<?php

namespace App\Http\Controllers;

use App\DataTables\LeadDataTable;
use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Timeline;
use App\Models\Appointment;
use App\Models\AppointmentNote;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\LeadSource;
use App\Models\Role;
use App\Models\Setting;
use App\Models\UtilityCompany;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendFirebaseNotification;
use App\Mail\LeadAssigned;
use App\Mail\UserTagged;
use App\Models\CommunicationMethod;
use App\Models\Deal;
use App\Models\HomeType;
use App\Models\Stage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $companyId = Auth::user()->company_id;

        $users = User::where('deleted_at', null)->where('company_id', Auth::user()->company_id)->get();
        $companies = Company::where('deleted_at', null)->get();
        $appointment = Appointment::where('deleted_at', null)->with('lead')->get();
        $note = Note::where('deleted_at', null)->get();
        $roles = Role::where('company_id', Auth::user()->company_id)->get();
        // Get assigned countries for the company
        $assignedCountryIds = Setting::where('company_id', $companyId)
            ->pluck('country_id')
            ->toArray();

        // If no countries are assigned, use United States (id=233)
        if (empty($assignedCountryIds)) {
            $assignedCountryIds = [233];
        }

        // Fetch country names from the Country model
        $countries = Country::whereIn('id', $assignedCountryIds)->pluck('name', 'id');

        // Fetch the states for these countries
        $states = State::whereIn('country_id', $assignedCountryIds)
            ->pluck('id', 'name')
            ->toArray();
            
        // Fetch the cities for these states
        $cities = City::whereIn('state_id', array_keys($states))
            ->pluck('id', 'name')
            ->toArray();
        // Retrieve Lead Sources and Utility Companies for filtering
        $sources = LeadSource::where('deleted_at', null)
        ->where('company_id', $companyId)
        ->get();
        $utilityCompanies = UtilityCompany::where('company_id', $companyId)->get();
        $homeTypes = HomeType::where('deleted_at', null)->where('company_id', Auth::user()->company_id)->get();
        $dealStages = Stage::where('deleted_at', null)->where('company_id', Auth::user()->company_id)->get();
        $communicationMethods = CommunicationMethod::where('deleted_at', null)->where('company_id', Auth::user()->company_id)->get();
        // Retrieve leads based on these states
        $leadsQuery = Lead::with('leadSource', 'utilityCompany', 'user', 'company')
            ->where('company_id', $companyId)
            ->join('states', 'leads.state_id', '=', 'states.id')  // Join with states table
            ->where(function ($query) {
                $query->where('owner_id', Auth::user()->id)
                    ->orWhere('sale_representative', Auth::user()->id)
                    ->orWhere('call_center_representative', Auth::user()->id);
            })
            ->whereNull('leads.deleted_at');

        // Apply search filters
        $searchTerm = $request->input('search', '');
        if (!empty($searchTerm)) {
            $leadsQuery->where(function($q) use ($searchTerm) {
                // If the search term is numeric, search by ID and phone number
                if (is_numeric($searchTerm)) {
                    $q->Where('leads.phone', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('leads.mobile', 'LIKE', "%{$searchTerm}%");
                } elseif (strpos($searchTerm, '@') !== false) {
                    $q->where('leads.email', 'LIKE', "%{$searchTerm}%");
                } elseif (preg_match('/^[a-zA-Z\s]+$/', $searchTerm)) {
                    $q->where('leads.first_name', 'LIKE', "{$searchTerm}%")
                    ->orWhere('leads.last_name', 'LIKE', "{$searchTerm}%")
                    ->orWhere('leads.email', 'LIKE', "{$searchTerm}%")
                    ->orWhere(DB::raw("CONCAT(leads.first_name, ' ', leads.last_name)"), 'LIKE', "%{$searchTerm}%");
                }
            });
        }
        
        // Apply date filters
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');
        if (!empty($dateFrom) && !empty($dateTo)) {
            $leadsQuery->whereBetween('leads.created_at', [$dateFrom, $dateTo]);
        } elseif (!empty($dateFrom)) {
            $leadsQuery->where('leads.created_at', '>=', $dateFrom);
        } elseif (!empty($dateTo)) {
            $leadsQuery->where('leads.created_at', '<=', $dateTo);
        }

        // Apply filter by lead source
        $filterSource = $request->input('filter_source');
        if (!empty($filterSource)) {
            $leadsQuery->where('leads.lead_source_id', '=', $filterSource);
        }

        // Apply filter by utility company
        $filterUtilityCompany = $request->input('filter_utility');
        if (!empty($filterUtilityCompany)) {
            $leadsQuery->where('leads.utility_company_id', '=', $filterUtilityCompany);
        }

        // Select the necessary fields including state_name
        $leadsQuery->select(
            'leads.*',
            'states.name as state_name'  // Select state name as state_name
        );

        // Paginate the results
        $rows = $leadsQuery->paginate(15)->withQueryString();

        return view('pages.lead.list', compact('sources', 'roles', 'utilityCompanies', 'states', 'cities', 'rows', 'request', 'users', 'companies', 'note', 'appointment', 'countries', 'homeTypes', 'dealStages', 'communicationMethods' ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);

        // Initialize variables
        $noteAdded = $request->input('notes') ? 1 : 0;
        $appointmentNoteAdded = $request->input('appointment_notes') ? 1 : 0;
        $appointmentHasNewComment = $appointmentNoteAdded ? 1 : 0;

        $userIds = isset($request->user_ids) ? implode(',', $request->user_ids) : null;
        $appointmentUserIds = isset($request->appointment_user_ids) ? implode(',', $request->appointment_user_ids) : null;

        // Create a new lead record
        $lead = $this->createLead($request, $noteAdded);

        if ($lead) {
            // Create appointment if necessary
            if ($lead->appointment_sat == 1 && $request->input('appointment_date') && $request->input('appointment_time')) {
                $appointment = $this->createAppointment($request, $lead->id, $appointmentNoteAdded, $appointmentHasNewComment);

                if ($appointment) {
                    // Add timeline and notes
                    $this->createTimelineAndNotes($request, $lead, $appointment, $noteAdded, $appointmentUserIds, $userIds);
                }
            }

            $senderUser = auth()->user();

            if ($request->input('sale_representative')) {
                $salesRepresentativeId = $request->input('sale_representative');
                $saleRepresentativeUser = User::where('id', $salesRepresentativeId)->first();

                // Send notification to the sales representative
                $this->sendFirebaseNotification([$request->input('sale_representative')], [
                    'title' => 'New Lead Created',
                    'body' => 'A new lead has been assigned to you.',
                    'click_action' => env('APP_URL') . "leads/" . $lead->id
                ]);
                // Send email notification to the sales representative
                if ($saleRepresentativeUser->email) {
                    $leadCreatedAt = \Carbon\Carbon::parse($lead->created_at)->format('d M Y h:i a');
                    Mail::to($saleRepresentativeUser->email)->queue(new LeadAssigned($lead, $leadCreatedAt, $senderUser, $saleRepresentativeUser));
                }
            }

            // Send notification to the appointment tagged users
            if ($request->appointment_user_ids) {
                $this->sendFirebaseNotification($request->appointment_user_ids, [
                    'title' => 'You have been tagged in a comment',
                    'body' => ucwords(Auth::user()->name) . ' has mentioned you in a comment.',
                    'click_action' => env('APP_URL') . "appointments/" . $appointment->id . "?show_comments"
                ]);

                // Send email to the assigned sales representative
                $receiverUsers = User::whereIn('id', $request->appointment_user_ids)->get();
                $appointmentComment = $request->input('appointment_notes');
                $appointmentCreatedAt = \Carbon\Carbon::parse($appointment->created_at)->format('d M Y h:i a');
                foreach ($receiverUsers as $taggedUser) {
                    if ($taggedUser && $taggedUser->email) {
                        Mail::to($taggedUser->email)->queue(new UserTagged($appointment, $appointmentComment, $appointmentCreatedAt, $senderUser, $taggedUser));
                    }
                }
            }

            return redirect()->back()->with('success', 'Lead has been created successfully.');
        }

        return redirect()->back()->with('error', 'Failed to create lead.');
    }

    protected function validateRequest($request)
    {
        $request->validate([
            'owner_id' => 'required|integer',
            'sale_representative' => 'required|integer',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => 'nullable',
            'phone' => 'required|string|max:25',
            'email' => 'required|email|max:255',
            'utility_company_id' => 'nullable|integer',
            'call_center_representative' => 'nullable|integer',
            'lead_source_id' => 'required|integer',
            'appointment_sat' => 'nullable',
            'street' => 'nullable|string|max:255',
            'country_id' => 'required|int',
            'state_id' => 'required|int',
            'city_id' => 'int',
            'zip' => 'nullable|string|max:20',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
        ]);
        $request->validate([
            'appointment_date' => 'required_if:appointment_sat,1',
            'appointment_time' => 'required_if:appointment_sat,1',
        ]);
    }

    protected function createLead($request, $noteAdded)
    {
        return Lead::create([
            'company_id' => Auth::user()->company_id,
            'owner_id' => $request->input('owner_id'),
            'sale_representative' => $request->input('sale_representative'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'mobile' => $request->input('mobile'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'utility_company_id' => $request->input('utility_company_id'),
            'call_center_representative' => $request->input('call_center_representative'),
            'lead_source_id' => $request->input('lead_source_id'),
            'appointment_sat' => $request->input('appointment_sat', 0),
            'street' => $request->input('street'),
            'city_id' => $request->input('city_id'),
            'state_id' => $request->input('state_id'),
            'zip' => $request->input('zip'),
            'country_id' => $request->input('country_id'),
            'address_1' => $request->input('address1'),
            'address_2' => $request->input('address2'),
            'note_added' => $noteAdded,
            'created_by' => Auth::user()->id,
        ]);
    }

    protected function createAppointment($request, $leadId, $appointmentNoteAdded, $appointmentHasNewComment)
    {
        return Appointment::create([
            'lead_id' => $leadId,
            'status_id' => $request->input('status_id'),
            'representative_user' => $request->input('call_center_representative'),
            'appointment_date' => $request->input('appointment_date'),
            'appointment_time' => $request->input('appointment_time'),
            'appointment_street' => $request->input('street'),
            'appointment_country_id' => $request->input('country_id'),
            'appointment_state_id' => $request->input('state_id'),
            'appointment_city_id' => $request->input('city_id'),
            'appointment_zip' => $request->input('zip'),
            'appointment_address_1' => $request->input('address1'),
            'appointment_address_2' => $request->input('address2'),
            'timeline_date' => date('Y-m-d'),
            'note_added' => $appointmentNoteAdded,
            'has_new_comments' => $appointmentHasNewComment,
            'created_by' => Auth::user()->id,
        ]);
    }

    protected function createTimelineAndNotes($request, $lead, $appointment, $noteAdded, $appointmentUserIds, $userIds)
    {
        Timeline::create([
            'appointment_id' => $appointment->id,
            'status_id' => $request->input('status_id'),
            'timeline_date' => date('Y-m-d'),
            'note_added' => $noteAdded,
            'created_by' => Auth::user()->id,
        ]);

        if ($request->input('appointment_notes')) {
            AppointmentNote::create([
                'appointment_id' => $appointment->id,
                'status_id' => $request->input('status_id'),
                'user_id' => Auth::user()->id,
                'user_ids' => $appointmentUserIds,
                'unread_ids' => $appointmentUserIds,
                'notes' => trim($request->input('appointment_notes')),
                'created_by' => Auth::user()->id,
            ]);
        }

        if ($request->input('notes')) {
            Note::create([
                'lead_id' => $lead->id,
                'user_id' => Auth::user()->id,
                'user_ids' => $userIds,
                'unread_ids' => $userIds,
                'notes' => trim($request->input('notes')),
                'created_by' => Auth::user()->id,
            ]);
        }
    }

    protected function sendFirebaseNotification($userIds, $notificationData)
    {
        // Dispatch the job for sending Firebase notifications
        SendFirebaseNotification::dispatch($userIds, $notificationData);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        
        $appointments = Appointment::whereNull('deleted_at')
            ->where('lead_id', $lead->id)
            ->with('status')
            ->with('country')
            ->with('state')
            ->with('city')
            ->get();
        $users = User::whereNull('deleted_at')
            ->where('company_id', Auth::user()->company_id)
            ->pluck('name', 'id')
            ->toArray();
        $rows = AppointmentNote::select('appointment_notes.id as note_id', 'users.name as user_name', 'appointment_notes.*')
            ->Join('appointments', 'appointment_notes.appointment_id', 'appointments.id')
            ->leftJoin('users', 'appointment_notes.created_by', 'users.id')
            ->leftJoin('leads', 'appointments.lead_id', 'leads.id')
            ->where('leads.id', $lead->id)
            ->whereNull('appointment_notes.deleted_at')
            ->orderBy('appointment_notes.created_at', 'DESC') // Order by latest
            ->paginate(10) // Adjust the pagination limit as needed
            ->withQueryString();
        return view('pages/lead/show', compact('lead', 'appointments', 'users', 'rows'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lead $lead)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'owner_id' => 'required|exists:users,id',
            'sale_representative' => 'required|exists:users,id',
            'lead_source_id' => 'required|exists:lead_source,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:25',
            'phone' => 'nullable|string|max:25',
            'email' => 'required|email|max:255',
            'utility_company_id' => 'nullable|exists:utility_companies,id',
            'call_center_representative' => 'nullable|exists:users,id',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'nullable|exists:cities,id',
            'street' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:10',
            'address_1' => 'required|string|max:255',
            'address_2' => 'nullable|string|max:255',
        ]);
        $lead = Lead::findOrFail($request->lead_id);
        // Update lead information
        $lead->update([
            'owner_id' => $validatedData['owner_id'],
            'sale_representative' => $validatedData['sale_representative'],
            'lead_source_id' => $validatedData['lead_source_id'],
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'mobile' => $validatedData['mobile'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'utility_company_id' => $validatedData['utility_company_id'],
            'call_center_representative' => $validatedData['call_center_representative'],
            'country_id' => $validatedData['country_id'],
            'state_id' => $validatedData['state_id'],
            'city_id' => $validatedData['city_id'] ?? null,
            'street' => $validatedData['street'],
            'zip' => $validatedData['zip'],
            'address_1' => $validatedData['address_1'],
            'address_2' => $validatedData['address_2'],
        ]);

        // Return success response
        return response()->json([
            'success' => 'Lead information updated successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $lead = Lead::findOrFail($request->leadId);
        $lead->deleted_at = now();
        if ($lead->save()) {
            return response()->json(['success' => true, 'message' => 'Lead successfully deleted']);
        }
        return response()->json(['failed' => true, 'message' => 'Failed to delete Lead!']);
    }

    public function noteStore(Request $request)
    {
        // Validate the request data
        $request->validate([
            'timeline_notes' => 'required|string',
        ]);
        if ($request->timeline_notes && $request->timeline_notes != Null) {
            if (isset($request->user_ids) && $request->user_ids != null) {
                $userIds = implode(',', $request->user_ids);
            }
            Note::create([
                'lead_id' => $request->lead_id,
                'user_id' => Auth::user()->id,
                'user_ids' => $userIds ?: null,
                'unread_ids' => $userIds ?: null,
                'notes' => $request->timeline_notes,
                'created_by' => Auth::user()->id,
            ]);
            return response()->json(['success' => true, 'message' => 'New Comment Added']);
        }
        return response()->json(['failed' => true, 'message' => 'Failed to Add Comment']);
    }

    public function markAsRead(Request $request)
    {
        $note = Note::where('id', $request->noteId)->first();

        $unread_ids = $note->unread_ids ? explode(',', $note->unread_ids) : [];

        if (($key = array_search(Auth::user()->id, $unread_ids)) !== false) {
            unset($unread_ids[$key]);
            $note->unread_ids = implode(',', $unread_ids);
            if (empty($unread_ids)) {
                $note->is_read = 1;
            }
            $note->save();
            return response()->json(['success' => true, 'message' => 'Note marked as read']);
        }
        return response()->json(['failed' => true, 'message' => 'Failed to Note marked as read']);
    }

    public function viewLeadComments(Request $request)
    {
        if ($request->lead_id) {
            $users = User::where('deleted_at', null)
                ->where('company_id', Auth::user()->company_id)
                ->get();
            $users = array_column($users->toArray(), 'name', 'id');
            $leadNotes = Note::where('lead_id', $request->lead_id)
                ->whereNull('deleted_at')
                ->get();
            return view('pages.lead.comments', compact('users', 'leadNotes'))->render();
        }
    }

    public function getStates(Request $request)
    {
        $countryId = $request->countryId;

        if ($countryId) {
            $states = State::where('country_id', $countryId)
                ->leftJoin('state_colours', 'states.id', '=', 'state_colours.state_id')
                ->get(['states.id', 'states.name', 'state_colours.color_code']);

            // Format the states as key-value pairs with color codes
            $formattedStates = [];
            foreach ($states as $state) {
                $formattedStates[] = [
                    'id' => $state->id,
                    'name' => $state->name,
                    'color_code' => $state->color_code,
                ];
            }

            return response()->json(['states' => $formattedStates]);
        }

        return response()->json(['states' => []]); // Return empty array if no countryId is provided
    }

    public function getCities(Request $request)
    {
        $stateId = $request->stateId;

        if ($stateId) {
            $cities = City::where('state_id', $stateId)->pluck('name', 'id');
            return response()->json(['states' => $cities]);
        }

        return response()->json(['cities' => []]); // Return empty array if no stateId is provided
    }
    
    public function convertLeadToDeal(Request $request)
    {
        $request->validate([
            'convert_lead_id' => 'nullable|integer|exists:leads,id',
            'project_administrator_id' => 'nullable|integer|exists:users,id',
            'owner_id' => 'nullable|integer|exists:users,id',
            'financier_id' => 'nullable|integer|exists:users,id',
            'home_type_id' => 'nullable|integer|exists:home_types,id',
            'deal_account_name' => 'nullable|string|max:255',
            'deal_contact_name' => 'nullable|string|max:255',
            'deal_phone_burner_last_call_outcome' => 'nullable|string|max:255',
            'deal_social_lead_id' => 'nullable|string|max:255',
            'deal_amount' => 'nullable|numeric',
            'deal_closing_date' => 'nullable|date',
            'deal_pipeline' => 'nullable|integer',
            'communication_method_id' => 'nullable|integer|exists:communication_methods,id',
            'stage_id' => 'nullable|integer|exists:stages,id',
            'deal_probability' => 'nullable|numeric|min:0|max:100',
            'deal_expected_revenue' => 'nullable|numeric',
            'deal_permit_number' => 'nullable|string|max:255',
            'deal_phone_burner_followup_date' => 'nullable|date',
            'deal_phone_burner_last_call_time' => 'nullable|date_format:Y-m-d\TH:i',
            'deal_availability_start' => 'nullable',
            'deal_availability_end' => 'nullable',
            'organization_id' => 'nullable|integer|exists:organizations,id',
        ]);
        $leadId = $request->convert_lead_id;

        if ($leadId) {
            $lead = Lead::findOrFail($leadId);
            $deal_address = (implode(', ', array_filter([
                optional($lead->country)->name,
                optional($lead->state)->name,
                optional($lead->city)->name,
                $lead->address_1,
                $lead->address_2,
                $lead->street,
                $lead->zip
            ])));
            $deal_name = (implode(' ', array_filter([$lead->first_name, $lead->last_name])));
            $deal_phone_1 = $lead->phone;
            $deal_email = $lead->email;
            $source_id = $lead->lead_source_id;
            Deal::create([
                'lead_id' => $leadId,
                'project_administrator_id' => $request->project_administrator_id,
                'owner_id' => $request->owner_id,
                'deal_name' => $deal_name,
                'deal_address' => $deal_address,
                'deal_phone_1' => $deal_phone_1,
                'deal_email' => $deal_email,
                'financier_id' => $request->financier_id,
                'home_type_id' => $request->home_type_id,
                'source_id' => $source_id,
                'deal_account_name' => $request->deal_account_name,
                'deal_contact_name' => $request->deal_contact_name,
                'deal_phone_burner_last_call_outcome' => $request->deal_phone_burner_last_call_outcome,
                'deal_social_lead_id' => $request->deal_social_lead_id,
                'deal_amount' => $request->deal_amount,
                'deal_closing_date' => $request->deal_closing_date,
                'deal_pipeline' => $request->deal_pipeline,
                'communication_method_id' => $request->communication_method_id,
                'stage_id' => $request->stage_id,
                'deal_probability' => $request->deal_probability,
                'deal_expected_revenue' => $request->deal_expected_revenue,
                'deal_permit_number' => $request->deal_permit_number,
                'deal_phone_burner_followup_date' => $request->deal_phone_burner_followup_date,
                'deal_phone_burner_last_call_time' => $request->deal_phone_burner_last_call_time,
                'deal_availability_start' => $request->deal_availability_start,
                'deal_availability_end' => $request->deal_availability_end,
                'organization_id' => $request->organization_id,
                'company_id' => Auth::user()->company_id,
                'created_by' => Auth::user()->id,
            ]);
            return response()->json(['success' => 'Deal created successfully.']);
        } else {
            return response()->json(['error' => 'Failed to convert Lead to Deal'], 500);
        }
    }

    public function export(Request $request)
    {
        $dateTime = Carbon::now()->format('Y-m-d_h-i-s-a');
        $fileName = 'leads_'.$dateTime.'.csv';
        
        $leads = Lead::query();
        if ($request->has('search') && !empty($request->search)) {
            $leads->where(function($query) use ($request) {
                $query->where('first_name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere(DB::raw("CONCAT(leads.first_name, ' ', leads.last_name)"), 'LIKE', '%' . $request->search . '%')
                    ->orWhere('phone', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $request->search . '%');
            });
        }
    
        if ($request->has('date_from') && !empty($request->date_from)) {
            $leads->whereDate('created_at', '>=', $request->date_from);
        }
    
        if ($request->has('date_to') && !empty($request->date_to)) {
            $leads->whereDate('created_at', '<=', $request->date_to);
        }
    
        if ($request->has('filter_source') && !empty($request->filter_source)) {
            $leads->where('source_id', $request->filter_source);
        }
        
        if ($request->has('filter_utility') && !empty($request->filter_utility)) {
            $leads->where('utility_company_id', $request->filter_utility);
        }
    
        $leads = $leads->whereNull('leads.deleted_at')->get();
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ];

        $callback = function() use ($leads) {
            $file = fopen('php://output', 'w');

            // Set the header row
            fputcsv($file, ['Sr. No.', 'Company Name', 'Lead Name', 'Lead Email', 'Lead Phone', 'Lead Address', 'Owner', 'Sale Representative', 'Utility Company', 'Source', 'Call Center Representative', 'Created By', 'Created At']);

            // Set the data rows
            $counter = 1;
            foreach ($leads as $lead) {
                $leadAddress = implode(', ', array_filter([
                    optional($lead->country)->name,
                    optional($lead->state)->name,
                    optional($lead->city)->name,
                    $lead->address_1,
                    $lead->address_2,
                    $lead->street,
                    $lead->zip
                ]));
                fputcsv($file, [
                    $counter++,
                    optional($lead->company)->name,
                    $lead->first_name . ' ' . $lead->last_name,
                    $lead->email,
                    $lead->phone,
                    $leadAddress,
                    optional($lead->owner)->name,
                    optional($lead->saleRepresentative)->name,
                    optional($lead->utilityCompany)->utility_company_name,
                    optional($lead->leadSource)->source_name,
                    optional($lead->callCenterRepresentative)->name,
                    optional($lead->user)->name,
                    Carbon::parse($lead->created_at)->format('d M Y H:i'),
                ]);
            }

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\CommunicationMethod;
use App\Models\Deal;
use App\Models\DealTimeline;
use App\Models\HomeType;
use App\Models\Lead;
use App\Models\LeadSource;
use App\Models\Role;
use App\Models\Stage;
use App\Models\Pipeline;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\Organization;

class DealController extends Controller
{
    // Display a listing of the deals
    public function index(Request $request)
    {
        $companyId = Auth::user()->company_id;

        // Retrieve necessary data for filters
        $users = User::whereNull('deleted_at')->where('company_id', $companyId)->get();
        $roles = Role::where('company_id', $companyId)->get();
        $leads = Lead::whereNull('deleted_at')->where('company_id', $companyId)->get();
        $homeTypes = HomeType::whereNull('deleted_at')->where('company_id', $companyId)->get();
        $leadSources = LeadSource::whereNull('deleted_at')->where('company_id', $companyId)->get();
        $dealStages = Stage::whereNull('deleted_at')->where('company_id', $companyId)->get();
        $dealPipelines = Pipeline::whereNull('deleted_at')->where('company_id', $companyId)->get();
      
        $communicationMethods = CommunicationMethod::whereNull('deleted_at')->where('company_id', $companyId)->get();
        $organizations = Organization::where('company_id', $companyId)
        ->whereNull('deleted_at')->get();
        // Initialize the deal query with necessary joins and filters
        $dealQuery = Deal::query()
            ->join('users', 'deals.created_by', '=', 'users.id')
            ->join('stages', 'deals.stage_id', '=', 'stages.id')
            ->join('pipeline', 'deals.deal_pipeline', '=', 'pipeline.id')
            ->whereNull('deals.deleted_at')
            ->select('deals.*', 'deals.id as deal_id');

        // Apply search filters (deal name, user name, phone, or email)
        $searchTerm = $request->input('search', '');
        if (!empty($searchTerm)) {
            $dealQuery->where(function ($q) use ($searchTerm) {
                if (is_numeric($searchTerm)) {
                    $q->where('deals.phone', 'LIKE', "%{$searchTerm}%");
                } elseif (strpos($searchTerm, '@') !== false) {
                    $q->where('deals.deal_email', 'LIKE', "%{$searchTerm}%");
                } elseif (preg_match('/^[a-zA-Z\s]+$/', $searchTerm)) {
                    $q->where('deals.deal_name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('users.name', 'LIKE', "%{$searchTerm}%");
                }
            });
        }

        // Apply date range filters
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');
        if (!empty($dateFrom) && !empty($dateTo)) {
            $dealQuery->whereBetween('deals.created_at', [$dateFrom, $dateTo]);
        } elseif (!empty($dateFrom)) {
            $dealQuery->where('deals.created_at', '>=', $dateFrom);
        } elseif (!empty($dateTo)) {
            $dealQuery->where('deals.created_at', '<=', $dateTo);
        }

        // Apply amount filter
        $filterAmount = $request->input('amount');
        if (!empty($filterAmount) && is_numeric($filterAmount)) {
            $dealQuery->where('deals.deal_amount', '=', $filterAmount);
        }

        // Apply stage filter
        $filterStage = $request->input('filter_stage');
        if (!empty($filterStage)) {
            $dealQuery->where('deals.stage_id', '=', $filterStage);
        }

        $filterPipeline = $request->input('filter_pipeline');
        if (!empty($filterPipeline)) {
            $dealQuery->where('deals.deal_pipeline', '=', $filterPipeline);
        }

        // Fetch results with pagination
        $rows = $dealQuery->paginate(15)->withQueryString();

        // Return the view with all necessary data
        return view('pages.deals.index', compact(
            'rows', 'users', 'roles', 'leads', 'homeTypes', 'leadSources', 'dealStages', 'communicationMethods' ,'organizations','dealPipelines'
        ));
    }


    // Show the form for creating a new deal
    public function create()
    {
        return view('deals.create');
    }

    // Store a newly created deal in storage
    public function store(Request $request)
    {
        $this->validateRequest($request);
        $deal = $this->createDeal($request);
        if ($deal) {
            // Add deal timeline
            $this->createDealTimeline($request, $deal);
            return response()->json(['success' => 'Deal created successfully.']);
        } else {
            return response()->json(['error' => 'Failed to create new Deal'], 500);
        }
    }

    protected function validateRequest($request)
    {
        // Validate the request data
        $request->validate([
            'deal_name' => 'required|string|max:255',
            'lead_id' => 'nullable|integer|exists:leads,id',
            'project_administrator_id' => 'nullable|integer|exists:users,id',
            'owner_id' => 'nullable|integer|exists:users,id',
            'deal_phone_1' => 'nullable|string|max:255',
            'deal_email' => 'nullable|email|max:255',
            'financier_id' => 'nullable|integer|exists:users,id',
            'home_type_id' => 'nullable|integer|exists:home_types,id',
            'source_id' => 'nullable|integer|exists:lead_source,id',
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
    }

    protected function createDeal($request)
    {
        return Deal::create([
            'lead_id' => $request->lead_id,
            'project_administrator_id' => $request->project_administrator_id,
            'owner_id' => $request->owner_id,
            'deal_name' => $request->deal_name,
            'deal_address' => $request->deal_address,
            'deal_phone_1' => $request->deal_phone_1,
            'deal_email' => $request->deal_email,
            'financier_id' => $request->financier_id,
            'home_type_id' => $request->home_type_id,
            'source_id' => $request->source_id,
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
    }

    protected function createDealTimeline($request, $deal)
    {
        DealTimeline::create([
            'deal_id' => $deal->id,
            'stage_id' => $request->input('stage_id'),
            'created_by' => Auth::user()->id,
        ]);
    }

    // Display the specified deal
    public function show(Deal $deal)
    {
        $stageIds = Stage::whereNull('deleted_at')
            ->where('company_id', Auth::user()->company_id)
            ->pluck('id')
            ->toArray();
        $dealTimelines = DealTimeline::whereNull('deleted_at')
            ->where('deal_id', $deal->id)
            ->whereIn('stage_id', $stageIds)
            ->get();
        return view('pages.deals.show', compact('deal', 'dealTimelines'));
    }

    // Show the form for editing the specified deal
    public function edit(Deal $deal)
    {
        return view('deals.edit', compact('deal'));
    }

    // Update the specified deal in storage
    public function update(Request $request)
    {
        $request->validate([
            'update_deal_name' => 'required|string|max:255',
            'update_lead_id' => 'nullable|integer|exists:leads,id',
            'update_project_administrator_id' => 'nullable|integer|exists:users,id',
            'update_owner_id' => 'nullable|integer|exists:users,id',
            'update_deal_phone_1' => 'nullable|string|max:255',
            'update_deal_email' => 'nullable|email|max:255',
            'update_financier_id' => 'nullable|integer|exists:users,id',
            'update_home_type_id' => 'nullable|integer|exists:home_types,id',
            'update_source_id' => 'nullable|integer|exists:lead_source,id',
            'update_deal_account_name' => 'nullable|string|max:255',
            'update_deal_contact_name' => 'nullable|string|max:255',
            'update_deal_phone_burner_last_call_outcome' => 'nullable|string|max:255',
            'update_deal_social_lead_id' => 'nullable|string|max:255',
            'update_deal_amount' => 'nullable|numeric',
            'update_deal_closing_date' => 'nullable|date',
            'update_deal_pipeline' => 'nullable|integer',
            'update_communication_method_id' => 'nullable|integer|exists:communication_methods,id',
            'update_stage_id' => 'nullable|integer|exists:stages,id',
            'update_deal_probability' => 'nullable|numeric|min:0|max:100',
            'update_deal_expected_revenue' => 'nullable|numeric',
            'update_deal_permit_number' => 'nullable|string|max:255',
            'update_deal_phone_burner_followup_date' => 'nullable|date',
            'update_deal_phone_burner_last_call_time' => 'nullable|date_format:Y-m-d\TH:i',
            'update_deal_availability_start' => 'nullable',
            'update_deal_availability_end' => 'nullable',
            'update_organization_id' => 'nullable|integer|exists:organizations,id',
        ]);
        if ($request->deal_id) {
            $deal = Deal::findOrFail($request->deal_id);
            $oldDealStageId = $deal->stage_id;
            $deal->lead_id = $request->update_lead_id;
            $deal->project_administrator_id = $request->update_project_administrator_id;
            $deal->owner_id = $request->update_owner_id;
            $deal->deal_name = $request->update_deal_name;
            $deal->deal_address = $request->update_deal_address;
            $deal->deal_phone_1 = $request->update_deal_phone_1;
            $deal->deal_email = $request->update_deal_email;
            $deal->financier_id = $request->update_financier_id;
            $deal->home_type_id = $request->update_home_type_id;
            $deal->source_id = $request->update_source_id;
            $deal->deal_account_name = $request->update_deal_account_name;
            $deal->deal_contact_name = $request->update_deal_contact_name;
            $deal->deal_phone_burner_last_call_outcome = $request->update_deal_phone_burner_last_call_outcome;
            $deal->deal_social_lead_id = $request->update_deal_social_lead_id;
            $deal->deal_amount = $request->update_deal_amount;
            $deal->deal_closing_date = $request->update_deal_closing_date;
            $deal->deal_pipeline = $request->update_deal_pipeline;
            $deal->communication_method_id = $request->update_communication_method_id;
            $deal->stage_id = $request->update_stage_id;
            $deal->deal_probability = $request->update_deal_probability;
            $deal->deal_expected_revenue = $request->update_deal_expected_revenue;
            $deal->deal_permit_number = $request->update_deal_permit_number;
            $deal->deal_phone_burner_followup_date = $request->update_deal_phone_burner_followup_date;
            $deal->deal_phone_burner_last_call_time = $request->update_deal_phone_burner_last_call_time;
            $deal->deal_availability_start = $request->update_deal_availability_start;
            $deal->deal_availability_end = $request->update_deal_availability_end;
            $deal->organization_id = $request->update_organization_id;
            $deal->updated_by = Auth::user()->id;
            if ($deal->save()) {
                if ($oldDealStageId != $request->update_stage_id) {
                    DealTimeline::create([
                        'deal_id' => $deal->id,
                        'stage_id' => $request->input('update_stage_id'),
                        'created_by' => Auth::user()->id,
                    ]);
                }
                return response()->json(['success' => 'Deal updated successfully']);
            } else {
                return response()->json(['error' => 'Failed to update Deal'], 500);
            }
        }
    }

    // Remove the specified deal from storage
    public function destroy(Request $request)
    {
        $deal = Deal::findorFail($request->dealId);
        $deal->delete();

        return redirect()->route('deals.index')->with('success', 'Deal deleted successfully.');
    }

    public function viewDealTimeline(Request $request)
    {
        if ($request->deal_id) {
            $users = User::where('deleted_at', null)
                ->where('company_id', Auth::user()->company_id)
                ->get();
            $users = array_column($users->toArray(), 'name', 'id');
            $stages = Stage::whereNull('deleted_at')
                ->where('company_id', Auth::user()->company_id)
                ->get();
            $deal = Deal::where('deleted_at', null)
                ->where('id', $request->deal_id)
                ->first();
            $allDealTimeline = DealTimeline::where('deal_id', $request->deal_id)
                ->whereNull('deleted_at')
                ->get();
            return view('pages.deals.deal-data', compact('deal', 'stages', 'users', 'allDealTimeline'))->render();
        }
    }

    public function updateDealTimeline(Request $request)
    {
        if ($request->deal_id) {
            $deal = Deal::findOrFail($request->deal_id);
            $deal->stage_id = $request->stage_id;
            if ($deal->save()) {
                // If the status has changed, create a new timeline entry
                $dealTimelineId = $request->deal_timeline_id;
                if ($request->current_stage_id != $request->stage_id) {
                    $createdDealTimeline = DealTimeline::create([
                        'deal_id' => $request->deal_id,
                        'stage_id' => $request->stage_id,
                        'created_by' => Auth::user()->id,
                    ]);
                    $dealTimelineId = $createdDealTimeline->id;
                } else {
                    if ($dealTimelineId) {
                        $dealTimeline = DealTimeline::findOrFail($dealTimelineId);
                        $dealTimeline->save();
                    }else {
                        $createdDealTimeline = DealTimeline::create([
                            'deal_id' => $request->deal_id,
                            'stage_id' => $request->stage_id,
                            'created_by' => Auth::user()->id,
                        ]);
                        $dealTimelineId = $createdDealTimeline->id;
                    }
                }
            }
            return redirect()->back()->with('success', 'Deal stage timeline has been updated successfully.');
        }
        return redirect()->back()->with('error', 'Failed to Update Deal stage timeline!');
    }

    public function export(Request $request)
    {
        $dateTime = Carbon::now()->format('Y-m-d_h-i-s-a');
        $fileName = 'deals_' . $dateTime . '.csv';
    
        // Build the deal query with eager loading to optimize related models fetching
        $deals = Deal::join('users', 'deals.created_by', '=', 'users.id')
                ->join('stages', 'deals.stage_id', '=', 'stages.id')
                ->join('pipeline', 'deals.deal_pipeline', '=', 'pipeline.id')
                ->when($request->has('search') && !empty($request->search), function($query) use ($request) {
                $searchTerm = $request->search;
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('deal_name', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('deal_phone_1', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('deal_email', 'LIKE', "%{$searchTerm}%");
                });
            })
            ->when($request->has('amount') && !empty($request->amount), function ($query) use ($request) {
                $query->where('deal_amount', '>=', $request->amount);
            })
            ->when($request->has('date_from') && !empty($request->date_from), function ($query) use ($request) {
                $query->whereDate('created_at', '>=', $request->date_from);
            })
            ->when($request->has('date_to') && !empty($request->date_to), function ($query) use ($request) {
                $query->whereDate('created_at', '<=', $request->date_to);
            })
            ->when($request->has('filter_stage') && !empty($request->filter_stage), function ($query) use ($request) {
                $query->where('stage_id', $request->filter_stage);
            })
            ->when($request->has('filter_pipeline') && !empty($request->filter_pipeline), function ($query) use ($request) {
                $query->where('deal_pipeline', $request->filter_pipeline);
            })
            ->whereNull('deals.deleted_at')
            ->get();
    
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ];
    
        $callback = function() use ($deals) {
            $file = fopen('php://output', 'w');
    
            // CSV header row
            $csvHeader = [
                'Sr. No.', 'Deal Name', 'Deal Email', 'Deal Phone', 'Account Name', 'Contact Name', 
                'Deal Amount', 'Project Administrator', 'Owner', 'Deal Stage', 'Home Type', 
                'Communication Method', 'Source', 'Closing Date', 'Probability', 'Expected Revenue', 
                'Availability Start', 'Availability End', 'Created By', 'Created At'
            ];
            fputcsv($file, $csvHeader);
    
            // CSV data rows
            $counter = 1;
            foreach ($deals as $deal) {
                fputcsv($file, [
                    $counter++,
                    $deal->deal_name,
                    $deal->deal_email,
                    $deal->deal_phone_1,
                    $deal->deal_account_name,
                    $deal->deal_contact_name,
                    $deal->deal_amount ? '$' . number_format($deal->deal_amount, 2) : 'N/A',
                    optional($deal->projectAdministrator)->name,
                    optional($deal->owner)->name,
                    optional($deal->stage)->stage_name,
                    optional($deal->getHomeType)->home_type_name,
                    optional($deal->source)->source_name,
                    optional($deal->communicationMethod)->method_name,
                    $deal->deal_closing_date,
                    $deal->deal_probability,
                    $deal->deal_expected_revenue,
                    $deal->deal_availability_start,
                    $deal->deal_availability_end,
                    optional($deal->creator)->name,
                    Carbon::parse($deal->created_at)->format('d M Y H:i'),
                ]);
            }
    
            fclose($file);
        };
    
        return new StreamedResponse($callback, 200, $headers);
    }
    
}

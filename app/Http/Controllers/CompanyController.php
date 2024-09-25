<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\FirebaseToken;
use App\Models\LoginActivity;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\CommunicationMethod;
use App\Models\Stage;
use App\Models\Status;
use App\Models\LeadSource;
use App\Models\HomeType;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $companyQuery = Company::withTrashed();
        $searchTerm = $request->input('search', '');
        if (!empty($searchTerm)) {
            $companyQuery->where(function ($q) use ($searchTerm) {
                if (is_numeric($searchTerm)) {
                    $q->where('companies.id', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('companies.phone', 'LIKE', "%{$searchTerm}%");
                } elseif (strpos($searchTerm, '@') !== false) {
                    $q->where('companies.email', 'LIKE', "%{$searchTerm}%");
                } elseif (preg_match('/^[a-zA-Z\s]+$/', $searchTerm)) {
                    $q->where('companies.name', 'LIKE', "%{$searchTerm}%"); 
                }
            });
        }
        $rows = $companyQuery->paginate(15)->withQueryString();
        return view('pages.company.index', compact('rows'));
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
        // Check if the email is already registered
        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
            return redirect()->back()->with('error', 'The email is already registered. Please use a different email.');
        }
        $company = $this->createCompany($request);
        if ($company) {
            $role = Role::create([
                'name' => 'admin', 
                'guard_name' => 'web', 
                'company_id' => $company->id,
            ]);
            if ($role) {
                $permissions = Permission::all();
                if ($permissions) {
                    foreach ($permissions as $permission) {
                        DB::table('role_has_permissions')->insert([
                            'permission_id' => $permission->id,
                            'role_id' => $role->id,
                        ]);
                    }
                }
            }
            $user = User::create([
                'company_id' => $company->id,
                'name' => $company->contact_person_name,
                'email' => $company->email,
                'email_verified_at' => now(),
                'password' => Hash::make($request->password),
                'password_plane' => $request->password,
            ]);

            if ($user) {
                DB::table('model_has_roles')->insert([
                    'role_id' => $role->id,
                    'model_type' => "App\Models\User",
                    'model_id' => $user->id,
                ]);
            }
            // Log in the user
            Auth::login($user);

            // Get the authenticated user
            $authenticatedUser = Auth::user();

            if ($authenticatedUser) {
                // Set session variables
                session(['company' => $company]);
                session(['fcm_token' => $request->input('fcm_token')]);
                 // Save the FCM token
                 if ($request->has('fcm_token') && $request->input('fcm_token')) {
                    FirebaseToken::create([
                        'user_id' => $authenticatedUser->id,
                        'fcm_token' => $request->input('fcm_token'),
                        'ip_address' => request()->ip(),
                    ]);
                }
            }
            if ($request->country_id) {
                // Insert new settings for each selected country
                foreach ($request->country_id as $key => $countryId) {
                    Setting::create([
                        'company_id' => $company->id,
                        'country_id' => $countryId?: '233',
                    ]);
                }
            }

            LoginActivity::create([
                'user_id' => Auth::id(),
                'status' => 'success',
                'device' => $request->header('User-Agent'),
                'ip_address' => $request->getClientIp(),
                'login_time' => Carbon::now(),
            ]);

            $request->user()->update([
                'last_login_at' => Carbon::now()->toDateTimeString(),
                'last_login_ip' => $request->getClientIp()
            ]);

            // Add company communication methods
            $defaultMethods = array("Call", "Email");
            foreach($defaultMethods as $method) {
                CommunicationMethod::create([
                    'company_id' => $company->id,
                    'method_name' => $method,
                    'created_by' => $authenticatedUser->id,
                ]);
            }

            // Add company deal stages
            $defaultStages = array("New" => "#fbff00", "Approved" => "#1eff00", "Cancelled" => "#ff0000");
            foreach($defaultStages as $stage => $color) {
                Stage::create([
                    'company_id' => $company->id,
                    'stage_name' => $stage,
                    'stage_color_code' => $color,
                    'created_by' => $authenticatedUser->id,
                ]);
            }

            // Add company appointment statues
            $defaultStatuses = array("Pending" => "#fbff00", "Completed" => "#1eff00", "Cancelled" => "#ff0000");
            foreach($defaultStatuses as $status => $color) {
                Status::create([
                    'company_id' => $company->id,
                    'status_name' => $status,
                    'color_code' => $color,
                    'created_by' => $authenticatedUser->id,
                ]);
            }

            // Add company lead sources
            $defaultSources = array("Email Marketing", "Direct Traffic", "Organic Search", "Networking");
            foreach($defaultSources as $source) {
                LeadSource::create([
                    'company_id' => $company->id,
                    'source_name' => $source,
                    'created_by' => $authenticatedUser->id,
                ]);
            }

            // Add deal home types
            $defaultHomeTypes = array("Single-Family Detached Home", "Apartment", "Townhouse (Townhome)", "Bungalow");
            foreach($defaultHomeTypes as $homeType) {
                HomeType::create([
                    'company_id' => $company->id,
                    'home_type_name' => $homeType,
                    'created_by' => $authenticatedUser->id,
                ]);
            }

            // Clear cache
            cache()->clear(); // Clear the application cache
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        return redirect()->back()->with('error', 'Failed to registered Company.');
    }

    protected function validateRequest($request)
    {
        $request->validate([
            'account_type' => 'nullable|integer',
            'employee_size' => 'nullable|int',
            'name' => 'required|string|max:255',
            'contact_person_name' => 'required|string|max:255',
            'account_plan' => 'nullable|integer',
            'business_type' => 'nullable|integer',
            'description' => 'string',
            'email' => [
                'required',
                'email',
                Rule::unique('companies'), 
            ],
            'phone' => 'required|string|max:25',
            'logo' => 'nullable|sometimes|image|max:1024',
            'website' => 'nullable|string',
            'address' => 'nullable|string',
            'password' => 'required|string|min:4',
        ]);
    }

    protected function createCompany($request)
    {
        return Company::create([
            'account_type' => $request->input('account_type'),
            'employee_size' => $request->input('employee_size', 1),
            'name' => $request->input('name'),
            'contact_person_name' => $request->input('contact_person_name'),
            'account_plan' => $request->input('account_plan', 1),
            'address' => $request->input('address'),
            'business_type' => $request->input('business_type'),
            'description' => $request->input('description'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'logo' => $request->input('logo') ? $request->input('logo')->store('companies', 'public') : null,
            'website' => $request->input('website'),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('pages/company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'account_type' => 'nullable|integer',
            'address' => 'nullable|string',
            'business_type' => 'nullable|integer',
            'employee_size' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);
        if ($request->company_id) {
            $company = Company::findOrFail($request->company_id);
            $company->name = $request->name;
            $company->account_type = $request->account_type;
            $company->address = $request->address;
            $company->employee_size = $request->employee_size;
            $company->business_type = $request->business_type;
            $company->description = $request->description;
            if ($company->save()) {
                return response()->json(['success' => 'Company updated successfully']);
            } else {
                return response()->json(['error' => 'Failed to update Company'], 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $company = Company::findorFail($request->companyId);
        $company->deleted_by = Auth::user()->id;
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}

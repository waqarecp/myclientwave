<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $companyId = Auth::user()->company_id;
        $assignedCountries = Setting::where('company_id', $companyId)->pluck('country_id')->toArray();
        
        // If no countries are assigned, default to United States (id=233)
        $selectedCountryIds = $assignedCountries ?: [233];
        
        // Pass the selected countries and all countries to the view
        $countries = Country::pluck('name', 'id'); // Assuming you have a Country model
        return view('pages.setting.index', compact('selectedCountryIds', 'countries'));
    }
    
    public function update(Request $request)
    {   
        $companyId = Auth::user()->company_id;
        
        try {
            // Delete all existing settings for the company
            Setting::where('company_id', $companyId)->delete();

            if ($request->country_id) {
                // Insert new settings for each selected country
                foreach ($request->country_id as $countryId) {
                    Setting::create([
                        'company_id' => $companyId,
                        'country_id' => $countryId,
                    ]);
                }
            }
            
            // Flash success message to session
            return redirect()->back()->with('success', 'Settings Saved Successfully');
        } catch (\Exception $e) {
            // Flash error message to session
            return redirect()->back()->with('error', 'Failed to save settings');
        }
    }
}

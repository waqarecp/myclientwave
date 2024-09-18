<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    
    public function registerCompany()
    {
        
        $countries = Country::where('deleted_at', null)->get();
        return view('register-company', compact('countries'));
    }
}

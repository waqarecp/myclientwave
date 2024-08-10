<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        return view('pages.reports.dsm_market_report');
    }
    
    public function list()
    {
        return view('pages.audience-manager.campaign');
    }
}

<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $pusherKey = config('broadcasting.connections.pusher.key');
        $company_logo_src_url = config('dashboard.info.company.logo.src_url');
        $company_name = config('dashboard.info.company.name');

        return view('dashboard')->with(compact('pusherKey', 'company_logo_src_url', 'company_name'));
    }
}

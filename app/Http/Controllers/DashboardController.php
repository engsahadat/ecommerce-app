<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\SSOService;

class DashboardController extends Controller
{
    /**
     * Show the dashboard
     */
    public function index()
    {
        // Check if user is logged in
        if (!Session::has('user_id')) {
            return redirect('/login');
        }
        
        $user = [
            'id' => Session::get('user_id'),
            'name' => Session::get('user_name'),
            'email' => Session::get('user_email'),
        ];
        
        $ssoToken = Session::get('sso_token');
        
        // Get the URL for the other app
        $foodpandaUrl = env('FOODPANDA_APP_URL', 'http://localhost/ZaviSoft/foodpanda-app/public') . '/sso-login?sso_token=' . urlencode($ssoToken);
        
        return view('dashboard', compact('user', 'foodpandaUrl'));
    }
}

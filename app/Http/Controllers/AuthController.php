<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Services\SSOService;

class AuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showLogin()
    {
        // Check if user is already logged in
        if (Session::has('user_id')) {
            return redirect('/dashboard');
        }
        
        return view('auth.login');
    }
    
    /**
     * Show the registration form
     */
    public function showRegister()
    {
        return view('auth.register');
    }
    
    /**
     * Handle user login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        // Find user by email
        $user = DB::table('users')->where('email', $request->email)->first();
        
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }
        
        // Set session
        Session::put('user_id', $user->id);
        Session::put('user_name', $user->name);
        Session::put('user_email', $user->email);
        
        // Generate SSO token
        $ssoToken = SSOService::generateToken($user->id);
        Session::put('sso_token', $ssoToken);
        
        // Determine redirect URL
        $redirectTo = $request->input('redirect_to');
        if ($redirectTo) {
            // Redirect to foodpanda app with SSO token
            $foodpandaUrl = env('FOODPANDA_APP_URL', 'http://localhost/ZaviSoft/foodpanda-app/public') . '/sso-login';
            $redirectUrl = SSOService::createSSORedirectUrl($foodpandaUrl, $ssoToken);
            $redirectUrl .= '&redirect_to=' . urlencode($redirectTo);
            return redirect($redirectUrl);
        }
        
        return redirect('/dashboard')->with('success', 'Logged in successfully! You are also logged into Foodpanda App.');
    }
    
    /**
     * Handle user registration
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);
        
        // Create user
        $userId = DB::table('users')->insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Log the user in
        $user = DB::table('users')->where('id', $userId)->first();
        Session::put('user_id', $user->id);
        Session::put('user_name', $user->name);
        Session::put('user_email', $user->email);
        
        // Generate SSO token
        $ssoToken = SSOService::generateToken($user->id);
        Session::put('sso_token', $ssoToken);
        
        return redirect('/dashboard')->with('success', 'Account created successfully!');
    }
    
    /**
     * Handle SSO login (when coming from another app)
     */
    public function ssoLogin(Request $request)
    {
        $token = $request->input('sso_token');
        
        if (!$token) {
            return redirect('/login')->withErrors(['error' => 'Invalid SSO token']);
        }
        
        // Validate token and get user
        $user = SSOService::validateToken($token);
        
        if (!$user) {
            return redirect('/login')->withErrors(['error' => 'SSO token expired or invalid']);
        }
        
        // Set session
        Session::put('user_id', $user->id);
        Session::put('user_name', $user->name);
        Session::put('user_email', $user->email);
        Session::put('sso_token', $token);
        
        $redirectTo = $request->input('redirect_to', '/dashboard');
        return redirect($redirectTo)->with('success', 'SSO login successful!');
    }
    
    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        $userId = Session::get('user_id');
        $ssoToken = Session::get('sso_token');
        
        // Revoke SSO tokens
        if ($userId) {
            SSOService::revokeUserTokens($userId);
        }
        
        // Clear session
        Session::flush();
        
        // Determine if we need to logout from foodpanda too
        $logoutBoth = $request->input('logout_both', false);
        if ($logoutBoth) {
            $foodpandaLogout = env('FOODPANDA_APP_URL', 'http://localhost/ZaviSoft/foodpanda-app/public') . '/logout';
            return redirect($foodpandaLogout);
        }
        
        return redirect('/login')->with('success', 'Logged out successfully');
    }
}

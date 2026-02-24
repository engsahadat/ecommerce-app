<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

/**
 * SSOService - Single Sign-On Service
 * Manages authentication tokens shared between multiple applications
 */
class SSOService
{
    /**
     * Generate a new SSO token for a user
     * 
     * @param int $userId
     * @return string The generated token
     */
    public static function generateToken($userId)
    {
        // Generate a unique token
        $token = Str::random(64);
        
        // Set token expiration (24 hours from now)
        $expiresAt = Carbon::now()->addHours(24);
        
        // Store token in database
        DB::table('sso_tokens')->insert([
            'user_id' => $userId,
            'token' => $token,
            'expires_at' => $expiresAt,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        // Clean up old tokens for this user
        self::cleanupExpiredTokens($userId);
        
        return $token;
    }
    
    /**
     * Validate an SSO token
     * 
     * @param string $token
     * @return object|null User data if token is valid, null otherwise
     */
    public static function validateToken($token)
    {
        if (empty($token)) {
            return null;
        }
        
        // Fetch token from database
        $ssoToken = DB::table('sso_tokens')
            ->where('token', $token)
            ->where('expires_at', '>', Carbon::now())
            ->first();
        
        if (!$ssoToken) {
            return null;
        }
        
        // Fetch user data
        $user = DB::table('users')
            ->where('id', $ssoToken->user_id)
            ->first();
        
        return $user;
    }
    
    /**
     * Remove expired tokens for a user
     * 
     * @param int $userId
     */
    public static function cleanupExpiredTokens($userId)
    {
        DB::table('sso_tokens')
            ->where('user_id', $userId)
            ->where('expires_at', '<', Carbon::now())
            ->delete();
    }
    
    /**
     * Revoke all tokens for a user (logout)
     * 
     * @param int $userId
     */
    public static function revokeUserTokens($userId)
    {
        DB::table('sso_tokens')
            ->where('user_id', $userId)
            ->delete();
    }
    
    /**
     * Revoke a specific token
     * 
     * @param string $token
     */
    public static function revokeToken($token)
    {
        DB::table('sso_tokens')
            ->where('token', $token)
            ->delete();
    }
    
    /**
     * Create a redirect URL with SSO token
     * 
     * @param string $targetUrl Base URL of the target application
     * @param string $token SSO token
     * @return string Full URL with token parameter
     */
    public static function createSSORedirectUrl($targetUrl, $token)
    {
        $separator = strpos($targetUrl, '?') !== false ? '&' : '?';
        return $targetUrl . $separator . 'sso_token=' . urlencode($token);
    }
}

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="card" style="max-width: 800px;">
    <div class="card-header">
        <h2>{{ __('🛒 Ecommerce Dashboard') }}</h2>
        <p>{{ __('Welcome to your personalized shopping dashboard') }}</p>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="user-info">
        <h3 style="margin-bottom: 1rem; color: #dc143c;">{{ __('Your Account') }}</h3>
        <p><strong>{{ __('Name:') }}</strong> {{ $user['name'] }}</p>
        <p><strong>{{ __('Email:') }}</strong> {{ $user['email'] }}</p>
        <p><strong>{{ __('User ID:') }}</strong> #{{ $user['id'] }}</p>
    </div>
    
    <div class="dashboard-grid">
        <div class="dashboard-card">
            <h3>0</h3>
            <p>{{ __('Orders') }}</p>
        </div>
        <div class="dashboard-card">
            <h3>0</h3>
            <p>{{ __('Cart Items') }}</p>
        </div>
        <div class="dashboard-card">
            <h3>0</h3>
            <p>{{ __('Wishlist') }}</p>
        </div>
    </div>
    
    <div class="sso-info" style="margin-top: 2rem;">
        <p><strong>{{ __('🔐 SSO Active - You\'re logged into both apps!') }}</strong></p>
        <p>{{ __('Click the button below to access Foodpanda App without logging in again') }}</p>
        <a href="{{ $foodpandaUrl }}" class="btn" style="display: inline-block; margin-top: 1rem; width: auto; padding: 0.75rem 2rem;">
            {{ __('Go to Foodpanda App →') }}
        </a>
    </div>
    
    <div style="margin-top: 2rem; text-align: center;">
        <a href="/logout" class="btn" style="background: #dc3545; width: auto; display: inline-block; padding: 0.75rem 2rem;">
            {{ __('Logout from Both Apps') }}
        </a>
    </div>
</div>
@endsection

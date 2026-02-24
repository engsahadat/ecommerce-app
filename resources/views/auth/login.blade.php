@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>{{ __('Login to Ecommerce') }}</h2>
        <p>{{ __('Enter your credentials to access your account') }}</p>
    </div>
    
    @if($errors->any())
        <div class="alert alert-error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <form method="POST" action="/login">
        @csrf
        
        <div class="form-group">
            <label for="email">{{ __('Email Address') }}</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>
        
        <div class="form-group">
            <label for="password">{{ __('Password') }}</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <button type="submit" class="btn">{{ __('Login') }}</button>
    </form>
    
    <div class="text-center mt-3">
        <p>{{ __('Don\'t have an account?') }} <a href="/register" class="link">{{ __('Register here') }}</a></p>
    </div>
    
    <div class="sso-info">
        <p><strong>{{ __('🔐 Single Sign-On Active') }}</strong></p>
        <p>{{ __('Logging in here will automatically log you into the Foodpanda App!') }}</p>
    </div>
    
    <div class="text-center mt-3">
        <p style="color: #666; font-size: 0.9rem;">{{ __('Demo credentials: demo@example.com / password') }}</p>
    </div>
</div>
@endsection

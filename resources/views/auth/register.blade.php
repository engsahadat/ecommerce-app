@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>{{ __('Create Account') }}</h2>
        <p>{{ __('Register for both Ecommerce and Foodpanda apps') }}</p>
    </div>
    
    @if($errors->any())
        <div class="alert alert-error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    
    <form method="POST" action="/register">
        @csrf
        
        <div class="form-group">
            <label for="name">{{ __('Full Name') }}</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
        </div>
        
        <div class="form-group">
            <label for="email">{{ __('Email Address') }}</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        
        <div class="form-group">
            <label for="password">{{ __('Password') }}</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <div class="form-group">
            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        
        <button type="submit" class="btn">{{ __('Register') }}</button>
    </form>
    
    <div class="text-center mt-3">
        <p>{{ __('Already have an account?') }} <a href="/login" class="link">{{ __('Login here') }}</a></p>
    </div>
    
    <div class="sso-info">
        <p><strong>{{ __('🔐 Single Sign-On Active') }}</strong></p>
        <p>{{ __('Your account will work on both Ecommerce and Foodpanda apps!') }}</p>
    </div>
</div>
@endsection

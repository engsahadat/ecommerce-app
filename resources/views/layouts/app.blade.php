<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ecommerce App') - Multi Login SSO</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-content">
            <h1>{{__('🛒 Ecommerce App')}}</h1>
            <div class="navbar-links">
                @if(Session::has('user_id'))
                    <span>{{__('Welcome,')}} {{ Session::get('user_name') }}</span>
                    <a href="/dashboard">{{__('Dashboard')}}</a>
                    <a href="/logout">{{__('Logout')}}</a>
                @else
                    <a href="/login">{{__('Login')}}</a>
                    <a href="/register">{{__('Register')}}</a>
                @endif
            </div>
        </div>
    </nav>
    
    <div class="container">
        @yield('content')
    </div>
</body>
</html>

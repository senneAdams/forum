<?php

session_start();

use Illuminate\Support\Facades\Auth;

?>
<html>
<head>
    @yield('styling')
</head>
<body>
<nav>
    <a href="{{ route('viewPostIndex') }}">Index</a>
@if(Auth::user())
        <a href="{{ route('viewCreatePost') }}">Creëer een post</a>
        <a href="{{ route('viewGetKey') }}">API Key</a>
        <a href="{{ route('viewEditProfile') }}">Profiel bewerken</a>
        <a href="{{ route('logOut') }}">Uitloggen</a>
        @else
        <a href="{{ route('viewLogin') }}">Login</a>
        <a href="{{ route('viewRegister') }}">Registreren</a>
    @endif
</nav>
@yield('content')
</body>
</html>


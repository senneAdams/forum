@extends('template.template')
<html>
<body>
@section('content')
<form action="{{route('submitLogin')}}" method="post">
    @csrf
    <div class="container">
        <h3>Inloggen</h3>
        <label for="email"><b>Email:</b></label>
        <input type="text" id="email" placeholder="Enter email" name="email" required>

        <label for="psw"><b>Password:</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <button type="submit">Login</button>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</form>
    @stop
</body>
</html>

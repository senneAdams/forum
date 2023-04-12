@extends('template.template')
<html>
<body>
@section('content')
<form action="{{route('submitRegister')}}" method="post">
    @csrf
    <div class="container">
        <h3>Registreren</h3>
        <label for="email"><b>Username:</b></label>
        <input type="text" id="username" placeholder="Enter username" name="username">

        <label for="email"><b>Email:</b></label>
        <input type="text" id="email" placeholder="Enter email" name="email">

        <label for="psw"><b>Password:</b></label>
        <input type="password" placeholder="Enter Password" name="password">

        <button type="submit">Registreer</button>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</form>
@stop
</body>
</html>

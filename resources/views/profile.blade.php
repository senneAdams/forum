@extends('template.template')
<html>
<body>
@section('content')
    <form method="post" action="{{route('submitEditProfile')}}">
        @csrf
        <h1>Profiel</h1>
        <label>Username:</label>
        <input type="text" name="username" id="username" value="{{$userData->username}}">
        <label>Email:</label>
        <input type="email" name="email" id="email" value="{{$userData->email}}">
        <label>Confirm old password:</label>
        <input type="password" name="oldPassword" id="oldPassword" placeholder="Oud wachtwoord">
        <label>New password:</label>
        <input type="password" name="password" id="password" placeholder="Nieuw wachtwoord">
        <input type="submit">
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
@endif
@endsection

@extends('template.template')
<?php
use Illuminate\Support\Facades\Auth;
?>
@section('content')
    <a href="{{route('getApiKey')}}"><button style="margin-top: 2.5%">get API Key(Nieuwe Key invalideert oudere keys)</button></a>
<div style="margin-top: 2%">
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
            {{ session()->get('success')['msg'] }}<br>
            Token:{{ auth::user()->tokens->first()['token']}}
        </div>
    @endif
</div>
@endsection

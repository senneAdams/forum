@extends('template.template')
@section('styling')
    <style>
        .center {
            margin: auto;
            width: 50%;
            border: 3px solid green;
            height: 90vh;
            overflow-y: scroll;
        }
    </style>
@stop
@section('content')
    <div class="center">
        <h1 style="margin-left: 5%">Post aanpassen</h1>
        <div style="width: 100%; height: 30%;">
            <form action="{{route('submitEditPost',$postData[0]->postID)}}" method="post">
                @csrf
                <div style="margin-top: 3.5%; margin-bottom: 1%">
                    <label style="margin-right: 2%; margin-left: 5%; ">Titel:</label>
                    <input name="postTitle" id="postTitle" value="{{$postData[0]->Title}}">
                </div>
                <div>
                    <label style="display: block; margin-left: 5%">Content:</label>
                    <textarea name="postDescription" id="postDescription"
                              style="width: 90%; margin-left: 5%; margin-right: 5%; height: 60%; display: block">{{$postData[0]->Content}}</textarea>
                </div>
                <a>
                    <button style="float: right;display: inline;margin-right: 5%;margin-top: 1.7%;margin-left: 0.5%" type="submit">Opslaan</button>
                </a>
            </form>
                <a href="{{route('viewPost',$postData[0]->postID)}}">
                    <button style="float: right; display: inline">Terug</button>
                </a>
            <div style="margin-left: 5%">
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
            </div>
        </div>
    </div>
@stop

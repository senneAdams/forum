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
        <div style="width: 100%; height: 30%;">
            <div style="margin-top: 3.5%">
                <h2 style="margin-left: 5%; display: inline">{{$postData[0]->Title}}</h2>
                <h5 style="display: inline; padding-left: 3%">gemaakt door:{{$postData[0]->user->username}}</h5>
                @if(\Illuminate\Support\Facades\Auth::id() === $postData[0]->user->id)
                    <div style="float: right; margin-right: 5%">
                        <a href="{{route('viewEditPost',$postData[0]->postID)}}"><button>Edit</button></a>
                    </div>
                @endif
            </div>
            <div>
                <textarea
                    readonly style="width: 90%; margin-left: 5%; margin-right: 5%; height: 60%">{{$postData[0]->Content}}</textarea>
            </div>
        </div>
        <div style="width: 90%; border: 1px solid gray; margin-left: 5%"></div>
        @if(!empty($postData[0]->comments))
            @foreach($postData[0]->comments as $data)
                <div style="margin-left: 5%; margin-right: 5%; width: 90%; height: 25%">
                    <h4 style="margin-left: 5%">{{$data->username}}</h4>
                    <div><textarea readonly style="height: 50%; width: 90%; margin-left: 5%">{{$data->Content}}</textarea></div>
                </div>
            @endforeach
        @endif
        <div>
            @auth
                <form action="{{route('submitComment',$postData[0]->postID)}}" method="post">
                    @csrf
                    <div style="margin-left: 5%; margin-right: 5%; width: 90%; height: 25%">
                        <h4 style="margin-left: 5%">Nieuwe comment</h4>
                        <div>
                            <textarea name="newCommentDescr"
                                      style="height: 50%; width: 90%; margin-left: 5%"></textarea>
                        </div>
                        <button style="margin-left: 5%; margin-top: 3.5%" name="commentSubmit">Voeg toe</button>
                        @if ($errors->any())
                            <div style="margin-left: 5%" class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session()->has('success'))
                            <div style="margin-left: 5%" class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                    </div>
                </form>
            @endauth
        </div>
    </div>
@stop

@extends('template.template')
@section('styling')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>

        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
            display: block;
            zoom: 0.75;
            -moz-transform: scale(0.65);
        }

        .rate:not(:checked) > input {
            position: absolute;
            top: -9999px;
        }

        .rate:not(input:checked) > label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rate:not(:checked) > label:before {
            content: '★ ';
        }

        .rate > input:checked ~ label {
            color: #ffc700 !important;
        }

        /*.rate > input:checked {*/
        /*    color: #c59b08;*/
        /*}*/

        .rate input:checked > label {
            color: #c59b08;
        }

        th {
            border-bottom: 2px solid black;
            border-left: 2px solid black;
            border-right: 2px solid black;

        }

        td {
            border: 1px solid gray;
            line-height: 40px;
        }


        /* Modified from: https://github.com/mukulkant/Star-rating-using-pure-css */

    </style>
@endsection
@section('content')
    <h4>Dit is de Index Pagina</h4>
    @if(!empty($posts))
        <div style="border: 2px solid black; margin-left: 5%; margin-right: 5%; height: 80%; overflow-y: scroll">
            <table style='width: 100%'>
                <tr>
                    <th style="width: 30%">Titel</th>
                    <th style="width: 30%">Door</th>
                    <th style="width: 10%">Hoeveel comments</th>
                    <th style="width: 15%">Rating</th>
                    <th style="width: 10%">Actie</th>
                </tr>
                @foreach($posts as $post)
                    <tr>
                        <td>{{$post->Title}}</td>
                        <td>{{$post->username}}</td>
                        <td></td>
                        <td>
                            <div style="display: inline; width: 50%; margin-left: 20%; margin-right: 20%" class="rate">
                                <input @if($post->Rating == 5) checked @endif disabled type="radio" id="star5"
                                       name="rating"
                                       value="5"/>
                                <label for="star5" title="text">5 stars</label>
                                <input @if($post->Rating == 4) checked @endif disabled type="radio" id="star4"
                                       name="rating"
                                       value="4"/>
                                <label for="star4" title="text">4 stars</label>
                                <input @if($post->Rating == 3) checked @endif disabled type="radio" id="star3"
                                       name="rating"
                                       value="3"/>
                                <label for="star3" title="text">3 stars</label>
                                <input @if($post->Rating == 2) checked @endif disabled type="radio" id="star2"
                                       name="rating"
                                       value="2"/>
                                <label for="star2" title="text">2 stars</label>
                                <input @if($post->Rating == 1) checked @endif disabled type="radio" id="star1"
                                       name="rating"
                                       value="1"/>
                                <label for="star1" title="text">1 star</label>
                            </div>
                        </td>
                        <td>
                            <div style="width: 100%">
                                    <div style="width: auto; display: inline-block; margin: 0">
                                    <a href="{{route('viewPost',$post->postID)}}">
                                        <button style="width: 100%; height: 40px">Bekijk post</button>
                                    </a>
                                </div>
                                @if(\Illuminate\Support\Facades\Auth::id() === $post->user->id)
                                <div style="width: auto; display: inline-block; margin: 0;">
                                    <a href="{{route('viewEditPost',$post->postID)}}">
                                        <button style="width: 100%; height: 40px">Pas aan</button>
                                    </a>
                                </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endif
@stop

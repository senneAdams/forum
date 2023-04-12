@extends('template.template')
@section('styling')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>

        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
            display: block;
        }

        .rate:not(:checked) > input {
            position: absolute;
            top: -9999px;
        }

        .rate:not(:checked) > label {
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
            color: #ffc700;
        }

        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
            color: #deb217;
        }

        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
            color: #c59b08;
        }

        /* Modified from: https://github.com/mukulkant/Star-rating-using-pure-css */

    </style>
@stop
@section('content')
    <form action="{{route('submitPost')}}" method="post">
        @csrf
        <div class="container">
            <h3>Creëer Post</h3>
            <div style="display: block">
                <label for="postTitle"><b>Post titel:</b></label>
                <input style="display: block" type="text" id="postTitle" placeholder="Enter post titel" name="postTitle" >
            </div>
            <div style="display: block; margin-top: 15px">
                <label for="postDescr"><b>Post Description:</b></label>
                <textarea style="display: block" placeholder="Enter post description" name="postDescription"
                          ></textarea>
            </div>
            <div style="margin-top: 10px" class="rate">
                <input type="radio" id="star5" name="rating" value="5"/>
                <label for="star5" title="text">5 stars</label>
                <input type="radio" id="star4" name="rating" value="4"/>
                <label for="star4" title="text">4 stars</label>
                <input type="radio" id="star3" name="rating" value="3"/>
                <label for="star3" title="text">3 stars</label>
                <input type="radio" id="star2" name="rating" value="2"/>
                <label for="star2" title="text">2 stars</label>
                <input type="radio" id="star1" name="rating" value="1"/>
                <label for="star1" title="text">1 star</label>
            </div>
            <div style="display: block; margin-top: 60px">
                <button style="margin-top: 10px" type="submit">submit</button>
            </div>
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
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
    </form>
@stop

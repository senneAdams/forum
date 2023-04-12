<?php

namespace App\Http\Controllers;

use App\Models\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\post;

class ViewController extends Controller
{
    static function returnView($view)
    {
        return view($view);
    }
}

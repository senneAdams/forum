<?php

namespace App\Http\Controllers;

use App\Models\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public static function submitComment(Request $request, $postID)
    {
        $validate = $request->validate([
            'newCommentDescr' => 'required',
        ]);

        $comment             = new comment;
        $comment->fromPostID = $postID;
        $comment->byUserID   = Auth::id();
        $comment->Title      = 'placeholder';
        $comment->Content    = $validate['newCommentDescr'];
        $comment->Rating     = 5;

        if ($comment->save()) {
            return redirect()->back()->with('success', 'Comment succesvol geplaatst');
        }

        return Redirect::back()->withErrors(['msg' => 'Comment plaatsen fout gegaan']);
    }
}

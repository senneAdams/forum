<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\comment;

class CommentController extends Controller
{
    function getAllComments(){
        return comment::all();
    }

    function getSingleComment($commentID){
        return comment::with( 'user')->where('commentID',$commentID )->get();
    }

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
            return  ['comment successvol aangemaakt'];
        }
        return  ['opslaan mislukt'];
    }

    public function updateComment(Request $request, int $id)
    {
        $comment = comment::find($id);
        $this->authorize('update', $comment);

        $validate = $request->validate([
            'newCommentDescr' => 'required'
        ]);

        $comment->Content = $validate['newCommentDescr'];

        if ($comment->save()) {
            return ['comment aanpassen successvol'];
        }
        return ['aanpassen mislukt'];
    }

    public function deleteComment(Request $request, int $id)
    {
        $comment = comment::find($id);
        $this->authorize('delete', $comment);

        if ($comment->delete()){
            return ['comment successvol verwijderd'];
        }
        return ['comment verwijderen mislukt'];
    }

}

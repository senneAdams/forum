<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\post;

class PostController extends Controller
{
    public function registerPost(Request $request)
    {
        $validate = $request->validate([
            'postTitle'       => 'required',
            'postDescription' => 'required',
        ]);

        $post                  = new post;
        $post->createdByUserID = Auth::id();
        $post->Title           = $validate['postTitle'];
        $post->Content         = $validate['postDescription'];
        $post->Rating          = 5;

        if ($post->save()) {
            return ['post successvol aangemaakt'];
        }

        return ['opslaan mislukt'];
    }

    public function updatePost(Request $request, int $id)
    {
        $post = post::find($id);
        $this->authorize('update', $post);

        $validate = $request->validate([
            'postTitle'       => 'required',
            'postDescription' => 'required',
        ]);

        $post->Title   = $validate['postTitle'];
        $post->Content = $validate['postDescription'];

        if ($post->save()) {
            return ['post aanpassen successvol'];
        }

        return ['aanpassen mislukt'];
    }

    public function deletePost(Request $request, int $id)
    {
        $post = post::find($id);
        $this->authorize('delete', $post);

        if (!empty($post->comments())){
            $post->comments()->delete();
        }
        if ($post->delete()){
            return ['post successvol verwijderd'];
        }
        return ['post verwijderen mislukt'];
    }

    function getAllPosts()
    {
        return post::getPosts();
    }

    function getSinglePost($postID)
    {
        return post::with('comments', 'user')->where('postID', $postID)->get();
    }

}

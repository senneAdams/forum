<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Gate;


class PostController extends Controller
{
    public function registerPost(Request $request)
    {
        $validate = $request->validate([
            'postTitle'       => 'required',
            'postDescription' => 'required',
            'rating'          => 'required|integer|digits_between:1,5',
        ]);

        $post                  = new post;
        $post->createdByUserID = Auth::id();
        $post->Title           = $validate['postTitle'];
        $post->Content         = $validate['postDescription'];
        $post->Rating          = $validate['rating'];

        if ($post->save()) {
            return redirect()->back()->with('success', 'Post successvol opgeslagen');
        }
        return Redirect::back()->withErrors(['msg' => 'Registreren fout gegaan']);
    }

    public function updatePost(Request $request, int $id)
    {
        $post = post::find($id);
        $this->authorize('update', $post);

        $validate = $request->validate([
            'postTitle'       => 'required',
            'postDescription' => 'required',
        ]);

        $post->Title = $validate['postTitle'];
        $post->Content = $validate['postDescription'];


        if ($post->save()) {
            return redirect()->back()->with('success', 'Update successvol');
        }
        return Redirect::back()->withErrors(['msg' => 'Update fout gegaan']);
    }


    static function returnPostView($id)
    {
        $data = post::with('comments', 'user')->where('postID', $id)->get();

        return view('Post')->with('postData', $data);
    }

    static function returnPostIndexView(){
        return view('PostIndex')->with('posts', post::getPosts());
    }

    static function returnPostEditView($id)
    {
        $data = post::with('user')->where('postID', $id)->get();

        return view('PostEdit')->with('postData',$data);
    }

}

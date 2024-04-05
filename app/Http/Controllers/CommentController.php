<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CommentController extends Controller
{
    public function store(Request $request){
        if(Auth::user()){
            Comment::create([
                'post_id' => $request->post_id,
                'user_id' => $request->user()->id,
                'comment' => $request->comment,
            ]);
        }
    }

    public function get($id){
        $post = Comment::find($id);
        return Inertia::render('Posts/Detail',['post'=>$post]);
    }
}

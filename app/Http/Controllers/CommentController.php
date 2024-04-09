<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
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
        $commentsUser = Comment::with('users')->find($id);
        return Inertia::render('Posts/Detail',['commentsUser'=>$commentsUser]);
    }

    public function destroy($id){
        $comment = Comment::find($id);
        $comment -> delete();
//        return redirect()->route('posts.detail');
        //Missing required parameter for [Route: posts.detail] [URI: {id}] [Missing parameter: id]. 에러
        //아래 코드로 해결됨.. post_id값을 넘겨주지 못해서 발생한거로 생각됨.
        return redirect()->route('posts.detail', ['id' => $comment->post_id]);
    }

    public function update(Request $request, $id)
    {
       $comment = Comment::find($id);
       $comment -> update($request->all());

       // Missing required parameter for [Route: posts.detail] [URI: {id}] [Missing parameter: id]. 에러
       $postId = $comment->post_id; //수정된 댓글이 속한 게시글 아이디 가져옴
       return redirect()->route('posts.detail',['id'=>$postId]);
    }

    public function edit($id){

        $comment = Comment::find($id); //id값으로 찾음

        return Inertia::render('Posts/CommentEdit',['comment'=>$comment]);
    }
}

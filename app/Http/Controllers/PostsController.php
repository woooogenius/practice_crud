<?php

namespace App\Http\Controllers;


use App\Models\Post;
//use GuzzleHttp\Psr7\Request; 이거쓰면 아래 에러 뜸
//Unresolvable dependency resolving [Parameter #0 [ <required> string $method ]] in class GuzzleHttp\Psr7\Request
use Inertia\Inertia;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function home()
    {
        $posts = Post::with('user')->get();
        return Inertia::render('Posts/Home',['posts'=>$posts]);
    }

    public function create(){
        return Inertia::render('Posts/Create');
    }

    public function edit($id){

        $post = Post::find($id); //id값으로 찾음

        return Inertia::render('Posts/Edit',['post'=>$post]);
    }

    public function store(Request $request){
        $request->validate([
           'title'=>'required',
           'content'=>'required',
           'board_id'=>'required',
           'user_id' => 'required',

        ]);

        Post::create($request->all());
        return redirect()->route('posts.home');

    }

    public function destroy($postId){
        $post = Post::query()->findOrFail($postId);// id에 해당하는 게시물을 검색
        $post->delete();
        return redirect()->route('posts.home');
    }

    public function update(Request $request, $id){
        $post = Post::find($id); //id에 해당하는 게시물 검색
        $post -> update($request->all()); // 요청으로 받은 데이터를 배열형태로 반환해서 한번에 update 매서드로 업데이트시킴

        return redirect()->route('posts.home');

    }
}

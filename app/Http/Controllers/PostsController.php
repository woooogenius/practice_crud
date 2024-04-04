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

        return Inertia::render('Posts/Home');
    }

    public function create(){
        return Inertia::render('Posts/Create');
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

}

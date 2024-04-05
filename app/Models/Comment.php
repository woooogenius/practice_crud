<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'comment',
    ];

    public function post(){
        return $this->belongsTo(Post::class);
    } //댓글은 게시글에 포함됨

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    } //댓글은 유저에 의해 작성됨
}

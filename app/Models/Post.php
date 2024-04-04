<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'board_id', 'content', 'user_id',
    ];
    protected  $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo(User::class);
        //포스트는 유저에 속한다
    }

}

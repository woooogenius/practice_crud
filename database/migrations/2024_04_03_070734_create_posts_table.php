<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->string('content');
            $table->string('board_id');
            $table->string('image_name') -> nullable();
            $table->string('image_path') -> nullable();
        });

        Schema::table('posts', function (Blueprint $table){
            $table->foreignId('user_id')->references('id')->on('users');
        }); //user_id 칼럼을 외래키로 설정한다 users의 테이블의 id칼럼을 참조하여서
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

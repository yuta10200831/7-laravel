<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookmarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('blog_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['user_id', 'blog_id'], 'user_blog_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookmarks');
    }
}
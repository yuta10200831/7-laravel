<?php

namespace App\UseCase\Blog;

use App\Models\Blog;

final class MyBlogsInteractor
{
    public function handle($userId)
    {
        return Blog::where('user_id', $userId)
                   ->orderBy('created_at', 'desc')
                   ->get();
    }
}
<?php

namespace App\UseCase\Blog;

use App\Models\Blog;

final class MyBlogDetailInteractor
{
    public function handle($blogId)
    {
        return Blog::where('id', $blogId)
                   ->with('comments')
                   ->firstOrFail();
    }
}
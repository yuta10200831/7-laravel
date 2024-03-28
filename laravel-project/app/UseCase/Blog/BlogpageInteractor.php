<?php

namespace App\UseCase\Blog;

use App\Models\Blog;

final class BlogPageInteractor
{
    public function handle($search, $sort)
    {
        $query = Blog::where('is_published', true);

        if (!empty($search)) {
            $query->where(function($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")
                      ->orWhere('contents', 'LIKE', "%{$search}%");
            });
        }

        if ($sort === 'newest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        }

        return $query->with(['comments' => function($query) {
            $query->whereHas('blog', function($query) {
                $query->where('is_published', true);
            });
        }])->get();
    }
}
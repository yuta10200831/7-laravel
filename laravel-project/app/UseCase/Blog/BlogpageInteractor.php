<?php

namespace App\UseCase\Blog;

use App\Models\Blog;
use App\Models\Category;

final class BlogPageInteractor
{
    public function handle($search, $category, $sort)
    {
        $query = Blog::query()->where('is_published', true);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('contents', 'like', "%{$search}%");
            });
        }

        if ($category) {
            $query->where('category_id', $category);
        }

        if ($sort === 'newest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        }

        return $query->with(['category', 'comments'])->paginate(10);
    }
}
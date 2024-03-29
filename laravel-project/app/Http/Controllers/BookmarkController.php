<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function store(Request $request, $blogId)
    {
        $blog = Blog::find($blogId);

        if (!$blog) {
            return back()->with('error', 'ブログが見つかりませんでした。');
        }

        Auth::user()->bookmarks()->toggle($blog->id);

        return back()->with('status', 'ブックマークを更新しました。');
    }
}
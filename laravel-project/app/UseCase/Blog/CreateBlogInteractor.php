<?php

namespace App\UseCase\Blog;

use App\UseCase\Blog\CreateBlogInput;
use App\UseCase\Blog\CreateBlogOutput;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;
use App\Models\ValueObjects\Title;
use App\Models\ValueObjects\Content;
use Illuminate\Support\Facades\Auth;

final class CreateBlogInteractor
{
    public function handle(CreateBlogInput $input): CreateBlogOutput
    {
        $validator = Validator::make($input->all(), [
            'title' => 'required|max:255',
            'contents' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('blogs.create')
                ->withInput()
                ->withErrors($validator);
        }

        $title = new Title($input->getTitle());
        $contents = new Content($input->getContents());
        $userId = Auth::id();

        Blog::create([
            'title' => $title->getValue(),
            'contents' => $contents->getValue(),
            'user_id' => $userId
        ]);

        return new CreateBlogOutput(true, "ブログが投稿されました！");
    }
}
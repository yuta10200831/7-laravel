<?php

namespace App\UseCase\Blog;

use App\Models\Blog;
use Illuminate\Support\Facades\Validator;
use App\Models\ValueObjects\Title;
use App\Models\ValueObjects\Content;

final class EditBlogInteractor
{
    public function handle(EditBlogInput $input): EditBlogOutput
    {
        $validator = Validator::make($input->all(), [
            'title' => 'required|max:255',
            'contents' => 'required',
        ]);

        if ($validator->fails()) {
            return new EditBlogOutput(false, $validator->errors()->first());
        }

        $blog = Blog::find($input->getBlogId());
        if (!$blog) {
            return new EditBlogOutput(false, "ブログが見つかりません。");
        }

        $blog->title = new Title($input->getTitle());
        $blog->contents = new Content($input->getContents());
        $blog->save();

        return new EditBlogOutput(true, "ブログを更新しました。");
    }
}
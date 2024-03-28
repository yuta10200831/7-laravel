<?php

namespace App\UseCase\Blog;

use App\Models\Blog;
use Illuminate\Support\Facades\Validator;

final class EditBlogInteractor
{
    public function handle(EditBlogInput $input): EditBlogOutput
    {
        $validator = Validator::make($input->all(), [
            'title' => 'required|max:255',
            'contents' => 'required',
            'is_published' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return new EditBlogOutput(false, $validator->errors()->first());
        }

        $blog = Blog::find($input->getBlogId());
        if (!$blog) {
            return new EditBlogOutput(false, "ブログが見つかりません。");
        }

        $blog->title = (string)$input->getTitle();
        $blog->contents = (string)$input->getContents();
        $blog->is_published = $input->getIsPublished();

        $blog->save();

        return new EditBlogOutput(true, "ブログを更新しました。");
    }
}
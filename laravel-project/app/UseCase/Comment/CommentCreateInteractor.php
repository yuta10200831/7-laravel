<?php

namespace App\UseCase\Comment;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\UseCase\Comment\CommentCreateInput;
use App\UseCase\Comment\CommentCreateOutput;

class CommentCreateInteractor
{
    public function handle(CommentCreateInput $input): CommentCreateOutput
    {
        $validatedData = [
            'user_id' => Auth::id(),
            'blog_id' => $input->getBlogId(),
            'commenter_name' => Auth::user()->name,
            'comments' => $input->getComment(),
        ];

        $comment = Comment::create($validatedData);

        if ($comment) {
            return new CommentCreateOutput(true, 'コメントを投稿しました！', $input->getBlogId());
        }

        return new CommentCreateOutput(false, 'コメントの投稿に失敗しました。', $input->getBlogId());
    }
}
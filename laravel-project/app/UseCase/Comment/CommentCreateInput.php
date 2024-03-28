<?php

namespace App\UseCase\Comment;

final class CommentCreateInput
{
    private $blogId;
    private $comment;

    public function __construct(string $blogId, string $comment)
    {
        $this->blogId = $blogId;
        $this->comment = $comment;
    }

    public function getBlogId(): string
    {
        return $this->blogId;
    }

    public function getComment(): string
    {
        return $this->comment;
    }
}
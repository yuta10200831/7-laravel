<?php

namespace App\UseCase\Comment;

class CommentCreateOutput
{
    private $success;
    private $message;
    private $blogId;

    public function __construct(bool $success, string $message, string $blogId)
    {
        $this->success = $success;
        $this->message = $message;
        $this->blogId = $blogId;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getBlogId(): string
    {
        return $this->blogId;
    }
}
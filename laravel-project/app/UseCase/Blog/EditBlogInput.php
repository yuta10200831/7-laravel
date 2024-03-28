<?php

namespace App\UseCase\Blog;

use App\Models\ValueObjects\Title;
use App\Models\ValueObjects\Content;

final class EditBlogInput
{
    private $blogId;
    private $title;
    private $contents;

    public function __construct($blogId, string $title, string $contents)
    {
        $this->blogId = $blogId;
        $this->title = $title;
        $this->contents = $contents;
    }

    public function getBlogId()
    {
        return $this->blogId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContents(): string
    {
        return $this->contents;
    }

    public function all(): array
    {
        return [
            'title' => $this->title,
            'contents' => $this->contents
        ];
    }
}
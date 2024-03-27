<?php

namespace App\UseCase\Blog;

use App\Models\ValueObjects\Title;
use App\Models\ValueObjects\Content;

final class CreateBlogInput
{
    private $title;
    private $contents;

    public function __construct(string $title, string $contents)
    {
        $this->title = $title;
        $this->contents = $contents;
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
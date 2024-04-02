<?php

namespace App\UseCase\Blog;

use App\Models\ValueObjects\Title;
use App\Models\ValueObjects\Content;

final class CreateBlogInput
{
    private $title;
    private $contents;
    private $categoryId;

    public function __construct(string $title, string $contents, int $categoryId)
    {
        $this->title = $title;
        $this->contents = $contents;
        $this->categoryId = $categoryId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContents(): string
    {
        return $this->contents;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function all(): array
    {
        return [
            'title' => $this->title,
            'contents' => $this->contents,
            'category_id' => $this->categoryId
        ];
    }

}
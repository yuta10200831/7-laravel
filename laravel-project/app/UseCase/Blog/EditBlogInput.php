<?php

namespace App\UseCase\Blog;

use App\Models\ValueObjects\Title;
use App\Models\ValueObjects\Content;

final class EditBlogInput
{
    private $blogId;
    private $title;
    private $contents;
    private $is_published;

    public function __construct($blogId, Title $title, Content $contents, $is_published)
    {
        $this->blogId = $blogId;
        $this->title = $title;
        $this->contents = $contents;
        $this->is_published = $is_published;
    }

    public function getBlogId()
    {
        return $this->blogId;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContents()
    {
        return $this->contents;
    }

    public function getIsPublished()
    {
        return $this->is_published;
    }

    public function all()
    {
        return [
            'title' => $this->title->getValue(),
            'contents' => $this->contents->getValue(),
            'is_published' => $this->is_published,
        ];
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'contents', 'is_published', 'category_id',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function isFavoritedBy(?User $user)
    {
        if (!$user) {
            return false;
        }

        return $this->favorites()->where('user_id', $user->id)->exists();
    }

    public function bookmarkedBy()
    {
        return $this->belongsToMany(User::class, 'bookmarks');
    }

    public function isBookmarkedBy(User $user)
    {
        return $this->bookmarks()->where('user_id', $user->id)->exists();
    }

    public function bookmarks()
    {
        return $this->belongsToMany(User::class, 'bookmarks')->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
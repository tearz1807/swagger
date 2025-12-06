<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug', 
        'content',
        'image',
        'is_published',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query, bool $status = true)
    {
        return $query->where('is_published', $status);
    }

    public function scopeUnpublished($query)
    {
        return $query->where('is_published', false);
    }
}
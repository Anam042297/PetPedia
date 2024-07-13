<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{ use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
       'post_id', 'url',
        // other fillable fields as needed
    ];

    // Example: If an image can belong to multiple posts
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}

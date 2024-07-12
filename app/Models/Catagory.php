<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catagory extends Model
{
    protected $fillable = [
        'name',
        // other fillable fields as needed
    ];

    // Example: If a category can have multiple posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}

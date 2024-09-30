<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{ use HasFactory;
    protected $fillable = ['name'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function breeds()
    {
        return $this->hasMany(Breed::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    use HasFactory;
    protected $fillable = ['name' , 'category_id'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}

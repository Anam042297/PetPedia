<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'pet_name',
        'age',
        'description',
        'user_id',
        'category_id',
        'breed_id',
        'image_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function breed()
    {
        return $this->belongsTo(Breed::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}

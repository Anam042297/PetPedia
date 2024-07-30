<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{ use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id', 'catagory_id', 'breed_id', 'name', 'age', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function catagory()
    {
        return $this->belongsTo(Catagory::class);
    }

    public function breed()
    {
        return $this->belongsTo(Breed::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}

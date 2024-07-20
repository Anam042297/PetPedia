<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    use HasFactory;
    protected $fillable = ['name' , 'catagory_id'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function catagory()
    {
        return $this->belongsTo(Catagory::class);
    }
}

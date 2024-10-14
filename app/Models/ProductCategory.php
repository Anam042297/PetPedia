<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productcategory extends Model
{
    use HasFactory;

    // The table associated with the model (optional if Laravel naming conventions are followed)
    protected $table = 'product_categories';

    // The attributes that are mass assignable
    protected $fillable = ['name','icon'];

    // Relationship: A category can have many products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

   

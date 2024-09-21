<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
 
        // The table associated with the model (optional if Laravel naming conventions are followed)
        protected $table = 'product_images';

        // The attributes that are mass assignable
        protected $fillable = ['product_id', 'image_path'];
    
        // Relationship: An image belongs to a product
        public function product()
        {
            return $this->belongsTo(Product::class);
        }
}


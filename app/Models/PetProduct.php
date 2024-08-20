<?php

namespace App\Models;
use Illuminate\Support\Str; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetProduct extends Model
{
    use HasFactory;

    // The table associated with the model (optional if Laravel naming conventions are followed)
    protected $table = 'pet_products';

    // The attributes that are mass assignable
    protected $fillable = [ 'serial_number', 'user_id','name', 'type', 'price', 'pet_category_id','weight','company','quantity',];

    // The attributes that should be cast to native types
    protected $casts = [
        'type' => 'string',
        'price' => 'decimal:2',
        'weight' => 'decimal:2',
        'quantity' => 'integer',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Relationship: A product belongs to a category
    public function Category()
    {
        return $this->belongsTo(PetCategory::class, 'pet_category_id');
    }

    // Relationship: A product can have many images
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    protected static function booted()
    {
        static::creating(function ($Product) {
            $Product->serial_number = Str::random(10); // Generate a 10-character random string
        });
    }
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}


 

   

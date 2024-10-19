<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // The table associated with the model (optional if Laravel naming conventions are followed)
    protected $table = 'products';
    //  The attributes that are mass assignable
    protected $fillable = [
        'serial_number',
        'user_id',
        'name',
        'category_id',
        'price',
        'product_category_id',
        'weight',
        'brand',
        'stock',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // Relationship: A product belongs to a category
    public function ProductCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    // Relationship: A product can have many images
    public function productimages()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    protected static function booted()
    {
        static::creating(function ($Product) {
            $Product->serial_number = Str::random(10); // Generate a 10-character random string
        });
    }
    public function Items()
    {
        return $this->hasMany(CartItem::class);
    }
}

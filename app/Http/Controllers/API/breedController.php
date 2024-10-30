<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Breed;
use App\Models\Post;
use Illuminate\Http\Request;

class breedController extends Controller
{
   

public function getBreedsByCategory($categoryId)
{
    $breeds = Breed::where('category_id', $categoryId)->get(['id', 'name']);

    return response()->json([
        'success' => true,
        'data' => $breeds
    ]);
}
public function getPostsByBreed($breedId)
{
    $posts = Post::with(['category', 'breed', 'images', 'user'])
                 ->where('breed_id', $breedId)
                 ->get();

    $formattedPosts = $posts->map(function ($post) {
        return [
            'id' => $post->id,
            'category' => $post->category->name,
            'breed' => $post->breed->name,
            'gender' => $post->gender,
            'name' => $post->name,
            'age' => $post->age,
            'description' => $post->description,
            'images' => $post->images->pluck('url'),
        ];
    });

    return response()->json([
        'success' => true,
        'data' => $formattedPosts
    ]);
}


}

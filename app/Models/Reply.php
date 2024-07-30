<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reply extends Model
{
    use SoftDeletes;

    protected $fillable = ['post_id', 'user_id', 'message'];

    public function communitypost()
    {
        return $this->belongsTo(CommunityPost::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}

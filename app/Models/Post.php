<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopePostFilter($query)
    {
        $query->when(
            request('title'),
            fn ($query) => $query->where('title', request('title'))
        );
    }

}

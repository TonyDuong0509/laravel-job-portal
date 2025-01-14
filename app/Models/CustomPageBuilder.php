<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPageBuilder extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['page_name', 'slug', 'content'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'page_name'
            ]
        ];
    }
}

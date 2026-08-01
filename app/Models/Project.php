<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'year',
        'start_date',
        'end_date',
        'title',
        'made_at',
        'url',
        'link_label',
        'description',
        'tags',
        'image_path',
        'show_on_home',
        'sort_order',
    ];

    protected $casts = [
        'tags'         => 'array',
        'show_on_home' => 'boolean',
    ];
}

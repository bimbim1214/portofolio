<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'date_range',
        'start_date',
        'end_date',
        'title',
        'company',
        'company_url',
        'description',
        'tags',
        'sort_order',
    ];

    protected $casts = [
        'tags' => 'array',
    ];
}

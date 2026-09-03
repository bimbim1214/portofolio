<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $fillable = [
        'title',
        'issuer',
        'issuer_full',
        'icon',
        'credential_id',
        'credential_url',
        'issued_date',
        'expiry_date',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'issued_date' => 'date',
        'expiry_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function getImageUrlAttribute()
    {
        $path = 'images/certificates/'.strtoupper(str_replace(' ', '_', $this->title)).'.jpg';

        return file_exists(public_path($path)) ? $path : null;
    }
}

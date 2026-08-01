<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name',
        'headline',
        'about_1',
        'about_2',
        'about_3',
        'short_bio',
        'photo_path',
        'cv_path',
        'github_url',
        'linkedin_url',
        'email',
        'whatsapp',
    ];
}

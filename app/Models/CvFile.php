<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CvFile extends Model
{
    protected $fillable = [
        'file_path',
        'original_name',
        'file_size',
    ];

    /**
     * Ambil satu-satunya record CV yang ada (selalu max 1 baris).
     */
    public static function getCurrent(): ?self
    {
        return self::latest()->first();
    }

    /**
     * Ukuran file dalam format human-readable (KB / MB).
     */
    public function getFileSizeFormattedAttribute(): string
    {
        if (! $this->file_size) {
            return '—';
        }

        if ($this->file_size >= 1048576) {
            return number_format($this->file_size / 1048576, 2).' MB';
        }

        return number_format($this->file_size / 1024, 1).' KB';
    }
}

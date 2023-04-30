<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_description',
        'photo_path',
        'photo_name',
        'author_id',
        'journal_release_date',
    ];

    protected $appends = [
        'photo_url',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partnership extends Model
{
    protected $fillable = [
    'title',
    'short_description',
    'points',
    'details_description',
    'button_text',
    'button_link',
    'image',
    'status'
];
protected $casts = [
    'points' => 'array',
];
}
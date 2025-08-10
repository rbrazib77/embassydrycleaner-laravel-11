<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerSection extends Model
{
    protected $fillable = [
    'title',
    'subtitle',
    'button_text',
    'button_url',
    'image',
    'status',
    'order',
];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
     protected $fillable = [
    'title',
    'short_description',
    'details_description',
    'button_text',
    'button_link',
    'image',
    'status'
];
}

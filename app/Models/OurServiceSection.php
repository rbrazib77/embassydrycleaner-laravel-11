<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurServiceSection extends Model
{
    protected $fillable = [
        'title',
        'icon',
        'description',
        'order',
        'status',
    ];
}

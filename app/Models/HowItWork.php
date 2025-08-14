<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HowItWork extends Model
{
   protected $fillable = [
        'title',
        'description',
        'icon',
        'status',
        'order',
    ];
}

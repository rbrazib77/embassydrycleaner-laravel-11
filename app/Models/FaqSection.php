<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqSection extends Model
{
      protected $fillable = [
        'heading',
        'image',
        'status'
    ];
}

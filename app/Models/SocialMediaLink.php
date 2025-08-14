<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialMediaLink extends Model
{
     protected $fillable = ['platform', 'icon_class', 'url', 'status','order'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserActivityLog extends Model
{
   protected $fillable = [
        'user_id',
        'ip_address',
        'url',
        'user_agent',
        'browser',
        'browser_version',
        'platform',
        'platform_version',
        'device',
        'country',
        'visit_count',
        'last_activity',
        'accessed_at'
    ];
     public $timestamps = true; // created_at, updated_at auto save হবে
}

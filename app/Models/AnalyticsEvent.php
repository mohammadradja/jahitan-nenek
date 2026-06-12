<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnalyticsEvent extends Model
{
    protected $fillable = [
        'event_type',
        'path',
        'target',
        'ip_address',
        'user_agent',
    ];
}

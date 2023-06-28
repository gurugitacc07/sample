<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'number_of_tasks',
        'anual_time',
        'daily_service_date',
        'weekly_service_date',
        'monthly_service_date',
        'daily_total_timing',
        'weekly_total_timing',
        'monthly_total_timing'
    ];
}

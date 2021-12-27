<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crm extends Model
{
    use HasFactory;
     protected $fillable = [
        'customer',
        'status',
        'assigned_to',
        'sla',
        'remarks',
        'issue',
        'dead_line',
    ];
}

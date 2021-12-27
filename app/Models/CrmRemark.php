<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmRemark extends Model
{
    use HasFactory;
     protected $fillable = [
        'crm_id',
        'user_id',
        'details',
    ];
}

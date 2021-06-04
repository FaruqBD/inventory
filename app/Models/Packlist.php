<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packlist extends Model
{
    use HasFactory;
    protected $fillable =  [

        'product_id', 'godown', 'available_qty', 'required_qty'

    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;
    protected $fillable =  [ 'shipment_type_id', 'courier_id', 'tracking_number','remarks', 'vehicle', 'executive'];
}

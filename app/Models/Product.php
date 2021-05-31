<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Godown;

class Product extends Model
{
    use HasFactory;
    protected $fillable =  [

        'product_name_id', 'quantity', 'godown_id', 'category_id', 'remarks'

    ];

    public function Godown()
    {
       
        return $this->belongsTo('App\Models\Godown');
    }
}

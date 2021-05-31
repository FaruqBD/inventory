<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Godown extends Model
{
   
    protected $fillable =  [ 'name'];

     public function Product()
    {
        return $this->hasMany('App\Models\Product');
    }
}

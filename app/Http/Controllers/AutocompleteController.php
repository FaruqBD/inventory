<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AutocompleteController extends Controller
{
   public function products(Request $request){
    if($request->get('query'))
     {
      $query = $request->get('query');
      $data = DB::table('product_names')
        ->join('products', 'product_names.id',"=", "products.product_name_id")
        ->where('product_names.name', 'LIKE', "%{$query}%")
        ->get();
        // ->unique('product_names.id');
      $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      foreach($data as $row)
      {
       $output .= '
       <li data-id="'.$row->id.'""><a href="#">'.$row->name.'</a></li>
       ';
      }
      $output .= '</ul>';
      echo $output;
     }
   }

   public function product_name(Request $request){
    if($request->get('query'))
     {
      $query = $request->get('query');
      $data = DB::table('product_names')
        ->where('product_names.name', 'LIKE', "%{$query}%")
        ->get();
        // ->unique('product_names.id');
      $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      foreach($data as $row)
      {
       $output .= '
       <li data-id="'.$row->id.'""><a href="#">'.$row->name.'</a></li>
       ';
      }
      $output .= '</ul>';
      echo $output;
     }
   }
  
}

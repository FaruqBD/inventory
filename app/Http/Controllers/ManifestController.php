<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courier;
use App\Rules\ExcelRule;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ManifestExport;

class ManifestController extends Controller
{
    public function index()
    {
        $couriers = Courier::latest()->get();
        return view('pages.manifest', compact('couriers'));
       
   
    }
    public function manifest_courier_name($id){
        $courier = Courier::latest()->get();
        $output = '';
        if(!$courier->isEmpty()){
            
            foreach ($courier as $brand){
                $courier_id = $brand->id;
                $courier_name = $brand->name;
                 if($id === 0)
                {
                     $output .= '<option value="'.$courier_id.'">'.$courier_name.'</option>';
                }else{
        
                $output .= '<option value="'.$courier_id.'" '.(($courier_id == $id) ? 'selected="selected"':"").'>'.$courier_name.'</option>';
                }
            }
            
        }

        return $output;
    }


   public function store(Request $request)
    {
         $courier = Courier::findOrFail($request->courier_id);
        return Excel::download(new ManifestExport($request->manifestDate, $request->courier_id), 'Manifests-'.$courier->name.'-'.$request->manifestDate.'.xlsx');
    }  
}

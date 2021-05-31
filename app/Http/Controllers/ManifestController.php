<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courier;

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


    public function fileImportExport()
    {
       return view('pages.tracking_number_import');
    }
   
    
    public function fileImport(Request $request) 
    {

       $validator = $request->validate([
        'file' => ['required', new ExcelRule($request->file('file'))],
        ]);
       
             Excel::import(new TrackingNumber, $request->file('file')->store('temp'));
        return view('pages.shipments');

       
    }
}

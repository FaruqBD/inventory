<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\ShipmentType;
use App\Models\Courier;
use Illuminate\Http\Request;
use DataTables;
use App\Rules\ExcelRule;
use App\Models\TrackingNumber;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
class ShipmentController extends Controller
{
     public function index(Request $request)
    {
         
        if ($request->ajax()) {
            //$data = Shipment::latest()->get();
             $data = DB::table('shipments')
                    ->join('shipment_types', 'shipments.shipment_type_id', '=', 'shipment_types.id' )
                    ->join('couriers', 'shipments.courier_id', '=', 'couriers.id' )
                    ->get(array('shipments.id as id', 'shipments.tracking_number as tracking_number','shipment_types.name as shipment_type_id', 'couriers.name as courier_id', 'shipments.remarks as remarks' ));
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editShipment">Edit</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteShipment">Delete</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('pages.shipments');
    }

    
    public function store(Request $request)
    {
        $request->validate([
                          
             'name' => 'required|unique:shipments',
            ], [
            'name.required' => 'Shipment name is required',
        ]);    
        
        Shipment::updateOrCreate(['id' => $request->id],
                ['shipment_type_id' => $request->shipment_type_id,'courier_id' => $request->courier_id, 'tracking_number' => $request->tracking_number, 'remarks' => $request->remarks ]);        

        return response()->json(['success'=>'Shipment saved successfully!']);
    }
   
    public function edit($id)
    {
        $Shipment = Shipment::find($id);
        return response()->json($Shipment);
    }

    
    public function destroy($id)
    {
        Shipment::find($id)->delete();

        return response()->json(['success'=>'Shipment deleted!']);
    }

     public function shipment_type($id){
        $shipment_type = ShipmentType::latest()->get();
        $output = '';
        if(!$shipment_type->isEmpty()){
            
            foreach ($shipment_type as $brand){
                $shipment_type_id = $brand->id;
                $shipment_type_name = $brand->name;
                if($id === 0)
                {
                     $output .= '<option value="'.$shipment_type_id.'">'.$shipment_type_name.'</option>';
                }else{
        
                $output .= '<option value="'.$shipment_type_id.'" '.(($shipment_type_id == $id) ? 'selected="selected"':"").'>'.$shipment_type_name.'</option>';
                }
            }
            
        }

        return $output;
    }
   
    public function courier_name($id){
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

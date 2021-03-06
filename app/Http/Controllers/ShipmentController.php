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
Use Alert;
class ShipmentController extends Controller
{

     public function index(Request $request)
    {
         
        if ($request->ajax()) {
            //$data = Shipment::latest()->get();
             $data = DB::table('shipments')
                    ->join('shipment_types', 'shipments.shipment_type_id', '=', 'shipment_types.id' )
                    ->join('couriers', 'shipments.courier_id', '=', 'couriers.id' )
                    ->orderBy('shipments.id', 'desc')
                    ->get(array('shipments.id as id', 'shipments.tracking_number as tracking_number','shipment_types.name as shipment_type_id', 'couriers.name as courier_id','shipments.created_at as shipment_create_date', 'shipments.remarks as remarks' ));
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
        
        $shipment_types = ShipmentType::latest()->get();

        $couriers = Courier::latest()->get();

        // dd($shipment_types[1]->name);

        return view('pages.shipments', compact('shipment_types', 'couriers'));
    }

    
    public function store(Request $request)
    {
        // dd($request->shipment_id);
        $request->validate([
                          
             'tracking_number' => 'required|unique:shipments',
            ], [
            'tracking_number.required' => 'Tracking Number is required.',
            'tracking_number.unique' => 'Tracking Number already exist!',
        ]);    
        
        Shipment::updateOrCreate(['id' => $request->shipment_id],
                ['shipment_type_id' => $request->shipment_type_id,'courier_id' => $request->courier_id, 'tracking_number' => $request->tracking_number, 'vehicle' => $request->vehicle, 'executive' => $request->executive, 'menifest_id'=> $request->menifest_id, 'remarks' => $request->remarks ]); 

    Alert::success('Success Title', 'Success Message');
        return back()->withInput()->with('success', 'Saved successfully6');
    }




    public function menifest_store(Request $request)
    {
        $request->validate([
                          
             'tracking_number' => 'required|unique:shipments',
            ], [
            'tracking_number.required' => 'Tracking Number is required.',
            'tracking_number.unique' => 'Tracking Number already exist!',
        ]);    
        
        Shipment::updateOrCreate(['id' => $request->id],
                ['shipment_type_id' => $request->shipment_type_id,'courier_id' => $request->courier_id, 'tracking_number' => $request->tracking_number, 'remarks' => $request->remarks ]); 

    Alert::success('Success Title', 'Success Message');
        return back()->withInput()->with('success', 'Saved successfully');
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

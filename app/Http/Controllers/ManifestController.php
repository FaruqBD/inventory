<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courier;
use App\Rules\ExcelRule;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ManifestExport;
use App\Models\Shipment;
use App\Models\ShipmentType;
use App\Models\Menifest;
use DataTables;
use App\Models\TrackingNumber;
Use Alert;

class ManifestController extends Controller
{
    public function index()
    {
        $couriers = Courier::latest()->get();
        return view('pages.manifest', compact('couriers'));
       
   
    }

    public function all_menifests(Request $request)
    {
         if ($request->ajax()) {
            //$data = Shipment::latest()->get();
             $data = DB::table('menifests')
                    ->orderBy('id', 'desc')
                    ->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-success btn-sm exportMenifest">Export</a>';
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-default btn-sm viewMenifest">view</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-info btn-sm editMenifest">Edit</a>';

                            $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteShipment">Delete</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('pages.all_menifest');
       
        
    }

     public function store_menifest(Request $request)
    {

        // dd($request);
        $request->validate([
                          
             'name' => 'required|unique:menifests',
            ], [
            'name.unique' => 'This name is already exist',
            'name.required' => 'Menifest name is required',
        ]);  
        $menifest = Menifest::updateOrCreate(['id' => $request->id],
                ['name' => $request->name ]);   


         if ($request->ajax()) {
            //$data = Shipment::latest()->get();
             $data = DB::table('shipments')
                    ->join('shipment_types', 'shipments.shipment_type_id', '=', 'shipment_types.id' )
                    ->join('couriers', 'shipments.courier_id', '=', 'couriers.id' )
                    ->orderBy('shipments.id', 'desc')
                    ->get(array('shipments.id as id', 'shipments.tracking_number as tracking_number','shipment_types.name as shipment_type_id', 'couriers.name as courier_id','shipments.created_at as shipment_create_date', 'shipments.vehicle as vehicle','shipments.executive as executive' ));
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

        return view('pages.create_menifest', compact('menifest','shipment_types','couriers'));
    }

    public function create_menifest(Request $request)
    {
        
        if ($request->ajax()) {
            //$data = Shipment::latest()->get();
             $data = DB::table('shipments')
                    ->join('shipment_types', 'shipments.shipment_type_id', '=', 'shipment_types.id' )
                    ->join('couriers', 'shipments.courier_id', '=', 'couriers.id' )
                    ->orderBy('shipments.id', 'desc')
                    ->get(array('shipments.id as id', 'shipments.tracking_number as tracking_number','shipment_types.name as shipment_type_id', 'couriers.name as courier_id','shipments.created_at as shipment_create_date', 'shipments.vehicle as vehicle','shipments.executive as executive' ));
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
        return view('pages.create_menifest', compact('shipment_types','couriers'));
       
   
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
        return Excel::download(new ManifestExport($request->manifestDate_from, $request->manifestDate_to, $request->courier_id), 'Manifests-'.$courier->name.'-'.$request->manifestDate_from.' to '.$request->manifestDate_from.'.xlsx');
    }  
}

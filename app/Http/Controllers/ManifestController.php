<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courier;
use App\Rules\ExcelRule;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ManifestExport;
use App\Exports\PrintMenifestExport;
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

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Print" class="edit btn btn-success btn-sm exportMenifest">Print</a>';
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="View Menifest List" class="btn btn-default btn-sm viewMenifest">View List</a>';

                           // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-info btn-sm editMenifest">Edit</a>';

                            $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteMenifest">Delete</a>';

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

        
        $shipment_types = ShipmentType::latest()->get();

        $couriers = Courier::latest()->get();  
        return redirect()->route('view-menifest-list', ['id' => $menifest->id]);

        // return view('pages.create_menifest', compact('menifest', 'data', 'shipment_types','couriers'));
    }

    

    public function delete_menifest($id)
    {
         Shipment::where('menifest_id', '=', $id)->delete();
         Menifest::find($id)->delete();
         return redirect()->back();

    }

    public function view_menifest_list($id)
    {
        
            $menifest = Menifest::find($id);   
            
            $data = DB::table('shipments')
                    ->join('shipment_types', 'shipments.shipment_type_id', '=', 'shipment_types.id' )
                    ->join('couriers', 'shipments.courier_id', '=', 'couriers.id' )
                    ->where('shipments.menifest_id', '=', $id)
                    ->orderBy('shipments.id', 'desc')
                    ->get(array('shipments.id as id', 'shipments.tracking_number as tracking_number','shipment_types.name as shipment_type_id', 'couriers.name as courier_id','shipments.created_at as shipment_create_date', 'shipments.vehicle as vehicle','shipments.executive as executive' ));
// dd($menifest);
            $shipment_types = ShipmentType::latest()->get();

            $couriers = Courier::latest()->get(); 
            return view('pages.create_menifest', compact('menifest', 'data', 'shipment_types','couriers'));
    }

    public function update_menifest_list(Request $request)
    {
        
        Shipment::updateOrCreate(['id' => $request->shipment_id],
                ['shipment_type_id' => $request->shipment_type_id,'courier_id' => $request->courier_id, 'tracking_number' => $request->tracking_number, 'vehicle' => $request->vehicle, 'executive' => $request->executive, 'menifest_id'=> $request->menifest_id, 'remarks' => $request->remarks ]); 

        Alert::success('Success Title', 'Success Message');
         return redirect()->back();
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


    public function edit($id)
    {
        $Shipment = Shipment::find($id);
        return response()->json($Shipment);
    }


   public function store(Request $request)
    {

         $courier = Courier::findOrFail($request->courier_id);
        return Excel::download(new ManifestExport($request->manifestDate_from, $request->manifestDate_to, $request->courier_id), 'Manifests-'.$courier->name.'-'.$request->manifestDate_from.' to '.$request->manifestDate_from.'.xlsx');
    }  

    public function delete_menifest_list($id)
    {
        Shipment::find($id)->delete();

        return redirect()->back();
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


public function menifest_export($id)
    {
        $menifest = Menifest::find($id);   

        $date = date('Y-m-d');
        return Excel::download(new PrintMenifestExport($id), $menifest->name.' list-'. $date .'.xlsx');
    }   











    
}

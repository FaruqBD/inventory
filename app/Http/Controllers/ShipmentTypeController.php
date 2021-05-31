<?php

namespace App\Http\Controllers;

use App\Models\ShipmentType;
use Illuminate\Http\Request;
use DataTables;
class ShipmentTypeController extends Controller
{
     public function index(Request $request)
    {


        if ($request->ajax()) {
            $data = ShipmentType::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editShipmentType">Edit</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteShipmentType">Delete</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('pages.shipment_types');
    }

    
    public function store(Request $request)
    {

             $request->validate([
                          
                             'name' => 'required|unique:shipment_types',
                            ], [
                            'name.required' => 'Shipment Type is required',
                        ]);        
        ShipmentType::updateOrCreate(['id' => $request->id],
                ['name' => $request->name ]);        

        return response()->json(['success'=>'ShipmentType saved successfully!']);
    }
   
    public function edit($id)
    {
        $ShipmentType = ShipmentType::find($id);
        return response()->json($ShipmentType);
    }

    
    public function destroy($id)
    {
        ShipmentType::find($id)->delete();

        return response()->json(['success'=>'ShipmentType deleted!']);
    }
}

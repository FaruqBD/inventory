<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use Illuminate\Http\Request;
use DataTables;

class CourierController extends Controller
{
    
    public function index(Request $request)
    {


        if ($request->ajax()) {
            $data = Courier::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editCourier">Edit</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCourier">Delete</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('pages.couriers');
    }

    
    public function store(Request $request)
    {
        $request->validate([
                          
             'name' => 'required|unique:couriers',
            ], [
            'name.required' => 'Courier name is required',
        ]);  
        Courier::updateOrCreate(['id' => $request->id],
                ['name' => $request->name ]);        

        return response()->json(['success'=>'Courier saved successfully!']);
    }
   
    public function edit($id)
    {
        $Courier = Courier::find($id);
        return response()->json($Courier);
    }

    
    public function destroy($id)
    {
        Courier::find($id)->delete();

        return response()->json(['success'=>'Courier deleted!']);
    }
}
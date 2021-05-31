<?php

namespace App\Http\Controllers;

use App\Models\Godown;
use Illuminate\Http\Request;
use DataTables;
class GodownController extends Controller
{
     public function index(Request $request)
    {


        if ($request->ajax()) {
            $data = Godown::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editGodown">Edit</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteGodown">Delete</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('pages.godowns');
    }

    
    public function store(Request $request)
    {
        $request->validate([
                          
             'name' => 'required|unique:godowns',
            ], [
            'name.required' => 'Godown name is required',
        ]);  
        Godown::updateOrCreate(['id' => $request->id],
                ['name' => $request->name ]);        

        return response()->json(['success'=>'Godown saved successfully!']);
    }
   
    public function edit($id)
    {
        $Godown = Godown::find($id);
        return response()->json($Godown);
    }

    
    public function destroy($id)
    {
        Godown::find($id)->delete();

        return response()->json(['success'=>'Godown deleted!']);
    }
}

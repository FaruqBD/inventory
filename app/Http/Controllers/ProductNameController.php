<?php

namespace App\Http\Controllers;

use App\Models\ProductName;
use Illuminate\Http\Request;
use DataTables;
class ProductNameController extends Controller
{
     public function index(Request $request)
    {


        if ($request->ajax()) {
            $data = ProductName::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProductName">Edit</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProductName">Delete</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('pages.product_names');
    }

    
    public function store(Request $request)
    {
        $validator = $request->validate([
                          
            'name' => 'required|unique:product_names',
            ], [
            'name.required' => 'Product name is required',
        ]);  
        
        ProductName::updateOrCreate(['id' => $request->id],
                ['name' => $request->name ]);        

        return response()->json(['success'=>'Product Name saved successfully!']);
    }
   
    public function edit($id)
    {
        $ProductName = ProductName::find($id);
        return response()->json($ProductName);
    }

    
    public function destroy($id)
    {
        ProductName::find($id)->delete();

        return response()->json(['success'=>'Product Name deleted!']);
    }
}

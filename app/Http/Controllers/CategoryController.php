<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;
class CategoryController extends Controller
{
     public function index(Request $request)
    {


        if ($request->ajax()) {
            $data = Category::latest()->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-success btn-sm editCategory">Edit</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCategory">Delete</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('pages.categories');
    }

    
    public function store(Request $request)
    {
        $request->validate([
                          
             'name' => 'required|unique:categories',
            ], [
            'name.required' => 'Category name is required',
        ]);  
        Category::updateOrCreate(['id' => $request->id],
                ['name' => $request->name ]);        

        return response()->json(['success'=>'Category saved successfully!']);
    }
   
    public function edit($id)
    {
        
        $Category = Category::find($id);
        return response()->json($Category);
    }

    
    public function destroy($id)
    {
        Category::find($id)->delete();
        // return response()->session()->flash('success', 'Category deleted!');
        

        return response()->json(['success'=>'Category deleted!']);
    }
}

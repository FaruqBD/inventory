<?php

namespace App\Http\Controllers;

use App\Models\ProductName;
use App\Models\Product;
use App\Models\Category;
use App\Models\Godown;
use App\Rules\ExcelRule;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;
use App\Exports\ProductExport;


class ProductController extends Controller
{
    
    public function index(Request $request)
    {


        if ($request->ajax()) {

                   
                     $data = DB::table('products')
                            ->join('product_names', 'products.product_name_id', '=', 'product_names.id' )
                            ->join('categories', 'products.category_id', '=', 'categories.id' )
                            ->join('godowns', 'products.godown_id', '=', 'godowns.id' )
                            ->orderBy('products.created_at', 'desc')
                            ->get(array('products.id as id', 'product_names.name as product_name_id', 'products.quantity as quantity', 'categories.name as category_id', 'godowns.name as godown_id', 'products.remarks as remarks' ));


                   
                    return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($row){

                                   $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                                   $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                                    return $btn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
                }

      


        return view('pages.products');
    }

    
    public function store(Request $request)
    {

       // dd($request);
        $product = Product::where('product_name_id', '=', $request->product_name_id)
                            ->Where('godown_id', '=', $request->godown_id)
                            ->first();

        if($product){
             $id = $product->id;
             $quantity = $product->quantity + $request->quantity;
           
        }
        else{
            $id = $request->id;
            $quantity = $request->quantity;
        }
        Product::updateOrCreate(['id' => $id],
                ['product_name_id' => $request->product_name_id, 'quantity' => $quantity,'category_id' => $request->category_id, 'godown_id' => $request->godown_id, 'remarks' => $request->remarks]);        

        return response()->json(['success'=>'Product saved successfully!']);
    }
     public function update(Request $request)
    {

        $request->validate([
              
                'product_name_id' => 'required',
                'quantity' => 'required',
                'godown_id' => 'required',
                'category_id' => 'nullable',
                'remarks' => 'nullable'
                ], [
                'product_name_id.required' => 'Product name is required',
                'quantity.required' => 'Product quantity is required',
                'godown_id.required' => 'Select godown name',
            ]);
        $product = Product::where('product_name_id', '=', $request->product_name_id)
                            ->Where('godown_id', '=', $request->godown_id)
                            ->first();

       
        Product::updateOrCreate(['id' => $id],
                ['product_name_id' => $request->product_name_id, 'quantity' => $quantity,'category_id' => $request->category_id, 'godown_id' => $request->godown_id, 'remarks' => $request->remarks]);        

        return response()->json(['success'=>'Product saved successfully!']);
    }

   public function edit($id)
    {
        $Product = Product::find($id);
        return response()->json($Product);
    }

    
    public function destroy($id)
    {
        Product::find($id)->delete();

        return response()->json(['success'=>'Product deleted!']);
    }
    public function product_name($id){
        $product_name = ProductName::findOrFail($id);
        $output = $product_name->name;

        return $output;
    }

    public function product_category($id){
        $category = Category::latest()->get();
        $output = '';
        if(!$category->isEmpty()){
            
            foreach ($category as $brand){
                $category_id = $brand->id;
                $category_name = $brand->name;
                if($id === 0)
                {
                     $output .= '<option value="'.$category_id.'">'.$category_name.'</option>';
                }else{
        
                $output .= '<option value="'.$category_id.'" '.(($category_id == $id) ? 'selected="selected"':"").'>'.$category_name.'</option>';
                }
            }
            
        }

        return $output;
    }
   
    public function product_godown($id){
        $godown = Godown::latest()->get();
        $output = '';
        if(!$godown->isEmpty()){
            
            foreach ($godown as $brand){
                $godown_id = $brand->id;
                $godown_name = $brand->name;
                 if($id === 0)
                {
                     $output .= '<option value="'.$godown_id.'">'.$godown_name.'</option>';
                }else{
        
                $output .= '<option value="'.$godown_id.'" '.(($godown_id == $id) ? 'selected="selected"':"").'>'.$godown_name.'</option>';
                }
            }
            
        }

        return $output;
    }
    public function table_category($id){
       $category = Category::where('id', '=', $id)->first();
      
        $output = '';
        if($category){
           
                $output = $category->name;
          
        }

        return $output;
    }



    public function fileImportExport()
    {
       return view('pages.file-import-export');
    }
   
    
    public function fileImport(Request $request) 
    {

        $validator = $request->validate([
        'file' => ['required', new ExcelRule($request->file('file'))],
        ]);
        
        Excel::import(new ProductImport, $request->file('file')->store('temp'));
        return view('pages.products');
        

       
    }

    public function fileExport() 
    {
        $date = date('Y-m-d');
        return Excel::download(new ProductExport, 'Products-'. $date .'.xlsx');
    }    

    public function single_product_outward()
    {
       return view('pages.single_product_outward'); 
    }
}

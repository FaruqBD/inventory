<?php

namespace App\Http\Controllers;
use App\Models\ProductName;
use App\Models\Packlist;
use App\Models\Category;
use App\Models\Product;
use App\Models\Godown;
use App\Models\SinglePacklist;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;
use App\Exports\PacklistExport;
use Redirect,Response;
use SweetAlert;
use PDF;

class PackListController extends Controller
{
    public function index(Request $request)
    {
        // $data = DB::table('packlists')
        //             ->join('products', 'packlists.product_name', '=', 'products.id' )
        //             ->join('product_names', 'products.product_name_id', '=', 'product_names.id' )
        //             ->orderBy('packlists.id', 'desc') 
        //             ->get();     

         
        //             dd($data);
            

        if ($request->ajax()) {

           $data = DB::table('packlists')
                    ->join('products', 'packlists.product_id', '=', 'products.id' )
                    ->join('product_names', 'products.product_name_id', '=', 'product_names.id' )
                    ->orderBy('packlists.id', 'desc') 
                    // ->get();                           
                    ->get(['packlists.id as id','products.product_name_id as product_name_id','godown_id','product_id','packlists.godown as godown','packlists.available_qty as available_qty','packlists.required_qty as required_qty','product_names.name as name']);

            
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary d-none btn-sm editPackList">Edit</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletePackList">Delete</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        $product_names = DB::table('products')
                            ->join('product_names', 'products.product_name_id', '=', 'product_names.id' )
                            // ->join('packlists', 'product_names.name', '!=', 'packlists.product_name' )
                            ->orderBy('product_names.name', 'asc')                            
                            ->get()->unique('name');
                            // dd($product_names);
               

        $godowns = Godown::latest()->get();
         // dd($godowns);
        return view('pages.packlist',compact('product_names', 'godowns'));
    }



    public function store(Request $request)
    {

        // dd($request->product_id);
        $request->validate([
                          
             'product_id' => 'required|unique:packlists',
             'available_qty' => 'required',
             'required_qty' => 'required',
            ], [
            'product_id.unique' => 'Product name already exist!',
            'available_qty.required' => 'Available quantity is required.',
            'required_qty.required' => 'Required quantity is required.',
        ]);    

        
         $godown = Godown::find($request->godown);
       
        Packlist::updateOrCreate(['id' => 0],
                ['product_id' => $request->product_id, 'godown' => $godown->name,'available_qty' => $request->available_qty,'required_qty' => $request->required_qty]);
        
        $data = Product::find($request->product_id);
        $data->quantity = $request->available_qty-$request->required_qty;
        $data->save();

        return back()->withInput()->with('success', 'Save successfully');
       
      
    }

    public function edit($id)
    {
        $Packlist = Packlist::find($id);
        return response()->json($Packlist);
    }

    
    public function destroy($id)
    {   $packlist = Packlist::find($id);

        $data = Product::find($packlist->product_id);
        $data->quantity = $packlist->available_qty;
        $data->save();

        Packlist::find($id)->delete();

        return response()->json(['success'=>'Packlist deleted!//']);
    }

    public function packlist_godown($id){
        $product_id = Product::findOrFail($id);
        $godowns = DB::table('products')
                    ->join('godowns', 'products.godown_id', '=', 'godowns.id' )
                    ->where('products.product_name_id', '=', $product_id->product_name_id)
                    ->orderBy('godowns.created_at', 'desc')
                    ->get(array('products.product_name_id as product_name_id','godowns.id as id', 'godowns.name as name', 'products.quantity as quantity'));

        
        return Response::json($godowns);
    }
    public function packlist_quantity($product_name_id, $godown_id){
        $quantity = DB::table('products')
                    ->where('products.product_name_id', $product_name_id )
                    ->where('products.godown_id', $godown_id )
                    ->get('products.quantity as quantity');
        
        return Response::json($quantity);
    }

     public function packlist_export()
    {
        $date = date('Y-m-d');
        return Excel::download(new PacklistExport, 'Packlist-'. $date .'.xlsx');
    }   
   
    public function clear_packlist()
    {
        DB::table('packlists')->delete();
        return back()->with('success', 'Packlist cleared successfully.');
    }   


   





}

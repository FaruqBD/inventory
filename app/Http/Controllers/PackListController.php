<?php

namespace App\Http\Controllers;
use App\Models\ProductName;
use App\Models\Packlist;
use App\Models\Category;
use App\Models\Godown;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;
use App\Exports\PacklistExport;
use Redirect,Response;
use SweetAlert;

class PackListController extends Controller
{
    public function index(Request $request)
    {


        if ($request->ajax()) {

            $data = PackList::latest()->get();
            
             
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
                            ->get()->unique('product_name_id');
                // dd($product_names);

        $godowns = Godown::latest()->get();
        return view('pages.packlist',compact('product_names', 'godowns'));
    }

     public function store(Request $request)
    {
         
        $godown = Godown::find($request->godown);
        // $product_name = ProductName::find($request->product_name);
        
        Packlist::updateOrCreate(['id' => 0],
                ['product_name' => $request->product_name, 'godown' => $godown->name,'available_qty' => $request->available_qty,'required_qty' => $request->required_qty]);        

        return response()->json(['success'=>'Pack List saved successfully!']);
    }

    public function edit($id)
    {
        $Packlist = Packlist::find($id);
        return response()->json($Packlist);
    }

    
    public function destroy($id)
    {
        Packlist::find($id)->delete();

        return response()->json(['success'=>'Packlist deleted!']);
    }

    public function packlist_godown($id){
        $godowns = DB::table('products')
                    ->join('godowns', 'products.godown_id', '=', 'godowns.id' )
                    ->where('products.product_name_id', '=', $id)
                    ->orderBy('godowns.created_at', 'desc')
                    ->get(array('godowns.id as id', 'godowns.name as name', 'products.quantity as quantity'));
        
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
        return Excel::download(new PacklistExport, 'Packlists.xlsx');
    }   
   
    public function clear_packlist()
    {
        DB::table('packlists')->delete();
         \Session::put('success', 'Your list deleted successfully.');
        return back();
    }   





}

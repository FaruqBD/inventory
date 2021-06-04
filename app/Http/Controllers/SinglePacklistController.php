<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductName;
use App\Models\Packlist;
use App\Models\Category;
use App\Models\Product;
use App\Models\Godown;
use App\Models\SinglePacklist;
use DataTables;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;
use App\Exports\PacklistExport;
use Redirect,Response;
use SweetAlert;
use PDF;

class SinglePacklistController extends Controller
{
     public function single_product_outward(Request $request)
    {
       if ($request->ajax()) {

           $data = DB::table('single_packlists')
                    ->join('products', 'single_packlists.product_id', '=', 'products.id' )
                    ->join('product_names', 'products.product_name_id', '=', 'product_names.id' )
                    ->orderBy('single_packlists.id', 'desc') 
                    // ->get();                           
                    ->get(['single_packlists.id as id','products.product_name_id as product_name_id','godown_id','product_id','single_packlists.godown as godown','single_packlists.available_qty as available_qty','single_packlists.required_qty as required_qty','product_names.name as name']);

            
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

        
        $godowns = Godown::latest()->get();
         // dd($godowns);
        return view('pages.single_product_outward',compact('godowns'));
    }

    public function single_packlist_store(Request $request)
    {


        // dd($request->product_id);
        $request->validate([
                          
               'product_id' => 'required|unique:single_packlists',
             'available_qty' => 'required',
             'required_qty' => 'required',
            ], [
            
             'product_id.unique' => 'Product name already exist!',
            'available_qty.required' => 'Available quantity is required.',
            'required_qty.required' => 'Required quantity is required.',
        ]);    

        
         $godown = Godown::find($request->godown);
       
        SinglePacklist::updateOrCreate(['id' => 0],
                ['product_id' => $request->product_id, 
                'godown' => $godown->name,
                'available_qty' => $request->available_qty,
                'required_qty' => $request->required_qty, 
            ]);
        
        $data = Product::find($request->product_id);
        $data->quantity = $request->available_qty-$request->required_qty;
        $data->save();

        $product = ProductName::find($request->product_name_id);


        $pdfData = [
            'title' => 'Packlist',
            'date' => date('m/d/Y'),
            'product_name' => $product->name,
            'godown' => $godown->name,
            'available_qty' => $request->available_qty,
            'required_qty' => $request->required_qty, 
        ];

        $pdf = PDF::loadView('pdf.single_packlist_pdf', compact('pdfData'));

    
       return $pdf->download('Single Packlist-'.date('m-d-Y').'.pdf');

        // return back()->withInput()->with('success', 'Save successfully');
       
      
    }

     public function edit($id)
    {
        $Packlist = SinglePacklist::find($id);
        return response()->json($Packlist);
    }

    
    public function destroy($id)
    {   $packlist = SinglePacklist::find($id);

        $data = Product::find($packlist->product_id);
        $data->quantity = $packlist->available_qty;
        $data->save();

        SinglePacklist::find($id)->delete();

        return response()->json(['success'=>'Single Packlist deleted!//']);
    }
}

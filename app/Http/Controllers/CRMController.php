<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crm;
use App\Models\CrmRemark;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CRMController extends Controller
{
    public function index()
    {
       
            // $crms = Crm::latest()->get();
        $crms = DB::table('crms')
                    ->join('users', 'crms.assigned_to', '=', 'users.id' )
                    ->orderBy('crms.id', 'desc')
                    ->get(array('crms.id as id', 'crms.customer as customer','crms.issue as issue','crms.status as status', 'crms.created_at as created_at', 'users.name as assigned_to','crms.dead_line as dead_line', 'crms.remarks as remarks', 'crms.sla as sla'));
            $users = User::latest()->get();
            $currentTime = date("Y-m-d H:i:s",Time());

            return view('pages.all_crm', compact('crms', 'users', 'currentTime'));
    }
     

     public function store(Request $request)
    {
        if($request->status > 1){
            $sla = date("Y-m-d H:i:s",Time());
            }else{
                $sla = null;
            }


         $request->validate([
              
                'id' => 'nullable',
                'customer' => 'required',
                'issue' => 'required',
                'status' => 'nullable',
                'assigned_to' => 'required',
                'dead_line' => 'required',
                'remarks' => 'nullable'
            ]);
       
            Crm::updateOrCreate(
                ['id' => $request->id],
                ['customer' => $request->customer,        
                'issue' => $request->issue,    
                'status' => $request->status,    
                'assigned_to' => $request->assigned_to,
                'dead_line' => $request->dead_line,
                'sla' => $sla,
                'remarks' => $request->remarks]
            );  
        return redirect()->back();
    }

     public function edit($id)
    {
        $crms = Crm::find($id);
        return response()->json($crms);
    }

     public function details($id)
    {

        $crms = DB::table('crms')
                    ->join('users', 'crms.assigned_to', '=', 'users.id' )
                    ->where('crms.id', '=', $id)
                    ->get(array('crms.id as id', 'crms.customer as customer','crms.issue as issue','crms.status as status', 'crms.created_at as created_at', 'users.name as assigned_to','crms.dead_line as dead_line', 'crms.remarks as remarks'));
        $crm_remarks = DB::table('crm_remarks')
                        ->join('users', 'crm_remarks.user_id', '=', 'users.id' )
                        ->where('crm_remarks.crm_id', '=', $id)
                        ->orderBy('crm_remarks.id', 'desc')
                        ->get(array('crm_remarks.details as details', 'crm_remarks.created_at as created_at', 'users.name as user'));
        $id = $id;
        return view('pages.crm_details', compact('crms', 'id', 'crm_remarks'));
    }

    public function destroy($id)
    {
        Crm::find($id)->delete();

        return redirect()->back();
    }

    public function crm_post_update(Request $request)
    {
         $request->validate([
              
                'id' => 'nullable',
                'crm_id' => 'required',
                'user_id' => 'required',
                'details' => 'required',
            ]);
       
            CrmRemark::updateOrCreate(
                ['id' => $request->id],
                ['crm_id' => $request->crm_id,        
                'user_id' => $request->user_id,        
                'details' => $request->details,]
            );  
        return redirect()->back();

    }
      
}

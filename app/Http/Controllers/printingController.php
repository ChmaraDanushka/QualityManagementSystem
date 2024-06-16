<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Login;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\View;
use App\Models\printing_mc;
use App\Models\print_cus;
use App\Models\sheet_product_add;
use App\Models\print_check_list;
use App\Models\print_mc_log;
use App\Models\sheet_ch_list;
use Illuminate\Support\Facades\DB;

class printingController extends Controller
{

    public function print_customers_list (){
        $data =  print_cus::all();
        return view('print_customers_list ',['data'=>$data]);
    }
    public function print_list_all(Request $req){
        $print_list =print_check_list::orderBy('print_che_id','desc')->get();
        return view('print_list_all')->with(['print_list'=>$print_list]);
    }
    public function print_list_ongoing(Request $req){
        $print_list =print_check_list::where('print_che_date',date('Y-m-d'))->orderBy('print_che_id','desc')->get();
        return view('print_list_ongoing')->with(['print_list'=>$print_list]);
    }
    public function printlist_quality_recent(Request $req){
        $print_list = print_check_list::where('print_che_date',date('Y-m-d'))->where('created_by',session('uid'))->orderBy('print_che_id','desc')->get();
        return view('print_list_recent')->with(['print_list'=>$print_list]);
    }

    public function startStopMachine(Request $req){
        try {
           $check_status = printing_mc::where('printing_mc_id',$req->id)->value('mc_status');
           $machine_name = printing_mc::where('printing_mc_id',$req->id)->value('printing_mc_no');
           if($check_status==0){
            $create_log = print_mc_log::create([
                'mc_id'=>$req->id,
                'mc_name'=>$machine_name,
                'log_date'=>date('Y-m-d'),
                'start_time'=>date('H:i:s'),
                'created_at'=>date('Y-m-d H:i:s'),
                'created_by'=>session('uid')
            ]);
            $update_status = printing_mc::where('printing_mc_id',$req->id)->update(['mc_status'=>1]);
            return back()->with('success', 'Machine started successfully');
           }else{
            $get_last_log = print_mc_log::where('mc_id',$req->id)->latest()->first();
            $update_log = print_mc_log::where('id',$get_last_log->id)->update([
                'end_time'=>date('H:i:s')
            ]);
            $update_status = printing_mc::where('printing_mc_id',$req->id)->update(['mc_status'=>0]);
            return back()->with('success', 'Machine stoped successfully');
           }
           
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('error', 'something went wrong');
        }
    }
        //...............................thermo forming matchin add..........................................//
        public function printing_add_mc(Request $req)
        {
     // Add validation 
     $req->validate([
        'mc_no' => 'required|string|max:255|unique:printing_mc,printing_mc_no',
        'mc_name' => 'required|string|max:255|unique:printing_mc,printing_mc_name',
        'main_matirial' => 'required|string|max:255',
        'second_matirial' => 'required|string|max:255',
    ]);
    
    try {
        // Insert the new matchin record into the database
        $printing = new printing_mc();
        $printing->printing_mc_no = $req->mc_no;
        $printing->printing_mc_name = $req->mc_name;
        $printing->printing_mcfirst_mt = $req->main_matirial;
        $printing->printing_mcsecond_mt = $req->second_matirial;
      
        $rec = $printing->save();
    
        if ($rec) {
            return back()->with('success', 'You have successfully added a printing Matchine.');
        }
    } catch (\Illuminate\Database\QueryException $e) {
        if ($e->getCode() === '23000') {
            // Duplicate entry error
            return back()->with('fail', 'The data already exists.');
        } else {
            // Other query exceptions
            return back()->with('error', 'somthing went wrong.');
        }    
    }
        }

        //.....................................................view printing mc...............................//
function print_mc_view(){

    if (session()->has('AName')) {

        $data =  printing_mc::all();
        $machine_log = print_mc_log::orderBy('created_at','desc')->get();
        
        return view('printing_add_mc',['printing'=>$data,'logs'=>$machine_log]);

        }
    return view('admin_login');
   
}

  //...............................Printing customer add..........................................//
  public function printing_cus_view(){
    return view('printing_cus_add');
  }
  public function printing_cus_add(Request $req)
  {
// Add validation 
$req->validate([
  'cus_no' => 'required|string|max:255|unique:print_cus,print_cus_idno',
  'cus_name' => 'required|string|max:255|unique:print_cus,print_cus_name',
  'ref_name' => 'required|string|max:255',
  'ref_tp' => 'required|string|max:255',
]);

try {
  // Insert the new matchin record into the database print_cus_idno
  $printing = new print_cus();
  $printing->print_cus_idno = $req->cus_no;
  $printing->print_cus_name = $req->cus_name;
  $printing->print_ref_id = $req->ref_name;
  $printing->print_ref_tp = $req->ref_tp;


  $rec = $printing->save();

  if ($rec) {
      return back()->with('success', 'You have successfully added a printing Customer.');
  }
} catch (\Illuminate\Database\QueryException $e) {
  if ($e->getCode() === '23000') {
      // Duplicate entry error
      return back()->with('fail', 'The data already exists.');
  } else {
      // Other query exceptions
      return back()->with('error', 'somthing went wrong.');
  }    
}
  } 
        //.....................................................view printing customer...............................// 
        function print_cus_view(){ 

            if (session()->has('AName')) {
        
                $data =  print_cus::all();
                
                return view('print_customers_add',['printing'=>$data]);
        
                }
            return view('admin_login');
           
        }

        // ......................................................Delete sheet mc..........................//


        public function print_cus_delete($id){

            $data = print_cus::where('print_cus_id', $id)->first();
            $data->delete();
    
            return redirect('print_customers_add');
        
            }

            public function print_mc_delete($id){

                $data = printing_mc::where('printing_mc_id', $id)->first();
                $data->delete();
        
                return back()->with('success','Machine Deleted Successfully');
            
                }

            //...................................................................................................................................................................................//
//.............................................qc dash thermo online check list....................................................................................................................//
//.................................................................................................................................................................................//
function ch_mc_view(){
    if (session()->has('QCName')) {
        $data =  printing_mc::where('mc_status',1)->get();
        $data1 =  print_cus::all();
        $data2 =  sheet_product_add::all();
        $data3 = sheet_ch_list::select('sheet_chc_id','sheet_chc_mt_id','sheet_chc_mt','sheet_chc_color','sheet_chc_batch','sheet_chc_rollBatch')->where('sheet_issues',0)->get();
        
        return view('print_check_list', ['admin' => $data, 'product' => $data1, 'sheet' => $data2,'ch_list'=>$data3]);
    }

    return view('admin_login');
}

//add print check list  
public function print_check(Request $req)
{
    $req->validate([
        'mc_no' => 'required|string|max:255',
        'item_name' => 'required|string|max:255',
        'item_batch' => 'required|string|max:255',

        
        'qty_ch' => 'required|string|max:255',
        'color_va' => 'required|string|max:255',

        'missin_si' => 'required|string|max:255',
        'smudge_si' => 'required|string|max:255',
        'block_al' => 'required|string|max:255',
        'ink_dry' => 'required|string|max:255',

    ]);
    DB::beginTransaction();
    try {
        // Insert the new matchin record into the database
        $issues = 0;
        $product_data = print_cus::where('print_cus_id',$req->item_name)->first();
        $print = new print_check_list();
        $print->print_che_mc = $req->mc_no;
        $print->print_cus_id = $product_data->print_cus_id;
        $print->print_che_name = $product_data->print_cus_name;
        $print->print_che_batch = $req->item_batch;

        $print->print_che_time = date('H:i:s');
        $print->print_che_date = date('Y-m-d');
        $print->print_che_qty = $req->qty_ch;
        $print->print_che_cVa = $req->color_va;

        $print->print_che_missing = $req->missin_si;
        $print->print_che_smudge = $req->smudge_si;
        $print->print_che_block = $req->block_al;
        $print->print_che_ink = $req->ink_dry;
        $print->created_by = session('uid');
        //check for quality issues
        if($req->color_va=='Yes'){
            $issues+=1;
        }
        if($req->missin_si=='Yes'){
            $issues+=1;
        }
        if($req->smudge_si=='Yes'){
            $issues+=1;
        }
        if($req->block_al=='Yes'){
            $issues+=1;
        }
        if($req->ink_dry=='Yes'){
            $issues+=1;
        }
        $print->print_issues = $issues;

        $rec = $print->save();
    
        if ($rec) {
            DB::commit();
            $msg = '';
            if($issues>0){
                $msg = 'Printing Checklist added successfully. There are some quality issues appeared. Please Check the Issues!!';
            }else{
                $msg = 'Printing Checklist added successfully';
            }
            return back()->with('success', $msg);
        }
    } catch (\Illuminate\Database\QueryException $e) {
        DB::rollBack();
        if ($e->getCode() === '23000') {
            // Duplicate entry error
            return back()->with('fail', 'The data already exists.');
        } else {
            // Other query exceptions
            return back()->with('error', 'somthing went wrong.');
        }    
    }
}

}

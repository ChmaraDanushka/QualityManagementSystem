<?php

namespace App\Http\Controllers;

use App\Models\qc_users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Login;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\View;
use App\Models\sheet_mc_add;
use App\Models\sheet_material_add;
use App\Models\sheet_product_add;
use App\Models\sheet_ch_list;
use App\Models\sheet_mixture;
use App\Models\sheet_mc_log;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class sheetContoller extends Controller

{
    public function view_material_mixture(){
        $data = sheet_mixture::select('mx_bulk_id',DB::raw('SUM(mx_qty) as tot_qty'),DB::raw('SUM(mx_mixed) as tot_mix'))->groupBy('mx_bulk_id')->get();
        $data1 = sheet_mixture::all();
        return view('view_material_mixture',['data'=>$data,'mixtures'=>$data1]);
    }

    public function sheet_product_list(){
        $data =  sheet_product_add::all();
        return view('sheet_product_list',['data'=>$data]);
    }

    public function get_product_mixture(Request $req){
        $data =  sheet_material_add::all();
        return view('qc_add_material_mixture',['admin'=>$data]);
    }



    public function qc_sheet_quality_recent(Request $req){
        $ch_list =sheet_ch_list::where('sheet_chc_date',date('Y-m-d'))->where('created_by',session('uid'))->orderBy('sheet_chc_id','desc')->get();
        return view('sheet_checklist_recent')->with(['ch_list'=>$ch_list]);
    }

    public function startStopMachine(Request $req){
        try {
           $check_status = sheet_mc_add::where('mc_id',$req->id)->value('mc_status');
           $machine_name = sheet_mc_add::where('mc_id',$req->id)->value('mc_no');
           if($check_status==0){
            $create_log = sheet_mc_log::create([
                'mc_id'=>$req->id,
                'mc_name'=>$machine_name,
                'log_date'=>date('Y-m-d'),
                'start_time'=>date('H:i:s'),
                'created_at'=>date('Y-m-d H:i:s'),
                'created_by'=>session('uid')
            ]);
            $update_status = sheet_mc_add::where('mc_id',$req->id)->update(['mc_status'=>1]);
            return back()->with('success', 'Machine started successfully');
           }else{
            $get_last_log = sheet_mc_log::where('mc_id',$req->id)->latest()->first();
            $update_log = sheet_mc_log::where('id',$get_last_log->id)->update([
                'end_time'=>date('H:i:s')
            ]);
            $update_status = sheet_mc_add::where('mc_id',$req->id)->update(['mc_status'=>0]);
            return back()->with('success', 'Machine Stoped successfully');
           }
           
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('error', 'something went wrong');
        }
    }
    //
    public function sheetmcadd(Request $req)
    {
 // Add validation 
 $req->validate([
    'mc_no' => 'required|string|max:255|unique:sheet_mc_add,mc_no|unique:sheet_mc_add,mc_no',
    'mc_name' => 'required|string|max:255|unique:sheet_mc_add,mc_name',
    'main_matirial' => 'required|string|max:255',
    'second_matirial' => 'required|string|max:255',
]);

try {
    // Insert the new matchin record into the database
    $sheetEx = new sheet_mc_add();
    $sheetEx->mc_no = $req->mc_no;
    $sheetEx->mc_name = $req->mc_name;
    $sheetEx->first_matirial = $req->main_matirial;
    $sheetEx->second_matirial = $req->second_matirial;
  
    $rec = $sheetEx->save();

    if ($rec) {
        return back()->with('success', 'You have successfully added an Sheet Extruder.');
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
    
//.....................................................view sheet mc...............................//
function sheet_mc_view(){

    if (session()->has('AName')) {

        $data =  sheet_mc_add::all();
        $machine_log = sheet_mc_log::orderBy('created_at','desc')->get();
        
        return view('sheet_mc_add',['admin'=>$data,'logs'=>$machine_log]);

        }
    return view('admin_login');
   
}

//.....................................................edit sheet mc...............................//
public function editSheetMc($id)
{
    if (session()->has('AName')) {
        $data = sheet_mc_add::where('mc_id', $id)->first(); // Use first() instead of get() to retrieve a single record
        return view('sheet_mc_add', ['sheetMc' => $data]);
    }

    return view('admin_login');
}
                 ///// .....................Delete sheet mc..............  ///////


                public function delete_mc($id){

                    $data = sheet_mc_add::where('mc_id', $id)->first();
                    $data->delete();
            
                    return redirect('sheet_mc_add');
                
                    }

// sheet material add function.........................................
public function sheet_material_add(Request $req)
{
 // Add validation 
 $req->validate([
    'material_name' => 'required|string|max:255|unique:sheet_material_add,sheet_material_name',
    'supplier' => 'required|string|max:255|unique:sheet_mc_add,mc_name',
    'batch_no' => 'required|string|max:255',
    'brand' => 'required|string|max:255',
    'grade' => 'required|string|max:255',
]);

try {
    // Insert the new matchin record into the database
    $sheetMt = new sheet_material_add();
    $sheetMt->sheet_material_name  = $req->material_name;
    $sheetMt->sheet_material_supplier = $req->supplier;
    $sheetMt->sheet_material_batch_no = $req->batch_no;
    $sheetMt->sheet_material_brand = $req->brand;
    $sheetMt->sheet_material_grade = $req->grade;
  
    $rec = $sheetMt->save();

    if ($rec) {
        return back()->with('success', 'You have successfully added an Sheet Extruder Material.');
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
//.....................................................view sheet material...............................//
function sheet_material_view(){

    if (session()->has('AName')) {

        $data =  sheet_material_add::all();
        
        return view('sheet_material_add',['admin'=>$data]);

        }
    return view('admin_login');
   
}
                 ///// .....................Delete sheet material..............  ///////


public function delete_material($id){

    $data = sheet_material_add::where('material_id', $id)->first();
    $data->delete();

 return redirect('sheet_material_add');
                
 }


// sheet product add function......................................................................
//sheet

public function add_sheet_product(Request $req)
{
    // Add validation 
    $req->validate([
        'sheet_type' => 'required|string|max:255',
        'sheet_color' => 'required|string|max:255',
        // 'batch_no' => 'required|string|max:255',
        'standard_width' => 'required|string|max:255',
        'standard_thickness' => 'required|string|max:255',
    ]);

    try {
        // Insert the new matching record into the database

        $sheetEx = new sheet_product_add();
        $sheetEx->s_type = $req->sheet_type;
        $sheetEx->s_color = $req->sheet_color;
        // $sheetEx->s_batchNo = $req->batch_no;
        $sheetEx->s_width = $req->standard_width;
        $sheetEx->s_thickness = $req->standard_thickness;

        $rec = $sheetEx->save();

        if ($rec) {
            return back()->with('success', 'You have successfully added a Sheet Extruder.');
        }
    } catch (\Illuminate\Database\QueryException $e) {
        if ($e->getCode() === '23000') {
            // Duplicate entry error
            return back()->with('fail', 'The data already exists.');
        } else {
            // Log the actual exception message
            Log::error($e->getMessage());
    
            // Display a more informative error message
            return back()->with('error', 'An unexpected error occurred. Please check the logs for more information.');  
        }    
    }
    
}

function sheet_product_view(){

    if (session()->has('AName')) {

        $data =  sheet_product_add::all();
        
        return view('sheet_product',['admin'=>$data]);

        }
    return view('admin_login');
   
}

public function delete_sheet_product($id){

    $data = sheet_product_add::where('s_product_id', $id)->first();
    $data->delete();

 return redirect('sheet_product');
                
 }

//....................................................................................................................................//
//...............................................................QC online checlist ........................................................//
function get_mc_data(){

    if (session()->has('QCName')) {

        $data = [
            'admin' =>  sheet_mc_add::where('mc_status',1)->get(),
            'product' =>  sheet_product_add::all(),
            
        ];
       
        return view('qc_sheet_checklist',['admin'=>$data['admin']],['product'=>$data['product']])->with(['data'=>$data]);

        }
    return view('qc_login');
   
}
//add check list
public function sheet_online_checklist_add(Request $req)
{
    // Add validation 
    $req->validate([
        'mc_no' => 'required|string|max:255',
        'material_type' => 'required|string|max:255',
        // 'standard_color' => 'required|string|max:255',
        // 'batch_no' => 'required|string|max:255',
        'standard_width' => 'required|string|max:255',
        'standard_thicknes' => 'required|string|max:255',

        // 'ch_time' => 'required|string|max:255',
        // 'ch_date' => 'required|string|max:255',
        'ch_roll_batch' => 'required|string|max:255',
        'ch_roll_width' => 'required|string|max:255',

        'ch_roll_dust' => 'required|string|max:255',
        'ch_roll_r' => 'required|string|max:255',
        'ch_roll_mr' => 'required|string|max:255',
        'ch_roll_ml' => 'required|string|max:255',
        'ch_roll_l' => 'required|string|max:255',

    ]);
    DB::beginTransaction();
    try {
        // Insert the new matching record into the database
        $issues = 0;
        $split_str = explode('-',$req->material_type);
        $product_data = sheet_product_add::where('s_type',$split_str[0])->where('s_color',$split_str[1])->where('s_width',$req->standard_width)->where('s_thickness',$req->standard_thicknes)->first();
        if($product_data){
            $sheetEx = new sheet_ch_list();
        $sheetEx->sheet_chc_mc = $req->mc_no;
        $sheetEx->sheet_chc_mt_id = $product_data->s_product_id;
        $sheetEx->sheet_chc_color = $product_data->s_color;
        $sheetEx->sheet_chc_mt = $product_data->s_type;
        $sheetEx->sheet_chc_width = $req->standard_width;
        $sheetEx->sheet_chc_thickness = $req->standard_thicknes;

        $sheetEx->sheet_chc_time = date('H:i:s');
        $sheetEx->sheet_chc_date = date('Y-m-d');
        $sheetEx->sheet_chc_rollBatch = $req->ch_roll_batch;
        $sheetEx->sheet_chc_rollWidth = $req->ch_roll_width;

        $sheetEx->sheet_chc_roll_dust = $req->ch_roll_dust;
        
        $sheetEx->sheet_chc_roll_r = $req->ch_roll_r;
        $sheetEx->sheet_chc_roll_mr = $req->ch_roll_mr;
        $sheetEx->sheet_chc_roll_ml = $req->ch_roll_ml;
        $sheetEx->sheet_chc_roll_l = $req->ch_roll_l;
        $sheetEx->created_by = session('uid');
        //check for quality issues
        if($req->ch_roll_r!=$product_data->s_thickness){
            $issues+=1;
        }
        if($req->ch_roll_mr!=$product_data->s_thickness){
            $issues+=1;
        }
        if($req->ch_roll_ml!=$product_data->s_thickness){
            $issues+=1;
        }
        if($req->ch_roll_l!=$product_data->s_thickness){
            $issues+=1;
        }
        $sheetEx->sheet_issues = $issues;
        $rec = $sheetEx->save();

        if ($rec) {
            DB::commit();
            $msg = '';
            if($issues>0){
                $msg = 'Sheet Extruder added successfully. There are some quality issues appeared. Please Check the Issues!!';
            }else{
                $msg = 'Sheet Extruder added successfully';
            }
            $data =  sheet_mc_add::all();
            $data1 =  sheet_product_add::all();
            
        
        return back()->with('success', $msg);
            
        }
        }else{
            $msg = 'No Product found with your selection';
            $data =  sheet_mc_add::all();
            $data1 =  sheet_product_add::all();
            
            return back()->with('error', $msg);
        }
        
        
    } catch (\Illuminate\Database\QueryException $e) {
        DB::rollBack();
        // dd($e->getMessage());
        if ($e->getCode() === '23000') {
            // Duplicate entry error
            return back()->with('fail', 'The data already exists.');
        } else {
            // Log the actual exception message
            Log::error($e->getMessage());
            
            // Display a more informative error message
            return back()->with('error', 'An unexpected error occurred. Please check the logs for more information.');
        }    
    }
    
}



//view of the sheet check list
function sheet_online_checklist_view(){

    if (session()->has('AName')) {

        // Get the current date
        $today = Carbon::now()->format('Y-m-d');

        // Fetch records for today's date
        $data = sheet_ch_list::whereDate('sheet_chc_date', $today)->get();
        
        return view('qc_sheet_quality_history', ['admin' => $data]);
       
    }

    return view('qc_login');
}

function sheet_ongoing(){

    if (session()->has('AName')) {

        $ch_list =sheet_ch_list::select('sheet_ch_list.*','qc_users.qc_first_name')->join('qc_users','qc_id','sheet_ch_list.created_by')->where('sheet_chc_date',date('Y-m-d'))->orderBy('sheet_chc_id','desc')->get();
        
        return view('sheet_ongoing', ['admin' => $ch_list]);

    }

    return view('admin_login');
}

//sheet all quality products

function sheet_all(){

    if (session()->has('AName')) {

        $data =  sheet_ch_list::orderBy('sheet_chc_id','desc')->get();
        
        return view('sheet_all_quality_pro',['admin'=>$data]);

        }
    return view('admin_login');


}

//delete quality check list



public function delete_sheet_all($id){

    $data = sheet_ch_list::where('sheet_chc_id', $id)->first();
    $data->delete();

 return back();
                
 }

//...................mixture add..............//
public function sheet_mixture_add(Request $request)
{
    try {
        $rand = rand();
        for ($i = 1; $i <= 6; $i++) {
            if($request->input("material_".$i)==null){
                break;
            }
            sheet_mixture::create([
                'mx_bulk_id'=>$rand,
                'mx_material' => $request->input("material_".$i),
                'mx_our_bn_no' => $request->input("our_bn_no_".$i),
                'mx_mt_brand' => $request->input("mt_brand_".$i),
                'mx_qty' => $request->input("qty_".$i),
                'mx_mixed' => $request->input("mixed_".$i),
            ]);
        }

        // Redirect to the view with the data
     
        return back()->with('success','Material Mixture Added Successfully');

    } catch (\Illuminate\Database\QueryException $e) {
        return back()->with('error', 'An unexpected error occurred. Please check the logs for more information.');
        // if ($e->getCode() === '23000') {
        //     // Duplicate entry error
        //     return back()->with('error', 'The data already exists.');
        // } else {
        //     // Log the actual exception message
        //     Log::error($e->getMessage());

        //     // Display a more informative error message
        //     return back()->with('error', 'An unexpected error occurred. Please check the logs for more information.');
        // }
    }
}



}










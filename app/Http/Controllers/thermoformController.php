<?php

namespace App\Http\Controllers;

use App\Models\sheet_ch_list;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Login;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\View;
use App\Models\thermo_mc_add;
use App\Models\thermo_items;
use App\Models\sheet_product_add;

use App\Models\thermo_check_list;
use App\Models\thermo_mc_log;
use Illuminate\Support\Facades\DB;

class thermoformController extends Controller
{
    
    public function thermo_product_list(){
        $data =  thermo_items::all();
        return view('thermo_product_list',['data'=>$data]);
    }

    public function thermo_form_quality_recent(Request $req){
        $thermo_list =thermo_check_list::where('thermo_check_date',date('Y-m-d'))->where('created_by',session('uid'))->orderBy('thermo_check_id','desc')->get();
        return view('thermo_form_recent')->with(['th_list'=>$thermo_list]);
    }

    public function startStopMachine(Request $req){
        try {
           $check_status = thermo_mc_add::where('thermo_mc_id',$req->id)->value('mc_status');
           $machine_name = thermo_mc_add::where('thermo_mc_id',$req->id)->value('thermo_mc_no');
           if($check_status==0){
            $create_log = thermo_mc_log::create([
                'mc_id'=>$req->id,
                'mc_name'=>$machine_name,
                'log_date'=>date('Y-m-d'),
                'start_time'=>date('H:i:s'),
                'created_at'=>date('Y-m-d H:i:s'),
                'created_by'=>session('uid')
            ]);
            $update_status = thermo_mc_add::where('thermo_mc_id',$req->id)->update(['mc_status'=>1]);
            return back()->with('success', 'Machine started successfully');
           }else{
            $get_last_log = thermo_mc_log::where('mc_id',$req->id)->latest()->first();
            $update_log = thermo_mc_log::where('id',$get_last_log->id)->update([
                'end_time'=>date('H:i:s')
            ]);
            $update_status = thermo_mc_add::where('thermo_mc_id',$req->id)->update(['mc_status'=>0]);
            return back()->with('success', 'Machine stoped successfully');
           }
           
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('error', 'something went wrong');
        }
    }
    //...............................thermo forming matchin add..........................................//
    public function thermo_mc_add(Request $req)
    {
 // Add validation 
 $req->validate([
    'mc_no' => 'required|string|max:255|unique:thermo_mc_add,thermo_mc_no',
    'mc_name' => 'required|string|max:255|unique:thermo_mc_add,thermo_mc_name',
    'main_matirial' => 'required|string|max:255',
    'second_matirial' => 'required|string|max:255',
]);

try {
    // Insert the new matchin record into the database
    $thermo = new thermo_mc_add();
    $thermo->thermo_mc_no = $req->mc_no;
    $thermo->thermo_mc_name = $req->mc_name;
    $thermo->thermo_main_matirial = $req->main_matirial;
    $thermo->thermo_second_matirial = $req->second_matirial;
  
    $rec = $thermo->save();

    if ($rec) {
        return back()->with('success', 'You have successfully added an Thermo Forming Matchine.');
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
function thermo_mc_view(){

    if (session()->has('AName')) {

        $data =  thermo_mc_add::all();
        $machine_log = thermo_mc_log::orderBy('created_at','desc')->get();
        
        return view('thermo_mc_add',['admin'=>$data,'logs'=>$machine_log]);

        }
    return view('admin_login');
   
}
// ......................................................Delete sheet mc..........................//


                 public function thermo_mc_delete($id){

                    $data = thermo_mc_add::where('thermo_mc_id', $id)->first();
                    $data->delete();
            
                    return redirect('thermo_mc_add');
                
                    }
//.................................................... thermo add products............................//
                    public function thermo_product_add(Request $req)
                    {
                        $req->validate([
                            'item' => 'required|string|max:255|unique:thermo_items,thermo_items_name',
                            'color' => 'required|string|max:255',
                            'material' => 'required|string|max:255',
                            'top' => 'required|string|max:255',
                            'outside' => 'required|string|max:255',
                            'bottom' => 'required|string|max:255',
                            'brim' => 'required|string|max:255',
                            'body' => 'required|string|max:255',
                            'base' => 'required|string|max:255',
                            'height' => 'required|string|max:255',
                            'weight' => 'required|string|max:255',
                            'capacity' => 'required|string|max:255',

                         
                        ]);
                        
                        try {
                            // Insert the new matchin record into the database
                            $thermo = new thermo_items();
                            $thermo->thermo_items_name = $req->item;
                            $thermo->thermo_items_color = $req->color;
                            $thermo->thermo_items_mt = $req->material;
                            $thermo->thermo_item_top = $req->top;
                            $thermo->thermo_item_outside = $req->outside;
                            $thermo->thermo_item_bottom = $req->bottom;
                            $thermo->thermo_item_brim = $req->brim;
                            $thermo->thermo_item_body = $req->body;
                            $thermo->thermo_item_base = $req->base;
                            $thermo->thermo_item_height = $req->height;
                            $thermo->thermo_item_weight = $req->weight;
                            $thermo->thermo_item_capacity = $req->capacity;
                            
                          

                           
                          
                            $rec = $thermo->save();
                        
                            if ($rec) {
                                return back()->with('success', 'You have successfully added an Thermo Forming Matchine.');
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

                    function sheet_product_view(){

                        if (session()->has('AName')) {
                    
                            $data =  thermo_items::all();
                            
                            return view('thermo_product_add',['admin'=>$data]);
                    
                            }
                        return view('admin_login');
                       
                    }
// ......................................................Delete thermo product..........................//


public function delete_thermo_item($id){
    $data = thermo_items::where('thermo_items_id', $id)->first();
    
    if ($data) {
        $data->delete();
        return redirect('thermo_product_add')->with('success', 'Successfully Deleted Record');
    } else {
        return redirect('thermo_product_add')->with('error', 'Record not found');
    }
}
// ......................................................Edit thermo product..........................//
public function editThermo($id)
{
    if (session()->has('AName')) {
        $data = thermo_items::where('thermo_items_id', $id)->first(); // Use first() instead of get() to retrieve a single record
        return view('thermo_item_edit', ['data' => $data]);
    }

    return view('admin_login');
}



//..........................................update item details.........................................................
function update_thermo_item(Request $req){
   
    // Find the existing admin user by ID
    $thermo = thermo_items::find($req->thermo_items_id );

    if (!$thermo) {
        return back()->with('error', 'User not found.');
    }

    // Update the user fields
    $thermo->thermo_items_name = $req->item;
    $thermo->thermo_items_color = $req->color;
    $thermo->thermo_items_mt = $req->material;
    $thermo->thermo_item_top = $req->top;
    $thermo->thermo_item_outside = $req->outside;
    $thermo->thermo_item_bottom = $req->bottom;
    $thermo->thermo_item_brim = $req->brim;
    $thermo->thermo_item_body = $req->body;
    $thermo->thermo_item_base = $req->base;
    $thermo->thermo_item_height = $req->height;
    $thermo->thermo_item_weight = $req->weight;
    $thermo->thermo_item_capacity = $req->capacity;


    // Save the updated user
    $thermo->save();

    if ($thermo) {
        return back()->with('success', 'Item updated successfully.');
    } else {
        return back()->with('error', 'Something went wrong.');
    }
}


//...................................................................................................................................................................................//
//.............................................qc dash thermo online check list....................................................................................................................//
//.................................................................................................................................................................................//

function thermo_mc_checkList(){
    if (session()->has('QCName')) {
        $data =  thermo_mc_add::where('mc_status',1)->get();
        $data1 =  thermo_items::all();
        $data2 =  sheet_product_add::all();
        $data3 = sheet_ch_list::select('sheet_chc_id','sheet_chc_mt_id','sheet_chc_mt','sheet_chc_color','sheet_chc_batch','sheet_chc_rollBatch')->where('sheet_issues',0)->get();
        
        return view('thermo_form_check_list', ['admin' => $data, 'product' => $data1, 'sheet' => $data2,'ch_list'=>$data3]);
    }

    return view('admin_login');
}

//add check list data

public function thermo_check_add(Request $req)
{
// Add validation 
DB::beginTransaction();
$req->validate([
    'mc_no' => 'required|string|max:255',
    // 'material_type' => 'required|string|max:255',
    // 'standard_color' => 'required|string|max:255',
    'item_name' => 'required|string|max:255',

    // 'ch_time' => 'required|string|max:255',
    // 'ch_date' => 'required|string|max:255',

    'height' => 'required|string|max:255',
    'top_di' => 'required|string|max:255',
    'outer_di' => 'required|string|max:255',
    'bottom_di' => 'required|string|max:255',
  
    'brim_thi' => 'required|string|max:255',
    'body_thi' => 'required|string|max:255',
    'base_thi' => 'required|string|max:255',

    'weight' => 'required|string|max:255',
    'volume' => 'required|string|max:255',



]);

try {
// Insert the new matchin record into the database
$issues = 0;
$product_data = thermo_items::where('thermo_items_id',$req->item_name)->first();
$thermo = new thermo_check_list();
$thermo->thermo_check_mc = $req->mc_no;
$thermo->thermo_batch_no = $req->item_batch;
$thermo->thermo_check_mt_id = $req->item_name;
$thermo->thermo_check_mt = $product_data->thermo_items_mt;
$thermo->thermo_check_color = $product_data->thermo_items_color;
$thermo->thermo_check_item = $product_data->thermo_items_name;

$thermo->thermo_check_time = date('H:i:s');
$thermo->thermo_check_date = date('Y-m-d');

$thermo->thermo_check_height = $req->height;
$thermo->thermo_check_top = $req->top_di;
$thermo->thermo_check_outer = $req->outer_di;
$thermo->thermo_check_bottom = $req->bottom_di;

$thermo->thermo_check_brim = $req->brim_thi;
$thermo->thermo_check_body = $req->body_thi;
$thermo->thermo_check_base = $req->base_thi;

$thermo->thermo_check_width = $req->weight;
$thermo->thermo_check_volume = $req->volume;

//check for quality issues
if($req->height!=$product_data->thermo_item_height){
    $issues+=1;
}
if($req->top_di!=$product_data->thermo_item_top){
    $issues+=1;
}
if($req->outer_di!=$product_data->thermo_item_outside){
    $issues+=1;
}
if($req->bottom_di!=$product_data->thermo_item_bottom){
    $issues+=1;
}
if($req->brim_thi!=$product_data->thermo_item_brim){
    $issues+=1;
}
if($req->body_thi!=$product_data->thermo_item_body){
    $issues+=1;
}
if($req->base_thi!=$product_data->thermo_item_base){
    $issues+=1;
}
if($req->volume!=$product_data->thermo_item_capacity){
    $issues+=1;
}
if($req->weight!=$product_data->thermo_item_weight){
    $issues+=1;
}
$thermo->created_by = session('uid');
$thermo->thermo_issues = $issues;
$rec = $thermo->save();

if ($rec) {
    $msg = '';
    DB::commit();
            if($issues>0){
                $msg = 'Thermo Form added successfully. There are some quality issues appeared. Please Check the Issues!!';
            }else{
                $msg = 'Thermo Form added successfully';
            }
    
        $data =  thermo_mc_add::all();
        $data1 =  thermo_items::all();
        $data2 =  sheet_product_add::all();
        $data3 = sheet_ch_list::select('sheet_chc_id','sheet_chc_mt_id','sheet_chc_mt','sheet_chc_color','sheet_chc_batch','sheet_chc_rollBatch')->where('sheet_issues',0)->get();
        
        return back()->with(['success'=>$msg]);
        
        
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
//thermo ongoing 

function thermo_ongoing_checlist(){

    if (session()->has('AName')) {

       

        // Fetch records for today's date
        $thermo_list =thermo_check_list::where('thermo_check_date',date('Y-m-d'))->orderBy('thermo_check_id','desc')->get();
        
        return view('thermo_ongoing_checlist')->with(['th_list' => $thermo_list]);

    }

    return view('admin_login');
}


function thermo_all_checklist(){

    if (session()->has('AName')) {

       

        // Fetch records for today's date
        $thermo_list =thermo_check_list::orderBy('thermo_check_id','desc')->get();
        
        return view('thermo_all_checklist')->with(['th_list' => $thermo_list]);

    }

    return view('admin_login');
}

}


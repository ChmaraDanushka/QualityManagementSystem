<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\print_check_list;
use App\Models\print_cus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\sheet_ch_list;
use App\Models\sheet_product_add;
use App\Models\thermo_check_list;
use App\Models\thermo_items;

class CommonController extends Controller
{
    public function logout(){
        Artisan::call('cache:clear');
        Auth::logout();
        return view('admin_login');
    }  
    
    public function qc_logout(){
        Artisan::call('cache:clear');
        Auth::logout();
        return view('qc_login');
    } 
    
    public function sheet_extruder_report(){
        $ch_list =sheet_ch_list::where('sheet_chc_date',date('Y-m-d'));
        $products = sheet_product_add::all();
        $ch_list = $ch_list->orderBy('sheet_chc_id','desc')->get();
        session()->flashInput([]);
        return view('sheet_extruder_report',['admin'=>$ch_list,'products'=>$products]);
    }

    public function genarate_sheet_extruder_report(Request $req){
        $date = explode(' - ',$req->daterange);
        $ch_list =sheet_ch_list::whereDate('sheet_chc_date','>=',date('Y-m-d',strtotime($date[0])))->whereDate('sheet_chc_date','<=',date('Y-m-d',strtotime($date[1])));
        $products = sheet_product_add::all();
        if($req->product!=0){
            $ch_list=$ch_list->where('sheet_chc_mt_id',$req->product);
        }
        if($req->status==1){
            $ch_list=$ch_list->where('sheet_issues','>',0);
        }
        if($req->status==2){
            $ch_list=$ch_list->where('sheet_issues',0);
        }
        $ch_list = $ch_list->orderBy('sheet_chc_id','desc')->get();
        session()->flashInput($req->input());
        return view('sheet_extruder_report',['admin'=>$ch_list,'products'=>$products]);
    }

    public function thermo_form_report(){
        $list =thermo_check_list::where('thermo_check_date',date('Y-m-d'));
        $products = thermo_items::all();
        $list = $list->orderBy('thermo_check_id','desc')->get();
        session()->flashInput([]);
        return view('thermo-form-report',['admin'=>$list,'products'=>$products]);
    }

    public function genarate_thermo_form_report(Request $req){
        $date = explode(' - ',$req->daterange);
        $list =thermo_check_list::whereDate('thermo_check_date','>=',date('Y-m-d',strtotime($date[0])))->whereDate('thermo_check_date','<=',date('Y-m-d',strtotime($date[1])));
        $products = thermo_items::all();
        if($req->product!=0){
            $list=$list->where('thermo_check_mt_id',$req->product);
        }
        if($req->status==1){
            $list=$list->where('thermo_issues','>',0);
        }
        if($req->status==2){
            $list=$list->where('thermo_issues',0);
        }
        $list = $list->orderBy('thermo_check_id','desc')->get();
        session()->flashInput($req->input());
        return view('thermo-form-report',['admin'=>$list,'products'=>$products]);
    }

    public function printing_report(){
        $list =print_check_list::where('print_che_date',date('Y-m-d'));
        $products = print_cus::all();
        $list = $list->orderBy('print_che_id','desc')->get();
        session()->flashInput([]);
        return view('printing-report',['admin'=>$list,'products'=>$products]);
    }

    public function generate_printing_report(Request $req){
        $date = explode(' - ',$req->daterange);
        $list =print_check_list::whereDate('print_che_date','>=',date('Y-m-d',strtotime($date[0])))->whereDate('print_che_date','<=',date('Y-m-d',strtotime($date[1])));
        $products = print_cus::all();
        if($req->product!=0){
            $list=$list->where('print_cus_id',$req->product);
        }
        if($req->status==1){
            $list=$list->where('print_issues','>',0);
        }
        if($req->status==2){
            $list=$list->where('print_issues',0);
        }
        $list = $list->orderBy('print_che_id','desc')->get();
        session()->flashInput($req->input());
        return view('printing-report',['admin'=>$list,'products'=>$products]);
    }

    public function markMessageRead(Request $req){
        $msg_update = Message::where('id',$req->id)->update(['is_read'=>1]);
        return back();
    }

    public function writeMessage(Request $req){
        $exp = explode('-',$req->user);
        $create = Message::create([
            'msg_from'=>session('uid'),
            'from_name'=>session('AName')?session('AName'):session('QCName'),
            'msg_from_utype'=>session('AName')?1:2,
            'msg_to_utype'=>session('AName')?2:1,
            'to_name'=>$exp[1],
            'msg_to'=>$exp[0],
            'message'=>$req->message,
            'create_time'=>date('Y-m-d H:i:s')
        ]);
        return back()->with('success','Message sent successfully');
    }
          
    
}

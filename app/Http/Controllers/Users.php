<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\printing_mc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\user_log;
use App\Models\qc_users;
use App\Models\sheet_mc_add;
use App\Models\thermo_mc_add;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Login;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\View;
use App\Models\sheet_ch_list;
use App\Models\thermo_check_list;
use App\Models\print_check_list;

class Users extends Controller
{
    //........................................ ADMIN USER CONTRALLERS...................................................................//

    public function addnewqcuser(){
        return view('add_qc_user');
    }
    public function loginAdmin(Request $req)
    {

                   //return DB::select("select * from users");

              
                       $req->validate([
                  
                           'email' => 'required|email|string|max:255',
                           'password'  => 'required',
               
               
                       ]);

                       $adminUser = User::where('user_email', trim($req->email))->first();
                       if ($adminUser) {
                        if (Hash::check(trim($req->password), $adminUser->password))  { //check the password
   
                   //add user info to session
                   $req->session()->put('AName', $adminUser->user_first_name);
                   $req->session()->put('uid',$adminUser->user_id);
                   $logUser = new user_log();
                   $logUser->user_name = $adminUser->user_first_name;
                   $logUser->user_log_email = $req->email;
                  // Add the current date
$logUser->login_date = date('Y-m-d');

// Add the current time
$logUser->login_time = date('H:i:s');
$rec = $logUser->save();
   
                   return redirect('dashboard');
                   
               } else {
                   return back()->with('fail', 'This password is not correct');
               }
           } else {
               return back()->with('fail', 'This email is not registered');
           } 
                    
                    

    }

                   ///// Add Admin User to DB ///////
                   function viewAddAdmin() {
                    if (session()->has('AName')) {
                        $latestUserId = users::max('user_id');
                        $nextUserId = $latestUserId + 1;
            
                
                        return View::make('add_admin')->with('data', $nextUserId); 
                    }
                    
                    return view('admin');
                }

                public function addAdminPage(Request $req)
                {
                    // Add validation 
                    $req->validate([
                        'user_reg_no' => 'required|string|max:255|unique:users,user_reg_no',
                        'user_first_name' => 'required|string|max:255',
                        'user_last_name' => 'required|string|max:255',
                        'user_nic' => 'required|string|max:255|unique:users,user_nic',
                        'user_address' => 'required|string|max:255', 
                        'user_email' => 'required|email|string|max:255|unique:users,user_email',
                        'user_tp_number' => 'required|string|max:255|unique:users,user_tp',
                        'user_level' => 'required|string|max:255',
                        'InputPassword1' => 'required|string|min:6',
                        'confirmPassword' => 'required|min:6|same:InputPassword1',
                    ], [
                        'InputPassword1.confirmed' => 'The password confirmation does not match.',
                    ]);

            
                
                    try {
                        // Insert the new admin user record into the database
                        $adminUser = new User();
                        $adminUser->user_reg_no = $req->user_reg_no;

                if($req->hasfile('profile_picture')){
                    $file = $req->file('profile_picture');
                    $extension = $file->getClientOriginalExtension();

                    $filename = time().'.'.$extension;
                    $file->move('uploads/admin_pro/',$filename);
                    $adminUser->user_profile_picture = $filename;
                }
                        

                        $adminUser->user_first_name = $req->user_first_name;
                        $adminUser->user_last_name = $req->user_last_name;
                        $adminUser->user_nic = $req->user_nic;
                        $adminUser->user_address = $req->user_address;
                        $adminUser->user_email = $req->user_email;
                        $adminUser->user_tp = $req->user_tp_number;
                        $adminUser->user_level = $req->user_level;
                        $adminUser->password = Hash::make($req->InputPassword1);
                
                        $rec = $adminUser->save();
                
                        if ($rec) {
                            return back()->with('success', 'You have successfully added an admin.');
                        }
                    } catch (\Illuminate\Database\QueryException $e) {
                        if ($e->getCode() === '23000') {
                            // Duplicate entry error
                            return back()->with('fail', 'The admin user already exists.');
                        } else {
                            // Other query exceptions
                            return back()->with('error', 'somthing went wrong.');
                        }    
                    }
                }

                              ///// ..........View Admin User............... ///////

           
    function viewAdminUser(){

        if (session()->has('AName')) {

            $data =  User::all();
            
            return view('admin_view',['admin'=>$data]);

            }
        return view('admin_login');
       
    }
                 ///// .....................Delete Admin User..............  ///////


                 function adminDelete($id){

                    $data = User::where('user_id', $id)->first();
                    $data->delete();
            
                    return redirect('admin_view');
                
                    }

                    function qcDelete($id){

                        $data = qc_users::where('qc_id', $id)->first();
                        $data->delete();
                
                        return redirect('admin_view');
                    
                        }
  ///// Update Admin User to DB ///////
  function updateAdminUser(Request $req){
    //validate pasword
   
    $req->validate([
        'InputPassword1' => 'string|min:6',
        'confirmPassword' => 'min:6|same:InputPassword1',
    ], [
       // 'InputPassword1.confirmed' => 'The password confirmation does not match.',
    ]);
    // Find the existing admin user by ID
    $adminUser = User::find($req->user_id);

    if (!$adminUser) {
        return back()->with('error', 'User not found.');
    }

    // Update the user fields
    $adminUser->user_reg_no = $req->user_reg_no;
    $adminUser->user_first_name = $req->user_first_name;
    $adminUser->user_last_name = $req->user_last_name;
    $adminUser->user_nic = $req->user_nic;
    $adminUser->user_address = $req->user_address;
    $adminUser->user_email = $req->user_email;
    $adminUser->user_tp = $req->user_tp_number;
    $adminUser->user_level = $req->user_level;
    $adminUser->password = Hash::make($req->InputPassword1);

    if ($req->hasFile('profile_picture')) {
        $file = $req->file('profile_picture');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('uploads/admin_pro/', $filename);
        $adminUser->user_profile_picture = $filename;
    }

    // If you want to update the password, you can do it like this:
    if ($req->filled('InputPassword1')) {
        $adminUser->password = Hash::make($req->InputPassword1);
    }

    // Save the updated user
    $adminUser->save();

    if ($adminUser) {
        return back()->with('success', 'User updated successfully.');
    } else {
        return back()->with('error', 'Something went wrong.');
    }
}


        // edit admin view//
function userEdtview($id){

    $data = user::where('user_id', $id)->first();

   return view('edit_admin',['data'=>$data]);


}

function viewadminPro() {
    // Check if 'AName' session variable exists
    if (session()->has('AName')) {
        // Retrieve data for the user specified in the session
        $adminName = session('AName');
        $data = User::where('user_first_name', $adminName)->get();

        // Pass the filtered data to the view
        return view('admin_profile', ['admin' => $data]);
    }

    // Redirect to admin login if 'AName' session variable is not set
    return view('admin_login');
}

function dashboard() {
    
    // Check if 'AName' session variable exists
    if (session()->has('AName')) {
        // Retrieve data for the user specified in the session
        $adminName = session('AName');
        $data = qc_users::where('qc_first_name', $adminName)->get();
        
        // Pass the filtered data to the view
        $dashboard_data = array(
            'sheet_mc_count' => sheet_mc_add::where('mc_status',1)->count(),
            'thermo_mc_count' => thermo_mc_add::where('mc_status',1)->count(),
            'printing_mc_count' => printing_mc::where('mc_status',1)->count(),
            'sheet_daily'=>sheet_ch_list::where('sheet_chc_date',date('Y-m-d'))->orderBy('sheet_chc_id','desc')->count(),
            'thermo_daily'=>thermo_check_list::where('thermo_check_date',date('Y-m-d'))->orderBy('thermo_check_id','desc')->count(),
            'print_daily'=>print_check_list::where('print_che_date',date('Y-m-d'))->orderBy('print_che_id','desc')->count(),
            'msgs'=>Message::where('msg_to',session('uid'))->where('msg_to_utype',1)->orderBy('id','desc')->get(),
            'logs_sheet'=>sheet_ch_list::where('sheet_chc_date',date('Y-m-d'))->where('sheet_issues','>',0)->orderBy('sheet_chc_id','desc')->get(),
            'logs_forms'=>thermo_check_list::where('thermo_check_date',date('Y-m-d'))->where('thermo_issues','>',0)->orderBy('thermo_check_id','desc')->get(),
            'logs_prints'=>print_check_list::where('print_che_date',date('Y-m-d'))->where('print_issues','>',0)->orderBy('print_che_id','desc')->get(),
            'qcs'=>qc_users::all()
        );
        
        
        return view('dashboard', ['admin' => $data,'data'=>$dashboard_data]);
    }

    // Redirect to admin login if 'AName' session variable is not set
    return view('admin_login');
}




//-------------------------QC CONTRALL SECTION
function addqcuser(Request $req){
          // Add validation 
          $req->validate([
            'user_reg_no' => 'required|string|max:255|unique:qc_users,qc_reg_no',
            'user_first_name' => 'required|string|max:255',
            'user_last_name' => 'required|string|max:255',
            'user_nic' => 'required|string|max:255|unique:qc_users,qc_nic',
            'user_address' => 'required|string|max:255', 
            'user_email' => 'required|email|string|max:255|unique:qc_users,qc_email',
            'user_tp_number' => 'required|string|max:255|unique:qc_users,qc_tp',
        
            'InputPassword1' => 'required|string|min:6',
            'confirmPassword' => 'required|min:6|same:InputPassword1',
        ], [
            'InputPassword1.confirmed' => 'The password confirmation does not match.',
        ]);


        try {
            // Insert the new admin user record into the database
            $adminUser = new qc_users();
            $adminUser->qc_reg_no = $req->user_reg_no;

    if($req->hasfile('profile_picture')){
        $file = $req->file('profile_picture');
        $extension = $file->getClientOriginalExtension();

        $filename = time().'.'.$extension;
        $file->move('uploads/admin_pro/',$filename);
        $adminUser->qc_pro_pic = $filename;
    }
            

            $adminUser->qc_first_name = $req->user_first_name;
            $adminUser->qc_last_name = $req->user_last_name;
            $adminUser->qc_nic = $req->user_nic;
            $adminUser->qc_address = $req->user_address;
            $adminUser->qc_email = $req->user_email;
            $adminUser->qc_tp = $req->user_tp_number;
    
            $adminUser->qc_password = Hash::make($req->InputPassword1);
    
            $rec = $adminUser->save();
            if ($rec) {
                return back()->with('success', 'You have successfully added an admin.');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23000') {
                // Duplicate entry error
                return back()->with('fail', 'The admin user already exists.');
            } else {
                // Other query exceptions
                return back()->with('error', 'somthing went wrong.');
            }    
        }
}

function veiw_qc_user(){
    if (session()->has('AName')) {

        $data =  qc_users::all();
        
        return view('qc_view',['admin'=>$data]);

        }
    return view('qc_view');
}

function updateQc(Request $req){
    $req->validate([
        'InputPassword1' => 'string|min:6',
        'confirmPassword' => 'min:6|same:InputPassword1',
    ], [
        'InputPassword1.confirmed' => 'The password confirmation does not match.',
    ]);
    // Find the existing admin user by ID
    $adminUser = qc_users::find($req->qc_id);

    if (!$adminUser) {
        return back()->with('error', 'User not found.');
    }

    // Update the user fields
    $adminUser->qc_reg_no = $req->user_reg_no;
    $adminUser->qc_first_name = $req->qc_first_name;
    $adminUser->qc_last_name = $req->qc_last_name;
    $adminUser->qc_nic = $req->qc_nic;
    $adminUser->qc_address = $req->qc_address;
    $adminUser->qc_email = $req->qc_email;
    $adminUser->qc_tp = $req->qc_tp;

    $adminUser->qc_password = Hash::make($req->InputPassword1);

    if ($req->hasFile('profile_picture')) {
        $file = $req->file('profile_picture');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('uploads/admin_pro/', $filename);
        $adminUser->qc_pro_pic = $filename;
    }

    // If you want to update the password, you can do it like this:
    if ($req->filled('InputPassword1')) {
        $adminUser->qc_password = Hash::make($req->InputPassword1);
    }

    // Save the updated user
    $adminUser->save();

    if ($adminUser) {
        return back()->with('success', 'User updated successfully.');
    } else {
        return back()->with('error', 'Something went wrong.');
    }
}

function qcEdtview($id){

    $data = qc_users::where('qc_id', $id)->first();

   return view('qc_edit',['data'=>$data]);


}



function viewQcPro() {
    // Check if 'AName' session variable exists
    if (session()->has('QCName')) {
        // Retrieve data for the user specified in the session
        $adminName = session('QCName');
        $data = qc_users::where('qc_first_name', $adminName)->get();
        // Pass the filtered data to the view
        return view('qc_profile', ['admin' => $data]);
    }

    // Redirect to admin login if 'AName' session variable is not set
    return view('qc_login');
}


function qclogview(){
    if (session()->has('AName')) {

        $data =  User::all();
        
        return view('qc_log_list',['admin'=>$data]);

        }
    return view('qc_log_list');
}






//...................................................................................................................................................................................//
//.............................................QC Worker Section....................................................................................................................//
//.................................................................................................................................................................................//

//qc login
public function loginQc(Request $req)
{

               //return DB::select("select * from users");

          
                   $req->validate([
              
                       'email' => 'required|email|string|max:255',
                       'password'  => 'required',
           
           
                   ]);

                   $adminUser = qc_users::where('qc_email', trim($req->email))->first();
                   if ($adminUser) {
                    if (Hash::check($req->password, $adminUser->qc_password))  { //check the password

               //add user info to session
               $req->session()->put('QCName', $adminUser->qc_first_name);
               $req->session()->put('uid',$adminUser->qc_id);


               return redirect('qc_dashboard');
               
           } else {
               return back()->with('fail', 'This password is not correct');
           }
       } else {
           return back()->with('fail', 'This email is not registered');
       } 
                
                

}
//user log list

function qc_dashboard(){
    if (session()->has('QCName')) {
        // Retrieve data for the user specified in the session
        $adminName = session('QCName');
        $data = qc_users::where('qc_first_name', $adminName)->get();

        // Pass the filtered data to the view
        $dashboard_data = array(
            'sheet_mc_count' => sheet_mc_add::where('mc_status',1)->count(),
            'thermo_mc_count' => thermo_mc_add::where('mc_status',1)->count(),
            'printing_mc_count' => printing_mc::where('mc_status',1)->count(),
            'sheet_daily'=>sheet_ch_list::where('sheet_chc_date',date('Y-m-d'))->where('created_by',session('uid'))->orderBy('sheet_chc_id','desc')->count(),
            'thermo_daily'=>thermo_check_list::where('thermo_check_date',date('Y-m-d'))->where('created_by',session('uid'))->orderBy('thermo_check_id','desc')->count(),
            'print_daily'=>print_check_list::where('print_che_date',date('Y-m-d'))->where('created_by',session('uid'))->orderBy('print_che_id','desc')->count(),
            'msgs'=>Message::where('msg_to',session('uid'))->where('msg_to_utype',2)->orderBy('id','desc')->get(),
            'admins'=>User::all(),
            'logs_sheet'=>sheet_ch_list::where('sheet_chc_date',date('Y-m-d'))->where('created_by',session('uid'))->where('sheet_issues','>',0)->orderBy('sheet_chc_id','desc')->get(),
            'logs_forms'=>thermo_check_list::where('thermo_check_date',date('Y-m-d'))->where('created_by',session('uid'))->where('thermo_issues','>',0)->orderBy('thermo_check_id','desc')->get(),
            'logs_prints'=>print_check_list::where('print_che_date',date('Y-m-d'))->where('created_by',session('uid'))->where('print_issues','>',0)->orderBy('print_che_id','desc')->get(),
        );
        
        
        return view('qc_dashboard_content', ['admin' => $data,'data'=>$dashboard_data]);
    }
}

function user_log(){
    if (session()->has('AName')) {

        $data =  user_log::all();
        
        return view('user_log',['admin'=>$data]);

        }
    return view('admin_login');
}

//view of the qc pro

}
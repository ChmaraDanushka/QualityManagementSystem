<?php

use App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users;
use App\Http\Controllers\sheetContoller;
use App\Http\Controllers\thermoformController;
use App\Http\Controllers\printingController;
/*use App\Http\Controllers\userController;
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//---------------- route for testing file//
Route::get('/testing', function () {
    return view('testing');
})->name('testing');

//---------------- route for welcome file//
Route::get('/welcome', function () {
    return view('welcome');
});
//---------------- route for admin login file//
Route::get('/', function () {
    return view('admin_login');
});
//---------------- route for admin layout file//
Route::get('/admin_layout', function () {
    return view('admin_layout');
});
Route::get('/add_admin', function () {
    return view('add_admin');
})->name('add_admin');

Route::get('/admin_profile', function () {
    return view('admin_profile');
})->name('admin_profile');
//---------------- route for admin layout data dashboard file//

Route::get('/dashboard', [Users::class, 'dashboard'])->name('dashboard');

//---------------- route for admin login post//
Route::post('login_admin', [Users::class, 'loginAdmin'])->name('login_admin');
//Route::get('add_admin', [Users::class,'viewAddAdmin'])->name('add_admin');
//---------------- route for add admin//
//Route::get('add_admin',[Users::class, 'addAdminUser'])->name('add_admin');
Route::post('add_admin_user', [Users::class, 'addAdminPage'])->name('add_admin_user');
Route::get('admin_view', [Users::class, 'viewAdminUser'])->name('admin_view');
//delete admins//
Route::get('delete_admin/{id}', [Users::class, 'adminDelete'])->name('delete_admin');

Route::get('delete_qc/{id}', [Users::class, 'qcDelete'])->name('delete_qc');

//get the Edit User
Route::get('edit_admin/{id}', [Users::class, 'userEdtview']);
//Update Edit User
Route::put('update_admin', [Users::class, 'updateAdminUser'])->name('update_admin');

//show user profile details
Route::get('admin_profile', [Users::class, 'viewadminPro'])->name('admin_profile');

//show user profile details
// Route::get('dashboard',[Users::class,'viewqcData'])->name('dashboard');

Route::get('/user_log', function () {
    return view('user_log');
})->name('user_log');
Route::get('user_log', [Users::class, 'user_log'])->name('user_log');


//............................QC PART..............................//


Route::get('add_qc_user', [Users::class, 'addnewqcuser'])->name('add_qc_user_view');
Route::post('add_qc_user', [Users::class, 'addqcuser'])->name('add_qc_user');
//view qc
Route::get('qc_view', [Users::class, 'veiw_qc_user'])->name('qc_view');
//edit qc
Route::get('qc_update/{id}', [Users::class, 'qcEdtview']);
Route::put('update_qc', [Users::class, 'updateQc'])->name('update_qc');
//qc log
Route::get('qc_log_list', [Users::class, 'qclogview'])->name('qc_log_list');


Route::get('qc_profile', [Users::class, 'viewQcPro'])->name('qc_profile');

//............................SHEET EXTRUDER PART..............................//

//view sheet mc
Route::get('sheet_mc_add', [sheetContoller::class, 'sheet_mc_view'])->name('sheet_mc_view');
Route::post('sheet_mc_add', [sheetContoller::class, 'sheetmcadd'])->name('sheet_mc_add');
//delete mc//
Route::get('delete_mc/{id}', [sheetContoller::class, 'delete_mc'])->name('delete_mc');




//............................SHEET EXTRUDER Matireal add..............................//
Route::get('/sheet_material_add', function () {
    return view('sheet_material_add');
})->name('sheet_material_add');
Route::post('sheet_material_add', [sheetContoller::class, 'sheet_material_add'])->name('sheet_material_add');
//view material
Route::get('sheet_material_add', [sheetContoller::class, 'sheet_material_view'])->name('sheet_material_view');
//delete mc//
Route::get('delete_material/{id}', [sheetContoller::class, 'delete_material'])->name('delete_material');




//............................SHEET EXTRUDER Product add..............................//

Route::get('/sheet_product', function () {
    return view('sheet_product');
})->name('sheet_product');
Route::post('sheet_product', [sheetContoller::class, 'add_sheet_product'])->name('sheet_add_product');
//view product
Route::get('sheet_product', [sheetContoller::class, 'sheet_product_view'])->name('sheet_product');
//delete sheet_product//
Route::get('delete_sheet_product/{id}', [sheetContoller::class, 'delete_sheet_product'])->name('delete_sheet_product');


//............................SHEET EXTRUDER ongoing Product ..............................//
Route::get('sheet_ongoing', [sheetContoller::class, 'sheet_ongoing'])->name('sheet_ongoing');

//............................SHEET EXTRUDER all Product ..............................//
Route::get('sheet_ongsheet_all_quality_pro', [sheetContoller::class, 'sheet_all'])->name('sheet_all_quality_pro');
// sheet check list all deta delete      
Route::get('delete_sheet_all_ch/{id}', [sheetContoller::class, 'delete_sheet_all'])->name('delete_sheet_all_ch');


//sheet ongoling product.............................................//


//............................THERMO FORMING PART..............................//

//view sheet mc
Route::get('thermo_mc_add', [thermoformController::class, 'thermo_mc_view'])->name('thermo_mc_view');
Route::post('thermo_mc_add', [thermoformController::class, 'thermo_mc_add'])->name('thermo_mc_add');
//delete mc//
Route::get('delete_thermo_mc/{id}', [thermoformController::class, 'thermo_mc_delete'])->name('delete_thermo_mc');


//view material
Route::get('thermo_product_add', [thermoformController::class, 'sheet_product_view'])->name('sheet_product_view');
Route::post('thermo_product_add', [thermoformController::class, 'thermo_product_add'])->name('thermo_product_add');
//delete thermo forming item//
Route::get('delete_thermo_pr/{id}', [thermoformController::class, 'delete_thermo_item'])->name('delete_thermo_pr');
//edit thermo forming items
Route::get('edit_thermo_pr/{id}', [thermoformController::class, 'editThermo']);
Route::put('thermo_item_edit', [thermoformController::class, 'update_thermo_item'])->name('thermo_item_edit');
//...................................................................................................................................................................................//
//.............................................qc dash thermo online check list....................................................................................................................//
//.................................................................................................................................................................................//

//get thermo forming data 
Route::get('thermo_form_check_list', [thermoformController::class, 'thermo_mc_checkList'])->name('thermo_form_check_list');
//add online check list 
Route::post('thermo_check', [thermoformController::class, 'thermo_check_add'])->name('thermo_check');

//ongoing ckeck list today qc_thermo_qa_history

Route::get('thermo_ongoing_checlist', [thermoformController::class, 'thermo_ongoing_checlist'])->name('thermo_ongoing_checlist');
Route::get('thermo_all_checklist', [thermoformController::class, 'thermo_all_checklist'])->name('thermo_all_checklist');


//............................PRINTING PART..............................//

//view pr matchines
Route::get('printing_add_mc', [printingController::class, 'print_mc_view'])->name('printing_view_mc');
Route::post('printing_add_mc', [printingController::class, 'printing_add_mc'])->name('printing_add_mc');

//view print customer
Route::get('print_customers_add', [printingController::class, 'print_cus_view'])->name('print_customers_add');
//delete print customer
Route::get('delete_print_cus/{id}', [printingController::class, 'print_cus_delete'])->name('delete_print_cus');
Route::get('delete_print_mc/{id}', [printingController::class, 'print_mc_delete'])->name('delete_print_mc');
//...................................................................................................................................................................................//
//.............................................qc dash print online check list....................................................................................................................//

Route::get('print_check_list', [printingController::class, 'ch_mc_view'])->name('print_check_list');
//add online check list 
Route::post('print_check', [printingController::class, 'print_check'])->name('print_check');
//............................FOIL PRINT PART..............................//

//...................................................................................................................................................................................//
//.............................................QC Worker Section....................................................................................................................//
//.................................................................................................................................................................................//

//qc login
Route::get('/qc_login', function () {
    return view('qc_login');
});
//qc login function
Route::post('login_qc', [Users::class, 'loginQc'])->name('login_qc');
//---------------- route for admin layout file//
Route::get('/qc_dashboard', [Users::class, 'qc_dashboard']);
//qc dashboard content
Route::get('/qc_dashboard_content', function () {
    if (session()->has('AName')) {

        return view('qc_dashboard_content');
    }
});




//...................................................................................................................................................................................//
//.............................................qc dash sheet online check list....................................................................................................................//
//.................................................................................................................................................................................//



//get sheet mc data 
Route::get('qc_sheet_checklist', [sheetContoller::class, 'get_mc_data'])->name('qc_sheet_checklist');
//add online check list
Route::post('sheet_online_checklist_add', [sheetContoller::class, 'sheet_online_checklist_add'])->name('sheet_online_checklist_add');

//view checklist data
Route::get('qc_sheet_quality_history', [sheetContoller::class, 'sheet_online_checklist_view'])->name('qc_sheet_quality_history');
//add material mixture

//get sheet product  data 
Route::get('qc_add_material_mixture', [sheetContoller::class, 'get_product_mixture'])->name('qc_add_material_mixture');
//add mixture
Route::post('sheet_mixture_add', [sheetContoller::class, 'sheet_mixture_add'])->name('sheet_mixture_add');

//user_log list


//sheet extruder machine start stop
Route::post('start-stop-sheet-machine/{id}', [sheetContoller::class, 'startStopMachine'])->name('start-stop-sheet-machine');

//thermo machine start stop
Route::post('start-stop-thermo-machine/{id}', [thermoformController::class, 'startStopMachine'])->name('start-stop-thermo-machine');

//print machine start stop
Route::post('start-stop-print-machine/{id}', [printingController::class, 'startStopMachine'])->name('start-stop-print-machine');


//recent checklists
Route::get('qc_sheet_quality_recent', [sheetContoller::class, 'qc_sheet_quality_recent'])->name('qc_sheet_quality_recent');

//recent thermolist
Route::get('thermo_form_quality_recent', [thermoformController::class, 'thermo_form_quality_recent'])->name('thermo_form_quality_recent');

//recent printlist
Route::get('printlist_quality_recent', [printingController::class, 'printlist_quality_recent'])->name('printlist_quality_recent');

//logout
Route::post('logout', [CommonController::class, 'logout'])->name('logout');

//logout qc
Route::post('qc_logout', [CommonController::class, 'qc_logout'])->name('qc_logout');

//ongoing printlist
Route::get('print_list_ongoing', [printingController::class, 'print_list_ongoing'])->name('print_list_ongoing');

//history printlist
Route::get('print_list_all', [printingController::class, 'print_list_all'])->name('print_list_all');

//reports section
Route::get('sheet-extruder-report',[CommonController::class,'sheet_extruder_report'])->name('sheet-extruder-report');
Route::post('genarate-sheet-extruder-report',[CommonController::class,'genarate_sheet_extruder_report'])->name('genarate-sheet-extruder-report');
Route::get('thermo-form-report',[CommonController::class,'thermo_form_report'])->name('thermo-form-report');
Route::post('genarate-thermo-form-report',[CommonController::class,'genarate_thermo_form_report'])->name('genarate-thermo-form-report');
Route::get('printing-report',[CommonController::class,'printing_report'])->name('printing-report');
Route::post('genarate-printing-report',[CommonController::class,'generate_printing_report'])->name('genarate-printing-report');


//sheet extruder products
Route::get('sheet_product_list',[sheetContoller::class,'sheet_product_list'])->name('sheet_product_list');

//thermo products
Route::get('thermo_product_list',[thermoformController::class,'thermo_product_list'])->name('thermo_product_list');

//printing products
Route::get('print_customers_list',[printingController::class,'print_customers_list'])->name('print_customers_list');

//printing customer add
Route::get('printing_cus_add',[printingController::class,'printing_cus_view'])->name('printing_cus_view');
Route::post('printing_cus_add',[printingController::class,'printing_cus_add'])->name('printing_cus_add');

//view material mixture
Route::get('view_material_mixture',[sheetContoller::class,'view_material_mixture'])->name('view_material_mixture');

//mark message read
Route::post('mark-message-read',[CommonController::class,'markMessageRead'])->name('mark-message-read');

//write message
Route::post('write-message',[CommonController::class,'writeMessage'])->name('write-message');
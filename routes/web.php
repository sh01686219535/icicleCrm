<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CreateAdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FacilitiesController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\InvestorPayController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PermissionAssignController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SubModuleController;
use App\Http\Controllers\SuspectController;
use App\Http\Controllers\TaskComentsController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskUpdateController;
use App\Http\Controllers\BookingPaymentController;
use App\Http\Controllers\ExcelController;
use App\Models\InvestorPay;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\TargetController;




Route::redirect('/', 'dashboard');
Route::match(['get', 'post'], '/register', [AdminAuthController::class, 'register'])->name('register');
Route::match(['get', 'post'], '/login', [AdminAuthController::class, 'login'])->name('login');
Route::match('get', '/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
Route::match(['get', 'post'], '/my-profile/{id}', [AdminAuthController::class, 'myProfile'])->name('my.profile');
Route::match(['get', 'post'], '/change/password/{id}', [AdminAuthController::class, 'changePassword'])->name('change.password');


Route::group(['middleware' => ['adminAuth']], function () {
    Route::match(['get'], '/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    ///investor
    Route::match(['get', 'post'], '/investor_create', [InvestorController::class, 'investor_create'])->name('investor_create');
    Route::match(['get', 'post'], '/investorApprove', [InvestorController::class, 'investorApprove'])->name('investorApprove');
    Route::post('/comment/{id}', [InvestorController::class, 'comment'])->name('commentPost');
    Route::match(['get'], '/approve/{id}', [InvestorController::class, 'approve'])->name('approve');
    Route::match(['get'], '/investorList', [InvestorController::class, 'investorList'])->name('investorList');
    Route::match(['get'], '/investor_delete/{id}', [InvestorController::class, 'investor_delete'])->name('investor_delete');
    Route::match(['get', 'post'], '/investor_show/{id}', [InvestorController::class, 'investorShow'])->name('investor_show');
    Route::match(['get', 'post'], '/investor_admin_show/{id}', [InvestorController::class, 'investorAdminShow'])->name('investor_admin_show');
    //add multipule investor
    Route::match(['get', 'post'], '/add/multipule/investor', [InvestorController::class, 'addMultipuleInvestor'])->name('add.multipule.investor');
    //ajax
    Route::match(['get','post'], '/getMultiInvestor', [AjaxController::class, 'getMultiInvestor'])->name('getMultiInvestor');
    //investor_org_show
    //investor_org_show
    Route::match(['get', 'post'], '/investor_org_show/{id}', [InvestorController::class, 'investor_org_show'])->name('investor_org_show');
    Route::get('/investor_edit/{id}', [InvestorController::class, 'investor_edit'])->name('investor_edit');
    Route::match(['get'], '/unpaidInvestor', [InvestorController::class, 'unpaidInvestor'])->name('unpaidInvestor');
    // payment List
    Route::match(['get'], '/paymentList/{id}', [InvestorController::class, 'paymentList'])->name('paymentList');
    Route::match(['get'], '/investorPayment.pdf/{id}', [InvestorController::class, 'investorPaymentPdf'])->name('investorPayment.pdf');
    //teamLeader.investor
    Route::match(['get'], '/teamLeader/investor', [InvestorController::class, 'teamLeaderInvestor'])->name('team.investor');

    //facilities Approval
    Route::match(['get', 'post'], '/facilities/approval', [FacilitiesController::class, 'facilitiesApproval'])->name('facilities.approval');
    Route::match(['get', 'post'], '/approve_facilities/{id}', [FacilitiesController::class, 'approveFacilities'])->name('approve_facilities');
    Route::match(['get', 'post'], '/facilitiesDelete/{id}', [FacilitiesController::class, 'facilitiesDelete'])->name('facilitiesDelete');
    Route::match(['get', 'post'], '/facilities_admin_show/{id}', [FacilitiesController::class, 'facilitiesAdminShow'])->name('facilities_admin_show');
    //Investor Booking register
    Route::match(['get', 'post'], '/booking/register', [BookingController::class, 'register'])->name('booking.register');
    //booking money
    Route::match(['get', 'post'], '/downPayment', [BookingPaymentController::class, 'downPayment'])->name('downPayment');


    //investor_pay
    Route::match(['get', 'post'], '/investor_pay', [InvestorPayController::class, 'investor_pay'])->name('investor_pay');
    Route::match(['get'], '/payment/list', [InvestorPayController::class, 'paymentList'])->name('payment.list');
    Route::match(['get'], '/investorPay_delete/{id}', [InvestorPayController::class, 'investorPayDelete'])->name('investorPay_delete');
    //employee
    Route::match(['get', 'post'], '/employee', [EmployeeController::class, 'employee'])->name('employee');
    //teamLeader
    Route::match(['get', 'post'], '/teamLeader', [EmployeeController::class, 'teamLeader'])->name('teamLeader');
    Route::match(['get'], '/employeeDelete/{id}', [EmployeeController::class, 'employeeDelete'])->name('employeeDelete');
    Route::match(['get', 'post'], '/employeeEdit/{id}', [EmployeeController::class, 'employeeEdit'])->name('employeeEdit');
    Route::match(['get'], '/teamDelete/{id}', [EmployeeController::class, 'teamDelete'])->name('teamDelete');
    Route::match(['get', 'post'], '/teamEdit/{id}', [EmployeeController::class, 'teamEdit'])->name('teamEdit');
    Route::match(['post'], '/fileUpdate/{id}', [InvestorController::class, 'fileUpdate'])->name('fileUpdate');
    Route::match(['get'], '/fileDownload/{id}', [InvestorController::class, 'fileDownload'])->name('fileDownload.pdf');
    //employee.list
    Route::match(['get'], '/employee/list', [EmployeeController::class, 'employeeList'])->name('employee.list');
    Route::match(['get'], '/cmoList', [EmployeeController::class, 'cmoList'])->name('cmoList');
    Route::match(['get','post'], '/cmoEdit/{id}', [EmployeeController::class, 'cmoEdit'])->name('cmoEdit');
    Route::match(['get'], '/cmoDelete/{id}', [EmployeeController::class, 'cmoDelete'])->name('cmoDelete');
    Route::match(['get'], '/gmList', [EmployeeController::class, 'gmList'])->name('gmList');
    Route::match(['get'], '/em/delete/{id}', [EmployeeController::class, 'emDelete'])->name('em.delete');
    //tasks
    Route::resource('tasks', TaskController::class);
    // task comments
    Route::match(['get', 'post'], '/tasks/coment/details/{id}', [TaskComentsController::class, 'tasksComentDetails'])->name('tasks.coment.details');
    //task Update Controller
    Route::get('/status/update/{id}', [TaskUpdateController::class, 'statusUpdate'])->name('status.update');

    //ajax route getName
    Route::match(['get'], '/getName', [AjaxController::class, 'getName'])->name('getName');
    Route::match(['get'], '/getAssist', [AjaxController::class, 'getAssist'])->name('getAssist');
    Route::match(['get'], '/getTeamLeader', [AjaxController::class, 'getTeamLeader'])->name('getTeamLeader');
    Route::match(['get'], '/ratio', [AjaxController::class, 'ratio'])->name('ratio');
    Route::match(['get'], '/getExitingAssist', [AjaxController::class, 'getExitingAssist'])->name('getExitingAssist');
    Route::match(['post'], '/getTeamSales', [AjaxController::class, 'getTeamSales'])->name('getTeamSales');
    Route::match(['post'], '/getTeam', [AjaxController::class, 'getTeam'])->name('getTeamLeader');
    Route::match(['post'], '/getGmSalesPerson', [AjaxController::class, 'getGmSalesPerson'])->name('getGmSalesPerson');
    Route::match(['post'], '/getGmTeamLeader', [AjaxController::class, 'getGmTeamLeader'])->name('getGmTeamLeader');

    //incentiveRatio
    Route::match(['get','post'],'/incentive/ratio',[ReportController::class,'incentiveRatio'])->name('incentive.ratio');
    //ajax-role
    Route::post('/get-permission', [AjaxController::class, 'getPermission'])->name('get-permission');
    //lead management
    Route::match(['get', 'post'], '/lead', [LeadController::class, 'Lead'])->name('lead');
    Route::match(['get', 'post'], '/leadEdit/{id}', [LeadController::class, 'leadEdit'])->name('leadEdit');
    Route::match(['get'], '/leadDelete/{id}', [LeadController::class, 'leadDelete'])->name('leadDelete');
    Route::match(['get'], '/lead/process', [LeadController::class, 'leadProcess'])->name('lead.process');
    Route::match(['get', 'post'], '/lead/to/investor/{id}', [LeadController::class, 'leadToInvestor'])->name('lead.to.investor');
    Route::match(['get', 'post'], '/lead/review/{id}', [LeadController::class, 'leadReview'])->name('lead.review');
    Route::match(['get', 'post'], '/review/lead/{id}', [LeadController::class, 'reviewLead'])->name('review.lead');
    //my.work.list
    Route::match(['get', 'post'], '/my/work/list', [LeadController::class, 'myWorkList'])->name('my.work.list');
    //report
    Route::match(['get'], '/work/report', [ReportController::class, 'workReport'])->name('work.report');
    Route::match(['get'], '/task/report', [ReportController::class, 'taskReport'])->name('task_report');
    //investor report
    Route::get('investorReport', [ReportController::class, 'investorReport'])->name('investorReport');
    Route::get('postInvestorReport', [ReportController::class, 'postInvestorReport'])->name('postInvestorReport');
    //Due report
    Route::get('dueReport', [ReportController::class, 'dueReport'])->name('dueReport');
    Route::get('/postDueReport', [ReportController::class, 'postDueReport'])->name('postDueReport');
    //targetReport
    Route::get('/targetReport', [ReportController::class, 'targetReport'])->name('targetReport');
    // monthly.target
    Route::match(['get'],'/monthly/target', [ReportController::class, 'monthlyTarget'])->name('monthly.target');

    //excel
    Route::get('/excel', [ExcelController::class, 'excel'])->name('excel');
    Route::get('/suspect/list/excel', [ExcelController::class, 'suspectListExcel'])->name('suspect.list.excel');
    Route::get('/active/excel', [ExcelController::class, 'activeExcel'])->name('active.excel');
    Route::get('/sgl/excel', [ExcelController::class, 'sglExcel'])->name('sgl.excel');
    Route::get('/junk/excel', [ExcelController::class, 'junkExcel'])->name('junk.excel');
    Route::get('/lead/investor/excel', [ExcelController::class, 'leadInvestorExcel'])->name('lead.investor.excel');
    Route::get('/investor/Export', [ExcelController::class, 'investorExport'])->name('investor-export');
    //pdf
    //bookingPdf.list
    Route::match(['get'], '/bookingPdf/{id}', [PdfController::class, 'bookingPdf'])->name('bookingPdf');
    //downPdf.list
    Route::match(['get'], '/downPdf/{id}', [PdfController::class, 'downPdf'])->name('downPdf');
    //investor.list
    Route::match(['get'], '/investorPdf/{id}', [PdfController::class, 'investorPdf'])->name('investor.list');
    //investorPay_view
    Route::match(['get'], '/investorPay_view/{id}', [InvestorPayController::class, 'investorPay_view'])->name('investorPay_view');
    //investorPay_print
    Route::match(['get'], '/investorPay_print/{id}', [PdfController::class, 'investorPay_print'])->name('investorPay_print');
    //unpaid.pdf
    Route::match(['get'], '/unpaid/pdf', [PdfController::class, 'unpaidPdf'])->name('unpaid.pdf');
    // module route
    Route::get('/module', [ModuleController::class, 'module'])->name('module');
    Route::get('/add-module', [ModuleController::class, 'addModule'])->name('add.module');
    Route::post('/store-module', [ModuleController::class, 'storeModule'])->name('store.module');
    Route::get('/edit-module/{id}', [ModuleController::class, 'editModule'])->name('edit.module');
    Route::post('/update-module', [ModuleController::class, 'updateModule'])->name('update.module');
    Route::get('/delete-module/{id}', [ModuleController::class, 'deleteModule'])->name('delete.module');
    // sub Module route
    Route::get('/subModule', [SubModuleController::class, 'subModule'])->name('subModule');
    Route::get('/add-subModule', [SubModuleController::class, 'addSubModule'])->name('add.subModule');
    Route::post('/store-subModule', [SubModuleController::class, 'storeSubModule'])->name('store.subModule');
    Route::get('/edit-subModule/{id}', [SubModuleController::class, 'editSubModule'])->name('edit.subModule');
    Route::post('/update-subModule', [SubModuleController::class, 'updateSubModule'])->name('update.subModule');
    Route::get('/delete-subModule/{id}', [SubModuleController::class, 'deleteSubModule'])->name('delete.subModule');
    //role

    // role route
    Route::get('/role', [RoleController::class, 'role'])->name('role');
    Route::get('/add-role', [RoleController::class, 'addRole'])->name('add.role');
    Route::post('/store-role', [RoleController::class, 'storeRole'])->name('store.role');
    Route::get('/edit-role/{id}', [RoleController::class, 'editRole'])->name('edit.role');
    Route::post('/update-role', [RoleController::class, 'updateRole'])->name('update.role');
    Route::get('/delete-role/{id}', [RoleController::class, 'deleteRole'])->name('delete.role');
    Route::match(['get'], '/preview', [InvestorController::class, 'previewInvestor'])->name('preview.investor');
    Route::match(['get'], '/multiplepreview', [InvestorController::class, 'multiplepreviewInvestor'])->name('preview.multipleinvestor');
    //creating admin

    Route::get('/admin-list', [CreateAdminController::class, 'adminList'])->name('adminList');
    Route::post('/admin-list', [CreateAdminController::class, 'list'])->name('list');

    Route::get('/create-admin', [CreateAdminController::class, 'createAdmin'])->name('create-admin');
    Route::post('/create-admin', [CreateAdminController::class, 'adminCreate'])->name('adminCreate');

    Route::get('/edit-admin/{id}', [CreateAdminController::class, 'showEditAdmin'])->name('showEditAdmin');
    Route::post('/edit-admin/{id}', [CreateAdminController::class, 'editAdmin'])->name('editAdmin');

    Route::get('/delete-admin/{id}', [CreateAdminController::class, 'deleteAdmin'])->name('deleteAdmin');

    // Permission Route
    Route::get('/permission', [RolePermissionController::class, 'permission'])->name('permission');
    Route::get('/add-permission', [RolePermissionController::class, 'addPermission'])->name('add-permission');
    Route::post('/store-permission', [RolePermissionController::class, 'storePermission'])->name('store.permission');
    Route::get('/edit-permission/{id}', [RolePermissionController::class, 'editPermission'])->name('edit.permission');
    Route::post('/update-permission', [RolePermissionController::class, 'updatePermission'])->name('update.permission');
    Route::get('/delete-permission/{id}', [RolePermissionController::class, 'deletePermission'])->name('delete.permission');

    //access-control
    Route::get('/access-control', [PermissionAssignController::class, 'showAccessControl'])->name('access-control');
    Route::post('/access-control', [PermissionAssignController::class, 'accessControl'])->name('accessControl');
    Route::get('/add-assign-permission', [PermissionAssignController::class, 'addAssignPermission'])->name('add-assign-permission');
    Route::get('/edit-assign-permission/{id}', [PermissionAssignController::class, 'showEditAssignPermission'])->name('showEdit-assign-permission');
    Route::post('/edit-assign-permission', [PermissionAssignController::class, 'editAssignPermission'])->name('edit-assign-permission');
    Route::get('/delete-assign-permission/{id}', [PermissionAssignController::class, 'deleteAssignPermission'])->name('delete-assign-permission');
    //target Management admin
    Route::get('/target/assign/admin',[TargetController::class,'targetAssignAdmin'])->name('target.assign.admin');
    Route::post('/store/assign/target',[TargetController::class,'storeAssignAdmin'])->name('store.assign.target');
    Route::get('/target/admin/edit/{id}',[TargetController::class,'targetAdminEdit'])->name('target.admin.edit');
    Route::post('/update/assign/target/{id}',[TargetController::class,'updateAssignTarget'])->name('update.assign.target');
    Route::get('/target/admin/delete/{id}',[TargetController::class,'targetAdminDelete'])->name('target.admin.delete');

    //target Management teamLeader
    Route::get('/target/assignt/eamLeader',[TargetController::class,'TeamLeaderShow'])->name('target.assign.teamLeader');
    Route::post('/store/assign/target/team',[TargetController::class,'TeamLeaderStore'])->name('store.assign.target.team');
    Route::get('/target/team/edit/{id}',[TargetController::class,'TeamLeaderEdit'])->name('target.team.edit');
    Route::post('/update/assign/team/{id}',[TargetController::class,'TeamLeaderUpdate'])->name('update.assign.team');
    Route::get('/target/team/delete/{id}',[TargetController::class,'TeamLeaderDelete'])->name('target.team.delete');

    //MPL list
    Route::get('/mpl/list', [SuspectController::class, 'mplList'])->name('mpl.list');
    Route::get('/sgl/list', [SuspectController::class, 'sglList'])->name('sgl.list');
    Route::get('/active/suspect/list', [SuspectController::class, 'activeSuspectList'])->name('active.suspect.list');
    Route::get('/junk/suspect/list', [SuspectController::class, 'junk_suspect_list'])->name('junk.suspect.list');
    Route::get('/client/suspect/list', [SuspectController::class, 'client_suspect_list'])->name('client.suspect.list');
    //mpl.edit
    Route::match(['get', 'post'], '/mpl/edit/{id}', [SuspectController::class, 'mplEdit'])->name('mpl.edit');
    // sgl.edit
    Route::match(['get', 'post'], '/sgl/edit/{id}', [SuspectController::class, 'sglEdit'])->name('sgl.edit');
    // active.edit
    // Route::match(['get', 'post'], '/active/edit/{id}', [SuspectController::class, 'activedit'])->name('activeList.edit');
    // junk.edit
    Route::match(['get', 'post'], '/active/edit/{id}', [SuspectController::class, 'junkEdit'])->name('junk.edit');

    //rules and permission
    Route::get('create-role', function () {
        // $permission = Permission::create(['name' => 'edit articles']);
        $user = auth('admin')->user();
        $access = $user->can('edit articles');
        if ($access) {
            return 'has permitted';
        } else {
            return 'has not permitted';
        }
        // $user->givePermissionTo('edit articles');
        return $user->can('delete articles');
    });

    //user todays  work
    Route::get('/today/work/{id}', [UserController::class, 'todayWork'])->name('today.work');
    //todo work
    Route::get('/todo/work/{id}', [UserController::class, 'todoork'])->name('todo.work');
});

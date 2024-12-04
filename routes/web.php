<?php

use App\Exports\LeadEnqueryExport;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Web\AdvanceSalaryController;
use App\Http\Controllers\Web\AppSettingController;
use App\Http\Controllers\Web\AssetAssignmentController;
use App\Http\Controllers\Web\AssetController;
use App\Http\Controllers\Web\AssetTypeController;
use App\Http\Controllers\Web\AttachmentController;
use App\Http\Controllers\Web\AttendanceController;
use App\Http\Controllers\Web\BranchController;
use App\Http\Controllers\Web\BrandsController;
use App\Http\Controllers\Web\ClientController;
use App\Http\Controllers\Web\CompanyController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\DataExportController;
use App\Http\Controllers\Web\DepartmentController;
use App\Http\Controllers\Web\EmployeeLogOutRequestController;
use App\Http\Controllers\Web\EmployeeSalaryController;
use App\Http\Controllers\Web\FeatureController;
use App\Http\Controllers\Web\FollowUpController;
use App\Http\Controllers\Web\FollowUpSettingController;
use App\Http\Controllers\Web\GeneralSettingController;
use App\Http\Controllers\Web\HolidayController;
use App\Http\Controllers\Web\LeadEnquiriesController;
use App\Http\Controllers\Web\LeadsSettingController;
use App\Http\Controllers\Web\LeaveController;
use App\Http\Controllers\Web\LeaveTypeController;
use App\Http\Controllers\Web\NFCController;
use App\Http\Controllers\Web\NoticeController;
use App\Http\Controllers\Web\NotificationController;
use App\Http\Controllers\Web\OfficeTimeController;
use App\Http\Controllers\Web\OverTimeSettingController;
use App\Http\Controllers\Web\PaymentCurrencyController;
use App\Http\Controllers\Web\PaymentMethodController;
use App\Http\Controllers\Web\PostController;
use App\Http\Controllers\Web\PrivacyPolicyController;
use App\Http\Controllers\Web\ProcurementController;
use App\Http\Controllers\Web\ProjectController;
use App\Http\Controllers\Web\QrCodeController;
use App\Http\Controllers\Web\RegularizationController;
use App\Http\Controllers\Web\RoleController;
use App\Http\Controllers\Web\RouterController;
use App\Http\Controllers\Web\RequirementController;
use App\Http\Controllers\Web\SalaryComponentController;
use App\Http\Controllers\Web\SalaryGroupController;
use App\Http\Controllers\Web\SalaryHistoryController;
use App\Http\Controllers\Web\SalaryTDSController;
use App\Http\Controllers\Web\StaticPageContentController;
use App\Http\Controllers\Web\SupportController;
use App\Http\Controllers\Web\TadaAttachmentController;
use App\Http\Controllers\Web\TadaController;
use App\Http\Controllers\Web\TaskChecklistController;
use App\Http\Controllers\Web\TaskCommentController;
use App\Http\Controllers\Web\TaskController;
use App\Http\Controllers\Web\TeamMeetingController;
use App\Http\Controllers\Web\TimeLeaveController;
use App\Http\Controllers\Web\UnderTimeSettingController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\VendorController;
use App\Http\Controllers\Web\VendorRegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Auth::routes([
    'register' => false,
    'login' => false,
    'logout' => false,
]);

Route::get('/', function () {
    return redirect()->route('admin.login');
});

/** Crm Enquery route */

Route::get('/leadenquiry', [LeadEnquiriesController::class, 'index'])->name('leadenquiry.index');

Route::post('leadenquiry', [LeadEnquiriesController::class, 'store'])->name('leadenquiry.store');

// Lead Form
Route::get('/leadform', function () {
    return view('leadform.index');
});

// Requirement Module

Route::get('requirement', [RequirementController::class, 'index'])->name('requirement.index');

/** app privacy policy route */
Route::get('privacy', [PrivacyPolicyController::class, 'index'])->name('privacy-policy');
Route::get('vendor/register', [VendorRegisterController::class, 'viewRegistrationForm'])->name('vendor.register');
Route::post('vendor/create', [VendorRegisterController::class, 'store'])->name('vendor.create');

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['web'],
], function () {
    Route::get('login', [AdminAuthController::class, 'showAdminLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login.process');

    Route::group(['middleware' => ['admin.auth', 'permission']], function () {

        Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        /** User route */
        Route::resource('users', UserController::class);
        Route::get('users/toggle-status/{id}', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
        Route::get('users/export/forms', [UserController::class, 'exportForm'])->name('users.exportForm');

        Route::get('employees/import-csv', [UserController::class, 'employeeImport'])->name('employees.import-csv.show');
        Route::post('employees/import-csv', [UserController::class, 'importEmployee'])->name('employees.import-excel.store');

        Route::get('users/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
        Route::get('users/change-workspace/{id}', [UserController::class, 'changeWorkSpace'])->name('users.change-workspace');
        Route::get('users/get-company-employee/{branchId}', [UserController::class, 'getAllCompanyEmployeeDetail'])->name('users.getAllCompanyUsers');
        Route::post('users/change-password/{userId}', [UserController::class, 'changePassword'])->name('users.change-password');
        Route::get('users/force-logout/{userId}', [UserController::class, 'forceLogOutEmployee'])->name('users.force-logout');

        /** company route */
        Route::resource('company', CompanyController::class);

        /** branch route */
        Route::resource('branch', BranchController::class);
        Route::get('branch/toggle-status/{id}', [BranchController::class, 'toggleStatus'])->name('branch.toggle-status');
        Route::get('branch/delete/{id}', [BranchController::class, 'delete'])->name('branch.delete');

        /** Department route */
        Route::resource('departments', DepartmentController::class);
        Route::get('departments/toggle-status/{id}', [DepartmentController::class, 'toggleStatus'])->name('departments.toggle-status');
        Route::get('departments/delete/{id}', [DepartmentController::class, 'delete'])->name('departments.delete');
        Route::get('departments/get-All-Departments/{branchId}', [DepartmentController::class, 'getAllDepartmentsByBranchId'])->name('departments.getAllDepartmentsByBranchId');

        /** post route */
        Route::resource('posts', PostController::class);
        Route::get('posts/toggle-status/{id}', [PostController::class, 'toggleStatus'])->name('posts.toggle-status');
        Route::get('posts/delete/{id}', [PostController::class, 'delete'])->name('posts.delete');
        Route::get('posts/get-All-posts/{deptId}', [PostController::class, 'getAllPostsByBranchId'])->name('posts.getAllPostsByBranchId');

        /** roles & permissions route */
        Route::resource('roles', RoleController::class);
        Route::get('roles/toggle-status/{id}', [RoleController::class, 'toggleStatus'])->name('roles.toggle-status');
        Route::get('roles/delete/{id}', [RoleController::class, 'delete'])->name('roles.delete');
        Route::get('roles/permissions/{roleId}', [RoleController::class, 'createPermission'])->name('roles.permission');
        Route::put('roles/assign-permissions/{roleId}', [RoleController::class, 'assignPermissionToRole'])->name('role.assign-permissions');

        /** office_time route */
        Route::resource('office-times', OfficeTimeController::class);
        Route::get('office-times/toggle-status/{id}', [OfficeTimeController::class, 'toggleStatus'])->name('office-times.toggle-status');
        Route::get('office-times/delete/{id}', [OfficeTimeController::class, 'delete'])->name('office-times.delete');

        /** branch_router route */
        Route::resource('routers', RouterController::class);
        Route::get('routers/toggle-status/{id}', [RouterController::class, 'toggleStatus'])->name('routers.toggle-status');
        Route::get('routers/delete/{id}', [RouterController::class, 'delete'])->name('routers.delete');

        /** holiday route */
        Route::get('holidays/import-csv', [HolidayController::class, 'holidayImport'])->name('holidays.import-csv.show');
        Route::post('holidays/import-csv', [HolidayController::class, 'importHolidays'])->name('holidays.import-csv.store');
        Route::resource('holidays', HolidayController::class);
        Route::get('holidays/toggle-status/{id}', [HolidayController::class, 'toggleStatus'])->name('holidays.toggle-status');
        Route::get('holidays/delete/{id}', [HolidayController::class, 'delete'])->name('holidays.delete');

        /** app settings */
        Route::get('app-settings/index', [AppSettingController::class, 'index'])->name('app-settings.index');
        Route::get('app-settings/toggle-status/{id}', [AppSettingController::class, 'toggleStatus'])->name('app-settings.toggle-status');
        Route::get('app-settings/changeTheme', [AppSettingController::class, 'changeTheme'])->name('app-settings.change-theme');

        /** General settings */
        Route::resource('general-settings', GeneralSettingController::class);
        Route::get('general-settings/delete/{id}', [GeneralSettingController::class, 'delete'])->name('general-settings.delete');

        /** Leave route */
        Route::resource('leaves', LeaveTypeController::class);
        Route::get('leaves/toggle-status/{id}', [LeaveTypeController::class, 'toggleStatus'])->name('leaves.toggle-status');
        Route::get('leaves/toggle-early-exit/{id}', [LeaveTypeController::class, 'toggleEarlyExit'])->name('leaves.toggle-early-exit');
        Route::get('leaves/delete/{id}', [LeaveTypeController::class, 'delete'])->name('leaves.delete');
        Route::get('leaves/get-leave-types/{earlyExitStatus}', [LeaveTypeController::class, 'getLeaveTypesBasedOnEarlyExitStatus']);

        /** Company Content Management route */
        Route::resource('static-page-contents', StaticPageContentController::class);
        Route::get('static-page-contents/toggle-status/{id}', [StaticPageContentController::class, 'toggleStatus'])->name('static-page-contents.toggle-status');
        Route::get('static-page-contents/delete/{id}', [StaticPageContentController::class, 'delete'])->name('static-page-contents.delete');

        /** Notification route */
        Route::get('notifications/get-nav-notification', [NotificationController::class, 'getNotificationForNavBar'])->name('nav-notifications');
        Route::resource('notifications', NotificationController::class);
        Route::get('notifications/toggle-status/{id}', [NotificationController::class, 'toggleStatus'])->name('notifications.toggle-status');
        Route::get('notifications/delete/{id}', [NotificationController::class, 'delete'])->name('notifications.delete');
        Route::get('notifications/send-notification/{id}', [NotificationController::class, 'sendNotificationToAllCompanyUser'])->name('notifications.send-notification');

        //Vendor route
        Route::resource('procurement_request', VendorRegisterController::class);

        /** Attendance route */
        Route::resource('attendances', AttendanceController::class);
        Route::get('employees/attendance/check-in/{companyId}/{userId}', [AttendanceController::class, 'checkInEmployee'])->name('employees.check-in');
        Route::get('employees/attendance/check-out/{companyId}/{userId}', [AttendanceController::class, 'checkOutEmployee'])->name('employees.check-out');
        Route::get('employees/attendance/delete/{id}', [AttendanceController::class, 'delete'])->name('attendance.delete');
        Route::get('employees/attendance/change-status/{id}', [AttendanceController::class, 'changeAttendanceStatus'])->name('attendances.change-status');
        Route::get('employees/attendance/{type}', [AttendanceController::class, 'dashboardAttendance'])->name('dashboard.takeAttendance');

        //Attendance Regularization
        Route::resource('regularization', RegularizationController::class);
        Route::get('regularization/approve/{id}', [RegularizationController::class, 'approveRegularization'])->name('regularization.approveRegularization');
        Route::get('regularization/reject/{id}', [RegularizationController::class, 'rejectRegularization'])->name('regularization.rejectRegularization');
        Route::post('ajax-regularization', [RegularizationController::class, 'checkAttendance'])->name('ajaxRegularizationModal');
        Route::post('create-regularization', [RegularizationController::class, 'createRegularization'])->name('createAjaxRegularization');

        /** Leave route */
        Route::get('employees/leave-request', [LeaveController::class, 'index'])->name('leave-request.index');
        Route::post('leave-request/store', [LeaveController::class, 'storeLeaveRequest'])->name('employee-leave-request.store');
        Route::get('employees/leave-request/show/{leaveId}', [LeaveController::class, 'show'])->name('leave-request.show');
        Route::put('employees/leave-request/status-update/{leaveRequestId}', [LeaveController::class, 'updateLeaveRequestStatus'])->name('leave-request.update-status');
        Route::get('leave-request/create', [LeaveController::class, 'createLeaveRequest'])->name('leave-request.create');
        Route::get('employees/leave-request/add', [LeaveController::class, 'addLeaveRequest'])->name('leave-request.add');
        Route::post('employees/leave-request/add', [LeaveController::class, 'saveLeaveRequest'])->name('leave-request.save');

        /** Time Leave Route */
        Route::get('employees/time-leave-request', [TimeLeaveController::class, 'index'])->name('time-leave-request.index');
        Route::put('employees/time-leave-request/status-update/{leaveRequestId}', [TimeLeaveController::class, 'updateLeaveRequestStatus'])->name('time-leave-request.update-status');
        Route::get('employees/time-leave-request/show/{leaveId}', [TimeLeaveController::class, 'show'])->name('time-leave-request.show');
        Route::get('employees/time-leave-request/create', [TimeLeaveController::class, 'createLeaveRequest'])->name('time-leave-request.create');
        Route::post('employees/time-leave-request/store', [TimeLeaveController::class, 'storeLeaveRequest'])->name('time-leave-request.store');

        /**logout request Routes */
        Route::get('employee/logout-requests', [EmployeeLogOutRequestController::class, 'getAllCompanyEmployeeLogOutRequest'])->name('logout-requests.index');
        Route::get('employee/logout-requests/toggle-status/{employeeId}', [EmployeeLogOutRequestController::class, 'acceptLogoutRequest'])->name('logout-requests.accept');

        /** Notice route */
        Route::resource('notices', NoticeController::class);
        Route::get('notices/toggle-status/{id}', [NoticeController::class, 'toggleStatus'])->name('notices.toggle-status');
        Route::get('notices/delete/{id}', [NoticeController::class, 'delete'])->name('notices.delete');
        Route::get('notices/send-notice/{id}', [NoticeController::class, 'sendNotice'])->name('notices.send-notice');

        /** Team Meeting route */
        Route::resource('team-meetings', TeamMeetingController::class);
        Route::get('team-meetings/delete/{id}', [TeamMeetingController::class, 'delete'])->name('team-meetings.delete');
        Route::get('team-meetings/remove-image/{id}', [TeamMeetingController::class, 'removeImage'])->name('team-meetings.remove-image');

        /** Clients route */
        Route::post('clients/ajax/store', [ClientController::class, 'ajaxClientStore'])->name('clients.ajax-store');
        Route::resource('clients', ClientController::class);
        Route::get('clients/delete/{id}', [ClientController::class, 'delete'])->name('clients.delete');
        Route::get('clients/toggle-status/{id}', [ClientController::class, 'toggleIsActiveStatus'])->name('clients.toggle-status');

        /** leadenquiry route */
        // Route::resource('leadenquiry', CrmEnqueriesController::class);
        Route::get('/leadenquiry', [LeadEnquiriesController::class, 'list'])->name('leadenquiry.index');
        Route::get('/leadenquiry/{id}/edit', [LeadEnquiriesController::class, 'edit_crm'])->name('leadenquiry.edit');
        Route::put('leadenquiry/{id}', [LeadEnquiriesController::class, 'update'])->name('leadenquiry.update');
        Route::get('leadenquiry/get-users-by-department/{departmentId}', [LeadEnquiriesController::class, 'getUsersByDepartment'])->name('leadenquiry.getUsersByDepartment');
        // Route::get('leadenquiry/{id}',[LeadEnquiriesController::class, 'show'])->name('admin.leadenquiry.show');
        Route::get('leadenquiry/lead-enquiries/{id}', [LeadEnquiriesController::class, 'show'])->name('leadenquiry.show');
        Route::put('leadenquiry/lead-enquiries-delete/{id}', [LeadEnquiriesController::class, 'destroy'])->name('leadenquiry.destroy');
        // from Dropdown
        Route::post('leadenquiry/update-status', [LeadEnquiriesController::class, 'updateStatus'])->name('leadenquiry.updateStatus');
        Route::post('leadenquiry/update-agents', [LeadEnquiriesController::class, 'updateAgents'])->name('leadenquiry.updateAgents');
        // from checkbox
        Route::get('leadenquiry/get-lead-statuses', [LeadEnquiriesController::class, 'getLeadStatuses'])->name('leadenquiry.getLeadStatuses');
        Route::post('leadenquiry/update-lead-status', [LeadEnquiriesController::class, 'updateLeadStatus'])->name('leadenquiry.updateLeadStatus');

        Route::get('leadenquiry/get-lead-agents', [LeadEnquiriesController::class, 'getLeadAgents'])->name('leadenquiry.getLeadAgents');
        Route::post('leadenquiry/update-lead-agent', [LeadEnquiriesController::class, 'updateLeadAgent'])->name('leadenquiry.updateLeadAgent');

        // Store Lead Enquery Through ADD Lead Modal
        Route::post('leadenquiry/addleadstore', [LeadEnquiriesController::class, 'addleadstore'])->name('leadenquiry.addleadstore');

        // Lead Enquery Export and Import option
        Route::get('leadenquiry/export-leadenquery', function () {
            return Excel::download(new LeadEnqueryExport, 'LeadEnquery.xlsx');
        });
        Route::post('leadenquiry/import-leadenquery', [LeadEnquiriesController::class, 'import'])->name('leadenquiry.import');

        // from Swalfire after assign Agents
        Route::post('leadenquiry/update-lagents', [LeadEnquiriesController::class, 'updateLAgents'])->name('leadenquiry.update-lagents');
        Route::post('leadenquiry/update-lstatus', [LeadEnquiriesController::class, 'updateLStatus'])->name('leadenquiry.update-lstatus');

        Route::post('leadenquiry/delete-leads', [LeadEnquiriesController::class, 'deleteLeads'])->name('leadenquiry.deleteLeads');

        // Dashboard Follow up in swal fire
        Route::get('dashboard/followups', [DashboardController::class, 'showFollowUps']);

        // Follow Up Routes which is under the part of Lead Enquiry
        Route::post('leadenquiry/addfollowup/store', [LeadEnquiriesController::class, 'addfollowup_store'])->name('addfollowup.store');

        // Lead Setting
        Route::post('leads-setting/leadsetting/setting', [LeadsSettingController::class, 'setting'])->name('leadsetting.setting');
        Route::post('leads-setting/leadsetting/setting/customizeleadform', [LeadsSettingController::class, 'setting2'])->name('leadsetting.setting2');
        Route::post('leads-setting/update-lead-form', [LeadsSettingController::class, 'displayfield'])->name('leadsetting.displayfield');

        // THis is for Follow Up view as a modal
        Route::get('followuplist/followup/{id}', [FollowUpController::class, 'getFollowUpRemark'])->name('followuplist.remark');

        // Follow Up List followup.list
        Route::get('followuplist', [FollowUpController::class, 'index'])->name('followuplist.list');
        Route::put('followuplist/update/{id}', [FollowUpController::class, 'update'])->name('followuplist.update');
        Route::put('followuplist/follow-up-delete/{id}', [FollowUpController::class, 'followup_destroy'])->name('followuplist.destroy');

        // Follow Up Setting
        Route::get('followup-setting', [FollowUpSettingController::class, 'index'])->name('followupSetting.index');
        Route::post('followup-setting/store', [FollowUpSettingController::class, 'store'])->name('followupSetting.store');

        /** Leads Source setting */
        Route::get('leads-setting', [LeadsSettingController::class, 'index'])->name('leadsSetting.index');
        Route::post('leads-setting/leadsource/store', [LeadsSettingController::class, 'store'])->name('leadsource.store');
        Route::put('leads-setting/leadsource/update/{id}', [LeadsSettingController::class, 'update'])->name('leadsource.update');
        Route::put('leads-setting/lead-source-delete/{id}', [LeadsSettingController::class, 'destroy'])->name('leadsource.destroy');

        /** Leads Status setting */
        Route::post('leads-setting/leadstatus/store', [LeadsSettingController::class, 'leadstatus_store'])->name('leadstatus.store');

        Route::put('leads-setting/leadstatus/update/{id}', [LeadsSettingController::class, 'leadstatus_update'])->name('leadstatus.update');

        Route::put('leads-setting/lead-status-delete/{id}', [LeadsSettingController::class, 'leadstatus_destroy'])->name('leadstatus.destroy');

        Route::post('leads-setting/update-default-status', [LeadsSettingController::class, 'updateDefaultStatus'])->name('leads-setting.update-default-status');

        /** Leads Agent setting */
        Route::get('leads-setting/leadagent/create', [LeadsSettingController::class, 'leadagent_create'])->name('admin.leadagent.create');
        Route::post('leads-setting/leadagent/store', [LeadsSettingController::class, 'leadagent_store'])->name('leadagent.store');
        Route::put('leads-setting/lead-agent-delete/{id}', [LeadsSettingController::class, 'leadAgentDelete'])->name('leadagent.delete');

        /** Leads Category setting */
        Route::post('leads-setting/leadcategory/store', [LeadsSettingController::class, 'leadcategory_store'])->name('leadcategory.store');
        Route::put('leads-setting/leadcategory/update/{id}', [LeadsSettingController::class, 'leadcategory_update'])->name('leadcategory.update');

        Route::put('leads-setting/lead-category-delete/{id}', [LeadsSettingController::class, 'leadcategory_destroy'])->name('leadcategory.destroy');

        /** Project Management route */
        Route::resource('projects', ProjectController::class);
        Route::get('projects/delete/{id}', [ProjectController::class, 'delete'])->name('projects.delete');
        Route::get('projects/toggle-status/{id}', [ProjectController::class, 'toggleStatus'])->name('projects.toggle-status');
        Route::get('projects/get-assigned-members/{projectId}', [ProjectController::class, 'getProjectAssignedMembersByProjectId'])->name('projects.get-assigned-members');
        Route::get('projects/get-employees-to-add/{addEmployeeType}/{projectId}', [ProjectController::class, 'getEmployeesToAddTpProject'])->name('projects.add-employee');
        Route::post('projects/update-leaders', [ProjectController::class, 'updateLeaderToProject'])->name('projects.update-leader-data');
        Route::post('projects/update-members', [ProjectController::class, 'updateMemberToProject'])->name('projects.update-member-data');

        /** Project & Task Attachment route */
        Route::get('projects/attachment/create/{projectId}', [AttachmentController::class, 'createProjectAttachment'])->name('project-attachment.create');
        Route::post('projects/attachment/store', [AttachmentController::class, 'storeProjectAttachment'])->name('project-attachment.store');
        Route::get('tasks/attachment/create/{taskId}', [AttachmentController::class, 'createTaskAttachment'])->name('task-attachment.create');
        Route::post('tasks/attachment/store', [AttachmentController::class, 'storeTaskAttachment'])->name('task-attachment.store');
        Route::get('attachment/delete/{id}', [AttachmentController::class, 'deleteAttachmentById'])->name('attachment.delete');

        /** Task Management route */
        Route::resource('tasks', TaskController::class);
        Route::get('projects/task/create/{projectId}', [TaskController::class, 'createTaskFromProjectPage'])->name('project-task.create');
        Route::get('tasks/delete/{id}', [TaskController::class, 'delete'])->name('tasks.delete');
        Route::get('tasks/toggle-status/{id}', [TaskController::class, 'toggleStatus'])->name('tasks.toggle-status');

        /** Task Checklist route */
        Route::post('task-checklists/save', [TaskChecklistController::class, 'store'])->name('task-checklists.store');
        Route::get('task-checklists/edit/{id}', [TaskChecklistController::class, 'edit'])->name('task-checklists.edit');
        Route::put('task-checklists/update/{id}', [TaskChecklistController::class, 'update'])->name('task-checklists.update');
        Route::get('task-checklists/delete/{id}', [TaskChecklistController::class, 'delete'])->name('task-checklists.delete');
        Route::get('task-checklists/toggle-status/{id}', [TaskChecklistController::class, 'toggleIsCompletedStatus'])->name('task-checklists.toggle-status');

        /** Task Comments  route */
        Route::post('task-comment/store', [TaskCommentController::class, 'saveCommentDetail'])->name('task-comment.store');
        Route::get('task-comment/delete/{commentId}', [TaskCommentController::class, 'deleteComment'])->name('comment.delete');
        Route::get('task-comment/reply/delete/{replyId}', [TaskCommentController::class, 'deleteReply'])->name('reply.delete');

        /** Support route */
        Route::get('supports/get-all-query', [SupportController::class, 'getAllQueriesPaginated'])->name('supports.index');
        Route::get('supports/change-seen-status/{queryId}', [SupportController::class, 'changeIsSeenStatus'])->name('supports.changeSeenStatus');
        Route::put('supports/update-status/{id}', [SupportController::class, 'changeQueryStatus'])->name('supports.updateStatus');
        Route::get('supports/delete/{id}', [SupportController::class, 'delete'])->name('supports.delete');

        /** Tada route */
        Route::put('tadas/update-status/{id}', [TadaController::class, 'changeTadaStatus'])->name('tadas.update-status');
        Route::resource('tadas', TadaController::class);
        Route::get('tadas/delete/{id}', [TadaController::class, 'delete'])->name('tadas.delete');
        Route::get('tadas/toggle-active-status/{id}', [TadaController::class, 'toggleTadaIsActive'])->name('tadas.toggle-status');

        /** Tada Attachment route */
        Route::get('tadas/attachment/create/{tadaId}', [TadaAttachmentController::class, 'create'])->name('tadas.attachment.create');
        Route::post('tadas/attachment/store', [TadaAttachmentController::class, 'store'])->name('tadas.attachment.store');
        Route::get('tadas/attachment/delete/{id}', [TadaAttachmentController::class, 'delete'])->name('tadas.attachment-delete');

        /** Export data route */
        Route::get('leave-types-export', [DataExportController::class, 'exportLeaveType'])->name('leave-type-export');
        Route::get('leave-requests-export', [DataExportController::class, 'exportEmployeeLeaveRequestLists'])->name('leave-request-export');
        Route::get('employee-detail-export', [DataExportController::class, 'exportEmployeeDetail'])->name('employee-lists-export');
        Route::get('attendance-detail-export', [DataExportController::class, 'exportAttendanceDetail'])->name('attendance-lists-export');

        /** Asset Management route */
        Route::resource('asset-types', AssetTypeController::class, [
            'except' => ['destroy'],
        ]);
        Route::get('asset-types/delete/{id}', [AssetTypeController::class, 'delete'])->name('asset-types.delete');
        Route::get('asset-types/toggle-status/{id}', [AssetTypeController::class, 'toggleIsActiveStatus'])->name('asset-types.toggle-status');

        Route::resource('assets', AssetController::class, [
            'except' => ['destroy'],
        ]);
        Route::resource('asset_assignment', AssetAssignmentController::class, [
            'except' => ['destroy'],
        ]);
        Route::get('assets/delete/{id}', [AssetController::class, 'delete'])->name('assets.delete');
        Route::get('assets/toggle-status/{id}', [AssetController::class, 'changeAvailabilityStatus'])->name('assets.change-Availability-status');

        Route::resource('asset_assignment', AssetAssignmentController::class, [
            'except' => ['destroy'],
        ]);
        Route::get('/download-pdf', [AssetAssignmentController::class, 'downloadAssignmentPDF'])->name('download.pdf');
        Route::get('/download-return-pdf', [AssetAssignmentController::class, 'downloadReturnPDF'])->name('download.return.pdf');

        Route::get('asset-assignments/get-All-Assets/{assetType_id}', [AssetAssignmentController::class, 'getAllAssetsByAssetTypeId'])->name('assets.getAllAssetsByAssetTypeId');
        Route::post('asset-assignments/asset-return', [AssetAssignmentController::class, 'return'])->name('asset_return');

        // Procuremnets
        Route::resource('brands', BrandsController::class, [
            'except' => ['destroy'],
        ]);
        Route::get('brands/delete/{id}', [BrandsController::class, 'delete'])->name('brands.delete');
        Route::get('brands/toggle-status/{id}', [BrandsController::class, 'toggleIsActiveStatus'])->name('brands.toggle-status');

        // Procuremnets
        Route::resource('procurement', ProcurementController::class, [
            'except' => ['destroy'],
        ]);
        Route::get('procurement/show/{id}', [ProcurementController::class, 'show'])->name('procurement.show');
        Route::get('procurement/delete/{id}', [ProcurementController::class, 'delete'])->name('procurement.delete');
        Route::post('procurement/change-status/{id}', [ProcurementController::class, 'changeStatus'])->name('change-status-approve');
        Route::post('procurement/pause-status/{id}', [ProcurementController::class, 'pauseStatus'])->name('pauseStatus');
        Route::post('procurement/{id}/resume-status', [ProcurementController::class, 'resumeStatus'])->name('resumeStatus');
        Route::get('getQuotationDetails/{id}', [ProcurementController::class, 'getQuotationDetails'])->name('getQuotationDetails');
        Route::post('approveStatusQuotation/{id}', [ProcurementController::class, 'approveStatusQuotation'])->name('approveStatusQuotation');

        /** Salary Component route */
        Route::resource('salary-components', SalaryComponentController::class, [
            'except' => ['destroy', 'show'],
        ]);
        Route::get('salary-components/delete/{id}', [SalaryComponentController::class, 'delete'])->name('salary-components.delete');
        Route::get('salary-components/change-status/{id}', [SalaryComponentController::class, 'toggleSalaryComponentStatus'])->name('salary-components.toggle-status');

        /** Payment Methods route */
        Route::resource('payment-methods', PaymentMethodController::class, [
            'except' => ['destroy', 'show', 'edit'],
        ]);
        Route::get('payment-methods/delete/{id}', [PaymentMethodController::class, 'deletePaymentMethod'])->name('payment-methods.delete');
        Route::get('payment-methods/change-status/{id}', [PaymentMethodController::class, 'togglePaymentMethodStatus'])->name('payment-methods.toggle-status');

        /** Payment Currency route */
        Route::get('payment-currency', [PaymentCurrencyController::class, 'index'])->name('payment-currency.index');
        Route::post('payment-currency', [PaymentCurrencyController::class, 'updateOrSetPaymentCurrency'])->name('payment-currency.save');

        /** Salary TDS route */
        Route::resource('salary-tds', SalaryTDSController::class, [
            'except' => ['destroy', 'show'],
        ]);
        Route::get('salary-tds/delete/{id}', [SalaryTDSController::class, 'deleteSalaryTDS'])->name('salary-tds.delete');
        Route::get('salary-tds/change-status/{id}', [SalaryTDSController::class, 'toggleSalaryTDSStatus'])->name('salary-tds.toggle-status');

        /** Salary Group route */
        Route::resource('salary-groups', SalaryGroupController::class, [
            'except' => ['destroy', 'show'],
        ]);
        Route::get('salary-groups/delete/{id}', [SalaryGroupController::class, 'deleteSalaryGroup'])->name('salary-groups.delete');
        Route::get('salary-groups/change-status/{id}', [SalaryGroupController::class, 'toggleSalaryGroupStatus'])->name('salary-groups.toggle-status');

        /** Employee Salary route */
        Route::resource('employee-salaries', EmployeeSalaryController::class, [
            'except' => ['destroy', 'create', 'edit', 'update', 'store', 'show'],
        ]);
        Route::get('employee-salaries/update-cycle/{employeeId}/{cycle}', [EmployeeSalaryController::class, 'changeSalaryCycle'])->name('employee-salaries.update-salary-cycle');
        Route::post('employee-salaries/payroll-create', [EmployeeSalaryController::class, 'payrollCreate'])->name('employee-salaries.payroll-create');
        Route::get('employee-salaries/payroll', [EmployeeSalaryController::class, 'payroll'])->name('employee-salary.payroll');
        Route::get('employee-salaries/payroll/{payslipId}', [EmployeeSalaryController::class, 'viewPayroll'])->name('employee-salary.payroll-detail');
        Route::get('employee-salaries/payroll/{payslipId}/print', [EmployeeSalaryController::class, 'printPayslip'])->name('employee-salary.payroll-print');
        Route::get('employee-salaries/payroll/{payslipId}/edit', [EmployeeSalaryController::class, 'editPayroll'])->name('employee-salary.payroll-edit');
        Route::put('employee-salaries/payroll/{payslipId}/update', [EmployeeSalaryController::class, 'updatePayroll'])->name('employee-salary.payroll-update');
        Route::delete('employee-salaries/payroll/{payslipId}/delete', [EmployeeSalaryController::class, 'deletePayroll'])->name('employee-salary.payroll-delete');

        Route::get('employee-salaries/salary/create/{employeeId}', [EmployeeSalaryController::class, 'createSalary'])->name('employee-salaries.add');
        Route::post('employee-salaries/salary/{employeeId}', [EmployeeSalaryController::class, 'saveSalary'])->name('employee-salaries.store-salary');
        Route::get('employee-salaries/salary/edit/{employeeId}', [EmployeeSalaryController::class, 'editSalary'])->name('employee-salaries.edit-salary');
        Route::put('employee-salaries/salary/{employeeId}', [EmployeeSalaryController::class, 'updateSalary'])->name('employee-salaries.update-salary');
        Route::get('employee-salaries/salary/{employeeId}', [EmployeeSalaryController::class, 'deleteSalary'])->name('employee-salaries.delete-salary');

        Route::put('employee-salaries/{payslipId}/make-payment', [EmployeeSalaryController::class, 'makePayment'])->name('employee-salaries.make_payment');

        /** get weeks list */
        Route::get('employee-salaries/getWeeks/{year}', [EmployeeSalaryController::class, 'getWeeks'])->name('employee-salaries.get-weeks');

        /** Employee Salary History route */
        Route::get('employee-salaries/salary-update/{accountId}', [SalaryHistoryController::class, 'create'])->name('employee-salaries.increase-salary');
        Route::post('employee-salaries/salary-history/store', [SalaryHistoryController::class, 'store'])->name('employee-salaries.updated-salary-store');
        Route::get('employee-salaries/salary-increment-history/{employeeId}', [SalaryHistoryController::class, 'getEmployeeAllSalaryHistory'])->name('employee-salaries.salary-revise-history.show');

        Route::get('advance-salaries/setting/', [AdvanceSalaryController::class, 'setting'])->name('advance-salaries.setting');

        /** Advance Salary route */
        Route::resource('advance-salaries', AdvanceSalaryController::class, [
            'except' => ['destroy', 'store', 'edit'],
        ]);
        Route::get('advance-salaries/delete/{id}', [AdvanceSalaryController::class, 'delete'])->name('advance-salaries.delete');

        /** Payroll OverTime Setting route */

        Route::resource('overtime', OverTimeSettingController::class, [
            'except' => ['destroy'],
        ]);
        Route::get('overtime/delete/{id}', [OverTimeSettingController::class, 'delete'])->name('overtime.delete');
        Route::get('overtime/change-status/{id}', [OverTimeSettingController::class, 'toggleOTStatus'])->name('overtime.toggle-status');

        /** Payroll UnderTime Setting route */
        Route::resource('under-time', UnderTimeSettingController::class, [
            'except' => ['destroy'],
        ]);
        Route::get('under-time/delete/{id}', [UnderTimeSettingController::class, 'delete'])->name('under-time.delete');
        Route::get('under-time/change-status/{id}', [UnderTimeSettingController::class, 'toggleUTStatus'])->name('under-time.toggle-status');

        Route::resource('qr', QrCodeController::class, [
            'except' => ['destroy', 'show'],
        ]);
        Route::get('qr/delete/{id}', [QrCodeController::class, 'delete'])->name('qr.destroy');
        Route::get('qr/print/{id}', [QrCodeController::class, 'print'])->name('qr.print');

        Route::get('/nfc', [NFCController::class, 'index'])->name('nfc.index');
        Route::get('/nfc/delete/{id}', [NFCController::class, 'delete'])->name('nfc.destroy');

        /** app settings */
        Route::get('feature/index', [FeatureController::class, 'index'])->name('feature.index');
        Route::get('feature/toggle-status/{id}', [FeatureController::class, 'toggleStatus'])->name('feature.toggle-status');

        /** delete employee leave type */
        Route::get('employees/leave_type/delete/{id}', [UserController::class, 'deleteEmployeeLeaveType'])->name('employee_leave_type.delete');

        // Requirement Module
        Route::get('requirement', [RequirementController::class, 'manageRequirement'])->name('requirement.manageRequirement');

    });
});

Route::group([
    'prefix' => 'vendor',
    'as' => 'vendor.',
    'middleware' => ['web'], // Same middleware as admin
], function () {

    Route::group(['middleware' => ['vendor.auth', 'permission']], function () {
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('dashboard', [VendorController::class, 'index'])->name('dashboard');
        Route::get('profile', [VendorController::class, 'profile'])->name('profile');
        Route::get('billing', [VendorController::class, 'billing'])->name('billing');
        Route::get('orders', [VendorController::class, 'orders'])->name('orders');
        Route::get('products', [VendorController::class, 'products'])->name('products');

        // on Order page
        Route::post('quotation/store', [VendorController::class, 'storeQuotation'])->name('quotationsStore');
        Route::get('getAssetDetails/{id}', [VendorController::class, 'getAssetDetails'])->name('getAssetDetails');
        Route::get('sendquotation/{id}', [VendorController::class, 'sendquotation'])->name('sendquotation');
        Route::get('getQuotationDetails/{id}', [VendorController::class, 'getQuotationDetails'])->name('getQuotationDetails');
        Route::post('checkDeliverStatus/{id}', [VendorController::class, 'checkDeliverStatus'])->name('checkDeliverStatus');
        Route::post('setDeliver/{id}', [VendorController::class, 'setDeliver'])->name('setDeliver');
        Route::get('checkbill/{id}', [VendorController::class, 'checkBillData'])->name('checkBillData');
        Route::post('uploadBill/{id}', [VendorController::class, 'uploadBill'])->name('uploadBill');

        // On Dashboard Page
        Route::get('api/quotations/combined-chart-data', [VendorController::class, 'getCombinedChartData']);
        // Route::get('api/quotations/complete-orders-count', [VendorController::class, 'completeOrderChartData']);





    });
});

Route::fallback(function () {
    return view('errors.404');
});

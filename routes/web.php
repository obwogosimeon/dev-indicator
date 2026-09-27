<?php


Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/organization', 'HomeController@organization')->name('organization');
Route::get('/thankyou', 'HomeController@thankyou')->name('thankyou');
Route::get('/change-password', 'HomeController@showChangePasswordForm')->name('change-password');
Route::post('/changePassword', 'HomeController@changePassword')->name('changePassword');

Route::get('2fa', [App\Http\Controllers\TwoFAController::class, 'index'])->name('2fa.index');
Route::post('2fa', [App\Http\Controllers\TwoFAController::class, 'store'])->name('2fa.post');
Route::get('2fa/reset', [App\Http\Controllers\TwoFAController::class, 'resend'])->name('2fa.resend');

Route::group(['middleware' => ['auth']], function() {
    //Projects Management
    Route::resource('projects', 'ProjectController');
    Route::get('project-reports', 'ProjectController@projectreports')->name('project-reports');
    Route::get('project-implement', 'ProjectController@projectimplement')->name('project-implement');
    Route::get('project-plan', 'ProjectController@projectplan')->name('project-plan');
    Route::get('project-configure', 'ProjectController@projectconfigure')->name('project-configure');
    Route::get('project-reviews', 'ProjectController@projectreviews')->name('project-reviews');
    Route::get('project-documents', 'ProjectController@projectdocuments')->name('project-documents');
    //Project Implementation
    Route::post('edit/implementation/{id}', 'ProjectController@implementedit')->name('implementedit');
    Route::post('delete/implementation/{id}', 'ProjectController@implementdelete')->name('implementdelete');
    Route::post('dobudget/implementation/{id}', 'ProjectController@dobudget')->name('dobudget');
    Route::post('submit/implementation/{id}', 'ProjectController@submitreview')->name('submitreview');
    Route::post('reportsubmit/implementation/{id}', 'ProjectController@reportsubmit')->name('reportsubmit');
    Route::post('imptimeline/implementation/{id}', 'ProjectController@imptimeline')->name('imptimeline');
    Route::post('preview/implementation/{id}', 'ProjectController@impreview')->name('impreview');
    Route::post('implpdf/implementation/{id}', 'ProjectController@implpdf')->name('implpdf');
    Route::post('implexcel/implementation/{id}', 'ProjectController@implexcel')->name('implexcel');
    Route::post('implfulldownload/implementation/{id}', 'ProjectController@implfulldownload')->name('implfulldownload');

    Route::post('createIntervention', 'ProjectController@createIntervention')->name('createIntervention');
    Route::get('createwp/{id}', 'ProjectController@createwp')->name('createwp');
    Route::get('createindicatorwp/{id}', 'ProjectController@createindicatorwp')->name('createindicatorwp');
    Route::post('createworkplan', 'ProjectController@createworkplan')->name('createworkplan');
    Route::post('createactivitywp', 'ProjectController@createactivitywp')->name('createactivitywp');
    Route::post('createindicatorworkp', 'ProjectController@createindicatorworkp')->name('createindicatorworkp');
    Route::post('createwpcontainer', 'ProjectController@createwpcontainer')->name('createwpcontainer');
    Route::post('createimcontainer', 'ProjectController@createimcontainer')->name('createimcontainer');
    Route::post('createicontainer', 'ProjectController@createicontainer')->name('createicontainer');
    // Route::post('createwp/{id}', 'ProjectController@createwp')->name('createwp');
    Route::get('createwp/{id}', 'ProjectController@createwp')->name('createwp');
    // Route::post('editintervention', 'ProjectController@editintervention')->name('editintervention');

    Route::post('organization-assign', 'HomeController@organizationassign')->name('organization-assign');

    //Program Management
    Route::resource('programs', 'ProgramController');
    Route::get('reports/get', 'ProgramController@programreport')->name('programreport');
    Route::get('program/templates', 'ProgramController@programtemplates')->name('programtemplates');
    Route::get('program/configure', 'ProgramController@programconfigure')->name('programconfigure');
    Route::get('program/documents', 'ProgramController@programdocuments')->name('programdocuments');

    //Account Management
    Route::resource('accounts', 'AccountController');
    Route::get('funding/index', 'AccountController@funding')->name('fundingindex');
    Route::get('funding/create', 'AccountController@fundingcreate')->name('fundingcreate');
    Route::get('funding/edit/{id}', 'AccountController@fundingedit')->name('funding.edit');
    Route::post('funding/update/{id}', 'AccountController@fundingupdate')->name('funding.update');
    Route::get('funding/show/{id}', 'AccountController@fundingshow')->name('funding.show');
    Route::post('funding/store', 'AccountController@fundingstore')->name('fundingstore');

    Route::resource('reviews', 'ReviewController');

    //Log Frames Management
    Route::resource('logframes', 'LogFrameController');
    Route::post('add/goal/{id}', 'LogFrameController@addgoal');
    Route::post('add/outcome/{id}', 'LogFrameController@addoutcome');
    Route::post('add/output/{id}', 'LogFrameController@addoutput');
    Route::post('add/activity/{id}', 'LogFrameController@addactivity');

    Route::resource('currencies', 'CurrencyController');
    Route::resource('years', 'YearController');
    Route::resource('settings', 'SettingController');
    Route::resource('regions', 'RegionController');
    Route::resource('levels', 'LevelController');

    //Users Management
    Route::resource('users', 'UserController');

    Route::resource('roles', 'RoleController');
    Route::resource('departments', 'DepartmentController');

    //Organization Management
    Route::resource('organizations', 'OrganizationController');
    Route::post('inviteorganization', 'OrganizationController@inviteorganization');

    //System Packages
    Route::resource('packages', 'PackageTypeController');

    //System Settings
    Route::get('notification/settings', 'SettingController@notification')->name('notificationget');
    Route::get('notification/create', 'SettingController@createnotification')->name('notificationcreate');
    Route::post('notification/store', 'SettingController@storenotification')->name('notificationstore');

    //Reports
    Route::get('index/reports', 'ReportsController@index')->name('reportsindex');
    Route::get('projectreport/show/{id}', 'ReportsController@projectreportshow')->name('projectreportshow');
    Route::post('projectemplate/create', 'ReportsController@createtemplate')->name('createmplate');
    Route::post('templatedefinition/create', 'ReportsController@createdefinition')->name('createdefinition');
    Route::get('programreports', 'ReportsController@programreports')->name('programreports');
    Route::get('logframereports', 'ReportsController@logframereports')->name('logframereports');
    //Goals
    Route::resource('goals', 'GoalController');
    Route::post('addgoalindicator', 'GoalController@addgoalindicator')->name('addgoalindicator');

    //Goal Outcomes
    Route::resource('outcomes', 'OutcomeController');
    Route::post('addoutcomeactivity', 'OutcomeController@addoutcomeactivity')->name('addoutcomeactivity');
    Route::post('addoutcomeindicator', 'OutcomeController@addoutcomeindicator')->name('addoutcomeindicator');
    //Goal Activities
    Route::resource('activities', 'ActivityController');
    //Outcome Output
    Route::resource('outputs', 'OutputControlle');
    Route::post('addoutputactivity', 'OutputControlle@addoutputactivity')->name('addoutputactivity');
    Route::post('addoutputindicator', 'OutputControlle@addoutputindicator')->name('addoutputindicator');

    Route::get('api/funding1', function(){
        $id = Input::get('option');
        $activity = App\Intervention::where('activity_id', $id)->first();
        return $activity->funding1;
    });

    Route::get('api/organization', function(){
        $id = Input::get('option');
        $organization = App\Organization::find($id);
        return $organization->email;
    });

    Route::get('api/submittedemail', function(){
        $id = Input::get('option');
        $users = App\User::find($id);
        return $users->email;
    });

    Route::get('api/submiitedname', function(){
        $id = Input::get('option');
        $name = App\User::find($id);
        return $name->name;
    });

    Route::get('api/adminid', function(){
        $id = Input::get('option');
        $organization = App\Organization::find($id);
        $user = App\User::where('email', $organization->email)->first();
        return $user->id;
    });

    Route::get('api/inviteuser', function(){
        $id = Input::get('option');
        $user = App\User::find($id);
        return $user->email;
    });


    Route::get('api/getname', function(){
        $id = Input::get('option');
        $user = App\User::find($id);
        return $user->name;
    });


    Route::get('api/funding2', function(){
        $id = Input::get('option');
        $activity = App\Intervention::where('activity_id', $id)->first();
        return $activity->funding2;
    });


    Route::get('api/exchangeperiod', function(){
        $id = Input::get('option');
        $program = App\Program::find($id);
        $exchange = App\Currency::where('program_id', $program->id)->first();
        return $exchange->currency_name;
    });

    Route::get('api/fundingx', function(){
        $id = Input::get('option');
        $activity = App\Intervention::find($id);
        return $activity->funding3;
    });


    Route::get('api/baseline', function(){
        $id = Input::get('option');
        $indicator = App\Indicator::find($id);
        return $indicator->dbaseline;
    });


    Route::get('api/target', function(){
        $id = Input::get('option');
        $indicator = App\Indicator::find($id);
        return $indicator->dtarget;
    });

    Route::get('api/label', function(){
        $id = Input::get('option');
        $indicator = App\Indicator::find($id);
        return $indicator->dvalue;
    });

    Route::get('api/frequency', function(){
        $id = Input::get('option');
        $indicator = App\Indicator::find($id);
        return $indicator->reporting_frequency;
    });

    Route::get('api/showform', function(){
        $id = Input::get('option');
        $indicator = App\Indicator::find($id);
        return $indicator;
    });

    Route::get('api/des', function(){
        $id = Input::get('option');
        $indicator = App\Indicator::find($id);
        return $indicator->disaggregation;
    });

    Route::get('api/indicatortarget', function(){
        $id = Input::get('option');
        $indicator = App\Indicator::find($id);
        return $indicator->reporting_frequency;
    });

    Route::get('api/activityname', function(){
        $id = Input::get('option');
        $activity = App\Activity::find($id);
        return $activity->activity_title;
    });

    Route::get('api/planningtype', function(){
        $id = Input::get('option');
        $planningtype = App\WorkPlanContainer::find($id);
        return $planningtype->planning_type;
    });

    // Route::get('getnotificationcount', function()
    // {
    //     return config('global.notificationcount');
    // });
    // Route::get('getallnotifications', function()
    // {
    //     return config('global.notifcations');
    // });


    Route::resource('permissions', 'PermissionController');
    Route::post('createdocument', 'ProjectController@createdocument')->name('createdocument');
    Route::get('documentview/{id}', 'ProjectController@documentview')->name('documentview');
    Route::get('download/{id}', 'ProjectController@download')->name('download');

    Route::resource('documents', 'DocumentController');

    Route::get('editfunding1/{id}', 'ProjectController@endifunding1')->name('endifunding1');
    Route::get('editfunding2/{id}', 'ProjectController@endifunding2')->name('endifunding2');

    Route::post('/livetable/add_data', 'ProjectController@add_data')->name('livetable.add_data');


    Route::get('budgetupdate/{id}', 'ProjectController@editbudget')->name('editbudget');
    Route::post('updatebudget/{id}', 'ProjectController@updatebudget')->name('updatebudget');
    Route::post('impcontainer/submit/{id}', 'ProjectController@submitimcontainer')->name('submitimcontainer');

    Route::get('indicators/list/{id}', 'LogFrameController@getlogframeindicators')->name('getlogframeindicators');

    Route::get('/livesearch/action','ProjectController@search')->name('live_search.action');

    Route::get('indicatorupdate/{id}', 'ProjectController@indicatorupdate')->name('indicatorupdate');
    Route::post('updateindicator/{id}', 'ProjectController@updatebudget')->name('updatebudget');
    Route::post('updatebasecurrency/{id}', 'ProjectController@updatebasecurrency')->name('updatebasecurrency');

    //Goal Enties management {Activities && indicators}
    Route::get('goalentities/remove/{id}', 'LogFrameController@removegoalentities')->name('goal.remove.entiries');
    Route::get('goalentities/comment/{id}', 'LogFrameController@commentgoalentities')->name('goal.comment.entiries');
    Route::get('goalentities/edit/{id}', 'LogFrameController@editgoalentities')->name('goal.edit.entiries');

    //Outcome Enties management {Activities && indicators}
    Route::get('outcometities/remove/{id}', 'LogFrameController@removeoutcomeentities')->name('outcome.remove.entiries');
    Route::get('outcometities/comment/{id}', 'LogFrameController@commentoutcomeentities')->name('outcome.comment.entiries');
    Route::get('outcometities/edit/{id}', 'LogFrameController@editoutcomeentities')->name('outcome.edit.entiries');

    //Output Enties management {Activities && indicators}
    Route::get('outputetities/remove/{id}', 'LogFrameController@removeoutputentities')->name('output.remove.entiries');
    Route::get('outputetities/comment/{id}', 'LogFrameController@commentoutputentities')->name('output.comment.entiries');
    Route::get('outputetities/edit/{id}', 'LogFrameController@editoutputentities')->name('output.edit.entiries');

    //Activities Enties management {Activities && indicators}
    Route::get('activityetities/remove/{id}', 'LogFrameController@removeactivityentities')->name('activity.remove.entiries');
    Route::get('activityetities/comment/{id}', 'LogFrameController@commentactivityentities')->name('activity.comment.entiries');
    Route::get('activityetities/edit/{id}', 'LogFrameController@editactivityentities')->name('activity.edit.entiries');

    Route::get('editintervention/{id}', 'ProjectController@editintervention')->name('editintervention');
    Route::post('interventionsupdate', 'ProjectController@updateinterventions')->name('updateinterventions');
    Route::get('viewinterventions/{id}', 'ProjectController@viewinterventions')->name('viewinterventions');

    Route::post('addmember', 'OrganizationController@addmember')->name('addmember');
    Route::post('addprojectuser', 'ProjectController@inviteuser')->name('inviteuser');
    Route::post('addprogramuser', 'ProgramController@inviteuser')->name('inviteuserprogram');

    Route::get('addactivity/{id}/activity', 'GoalController@addactivity');
    Route::get('addactiyoutput/{id}/outcome', 'OutcomeController@addactivity');
    Route::resource('interventions', 'InterventionController');

    Route::get('barnotifications', 'OrganizationController@barnotify');
    Route::get('managebarnotify/{id}', 'OrganizationController@managebarnotify');
    Route::post('acceptinvite/{id}', 'OrganizationController@acceptinvite');
    Route::post('rejectinvite/{id}', 'OrganizationController@rejectinvite');
    Route::post('closeinvite/{id}', 'OrganizationController@closeinvite');

    Route::post('submit/intervention', 'ProjectController@submitintervention')->name('submitintervention');
    Route::post('cancel/intervention', 'ProjectController@cancelintervention')->name('cancelintervention');
    Route::post('approve/intervention', 'ProjectController@approveintervention')->name('approveintervention');
    Route::post('forward/intervention', 'ProjectController@forwardintervention')->name('forwardintervention');
    Route::post('reject/intervention', 'ProjectController@rejectintervention')->name('rejectintervention');
    Route::post('submit/workplan', 'ProjectController@submitworkplan')->name('submitworkplan');
    Route::post('cancel/workplan', 'ProjectController@cancelworkplan')->name('cancelworkplan');
        // Route::resource('goalsact', 'GoalController');

    Route::resource('indicators', 'IndicatorController');
    Route::resource('interventioncontainers', 'InterventionContainerController');
    Route::resource('workplancontainers', 'WorkPlanContainerController');

    //Updates
    Route::post('updategoal', 'ProjectController@updategoal')->name('updategoal');
    Route::post('updateactivitygoal', 'ProjectController@updateactivitygoal')->name('updateactivitygoal');
    Route::post('updateoutcomeactivity', 'ProjectController@updateoutcomeactivity')->name('updateoutcomeactivity');
    Route::post('updateoutputactivity', 'ProjectController@updateoutputactivity')->name('updateoutputactivity');
    Route::post('updateoutcome', 'ProjectController@updateoutcome')->name('updateoutcome');
    Route::post('updateoutput', 'ProjectController@updateoutput')->name('updateoutput');
    Route::post('updateindicatorgoal', 'ProjectController@updateindicatorgoal')->name('updateindicatorgoal');
    Route::post('updateoutcomeindicator', 'ProjectController@updateoutcomeindicator')->name('updateoutcomeindicator');
    Route::post('updateoutputindicator', 'ProjectController@updateoutputindicator')->name('updateoutputindicator');
    Route::post('budgetupdatexpense/{id}', 'ProjectController@budgetupdatexpense')->name('budget.update.expense');

    //Integrations
    //https://kf.kobo.ychira.com/
    Route::get('getkobo', 'KoboController@getkobo')->name('getkobo');
    Route::get('rstudio', 'RstudioController@rstudio')->name('rstudio');
    //https://jupyterhub.ychira.com/
    Route::get('jupyter', 'JupyterController@jupyter')->name('jupyter');


    Route::post('budgetexpense', 'ProjectController@budgetexpense')->name('budgetexpense');
    Route::get('updatebudget/{id}', 'BudgetController@updatexpense');
    Route::resource('budgets', 'BudgetController');

    

});
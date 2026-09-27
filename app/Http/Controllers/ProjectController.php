<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Project;
use App\Program;
use App\LogFrame;
use App\Goal;
use App\Currency;
use DB;
use Auth;
use App\User;
use App\WorkPlan;
use App\WorkPlanContainer;
use App\ImplementationContainer;
use App\Funding;
use App\Activity;
use App\Indicator;
use App\Outcome;
use App\Output;
use App\Intervention;
use App\Year;
use App\Budget;
use App\IndicatorTarget;
use App\Document;
use App\BudgetExpense;
use Spatie\Permission\Models\Role;
use App\BaseCurrency;
use App\ProjectUser;
use App\Notifications\AddUsertoProject;
use App\Notifications\SubmitInterventionContainer;
use App\InterventionContainer;
use App\BarNotification;
use App\Organization;
use App\OrgnizationInvite;
use App\Transaction;
use Validator;

class ProjectController extends Controller
{
    public function index()
    {
        $notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
        $notificationcount = DB::table('bar_notifications')
        ->where('status', '=', '01')
        ->where('user_id', Auth::user()->id)
        ->count();

        $loggedInUserId = Auth::id();
        $projectIds = ProjectUser::where('user_id', $loggedInUserId)->pluck('project_id');
        $projects = Project::whereIn('id', $projectIds)
        ->orWhere('created_by', $loggedInUserId)  
        ->get();


        return view('projects.index', compact('projects','notifcations','notificationcount'));
    }


    public function create()
    {  
        $notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
        $notificationcount = DB::table('bar_notifications')
        ->where('status', '=', '01')
        ->where('user_id', Auth::user()->id)
        ->count(); 
        $programs = Program::where('organization_id', Auth::user()->organization_id)->get();
        $logframes = LogFrame::where('organization_id', Auth::user()->organization_id)->get();
        $currencies = Currency::where('organization_id', Auth::user()->organization_id)->get();
        return view('projects.create', compact('programs', 'currencies', 'logframes','notifcations','notificationcount'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'project_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'program_id' => '',
            'logframe_id' => '',
            'exchange_period' => '',
            'description' => '',
            'reporting_frequency' => 'required'
        ]);

        $input = $request->all();
        $project = Project::create($input);
        toastr()
        ->positionClass('toast-top-center')
        ->addSuccess('Project Created Successfully.');
        return redirect()->route('projects.index');
    }

    public function show($id)
    {
        $projectshow = Project::find($id);
        // $years = Year::all();
        // dd($projectshow);
        $reportingf = $projectshow->reporting_frequency;
        // dd($reportingf);
        $program = Program::where('id', '=', $projectshow->program_id)->first();
        $years = Year::where('program_id', $program->id)->get();
        $logframes = LogFrame::where('id', '=', $program->log_frame_id)->first();
        $goalframe = null;
        if($logframes != null){
            $goalframe = Goal::where('log_frame_id', '=', $logframes->id)->first();
        }

        $loopgoals = null;
        if($logframes != null){
            $loopgoals = Goal::where('log_frame_id', $logframes->id)->get();
        }

        $outcomes2 = Outcome::all();
        $outputs2 = Output::all();
        $activity2 = Activity::all();
        $indicators2 = Indicator::all();
        $goaladctiv = Activity::all();
        $goalindicators = Indicator::all();
        $outoutindicator2 = Indicator::all();
        $outputactivity2 = Activity::all();



        // dd($goalframe);
        $activitygoal = null;
        if($goalframe != null){
            $activitygoal = Activity::where('goal_id', '=', $goalframe->id)
            ->Where('project_id', $id)
            ->get();
        }
        $goalindicator = null;
        if($goalframe != null){
            $goalindicator = Indicator::where('goal_id', '=', $goalframe->id)
            ->Where('project_id', $id)
            ->get();
        }
        $goaloutcomes = null;
        if($goalframe != null){
            $goaloutcomes = Outcome::where('program_id', '=', $program->id)
            ->orWhere('project_id', $id)
            ->get();
        }
        $outcome = null;
        if($goalframe != null){
            $outcome = Outcome::where('program_id', '=', $program->id)->orWhere('project_id', $id)->first();
        }

        $activityoutcome = null;
        if($outcome != null){
            $activityoutcome = Activity::where('outcome_id', '=', $outcome->id)
            ->Where('project_id', $id)
            ->get();
        }
        $outcomeindicator = null;
        if($outcome != null){
            $outcomeindicator = Indicator::where('outcome_id', '=', $outcome->id)->Where('project_id', $id)->get();
        }

        $projectoutput = null;
        if($outcome != null){
            $projectoutput = Output::Where('program_id', $program->id)
            ->Where('outcome_id', $outcome->id)
            ->orWhere('project_id', $id)
            ->get();
        }



        $outputone = null;
        if($outcome != null){
            $outputone = Output::where('outcome_id', '=', $outcome->id)
            ->Where('project_id', $id)
            ->orWhere('program_id', $program->id)
            ->first();
        }

        $outputactivity = null;
        if($outputone != null){
            $outputactivity = Activity::where('output_id', $outputone->id)
            ->Where('project_id', $id)
            ->orWhere('program_id', $program->id)
            ->get();
        }

        $outputindicator = null;
        if($outputone != null){
            $outputindicator = Indicator::where('output_id', $outputone->id)
            ->Where('project_id', $id)
            ->orWhere('program_id', $program->id)
            ->get();
        }

        $workplancontaines = WorkPlanContainer::where('project_id', '=', $id)->get();
        $implementation = ImplementationContainer::where('project_id', $id)->get();

        $workplancontaineract = WorkPlanContainer::where('project_id', '=', $id)
        ->where('planning_type', '=', 'Activity')->get();    

        $workplancontainerind = WorkPlanContainer::where('project_id', '=', $id)
        ->where('planning_type', '=', 'Indicator')->get();    

        $accounts =  DB::table('fundings')
        ->where('type', '=', 'Global')
        ->where('program_id', $program->id)
        ->get();

        $users = User::all();    


        $impcontainers = ImplementationContainer::where('project_id', $id)->get();
        $intervencontainers = InterventionContainer::where('project_id', $id)->get();
        $interventions = Intervention::where('project_id', '=',  $id)->get();  

        $sumcontainer = DB::table('intervention_containers')
        ->join('interventions', 'intervention_containers.id', '=', 'interventions.intervention_container_id')
        ->first();


        $purchases = DB::table('interventions')
        ->where('project_id', '=', $id)
        ->sum('interventions.total');

        // dd($purchases);

        $purchases1 = DB::table('interventions')
        ->where('project_id', '=', $id)
        ->sum('interventions.funding1');

        $purchases2 = DB::table('interventions')
        ->where('project_id', '=', $id)
        ->sum('interventions.funding2');

        $fundingonetotal = DB::table('budgets')
        ->where('project_id', $id)
        ->sum('budgets.annual_amounta');

        $fundingtwototal = DB::table('budgets')
        ->where('project_id', $id)
        ->sum('budgets.annual_amountb');

        $fundingtotal = DB::table('budgets')
        ->where('project_id', $id)
        ->sum('budgets.total');

        $activities = null;
        if($logframes != null){
            $activities = Activity::orWhere('project_id', $id)
            ->orWhere('program_id', $program->id)
        // ->orWhere('log_frame_id', $logframes->id)
                                // ->where('')
            ->get();
        }
                                // dd($activities);

        $reporting = DB::table('indicator_targets')
        ->where('reporting', '=', 'Monthly')
        ->where('project_id', $id)
        ->get();

        $arrayReport = $reporting->toArray();

        // dd($reporting);

        $reporting2 = DB::table('indicator_targets')
        ->where('reporting', '=', 'Bi-Monthly')
        ->where('project_id', $id)
        ->get();  

        $reporting3 = DB::table('indicator_targets')
        ->where('reporting', '=', 'Quaterly')
        ->where('project_id', $id)
        ->get(); 

        $reporting4 = DB::table('indicator_targets')
        ->where('reporting', '=', 'Semi-Annual')
        ->where('project_id', $id)
        ->get(); 

        $reporting5 = DB::table('indicator_targets')
        ->where('reporting', '=', 'Annual')
        ->where('project_id', $id)
        ->get();                                                              

                        // dd($reporting);

        // $budgets = Budget::where('project_id', $id)->get();

        $budgets = DB::table('budgets')
        ->leftJoin('budget_expenses', 'budgets.id', '=', 'budget_expenses.budget_id')
        ->leftJoin('implementation_containers', 'budget_expenses.implementation_container_id', '=', 'implementation_containers.id')
        ->select('budgets.id','workplan_name', 'annual_amounta', 'annual_amountb', 'work_plan_container_id', 'activity', 'total','budget_expenses.implementation_container_id', 'budget_expenses.expense_current_period_yearly1', 'budget_expenses.expense_current_period_yearly2', 'budget_expenses.budget_current_period_yearly1', 'budget_expenses.budget_current_period_yearly2', 'implementation_containers.planning_type', 'implementation_containers.reporting_frequency', 'budget_expenses.funding_id', 'budgets.annual_amounta', 'budgets.annual_amountb', 'budget_expenses.budget_id', 'budgets.work_plan_container_id','budget_expenses.budget_current_period_firstsemi1','budget_expenses.budget_current_period_firstsemi2','budget_expenses.expense_current_period_firstsemi1','budget_expenses.expense_current_period_firstsemi2','budget_expenses.budget_current_period_secondsemi1','budget_expenses.budget_current_period_secondsemi2','budget_expenses.expense_current_period_secondsemi1','budget_expenses.expense_current_period_secondsemi2','budget_expenses.budget_current_period_firstq1','budget_expenses.budget_current_period_firstq2','budget_expenses.expense_current_period_firstq1','budget_expenses.expense_current_period_firstq2','budget_expenses.budget_current_period_secondq1','budget_expenses.budget_current_period_secondq2','budget_expenses.expense_current_period_secondq1','budget_expenses.expense_current_period_secondq2','budget_expenses.budget_current_period_thirdq1','budget_expenses.budget_current_period_thirdq2','budget_expenses.expense_current_period_thirdq1','budget_expenses.expense_current_period_thirdq2','budget_expenses.budget_current_period_lastq1','budget_expenses.budget_current_period_lastq2','budget_expenses.expense_current_period_lastq1','budget_expenses.expense_current_period_lastq2','budget_expenses.budget_current_period_monthone1','budget_expenses.budget_current_period_monthone2','budget_expenses.expense_current_period_monthone1','budget_expenses.expense_current_period_monthone2','budget_expenses.budget_current_period_monthtwo1','budget_expenses.budget_current_period_monthtwo2','budget_expenses.expense_current_period_monthtwo1','budget_expenses.expense_current_period_monthtwo2','budget_expenses.budget_current_period_monththree1','budget_expenses.budget_current_period_monththree2','budget_expenses.expense_current_period_monththree1','budget_expenses.expense_current_period_monththree2','budget_expenses.budget_current_period_monthfour1','budget_expenses.budget_current_period_monthfour2','budget_expenses.expense_current_period_monthfour1','budget_expenses.expense_current_period_monthfour2','budget_expenses.budget_current_period_monthfive1','budget_expenses.budget_current_period_monthfive2','budget_expenses.expense_current_period_monthfive1','budget_expenses.expense_current_period_monthfive2','budget_expenses.budget_current_period_monthsix1','budget_expenses.budget_current_period_monthsix2','budget_expenses.expense_current_period_monthsix1','budget_expenses.expense_current_period_monthsix2','budget_expenses.budget_current_period_monthseven1','budget_expenses.budget_current_period_monthseven2','budget_expenses.expense_current_period_monthseven1','budget_expenses.expense_current_period_monthseven2','budget_expenses.budget_current_period_montheight1','budget_expenses.budget_current_period_montheight2','budget_expenses.expense_current_period_montheight1','budget_expenses.expense_current_period_montheight2','budget_expenses.budget_current_period_monthnine1','budget_expenses.budget_current_period_monthnine2','budget_expenses.expense_current_period_monthnine1','budget_expenses.expense_current_period_monthnine2','budget_expenses.budget_current_period_monthten1','budget_expenses.budget_current_period_monthten2','budget_expenses.expense_current_period_monthten1','budget_expenses.expense_current_period_monthten2','budget_expenses.budget_current_period_montheleven1','budget_expenses.budget_current_period_montheleven2','budget_expenses.expense_current_period_montheleven1','budget_expenses.expense_current_period_montheleven2','budget_expenses.budget_current_period_monththwelve1','budget_expenses.budget_current_period_monththwelve2','budget_expenses.expense_current_period_monththwelve1','budget_expenses.expense_current_period_monththwelve2')
        ->where('budgets.project_id', $id)
        ->get();

        $budgetexpense = BudgetExpense::where('project_id', $id)->get();
        $implementation_container_id = ImplementationContainer::where('project_id', $id)->get();

        $budget = DB::table('budgets')
        ->leftJoin('budget_expenses', 'budgets.id', '=', 'budget_expenses.budget_id')

                    // ->leftJoin('implementation_containers', 'budget_expenses.implementation_container_id', '=', 'implementation_containers.id')
                    // ->whereJsonContains('budget_expenses.implementation_container_id', $implementation_container_id) 
        ->select('workplan_name', 'budget_expenses.budget_current_period_yearly1', 'budget_expenses.budget_current_period_yearly2','budget_expenses.expense_current_period_yearly1', 'budget_expenses.expense_current_period_yearly2', 'budgets.annual_amounta', 'budgets.annual_amountb', 'budget_expenses.implementation_container_id', 'budget_expenses.budget_id', 'budget_expenses.budget_current_period_firstsemi1','budget_expenses.budget_current_period_firstsemi2','budget_expenses.expense_current_period_firstsemi1','budget_expenses.expense_current_period_firstsemi2','budget_expenses.budget_current_period_secondsemi1','budget_expenses.budget_current_period_secondsemi2','budget_expenses.expense_current_period_secondsemi1','budget_expenses.expense_current_period_secondsemi2','budget_expenses.budget_current_period_firstq1','budget_expenses.budget_current_period_firstq2','budget_expenses.expense_current_period_firstq1','budget_expenses.expense_current_period_firstq2','budget_expenses.budget_current_period_secondq1','budget_expenses.budget_current_period_secondq2','budget_expenses.expense_current_period_secondq1','budget_expenses.expense_current_period_secondq2','budget_expenses.budget_current_period_thirdq1','budget_expenses.budget_current_period_thirdq2','budget_expenses.expense_current_period_thirdq1','budget_expenses.expense_current_period_thirdq2','budget_expenses.budget_current_period_lastq1','budget_expenses.budget_current_period_lastq2','budget_expenses.expense_current_period_lastq1','budget_expenses.expense_current_period_lastq2','budget_expenses.budget_current_period_monthone1','budget_expenses.budget_current_period_monthone2','budget_expenses.expense_current_period_monthone1','budget_expenses.expense_current_period_monthone2','budget_expenses.budget_current_period_monthtwo1','budget_expenses.budget_current_period_monthtwo2','budget_expenses.expense_current_period_monthtwo1','budget_expenses.expense_current_period_monthtwo2','budget_expenses.budget_current_period_monththree1','budget_expenses.budget_current_period_monththree2','budget_expenses.expense_current_period_monththree1','budget_expenses.expense_current_period_monththree2','budget_expenses.budget_current_period_monthfour1','budget_expenses.budget_current_period_monthfour2','budget_expenses.expense_current_period_monthfour1','budget_expenses.expense_current_period_monthfour2','budget_expenses.budget_current_period_monthfive1','budget_expenses.budget_current_period_monthfive2','budget_expenses.expense_current_period_monthfive1','budget_expenses.expense_current_period_monthfive2','budget_expenses.budget_current_period_monthsix1','budget_expenses.budget_current_period_monthsix2','budget_expenses.expense_current_period_monthsix1','budget_expenses.expense_current_period_monthsix2','budget_expenses.budget_current_period_monthseven1','budget_expenses.budget_current_period_monthseven2','budget_expenses.expense_current_period_monthseven1','budget_expenses.expense_current_period_monthseven2','budget_expenses.budget_current_period_montheight1','budget_expenses.budget_current_period_montheight2','budget_expenses.expense_current_period_montheight1','budget_expenses.expense_current_period_montheight2','budget_expenses.budget_current_period_monthnine1','budget_expenses.budget_current_period_monthnine2','budget_expenses.expense_current_period_monthnine1','budget_expenses.expense_current_period_monthnine2','budget_expenses.budget_current_period_monthten1','budget_expenses.budget_current_period_monthten2','budget_expenses.expense_current_period_monthten1','budget_expenses.expense_current_period_monthten2','budget_expenses.budget_current_period_montheleven1','budget_expenses.budget_current_period_montheleven2','budget_expenses.expense_current_period_montheleven1','budget_expenses.expense_current_period_montheleven2','budget_expenses.budget_current_period_monththwelve1','budget_expenses.budget_current_period_monththwelve2','budget_expenses.expense_current_period_monththwelve1','budget_expenses.expense_current_period_monththwelve2')
        ->where('budgets.project_id', $id)
                    // ->whereJsonContains('budget_expenses.implementation_container_id', $budgetexpense)
                    // ->groupBy('workplan_name')
        ->get();

        $mappedBudgets = [];

        foreach ($budget as $item) {
            $containerIds = json_decode($item->implementation_container_id, true);

            if (is_array($containerIds)) {
                foreach ($containerIds as $containerId) {
                    $mappedBudgets[$containerId][] = $item;
                }
            }
        }

                    // dd($containerIds);



        // $expensepreviousperiod = DB::table('budget_expenses')
        //                         ->leftJoin('budgets', 'budget_expenses.budget_id', '=', 'budgets.id')
        //                         ->leftJoin('implementation_containers', 'budget_expenses.implementation_container_id', '=', 'implementation_containers.id')
        //                         ->select('budget_expenses.expense_current_period1', 'budget_expenses.expense_current_period2','implementation_containers.reporting_frequency')   
        //                         ->where('budget_expenses.project_id', $id)->first();    

        $budgetper = DB::table('budgets') 
        ->select('id as budgetid')
        ->where('project_id', $id)
        ->get();                           

                    // dd($budgetper);

        $indicatortargets = IndicatorTarget::where('project_id', $id)->get();   
        // dd($indicatortargets);

        // $impcontainers  


        $budgetannuala = DB::table('budgets')
        ->where('project_id', '=', $id)
        ->sum('budgets.annual_amounta');

        $budgetannualb = DB::table('budgets')
        ->where('project_id', '=', $id)
        ->sum('budgets.annual_amountb');

        $impcontainer = ImplementationContainer::where('project_id', $id)->get();

        // dd($impcontainer);

        if ($projectshow->reporting_frequency = 'Quaterly' && $impcontainer->reporting_frequency = '1'){

            $totalcurrentperid = DB::table('budget_expenses')
            ->where('project_id', '=', $id)
            ->sum('budget_expenses.budget_current_period_firstq1');

            $totalexpensecurrent = DB::table('budget_expenses')
            ->where('project_id', '=', $id)
            ->sum('budget_expenses.expense_current_period_firstq1');

            $totalcurrentperid2 = DB::table('budget_expenses')
            ->where('project_id', '=', $id)
            ->sum('budget_expenses.budget_current_period_firstq2');

            $totalexpensecurrent2 = DB::table('budget_expenses')
            ->where('project_id', '=', $id)
            ->sum('budget_expenses.expense_current_period_firstq2');

        } elseif($projectshow->reporting_frequency = 'Quaterly' && $impcontainer->reporting_frequency = '2'){

         $totalcurrentperid = DB::table('budget_expenses')
         ->where('project_id', '=', $id)
         ->sum('budget_expenses.budget_current_period_firstq2');

         $totalexpensecurrent = DB::table('budget_expenses')
         ->where('project_id', '=', $id)
         ->sum('budget_expenses.expense_current_period_firstq2');

         $totalcurrentperid2 = DB::table('budget_expenses')
         ->where('project_id', '=', $id)
         ->sum('budget_expenses.budget_current_period_firstq2');

         $totalexpensecurrent2 = DB::table('budget_expenses')
         ->where('project_id', '=', $id)
         ->sum('budget_expenses.expense_current_period_firstq2');
     }





     $budgetexpense = BudgetExpense::where('project_id', $id)->get();

        // $budgetexpense = DB::table('budget_expenses')

     $currencies =  DB::table('currencies')
                    // ->where('type', '=', 'Global')
     ->where('program_id', $program->id)
     ->get();


     $roles = Role::where('category', '=', 'project')->get();

     $basecurrency = BaseCurrency::all();

     $projectusers = DB::table('project_users')
     ->join('users', 'project_users.id', '=', 'users.id')
     ->select('users.name as name', 'users.id as id', 'users.last_name as last_name')
     ->where('project_users.project_id', $id)->get();


     $projectusers1 = DB::table('organizations')
     ->join('users', 'organizations.id', '=', 'users.organization_id')
     ->select('users.name as name', 'users.id as id', 'users.last_name as last_name')
     ->orWhere('users.organization_id', Auth::user()->organization_id)
     ->orWhere('organizations.parent_id', Auth::user()->organization_id)
     ->get();                


     $notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
     $notificationcount = DB::table('bar_notifications')
     ->where('status', '=', '01')
     ->where('user_id', Auth::user()->id)
     ->count();

     $documents = Document::where('project_id', $id)
     ->get();

     $projectexpenses = Transaction::where('project_id', $id)->get();

        // dd($projectshow);

     return view('projects.show',compact('projectshow', 'accounts', 'users', 
        'workplancontaineract', 'impcontainers', 'interventions', 'purchases', 'goalframe', 
        'activitygoal', 'goalindicator', 'goaloutcomes', 'activityoutcome', 
        'outcomeindicator', 'projectoutput', 'outputone', 'outputactivity', 'logframes', 
        'activities', 'outcome', 'outputindicator', 'years', 
        'fundingonetotal', 'fundingtwototal', 'fundingtotal', 'reporting', 
        'reporting2', 'reporting3', 'reporting4', 'reporting5','budgets', 
        'indicatortargets', 'purchases1', 'purchases2', 'documents', 'budgetannuala', 
        'budgetannualb', 'budgetexpense', 'totalcurrentperid', 'totalexpensecurrent', 
        'totalcurrentperid2', 'totalexpensecurrent2', 'roles', 'currencies', 
        'basecurrency', 'loopgoals', 'outcomes2','outputs2', 'activity2', 
        'indicators2','goaladctiv','goalindicators', 'projectusers', 
        'intervencontainers','notifcations','notificationcount',
        'outoutindicator2','outputactivity2', 'budgetper', 'implementation', 'budget', 'workplancontainerind', 'workplancontaines', 'projectexpenses', 'reportingf', 'projectusers1'));
 }


 public function inviteuser(Request $request)
 {
   $input = $request->all();

   $projectuser = ProjectUser::create([
    'project_id' => $input['project_id'],
    'user_id' => $input['user_id'],
    'project_name' => $input['project_name'],
    'email' => $input['email'],
    'name' => $input['name'],
]);

   $projectuser->notify(new AddUsertoProject($projectuser));

   toastr()
   ->addSuccess('User Invited Successfully to the project');
   return back()->with('message', 'User Invited Successfully');
}

public function edit($id)
{
    $projectedit = Project::find($id);
    $programs = Program::all();
        // dd($programs);
    $logframes = LogFrame::all();
    $currencies = Currency::all();
    $notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
    $notificationcount = DB::table('bar_notifications')
    ->where('status', '=', '01')
    ->where('user_id', Auth::user()->id)
    ->count();
    return view('projects.edit', compact('projectedit','programs', 'logframes', 
        'currencies','notifcations','notificationcount'));
}


public function update(Request $request, $id)
{
    $this->validate($request, [
        'project_name' => '',
        'start_date' => '',
        'end_date' => '',
        'program_id' => '',
        'logframe_id' => '',
        'exchange_period' => '',
        'description' => '',
        'reporting_frequency' => '',
    ]);

    $input = $request->all();
    $project = Project::find($id);
    $project->update($input);
    toastr()
    ->positionClass('toast-top-center')
    ->addSuccess('Project Updated Successfully.');
    return redirect()->route('projects.index');
}


public function projectreports()
{
    return view('projects.reports');
}


public function projectimplement()
{
    return view('projects.implements');
}


public function projectplan()
{
    return view('projects.plans');
}

public function projectconfigure()
{
    return view('projects.configure');
}

public function projectreviews()
{
    return view('projects.reviews');
}


public function projectdocuments()
{
    return view('projects.documents');
}


public function createworkplan(Request $request)
{

    $this->validate($request, [
        'activity' => 'required',
        'start_date' => 'required',
        'end_date' => 'required',
        'workplan_name' => 'required',
        'workplan_description' => '',
        'status' => '',
        'created_by' => '',
        'organization_id' => '',
        'financial_year' => '',
        'exchange_rate' => '',
        ''
    ]);

    $input = $request->all();
    $workplan = WorkPlan::create($input);
    toastr()
    ->positionClass('toast-top-center')
    ->addSuccess('Work Plan Created successfully');
    return back()->with('message', 'Work Plan Created successfully');
}


public function createwp($id)
{
    $workplancontainer = WorkPlanContainer::find($id);
    $logframes = LogFrame::all();
    $project = Project::where('id', $workplancontainer->project_id)->first();
    $fundings = Funding::where('program_id', $project->program_id)->get();
    // dd($fundings);
    $interventions = Intervention::where('project_id', $workplancontainer->project_id)->get();
    $activities = DB::table('activities')
    ->Join('interventions', 'activities.id', '=', 'interventions.activity_id')
    ->where('interventions.project_id', '=', $workplancontainer->project_id)
    ->select('activity_title','activities.id', 'interventions.activity_id')->get();
    // dd($activities);                      
    $indicators = Indicator::all();
    $notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
    $notificationcount = DB::table('bar_notifications')
    ->where('status', '=', '01')
    ->where('user_id', Auth::user()->id)
    ->count();
    return view('projects.createwp', compact('workplancontainer', 'logframes', 
        'fundings', 'interventions', 'indicators','notifcations','notificationcount','activities'));
}


public function workplanstore(Request $request, $id)
{
    $this->validate($request, [
        'wactivity' => 'required',
        'wstart_date' => 'required',
        'wend_date' => 'required',
        'wname' => '',
        'wstatus' => '',
        'wcreated_by' => '',
        'exchange_rate' => '',
    ]);
    $input = $request->all();
    $wp = WorkPlanContainer::find($id);
    $wp->update($input);
    toastr()
    ->positionClass('toast-top-center')
    ->addSuccess('Work Plan Added successfully to project');
    return back()->with('message', 'Work Plan Created successfully');
}


public function createwpcontainer(Request $request)
{
    $this->validate($request, [
        'container_name' => 'required',
        'planning_type' => 'required',
        'status' => 'required',
        'created_by' => '',
        'organization_id' => '',
        'project_id' => '',
        'financial_year' => 'required',
    ]);
    $input = $request->all();
    $container = WorkPlanContainer::create($input);
    toastr()
    ->addSuccess('Container Added successfully');
    return back()->withInput(['tab'=>'tabItem2']);
}


public function createimcontainer(Request $request)
{
    $count = DB::table('implementation_containers')->where('project_id', '=', $request->project_id)->count();
    $nextcontainer = $count + 1; 

    $impcont = DB::table('implementation_containers')->where('workplancontainer_id', '=', $request->workplancontainer_id)->count();

    // $budgetex = BudgetExpense::where('workplancontainer_id', $request->workplancontainer_id)->get();

    $project = Project::where('id', '=', $request->project_id)->first();

    if($project->reporting_frequency == 'Monthly' && $count == '12' && $impcont == '12' || $project->reporting_frequency == 'BiMonthly' && $count == '6' && $impcont == '6' || $project->reporting_frequency == 'Quaterly' && $count == '4' && $impcont == '4' || $project->reporting_frequency == 'SemiAnnual' && $count == '2' && $impcont == '2' || $project->reporting_frequency == 'Annaul' && $count == '1' && $impcont == '1'){
        toastr()
        ->positionClass('toast-top-center')
        ->addError('<strong>We’re sorry</strong>, Maximum Containers Reached!');
        return back()->with('message', 'Implementation Container Added successfully');
    }else{
        $container = new ImplementationContainer();
        $container->container_name = $request->container_name;
        $container->planning_type = $request->planning_type;
        $container->status = $request->status;
        $container->created_by = $request->created_by;
        $container->organization_id = $request->organization_id;
        $container->exchange_rate = $request->exchange_rate;
        $container->project_id = $request->project_id;
        $container->workplancontainer_id = $request->workplancontainer_id;
        $container->implementation_start_date = $request->implementation_start_date;
        $container->imeplementation_end_date = $request->imeplementation_end_date;
        $container->reporting_frequency = $nextcontainer;
        $container->save();

        $containerId = $container->id;

        $budgetex = BudgetExpense::where('workplancontainer_id', $request->workplancontainer_id)->get();

    // $updatedExpenseIds = [];

        foreach ($budgetex as $expense) {
        // $expense->implementation_container_id = $containerId;
        // $expense->save();

            $currentIds = json_decode($expense->implementation_container_id, true) ?: [];

    // Add the new container ID to the array if it's not already present
            if (!in_array($containerId, $currentIds)) {
                $currentIds[] = $containerId;
            }

    // Encode the array back to JSON and save it
            $expense->implementation_container_id = json_encode($currentIds);
            $expense->save();

        }



    }

    toastr()
    ->positionClass('toast-top-center')
    ->addSuccess('Implementation Container Added successfully');
    return back()->with('message', 'Implementation Container Added successfully');

}



public function submitimcontainer(Request $request, $id)
{
    $process = ImplementationContainer::find($id);
    $process->status = $request->status;
    $process->submitted_by = $request->submitted_by;
    $process->save();
    toastr()->addSuccess('Implementation Container Submitted Successfully!');
    return back()->with('message', 'Implementation Container Submitted Successfully!');
}


public function createIntervention(Request $request)
{
   $this->validate($request, [
    'activity_id' => '',
    'funding1' => '',
    'funding2' => '',
    'funding3' => '',
    'total' => '',
    'status' => '',
    'organization_id' => '',
    'created_by' => '',
    'project_id' => 'required',
    'intervention_container_id' => 'required',
]);
   if (Intervention::where('activity_id', '=', $request->activity_id)->exists()) {
    toastr()
    ->addError('<strong>We’re sorry</strong>, Activity already exits on Funding.');
    return back()->withInput(['tab'=>'tabItem3']);
}else{
    $input = $request->all();
    $interventions = Intervention::create($input);
    toastr()
    ->addSuccess('Intervention Added Successfully');
    return back()->withInput(['tab'=>'tabItem3']);
}


}


public function createactivitywp(Request $request)
{

    if(DB::table('budgets')->count() == 0){
        $budget_id = 1;
    } else {
        $budget_id = Budget::orderBy('id', 'desc')->first()->id + 1;
    }

    $this->validate($request, [
        'project_id' => '', 
        'entry_id' => '',
        'annual_amounta' => '',
        'annual_amountb' => '',
        'annual_amountx' => '',
        'period' => '',
        'exchange_rate' => '',
        'status' => 'required',
        'created_by' => 'required',
        'organization_id' => 'required',
        'activity_id' => '',
        'indicator_id' => '',
        'workplan_name' => '',
        'work_plan_container_id' => '',
        'start_date' => '',
        'end_date' => '',
        'activity' => '',
        'financial_year' => '',
        'total' => '',
    ]);
    $input = $request->all();
    

    $budgetexpense = new BudgetExpense();
    $budgetexpense->workplancontainer_id = $request->work_plan_container_id;
    $budgetexpense->annual_budget = $request->total;
    $budgetexpense->organization_id = Auth::user()->organization_id;
    // $budgetexpense->total = $request->work_plan_container_id;
    $budgetexpense->project_id = $request->project_id;
    $budgetexpense->status = '01';
    $budgetexpense->budget_id = $budget_id;
    $budgetexpense->save();

    $activitywp = Budget::create($input);


    toastr()
    ->positionClass('toast-top-center')
    ->addSuccess('Activity Work Plan Added Successfully');
    return back()->with('message', 'Activity Work Plan Added Successfully');
}


public function createindicatorwp($id)
{
    $workplancontainer = WorkPlanContainer::find($id);
    $logframes = LogFrame::all();
    $project = Project::where('id', $workplancontainer->project_id)->first();
    $fundings = Funding::where('program_id', $project->program_id)->get();
    $interventions = Intervention::where('project_id', $workplancontainer->project_id)->get();
    $indicators = Indicator::where('project_id', $workplancontainer->project_id)
    ->orWhere('program_id', $project->program_id)->get();
    $notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
    $notificationcount = DB::table('bar_notifications')
    ->where('status', '=', '01')
    ->where('user_id', Auth::user()->id)
    ->count();
    return view('projects.createindicatorwp', compact('workplancontainer', 'logframes', 
        'fundings', 'interventions', 'indicators','project','notifcations','notificationcount'));
}       


public function createindicatorworkp(Request $request)
{   

// if($request->reporting == "Annual"){
//     $indicatortarget = new IndicatorTarget();
//     $indicatortarget->jan_december = $request->jan_december;
//     $indicatortarget->created_by = $request->created_by;
//     $indicatortarget->organization_id = $request->organization_id;
//     $indicatortarget->status = $request->status;
//     $indicatortarget->work_plan_container_id = $request->work_plan_container_id;
//     $indicatortarget->financial_year = $request->financial_year;
//     $indicatortarget->project_id = $request->project_id;
//     $indicatortarget->exchange_rate = $request->exchange_rate;
//     $indicatortarget->reporting = $request->reporting;
//     $indicatortarget->save();

//     // dd($indicatortarget);

//     toastr()
//     ->positionClass('toast-top-center')
//     ->addSuccess('Indicator Work Plan Added Successfully');
//     return back()->with('message', 'Indicator Work Plan Added Successfully');
// } elseif($request->reporting == "Semi-Annual"){

// }
    // $this->validate($request, [
    //     'january' => '',
    //     'february' => '',
    //     'march' => '',
    //     'april' => '',
    //     'may' => '',
    //     'june' => '',
    //     'july' => '',
    //     'august' => '',
    //     'september' => '',
    //     'october' => '',
    //     'november' => '',
    //     'december' => '',
    //     'jan_feb' => '',
    //     'mar_apr' => '',
    //     'may_june' => '',
    //     'july_aug' => '',
    //     'sep_oct' => '',
    //     'nov_dec' => '',
    //     'jan_march' => '',
    //     'april_june' => '',
    //     'july_september' => '',
    //     'october_december' => '',
    //     'jan_june' => '',
    //     'july_december' => '',
    //     'jan_december' => '',
    //     'baseline' => '',
    //     'target' => '',
    //     'label' => 'required',
    //     'frequency' => '',
    //     'indicator_id' => 'required',
    //     'created_by' => 'required',
    //     'organization_id' => 'required',
    //     'status' => 'required',
    //     'work_plan_container_id' => 'required',
    //     'financial_year' => 'required',
    //     'project_id' => 'required',
    //     'exchange_rate' => 'required',
    //     'reporting' => 'required',

    // ]);
    // $input = $request->all();
    // // dd($input);
    // $jsonData = json_encode($input);

    // $activitywp = IndicatorTarget::create($jsonData);
    // toastr()
    // ->positionClass('toast-top-center')
    // ->addSuccess('Indicator Work Plan Added Successfully');
    // return back()->with('message', 'Indicator Work Plan Added Successfully');


 $process = new IndicatorTarget();
 $process->january = json_encode($request->january);
 $process->february = json_encode($request->february);
 $process->march = json_encode($request->march);
 $process->april = json_encode($request->april);
 $process->may = json_encode($request->may);
 $process->june = json_encode($request->june);
 $process->july = json_encode($request->july);
 $process->august = json_encode($request->august);
 $process->september = json_encode($request->september);
 $process->october = json_encode($request->october);
 $process->november = json_encode($request->november);
 $process->december = json_encode($request->december);
 $process->jan_feb = json_encode($request->jan_feb);
 $process->mar_apr = json_encode($request->mar_apr);
 $process->may_june = json_encode($request->may_june);
 $process->july_aug = json_encode($request->july_aug);
 $process->sep_oct = json_encode($request->sep_oct);
 $process->nov_dec = json_encode($request->nov_dec);
 $process->jan_march = json_encode($request->jan_march);
 $process->april_june = json_encode($request->april_june);
 $process->july_september = json_encode($request->july_september);
 $process->october_december = json_encode($request->october_december);
 $process->jan_june = json_encode($request->jan_june);
 $process->july_december = json_encode($request->july_december);
 $process->jan_december = json_encode($request->jan_december);
 $process->baseline = $request->baseline;
 $process->target = $request->target;
 $process->label = $request->label;
 // $process->frequency = $request->frequency;
 $process->indicator_id = $request->indicator_id;
 $process->created_by = $request->created_by;
 $process->organization_id = $request->organization_id;
 $process->status = $request->status;
 $process->work_plan_container_id = $request->work_plan_container_id;
 $process->financial_year = $request->financial_year;
 $process->project_id = $request->project_id;
 $process->exchange_rate = $request->exchange_rate;
 $process->reporting = $request->reporting;
 // dd($process);
 $process->save();
 toastr()
 ->positionClass('toast-top-center')
 ->addSuccess('Indicator Work Plan Added Successfully');
 return back()->with('message', 'Indicator Work Plan Added Successfully');

}


public function createdocument(Request $request)
{

    // dd('Am here');
    $this->validate($request, [
      'doc_name' => 'required|string|max:255',
      'file' => 'required|max:50000',
      'created_by' => '',
      'organization_id' => '',
      'project_id' => '',
      'program_id' => '',
  ]);

    $user_id = auth()->user()->id;

    if ($request->hasFile('file')) {
        $fileNameWithExt = $request->file('file')->getClientOriginalName();
        $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('file')->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('file')->storeAs('storage/documents/'.$user_id, $fileNameToStore);
    }


    $doc = new Document;
    $doc->doc_name = $request->input('doc_name');
    $doc->created_by = $user_id;
    $doc->file = $path;

    $doc->mimetype = Storage::mimeType($path);
    $size = Storage::size($path);
    if ($size >= 1000000) {
      $doc->filesize = round($size/1000000) . 'MB';
  }elseif ($size >= 1000) {
      $doc->filesize = round($size/1000) . 'KB';
  }else {
      $doc->filesize = $size;
  }

  $doc->save();

// \Log::addToLog('New Document, '.$request->input('name').' was uploaded');

  toastr()
  ->positionClass('toast-top-center')
  ->addSuccess('Document uploaded Successfully');
  return back()->with('message', 'Document uploaded Successfully');

  // return redirect()->route('projects.index')->with('success','Document uploaded Successfully');
}


public function documentview($id)
{
    $doc = Document::findOrFail($id);
    $path = Storage::disk('local')->getDriver()->getAdapter()->applyPathPrefix($doc->file);
    $type = $doc->mimetype;

    // \Log::addToLog('Document ID '.$id.' was viewed');

    if ($type == 'application/pdf' || $type == 'image/jpeg' ||
        $type == 'image/png' || $type == 'image/jpg' || $type == 'image/gif')
    {
        return response()->file($path, ['Content-Type' => $type]);
    }
    elseif ($type == 'video/mp4' || $type == 'audio/mpeg' ||
        $type == 'audio/mp3' || $type == 'audio/x-m4a')
    {
        return view('documents.play',compact('doc'));
    }
    else {
        return response()->file($path, ['Content-Type' => $type]);
    }
}



public function download($id)
{
    $doc = Document::findOrFail($id);
    $path = Storage::disk('local')->getDriver()->getAdapter()->applyPathPrefix($doc->file);
    $type = $doc->mimetype;
    return response()->download($path);
}


public function add_data(Request $request)
{
    if($request->ajax())
    {
        $data = array(
            'budget_current_period'     =>  $request->budget_current_period,
            'expense_current_period'     =>  $request->expense_current_period,
        );

        // dd($request);

        $id = DB::table('budget_expenses')->insert($data);
        if($id > 0)
        {
            return response()->json($request);
        }



    } 
}



public function editbudget($id)
{
    $budgetedit = Budget::find($id);
    $project = Project::where('id', $budgetedit->project_id)->first();
    $fundings = Funding::where('program_id', $project->program_id)->get();
    $activity = DB::table('activities')->where('id', $budgetedit->activity)->first();
    $workplancontainer = WorkPlanContainer::where('id', '=', $budgetedit->work_plan_container_id)->first(); 

    $interventions = Intervention::where('activity_id', $activity->id)->first();
    
    $funding  = DB::table('fundings')
    ->select('funding_name')
    ->where('id', '!=', $budgetedit->funding_id)
    ->first();
    
    $notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
    $notificationcount = DB::table('bar_notifications')
    ->where('status', '=', '01')
    ->where('user_id', Auth::user()->id)
    ->count();

    return view('projects.fundings.edit', compact('budgetedit','funding','notifcations',
        'notificationcount','fundings', 'interventions', 'workplancontainer'));
}


public function updatebudget(Request $request, $id)
{

    $this->validate($request, [
        'workplan_name' => 'required',
        'annual_amounta' => 'required',
        'annual_amountb' => 'required',
        'start_date' => 'required',
        'end_date' => 'required',
        'total' => 'required',
    ]);

    $input = $request->all();
    $budget = Budget::find($id);
    $budget->update($input);
    toastr()->addSuccess('Budget Updated Successfully.');
    return back()->with('message', 'Activity Work Plan Added Successfully');
    // return redirect()->route('projects.index');
}


public function search(Request $request)
{

    $query = $request->input('search');
    $users = User::where('name', 'LIKE', '%'.$query.'%')->get();

    return response()->json($users);
    
}


public function indicatorupdate($id)
{
    $indicatorupdate = IndicatorTarget::find($id);
    $notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
    $notificationcount = DB::table('bar_notifications')
    ->where('status', '=', '01')
    ->where('user_id', Auth::user()->id)
    ->count();
    return view('projects.fundings.indicatoredit', compact('indicatorupdate','notifcations','notificationcount'));
}


public function updatebasecurrency(Request $request, $id)
{

 $process = Project::find($id);
 $process->basecurrency_id = $request->basecurrency_id;
 $process->save();
 toastr()->addSuccess('Base Currency Updated Successfully!');
 return back()->with('message', 'Base Currency Updated Successfully!'); 
}

public function updateinterventions(Request $request)
{
 $process = Intervention::find($request->intervention_id);
 $process->activity_name = $request->activity_name;
 $process->funding1 = $request->funding1;
 $process->funding2 = $request->funding2;
 $process->total = $request->total;
 $process->save();
 toastr()->addSuccess('Intervention Updated Successfully!');
 return back()->with('message', 'Intervention Updated Successfully!'); 
}


public function submitintervention(Request $request)
{

    $data = $request->all();

    $process = InterventionContainer::where('id', '=', $request->container_id)->update([
        'status' => $data['status'],
        'submitted_by' => $data['submitted_by'],
        'submission_comment' => $data['submission_comment'],
        'email' => $data['email'],
        'submitted_name' => $data['submitted_name'],
        'submitted_on' => $data['submitted_on'],
    ]);

    // dd($process);

    $process->notify(new SubmitInterventionContainer($process));
    
    toastr()->addSuccess('Intervention Submitted Successfully!');
    return back()->with('message', 'Implementation Container Submitted Successfully!');



}


public function cancelintervention(Request $request)
{
    $process = $request->all();

    $process = InterventionContainer::find($request->container_id);
    $process->status = $request->status;
    $process->cancel_comment = $request->cancel_comment;
    $process->save();
    
    toastr()->addSuccess('Intervention Cancelled Successfully!');
    return back()->with('message', 'Intervention Cancelled Successfully!');

}

public function approveintervention(Request $request)
{
    $process = InterventionContainer::find($request->container_id);
    $process->status = $request->status;
    $process->approved_by = $request->approved_by;
    $process->approval_comment = $request->approval_comment;
    $process->approved_by_email = $request->approved_by_email;
    $process->approved_on = $request->approved_on;
    $process->save();
    toastr()->addSuccess('Intervention Approved Successfully!');
    return back()->with('message', 'Implementation Container Submitted Successfully!');
}

public function forwardintervention(Request $request)
{
    $process = InterventionContainer::find($request->container_id);
    $process->status = $request->status;
    $process->forward_to_email = $request->forward_to_email;
    $process->forward_to_name = $request->forward_to_name;
    $process->forwarded_by = $request->forwarded_by;
    $process->forwarded_on = $request->forwarded_on;
    $process->forward_comment = $request->forward_comment;
    $process->save();

    toastr()->addSuccess('Intervention Forwarded Successfully!');
    return back()->with('message', 'Implementation Container Submitted Successfully!');
}

public function rejectintervention(Request $request)
{
    $process = InterventionContainer::find($request->container_id);
    $process->status = $request->status;
    $process->rejected_by = $request->rejected_by;
    $process->reject_comment = $request->reject_comment;
    $process->rejected_by_email = $request->rejected_by_email;
    $process->rejected_on = $request->rejected_on;
    $process->save();
    toastr()->addSuccess('Intervention Rejected!');
    return back()->with('message', 'Implementation Container Submitted Successfully!');
}


public function interventiontimeline()
{

}


public function createicontainer(Request $request)
{
    $this->validate($request, [
        'container_name' => 'required',
        'status' => 'required',
        'created_by' => '',
        'organization_id' => '',
        'project_id' => '',
    ]);
    $input = $request->all();
    $container = InterventionContainer::create($input);
    toastr()
    ->addSuccess('Intervention Container Added successfully');
    return back()->withInput(['tab'=>'tabItem3']);
}

public function submitworkplan(Request $request)
{
    $data = $request->all();


    $process = WorkPlanContainer::where('id', $data['container_id'])->update([
        'status' => $data['status'],
        'submitted_by' => $data['submitted_by'],
        'submission_comment' => $data['submission_comment'],
        'email' => $data['email'],
        'submitted_name' => $data['submitted_name'],
        'submitted_on' => $data['submitted_on'],
    ]);

    $process->notify(new SubmitInterventionContainer($process));
    
    toastr()->addSuccess('WorkPlan Container Submitted Successfully!');
    return back()->with('message', 'Implementation Container Submitted Successfully!');

}

public function cancelworkplan(Request $request)
{
    $process = $request->all();

    $process = WorkPlanContainer::find($request->container_id);
    $process->status = $request->status;
    $process->cancel_comment = $request->cancel_comment;
    $process->cancel_date = $request->cancel_date;
    $process->save();
    
    toastr()->addSuccess('WorkPma Container Cancelled Successfully!');
    return back()->with('message', 'Intervention Cancelled Successfully!');

}


public function updategoal(Request $request)
{
 $process = Goal::find($request->goal_id);
 $process->goal_name = $request->goal_name;
 $process->goal_code = $request->goal_code;
 $process->save();
 toastr()->addSuccess('Goal Edited Successfully!');
 return back()->withInput(['tab'=>'tabItem4']);
}

public function updateactivitygoal(Request $request)
{
 $process = Activity::find($request->activity_id);
 $process->activity_title = $request->activity_title;
 $process->activity_code = $request->activity_code;
 $process->save();
 toastr()->addSuccess('Goal Activity Edited Successfully!');
 return back()->withInput(['tab'=>'tabItem4']);
}


public function updateoutcome(Request $request)
{
 $process = Outcome::find($request->outcome_id);
 $process->outcome_title = $request->outcome_name;
 $process->outcome_code = $request->outcomecode;
 $process->save();
 toastr()->addSuccess('Outcome Updated Successfully!');
 return back()->withInput(['tab'=>'tabItem4']);
}


public function updateoutcomeactivity(Request $request)
{
 $process = Activity::find($request->activity_id);
 $process->activity_title = $request->activity_title;
 $process->activity_code = $request->activity_code;
 $process->save();
 toastr()->addSuccess('Outcome Activity Edited Successfully!');
 return back()->withInput(['tab'=>'tabItem4']);
}

public function updateoutput(Request $request)
{
 $process = Output::find($request->output_id);
 $process->output_name = $request->output_name;
 $process->output_code = $request->output_code;
 $process->save();
 toastr()->addSuccess('Output Updated Successfully!');
 return back()->withInput(['tab'=>'tabItem4']); 
}


public function updateoutputactivity(Request $request)
{
 $process = Activity::find($request->activity_id);
 $process->activity_title = $request->activity_title;
 $process->activity_code = $request->activity_code;
 $process->save();
 toastr()->addSuccess('Output Activity Edited Successfully!');
 return back()->withInput(['tab'=>'tabItem4']);
}



public function budgetupdatexpense(Request $request, $budgetExpenseID)
{
    $budgetexpense = BudgetExpense::where('budget_id', $budgetExpenseID)->first();

    if (!$budgetexpense) {
        return response()->json(['error' => 'Budget Expense not found'], 404);
    }

    $project = Project::find($budgetexpense->project_id);

    // Decode implementation_container_id as an array
    $implementationContainerIds = json_decode($budgetexpense->implementation_container_id, true);

    if (!is_array($implementationContainerIds) || empty($implementationContainerIds)) {
        return response()->json(['error' => 'No valid implementation container IDs found'], 400);
    }

    // Loop through each ID to find a valid matching container
    foreach ($implementationContainerIds as $containerId) {
        $implementation_container = ImplementationContainer::find($containerId);

        if (
            $implementation_container &&
            $implementation_container->reporting_frequency == "1" &&
            $project->reporting_frequency == "Annaul" && 
            $request->budget_current_period_yearly1 !== null &&
            $request->expense_current_period_yearly1 !== null
        ) {
            $budgetexpense->budget_current_period_yearly1 = $request->budget_current_period_yearly1;
            $budgetexpense->expense_current_period_yearly1 = $request->expense_current_period_yearly1;
            $budgetexpense->save();

            return response()->json(['success' => true]);
        } elseif (
            $implementation_container &&
            $implementation_container->reporting_frequency == "1" &&
            $project->reporting_frequency == "Annaul" && 
            $request->budget_current_period_yearly2 !== null &&
            $request->expense_current_period_yearly2 !== null
        ) {
            $budgetexpense->budget_current_period_yearly2 = $request->budget_current_period_yearly2;
            $budgetexpense->expense_current_period_yearly2 = $request->expense_current_period_yearly2;
            $budgetexpense->save();
            return response()->json(['success' => true]);
        }
    }

    return response()->json(['error' => 'No matching implementation container met the update criteria'], 400);
}


public function budgetexpense(Request $request)
{
    $budgetexpense = new BudgetExpense();

    $budgetexpense->budget_current_period1 = $request->budget_current_period1;
    $budgetexpense->budget_current_period2 = $request->budget_current_period2;
    $budgetexpense->expense_previous_period = $request->expense_previous_period;
    $budgetexpense->expense_current_period1 = $request->expense_current_period1;
    $budgetexpense->expense_current_period2 = $request->expense_current_period2;
    $budgetexpense->organization_id = Auth::user()->organization_id;
    $budgetexpense->status = '01';
    $budgetexpense->project_id = $request->project_id;
    $budgetexpense->budget_id = $request->budget_id;
    $budgetexpense->funding_id = $request->funding_id;
    $budgetexpense->implementation_container_id = $request->implementation_container_id;

    $budgetexpense->save();

    return response()->json(['success' => true]);
}




}

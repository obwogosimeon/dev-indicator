<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Program;
use App\LogFrame;
use App\Goal;
use App\Activity;
use App\Indicator;
use App\Outcome;
use App\Output;
use DB;
use Auth;
use App\Currency;
use App\Year;
use App\Funding;
use App\BaseCurrency;
use App\ProgramUser;
use App\User;
use App\Notifications\AddUsertoProgram;
use App\BarNotification;
use Spatie\Permission\Models\Role;
use App\Document;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ProgramController extends Controller
{
    public function index()
    { 
        $notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
        $notificationcount = DB::table('bar_notifications')
        ->where('status', '=', '01')
        ->where('user_id', Auth::user()->id)
        ->count();  
        $programs = Program::where('organization_id', Auth::user()->organization_id)->get();
        return view('programs.index', compact('programs','notifcations','notificationcount'));
    }


    public function create()
    {

        $statement = DB::select("SHOW TABLE STATUS LIKE 'log_frames'");
        $nextId = $statement[0]->Auto_increment;
        $notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
        $notificationcount = DB::table('bar_notifications')
        ->where('status', '=', '01')
        ->where('user_id', Auth::user()->id)
        ->count();
        $logframes = LogFrame::where('organization_id', Auth::user()->organization_id)->get();
        $basecurrency = BaseCurrency::all();
        return view('programs.create', compact('logframes','basecurrency', 'nextId','notifcations','notificationcount'));
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'program_name' => 'required',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after:start_date',
            'description' => '',
            'currency' => '',
            'basecurrency_id' => 'required'
        ]);

        $validator->after(function ($validator) use ($request) {
            $startDate = Carbon::parse($request->input('start_date'));
            $endDate = Carbon::parse($request->input('end_date'));

            if ($startDate->greaterThanOrEqualTo($endDate)) {
                $validator->errors()->add('start_date', 'The start date must be less than the end date.');
            }
        });

        if (Program::where('program_name', '=', $request->program_name)->exists()){
            toastr()
            ->addError('<strong>We’re sorry</strong>, Program Already Exist!.');
            return redirect()->route('programs.create');
        } else {
            $input = $request->all();
            $program = Program::create($input);
            return redirect()->route('programs.index')
            ->with('success','Program Created successfully');
        }
    }


    public function show($id)
    {

        $programshow = Program::find($id);

        $logframes = LogFrame::where('id', '=', $programshow->log_frame_id)->first();

        $goalframe = null;
        if($logframes != null){
            $goalframe = Goal::where('log_frame_id', '=', $logframes->id)->first();
        }
        // $output1 = Output::where('log_frame_id', '=', $logframes->id)->first();
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

        $activitygoal = null;
        if($goalframe != null){
            $activitygoal = Activity::where('goal_id', '=', $goalframe->id)->where('program_id', $id)->get();
        }
        $goalindicator = null;
        if($goalframe != null){
            $goalindicator = Indicator::where('goal_id', '=', $goalframe->id)->where('program_id', $id)->get();
        }
        $goaloutcomes = null;
        if($goalframe != null){
            $goaloutcomes = Outcome::where('goal_id', '=', $goalframe->id)->where('program_id', $id)->get();
        }
        // dd($goaloutcomes);

        $outcome = null;
        if($goalframe != null){
            $outcome = Outcome::where('goal_id', '=', $goalframe->id)->where('program_id', $id)->first();
        }
        // dd($outcome);
        $activityoutcome = null;
        if($outcome != null){
            $activityoutcome = Activity::where('outcome_id', '=', $outcome->id)->where('program_id', $id)->get();
        }
        $outcomeindicator = null;
        if($outcome != null){
            $outcomeindicator = Indicator::where('outcome_id', '=', $outcome->id)->where('program_id', $id)->get();
        }
        $output = null;
        if($outcome != null){
            $output = Output::where('outcome_id', '=', $outcome->id)->where('program_id', $id)->get();
        }
        $outputone = null;
        if($outcome != null){
            $outputone = Output::where('outcome_id', '=', $outcome->id)->where('program_id', $id)->first();
        }

        // $output1 = Output::where('program_id', '=', $id)->first();
        $outputactivity = null;
        if($outputone != null){
            $outputactivity = Activity::where('output_id', $outputone->id)->where('program_id', $id)->get();
        }
        // dd($outputactivity);
        $outputindicator = null;
        if ($outputone != null){
            $outputindicator = Indicator::where('output_id', '=',  $outputone->id)
            ->where('program_id', $id)->get();
        }

        $currencies = Currency::where('program_id', $id)->get();
        $years = Year::where('program_id', $id)->get();
        $fundings = Funding::where('program_id', $id)->get();

        $accounts =  DB::table('fundings')->where('type', '=', 'Global')->get();

        // $programusers = User::where('organization_id', $programshow->organization_id)
        // orWhere('')->get();
        $programusers = DB::table('organizations')
        ->join('users', 'organizations.id', '=', 'users.organization_id')
        ->orWhere('parent_id', Auth::user()->organization_id)
        ->orWhere('organizations.id', Auth::user()->organization_id)
        ->select('users.last_name as last_name','users.id as id', 'users.name as name')
        ->get();

                        // dd($programusers);

        $notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
        $notificationcount = DB::table('bar_notifications')
        ->where('status', '=', '01')
        ->where('user_id', Auth::user()->id)
        ->count();

        $roles = DB::table('roles')
        ->select('name', 'id')
        ->orWhere('name', '=', 'ProgramMaker')
        ->orWhere('name', '=', 'ProgramChecker')->get();

        $documents = Document::where('program_id', $id)
        ->where('created_by', Auth::user()->id)->get();       

        return view('programs.show',compact('programshow', 'accounts', 'activitygoal', 
            'goalindicator', 'goaloutcomes', 'activityoutcome', 
            'outcomeindicator', 'output', 'outputactivity', 'goalframe', 'outcome', 'outputone', 
            'outputindicator', 'currencies', 'years', 'fundings', 
            'loopgoals','outcomes2', 'outputs2', 'activity2','indicators2','goaladctiv',
            'goalindicators', 'logframes', 'programusers','notifcations',
            'notificationcount','roles', 'documents','outoutindicator2','outputactivity2'));
    }

    public function inviteuser(Request $request)
    {
        $input = $request->all();

        $programuser = ProgramUser::create([
            'program_id' => $input['program_id'],
            'user_id' => $input['user_id'],
            'program_name' => $input['program_name'],
            'email' => $input['email'],
            'name' => $input['name'],
        ]);

        $programuser->notify(new AddUsertoProgram($programuser));

        toastr()
        ->addSuccess('User Invited Successfully to the Program');
        return back()->with('message', 'User Invited Successfully');
    }

    public function edit($id)
    {
        $programedit = Program::find($id);
        $logframes = LogFrame::all();
        $notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
        $notificationcount = DB::table('bar_notifications')
        ->where('status', '=', '01')
        ->where('user_id', Auth::user()->id)
        ->count();
        return view('programs.edit', compact('programedit', 'logframes','notifcations','notificationcount'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'program_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'logframe_id' => '',
            'description' => ''
        ]);
        $input = $request->all();
        $program = Program::find($id);
        $program->update($input);
        return redirect()->route('programs.index')->with('success','Program Updated successfully');
    }


}

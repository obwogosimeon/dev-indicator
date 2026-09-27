<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\LogFrame;
use App\Goal;
use App\Outcome;
use App\Output;
use App\Activity;
use App\Indicator;
use App\Program;
use DB;
use Auth;
use App\BarNotification;

class LogFrameController extends Controller
{
    public function index()
    {
        $notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
        $notificationcount = DB::table('bar_notifications')
        ->where('status', '=', '01')
        ->where('user_id', Auth::user()->id)
        ->count();
    	$logframes = LogFrame::where('created_by',  Auth::user()->id)->get();
        return view('logframes.index', compact('logframes','notifcations','notificationcount'));
    }


    public function create()
    {
        $notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
        $notificationcount = DB::table('bar_notifications')
        ->where('status', '=', '01')
        ->where('user_id', Auth::user()->id)
        ->count();
        return view('logframes.create', compact('notifcations','notificationcount'));
    }


    public function store(Request $request)
    {
    	$this->validate($request, [
            'logframe_name' => 'required',
            'created_by' => 'required',
            'organization_id' => '',
            'logid' => '',
        ]);

        if(DB::table('log_frames')->count() == 0){
            $logframeid = 1;
        } else {
            $logframeid = LogFrame::orderBy('id', 'desc')->first()->id + 1;
        }

        $program = Program::find($request->logid);
        $program->log_frame_id = $logframeid;
        $program->save();

        $input = $request->all();
        $logframe = LogFrame::create($input);
        toastr()->addSuccess('Logframe Created successfully');
        return back()->withInput(['tab'=>'tabItem6']);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'logframe_name' => '',
            'created_by' => '',
            'organization_id' => '',
        ]);

        $input = $request->all();
        $logframe = LogFrame::find($id);
        toastr()->addSuccess('Logframe Created Successfully.');
        return redirect()->route('logframes.index');
    }


    public function show($id)
    {

        $logshow = LogFrame::find($id);

        $goals = Goal::where('log_frame_id', '=', $id)->first();

        $loopgoals = Goal::where('log_frame_id', $id)->get();
        $outcomes2 = Outcome::all();
        $outputs2 = Output::all();
        $activity2 = Activity::all();
        $indicators2 = Indicator::all();
        $goaladctiv = Activity::all();
        $goalindicators = Indicator::all();

        // dd($outcomes2);

        $outcomes1 = Outcome::where('log_frame_id', '=', $id)->first();
        $output1 = Output::where('log_frame_id', '=', $id)->first();


        $outcomes = null;

        if ($goals != null){

            $outcomes = Outcome::
            where('log_frame_id', '=', $id)
            ->where('goal_id', '=', $goals->id)
            ->first();
        } 

        $outputs = Output::where('log_frame_id', '=', $id)->first();

        $goalactivities = null;
        if ($goals != null){
            $goalactivities = Activity::where('log_frame_id', '=', $id)
            ->where('goal_id', '=', $goals->id)
            ->get();

            // dd($goalactivities);
        }

        $outcomeactivities = null;

        if ($outcomes1 != null){
            $outcomeactivities = Activity::where('log_frame_id', '=', $id)
            ->where('outcome_id', '=', $outcomes1->id)
            ->get();  
        }

        $outputactivities = null;
        if ($output1 != null){            
            $outputactivities = Activity::where('log_frame_id', '=', $id)
            ->where('output_id', '=', $output1->id)
            ->get(); 
        }

        $indicators = Indicator::where('log_frame_id', '=', $id)->first();

        $goalindicator = null;
        if ($goals != null){
            $goalindicator = Indicator::where('log_frame_id', '=', $id)
            ->where('goal_id', '=', $goals->id)
            ->get();
        }

        $outcomeindicator = null;
        if ($outcomes1 != null){
            $outcomeindicator = Indicator::where('log_frame_id', '=', $id)
            ->where('outcome_id', '=', $outcomes1->id)
            ->get();
        }

        $outputindicator = null;
        if ($output1 != null){
            $outputindicator = Indicator::where('log_frame_id', '=', $id)
            ->where('output_id', '=', $output1->id)
            ->get();
        }

        $logframeindicators = Indicator::where('log_frame_id', $id)->get();
        $notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
        $notificationcount = DB::table('bar_notifications')
        ->where('status', '=', '01')
        ->where('user_id', Auth::user()->id)
        ->count();

        return view('logframes.show',compact('logshow', 'goals', 'outcomes', 
            'outputs', 'indicators','outputactivities', 'outcomeactivities', 'goalactivities', 
            'outcomes1', 'output1', 'goalindicator', 'outcomeindicator', 'outputindicator', 'logframeindicators', 'loopgoals', 
            'outcomes2', 'outputs2', 'activity2', 
            'indicators2', 'goaladctiv', 'goalindicators','notifcations','notificationcount'));
    }

    public function edit($id)
    {
        $logedit = LogFrame::find($id);
        return view('logframes.edit', compact('logedit'));
    }


    public function addgoal(Request $request)
    {
        $this->validate($request, [
            'goal_name' => 'required',
            'goal_code' => 'required',
            'goal_description' => '',
            'logid' => '',
        ]);
        $input = $request->all();
        $goal = LogFrame::find($request->logid);
        toastr()->addSuccess('Goal Created successfully');
        return back()->with('message', 'Goal Created successfully');
    }


    public function addoutcome(Request $request, $id)
    {
    	$this->validate($request, [
    		'outcome_goal' => 'required',
            'outcome_title' => 'required',
            'outcome_code' => 'required',
            'outcome_description' => '',
        ]);
        $input = $request->all();
        $outcome = LogFrame::find($id);
        $outcome->update($input);
        toastr()->addSuccess('Outcome Created successfully');
        return back()->with('message', 'Outcome Created successfully');
    }

    public function addoutput(Request $request, $id)
    {
    	$this->validate($request, [
    		'output_name' => 'required',
            'output_title' => 'required',
            'output_code' => 'required',
            'output_description' => '',
        ]);
        $input = $request->all();
        $outcome = LogFrame::find($id);
        $outcome->update($input);
        toastr()->addSuccess('Output Created successfully');
        return back()->with('message', 'Output Created successfully');
    }


    public function addactivity(Request $request, $id)
    {
    	$this->validate($request, [
    		'activity_name' => 'required',
            'activity_title' => 'required',
            'activity_code' => 'required',
            'activity_description' => '',
        ]);
        $input = $request->all();
        $outcome = LogFrame::find($id);
        $outcome->update($input);
        toastr()->addSuccess('Activity Created successfully');
        return back()->with('message', 'Activity Created successfully');
    }


    public function getlogframeindicators($id)
    {
        $indicators = Indicator::where('log_frame_id', $id)->get();
        return view('logframes.indicators.index', compact('indicators'));
    }

    
}

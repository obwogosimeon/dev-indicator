<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Outcome;
use App\Output;
use App\Activity;
use App\Indicator;

class OutcomeController extends Controller


{

    public function index(){

      $outcomes = Outcome::all();
      toastr()
        ->positionClass('toast-top-center')
        ->addSuccess('Outcome Created successfully');
          return back()->with('message', 'Goal Outcome Created successfully');
          return redirect()->route('logframes.index')->with('success','Goal Outcome Created successfully');
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'outcome_goal' => '',
            'outcome_title' => '',
            'outcome_code' => '',
            'outcome_description' => '',
            'created_by' => '',
            'status' => '',
            'organization_id' => '',
            'log_frame_id' => '',
            'goal_id' => '',
            'program_id' => '',
            'project_id' => '',
        ]);

        $input = $request->all();
        $outcomes = Outcome::create($input);
        if($request->program_id != ''){
        // toastr()
        // ->addSuccess('Program Goal Outcome Created successfully');
        // return back()->withInput(['tab'=>'tabItem6']);
        return response()->json(['success' => true]);
        }elseif($request->project_id != ''){
        //     toastr()
        // ->addSuccess('Project Goal Outcome Created successfully');
        // return back()->withInput(['tab'=>'tabItem4']);
        return response()->json(['success' => true]);
        }
    }


    public function addoutcomeactivity(Request $request)
    {

        $this->validate($request, [
            'activity_name' => '',
            'activity_title' => '',
            'activity_code' => '',
            'activity_description' => '',
            'created_by' => '',
            'status' => '',
            'organization_id' => '',
            'log_frame_id' => '',
            'outcome_id' => '',
            'program_id' => '',
            'project_id' => '',
        ]);

        $input = $request->all();
        $activities = Activity::create($input);
        if($request->program_id != ''){
        // toastr()
        // ->addSuccess('Outcome Activity Created successfully');
        // return back()->withInput(['tab'=>'tabItem6']);
            return response()->json(['success' => true]);
        }elseif($request->project_id != ''){
        //     toastr()
        // ->addSuccess('Outcome Activity Created successfully');
        // return back()->withInput(['tab'=>'tabItem4']);
            return response()->json(['success' => true]);
        }

    }

    public function addoutcomeindicator(Request $request)
    {
        // dd('Arrived');
        $this->validate($request, [
            'activity_name' => '',
            'goal_name' => '',
            'output_name' => '',
            'outcome_name' => '',
            'indicator_title' => '',
            'reporting_frequency' => '',
            'disaggregation' => '',
            'indicator_description' => '',
            'type' => '',
            'status' => '',
            'organization_id' => '',
            'created_by' => '',
            'log_frame_id' => '',
            'goal_id' => '',
            'label_none' => '',
            'baseline_none' => '',
            'target_none' => '',
            'dvalue' => '',
            'dtarget' => '',
            'dbaseline' => '',
            'activity_id' => '',
            'output_id' => '',
            'outcome_id' => '',
            'program_id' => '',
            'project_id' => '',
        ]);

        $input = $request->all();
        $indicators = Indicator::create($input);
        if($request->program_id != ''){
            return response()->json(['success' => true]);
        }elseif($request->project_id != ''){
            return response()->json(['success' => true]);
        }
    }


    public function edit($id)
    {
        $outcome = Outcome::find($id);
        return response()->json($outcome);
    }

    public function destroy($id)
    {

        Outcome::find($id)->delete();
        return response()->json(['success'=>'Outcome deleted successfully.']);
    }
}

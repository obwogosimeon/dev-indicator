<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Goal;
use App\Indicator;

class GoalController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'goal_name' => 'required',
            'goal_code' => 'required',
            'goal_description' => '',
            'log_frame_id' => '',
            'organization_id' => '',
            'created_by' => 'required',
            'status' => '',
        ]);

        $input = $request->all();
        $goals = Goal::create($input);
        toastr()
        ->addSuccess('Goal Added successfully');
        return back()->withInput(['tab'=>'tabItem6']);
    }


    public function addgoalindicator(Request $request)
    {
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
            'project_id' => '',
            'program_id' => '',
        ]);

        $input = $request->all();
        $indicators = Indicator::create($input);
        if($request->log_frame_id != ''){
        //     toastr()
        // ->addSuccess('Goal Added successfully');
        // return back()->withInput(['tab'=>'tabItem6']);
            return response()->json(['success' => true]);
        }elseif($request->project_id != ''){
        //     toastr()
        // ->addSuccess('Project Indicator Added successfully');
        // return back()->withInput(['tab'=>'tabItem4']);
            return response()->json(['success' => true]);
        }elseif($request->program_id != ''){
        //     toastr()
        // ->addSuccess('Program Indicator Added successfully');
        // return back()->withInput(['tab'=>'tabItem6']);
            return response()->json(['success' => true]);
        }
    }


    public function edit($id)
    {
        $goals = Goal::find($id);
        return response()->json($goals);
    }


    public function destroy($id)
    {

        Goal::find($id)->delete();
        return response()->json(['success'=>'Goal deleted successfully.']);
    }

}

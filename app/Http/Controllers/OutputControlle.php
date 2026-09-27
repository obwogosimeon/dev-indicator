<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Output;
use App\Activity;
use App\Indicator;
use Redirect;

class OutputControlle extends Controller


{

    public function index()
    {

      $outputs = Output::all();
      toastr()
        ->positionClass('toast-top-center')
        ->addSuccess('Output Created successfully');
          return back()->with('message', 'Goal Output Created successfully');
          return redirect()->route('logframes.index')->with('success','Goal Output Created successfully');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'output_name' => '',
            'output_code' => '',
            'output_title' => '',
            'output_description' => '',
            'created_by' => '',
            'status' => '',
            'organization_id' => '',
            'outcome_id' => '',
            'log_frame_id' => '',
            'program_id' => '',
            'project_id' => '',
        ]);

        $input = $request->all();
        $outputs = Output::create($input);
        if($request->log_frame_id != ''){
        return response()->json(['success' => true]);
        }elseif($request->project_id != ''){
        return response()->json(['success' => true]);
        }elseif($request->program_id != ''){
        return response()->json(['success' => true]);
        }
    }


    public function addoutputactivity(Request $request)
    {
        $this->validate($request, [
            'activity_name' => '',
            'activity_title' => '',
            'activity_code' => '',
            'activity_description' => '',
            'goal_id' => '',
            'log_frame_id' => '',
            'status' => '',
            'created_by' => '',
            'organization_id' => '',
            'output_id' => '',
            'program_id' => '',
            'project_id' => '',
        ]);

        $input = $request->all();
        $outputactivity = Activity::create($input);
        if($request->program_id != ''){
        // toastr()
        // ->addSuccess('Program Output Activity Added successfully');
        // return back()->withInput(['tab'=>'tabItem6']);
            return response()->json(['success' => true]);
        }elseif($request->project_id != ''){
        //     toastr()
        // ->addSuccess('Project Output Activity Added successfully');
        // return back()->withInput(['tab'=>'tabItem4']);
            return response()->json(['success' => true]);
        }
        
    }


    public function addoutputindicator(Request $request)
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
            return response()->json(['success' => true]);
        }elseif($request->project_id != ''){
            return response()->json(['success' => true]);
        }elseif($request->program_id != ''){
            return response()->json(['success' => true]);
        }
    }


    public function edit($id)
    {
        $output = Output::find($id);
        return response()->json($output);
    }

    public function destroy($id)
    {
        Output::find($id)->delete();
        return response()->json(['success'=>'Outout deleted successfully.']);
    }

}
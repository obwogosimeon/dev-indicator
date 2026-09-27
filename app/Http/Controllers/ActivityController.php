<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Activity;

class ActivityController extends Controller
{


    public function store(Request $request)
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
            'goal_id' => '',
            'program_id',
            'project_id',
        ]);

        $input = $request->all();
        $activities = Activity::create($input);
        if($request->program_id != ''){
        // toastr()
        // ->addSuccess('Program Goal Activity Created Successfully');
        // return back()->withInput(['tab'=>'tabItem6']);
            return response()->json(['success' => true]);
        }elseif($request->project_id != ''){
        //     toastr()
        // ->addSuccess('Project Goal Activity Created successfully');
        // return back()->withInput(['tab'=>'tabItem4']);
            return response()->json(['success' => true]);
        }
    }


    public function edit($id)
    {
        $activities = Activity::find($id);
        return response()->json($activities);
    }


    public function destroy($id)
    {

        Activity::find($id)->delete();
        return response()->json(['success'=>'Activity deleted successfully.']);
    }
}

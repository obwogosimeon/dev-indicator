<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Indicator;

class IndicatorController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'outcome_goal' => 'required',
            'outcome_title' => 'required',
            'outcome_code' => 'required',
            'outcome_description' => '',
            'created_by' => '',
            'status' => 'required',
            'organization_id' => '',
            'logframe_id' => 'required',
            'goal_id' => 'required'
        ]);

        $input = $request->all();
        $outcomes = Outcome::create($input);
        // return redirect()->route('logframes.index')->with('success','Outcome Created successfully');

        if($request->logframe_id != null){
            return redirect()->route('logframes.index')->with('success','Indicator Activity Created successfully');
        }elseif ($request->program_id != null) {
            return redirect()->route('programs.index')->with('success','Program Indicator Activity Created successfully');
        }elseif ($request->project_id != null) {
            return redirect()->route('projects.index')->with('success','Project Indicator Activity Created successfully');
        }
    }


    public function edit($id)
    {
        $indicators = Indicator::find($id);
        return response()->json($indicators);
    }


    public function destroy($id)
    {

        Indicator::find($id)->delete();
        return response()->json(['success'=>'Indicator deleted successfully.']);
    }
}

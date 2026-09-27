<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Project;
use App\Template;
use App\Definition;
use App\Program;
use App\Logframe;
use App\BarNotification;
use DB;
use Auth;

class ReportsController extends Controller
{
    public function index() 
    {   
        $notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
        $notificationcount = DB::table('bar_notifications')
        ->where('status', '=', '01')
        ->where('user_id', Auth::user()->id)
        ->count();
    	$projects = Project::all();
    	return view('reports.index', compact('projects','notifcations','notificationcount'));
    }


    public function programreports()
    {
        $programs = Program::all();
        return view('reports.programs', compact('programs'));
    }

     public function logframereports()
    {
        $logrames = Logframe::all();
        return view('reports.logframes', compact('logrames'));
    }


    public function projectreportshow($id)
    {
    	$projectshow = Project::find($id);
    	$templates = Template::where('project_id', '=', $id)->get();
        $definitions = Definition::where('project_id', '=', $id)->get();
    	return view('reports.projectreport', compact('projectshow', 'templates', 'definitions'));
    }


    public function createtemplate(Request $request)
    {
    	 $this->validate($request, [
            'template_name' => 'required',
            'project_id' => '',
            'program_id' => '',
            'report_type' => '',
            'report_draft_entry' => '',
            'closed_reported_entry' => '',
            'draft_entry' => '',
            'approved_entry' => '',
            'status' => 'required',
            'created_by' => 'required'
        ]);

        $input = $request->all();
        $template = Template::create($input);
        return redirect()->route('reportsindex')
                        ->with('success','Template Created successfully');
    }


    public function createdefinition(Request $request)
    {
         $this->validate($request, [
            'template_id' => 'required',
            'definition_title' => '',
            'standard' => '',
            'status' => 'required',
            'created_by' => 'required'
        ]);

        $input = $request->all();
        $definition = Definition::create($input);
        return redirect()->route('reportsindex')
                        ->with('success','Definition Created Successfully');
    }
}

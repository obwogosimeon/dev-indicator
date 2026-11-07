<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Project;
use App\Template;
use App\Definition;
use App\Program;
use App\LogFrame;
use App\BarNotification;
use DB;
use Auth;

class ReportsController extends Controller
{
    public function index() 
    {   
        $projects = Project::with('program')->orderBy('project_name')->get();
        $programCount = Program::count();
        $logframeCount = LogFrame::count();

        return view('reports.index', array_merge(
            compact('projects', 'programCount', 'logframeCount'),
            $this->headerNotifications()
        ));
    }


    public function programreports()
    {
        $programs = Program::with('project')->orderBy('program_name')->get();

        return view('reports.programs', array_merge(
            compact('programs'),
            $this->headerNotifications()
        ));
    }

     public function logframereports()
    {
        $logrames = LogFrame::with('project')->orderBy('logframe_name')->get();

        return view('reports.logframes', array_merge(
            compact('logrames'),
            $this->headerNotifications()
        ));
    }


    public function projectreportshow($id)
    {
        $projectshow = Project::with('program')->findOrFail($id);
        $templates = Template::where('project_id', '=', $id)->orderBy('template_name')->get();
        $definitions = Definition::whereIn('template_id', $templates->pluck('id'))->get();

        return view('reports.projectreport', array_merge(
            compact('projectshow', 'templates', 'definitions'),
            $this->headerNotifications()
        ));
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
        return redirect()->route('projectreportshow', $request->input('project_id'))
                        ->with('success','Template Created successfully');
    }


    public function createdefinition(Request $request)
    {
         $this->validate($request, [
            'template_id' => 'required|exists:templates,id',
            'definition_title' => '',
            'standard' => '',
            'status' => 'required',
            'created_by' => 'required'
        ]);

        $input = $request->all();
        $definition = Definition::create($input);
        $projectId = Template::findOrFail($request->input('template_id'))->project_id;
        return redirect()->route('projectreportshow', $projectId)
                        ->with('success','Definition Created Successfully');
    }

    private function headerNotifications()
    {
        $userId = Auth::id();

        return [
            'notifcations' => BarNotification::where('status', '=', '01')
                ->where('user_id', $userId)
                ->get(),
            'notificationcount' => DB::table('bar_notifications')
                ->where('status', '=', '01')
                ->where('user_id', $userId)
                ->count(),
        ];
    }
}

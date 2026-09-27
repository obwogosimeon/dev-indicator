<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Document;
use App\Program;
use App\Project;
use Auth;
use App\BarNotification;
use DB;

class DocumentController extends Controller
{
	public function index()
	{	
		$notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
        $notificationcount = DB::table('bar_notifications')
        ->where('status', '=', '01')
        ->where('user_id', Auth::user()->id)
        ->count();
		$documents = Document::all();
		return view('documents.index', compact('documents','notifcations','notificationcount'));
	}

	public function create()
	{	
		$notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
        $notificationcount = DB::table('bar_notifications')
        ->where('status', '=', '01')
        ->where('user_id', Auth::user()->id)
        ->count();
		$projects = Project::where('organization_id', Auth::user()->organization_id)->get();
		$programs = Program::where('organization_id', Auth::user()->organization_id)->get();
		return view('documents.create', compact('projects', 'programs','notifcations','notificationcount'));
	}

	public function store(Request $request)
	{

		$this->validate($request, [
			'doc_name' => 'required|string|max:255',
			'file' => 'required|max:50000',
			'user_id' => 'required',
			'organization_id' => 'required',
			'project_id' => '',
			'program_id' => '',
			'status' => 'required'
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
		$doc->organization_id = $request->input('organization_id');
		$doc->project_id = $request->input('project_id');
		$doc->program_id = $request->input('program_id');
		$doc->status = $request->input('status');
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

		toastr()->addSuccess('Document uploaded Successfully.');
		return back()->withInput(['tab'=>'tabItem11']);


	}

	public function documentview($id)
{
    $doc = Document::findOrFail($id);
    $path = Storage::disk('local')->getDriver()->getAdapter()->applyPathPrefix($doc->file);
    $type = $doc->mimetype;

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
}

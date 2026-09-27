<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

use App\Year;
use App\BarNotification;
use Auth;
use DB;

class YearController extends Controller
{
    public function index()
    {
        $years = Year::all();
        $notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
        $notificationcount = DB::table('bar_notifications')
        ->where('status', '=', '01')
        ->where('user_id', Auth::user()->id)
        ->count();
        return view('years.index', compact('years','notifcations','notificationcount'));
    }

    public function create()
    {
        return view('years.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'year_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'created_by' => 'required',
            'organization_id' => 'required',
            'status' => 'required',
            'program_id' => 'required',
        ]);

        $input = $request->all();
        $year = Year::create($input);
        toastr()->addSuccess('Fiscal Year Created successfully');
        return back()->withInput(['tab'=>'tabItem9']);
    }

     public function show($id)
    {
        $yearshow = Year::find($id);
        return view('years.show',compact('yearshow'));
    }

    public function edit($id)
    {
        $yearedit = Year::find($id);
        return view('years.edit', compact('yearedit'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'year_name' => '',
            'start_date' => '',
            'end_date' => '',
        ]);
        $input = $request->all();
        $year = Year::find($id);
        $year->update($input);
        return redirect()->route('years.index')->with('success','Year Updated successfully');
    }
}

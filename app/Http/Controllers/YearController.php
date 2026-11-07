<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Year;
use App\BarNotification;
use Auth;

class YearController extends Controller
{
    public function index()
    {
        $years = Year::all();
        return view('years.index', array_merge(
            compact('years'),
            $this->navigationNotifications()
        ));
    }

    public function create()
    {
        return view('years.create', $this->navigationNotifications());
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
        $yearshow = Year::findOrFail($id);
        return view('years.show', array_merge(
            compact('yearshow'),
            $this->navigationNotifications()
        ));
    }

    public function edit($id)
    {
        $yearedit = Year::findOrFail($id);
        return view('years.edit', array_merge(
            compact('yearedit'),
            $this->navigationNotifications()
        ));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'year_name' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);
        $input = $request->all();
        $year = Year::findOrFail($id);
        $year->update($input);
        if ($year->program_id) {
            return redirect()->route('programs.show', $year->program_id)
                ->with('success', 'Year Updated successfully');
        }
        return redirect()->route('years.index')->with('success','Year Updated successfully');
    }

    private function navigationNotifications()
    {
        $notifications = BarNotification::where('status', '01')
            ->where('user_id', Auth::id())
            ->get();

        return [
            'notifcations' => $notifications,
            'notificationcount' => $notifications->count(),
        ];
    }
}

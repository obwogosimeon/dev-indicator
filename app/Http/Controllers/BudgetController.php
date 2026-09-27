<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Budget;
use App\BarNotification;
use Auth;
use DB;

class BudgetController extends Controller
{
    public function edit($id)
    {
        $budget = Budget::find($id);
        return response()->json($budget);
    }

    public function updatexpense(Request $request, $id)
    {
        // $data = $request->all();
        // dd($data);
        $budget = Budget::find($id);
        $notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
        $notificationcount = DB::table('bar_notifications')
        ->where('status', '=', '01')
        ->where('user_id', Auth::user()->id)
        ->count();
        return view('projects.fundings.budgetexpense', compact('budget','notifcations','notificationcount'));
    }
}

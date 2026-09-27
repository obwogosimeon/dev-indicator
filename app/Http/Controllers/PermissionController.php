<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Permission;
use App\BarNotification;
use DB;

use Auth;

class PermissionController extends Controller
{
    public function index()
    {   
        $notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
        $notificationcount = DB::table('bar_notifications')
        ->where('status', '=', '01')
        ->where('user_id', Auth::user()->id)
        ->count();
    	$permissions = Permission::all();
    	return view('permissions.index', compact('permissions','notifcations','notificationcount'));
    }


    public function create()
    {   
        $notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
        $notificationcount = DB::table('bar_notifications')
        ->where('status', '=', '01')
        ->where('user_id', Auth::user()->id)
        ->count();
    	return view('permissions.create', compact('notifcations','notificationcount'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'alias' => 'required',
            'category' => 'required',
            'guard_name' => 'required',
        ]);

        $input = $request->all();
        $currency = Permission::create($input);
        return redirect()->route('permissions.index')
                        ->with('success','Permission Created Successfully');
    }
}

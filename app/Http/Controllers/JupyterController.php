<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\BarNotification;
use Auth;
use DB;

class JupyterController extends Controller
{
    public function jupyter()
    {
        $notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
        $notificationcount = DB::table('bar_notifications')
        ->where('status', '=', '01')
        ->where('user_id', Auth::user()->id)
        ->count();

        return view('jupyter.login', compact('notifcations','notificationcount'));
    }
}

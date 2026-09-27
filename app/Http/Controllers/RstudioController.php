<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\BarNotification;
use Auth;
use DB;

class RstudioController extends Controller
{
    public function rstudio()
    {
        $notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
        $notificationcount = DB::table('bar_notifications')
        ->where('status', '=', '01')
        ->where('user_id', Auth::user()->id)
        ->count();

        return view('rstudio.login', compact('notifcations','notificationcount'));
    }
}

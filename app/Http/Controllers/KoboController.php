<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\BarNotification;
use Auth;
use DB;

class KoboController extends Controller
{
    public function getkobo()
    {
        $notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
        $notificationcount = DB::table('bar_notifications')
        ->where('status', '=', '01')
        ->where('user_id', Auth::user()->id)
        ->count();

        return view('kobo.login', compact('notifcations','notificationcount'));
    }
}

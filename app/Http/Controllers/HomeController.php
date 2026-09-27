<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Organization;
use App\Project;
use DB;
use Carbon;
use Auth;
use Hash;
use App\User;
use App\Funding;
use App\BarNotification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       if ((Auth::user()->password_change_at == null)) 
       {
         return redirect(route('change-password'));
     } else {
        $projects = DB::table('projects')->where('created_by', Auth::user()->id)->count();
        $programs = DB::table('programs')->where('created_by', Auth::user()->id)->count();
        $accounts = DB::table('accounts')->count();
        $affiliate = DB::table('orgnization_invites')
                        ->where('inviter_id', Auth::user()->organization_id)
                        ->where('status', '=', '02')
                        ->count();
        $fundings = Funding::all();
        $notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
        $notificationcount = DB::table('bar_notifications')
        ->where('status', '=', '01')
        ->where('user_id', Auth::user()->id)
        ->count();
        return view('backend.dash', compact('projects', 'programs', 'accounts','fundings',
            'notifcations', 'notificationcount', 'affiliate'));
    }

}

public function organization()
{
    return view('organization');
}

public function thankyou()
{
    return view('thankyou');
}

public function organizationassign(Request $request)
{

    return view('stdashboard');
}

public function showChangePasswordForm()
{
    return view('auth.passwords.changepassword');
}

public function changePassword(Request $request)
{
    if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
        return redirect()->back()->with("error","Your current password does not match with the password you provided. Please try again.");
    }elseif(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
        return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
    }else{

        $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|max:255|min:8',
            'new-password-confirm' => 'same:new-password',
        ]);

        $user = User::find(auth()->user()->id);
        $user->password = Hash::make($request->get('new-password'));
        $user->password_change_at = \Carbon\Carbon::now();
        $user->save();

        return redirect()->route('login')->with('success','Password changed successfully! Please Login');
    }
}


}

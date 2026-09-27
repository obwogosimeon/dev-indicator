<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notification;

class SettingController extends Controller
{
    public function index()
    {
    	$notifications = Notification::all();
        return view('settings.index', compact('notifications'));
    }


    public function notification()
    {
    	$notifications = Notification::all();
    	return view('notifications.index', compact('notifications'));
    }

    public function createnotification() 
    {
    	return view('notifications.create');
    }


    public function storenotification(Request $request)
    {
    	$this->validate($request, [
            'organization_id' => 'required',
            'created_by' => 'required',
            'driver' => 'required',
            'host' => 'required',
            'port' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $input = $request->all();
        $currency = Notification::create($input);
        return redirect()->route('notificationget')
                        ->with('success','Notification Mode Created Successfully');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Hash;

use App\Organization;
use App\PackageType;
use App\User;
use App\OrgnizationInvite;
use App\BarNotification;
use Auth;
use App\Notifications\MemberCreated;
use App\Notifications\InviteOrganization;
use DB;

class OrganizationController extends Controller
{
	public function index()
	{
		$organizations = Organization::where('id', Auth::user()->organization_id)
		->orWhere('parent_id', Auth::user()->organization_id)->get();
		$notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
		$notificationcount = DB::table('bar_notifications')
		->where('status', '=', '01')
		->where('user_id', Auth::user()->id)
		->count();
		return view('organization.index', compact('organizations','notifcations','notificationcount'));
	}


	public function barnotify()
	{
		$barnotifies = BarNotification::where('user_id', Auth::user()->id)->get();
		$notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
		$notificationcount = DB::table('bar_notifications')
		->where('status', '=', '01')
		->where('user_id', Auth::user()->id)
		->count();
		return view('organization.barnotify', compact('barnotifies', 'notifcations', 'notificationcount'));
	}

	public function managebarnotify($id)
	{
		$managebarnotify = BarNotification::find($id);
		$notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
		$notificationcount = DB::table('bar_notifications')
		->where('status', '=', '01')
		->where('user_id', Auth::user()->id)
		->count();
		return view('organization.managebarnotify', compact('managebarnotify', 'notifcations', 'notificationcount'));
	}


	public function acceptinvite(Request $request, $id)
	{
    // Find the bar notification
		$managebarnotify = BarNotification::find($id);

    // If the notification is not found, return an error
		if (!$managebarnotify) {
			toastr()->addError('Notification not found.');
			return back();
		}

    // Update notification fields
		$managebarnotify->accept_comment = $request->accept_comment;
		$managebarnotify->approved_by = $request->approved_by;
		$managebarnotify->status = $request->status;
		$managebarnotify->save();

    // Get the user's organization
		$organization = Organization::find(Auth::user()->organization_id);

    // Check if organization is found
		if (!$organization) {
			toastr()->addError('Organization not found.');
			return back();
		}

    // Update the parent_id
		$organization->parent_id = $managebarnotify->organization_id;
		$organization->save();

    // Get the notifications for the user
		$notifcations = BarNotification::where('status', '=', '01')
		->where('user_id', Auth::user()->id)
		->get();

    // Get the count of notifications
		$notificationcount = DB::table('bar_notifications')
		->where('status', '=', '01')
		->where('user_id', Auth::user()->id)
		->count();

    // Add a success message and return
		toastr()->addSuccess('Invite Accepted!');
		return back()->with('message', 'Base Currency Updated Successfully!', compact('notifcations', 'notificationcount'));
	}



	public function rejectinvite(Request $request, $id)
	{
		$managebarnotify = BarNotification::find($id);
		$managebarnotify->rejection_comment = $request->rejection_comment;
		$managebarnotify->rejected_by = $request->rejected_by;
		$managebarnotify->status = $request->status;
		$managebarnotify->save();

		$notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
		$notificationcount = DB::table('bar_notifications')
		->where('status', '=', '01')
		->where('user_id', Auth::user()->id)
		->count();

		toastr()->addSuccess('Invite Rejected!');
		return back()->with('message', 'Base Currency Updated Successfully!', compact('notifcations', 'notificationcount'));
	}

	public function closeinvite(Request $request, $id)
	{
		$managebarnotify = BarNotification::find($id);
		$managebarnotify->close_comment = $request->close_comment;
		$managebarnotify->closed_by = $request->closed_by;
		$managebarnotify->status = $request->status;
		$managebarnotify->save();

		$notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
		$notificationcount = DB::table('bar_notifications')
		->where('status', '=', '01')
		->where('user_id', Auth::user()->id)
		->count();

		toastr()->addSuccess('Invite Closed!');
		return back()->with('message', 'Base Currency Updated Successfully!', compact('notifcations', 'notificationcount'));
	}


	public function create()
	{	

		$access_code = mt_rand(100000,999999);	
		$packages = PackageType::all();
		$organizations = Organization::all();
		$userorg = Organization::where('id', Auth::user()->organization_id)->get();
		$userorganization = Organization::where('id', Auth::user()->organization_id)->first();
		$notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
		$notificationcount = DB::table('bar_notifications')
		->where('status', '=', '01')
		->where('user_id', Auth::user()->id)
		->count();
		return view('organization.create', compact('packages', 'access_code', 'userorg', 'organizations', 
			'userorganization','notifcations','notificationcount'));
	}


	public function store(Request $request)
	{

		$input = $request->all();

		$input =  OrgnizationInvite::create([
			'inviter_id' => $input['inviter_id'],
			'invited_id' => $input['invited_id'],
			'email' => $input['email_address'],
			'status' => $input['status'],
			'yourorganization' => $input['yourorganization'],
		]);

		// dd($input);


		$barnotifications = new BarNotification;
		$barnotifications->type = 'Orgnization Invite';
		$barnotifications->datetime = date("Y-m-d");
		$barnotifications->organizationfrom = $input['yourorganization'];
		$barnotifications->user_id = $request->adminid;
		$barnotifications->status = '01';
		$barnotifications->organization_id = $input['inviter_id'];
		$barnotifications->description = $input['yourorganization'].' invites you to be an affilicate organization';
		$barnotifications->save();

		$input->notify(new InviteOrganization($input));

		toastr()->addSuccess('Organization Added successfully...Pending Approval');
		return redirect()->route('organizations.index');


	}


	public function inviteorganization(Request $request, $organization_name)
	{
		$input = $request->all();
		$program = Organization::find($id);

		$input =  Organization::create([
			'access_code' => $input['access_code'],
			// 'kra_pin' => $input['kra_pin'],
			'parent_id' => json_encode($input['organization_id1']),
			'email' => $input['email_address'],
			'organization_name' => $input['organization_name'],
			'created_by' => $input['created_by'],
			'status' => $input['status'],
			'yourorganization' => $input['yourorganization'],
			// 'organization_level' => $input['organization_level'],
			// 'package_type_id' => $input['package_type_id'],
		]);

		$barnotifications = new BarNotification;
		$barnotifications->type = 'Orgnization Invite';
		$barnotifications->datetime = date("Y-m-d");
		$barnotifications->organizationfrom = $input['yourorganization'];
		$barnotifications->user_id = $request->adminid;
		$barnotifications->status = '01';
		$barnotifications->organization_id = $request->organization_id;
		$barnotifications->description = $input['yourorganization'].' invites you to be an affilicate organization';
		$barnotifications->save();

		$input->notify(new InviteOrganization($input));

		toastr()->addSuccess('Organization Added successfully...Pending Approval');
		return redirect()->route('organizations.index');
	}


	public function show($id)
	{
		$orgshow = Organization::find($id);
		$users = User::all();
		$orgusers = User::where('organization_id', '=', $id)->get();
		$notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
		$notificationcount = DB::table('bar_notifications')
		->where('status', '=', '01')
		->where('user_id', Auth::user()->id)
		->count();
		return view('organization.show', compact('orgshow', 'users', 'orgusers','notifcations','notificationcount'));
	}


	public function edit($id)
	{
		$organization = Organization::find($id);
		$notifcations = BarNotification::where('status', '=', '01')->where('user_id', Auth::user()->id)->get();
		$notificationcount = DB::table('bar_notifications')
		->where('status', '=', '01')
		->where('user_id', Auth::user()->id)
		->count();
		return view('organization.edit', compact('organization','notifcations','notificationcount'));
	}

	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[random_int(0, $charactersLength - 1)];
		}
		return $randomString;
	}


	public function addmember(Request $request)
	{

		$rawpassword = $this->generateRandomString();

		$input = $request->all();
		$input['password'] = Hash::make($rawpassword);

		$member =  User::create([
			'name' => $input['name'],
			'last_name' => $input['last_name'],
			'email' => $input['email'],
			'roles' => $input['roles'],
			'organization_id' => $input['organization_id'],
			'created_by' => $input['created_by'],
			'password' => Hash::make($rawpassword),
			'rawpassword' => $rawpassword,
		]);


		$member->assignRole($request->input('roles'));

		$member->notify(new MemberCreated($member));

		toastr()->addSuccess('Member Added successfully, The member will get an email Notification with login credentials');
		return back()->with('message', 'Member Added successfully');
	}

}

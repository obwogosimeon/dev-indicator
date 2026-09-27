<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;

use App\User;
use DB;

class APIController extends BaseController
{
    public function registeruser()
    {
        // $rusers = User::where('ruser', '=', '1')->get();
        $rusers = DB::table('users')
        ->select('id', 'email', DB::raw("CONCAT(name, ' ', last_name) as full_name"))
        ->where('ruser', '=', '1')->get();
        return $this->sendResponse($rusers->toArray(), 'R Studio Users Retrieved Successfully!.');

    }


    public function updateruser(Request $request, $id)
    {

        $process = User::find($id);
        $process->ruser = '2';
        $process->save();

        return $this->sendResponse($process->toArray(), 'User updated successfully.');

    }
}

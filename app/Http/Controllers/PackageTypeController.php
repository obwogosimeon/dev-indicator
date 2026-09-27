<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\PackageType;

class PackageTypeController extends Controller
{
    public function index()
    {
    	$packages = PackageType::all();
    	return view('packages.index', compact('packages'));
    }

    public function create()
    {
    	return view('packages.create');
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
            'package_name' => 'required',
            'package_amount' => 'required',
            'user' => 'required',
            'project' => 'required',
        ]);

        $input = $request->all();
        $department = PackageType::create($input);
        return redirect()->route('packages.index')
                        ->with('success','Package Created successfully');
    }
}

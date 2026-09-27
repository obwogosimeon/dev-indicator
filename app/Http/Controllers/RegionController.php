<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Region;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::all();
        return view('regions.index', compact('regions'));
    }


    public function create()
    {
        return view('regions.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'region_name' => 'required',
            'description' => 'required',
        ]);

        $input = $request->all();
        $region = Region::create($input);
        return redirect()->route('regions.index')
                        ->with('success','Region Created successfully');
    }


    public function show($id)
    {
        $regionshow = Region::find($id);
        return view('regions.show',compact('regionshow'));
    }

    public function edit($id)
    {
        $regionedit = Region::find($id);
        return view('regions.edit', compact('regionedit'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'region_name' => 'required',
            'description' => 'required',
        ]);
        $input = $request->all();
        $region = Region::find($id);
        $region->update($input);
        return redirect()->route('regions.index')->with('success','Region Updated successfully');
    }
}

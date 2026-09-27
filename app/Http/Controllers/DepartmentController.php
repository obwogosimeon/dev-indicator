<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Department;

class DepartmentController extends Controller
{
        public function index()
    {
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }


    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'department_name' => 'required',
            'description' => 'required',
        ]);

        $input = $request->all();
        $department = Department::create($input);
        return redirect()->route('departments.index')
                        ->with('success','Department Created successfully');
    }

    public function show($id)
    {
        $departmentshow = Department::find($id);
        return view('departments.show',compact('departmentshow'));
    }

    public function edit($id)
    {
        $departmentedit = Department::find($id);
        return view('departments.edit', compact('departmentedit'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'department_name' => 'required',
            'description' => 'required',
        ]);
        $input = $request->all();
        $depatment = Department::find($id);
        $depatment->update($input);
        return redirect()->route('departments.index')->with('success','Department Updated successfully');
    }
}

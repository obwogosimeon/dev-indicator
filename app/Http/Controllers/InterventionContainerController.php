<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\InterventionContainer;

class InterventionContainerController extends Controller
{
    public function index()
    {
      $interventioncontainers = InterventionContainer::all();
      toastr()
        ->positionClass('toast-top-center')
        ->addSuccess('InterventionContainer Created successfully');
          return back()->with('message', 'InterventionContainer Created successfully');
    }

    public function edit($id)
    {
        $interventioncontainer = InterventionContainer::find($id);
        return response()->json($interventioncontainer);
    }

    public function destroy($id)
    {
        InterventionContainer::find($id)->delete();
        return response()->json(['success'=>'Intervention Container Deleted Successfully.']);
    }
}

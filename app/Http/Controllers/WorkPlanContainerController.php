<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\WorkPlanContainer;

class WorkPlanContainerController extends Controller
{
     public function index()
    {
      $workplancontainers = WorkPlanContainer::all();
      toastr()
        ->positionClass('toast-top-center')
        ->addSuccess('WorkPlanContainer Created successfully');
          return back()->with('message', 'WorkPlanContainer Created successfully');
    }

    public function edit($id)
    {
        $workplancontainer = WorkPlanContainer::find($id);
        return response()->json($workplancontainer);
    }

    public function destroy($id)
    {
        WorkPlanContainer::find($id)->delete();
        return response()->json(['success'=>'Work Plan Container Deleted Successfully.']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Intervention;

class InterventionController extends Controller
{

    public function index()
    {
      $interventions = Intervention::all();
      toastr()
        ->positionClass('toast-top-center')
        ->addSuccess('Intervention Created successfully');
          return back()->with('message', 'Intervention Created successfully');
    }
    public function edit($id)
    {
        $interventions = Intervention::find($id);
        return response()->json($interventions);
    }
}

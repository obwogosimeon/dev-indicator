<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Currency;

class CurrencyController extends Controller
{
    public function index()
    {
        $currencies = Currency::all();
        return view('currency.index', compact('currencies'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'currency_name' => 'required',
            'start_date' => 'required',
            'kes' => 'required',
            'rwf' => 'required',
            'tzs' => 'required',
            'ugx' => 'required',
            'usd' => 'required',
            'euro' => 'required',
            'program_id' => 'required',
            'organization_id' => 'required',
            'created_by' => 'required',
            'status' => 'required',
        ]);

        $input = $request->all();
        $currency = Currency::create($input);
        toastr()->addSuccess('Currency Exchange Created Successfully');
        return back()->withInput(['tab'=>'tabItem10']);
    }



}

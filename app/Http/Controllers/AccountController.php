<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Account;
use App\Funding;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::all();
        return view('accounts.index', compact('accounts'));
    }


    public function create()
    {
        return view('accounts.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'account_name' => 'required',
            'account_code' => 'required',
            'account_type' => '',
            'account_group' => 'required',
            'description' => '',
        ]);

        $input = $request->all();
        $account = Account::create($input);
        return redirect()->route('accounts.index')
                        ->with('success','Account Created successfully');
    }


    public function show($id)
    {
        $accountshow = Account::find($id);
        return view('accounts.show',compact('accountshow'));
    }

    public function edit($id)
    {
        $accountedit = Account::find($id);
        return view('accounts.edit', compact('accountedit'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'account_name' => 'required',
            'account_code' => 'required',
            'account_type' => 'required',
            'account_group' => '',
            'description' => '',
        ]);
        $input = $request->all();
        $account = Account::find($id);
        $account->update($input);
        return redirect()->route('accounts.index')->with('success','Account Updated successfully');
    }


    //Funding Management

    public function funding()
    {
        $fundings = Funding::all();
        return view('accounts.fundingindex', compact('fundings'));
    }

    public function fundingcreate()
    {
        return view('accounts.fundingcreate');
    }

    public function fundingstore(Request $request)
    {
        $this->validate($request, [
            'funding_name' => 'required',
            'funding_type' => 'required',
            'expenditure' => 'required',
            'variable_name' => 'required',
            'description' => '',
            'created_by' => 'required',
            'organization_id' => 'required',
            'type' => 'required',
            'status' => 'required',
            'program_id' => 'required',
        ]);

        $input = $request->all();
        $currency = Funding::create($input);
        toastr()->addSuccess('Funding Created Successfully');
        return back()->withInput(['tab'=>'tabItem8']);
    }


    public function fundingedit($id)
    {
        $fundingedit = Funding::find($id);
        return view('accounts.fundingedit', compact('fundingedit'));
    }


    public function fundingupdate(Request $request, $id)
    {
        $this->validate($request, [
            'funding_name' => 'required',
            'funding_type' => 'required',
            'expenditure' => 'required',
            'variable_name' => '',
            'description' => '',
            'updated_by' => '',
        ]);
        $input = $request->all();
        $funding = Funding::find($id);
        $funding->update($input);
        return redirect()->route('accounts.index')->with('success','Funding Updated successfully');
    }
}

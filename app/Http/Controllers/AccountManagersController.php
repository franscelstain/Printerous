<?php

namespace App\Http\Controllers;

use App\AccountManager;
use App\Organization;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;

class AccountManagersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::select('users.*', 'b.org_name')->leftJoin('organizations as b', 'users.id', 'b.account_manager_id')->where('user_type', 'Account Manager')->get();
        return view('manager.table', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->form_ele('Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->save($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AccountManager  $accountManager
     * @return \Illuminate\Http\Response
     */
    public function show(AccountManager $accountManager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AccountManager  $accountManager
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountManager $accountManager)
    {
        return $this->form_ele('Edit', $accountManager);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AccountManager  $accountManager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountManager $accountManager)
    {
        return $this->save($request, $accountManager);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AccountManager  $accountManager
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountManager $accountManager)
    {
        $amg = AccountManager::find($accountManager->id);
        $amg->delete();
        Session::put(['success', 'Data Account Manager deleted successfully!']);
    }

    public function form_ele($act, $data = [])
    {
        $org = Organization::whereNull('account_manager_id');
        if ($act == 'Edit' && !empty($data))
            $org->orWhere('account_manager_id', $data->id);

        return view('manager.form', [
            'act'   => $act, 
            'dt'    => \Session::has('_old_input') ? (object) Session::get('_old_input') : $data,
            'org'   => $org->get()
        ]);
    }

    public function save($request, $amg = null)
    {
        $validator = Validator::make($request->all(), AccountManager::rules());
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $pass   = !empty($request->password) ? ['password' => app('hash')->make($request->password)] : [];
        $act    = empty($amg->id) ? 'created' : 'updated';
        $data   = array_merge(['name' => $request->name, 'email' => $request->email, 'user_type' => 'Account Manager'], $pass);
        $save   = empty($amg->id) ? AccountManager::create($data) : AccountManager::where('id', $amg->id)->update($data);
        $id     = !empty($amg->id) ? $amg->id : $save->id;

        if (!empty($request->org_id))
            Organization::where('id', $request->org_id)->update(['account_manager_id' => $id]);

        return redirect('account-manager')->with('success', 'Data Account Manager '. $act .' successfully!');
    }
}

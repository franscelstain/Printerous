<?php

namespace App\Http\Controllers;

use App\Organization;
use App\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Auth;
use Session;

class OrganizationsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Organization::all();
        return view('organization.table', ['data' => $data]);
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
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        $person = Person::where('org_id', $organization->id)->get();
        return view('organization.show', ['dt' => $organization, 'person' => $person]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        return $this->form_ele('Edit', $organization);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    {
        return $this->save($request, $organization);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        $org = Organization::find($organization->id);
        $org->delete();
        Session::put(['success', 'Data Organization deleted successfully!']);
    }

    public function form_ele($act, $data = [])
    {
        if (!empty($data->id) && Auth::user()->user_type != 'Admin' && Auth::user()->id != $data->account_manager_id)
            return redirect('organization');
            
        return view('organization.form', [
            'act'   => $act, 
            'dt'    => \Session::has('_old_input') ? (object) Session::get('_old_input') : $data
        ]);
    }

    public function save($request, $org = null)
    {
        $validator = Validator::make($request->all(), Organization::rules());
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $act    = empty($org->id) ? 'created' : 'updated';
        $amg_id = $act == 'created' && Auth::user()->user_type == 'Account Manager' ? ['account_manager_id' => Auth::id()] : [];
        $data   = array_merge(['org_name' => $request->org_name, 'email' => $request->email, 'phone' => $request->phone, 'website' => $request->website], $amg_id);
        $save   = empty($org->id) ? Organization::create($data) : Organization::where('id', $org->id)->update($data);
        $id     = !empty($org->id) ? $org->id : $save->id;
        if ($request->hasFile('logo'))
        {
            $file = $request->file('logo');
            $logo = $id . '_' . $file->getClientOriginalName();
            $file->move(storage_path('app/public/organization'), $logo);
            Organization::where('id', $id)->update(['logo' => $logo]);
        }

        return redirect('organization')->with('success', 'Data Organization '. $act .' successfully!');
    }
}

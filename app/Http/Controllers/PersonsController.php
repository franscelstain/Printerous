<?php

namespace App\Http\Controllers;

use App\Organization;
use App\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Session;

class PersonsController extends Controller
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
        $data = Person::select('persons.*', 'b.org_name')->join('organizations as b', 'persons.org_id', 'b.id')->get();
        return view('person.table', ['data' => $data]);
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
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        $org = Organization::find($person->org_id);
        return view('person.show', ['dt' => $person, 'org' => $org]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        return $this->form_ele('Edit', $person);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        return $this->save($request, $person);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        $psn = Person::find($person->id);
        $psn->delete();
        Session::put(['success', 'Data Person deleted successfully!']);
    }

    public function form_ele($act, $data = [])
    {
        return view('person.form', [
            'act'   => $act, 
            'dt'    => \Session::has('_old_input') ? (object) Session::get('_old_input') : $data,
            'org'   => Organization::all()
        ]);
    }

    public function save($request, $org = null)
    {
        $validator = Validator::make($request->all(), Person::rules());
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $act    = empty($org->id) ? 'created' : 'updated';
        $data   = ['person_name' => $request->person_name, 'org_id' => $request->org_id, 'email' => $request->email, 'phone' => $request->phone];
        $save   = empty($org->id) ? Person::create($data) : Person::where('id', $org->id)->update($data);
        $id     = !empty($org->id) ? $org->id : $save->id;
        if ($request->hasFile('avatar'))
        {
            $file = $request->file('avatar');
            $ava  = $id . '_' . $file->getClientOriginalName();
            $file->move(storage_path('app/public/person'), $ava);
            Person::where('id', $id)->update(['avatar' => $ava]);
        }

        return redirect('person')->with('success', 'Data Person '. $act .' successfully!');
    }
}

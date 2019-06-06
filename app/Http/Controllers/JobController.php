<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Job;
use App\Category;
use App\City;
use App\Contract;
use App\Saved_job;
use App\Company;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::orderBy('created_at','DESC')->get();
        $categories = Category::all();

        return view('pages.job.index',['jobs' => $jobs, 'categories' => $categories, 'request' => '']);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $cities = City::orderBy('name')->get();
        $contracts = Contract::orderBy('name')->get();
        $companies = Company::where('id_user',Auth::user()->id)->get();

        return view('pages.job.create',['categories' => $categories, 'cities' => $cities,'contracts' => $contracts, 'companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'title' => 'required',
            'description' =>'required|min:100',
            'category' => 'required|numeric',
            'city' => 'required',
        ]);

        $job = new Job;
        $job->name = $request->title;
        $job->description = $request->description;
        $job->id_user = Auth::user()->id;
        $job->id_company = $request->company;
        $job->id_category = $request->category;
        $job->id_city = City::firstOrCreate(['name' => $request->city])->toArray()['id'];
        $job->id_contract = $request->contract;
        if($request->rate_min!='')
            $job->rate_min = $request->rate_min;
        if($request->rate_max!='')
            $job->rate_max = $request->rate_max;
        $job->save();

        session()->flash('notif','Pomyślnie dodano ofertę pracy'); 

        return redirect()->route('praca.show', ['job' => $job]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Job::findOrFail($id);
        $saved_job = false;
        if(Auth::user())
        {
            $rows = Saved_job::where([
                ['id_user','=', Auth::user()->id],
                ['id_job','=',$id]
            ])->get();
            if(count($rows)>0)
                $saved_job = true;
        }
            
        return view('pages.job.show',['job' => $job, 'saved' => $saved_job]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = Job::findOrFail($id);
        $categories = Category::orderBy('name')->get();
        $cities = City::orderBy('name')->get();
        $contracts = Contract::orderBy('name')->get();
        $companies = Company::where('id_user',Auth::user()->id)->get();

        return view('pages.job.edit',['job'=> $job, 'categories' => $categories, 'cities' => $cities, 'contracts' => $contracts,'companies'=>$companies]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'title' => 'required',
            'description' =>'required|min:100',
            'category' => 'required|numeric',
            'city' => 'required',
        ]);

        $job = Job::find($id);
        $job->name = $request->title;
        $job->description = $request->description;
        $job->id_category = $request->category;
        $job->id_company = $request->company;
        $job->id_city = City::firstOrCreate(['name' => $request->city])->toArray()['id'];
        $job->id_contract = $request->contract;
        if($request->rate!='')
            $job->rate = $request->rate;
        $job->save();

        session()->flash('notif','Pomyślnie edytowano ofertę pracy');

        return redirect()->route('praca.show', ['job' => $job]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = Job::find($id);

        if($job->id_user == Auth::user()->id)
        {
            Job::where('id',$id)->delete();
            Saved_job::where('id_job',$id)->delete();
        }
        else
            return redirect()->route('job_path', ['job' => $job]);

        session()->flash('notif','Pomyślnie usunięto ofertę pracy');

        return redirect()->route('praca.index');
    }

    public function save_job($id)
    {
        $rows = Saved_job::where([
            ['id_user','=', Auth::user()->id],
            ['id_job','=',$id]
        ])->get();

        if(count($rows)<1)
        {
            $save = new Saved_job;
            $save->id_user = Auth::user()->id;
            $save->id_job = $id;
            $save->save();
            session()->flash('notif', 'Pomyślnie zapisano ofertę pracy');
        }      

        return redirect()->route('praca.show',['job' => $id]);
    }

    public function unsave_job($id)
    {
        Saved_job::where([
            ['id_user','=', Auth::user()->id],
            ['id_job','=',$id]
        ])->delete();

        session()->flash('notif', 'Pomyślnie usunięto ofertę pracy');

        return redirect()->route('praca.show',['job' => $id]);
    }

}

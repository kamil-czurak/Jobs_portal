<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Job;
use App\Category;
use App\City;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $cities = City::orderBy('name')->get();

        return view('pages.city.index',['cities' => $cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.city.create');
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
            'name' => 'required|unique:cities,name'
        ]);

        $city = new City;
        $city->name = $request->name;
        $city->save();

        session()->flash('notif','Pomyślnie dodano miasto '.$city->name);

        return redirect()->route('miasto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        try{
            $city = City::where('name',$name)->firstOrFail();
            $jobs = Job::where('id_city',$city->id)->get();
            $categories = Category::all();

            return view('pages.job.index',['jobs' => $jobs, 'categories' => $categories, 'request' => 'miasta '.$name]);
        }
        catch(ModelNotFoundException $err)
        {
            return view('errors.search');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::where('id',$id)->firstOrFail();

        return view('pages.city.edit',['city' => $city]);
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
            'name' => 'required|unique:cities,name'
        ]);

        $city = City::find($id);
        $city->name = $request->name;
        $city->save();

        session()->flash('notif','Pomyślnie edytowano miasto '.$city->name);

        return redirect()->route('miasto.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::find($id); 
        City::where('id',$id)->delete();

        session()->flash('notif','Pomyślnie usunięto miasto '.$city->name);

        return redirect()->route('miasto.index');
    }
}

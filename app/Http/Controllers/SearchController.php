<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Job;
use App\City;
use App\Category;

class SearchController extends Controller
{
    public function index(Request $request)
    {
    	if($request->city!='' && $request->profession!='')
    		return $this->searchBothParams($request);
    	else if($request->city=='' && $request->profession!='' )
    		return $this->searchByProfession($request);
    	else if($request->city!='' && $request->profession=='' )
    		return redirect()->route('miasto.show',["city" => $request->city]);
    	
    }

    public function searchByProfession($request)
    {
        $jobs = Job::where('name','like','%'.$request->profession.'%')->get();
        $categories = Category::all();

        return view('pages.job.index',['jobs' => $jobs, 'categories' => $categories, 'request' => 'frazy '.$request->profession]);
    }

    public function searchBothParams($request)
    {
    	try{
            $city = City::where('name',$request->city)->firstOrFail();
            $jobs = Job::where([
            	['id_city','=',$city->id],
            	['name','like','%'.$request->profession.'%'],
            ])->get();
            $categories = Category::all();

            return view('pages.job.index',['jobs' => $jobs, 'categories' => $categories, 'request' => 'frazy '.$request->profession.' oraz miasta '.$request->city]);
        }
        catch(ModelNotFoundException $err)
        {
            return view('errors.search');
        }
    }
}

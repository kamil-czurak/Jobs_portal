<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Saved_job;
use App\Job;
use App\City;
use App\Company;

class AccountController extends Controller
{
    public function show()
    {
    	$saved_jobs = Saved_job::join('jobs','id_job','=','jobs.id')->where('saved_jobs.id_user',Auth::user()->id)->get();

    	$companies = Company::where('id_user',Auth::user()->id)->get();

    	$added_jobs = Job::where('id_user',Auth::user()->id)->get();

    	return view('pages.account.show',['jobs' => $saved_jobs, 'companies' => $companies, 'added_jobs' => $added_jobs]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Saved_job;
use App\Job;
use App\City;
use App\Company;
use App\Company_worker;

class AccountController extends Controller
{
    public function show()
    {
    	$saved_jobs = Saved_job::join('jobs','id_job','=','jobs.id')->where('saved_jobs.id_user',Auth::user()->id)->get();

    	$companies = Company_worker::where([
            ['id_user','=',Auth::user()->id],
            ['confirmed','=',true]
        ])->get();

    	$added_jobs = Job::where('id_user',Auth::user()->id)->get();

    	return view('pages.account.show',['jobs' => $saved_jobs, 'companies' => $companies, 'added_jobs' => $added_jobs]);
    }

    public function accept_worker($id_w, $id_c)
    {
    	$operation = Company_worker::where([
    		['id_user','=', $id_w],
    		['id_company','=', $id_c]
    	])->firstOrFail();
    	$operation->confirmed = true;
    	$operation->save();

        $user = User::find($id_w);
        $user->id_role = 2;
        $user->save();
        
    	session()->flash('notif', 'Pomyślnie zaakceptowano użytkownika do firmy');

    	return redirect()->route('account_path');
    }

    public function reject_worker($id_w, $id_c)
    {
    	$operation = Company_worker::where([
    		['id_user','=', $id_w],
    		['id_company','=', $id_c]
    	])->delete();

    	session()->flash('notif', 'Pomyślnie nie dodano użytkownika do firmy');

    	return redirect()->route('account_path');
    }

    public function apply_worker($id_w, $id_c)
    {
        $record = Company_worker::where([
            ['id_user','=', $id_w],
            ['id_company','=', $id_c]
        ])->first();
        if($record === null)
        {
            $operation = new Company_worker;
            $operation->id_company = $id_c;
            $operation->id_user = $id_w;

            $operation->save();

            session()->flash('notif','Wysłano prośbę o dodanie do firmy');
        }
        return redirect()->back();
        
    }
}

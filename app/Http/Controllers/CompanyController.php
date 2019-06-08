<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Company;
use App\Job;
use App\Category;
use App\Company_worker;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('name','DESC')->get();

        return view('pages.company.index',['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|unique:companies,name',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:9'
        ]);

        $company = new Company;
        $company->id_user = Auth::user()->id;
        $company->name = ucfirst($request->name);
        $company->email = $request->email;
        $company->phone = $request->phone;
        $company->save();

        $worker = new Company_worker;
        $worker->id_user = Auth::user()->id;
        $worker->id_company = $company->id;
        $worker->confirmed = true;
        $worker->save();

        session()->flash('notif','Pomyślnie utworzono nową firmę.');

        return redirect()->route('firma.show',['company' => $company->name]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        $company = Company::where('name',$name)->firstOrFail();
        $jobs = Job::where('id_company',$company->id)->get();
        $categories = Category::all();

        $worker_logic = false;
        if(Auth::user()&& Company_worker::where('id_user',Auth::user()->id)->where('id_company',$company->id)->first() === null)
            $worker_logic = true;

        return view('pages.job.index',['jobs' => $jobs, 'categories' => $categories, 'request' => 'firmy '.$name, 'company' => $company, 'worker_logic' => $worker_logic]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        $company_workers = Company_worker::where([
            ['id_company','=',$id],
            ['confirmed','=',true]
        ])->get();
        $logic = false;
        foreach ($company_workers as $worker) {
            if($worker->id_user == Auth::user()->id)
                $logic = true;
        }
        if(!$logic)
            return redirect()->route('account_path');
        
        $user_ver = Company_worker::where([
            ['id_company','=', $company->id],
            ['confirmed','=',false]
        ])->get();

        return view('pages.company.edit',['company' => $company, 'user_ver' => $user_ver]);
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
        $validate = $request->validate([
            'name' => 'required|unique:companies,name,'.$id,
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:9'
        ]);

        $company = Company::find($id);
        $company->id_user = Auth::user()->id;
        $company->name = ucfirst($request->name);
        $company->email = $request->email;
        $company->phone = $request->phone;
        $company->save();

        session()->flash('notif','Pomyślnie edytowano dane firmy');

        return redirect()->route('firma.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);

        Company::where('id',$id)->delete();
       
        Job::where('id_company',$company->id)->delete();

        Company_workerwhere('id_company',$company->id)->delete();

        session()->flash('notif','Pomyślnie usunięto firmę');

        return redirect()->back();
    }
}

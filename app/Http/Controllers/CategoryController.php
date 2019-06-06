<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Job;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('pages.category.index',['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.category.create');
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
            'name' =>'required|unique:categories,name'
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->save();

        session()->flash('notif','Pomyślnie utworzono kategorię '.$category->name);
        return redirect()->route('kategoria.index');
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
            $category = Category::where('name',$name)->firstOrFail();
            $jobs = Job::where('id_category',$category->id)->get();
            $categories = Category::all();

            return view('pages.job.index',['jobs' => $jobs, 'categories' => $categories, 'request' => 'kategoria '.$name]);
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
        $category = Category::findOrFail($id);

        return view('pages.category.edit',['category'=> $category]);
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
            'name' => 'required'
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();

        session()->flash('notif','Pomyślnie edytowano kategorię '.$category->name);
        return redirect()->route('kategoria.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        
        Category::where('id',$id)->delete();

        session()->flash('notif','Pomyślnie usunięto kategorię '.$category->name);

        return redirect()->route('kategoria.index');
    }
}

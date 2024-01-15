<?php

namespace App\Http\Controllers;

use App\Models\Questioncategory;
use App\Models\CategoryYear;
use App\Models\Timeframe;
use Illuminate\Http\Request;

class QuestioncategoryController extends Controller
{
    public function yearSelect()
    {
        $years = Timeframe::all();
        return view('admin.category.year', compact('years'));
    }
    public function categoriesYear($year)
    {
        $qAll = Questioncategory::all();
        $date = Timeframe::where('id', $year)->first();
        $categories = CategoryYear::where('timeframe_id',$date->id)->get();
        return view('admin.category.index', compact('categories','date','qAll'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Questioncategory::all();
        return view('admin.category.all', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'marks' => 'required',
        ]);

        $data = new Questioncategory;
        $data->category = $request->category;
        $data->marks = $request->marks;
        
        $data->save();

        return redirect('admin/category/create')->with('success','Category has been added.');
    }
    public function copyCategory(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'timeframe_id' => 'required',
        ]);

        $data = new CategoryYear;
        $data->questioncategory_id = $request->category_id;
        $data->timeframe_id = $request->timeframe_id;
        
        $data->save();

     
        return redirect()->back()->with('success','Category has been added.');
        
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Questioncategory  $questioncategory
     * @return \Illuminate\Http\Response
     */
    public function show(Questioncategory $questioncategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Questioncategory  $questioncategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Questioncategory::find($id);
        return view('admin.category.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Questioncategory  $questioncategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questioncategory $questioncategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Questioncategory  $questioncategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($year,$id)
    {
        if(CategoryYear::where('timeframe_id',$year)->where('questioncategory_id',$id)->delete()){
            return redirect()->back()->with('success','Category has been deleted.');
        }
    }
}

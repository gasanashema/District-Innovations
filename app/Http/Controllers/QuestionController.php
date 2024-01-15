<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionYear;
use App\Models\Questioncategory;
use App\Models\Timeframe;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    // a function to select year before adding question
    public function yearsSelect()
    {
        $years = Timeframe::orderByDesc('year')->get();
        return view('admin.question.year',compact('years'));
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($year)
    {
        $y = Timeframe::where('id',$year)->first();
        $categories = Questioncategory::all();
        $questions = QuestionYear::where('year_id',$year)->get();
        
        return view('admin.question.index', compact('questions','categories','y'));
    }

    public function all_questions()
    {
      
        $categories = Questioncategory::all();
        $questions = Question::all();
        
        return view('admin.question.all', compact('questions','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($year)
    {
        $y = Timeframe::where('id',$year)->first();
        $categories = Questioncategory::all();
        $qAll = Question::all();
        return view('admin.question.create', compact('categories','y','qAll'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$year)
    {
        $request->validate([
            'details' => 'required',
            'instructions' => 'required',
            'status' => 'required',
            'questioncategory_id' => 'required',
            'characters' => 'required',
        ]);

        $data = new Question;
        $data->questioncategory_id = $request->input('questioncategory_id');
        $data->details = $request->details;
        $data->instructions = $request->instructions;
        $data->number_of_characters = $request->characters;
        $data->status = $request->status;
        
        $data->save();

        // getting the id of the last inserted row

        $qestYear = new QuestionYear;
        $qestYear->question_id = $data->id;
        $qestYear->year_id = $year;
        $qestYear->save();

        $y =  Timeframe::where('id',$year)->first();
        $qAll = Question::all();
        $categories = Questioncategory::all();
        return view('admin.question.create',compact('y','qAll','categories'))->with('success','Question added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Question::find($id);
        return view('admin/question/show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Question::find($id);
        $categories = Questioncategory::all();
        return view('admin/question/edit',compact('data','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'details' => 'required',
            'instructions' => 'required',
            'status' => 'required',
            'questioncategory_id' => 'required',
            'characters' => 'required',
        ]);

        $data =Question::find($id);
        $data->questioncategory_id = $request->input('questioncategory_id');
        $data->details = $request->details;
        $data->instructions = $request->instructions;
        $data->number_of_characters = $request->characters;
        $data->status = $request->status;
        
        $data->save();

        return redirect('admin/question/'.$id.'/edit')->with('success','Question Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($year, $id)
    {
        $deleted = QuestionYear::where('question_id', $id)->where('year_id', $year)->delete();
    
        if ($deleted) {
            return redirect('admin/question/'.$year)->with('success', 'Question Removed Successfully');
        } else {
            return redirect('admin/question/'.$year)->with('success', 'Can Not Remove Question');
        }
    }
    


    public function question_copy(Request $request)
    {

        $check = QuestionYear::where('question_id',$request->question_id)->where('year_id',$request->year_id)->first();
        if ($check) {
            return redirect()->back()->with('success','Question Already Exist to this year.');
        }
        $data = new QuestionYear;
        $data->question_id = $request->question_id;
        $data->year_id = $request->year_id;
        if($data->save()){

            return redirect()->back()->with('success','Question Coppied successful.');
        }else{
            return redirect()->back()->with('success','Error');
        }
    }
}

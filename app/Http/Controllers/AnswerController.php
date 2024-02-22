<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\QuestionYear;
use App\Models\Practice;
use App\Models\Timeframe;
use Illuminate\Http\Request;

class AnswerController extends Controller
{

    function activeYear(){
        $year = Timeframe::where('status',true)->first();
    
        return $year;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$answers = Answer::all();
        //$practices=Practice::with('user')->get();
        $year = $this->activeYear();
        $questions = QuestionYear::where('year_id',$this->activeYear()->id)->get();
        $questCount = QuestionYear::where('year_id',$this->activeYear()->id)->count();
        $practices = auth()->user()->practices()->get();
        $answeredQ = auth()->user()->answers()->get();
        return view('user.answer.index',compact('practices','questions','answeredQ','year','questCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the form data (customize as needed)
        $request->validate([
            'question_id' => 'required',
            'practice_id' => 'required',
            'user_id' => 'required',
            'answer' => 'required',
        ]);
    
        // Create a new answer
        $answer = new Answer;
        $answer->question_id = $request->question_id;
        $answer->practice_id = $request->practice_id;
        $answer->user_id = $request->user_id;
        $answer->details = $request->answer;
    
        $answer->save();
    
        // You can return a response if needed
        return redirect('user/answer')->with('success','Answer has been added.');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'question_id' => 'required',
            'practice_id' => 'required',
            'user_id' => 'required',
            'answer' => 'required',
        ]);
    
        // Create a new answer
        $answer = Answer::find($id);
        $answer->question_id = $request->question_id;
        $answer->practice_id = $request->practice_id;
        $answer->user_id = $request->user_id;
        $answer->details = $request->answer;
    
        $answer->save();

        return redirect("user/answer/")->with('success',"Data updated successfuly");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        //
    }
}

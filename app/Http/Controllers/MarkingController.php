<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Marking;
use App\Models\MarkingCriteria;
use App\Models\District;
use App\Models\Practice;
use App\Models\Question;
use App\Models\Questioncategory;
use App\Models\Answer;
use App\Models\User;
use App\Models\Files;
use App\Models\Timeframe;
use App\Models\CategoryYear;

class MarkingController extends Controller
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
        $districts = District::withCount('practice')->orderBy('practice_count', 'desc')->get();


        return view('evaluator.marking.index',compact('districts'));
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
            'criteria_id' => 'required',
            'practice_id' => 'required',
            'marks' => 'required',
            'comment' => 'required',
        ]);
    
        // Check if a record with the given marking criteria and practice already exists
        $existingMark = Marking::where('markingcriteria_id', $request->criteria_id)
            ->where('practice_id', $request->practice_id)
            ->where('user_id', auth()->user()->id)
            ->first();
    
        if ($existingMark) {
            // If the record already exists, you may choose to update it or handle it accordingly
            // For now, let's assume you want to update the existing record
            $existingMark->marks = $request->marks;
            $existingMark->comment = $request->comment;
            $existingMark->save();
    
            // You can return a response if needed
            return redirect()->back()->with('success', 'Marks has been updated.');
        }
    
        // If no existing record, create a new marking
        $mark = new Marking;
        $mark->markingcriteria_id = $request->criteria_id;
        $mark->practice_id = $request->practice_id;
        $mark->user_id = auth()->user()->id;
        $mark->marks = $request->marks;
        $mark->comment = $request->comment;
    
        $mark->save();
    
        // storing district id to help in redirect
        $district = $request->district_id;
        $practice = $request->practice_id;
    
        // You can return a response if needed
        return redirect('evaluator/marking/' . $district . '/practices/' . $practice)->with('success', 'Marks has been added.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($district,$practice)
    {
        $practice = Practice::find($practice);
        $district = District::where('id',$district)->first();
        $year = Timeframe::where('status',true)->first();
        $categories = CategoryYear::where('timeframe_id',$year->id)->get();
        return view('evaluator.marking.show', compact('practice','district','categories'));
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $request->validate([
            'answer_id' => 'required',
            'practice_id' => 'required',
            'user_id' => 'required',
            'marks' => 'required',
        ]);
    
        // Create a new marking
        $mark = Marking::find($id);;
        $mark->marks = $request->marks;
        $district=$request->district_id;
        $mark->save();
        return redirect('evaluator/marking/'.$district)->with('success','Marks has been added.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function disrictPracties($id)
    {
        $practices = Practice::where('district_id', $id)->get();
        $district = District::find($id);

        return view('evaluator.marking.practices', compact('practices','district'));
    }


// ------ for admin
function practiceAvg($practice)
{
    $totalQuestions = Question::where('status', 1)->count();
    $totalEvaluators = User::where('type', 2)->count();
    $markedEvaluators = 0;
    $criterias = MarkingCriteria::all();
    $total = 0;

    foreach ($criterias as $criteria) {

            $markedEvaluators = Marking::where('markingcriteria_id', $criteria->id)->where('practice_id', $practice)->distinct('user_id')->count();
            if ($markedEvaluators != 0) {
                $mark = Marking::where('markingcriteria_id', $criteria->id)->where('practice_id', $practice)->sum('marks');
                $criteriaAvg = $mark / $markedEvaluators;
            }else{
                $criteriaAvg = 0;
            }
            

            $total += $criteriaAvg;
      
    }

    $average=$total;

    return $average;
}

public function obtainedMarks()
{
  
    // Get all practices
    $practices = Practice::where('timeframe_id',$this->activeYear()->id)->get();

    // Initialize an array to store practice details and marks
    $practiceDetails = [];

    // Loop through each practice and calculate the average marks
    foreach ($practices as $practice) {
        $practiceId = $practice->id;
        $marks = $this->practiceAvg($practiceId); // Correct namespace usage

        // Store practice details and marks in the array
        $practiceDetails[] = [
            'practiceId' => $practiceId,
            'practiceName' => $practice->name,
            'districtName' => $practice->district->name,
            'marks' => $marks,
        ];
    }

    // Sort the array based on marks
    usort($practiceDetails, function ($a, $b) {
        return $b['marks'] - $a['marks'];
    });

    // Display the sorted practice details
    return view('admin.marks.index', compact('practiceDetails'));
}



    public function answersDistricts()
    {
        $districts = District::orderBy('name', 'asc')->get();
    
        return view('admin.answers.index', compact('districts'));
    }
    public function reportDistricts()
    {
        $districts = District::orderBy('name', 'asc')->get();
    
        return view('admin.report.index', compact('districts'));
    }
    public function answers($id)
    {
        $district = District::find($id);
        $questions = Question::all();
        $practices = Practice::where('district_id',$id)->get();
        return view('admin.answers.show',compact('district','practices','questions'));
    }
    public function evaluation($id)
    {
        $district = District::find($id);
        $evaluators = User::where('type',2)->get();
        $practices = Practice::where('district_id',$id)->get();
        return view('admin.report.show',compact('district','practices','evaluators'));
    }
}

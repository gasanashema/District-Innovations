<?php

namespace app\Helpers;
use App\Models\Marking;
use App\Models\MarkingCriteria;
use App\Models\District;
use App\Models\Practice;
use App\Models\Question;
use App\Models\Questioncategory;
use App\Models\Answer;
use App\Models\User;
use App\Models\Timeframe;
use App\Models\QuestionYear;
use App\Models\CategoryYear;


// a function to check active year
    function activeYear() {
        $year = Timeframe::where('status', true)->first();
        return $year;
    }

    function practiceAvg($practice)
    {
        
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

    function districtAvg($district)
    {

        $totalPractice = Practice::where('district_id',$district)->count();
        $districtAvg =0;
        if ($totalPractice==0 || $totalPractice== null) {
            $districtAvg=0;
        }else{
            $practices = Practice::where('district_id',$district)->get();
            $totalAvg = 0;
            foreach ($practices as $practice) {
            
                $practiceMarks=practiceAvg($practice->id);

                $totalAvg += $practiceMarks;

            }
            $districtAvg = $totalAvg/$totalPractice;
        }
        return $districtAvg;
    }
    function practiceAprove($practice)
    {
        $totalQuestions = Question::where('status', 1)->count();
        $totalEvaluators = User::where('type', 2)->count();
        $markedEvaluators = 0;
        $questions = Question::all();
        $total = 0;
    
        foreach ($questions as $question) {
            $answer = Answer::where('practice_id', $practice)
                            ->where('question_id', $question->id)
                            ->first();
    
            // Check if $answer is not null before accessing its 'id' property
            if ($answer) {
                $ans_id = $answer->id;
                $questionAvg = 0;
    
                $markedEvaluators = Marking::where('answer_id', $ans_id)->distinct('user_id')->count();
                if ($markedEvaluators != 0) {
                    $mark = Marking::where('answer_id', $ans_id)->sum('marks');
                    $questionAvg = $mark / $markedEvaluators;
                }else{
                    $questionAvg = 0;
                }
                
    
                $total += $questionAvg;
            }
        }

        $average=($total/($totalQuestions*5))*100;
    
        return intval($average);
    }

    // a functin to take question category Id and return questions associated with that category
    function questionsInCategory($questioncategory)
    {
       $questions = Question::where('questioncategory_id',$questioncategory)->get();
       return $questions;
    }


    // a function to return marking criterias for a question category 
    function categoryCriterias($questioncategory)
    {
       $criterias = MarkingCriteria::where('questioncategory_id',$questioncategory)->get();
       return $criterias;
    }

    // a function to check if the criteria is marked and add a check icon
    function criteriaMarked($criteria,$practice,$user)
    {
       $marks = Marking::where('markingcriteria_id',$criteria)
                            ->where('practice_id',$practice)
                            ->where('user_id',$user)
                            ->first();
       return $marks;
    }

    // a function to display answers for evaluator

    function getAnswers($practice){
        $answers = Answer::where('practice_id',$practice)->get();
        return $answers;
    }

    // a function to display marks of each question category of a practice

    function categoryMarks($category, $practice, $user)
    {
        $criterias = MarkingCriteria::where('questioncategory_id', $category)->get();
    
        $total = 0;
        foreach ($criterias as $criteria) {
            $marks = Marking::where('markingcriteria_id', $criteria->id)
                ->where('practice_id', $practice)
                ->where('user_id', $user)
                ->first();
            if ($marks) {
                $total += $marks->marks;
            }
        }
    
        return $total;
    }

    // a function to calculate marks for a paractice

    function practiceMarks($practice, $user)
    {
    

            $marks = Marking::where('practice_id', $practice)
                ->where('user_id', $user)
                ->sum('marks');
            if ($marks) {
                return 'Marks: '.$marks;
            }else{
                return '<span class="text-danger">Practice Not Yet Marked</span>';
            }
    
        
    }

    // // hide answer editing button for user
    // function practiceMarkedCheck($practice){
    //     $marking= Marking::where('practice_id',$practice)->first();
    //     if ($marking) {
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }
    // e function to show evaluators who marked a practice
    function PracticeEvaluators($practice){
        $evaluators = Marking::where('practice_id', $practice)
        ->groupBy('user_id')
        ->get(['user_id']);
        return $evaluators;
    }
    // a funcion to calculate marks that each evaluator gave to a certain practice
    function EvaluatorPracticeMarks($practice,$user){
        $marks = Marking::where('practice_id',$practice)->where('user_id',$user)->sum('marks');
        return $marks;
    }

    // a function to check if all criterias of a practice are marked
    function checkAllPracticeMarked($practice, $user) {
        $practiceData = Practice::find($practice);
    
        $timeframe = Timeframe::find($practiceData->timeframe_id);
     
        $categories = CategoryYear::where('timeframe_id', $timeframe->id)->get();
        
        $totalCriteriaCount = 0;
    
        foreach ($categories as $categoryYear) {
            $category = $categoryYear->category;
    
            // Assuming there's a relationship between CategoryYear and Category
            if ($category) {
                $criteriaNumber = Markingcriteria::where('questioncategory_id', $category->id)->count();
                $totalCriteriaCount += $criteriaNumber;
            }
        }
    
        $markedCriteriaCount = Marking::where('practice_id', $practice)->where('user_id', $user)->count();
    
        return $totalCriteriaCount <= $markedCriteriaCount;
    }
    
        // a function to check if all criterias of a practice are marked
        function checkAllPracticeAnswered($practice,$user){
            $questions = QuestionYear::where('year_id',activeYear()->id)->count();
            $answers = Answer::where('practice_id',$practice)->where('user_id',$user)->count();
    
            if($questions <= $answers){
                return true;
            }else{
                return False;
            }
            
        }
      
        
        function checkPracticeDates() {
            $activeYear = activeYear();
        
            $today = date('Y-m-d');  // Corrected date format
        
            if ($activeYear && $today >= $activeYear->practice_start_date && $today <= $activeYear->practice_end_date) {
                return true;
            }
        
            return false; 
        }
        function checkEvaluationDates() {
            $activeYear = activeYear();
        
            $today = date('Y-m-d');  // Corrected date format
        
            if ($activeYear && $today >= $activeYear->evaluation_start_date && $today <= $activeYear->evaluation_end_date) {
                return true;
            }
        
            return false; 
        }
        // calculating practice submission remaining days
        function remainingPracticeDays() {
            $activeYear = activeYear();
        
            if ($activeYear) {
                $today = date('Y-m-d');
                
                if ($today >= $activeYear->practice_start_date && $today <= $activeYear->practice_end_date) {
                    $remainingDays = strtotime($activeYear->practice_end_date) - strtotime($today);
                    return max(0, floor($remainingDays / (60 * 60 * 24)));  // Calculate remaining days
                } else {
                    return null;  // Practice start date has not yet been reached
                }
            }
        
            return null;  // No active year found
        }

        // calculating remaining evaluation days
        function remainingEvaluationDays() {
            $activeYear = activeYear();
            
            if ($activeYear) {
                $today = date('Y-m-d');
                
                if ($today >= $activeYear->evaluation_start_date && $today <= $activeYear->evaluation_end_date) {
                    $remainingDays = abs(strtotime($today) - strtotime($activeYear->evaluation_end_date));
                    return max(0,floor($remainingDays / (60 * 60 * 24)));  // Calculate remaining days
                } else {
                    return null;  // Evaluation start date has not yet been reached or evaluation end date has passed
                }
            }
            
            return null;  // No active year found
        }
        
        
        
        
        
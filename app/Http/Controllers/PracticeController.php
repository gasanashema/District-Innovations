<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use App\Models\Practice;
use App\Models\District;
use App\Models\Timeframe;
use App\Models\Marking;
use Illuminate\Http\Request;

class PracticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$practices=Practice::with('user')->get();
        $time = Timeframe::where('status',true)->first();
        $practices = auth()->user()->practices()->where('timeframe_id',$time->id)->get();
        return view('user.practice.index', compact('practices','time'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.practice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $time = Timeframe::where('status',true)->first();

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'population' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
    
        // Check the number of practices for the current district and user
        $districtId = auth()->user()->district_id;
        $userId = auth()->user()->id;
    
        $practiceCount = Practice::where('district_id', $districtId)
            ->where('user_id', $userId)
            ->count();
    
        // Limit the number of practices to 2
        if ($practiceCount >= 3) {
            return redirect('user/practice')->with('error', 'You cannot add more than three practices for your district.');
        }
    
        // If the practice count is less than 2, proceed to add the new practice
        $data = new Practice;
        $data->name = $request->input('name');
        $data->description = $request->input('description');
        $data->population = $request->input('population');
        $data->start_date = $request->input('start_date');
        $data->end_date = $request->input('end_date');
        $data->district_id = $districtId;
        $data->user_id = $userId;
        $data->timeframe_id = $time->id;
        $data->save();
    
        return redirect('user/practice')->with('success', 'Practice has been added.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Practice  $practice
     * @return \Illuminate\Http\Response
     */
    public function show(Practice $practice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Practice  $practice
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $practice = Practice::find($id);
        return view('user.practice.edit', compact('practice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Practice  $practice
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:practices,name,' . $id, // Exclude the current practice by ID
            'description' => 'required',
            'population' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
    
        // If the practice count is less than 2, proceed to add the new practice
        $data = Practice::find($id);
        $data->name = $request->input('name');
        $data->description = $request->input('description');
        $data->population = $request->input('population');
        $data->start_date = $request->input('start_date');
        $data->end_date = $request->input('end_date');
    
        $data->save();
    
        return redirect('user/practice/'.$id.'/edit')->with('success', 'Practice has been Updated.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Practice  $practice
     * @return \Illuminate\Http\Response
     */


    
    public function destroy($id)
    {
        try {
            // Find the practice
            $practice = Practice::findOrFail($id);
    
            // Attempt to delete related answers
            $practice->answers()->delete();
    
            // Attempt to delete the practice
            $practice->delete();
    
            return redirect()->back()->with('success', 'Practice deleted successfully.');
        } catch (QueryException $e) {
            // Check if the exception is due to a foreign key constraint violation
            if ($e->errorInfo[1] === 1451) {
                return redirect()->back()->with('error', 'Cannot delete the practice. There are related answers.');
            }
    
            // Handle other exceptions or log them
            return redirect()->back()->with('error', 'An error occurred.');
        }
    }
    
    
}

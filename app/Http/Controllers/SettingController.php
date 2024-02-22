<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Timeframe;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    //  this function is mainly displaying the settings pahe
    public function index()
    {
        $years = Timeframe::orderByDesc('year')->get();
        return view('admin.settings.index',compact('years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  this is used to show add year form. the year can be created before adding dates
    public function create()
    {
        return view('admin.settings.year');
    }
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  this is used to store a year by validating its uniqueness
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'year' => [
                'required',
                'integer',
                'min:2014', // Adjust the min and max as needed
                'max:2050',
                Rule::unique('timeframes', 'year'), // Ensure the year is unique in the 'years' table
            ],
        ]);
    
        // Create a new Year instance and save it to the database
        $year = new Timeframe;
        $year->year = $validatedData['year'];
        $year->save();
    
        // You can redirect to a success page or do other actions here
        return redirect()->back()->with('success', 'Year added successfully');
    }

    // this is used to show form for adding dates to a created year
    public function datesCreate($id)
    {
        $year = Timeframe::find($id);
        return view('admin.settings.dates',compact('year'));
    }
    // this one is updating the year and add corressponding dates
    public function datesStore(Request $request,$id)
    {

        $request->validate([
            'practice_start_date' => 'required',
            'practice_end_date' => 'required',
            'evaluation_start_date' => 'required',
            'evaluation_end_date' => 'required',
        ]);

        $data = Timeframe::find($id);
        $data->practice_start_date = $request->practice_start_date;
        $data->practice_end_date = $request->practice_end_date;
        $data->evaluation_start_date = $request->evaluation_start_date;
        $data->evaluation_end_date = $request->evaluation_end_date;
        $data->save();

        $years = Timeframe::all();

        return redirect()->back()->with('success', 'Dates Saved Successfully');
    }


    // this is used to activate the year
    public function yearActivate($id)
    {
        // Setting status to false for all records
        Timeframe::query()->update(['status' => false]);
    
        // Setting status to true for the corresponding record
        $year = Timeframe::find($id);
    
        if ($year) {
            $year->status = true;
            $year->save();
            
           
            return redirect()->back()->with('message','Year activated successfully');
        } else {
          
            return redirect()->back()->with('message','Year not found');
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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

   
}

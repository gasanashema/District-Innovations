<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Practice;
use App\Models\User;
use App\Models\Files;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $practices = Practice::where('user_id',auth()->user()->id)->get();
        $files = Files::all();
        return view('user.files.index', compact('practices','files'));  

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $practices = Practice::where('district_id',auth()->user()->district->id)->get();
        return view('user.files.create', compact('practices'));
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
            'practice' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:10240', // Adjust the allowed file types and maximum size
            'comment' => 'required',
        ]);
    
        $practice = Practice::findOrFail($request->practice);
    
        // Check if a file is already attached to the practice
        // $existingFile = Files::where('practice_id', $request->practice)->first();
        // if ($existingFile) {
        //     return redirect('user/files/create')->with('error', 'A file is already attached to this practice.');
        // }
    
        $file = $request->file('file');
    
        // Use the original name with spaces replaced by underscores
        $originalName = $file->getClientOriginalName();
        $fileName = uniqid() . '_' . str_replace(' ', '_', $originalName);
    
        $filePath = $file->storeAs('storage/attachedFiles', $fileName);
    
        $data = new Files;
        $data->practice_id = $request->practice;
        $data->comment = $request->comment;
        $data->file_name = $originalName; // Use the original file name
        $data->file_path = $filePath;
        $data->file_type = $file->getClientOriginalExtension();
        $data->user_id = auth()->user()->id;
        $data->save();
    
        return redirect('user/files/create')->with('success', 'File Uploaded Successfully');
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
        // Retrieve the file record from the database
        $file = Files::findOrFail($id);

        // Build the full file path
        $filePath = 'public/attachedFiles/' . $file->file_name;

        // Delete the file from storage
        Storage::delete($filePath);

        // Delete the file record from the database
        $file->delete();

        return redirect('user/files')->with('success', 'File Deleted Successfully');
    }
}

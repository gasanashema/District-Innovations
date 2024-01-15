<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Marking;

class EvaluatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evaluators = User::where('type', 2)->get();
        return view('admin.evaluator.index', compact('evaluators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.evaluator.create');
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
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'phone' => 'required',
        ]);
    
        $data = new User;
        $data->fname = $request->fname;
        $data->lname = $request->lname;
        $data->title = 'Evaluator';
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->type = 2;
    
        $data->save();
    
        return redirect('admin/evaluator/create')->with('success', 'Evaluator added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $evaluator = User::find($id);
        $practices = Marking::select('practice_id', DB::raw('COUNT(*) as marking_count'))
            ->where('user_id', $id)
            ->groupBy('practice_id')
            ->get();
    
        return view('admin.evaluator.show', compact('evaluator', 'practices'));
    }    


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $evaluator = User::find($id);
        return view('admin.evaluator.edit', compact('evaluator'));
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
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
        ]);
    
        $data = User::find($id);
        $data->fname = $request->fname;
        $data->lname = $request->lname;
        $data->phone = $request->phone;
        $data->email = $request->email;
    
        $data->save();
    
        return redirect('admin/evaluator/'.$id.'/edit')->with('success', 'Evaluator edited.');
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

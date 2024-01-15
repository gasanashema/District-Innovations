<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\District;

class DistrictStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs = User::where('type', 0)->get();
        return view('admin.district_staff.index', compact('staffs'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = District::all();
        return view('admin.district_staff.create', compact('districts'));
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
            'district' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'phone' => 'required',
        ]);
    
        // Check if the district has no other staff
        $existingStaffCount = User::where('district_id', $request->district)->count();
    
        if ($existingStaffCount > 0) {
            return redirect('admin/district_staff/create')->with('error', 'Error!! District already has staff.');
        }
    
        $data = new User;
        $data->fname = $request->fname;
        $data->lname = $request->lname;
        $data->title = 'District Staff';
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->type = 0;
        $data->district_id = $request->district;
    
        $data->save();
    
        return redirect('admin/district_staff/create')->with('success', 'District Staff added.');
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
        $staff = User::find($id);
        $districts = District::all();
        return view('admin.district_staff.edit', compact('staff','districts'));
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
            'district' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
        ]);
    
        // Check if the district has no other staff
        $existingStaffCount = User::where('district_id', $request->district)->count();
    
        if ($existingStaffCount > 1) {
            return redirect('admin/district_staff/'.$id.'/edit')->with('error', 'Error!! District already has staff.');
        }
    
        $data = User::find($id);
        $data->fname = $request->fname;
        $data->lname = $request->lname;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->district_id = $request->district;
    
        $data->save();
    
        return redirect('admin/district_staff/'.$id.'/edit')->with('success', 'District Staff edited.');
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

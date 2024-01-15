@extends('layouts.master')
@section('content')

<div class="col-lg-6">

<div class="card">
  <div class="card-body">
    <h3 class="card-title">Add District Staff</h3>

    <!-- General Form Elements -->
@if(Session::has('success'))
<p class="text-success">{{session('success')}}</p>
@endif
@if(Session::has('error'))
<p class="text-danger">{{session('error')}}</p>
@endif
 
    <form method="POST" action="{{url('admin/district_staff/')}}">
        @csrf

      <div class="row mb-3">
        <label for="inputText" class="col-sm-3 col-form-label">First Name</label>
        <div class="col-sm-9">
          <input type="text"  name="fname" required class="form-control">
        </div>
      </div>
      <div class="row mb-3">
        <label for="inputText" class="col-sm-3 col-form-label">Last Name</label>
        <div class="col-sm-9">
          <input type="text"  name="lname" required class="form-control">
        </div>
      </div>
      
      <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">District</label>
                  <div class="col-sm-9">
                    <select class="form-select" required name="district" aria-label="Default select example">
                      <option value="" disabled selected>Select District</option>
                      @foreach($districts as $district)
                        <option value="{{$district->id}}">{{$district->name}}</option>
                      @endforeach
                     </select>
                  </div>
      </div>
      <div class="row mb-3">
        <label for="inputText" class="col-sm-3 col-form-label">Phone</label>
        <div class="col-sm-9">
          <input type="text"  name="phone" placeholder="Enter Phone Number" required class="form-control">
        </div>
      </div>
      <div class="row mb-3">
        <label for="inputText" class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-9">
          <input type="email"  name="email" placeholder="Enter Email" required class="form-control">
        </div>
      </div>

      <div class="row mb-3">
        <label for="inputText" class="col-sm-3 col-form-label">Password</label>
        <div class="col-sm-9">
          <input type="text"  name="password" placeholder="Enter Password" required class="form-control">
        </div>
      </div>
    

      <div class="row mb-3">
        <label class="col-sm-4 col-form-label"></label>
        <div class="col-sm-8">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>

    </form><!-- End General Form Elements -->

  </div>
</div>

</div>

@endsection
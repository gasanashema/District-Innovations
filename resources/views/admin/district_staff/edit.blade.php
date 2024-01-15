@extends('layouts.master')
@section('content')

<div class="col-lg-6">

<div class="card">
  <div class="card-body">
    <h3 class="card-title">Edit District Staff</h3>

    <!-- General Form Elements -->
    @if(Session::has('success'))
<p class="text-success">{{session('success')}}</p>
@endif
@if(Session::has('error'))
<p class="text-danger">{{session('error')}}</p>
@endif
 
    <form method="POST" action="{{url('admin/district_staff/'.$staff->id)}}">
        @csrf
        @method('put')
      <div class="row mb-3">
        <label for="inputText" class="col-sm-3 col-form-label">First Name</label>
        <div class="col-sm-9">
          <input type="text" value="{{ $staff->fname}}" name="fname" class="form-control">
        </div>
      </div>
      <div class="row mb-3">
        <label for="inputText" class="col-sm-3 col-form-label">Last Name</label>
        <div class="col-sm-9">
          <input type="text"  value="{{ $staff->lname}}" name="lname" class="form-control">
        </div>
      </div>
      
      <div class="row mb-3">
                  <label class="col-sm-3 col-form-label">District</label>
                  <div class="col-sm-9">
                    <select class="form-select" name="type" aria-label="Default select example">
                      @foreach($districts as $district)
                        <option value="{{$district->id}}" @if($district->id == $staff->district_id) selected @endif>{{$district->name}}</option>
                      @endforeach
                     </select>
                  </div>
      </div>
      <div class="row mb-3">
        <label for="inputText" class="col-sm-3 col-form-label">Phone</label>
        <div class="col-sm-9">
          <input type="text" value="{{ $staff->phone}}"  name="phone" placeholder="Enter Phone Number" required class="form-control">
        </div>
      </div>
      <div class="row mb-3">
        <label for="inputText" class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-9">
          <input type="email"  value="{{ $staff->email}}" name="email" placeholder="Enter Email" required class="form-control">
        </div>
      </div>
    

      <div class="row mb-3">
        <label class="col-sm-4 col-form-label"></label>
        <div class="col-sm-8">
          <button type="submit" onclick="return confirm('Are You Sure You Want To Edit');" class="btn btn-primary">Edit</button>
        </div>
      </div>

    </form><!-- End General Form Elements -->

  </div>
</div>

</div>

@endsection
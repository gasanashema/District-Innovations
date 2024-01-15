@extends('layouts.master')
@section('content')

<div class="col-lg-6">

<div class="card">
  <div class="card-body">
    <h3 class="card-title">Edit Evaluator</h3>

    <!-- General Form Elements -->
    @if(Session::has('success'))
<p class="text-success">{{session('success')}}</p>
@endif
@if(Session::has('error'))
<p class="text-danger">{{session('error')}}</p>
@endif
 
    <form action="{{url('admin/evaluator/'.$evaluator->id)}}" method="POST">
        @csrf
        @method('put')
      <div class="row mb-3">
        <label for="inputText" class="col-sm-3 col-form-label">First Name</label>
        <div class="col-sm-9">
          <input type="text" value="{{ $evaluator->fname}}" name="fname" class="form-control">
        </div>
      </div>
      <div class="row mb-3">
        <label for="inputText" class="col-sm-3 col-form-label">Last Name</label>
        <div class="col-sm-9">
          <input type="text"  value="{{ $evaluator->lname}}" name="lname" class="form-control">
        </div>
      </div>
      <div class="row mb-3">
        <label for="inputText" class="col-sm-3 col-form-label">Phone</label>
        <div class="col-sm-9">
          <input type="text" value="{{ $evaluator->phone}}"  name="phone" placeholder="Enter Phone Number" required class="form-control">
        </div>
      </div>
      <div class="row mb-3">
        <label for="inputText" class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-9">
          <input type="email"  value="{{ $evaluator->email}}" name="email" placeholder="Enter Email" required class="form-control">
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
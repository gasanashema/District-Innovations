@extends('layouts.master')
    
@section('content')

<div class="pagetitle">
    <h1>Welcome !</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Admin Dashboard</li>
      </ol>
    </nav>
  </div>

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">
          
            <div class="col-lg-7">

                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">Add Files</h3>
                @if(Session::has('success'))
                  <p class="text-success">{{Session('success')}}</p>
                @elseif(Session::has('error'))
                  <p class="text-danger">{{Session('error')}}</p>
                @endif
                    <!-- General Form Elements -->
                    <form class="row g-3 needs-validation" enctype="multipart/form-data" method="POST" action="{{ route('files.store') }}">
                        @csrf
                     
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Practice Name</label>
                            <div class="col-sm-8">
                            <select class="form-select" name="practice" aria-label="Default select example" required>
                                <option selected="" disabled>Choose Practice</option>
                                @foreach($practices as $practices)
                                @php
                                   $marked = App\Helpers\practiceMarkedCheck($practices->id);
                                   if($marked){
                                    continue;
                                   }
                                @endphp
                                <option value="{{ $practices->id }}">{{ $practices->name}}</option>
                                @endforeach
                              </select>
                              
                            </div>
                        </div>

                        <div class="row mb-3">
                          <label for="inputNumber" class="col-sm-4 col-form-label">Upload Files</label>
                          <div class="col-sm-8">
                            <input class="form-control" name="file" type="file" id="formFile" required>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="inputPassword" class="col-sm-4 col-form-label">Comment</label>
                          <div class="col-sm-8">
                            <textarea class="form-control" name="comment" style="height: 100px" required></textarea>
                          </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-8">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                
                    </form><!-- End General Form Elements -->
                
                  </div>
                </div>
                
                </div>


        </div>
      </div><!-- End Left side columns -->

      

    </div>
  </section>
@endsection
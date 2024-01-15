@extends('layouts.master')
    
@section('content')

<div class="pagetitle">
    <h1>Welcome !</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">User Dashboard</li>
      </ol>
    </nav>
  </div>

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">
                       @php
                          $practiceDates =App\Helpers\checkPracticeDates();
                       @endphp
            <div class="col-lg-7">
            @if($practiceDates != true)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-ban me-1"></i>
                    {{ "The dates for submitting practices and providing answers have expired." }}
                  
                </div>
            @endif
                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">My Files</h3>
                    @if(Session::has('success'))
                    <p class="text-success">{{session('success')}}</p>
                    @endif
                    @foreach($files as $file)
                      @foreach($practices as $practice)
                        @if($practice->id == $file->practice_id)
                         <!-- check if practice is marked using practiceMarkedCheck() function -->
                      
                        <!-- Card with an image on left -->
                          <div class="card mb-3">
                            
                              <div class="row g-0">
                                <div class="col-md-3">
                                @if($file->file_type == 'pdf')
                                    <img src="{{ asset('assets/img/pdf.png') }}" class="img-fluid rounded-start" alt="...">
                                @elseif($file->file_type == 'docx' or $file->file_type == 'doc')
                                    <img src="{{ asset('assets/img/word.png') }}" class="img-fluid rounded-start" alt="...">
                                @elseif($file->file_type == 'xlsx' or $file->file_type == 'xls')
                                    <img src="{{ asset('assets/img/excel.png') }}" class="img-fluid rounded-start" alt="...">
                                @else
                                    <img src="{{ asset('assets/img/file.jpg') }}" class="img-fluid rounded-start" alt="...">
                                @endif
                                </div>
                                <div class="col-md-9">
                                  <div class="card-body">
                                  <h5 class="card-title pb-0"><span class="text-primany">Practice: </span> {{$practice->name}}</h5>
                                  <p class="card-title py-0 text-dark fs-6"><span class="text-primary">File Name: </span>{{ $file->file_name}}</p> 
                                    <p class="card-text py-0 text-dark fs-6"><span class="text-primary fs-6">Comment: </span>{{ $file->comment}}</p> 
                                    @if($practiceDates == true)
                                    <a href="{{url('user/files/'.$file->id.'/delete')}}" onclick="return confirm('Are you sure you sure you want to delete file?')" class="text-danger py-0">Delete</a>
                                    @endif
                                  </div>
                                  
                                </div>
                              </div>
                          
                          </div>
                        <!-- End Card with an image on left -->
                        
                        @endif
                      @endforeach
                    @endforeach
                
                  </div>
                </div>
                
                </div>


        </div>
      </div><!-- End Left side columns -->

      

    </div>
  </section>
@endsection
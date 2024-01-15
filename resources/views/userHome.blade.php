@extends('layouts.master')
    
@section('content')

<div class="pagetitle">
    <h1> Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"> Dashboard</li>
      </ol>
    </nav>
  </div>

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">
      <!-- Sales Card -->
                       @php
                          $practiceDates =App\Helpers\activeYear();
                          $remainingDays = App\Helpers\remainingPracticeDays();
                       @endphp
      <div class="">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title fs-4">Practice Submission And Answering Dates<span></span></h5>
                <div class="d-flex align-items-center">
                  
                  <div class="ps-3">
                    <p class="fs-5"> <span class="card-title">Start Date:</span> <span class="text-primary">{{ $practiceDates->practice_start_date}}</span> </p>
                    <p class="fs-5"><span class="card-title">End Date:</span> <span class="text-primary"> {{  $practiceDates->practice_end_date}}</span></p>
                    @if ($remainingDays !== null) 
                    <p class="fs-5"><span class="card-title">Remaining Days:</span> <span class="text-primary">
                     
                          {{ $remainingDays ." Days"}}
                        </span></p>
                        @endif
                    
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->
        <div class="row">

          <!-- Sales Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Practice Submitted<span></span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="ri-team-fill"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ auth()->user()->practices()->count() }}</h6>
                    
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->


            <!-- Sales Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Questions<span></span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="ri-questionnaire-fill"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{App\Models\QuestionYear::where('year_id',App\Helpers\activeYear()->id)->count()}}</h6>
                    
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->

          <!-- Sales Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Uploaded Files <span></span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="ri-question-answer-line"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{App\Models\Files::where('user_id',auth()->user()->id)->count()}}</h6>
                    
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->

          

        </div>
      </div><!-- End Left side columns -->

      

    </div>
  </section>
@endsection
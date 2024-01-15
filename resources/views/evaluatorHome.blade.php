@extends('layouts.master')
    
@section('content')

<div class="pagetitle">
    <h1>Evaluator Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Evaluator Dashboard</li>
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
                          $remainingDays = App\Helpers\remainingEvaluationDays();
                       @endphp
      <div class="">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title fs-4">Evaluation Dates<span></span></h5>
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
                <h5 class="card-title">Questions<span></span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="ri-questionnaire-fill"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{App\Models\Question::where('status',1)->count()}}</h6>
                    
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->
  <!-- Sales Card -->
<div class="col-xxl-3 col-md-6">
  <div class="card info-card sales-card">
    <div class="card-body">
      <h5 class="card-title">Districts <span></span></h5>
      <div class="d-flex align-items-center">
        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
        <i class="bi bi-compass-fill"></i>
        </div>
        <div class="ps-3">
          <h6>{{App\Models\District::count()}}</h6>
          
        </div>
      </div>
    </div>

  </div>
</div><!-- End Sales Card -->

<!-- Sales Card -->
<div class="col-xxl-3 col-md-6">
  <div class="card info-card sales-card">
    <div class="card-body">
      <h5 class="card-title">Practices <span></span></h5>
      <div class="d-flex align-items-center">
        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
          <i class="ri-question-answer-line"></i>
        </div>
        <div class="ps-3">
          <h6>{{App\Models\Practice::count()}}</h6>
          
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
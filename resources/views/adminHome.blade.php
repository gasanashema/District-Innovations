@extends('layouts.master')
    
@section('content')

<div class="pagetitle">
    <h1>Admin Dashboard</h1>
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

          <!-- Sales Card -->
          <div class="col-xxl-3 col-md-6">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">District Staffs<span></span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="ri-team-fill"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{App\Models\User::where('type',0)->count()}}</h6>
                    
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->

          <!-- Sales Card -->
          <div class="col-xxl-3 col-md-6">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Evaluators <span></span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="ri-parent-fill"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{App\Models\User::where('type',2)->count()}}</h6>
                    
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
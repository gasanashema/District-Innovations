@extends('layouts.master')
    
@section('content')

<div class="pagetitle mb-5">
    <h1>Select Questions Year</h1>
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
           <div class="col-xxl-3 col-md-5 ">
            <div class="card info-card sales-card ">
                <a href="{{ url('admin/category/') }}">
                    <div class="card-body pt-4 px-2">
                    
                        <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="ri-lightbulb-flash-fill"></i>
                        </div>
                        <div class="ps-3">
                            <h6> All Questions Categories </h6>
                        </div>
                        </div>
                    </div>
                </a>
            </div>
          </div>
          <!-- /End Card -->

        @foreach($years as $year)
        
          <!-- Sales Card -->
          <div class="col-xxl-2 col-md-5 ">
            <div class="card info-card sales-card ">
                <a href="{{ url('admin/category/year/'. $year->id) }}">
                    <div class="card-body pt-4 px-2">
                    
                        <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="ri-lightbulb-flash-fill"></i>
                        </div>
                        <div class="ps-3">
                            <h6> <strong>{{ $year->year}}</strong> </h6>
                        </div>
                        </div>
                    </div>
                </a>
            </div>
          </div>
          <!-- /End Card -->
        @endforeach

          

        </div>
      </div><!-- End Left side columns -->

      

    </div>
  </section>
@endsection
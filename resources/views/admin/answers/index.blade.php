@extends('layouts.master')
    
@section('content')

<div class="pagetitle">
    <h1>All Districts</h1>

  </div>

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">

        @foreach($districts as $district)
        
          <!-- Sales Card -->
          <div class="col-xxl-3 col-md-6">
            <div class="card info-card sales-card">
                <a href="{{ url('admin/answers/districts/'. $district->id) }}">
                    <div class="card-body">
                        <h5 class="card-title">{{$district->name}} <span></span></h5>
                        <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="ri-lightbulb-flash-fill"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $district->practice->count() }} Practices</h6>
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
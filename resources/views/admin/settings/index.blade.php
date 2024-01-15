

@extends('layouts.master')
    
@section('content')

<div class="pagetitle">
    <h1>Settings</h1>
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
          
            <div class="col-lg-10">

         
            <!-- Sales Card -->
          <div class="">
            <div class="card info-card sales-card">
                
                    <div class="card-body">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="card-title col-sm-10 fs-4">Years <span></span></h5>
                            <a href="{{url('admin/setting/create')}}" class="btn btn-primary mb-4 mt-2">Add Year</a>
                        </div>
                        <div class="d-flex align-items-center">
                        <ul class="list-group col-md-12">
                          @foreach($years as $year)
                              <li class="list-group-item d-flex justify-content-between"><span class="col-sm-9 pt-2">{{$year->year}}</span>
                              <a href="{{url('admin/setting/'.$year->id.'/dates')}}" class="btn btn-primary">Set Dates</a>
                              <form method="POST" action="{{ url('admin/setting/'.$year->id.'/activate') }}" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn @if($year->status == 1) btn-success disabled @else btn-primary @endif"
                                        data-bs-toggle="tooltip" data-bs-placement="right"
                                        title="@if($year->status == 1) The Year Is Active @else Click To Activate This Year @endif">
                                    @if($year->status == 1) Active <i class="bi bi-check2-circle"></i> @else Activate @endif
                                </button>
                            </form>

                             </li>
                          @endforeach
                        </ul>
                        </div>
                    </div>
              
            </div>

            @foreach($years as $year)

            @if(!$year->practice_start_date && !$year->practice_start_date)

              @continue
            @endif
            <!-- card -->
            <div class="card">
                  <div class="card-body">
                        <div class="card-header d-flex justify-content-between py-0 pt-1 border-bottom-0">
                            <h5 class="card-title col-sm-10 fs-4">{{$year->year}} Timeframe <span></span></h5>
                            <a href="{{url('admin/setting/'.$year->id.'/dates')}}" class="btn btn-primary mb-4 mt-2">Edit Dates</a>
                        </div>
                        <h5 class="card-title col-sm-10">Practice Submission Dates</h5>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Start Date</label>
                            <div class="col-sm-9">
                              <input type="date" value="{{$year->practice_start_date}}" class="form-control inputDates" name="practice_start_date" disabled>
                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">End Date</label>
                            <div class="col-sm-9">
                              <input type="date" value="{{$year->practice_end_date}}" class="form-control inputDates" name="practice_end_date" disabled>
                             
                            </div>
                        </div>
                        <h5 class="card-title col-sm-10">Practice Evaluation Dates</h5>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Start Date</label>
                            <div class="col-sm-9">
                              <input type="date" value="{{$year->evaluation_start_date}}" class="form-control inputDates" name="evaluation_start_date" disabled>
                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Start Date</label>
                            <div class="col-sm-9">
                              <input type="date" value="{{$year->evaluation_end_date}}" class="form-control inputDates" name="evaluation_end_date" disabled>
                             
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            
                            
                            
                        </div>
                
                

                  </div>
            </div>
            <!--/ card -->
            @endforeach
          </div>
          <!-- /End Card -->
              
            </div>


        </div>
      </div><!-- End Left side columns -->

      

    </div>
  </section>
@endsection
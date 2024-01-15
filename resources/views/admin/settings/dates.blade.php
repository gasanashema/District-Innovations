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
@if(Session::has('success'))
<script>
    alert('{{session("success")}}');
</script>
@endif
      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">
          
            <div class="col-lg-10">

                <div class="card">
                <div class="card-header d-flex justify-content-between py-0 border-bottom-0 pt-2">
                            <h5 class="card-title col-sm-10 fs-4">Set Dates For {{$year->year}}<span></span></h5>
                            <a href="{{url('admin/setting')}}" class="btn btn-primary mb-4 mt-2">View All</a>
                </div>
                <br>
                  <div class="card-body">
                    
                
                    <!-- General Form Elements -->
                    <form class="row g-3 needs-validation" method="POST" action="{{ url('admin/setting/'.$year->id.'/dates/store') }}">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label"> Year</label>
                            <div class="col-sm-9">
                                <input type="text" name="year" class="form-control" disabled value="{{$year->year}}">
                            </div>
                        </div>
                        <h5 class="card-title col-sm-10">Practice Submission Dates</h5>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Start Date</label>
                            <div class="col-sm-9">
                              <input type="date" value="{{$year->practice_start_date}}" class="form-control inputDates" name="practice_start_date" required>
                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">End Date</label>
                            <div class="col-sm-9">
                              <input type="date" value="{{$year->practice_end_date}}" class="form-control inputDates" name="practice_end_date" required>
                             
                            </div>
                        </div>
                        <h5 class="card-title col-sm-10">Practice Evaluation Dates</h5>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Start Date</label>
                            <div class="col-sm-9">
                              <input type="date" value="{{$year->evaluation_start_date}}" class="form-control inputDates" name="evaluation_start_date" required>
                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Start Date</label>
                            <div class="col-sm-9">
                              <input type="date" value="{{$year->evaluation_end_date}}" class="form-control inputDates" name="evaluation_end_date" required>
                             
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            
                            
                            <div class="col-sm-12">
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" @if($year->evaluation_end_date) onclick="return confirm('Are you sure you want to edit dates')" @endif> Save </button>
                                    <button type="reset" class="btn btn-secondary">Reset </button>
                                  </div>
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
  @section('scripts')
    <!-- <script>
        // Get the current date
        const currentDate = new Date().toISOString().split('T')[0];

        // Set the minimum date for input fields with the class "inputDates"
        const inputDates = document.querySelectorAll('.inputDates');
        inputDates.forEach(input => {
            input.min = currentDate;
        });
    </script> -->
  @endsection
@endsection
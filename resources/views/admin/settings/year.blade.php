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
                <div class="card-header d-flex justify-content-between py-0">
                            <h5 class="card-title col-sm-10 fs-4">Add New Year <span></span></h5>
                            <a href="{{url('admin/setting')}}" class="btn btn-primary mb-4 mt-2">View All</a>
                </div>
                <br>
                  <div class="card-body">
                   @if(Session::has('success'))
                   <script>
                    alert('{{Session("success")}}')
                   </script>
                   @endif
                    <!-- General Form Elements -->
                    <form class="row g-3 needs-validation" method="POST" action="{{ url('admin/setting/') }}">
                        @csrf
                      
                      <div class="row mb-3">
                        <label for="inputText" class="col-sm-4 col-form-label">Select Year</label>
                        <div class="col-sm-8">
                        <select id="year" name="year" class="form-select"></select>
                            @error('lname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
  @section('scripts')
  <script>
    // Get the current year
    const currentYear = new Date().getFullYear();

    // Select the dropdown element
    const yearDropdown = document.getElementById("year");

    // Populate the dropdown with the last 10 years and the next 10 years
    for (let year = currentYear - 10; year <= currentYear + 10; year++) {
        const option = document.createElement("option");
        option.value = year;
        option.text = year;

        // Set the "selected" attribute if it's the current year
        if (year === currentYear) {
            option.selected = true;
        }

        yearDropdown.add(option);
    }
</script>
  @endsection
@endsection
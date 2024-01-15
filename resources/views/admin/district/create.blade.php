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
                    <h3 class="card-title">Add District</h3>
                
                    <!-- General Form Elements -->
                    <form class="row g-3 needs-validation" method="POST" action="{{ route('district.store') }}">
                        @csrf
                     
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">District Name</label>
                            <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Province</label>
                            <div class="col-sm-8">
                              <select class="form-select" name="province_id" aria-label="Default select example">
                                <option selected="">Choose Province</option>
                                @foreach($provinces as $province)
                                <option value="{{ $province->id }}">{{ $province->name}}</option>
                                @endforeach
                              </select>
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
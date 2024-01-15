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
          
            <div class="col-lg-7">

                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">Add Practice</h3>
                
                    <!-- General Form Elements -->
                    <form class="row g-3 needs-validation" method="POST" action="{{ route('practice.store') }}">
                        @csrf
                      
                      <div class="row mb-3">
                        <label for="inputText" class="col-sm-5 col-form-label">Practice Name</label>
                        <div class="col-sm-7">
                          <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="inputText" class="col-sm-5 col-form-label">Description</label>
                        <div class="col-sm-7">
                          <input type="text" name="description" class="form-control" value="{{ old('description') }}" required>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="inputText" class="col-sm-5 col-form-label">Geographical Scope <span class="text-muted">(sectors/cells)</span></label>
                        <div class="col-sm-7">
                          <input type="text" name="population" class="form-control" value="{{ old('population') }}" required>
                            @error('population')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="inputText" class="col-sm-5 col-form-label">Start Date</label>
                        <div class="col-sm-7">
                          <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}" required>
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="inputText" class="col-sm-5 col-form-label">End Date</label>
                        <div class="col-sm-7">
                          <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}" required>
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                      </div>
                
                      <div class="row mb-3">
                        <label class="col-sm-5 col-form-label"></label>
                        <div class="col-sm-7">
                          <button type="submit" class="btn btn-primary">Save Practice</button>
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
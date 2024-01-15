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
          
            <div class="col-lg-10">

                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">Add Marking Criteria</h3>
                
                    <!-- General Form Elements -->
                    <form class="row g-3 needs-validation" method="POST" action="">
                        @csrf
                     
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Question Category</label>
                            <div class="col-sm-9">
                              <select class="form-select" name="questioncategory_id" aria-label="Default select example" required>
                                <option selected="">Choose Category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Title</label>
                            <div class="col-9">
                                
                                  <textarea class="form-control" name="details" placeholder="Marking Criteria Details" id="floatingTextarea" style="height: 150px;" required></textarea>
                                  
                              </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-9">
                       
                                  <textarea class="form-control" name="instructions" placeholder="Description" id="floatingTextarea" style="height: 150px;" required></textarea>
                                
                              </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Marks</label>
                            <div class="col-9">
                               
                                  <input type="number" class="form-control" name="characters" placeholder="Marks" required/>
                               
                              </div>
                        </div>

                        
                    
                        <div class="row mb-3">
                            
                            
                            <div class="col-sm-12">
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Save Criteria</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
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
@endsection
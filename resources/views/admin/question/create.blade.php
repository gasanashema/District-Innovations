@extends('layouts.master')
    
@section('content')
  @section('styles')
  <style>
     .modal-dialog {
    max-width: 80%;
    }
  </style>
  @endsection
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
                  <div class="card-body">
                    <div class="card-header d-flex justify-content-between py-0 border-bottom-0">
                      <div class="card-title fs-3">Add a question To {{$y->year}}</div>
                      <div class="card-title">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">Copy From Existing</button>
                      </div>

                      <div class="modal fade" id="verticalycentered" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Copy a question to {{$y->year}}</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                   <!-- Table with stripped rows -->
                                      <table class="table datatable">
                                        <thead>
                                          <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Question</th>
                                            <th scope="col">Action</th>
                                        
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach($qAll as $que)
                                          <tr>
                                            <th scope="row">{{ $que->id}}</th>
                                            <td>{{ $que->details}}</td>
                                            <td>
                                              <form action="{{url('admin/copy/question/')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="question_id" value="{{ $que->id}}">
                                                <input type="hidden" name="year_id" value="{{ $y->id}}">
                                                <button type="submit" class="btn btn-info"  onclick="return confirm('Are you sure you want to copy this question to {{$y->year}}?')">Copy</button>
                                              </form>
                                            </td>
                                            
                                           
                                          </tr>
                                          @endforeach
                                        </tbody>
                                      </table>
                                      <!-- End Table with stripped rows -->
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- General Form Elements -->
                    <form class="row g-3 needs-validation" method="POST" action="{{ url('admin/question/'.$y->id) }}">
                        @csrf
                     
                        <input type="hidden" name="year">
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
                            <label for="inputText" class="col-sm-3 col-form-label">Question Details</label>
                            <div class="col-9">
                                <div class="form-floating">
                                  <textarea class="form-control" name="details" placeholder="Question Details" id="floatingTextarea" style="height: 150px;" required></textarea>
                                  <label for="floatingTextarea">Enter Question Details</label>
                                </div>
                              </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Instructions</label>
                            <div class="col-9">
                                <div class="form-floating">
                                  <textarea class="form-control" name="instructions" placeholder="Question Instructions" id="floatingTextarea" style="height: 150px;" required></textarea>
                                  <label for="floatingTextarea">Enter Question Instructions</label>
                                </div>
                              </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Maximum Characters</label>
                            <div class="col-9">
                               
                                  <input type="number" class="form-control" name="characters" placeholder="Maximum Number Of Characters For The Answer" required/>
                               
                              </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Question Status</label>
                            <div class="col-sm-9">
                              <select class="form-select" required name="status" aria-label="Default select example">
                                <option selected="" disabled>Choose status</option>
                                <option value="1">Published</option>
                                <option value="0">Draft</option>
                              </select>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            
                            
                            <div class="col-sm-12">
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Save Question</button>
                                    <button type="reset" class="btn btn-secondary">Reset Question</button>
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
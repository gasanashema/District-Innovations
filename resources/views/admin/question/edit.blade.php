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
                    <h3 class="card-title">Edit Question</h3>
                
                    <!-- General Form Elements -->
                    @if(Session::has('success'))
                    <p class="text-success">{{session('success')}}</p>
                    @endif
                    @if(Session::has('error'))
                    <p class="text-danger">{{session('error')}}</p>
                    @endif
                    <form class="row g-3 needs-validation" method="POST" action="{{url('admin/question/'.$data->id.'/update')}}">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Question Category</label>
                            <div class="col-sm-9">
                              <select class="form-select" name="questioncategory_id" aria-label="Default select example" required>
                                <option selected="">Choose Category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($data->questioncategory_id == $category->id) selected @endif>{{ $category->category}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Question Details</label>
                            <div class="col-9">
                               
                                  <textarea class="form-control" name="details" placeholder="Question Details" id="floatingTextarea" style="height: 100px;" required>{{$data->details}}</textarea>
                               
                              </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Instructions</label>
                            <div class="col-9">
                              
                                  <textarea class="form-control" name="instructions" placeholder="Question Instructions" id="floatingTextarea" style="height: 150px;" required>{{$data->instructions}}</textarea>
                                  
                              </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Minimum Characters</label>
                            <div class="col-9">
                               
                                  <input type="number" class="form-control" name="characters" placeholder="Enter Number Of Characters For The Answer" value="{{$data->number_of_characters}}" required/>
                               
                              </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Question Status</label>
                            <div class="col-sm-9">
                              <select class="form-select" required name="status" aria-label="Default select example">
                                <option selected="" disabled>Choose status</option>
                                
                                <option value="1" @if($data->status == 1) selected @endif>Published</option>
                                <option value="0" @if($data->status == 0) selected @endif>Draft</option>
                              </select>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            
                            
                            <div class="col-sm-12">
                                
                                <div class="text-center">
                                    <button type="submit" onclick="return confirm('Are You Sure You Want To Edit?')" class="btn btn-primary">Edit</button>
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
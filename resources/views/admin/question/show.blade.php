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
                <div class="card-header d-flex justify-content-between py-0 border-bottom-0">
                    <div class="card-title">View Question</div>
                    <div class="card-title">
                    <a href="javascript:void(0);" onclick="goBack()" class="btn btn-success">View All</a>
                    </div>
                </div>
                <br>
                  <div class="card-body">
                 
                
                    <!-- General Form Elements -->
                    <form class="row g-3 needs-validation">
                     
                     
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Question Category</label>
                            <div class="col-sm-9">
                              <input disabled class="form-select" value="{{$data->category->category}}" >
                               
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Question Details</label>
                            <div class="col-9">
                               
                                  <textarea class="form-control" style="height: 100px;" disabled>{{$data->details}}
                                </textarea>
                                  
                              </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Instructions</label>
                            <div class="col-9">
                               
                                  <textarea disabled class="form-control" style="height: 300px;" >{{$data->instructions}}</textarea>
                                  
                              </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-3 col-form-label">Minimum Characters</label>
                            <div class="col-9">
                               
                                  <input type="number" disabled class="form-control" value="{{$data->number_of_characters}}"/>
                               
                              </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Question Status</label>
                            <div class="col-sm-9">
                              <input type="text" disabled class="form-control" @if($data->status == 1) value="Published" @else value="Draft" @endif>
                                
                              </select>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            
                            
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
    function goBack() {
        window.history.back();
      }
  </script>
  @endsection
@endsection
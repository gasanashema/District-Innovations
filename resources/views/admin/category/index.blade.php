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
  @if(Session::has('success'))
    <script>
      alert('{{session("success")}}');
    </script>
    @endif
  <section class="section dashboard">
    
    <div class="row">
      <div class="col-lg-8">

        <div class="card">
          <div class="card-body">
            
            <div class="card-header d-flex justify-content-between py-0 border-bottom-0">
                      <div class="card-title fs-3">{{$date->year}} Question Categories</div>
                      <div class="card-title">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">Copy From Existing</button>
                      </div>

                      <div class="modal fade" id="verticalycentered" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Copy Question Category to {{$date->year}}</h5>
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
                                          @php
                                            $k=1;
                                          @endphp
                                          @foreach($qAll as $que)
                                          <tr>
                                            <th scope="row">{{ $k++}}</th>
                                            <td>{{ $que->category}}</td>
                                            <td>
                                              <form action="{{url('admin/questioncategory/copy/')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="category_id" value="{{ $que->id}}">
                                                <input type="hidden" name="timeframe_id" value="{{ $date->id}}">
                                                <button type="submit" class="btn btn-info"  onclick="return confirm('Are you sure you want to copy this question category to {{$date->year}}?')">Copy</button>
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
            
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Category Name</th>
                  <th scope="col">Marks</th>
                  <th scope="col">Action</th>
                 
                </tr>
              </thead>
              <tbody>
                @foreach($categories as $category)
                <tr>
                  <th scope="row">{{ $category->category->id}}</th>
                  <td>{{ $category->category->category}}</td>
                  <td>{{ $category->category->marks}}</td>
                  <td>
                    <a href="{{ url('admin/questioncategory/'.$date->id.'/delete/'.$category->category->id)}}" onclick="return confirm('Are You Sure You Want To Remove This Question Category From {{$date->year}}')" class="btn btn-danger">Delete</a>
                  </td>
                  
                
                </tr>
                @endforeach
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>

  </section>
@endsection
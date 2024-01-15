@extends('layouts.master')
    
@section('content')

<div class="pagetitle">
    <h1>My Practice !</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">User Dashboard</li>
      </ol>
    </nav>
  </div>

  <section class="section dashboard">
    
    <div class="row">
      <div class="col-lg-12">
                      @php
                          $practiceDates =App\Helpers\checkPracticeDates();
                       @endphp
           
            @if($practiceDates != true)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-ban me-1"></i>
                    {{ "The dates for submitting practices and providing answers have expired." }}
                  
                </div>
            @endif
        <div class="card">
          <div class="card-body">
            <div class="col-md-12 justify-content-between d-flex p-0 border-bottom-0">
            <h4 class="card-title col-md-10 fs-3 border-bottom-0">My Practices For {{$time->year}}</h4>
            
            @if($practiceDates == true)
              <a href="{{ route('practice.create') }}" class="btn btn-primary m-3 border-bottom-0">Add Practice</a>
            @endif
            </div>
            @if(Session::has('error'))
               
            <script>alert("{{Session('error')}}")</script>
               
            @endif
            @if(Session::has('success'))
               
               <script>alert("{{Session('success')}}")</script>
              
           @endif
            <hr>
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Practice Name</th>
                  <th scope="col">Geographical Scope</th>
                  <th scope="col">Start Date</th>
                  <th scope="col">End Date</th>
                  @if($practiceDates == true)
                  <th scope="col">Actions</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @php
                $i=1;
                @endphp
                @foreach($practices as $practice)
                <tr>
                  <th scope="row">{{ $i++}}</th>
                  <td>{{ $practice->name}}</td>
                  <td>{{ $practice->population}}</td>
                  <td>{{ $practice->start_date}}</td>
                  <td>{{ $practice->end_date}}</td>
                  @if($practiceDates == true)
                  <td>
                      
                        <a href="{{url('user/practice/'.$practice->id.'/edit')}}" class="btn btn-primary">Edit</a>
                        <a href="{{url('user/practice/'.$practice->id.'/delete')}}" onclick="return confirm('Are you sure you want to Delete this practice?')" class="btn btn-danger">Delete</a>
                  </td>
                  @endif
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
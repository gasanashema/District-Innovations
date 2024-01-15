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
      <div class="col-lg-8">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Districts</h5>
            
            <a href="{{ route('district.create') }}" class="btn btn-primary">Add new district</a>

            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">District Name</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($districts as $district)
                <tr>
                  <th scope="row">{{ $district->id}}</th>
                  <td>{{ $district->name}}</td>
                  
                  <td>
                    <a href="#" class="btn btn-primary">Edit</a>
                    <a href="#" class="btn btn-danger">Delete</a>
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
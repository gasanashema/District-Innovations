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
      <div class="col-lg-12">

        <div class="card">
          <div class="card-header d-flex justify-content-between py-0 border-bottom-0">
            <div class="card-title">Marking Criterias</div>
            <div class="card-title">
              <a href="{{url('admin/marking/criteria/create')}}" class="btn btn-primary">Add Criteria</a>
            </div>
          </div>
          <div class="card-body">
            

            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Criteria</th>
                  <th scope="col">Question Category</th>
                  <th scope="col">Description</th>
                  <th scope="col">Marks</th>
                </tr>
              </thead>
              <tbody>
                @foreach($criterias as $criteria)
                <tr>
                  <th scope="row">{{ $criteria->id}}</th>
                  <td>{{ $criteria->title}}</td>
                  <td>{{ $criteria->category->category}}</td>
                  <td>{{ $criteria->description}}</td>
                  <td>{{ $criteria->marks}}</td>
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
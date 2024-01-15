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
            <h5 class="card-title">Evaluators</h5>
            
            <a href="{{ route('evaluator.create') }}" class="btn btn-primary">Add new evaluator</a>
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">First Name</th>
                  <th scope="col">Last Name</th>
                  <th scope="col">Phone</th>
                  <th scope="col">Email</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
              @php $i = 1; @endphp
                @foreach($evaluators as $evaluator)
                <tr>
                  <th scope="row">{{ $i++}}</th>
                  <td>{{ $evaluator->fname}}</td>
                  <td>{{ $evaluator->lname}}</td>
                  <td>{{ $evaluator->phone}}</td>
                  <td>{{ $evaluator->email}}</td>
                  
                  <td>
                    <a href="{{url('admin/evaluator/'.$evaluator->id.'/edit')}}" class="btn btn-primary">Edit</a>
                    <a href="{{url('admin/evaluator/'.$evaluator->id)}}" class="btn btn-primary">View</a>
                    
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
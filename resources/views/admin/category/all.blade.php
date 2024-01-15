@extends('layouts.master')
    
@section('content')

<div class="pagetitle">
    <h1>Questions</h1>
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
            <div class="card-title fs-3">All Questions Categories</div>
            <a href="{{ route('category.create') }}" class="btn btn-primary">Add new category</a>

          </div>
          <div class="card-body">
            

            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Category</th>
                  <th scope="col">Marks</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($categories as $category)
                <tr>
                  <th scope="row">{{ $category->id}}</th>
                  <td>{{ $category->category}}</td>
                  <td>
                  {{ $category->marks}}
                  </td>
                  
                  <td>
                   
                    <a href="{{ url('admin/category/'.$category->id.'/edit')}}" class="btn btn-primary">Edit</a>
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
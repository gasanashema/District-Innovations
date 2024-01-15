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
            <h5 class="card-title">District Staff</h5>
            

            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">First Name</th>
                  <th scope="col">Last Name</th>
                  <th scope="col">Phone</th>
                  <th scope="col">Email</th>
                  <th scope="col">District Name</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
              @php $i = 1; @endphp
                @foreach($staffs as $staff)
                <tr>
                  <th scope="row">{{ $i++}}</th>
                  <td>{{ $staff->fname}}</td>
                  <td>{{ $staff->lname}}</td>
                  <td>{{ $staff->phone}}</td>
                  <td>{{ $staff->email}}</td>
                  <td>{{ $staff->district->name}}</td>
                  
                  <td>
                    <a href="{{url('admin/district_staff/'.$staff->id.'/edit')}}" class="btn btn-primary">Edit</a>
                    
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
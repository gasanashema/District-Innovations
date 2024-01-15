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
    @if(Session::has('success'))
      <script>
        alert('{{session("success")}}');
      </script>
    @endif
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-header d-flex justify-content-between py-0 border-bottom-0">
            <div class="card-title fs-3">{{$y->year}} Questions</div>
            <div class="card-title">
              <a href="{{ url('admin/question/'.$y->id.'/create') }}" class="btn btn-primary">Add new question</a>
            </div>
          </div>
          <div class="card-body">
            

            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Question</th>
                  <th scope="col">Status</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($questions as $question)
                <tr>
                  <th scope="row">{{ $question->question->id}}</th>
                  <td>{{ $question->question->details}}</td>
                  <td>
                    @if($question->question->status == 1)
                      {{'Published'}}
                    @else
                      {{'Draft'}}
                    @endif
                  </td>
                  
                  <td>
                    <a href="{{ url('admin/question/'.$question->id.'/show')}}" class="btn btn-info"><i class="bi bi-eye"></i></a>
                    <a href="{{ url('admin/question/'.$question->id.'/edit')}}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                    <a href="{{ url('admin/question/'.$y->id.'/delete/'.$question->question->id)}}" onclick="return confirm('Are You Sure You Want To Remove This Question From {{$y->year}}')" class="btn btn-danger"><i class="bi bi-trash"></i></a>
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
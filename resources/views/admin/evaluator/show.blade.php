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
            <h5 class="card-title">Evaluator's Report</h5>
           <span class="text-info">Evaluator Name:</span> {{$evaluator->fname.' '.$evaluator->lname}} <br>  
           <span class="text-info">Phone:</span>{{$evaluator->phone}} 
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Practice Name</th>
                  <th scope="col">District</th>
                  <th scope="col">Marks</th>
                </tr>
              </thead>
              <tbody>
              @php $i = 1; @endphp
                @foreach($practices as $practice)
                 @php
                    $allMarked = App\Helpers\checkAllPracticeMarked($practice->practice->id,$evaluator->id);
                 @endphp
                <tr>
                  <th scope="row">{{ $i++}}</th>
                  <td>{{ $practice->practice->name}}</td>
                  <td>{{ $practice->practice->district->name}}</td>
                  <td>{{ App\Helpers\EvaluatorPracticeMarks($practice->practice->id,$evaluator->id)}}% 
                  @if($allMarked)
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                        <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"/>
                        <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708"/>
                    </svg>
                  @endif
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
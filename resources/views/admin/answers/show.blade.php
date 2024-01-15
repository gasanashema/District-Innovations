@extends('layouts.master')

@section('styles')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

@endsection
 

@section('content')

<div class="pagetitle">
    <h1>Sumitted Practices</h1>
    
  </div>

  <section class="section profile">
    <div class="row">
      
        <div class="col-lg-12">

        <div class="card">
              <div class="card-body">
                <h5 class="card-title">District : {{$district->name}}</h5>
  
                <!-- Default Accordion -->
                <div class="accordion" id="accordionExample">
                  @foreach($practices as $practice)
                  <div class="accordion-item">
                    <h2 class="accordion-header justify-content-between" id="headingOne">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $practice->id}}" aria-expanded="false" aria-controls="collapse{{ $practice->id}}">
                        <span class="d-flex justify-content-between">

                            <span class="col-sm-12 ">Practice #{{ $practice->id}} :: {{ $practice->name }}</span>  
                            <span class="col-sm-12  text-primary ">Marks : {{ app\Helpers\practiceAvg($practice->id) }} % </span>  
                        </span>
                      </button>
                     
                    </h2>
                    <div id="collapse{{ $practice->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{ $practice->id}}" data-bs-parent="#accordionExample" style="">
                    
                    <!-- Accordition body -->
                    <div class="accordion-body">
                        

                        <div class="col-xl-12">

                            <div class="card">
                            <div class="card-body pt-3">
                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered">
                                
                                @foreach($questions as $question)
                                  
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#q{{ $practice->id}}{{$question->id}}">Q{{$question->id}}</button>
                                    </li>
                                  
                                @endforeach
                                
                                </ul>
                                

                                <div class="tab-content pt-2">
                              
                                  
                                
                                  @foreach($questions as $question)

                                      @php
                                      
                                      
                                          $answer = App\Models\Answer::where('practice_id', $practice->id)
                                                                      ->where('question_id', $question->id)
                                                                      ->first(); 
                                          if ($answer) {
                                              $detail = $answer->details; // Access 'details' as a property
                                            
                                            
                                          

                                          } else {
                                            
                                              $detail = null; 
                                          
                                              $answer=null;
                                          
                                          }

                                          
                                      @endphp

                                      <div class="tab-pane fade q{{ $practice->id}}{{$question->id}} pt-3" id="q{{ $practice->id}}{{$question->id}}">
                                    
                                        @if($answer == null)
                                              <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <i class="bi bi-check-circle me-1"></i>
                                                  Question Not Answered
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                              </div>
                                        @endif
                                        

                                          <!-- Question & Answer Form -->
                                          <form >
                                              

                                            

                                              <div class="row mb-3">
                                                  <label for="fullName" class="col-md-3 col-lg-3 col-form-label">Question:</label>
                                                  <div class="col-md-9 col-lg-9">
                                                      <textarea name="about" class="form-control" id="about" style="" disabled>{{ $question->details }}</textarea>
                                                  </div>
                                              </div>

                                              <div class="row mb-3">
                                                  <label for="about" class="col-md-3 col-lg-3 col-form-label">Instructions:</label>
                                                  <div class="col-md-9 col-lg-9">
                                                      <textarea name="about" class="form-control" id="about" style="height:200px;" disabled>{{ $question->instructions }}</textarea>
                                                  </div>
                                              </div>
                                              @if($answer != null)
                                                  <div class="row mb-3">
                                                      <label for="Answer" class="col-md-3 col-lg-3 col-form-label">Answer:</label>
                                                      <div class="col-md-9 col-lg-9">
                                                          <textarea readonly class="form-control summernote" name="answer" required readonly >{!! $detail !!}</textarea>
                                                      </div>
                                                  </div>
                                                  
                                              @else
                                              <div class="text-center text-danger">QUESTION IS NOT ANSWERED!!</div>
                                              @endif
                                          </form><!-- Question & Answer Form -->
                                      </div>
                                  @endforeach

                                
                                </div>
                                <!-- End Bordered Tabs -->
                            </div>
                            </div>
                
                        
                        </div>


                      </div>
                      
                    </div>
                  </div>
                  @endforeach
                  
                </div><!-- End Default Accordion Example -->
  
              </div>
            </div>
  
          </div>


        
        

    </div>
  </section>
@endsection
@section('scripts')
<script>
    
    $(document).ready(function() {
        $('.summernote').summernote({
            readOnly: true,
            toolbar: [],
            
        });
        $('.summernote').summernote('disable');
    });
    
</script>

  
@endsection
@extends('layouts.master')
 

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

                @php
                $k=1;
                @endphp
                <div class="accordion" id="accordionExample">
                  @foreach($practices as $practice)
                  <div class="accordion-item">
                    <h2 class="accordion-header justify-content-between" id="headingOne">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $practice->id}}" aria-expanded="false" aria-controls="collapse{{ $practice->id}}">
                        <span class="d-flex justify-content-between">

                            <span class="col-sm-12 ">Practice #{{ $k++}} :: {{ $practice->name }}</span>  
                            <span class="col-sm-12  text-primary ">Marks : {{ app\Helpers\practiceAvg($practice->id) }} % </span>  
                        </span>
                      </button>
                     
                    </h2>
                    <div id="collapse{{ $practice->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{ $practice->id}}" data-bs-parent="#accordionExample" style="">
                    
                    <!-- Accordition body -->
                    <div class="accordion-body">
                        @php

                        $evaluators = App\Helpers\PracticeEvaluators($practice->id);
                        
                        @endphp

                        <div class="col-xl-12">
                            <div class="card">
                              <div class="card-body">
                              

                                <!-- List group Numbered -->
                                <h5 class="card-title">Evaluators</h5>
                                <ol class="list-group list-group-numbered mt-3">

                                @foreach($evaluators as $evaluator)
                                  @php
                                    $user = App\Models\User::where('id',$evaluator->user_id)->first();
                                    $allMarked = App\Helpers\checkAllPracticeMarked($practice->id,$user->id);
                                  @endphp
                                  <li class="list-group-item d-flex "><span class="col-md-11 text-align-left">&nbsp;{{$user->fname .' '.$user->lname}}</span>
                                    <span class="col-md-1 p-0 m-0 text-success"> 
                                      {{App\Helpers\EvaluatorPracticeMarks($practice->id,$user->id)}}% 
                                      @if($allMarked)
                                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                                            <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"/>
                                            <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708"/>
                                          </svg>
                                      @endif
                                    </span>
                                  </li>
                                @endforeach
                                </ol><!-- End List group Numbered -->

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

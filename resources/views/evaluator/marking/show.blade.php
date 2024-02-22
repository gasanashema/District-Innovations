@extends('layouts.master')

@section('styles')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <style>
        /* .modal-dialog {
    max-width: fit-content;
    } */
    </style>
@endsection
 

@section('content')

<div class="pagetitle">
    <h1>Sumitted Practices By {{$district->name}} District</h1>
    
  </div>

  <section class="section profile">
    <div class="row">
      
        <div class="col-lg-12">
                @php
                  $allMarked =  app\Helpers\checkAllPracticeMarked($practice->id,auth()->user()->id);
                @endphp  
        <div class="card">
              <div class="card-body">
              <h5 class="card-title">
                Practice : {{$practice->name}}
                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                <span class="text-success">
                {!! app\Helpers\practiceMarks($practice->id,auth()->user()->id) !!}
                        @if($allMarked)
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                              <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"/>
                              <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708"/>
                            </svg>
                        @endif
                </span>
             </h5>
  
                <!-- Default Accordion -->
                <div class="accordion" id="accordionExample">
                @php
                $c=1;
                @endphp

                  @foreach($categories as $category)

                    @php
                      
                        $questions = app\Helpers\questionsInCategory($category->category->id);
                    @endphp
                
                    @foreach($questions as $question)
                    <!-- checking if the question is for the active year -->
                        @php
                            $check =App\Models\QuestionYear::where('year_id',App\Helpers\activeYear()->id)->where('question_id',$question->id)->first();
                        @endphp
                        @if(!$check)
                            @continue
                        @endif

                        
                    @endforeach
                    
                   





                  <div class="accordion-item">
                    <h2 class="accordion-header d-flex justify-content-between p-1" id="headingOne">

                      <button class="accordion-button collapsed col-md-10" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $category->category->id}}" aria-expanded="false" aria-controls="collapse{{ $category->category->id}}">
                       Category #{{ $category->category->id}} :: {{ $category->category->category }}  &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <span class="text-success">{{app\Helpers\categoryMarks($category->category->id,$practice->id,auth()->user()->id)}} / {{$category->category->marks}}</span> 
                      </button>

                      <button type="button" class="col-md-2 btn btn-success" data-bs-toggle="dropdown"  >Mark Category</button>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        @php
                            $criterias = app\Helpers\categoryCriterias($category->category->id);
                            $i=1;
                        @endphp
                    @foreach($criterias as $criteria)
                    @php
                    $marked = app\Helpers\criteriaMarked($criteria->id,$practice->id,auth()->user()->id);
                    @endphp
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#verticalycentered{{$criteria->id}}" href="#">Criteria {{$i++}} @if($marked) <i class="ri-check-line text-success"></i> @endif</a></li>
                    @endforeach
                    </ul>
                    @php
                            $i=1;
                    @endphp
                      
                    </h2>
                       
                    @foreach($criterias as $criteria)
                                @php
                                $button = 'Submit';
                                $marked = app\Helpers\criteriaMarked($criteria->id,$practice->id,auth()->user()->id);
                                $points = null;
                                $comment = null;
                                if($marked){
                                    $button = "Edit";
                                    $points = $marked->marks;
                                    $comment = $marked->comment;
                                }
                                $answers = app\Helpers\getAnswers($practice->id);
                                @endphp

                       <!-- Vertically centered Modal -->
                       <div class="modal fade" id="verticalycentered{{$criteria->id}}" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title"> Category #{{ $category->category->id}} :: {{ $category->category->category }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                   <!-- Horizontal Form -->
                                                   @if($marked)
                                                   <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        <i class="bi bi-check-circle me-1"></i>
                                                        Criteria Already Marked
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>
                                                   @endif
                                                    <form method="POST" action="{{url('evaluator/marking')}}">
                                                            @csrf
                                                        <input type="hidden" name="practice_id" value="{{$practice->id}}">
                                                        <input type="hidden" name="criteria_id" value="{{$criteria->id}}">
                                                        <input type="hidden" name="district_id" value="{{$district->id}}">
                                                                <!-- Card with titles, buttons, and links -->
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                    <h6 class="card-title py-0 my-0"><span class="text-dark">Criteria #{{$i}}: </span>{{$criteria->title}}</h6>
                                                                    <p class="card-text pt-1">{{$criteria->description}}</p>



                                                                     
                                                                   
                                                                    <div class="row mb-3">
                                                                  
                                                                    <div class="col-sm-12">
                                                                        <select class="form-select" aria-label="Default select example" required name="marks">
                                                                        <option selected disabled value="">Please Select Marks</option>
                                                                        @if($criteria->marks == 2.5)

                                                                        <option @if($points == 2.5) selected @endif value="2.5">2.5</option>
                                                                        <option @if($points == 2) selected @endif value="2">2</option>
                                                                        <option @if($points == 1.5) selected @endif value="1.5">1.5</option>
                                                                        <option @if($points == 1) selected @endif value="1">1</option>
                                                                        <option @if($points == 0.5) selected @endif value="0.5">0.5</option>
                                                                        <option  value="0">0</option>
                                                                        @else

                                                                        <option  value="0">0</option>
                                                                        <option @if($points == 1) selected @endif value="1">1</option>
                                                                        <option @if($points == 2) selected @endif value="2">2</option>
                                                                        <option @if($points == 3) selected @endif value="3">3</option>
                                                                        <option @if($points == 4) selected @endif value="4">4</option>
                                                                        <option @if($points == 5) selected @endif value="5">5</option>
                                                                        
                                                                        @endif
                                                                        </select>
                                                                    </div>
                                                                    </div>

                                                                    <div class="form-floating mb-3">
                                                                    <textarea class="form-control" required id="floatingTextarea" name="comment" style="height: 100px;">{{$comment}}</textarea>
                                                                    <label for="floatingTextarea">Comment</label>
                                                                    </div>

                                                                    </div>
                                                                </div>
                                                                <!-- End Card with titles, buttons, and links -->
                                                    
                                                    
                                                        <div class="text-center">
                                                        <button type="submit"
                                                        @if($marked)
                                                        onclick="return confirm('Are you sure you want to update your previous data on this criteria?')"
                                                        @endif
                                                        class="btn btn-primary"
                                                        >
                                                        {{$button}}
                                                        </button>
                                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                                        </div>
                                                    </form>
                                                    <!-- End Horizontal Form -->
              
                                                   
                                                   
                                                    </div>
                                                </div>
                                                </div>
                        </div>
                        <!-- End Vertically centered Modal-->
                    @endforeach

                    <div id="collapse{{ $category->category->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{ $category->category->id}}" data-bs-parent="#accordionExample" style="">
                        <!-- accordition body -->
                        <div class="accordion-body">
                         @php
                         $questions = app\Helpers\questionsInCategory($category->category->id);
                       
                         
                         @endphp   

                            <div class="col-xl-12">

                                <div class="card">
                                <div class="card-body pt-3">
                                    <!-- Bordered Tabs -->
                                    <ul class="nav nav-tabs nav-tabs-bordered">
                                       
                                        @foreach($questions as $question)
                                        <!-- checking if the question is for the active year -->
                                        @php
                                            $check =App\Models\QuestionYear::where('year_id',App\Helpers\activeYear()->id)->where('question_id',$question->id)->first();
                                        @endphp
                                        @if(!$check)
                                            @continue
                                        @endif

                                            <li class="nav-item">
                                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#q{{ $practice->id}}{{$question->id}}">Q{{$c++}}</button>
                                            </li>
                                        
                                        @endforeach
                                        
                                       
                                    </ul>
                                    

                                    <div class="tab-content pt-2">
                                
                                    
                                    
                                        @foreach($questions as $question)
                                           
                                                @php
                                                    $msg = '';
                                                
                                                    $method = '';
                                                    $button = 'Save Answer';
                                                    $detail = '';

                                                 
                                                @endphp
                                                @foreach($answers as $answer)
                                                    @php
                                                        if($answer->question_id == $question->id){
                                                            $detail = $answer->details;
                                                            break;
                                                        }
                                                    @endphp
                                                @endforeach

                                            <div class="tab-pane fade q{{ $practice->id}}{{$question->id}} pt-3" id="q{{ $practice->id}}{{$question->id}}">

                                                <!-- Question & Answer Form -->
                                                <form>
                                                   
                                                    

                                                    <input type="hidden" name="question_id" value="{{ $question->id }}">
                                                    <input type="hidden" name="practice_id" value="{{ $practice->id }}">
                                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

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

                                                    <div class="row mb-3">
                                                        <label for="Answer" class="col-md-3 col-lg-3 col-form-label">Answer:</label>
                                                        <div class="col-md-9 col-lg-9">
                                                        
                                                            <textarea id="" class="form-control summernote" name="answer" required>{{$detail}}</textarea>
                                                        </div>
                                                    </div>

                                                    <!-- <div class="text-center">
                                                        <button type="submit" @if($button=='Edit Answer') onclick="confirm('Are Sure You Want To Edit Your Answer?')" @endif class="btn btn-primary">{{ $button }}</button>
                                                    </div> -->
                                                </form><!-- Question & Answer Form -->
                                            </div>
                                        
                                        
                                         
                                        @endforeach
                                    
                                    
                                    </div><!-- End Bordered Tabs -->
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
    
        <!-- error model -->
        @if($errors->any())
    <script>
        // Add this script to automatically launch the modal
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('verticalycentered'));
            myModal.show();
        });
    </script>
    
    <!-- Vertically centered Modal -->
    <div class="modal fade" id="verticalycentered" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                @foreach($errors->all() as $error)
                <p class="text-danger">{{$error}}</p>
                @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Vertically centered Modal -->
@endif

        <!-- success modal-->
        @if(Session::has('success'))
    <script>
        // Add this script to automatically launch the modal
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('verticalycentered'));
            myModal.show();
        });
    </script>
    
    <!-- Vertically centered Modal -->
    <div class="modal fade" id="verticalycentered" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   {{Session('success')}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Vertically centered Modal -->
@endif

  </section>
@endsection
@section('scripts')
<script>
        // Add this script to automatically launch the modal
        document.addEventListener('DOMContentLoaded', function() {
            $('.summernote').summernote({
            readOnly: true,
            toolbar: [],
            
            });
            $('.summernote').summernote('disable');
        });
</script>
  
@endsection
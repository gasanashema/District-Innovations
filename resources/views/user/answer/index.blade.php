@extends('layouts.master')

@section('styles')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/vebj9tkkjd9uv3y96p83fthi9llr9f6bboygu7k91cdm9dju/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endsection
 

@section('content')

@php
$datesCheck = App\Helpers\checkPracticeDates();
@endphp
<div class="pagetitle">
    <h1>Welcome !</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">User Dashboard</li>
      </ol>
    </nav>
  </div>
    @if($datesCheck != true)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-ban me-1"></i>
            {{ "The dates for submitting practices and providing answers have expired." }}
          
        </div>
    @endif
  <section class="section profile">
    <div class="row">
 @if(Session::has('success'))     
<script>
    alert("{{session('success')}}");
</script>
 @endif
        <div class="col-lg-12">

        <div class="card">
              <div class="card-body">
                <h5 class="card-title">My Submitted Practice for {{$year->year}}</h5>
                @php
                $i=1;
                @endphp
                <!-- Default Accordion -->
                <div class="accordion" id="accordionExample">
                  @foreach($practices as $practice)
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $practice->id}}" aria-expanded="false" aria-controls="collapse{{ $practice->id}}">
                        @php
                        
                        $allAnswered = App\Helpers\checkAllPracticeAnswered($practice->id,auth()->user()->id);
                      
                        @endphp

                       Practice #{{ $i++}} :: {{ $practice->name }} 

                       @if($allAnswered==true)
                       <span class="text-success mx-4">
                              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                              <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"/>
                              <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708"/>
                            </svg>
                       </span>
                            
                            @endif
                       <!-- check if practice  dates using checkPracticeDates() function -->
                      </button>
                    </h2>
                    <div id="collapse{{ $practice->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{ $practice->id}}" data-bs-parent="#accordionExample" style="">
                      <div class="accordion-body">
                        

                        <div class="col-xl-12">

                        <div class="card">
                              <div class="card-body pt-3">
                                  <!-- Bordered Tabs -->
                                  <ul class="nav nav-tabs nav-tabs-bordered" id="myTabs">
                                    @php
                                      $c=1;
                                    @endphp
                                      @foreach($questions as $question)
                                      <li class="nav-item">
                                          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#q{{ $practice->id}}{{$question->question->id}}">Q{{$c++}}</button>
                                      </li>
                                      @endforeach
                                  </ul>

                                  <div class="tab-content pt-2">
                                    @php
                                      $k=1;
                                    @endphp
                                      @foreach($questions as $question)
                                      @php
                                      $msg = '';
                                      $url = url('user/answer');
                                      $method = '';
                                      $button = 'Save Answer';
                                      $detail = '';

                                      foreach($answeredQ as $answered) {
                                          if($question->question->id == $answered->question_id and $answered->practice_id==$practice->id) {
                                              $url = url('user/answer/'.$answered->id);
                                              $method = 'put';
                                              $button = 'Edit Answer';
                                              $msg = 'Question Answered';
                                              $detail =  $answered->details;
                                              break;
                                          }
                                      }

                                      if($datesCheck != true){
                                          $msg = "The dates for submitting practices and providing answers have expired.";
                                          $url = '';
                                          $method = '';
                                      }
                                      @endphp

                                      <div class="tab-pane fade q{{ $practice->id}}{{$question->question->id}} pt-3" id="q{{ $practice->id}}{{$question->question->id}}">
                                          @if($msg != '')
                                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                                              
                                              {{ $msg }}
                                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                          </div>
                                          @endif

                                          <!-- Question & Answer Form -->
                                          <form method="POST" action="{{ $url }}">
                                              @csrf
                                              @if($method == 'put')
                                              @method('put')
                                              @endif

                                              <input type="hidden" name="question_id" value="{{ $question->question->id }}">
                                              <input type="hidden" name="practice_id" value="{{ $practice->id }}">
                                              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                              <div class="row mb-3">
                                                  <label for="fullName" class="col-md-3 col-lg-3 col-form-label">Question:</label>
                                                  <div class="col-md-9 col-lg-9">
                                                      <textarea name="about" class="form-control" id="about" style="" disabled>{{ $question->question->details }}</textarea>
                                                  </div>
                                              </div>

                                              <div class="row mb-3">
                                                  <label for="about" class="col-md-3 col-lg-3 col-form-label">Instructions:</label>
                                                  <div class="col-md-9 col-lg-9">
                                                      <textarea name="about" class="form-control" id="about" style="height:200px;" disabled>{{ $question->question->instructions }}</textarea>
                                                  </div>
                                              </div>

                                              <div class="row mb-3">
                                                  <label for="Answer" class="col-md-3 col-lg-3 col-form-label">Answer:</label>
                                                  
                                                  <div class="col-md-9 col-lg-9">
                                                      <textarea id="" data-max-char-limit="{{ $question->question->number_of_characters }}" class="form-control summernote" name="answer" required>{{ $detail }}</textarea>
                                                  </div>
                                              </div>
                                              @if($datesCheck == true)
                                              <div class="text-center">
                                                  <button type="submit" @if($button=='Edit Answer') onclick="confirm('Are Sure You Want To Edit Your Answer?')" @endif class="btn btn-primary">{{ $button }}</button>
                                              </div>
                                              @endif
                                                    <!-- Next and Previous Buttons -->
                               
                                          </form><!-- Question & Answer Form -->
                                          <div class="mt-3 d-flex justify-content-between">
                                      <button class="btn btn-primary @if($k == 1) disabled @endif" onclick="showTab('prev')">Previous</button>
                                       @if($k < $questCount) 
                                      <button class="btn btn-primary ms-2" onclick="showTab('next')">Next</button>
                                      @else
                                      <a class="btn btn-primary ms-2" href="{{url('user/answer')}}">Finish</a>
                                      @endif
                                  </div>
                                      </div>
                                 @php
                                 $k++;
                                 @endphp
                                      @endforeach
                                  </div>

                                 
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
function showTab(direction) {
    const tabs = document.querySelectorAll('.nav-link');
    let activeIndex = 0;

    tabs.forEach((tab, index) => {
        if (tab.classList.contains('active')) {
            activeIndex = index;
        }
    });

    if (direction === 'next' && activeIndex < tabs.length - 1) {
        tabs[activeIndex + 1].click();
    } else if (direction === 'prev' && activeIndex > 0) {
        tabs[activeIndex - 1].click();
    } else if (direction === 'prev' && activeIndex === 0) {
        // Disable the button
        document.querySelector('.btn-prev').disabled = true;
    }
}

</script>
<script>
    // Function to initialize Summernote with maxCharLimit
    function initializeSummernote(maxCharLimit) {
        $('.summernote').summernote({
            toolbar: [
                // Grouping buttons with the 'name' property
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color', 'forecolor']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
            ],
            callbacks: {
                onKeydown: function(e) {
                    // Get the current content length
                    var contentLength = $(this).summernote('code').length;

                    // Check if the content length exceeds the limit
                    if (contentLength >= maxCharLimit) {
                        // Prevent further typing
                        e.preventDefault();
                    }
                },
                onChange: function(contents, $editable) {
                    // Update the character count or perform other actions if needed
                    var contentLength = contents.length;
                    console.log('Current content length:', contentLength);
                }
            }
        });
    }

    // Get the maxCharLimit from the data attribute and initialize Summernote
    $(document).ready(function() {
        $('.summernote').each(function() {
            var maxCharLimit = $(this).data('max-char-limit');
            initializeSummernote(maxCharLimit);
        });
    });
</script>
  
@endsection


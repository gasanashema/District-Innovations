@extends('layouts.master')

@section('styles')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <style>
        .modal-dialog {
    max-width: 80%;
    }
    </style>

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

                  @php
                  $files = App\Models\Files::where('practice_id',$practice->id)->get();
                  $allMarked =  app\Helpers\checkAllPracticeMarked($practice->id,auth()->user()->id);
                  @endphp  
                            <!-- Card with header and footer -->
                  <div class="card">
                      <div class="card-header py-0 d-flex justify-content-between">
                      <h5 class="card-title pb-0 col-md-10">
                          Practice Name: {{$practice->name}}&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
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
                      <a href="{{ url('evaluator/marking/'.$district->id.'/practices/'.$practice->id) }}" class="btn btn-success m-3 col-md-2">Mark Practice</a>
                      </div>
                      <div class="card-body">

                          <!-- Default List group -->
                          <ul class="list-group ">
                              <li class="list-group-item"><span class="text-primary">Start Date</span>: {{$practice->start_date}}</li>
                              <li class="list-group-item"><span class="text-primary">End Date</span>: {{$practice->end_date}}</li>
                              <li class="list-group-item"><span class="text-primary">Geographical Scope</span>: {{$practice->population}}</li>
                              <li class="list-group-item"><span class="text-primary">Description</span>: {{$practice->description}}</li>
                              <li class="list-group-item"><span class="text-primary">Practice Support Documents</span>:    <br>
                              @if($files)

                              @php
                                $s=1;
                              @endphp
                              
                                @foreach($files as $file)
                                  {{ $s++ .'. '.  $file->file_name}}
                              <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#verticalycentered{{$practice->id}}">
                                 View File
                              </button>
                               <!-- Vertically centered Modal -->
              
              <div class="modal fade" id="verticalycentered{{$practice->id}}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Practice <span class="text-primary">{{$practice->name}}</span> By <span class="text-primary">{{$district->name}} </span> District Support Document</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    @php
                        $extension = pathinfo($file->file_name, PATHINFO_EXTENSION);
                        if($extension == 'pdf'){
                          $mime_type = 'application/pdf';
                        }else{
                          $mime_type = ($extension == 'doc') ? 'application/msword' : 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
                        }
                      
                    @endphp

                    <object data="{{ asset($file->file_path) }}" type="{{ $mime_type }}" width="100%" height="600px">
                        <p>This browser does not support View for this document. Please download the document to view it: <a href="{{ asset($file->file_path) }}">Download Document</a></p>
                    </object> 
                    <p>
                      <span class="text-info">Comment:</span>
                        {{$file->comment}}
                    </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Vertically centered Modal-->
                        <br>
                        @endforeach
                              @else
                              {{'No file Uploaded'}}
                              @endif
                              </li>
                          </ul><!-- End Default List group -->

                          
                      </div>
                    </div><!-- End Card with header and footer -->
                  
                  
                 
                  
                    @endforeach
                  
                </div><!-- End Default Accordion Example -->
  
              </div>
            </div>
  
          </div>


        
        

    </div>
  </section>
@endsection

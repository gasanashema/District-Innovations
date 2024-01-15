<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="/{{ auth()->user()->type}}/home">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      @if (auth()->user()->type == 'admin') 
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
            <i class="ri-contacts-fill"></i><span>District Staff</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="{{ route('district_staff.create') }}">
                <i class="bi bi-circle"></i><span>Add</span>
              </a>
            </li>
            <li>
              <a href="{{ route('district_staff.index') }}">
                <i class="bi bi-circle"></i><span>Manage</span>
              </a>
            </li>
        
          </ul>
        </li><!-- End Components Nav -->

        <!-- Evaluators -->
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#evaluator" data-bs-toggle="collapse" href="#">
            <i class="ri-contacts-fill"></i><span>Evaluator</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="evaluator" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="{{ route('evaluator.create') }}">
                <i class="bi bi-circle"></i><span>Add</span>
              </a>
            </li>
            <li>
              <a href="{{ route('evaluator.index') }}">
                <i class="bi bi-circle"></i><span>Manage</span>
              </a>
            </li>
        
          </ul>
        </li><!-- End Evaluators Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#area" data-bs-toggle="collapse" href="#">
            <i class="ri-map-pin-2-fill"></i><span>Areas/Locations</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="area" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="{{ route('district.index') }}">
                <i class="bi bi-circle"></i><span>Districts</span>
              </a>
            </li>
            <li>
              <a href="{{ route('province.index') }}">
                <i class="bi bi-circle"></i><span>Provinces</span>
              </a>
            </li>
        
          </ul>
        </li><!-- End Components Nav -->
        
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#questions" data-bs-toggle="collapse" href="#">
            <i class="ri-questionnaire-fill"></i><span>Questions</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="questions" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            
            <li>
              <a href="{{ url('admin/year/question')}}">
                <i class="bi bi-circle"></i><span>Manage questions</span>
              </a>
            </li>

            <li>
              <a href="{{ url('admin/questioncategory/')}}">
                <i class="bi bi-circle"></i><span>Manage Questions Category</span>
              </a>
            </li>

            <li>
              <a href="{{ url('admin/marking/criteria')}}">
                <i class="bi bi-circle"></i><span>Marking Criterias</span>
              </a>
            </li>
            
          </ul>
        </li><!-- End Forms Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#answers" href="{{url('admin/answer/districts')}}">
            <i class="bi bi-journal-text"></i><span>Answers</span>
          </a>
        </li><!-- End Forms Nav -->


       <!-- End Tables Nav -->
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#report" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="report" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="{{url('admin/report/districts')}}">
                <i class="bi bi-circle"></i><span>Evaluation Report</span>
              </a>
            </li>
            <li>
              <a href="{{url('admin/report/')}}">
                <i class="bi bi-circle"></i><span>Ranking</span>
              </a>
            </li>

            
          </ul>
        </li><!-- End Forms Nav -->
        <li class="nav-item ">
          <a class="nav-link collapsed" href="{{ route('admin.profile')}}">
            <i class="bi bi-person"></i><span>Profile </span>
          </a>
        </li><!-- End Forms Nav -->

        <li class="nav-item ">
          <a class="nav-link collapsed" href="{{ url('admin/setting')}}">
            <i class="bi bi-gear"></i><span>Settings </span>
          </a>
        </li><!-- End Forms Nav -->
      @endif
      @if (auth()->user()->type == 'evaluator')
        <!-- End Forms Nav -->
        <li class="nav-item">
          <a class="nav-link" href="{{route('marking.index')}}">
            <i class="bi bi-journal-text"></i><span>Practice Marking </span>
          </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link collapsed" href="{{ route('evaluator.profile')}}">
            <i class="bi bi-person"></i><span>Profile </span>
          </a>
        </li><!-- End Forms Nav -->

      @endif
      @if (auth()->user()->type == 'user')
        <li class="nav-item">
          <a class="nav-link collapsed" href="{{ route('practice.index')}}">
            <i class="bi bi-journal-text"></i><span>My Practices</span>
          </a>
        </li><!-- End Forms Nav -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="{{ route('answer.index')}}">
            <i class="ri-question-answer-line"></i><span>My Answers </span>
          </a>
        </li><!-- End Forms Nav -->
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#area" data-bs-toggle="collapse" href="#">
          <i class="bi bi-file-earmark-arrow-up-fill"></i><span>My Files</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="area" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            @if(App\Helpers\checkPracticeDates() == true)
            <li>
              <a href="{{ route('files.create') }}">
                <i class="bi bi-circle"></i><span>Add </span>
              </a>
            </li>
            @endif
            <li>
              <a href="{{ url('user/files') }}">
                <i class="bi bi-circle"></i><span>Manage</span>
              </a>
            </li>
        
          </ul>
        </li><!-- End Components Nav -->
        <li class="nav-item ">
          <a class="nav-link collapsed" href="{{ route('user.profile')}}">
            <i class="bi bi-person"></i><span>Profile </span>
          </a>
        </li><!-- End Forms Nav -->
      @endif
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
          <i class="bi bi-box-arrow-right"></i><span>Sign out </span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
           </form>
      </li><!-- End Forms Nav -->

    </ul>

  </aside><!-- End Sidebar-->
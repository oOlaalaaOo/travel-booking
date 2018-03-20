<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link @if($active_link == 'dashboard') active @endif" href="{{ route('admin.dashboard') }}">
          <i class="fa fa-home"></i>
          Dashboard <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if($active_link == 'bookings') active @endif" href="{{ route('admin.booking.all') }}">
          <i class="fa fa-book"></i>
          Bookings
        </a>
      </li>
      
      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>Site Settings</span>
      <a class="d-flex align-items-center text-muted" href="#">
        <span data-feather="plus-circle"></span>
      </a>
      </h6>
      <li class="nav-item">
        <a class="nav-link @if($active_link == 'site-contents') active @endif" href="{{ route('admin.site-contents') }}">
          <i class="fa fa-wrench"></i>
           Site Contents
        </a>
      </li>

      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>Account Settings</span>
      <a class="d-flex align-items-center text-muted" href="#">
        <span data-feather="plus-circle"></span>
      </a>
      </h6>
      <li class="nav-item">
        <a class="nav-link @if($active_link == 'profile') active @endif" href="{{ route('admin.account.profile-view') }}">
          <i class="fa fa-user"></i>
           Profile
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if($active_link == 'credentials') active @endif" href="{{ route('admin.account.credentials-view') }}">
          <i class="fa fa-key"></i>
           Account Credentials
        </a>
      </li>
      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>Tour Settings</span>
      <a class="d-flex align-items-center text-muted" href="#">
        <span data-feather="plus-circle"></span>
      </a>
      </h6>
      <li class="nav-item">
        <a class="nav-link @if($active_link == 'tour-package') active @endif" href="{{ route('admin.tour.all') }}">
          <i class="fa fa-tags"></i>
          Tour Package
        </a>
      </li>
      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>Post Settings</span>
      <a class="d-flex align-items-center text-muted" href="#">
        <span data-feather="plus-circle"></span>
      </a>
      </h6>
      <li class="nav-item">
        <a class="nav-link @if($active_link == 'posts') active @endif" href="{{ route('admin.post.all') }}">
          <i class="fa fa-thumb-tack"></i>
          Posts
        </a>
      </li>

      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>Reports</span>
      <a class="d-flex align-items-center text-muted" href="#">
        <span data-feather="plus-circle"></span>
      </a>
      </h6>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.report') }}" @if($active_link == 'report') active @endif">
          <span data-feather="bar-chart-2"></span>
          Reports
        </a>
      </li>
    </ul>
    </ul>
  </div>
</nav>
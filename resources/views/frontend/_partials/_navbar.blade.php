<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
  <a class="navbar-brand" href="{{ route('home') }}">
    <img src="{{ asset('img/icon.png') }}" width="30" height="30" alt=""> {{ $site_name }}
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link @if($active_link == 'home') active @endif" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if($active_link == 'news') active @endif" href="{{ route('news') }}">News &amp; Updates</a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if($active_link == 'contact-us') active @endif" href="{{ route('contact-us') }}">Contact Us</a>
      </li>

      <li class="nav-item dropdown @if($active_link == 'about-us') active @endif">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          About Us
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('our-company') }}">Our Company</a>
          <a class="dropdown-item" href="{{ route('mission-vision') }}">Mission &amp; Vision</a>
        </div>
      </li>
      <li class="nav-item"><a class="nav-link @if($active_link == 'tour-packages') active @endif" href="{{ route('tour-packages') }}">Tour Packages</a></li>
    </ul>
  </div>
</nav>
<br />
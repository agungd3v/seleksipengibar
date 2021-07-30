<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link type="text/css" href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
  <link type="text/css" href="{{ asset('vendor/notyf/notyf.min.css') }}" rel="stylesheet">
  <link type="text/css" href="{{ asset('css/volt.css') }}" rel="stylesheet">
  @stack('css')
  <title>Dashboard - Seleksi pengibar bendera</title>
  <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/favicon/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('img/favicon/site.webmanifest') }}">
  <link rel="mask-icon" href="{{ asset('img/favicon/safari-pinned-tab.svg') }}" color="#ffffff">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff">
</head>
<body>
  <nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
    <a class="navbar-brand me-lg-5" href="#">
      <img class="navbar-brand-dark" src="{{ asset('img/favicon/favicon-32x32.png') }}" alt="Volt logo" />
      <img class="navbar-brand-light" src="{{ asset('img/brand/dark.svg') }}" alt="Volt logo" />
    </a>
    <div class="d-flex align-items-center">
      <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>
  <nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">
      <div class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
        <div class="d-flex align-items-center">
          <div class="avatar-lg me-4">
            <img src="{{ asset('img/team/profile-picture-3.jpg') }}" class="card-img-top rounded-circle border-white"
              alt="{{ Auth::user()->name }}">
          </div>
          <div class="d-block">
            <h2 class="h5 mb-3">Hi, Jane</h2>
            <a href="#" class="btn btn-secondary btn-sm d-inline-flex align-items-center">
              <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>            
              Sign Out
            </a>
          </div>
        </div>
        <div class="collapse-close d-md-none">
          <a href="#sidebarMenu" data-bs-toggle="collapse"
              data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="true"
              aria-label="Toggle navigation">
              <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </a>
        </div>
      </div>
      <ul class="nav flex-column pt-3 pt-md-0">
        <li class="nav-item">
          <a href="/" class="nav-link d-flex align-items-center">
            <span class="sidebar-icon">
              <img src="{{ asset('img/favicon/favicon-32x32.png') }}" height="20" width="20" alt="Volt Logo">
            </span>
            <span class="mt-1 ms-1 sidebar-text">Seleksi Pengibar</span>
          </a>
        </li>
        <li class="nav-item @yield('dashboard')">
          <a href="{{ route('admin.dashboard') }}" class="nav-link">
            <span class="sidebar-icon">
              <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
            </span> 
            <span class="sidebar-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item @yield('peserta')">
          <a href="{{ route('admin.peserta') }}" class="nav-link">
            <span class="sidebar-icon">
              <svg class="icon icon-xs me-2" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </span> 
            <span class="sidebar-text">Peserta</span>
          </a>
        </li>
        <li class="nav-item @yield('penilaian')">
          <a href="{{ route('admin.penilaian') }}" class="nav-link">
            <span class="sidebar-icon">
              <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path></svg>
            </span> 
            <span class="sidebar-text">Penilaian</span>
          </a>
        </li>
      </ul>
    </div>
  </nav>
  <main class="content">
    <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
      <div class="container-fluid px-0">
        <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
          <div class="d-flex align-items-center"></div>
          <ul class="navbar-nav align-items-center">
            <li class="nav-item dropdown ms-lg-3">
              <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="media d-flex align-items-center">
                  <img class="avatar rounded-circle" alt="Image placeholder" src="{{ asset('img/team/profile-picture-3.jpg') }}">
                  <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block">
                    <span class="mb-0 font-small fw-bold text-gray-900">{{ Auth::user()->name }}</span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1">
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path></svg>
                  My Profile
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z" clip-rule="evenodd"></path></svg>
                  Support
                </a>
                <div role="separator" class="dropdown-divider my-1"></div>
                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0)" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                  <svg class="dropdown-icon text-danger me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>                
                  Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="py-4">
      <div class="d-flex justify-content-between align-items-end w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
          <h1 class="h4">@yield('title')</h1>
        </div>
        @yield('report')
      </div>
    </div>
    @yield('content')
  </main>
  <script src="{{ asset('vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('vendor/onscreen/dist/on-screen.umd.min.js') }}"></script>
  <script src="{{ asset('vendor/nouislider/distribute/nouislider.min.js') }}"></script>
  <script src="{{ asset('vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
  <script src="{{ asset('vendor/chartist/dist/chartist.min.js') }}"></script>
  <script src="{{ asset('vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
  <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
  <script src="{{ asset('vendor/vanillajs-datepicker/dist/js/datepicker.min.js') }}"></script>
  <script src="{{ asset('vendor/notyf/notyf.min.js') }}"></script>
  <script src="{{ asset('vendor/simplebar/dist/simplebar.min.js') }}"></script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="{{ asset('js/volt.js') }}"></script>
  @stack('js')
</body>
</html>
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
    <title>Seleksi pengibar bendera</title>
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('img/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('img/favicon/safari-pinned-tab.svg') }}" color="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="og:title" content="Seleksi pengibar"/>
    <meta name="og:type" content="website"/>
    <meta name="og:url" content="http://seleksipengibar.online/"/>
    <meta name="og:image" content="{{ asset('img/favicon/favicon-32x32.png') }}"/>
    <meta name="og:site_name" content="IMDb"/>
    <meta name="og:description" content="Platform informasi seleksi pengibar online 2021"/>
    <meta name="theme-color" content="#ffffff">
    <meta name="keywords" content="your, tags"/>
    <meta name="description" content="Platform informasi seleksi pengibar online 2021"/>
    <meta name="subject" content="Seleksi pengibar online 2021">
    <meta name="copyright"content="agungd3v">
    <meta name="language" content="ID">
    <meta name="robots" content="index,follow" />
    <meta name="Classification" content="Business">
    <meta name="author" content="agungd3v, agungd3v@gmail.com">
    <meta name="designer" content="agungd3v">
    <meta name="copyright" content="agungd3v">
    <meta name="owner" content="agungd3v">
    <meta name="url" content="http://seleksipengibar.online">
    <meta name="identifier-URL" content="http://seleksipengibar.online">
    <meta name="directory" content="submission">
    <meta name="coverage" content="Worldwide">
    <meta name="distribution" content="Global">
    <meta name="revisit-after" content="7 days">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
</head>

<body>
    <header class="header-global">
        <nav id="navbar-main" aria-label="Primary navigation" class="navbar navbar-main navbar-expand-lg navbar-theme-primary pt-4 navbar-dark">
            <div class="container position-relative">
                <div class="navbar-collapse collapse me-auto" id="navbar_global">
                    <div class="navbar-collapse-header">
                        <div class="row">
                            <div class="col-6 collapse-brand">
                                <a href="/">
                                    <img src="{{ asset('img/brand/light.svg') }}" alt="Volt logo">
                                </a>
                            </div>
                            <div class="col-6 collapse-close">
                                <a href="#navbar_global" class="fas fa-times" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" title="close" aria-label="Toggle navigation"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center ms-auto">
                    @if (Route::has('login'))
                        <div class="top-right links">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-outline-white d-inline-flex align-items-center me-md-3">
                                    <svg class="icon icon-xxs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path></svg>
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-white d-inline-flex align-items-center me-md-3">
                                    <svg class="icon icon-xxs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                                    Login
                                </a>
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </nav>
    </header>
    <main class="bg-white">
        <section class="section-header overflow-hidden pt-7 pt-lg-8 pb-9 pb-lg-12 bg-primary text-white">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="bootstrap-big-icon d-none d-lg-block">
                            <img src="{{ asset('img/content-bg.jpg') }}">
                        </div>
                        <h1 class="fw-bolder position-relative" style="z-index: 1">Seleksi Pengibar Bendera</h1>
                        <h2 class="lead fw-normal text-muted mb-5 position-relative" style="z-index: 1">Penilaian peserta seleksi 2021</h2>
                        <div class="d-flex align-items-center justify-content-center mb-5 position-relative" style="z-index: 1">
                            <a href="{{ route('peserta') }}" class="btn btn-secondary d-inline-flex align-items-center me-4">
                                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11 4a1 1 0 10-2 0v4a1 1 0 102 0V7zm-3 1a1 1 0 10-2 0v3a1 1 0 102 0V8zM8 9a1 1 0 00-2 0v2a1 1 0 102 0V9z" clip-rule="evenodd"></path></svg>
                                List Peserta
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <figure class="position-absolute bottom-0 left-0 w-100 d-none d-md-block mb-n2"><svg class="home-pattern" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 3000 185.4"><path d="M3000,0v185.4H0V0c496.4,115.6,996.4,173.4,1500,173.4S2503.6,115.6,3000,0z"></path></svg></figure>       
        </section>
        <div class="section pt-0">
            <div class="container mt-n10 mt-lg-n12 z-2">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <img src="">
                    </div>
                </div>
            </div>
        </div>
        <section class="section section-lg bg-transparent pt-0 pb-0">
            <div class="container">
                <div class="row justify-content-center mb-5 mb-lg-6">
                    <div class="col-6 col-md-3 text-center mb-4">
                        <div class="icon icon-shape bg-white shadow-lg rounded mb-4">
                            <svg class="icon icon-md text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <h3 class="fw-bolder text-white">21</h3>
                        <p class="text-gray text-white">Total Sekolah</p>
                    </div>
                    <div class="col-6 col-md-3 text-center mb-4">
                        <div class="icon icon-shape bg-white shadow-lg rounded mb-4">
                            <svg class="icon icon-md text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h3 class="fw-bolder text-white">800+</h3>
                        <p class="text-gray text-white">Total Peserta</p>
                    </div>
                    <div class="col-6 col-md-3 text-center">
                        <div class="icon icon-shape bg-white shadow-lg rounded mb-4">
                            <svg class="icon icon-md text-secondary" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM5.05 6.464A1 1 0 106.464 5.05l-.707-.707a1 1 0 00-1.414 1.414l.707.707zM5 10a1 1 0 01-1 1H3a1 1 0 110-2h1a1 1 0 011 1zM8 16v-1h4v1a2 2 0 11-4 0zM12 14c.015-.34.208-.646.477-.859a4 4 0 10-4.954 0c.27.213.462.519.476.859h4.002z"></path></svg>
                        </div>
                        <h3 class="fw-bolder text-white">10+</h3>
                        <p class="text-gray text-white">Penguji</p>
                    </div>
                    <div class="col-6 col-md-3 text-center">
                        <div class="icon icon-shape bg-white shadow-lg rounded mb-4">
                            <svg class="icon icon-md text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        </div>
                        <h3 class="fw-bolder text-white">200+</h3>
                        <p class="text-gray text-white">Nilai diatas rata-rata</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="section section-lg bg-white pt-3" id="pricing">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <h2 class="h1 fw-bold mb-3">Open source</h2>
                        <p class="lead mb-4">Seleksi pengibar bendera is an open source project. Give us a lucky star to spread the open source love ❤️</p>
                        <div class="d-flex align-items-center">
                            <a href="https://github.com/agungd3v/seleksipengibar" target="_blank" class="btn btn-gray-800 me-4">
                                View on GitHub
                            </a>
                            <div class="mt-2">
                                <a class="github-button" href="https://github.com/agungd3v/seleksipengibar" data-color-scheme="no-preference: dark; light: light; dark: light;" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star /themesberg/volt-bootstrap-5-dashboard on GitHub">Star</a>                            
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-lg-6 row">
                    <div class="text-center col-12">
                       <h2 class="h5 text-gray fw-normal mb-4">Available in the following technologies:</h2>
                       <div>
                            <a class="me-3 card-link" href="https://getbootstrap.com/" target="_blank">
                                <img src="{{ asset('img/technologies/bootstrap-5-logo.svg') }}" class="image image-sm">
                            </a>
                            <a class="me-3 card-link" href="https://reactjs.org/" target="_blank">
                                <img src="{{ asset('img/technologies/react-logo.svg') }}" class="image image-sm">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
</body>
</html>
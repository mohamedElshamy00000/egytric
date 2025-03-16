<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">

        <title>{{ $title ?? 'EgyTric' }}</title>

		<meta name="keywords" content="Digital marketing agency, Digital marketing company, Digital marketing services, sass, software company">
		<meta name="description" content="Deski is a creative saas and software html template designed for saas and software Agency websites.">
      	<meta property="og:site_name" content="deski">
      	<meta property="og:url" content="https://heloshape.com/">
      	<meta property="og:type" content="website">
      	<meta property="og:title" content="Deski: creative saas and software html template">
		<meta name='og:image' content='images/assets/ogg.png'>
		<!-- For IE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- For Resposive Device -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- For Window Tab Color -->
		<!-- Chrome, Firefox OS and Opera -->
		<meta name="theme-color" content="#2a2a2a">
		<!-- Windows Phone -->
		<meta name="msapplication-navbutton-color" content="#2a2a2a">
		<!-- iOS Safari -->
		<meta name="apple-mobile-web-app-status-bar-style" content="#2a2a2a">

		<!-- fonts Almarai -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">

        {{-- cairo font --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
		<!-- Favicon -->
		<link rel="icon" type="image/png" sizes="56x56" href="{{ asset('frontend/images/fav-icon/F-icon.svg') }}">
		<!-- Main style sheet -->
		<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">
		<!-- responsive style sheet -->
		<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/responsive.css') }}">

        <!-- CUSTOM style sheet -->
		<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/components.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/custom.css') }}">


		<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/rtl.css') }}">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
		<!-- Fix Internet Explorer ______________________________________-->
		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<script src="vendor/html5shiv.js"></script>
			<script src="vendor/respond.js"></script>
		<![endif]-->
        @stack('styles')
        {{-- @vite('resources/css/app.css') --}}
        @livewireStyles()
    </head>
    <body>

        @livewire('partials.header')
        <main>
            {{ $slot }}
        </main>
        @livewire('partials.footer')

        @livewireScripts()
        {{-- @vite('resources/js/app.js') --}}
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <x-livewire-alert::scripts />

        <a href="https://wa.me/{{ setting('site_phone') }}" class="chatbot-button" target="_blank">
            {{-- <span class="text-dark">متردد؟اسألنا</span> --}}
            <div class="chatbot-icon bg-light">
                {{-- <img src="{{ asset('frontend/images/logo/Artboard 31.png') }}" alt=""> --}}
                <i class="fa fa-whatsapp text-success h3"></i>
            </div>
        </a>
    </body>

        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- jQuery -->
    <script src="{{ asset('frontend/vendor/jquery.min.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('frontend/vendor/popper.js/popper.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- menu  -->
    <script src="{{ asset('frontend/vendor/mega-menu/assets/js/custom.js') }}"></script>
    <!-- AOS js -->
    <script src="{{ asset('frontend/vendor/aos-next/dist/aos.js') }}    "></script>
    <!-- js count to -->
    <script src="{{ asset('frontend/vendor/jquery.appear.js') }}"></script>
    <script src="{{ asset('frontend/vendor/jquery.countTo.js') }}"></script>
    <!-- Slick Slider -->
    <script src="{{ asset('frontend/vendor/slick/slick.min.js') }}"></script>
    <!-- Fancybox -->
    <script src="{{ asset('frontend/vendor/fancybox/dist/jquery.fancybox.min.js') }}"></script>
    <!-- validator js -->
    <script src="{{ asset('frontend/vendor/validator.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- Theme js -->
    <script src="{{ asset('frontend/js/theme.js') }}"></script>

    @stack('scripts')
</html>

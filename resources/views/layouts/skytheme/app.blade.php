<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'/>

  <title>@yield('title') - {{ config('app.name') }}</title>

  {{-- Start of required lines block. DON'T REMOVE THESE LINES! They're required or might break things --}}
  <meta name="base-url" content="{!! url('') !!}">
  <meta name="api-key" content="{!! Auth::check() ? Auth::user()->api_key: '' !!}">
  <meta name="csrf-token" content="{!! csrf_token() !!}">
  {{-- End the required lines block --}}

  <link href="{{ public_mix('/assets/global/css/vendor.css') }}" rel="stylesheet"/>
  <link rel="shortcut icon" type="image/png" href="{{ public_asset('/assets/img/favicon.png') }}"/>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link href="{{ asset('assets/darkpan/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/darkpan/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/apex/ch_apex.css') }}" rel="stylesheet">

  <style>
    body {
      font-family: "Open Sans", sans-serif;
      background: #000;
      color: #e9ecef;
    }

    .main-content-wrap {
      background: #000;
      min-height: calc(100vh - 68px);
    }

    .content-card {
      background: #191C24;
      border-radius: 8px;
      padding: 1rem;
    }

    .footer,
    .footer a {
      color: #6c7293;
    }

    .footer {
      border-top: 1px solid rgba(255, 255, 255, 0.08);
    }

    .dropdown-menu {
      background: #191C24;
      border-color: rgba(255, 255, 255, 0.08);
    }

    .dropdown-item {
      color: #6c7293;
    }

    .dropdown-item:hover,
    .dropdown-item:focus {
      color: #eb1616;
      background: #000;
    }

    .select2-container,
    .select2-container * {
      color: #212529 !important;
    }
  </style>

  {{-- Start of the required files in the head block --}}
  @yield('css')
  @yield('scripts_head')
  {{-- End of the required stuff in the head block --}}
</head>
<body>
@include('helpers')

<div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
  <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>

<div class="container-fluid position-relative d-flex p-0">
  <div class="content w-100">
    @include('nav')

    <div class="main-content-wrap">
      @include('background')

      <div class="container-fluid pt-4 px-4">
        @include('flash.message')
        @yield('content')
      </div>
    </div>

    @include('footer')
  </div>
</div>

{{-- External Redirects Modal --}}
@include('external_redirect_modal')

<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

{{-- Start of the required tags block. Don't remove these or things will break!! --}}
<script src="{{ public_mix('/assets/global/js/vendor.js') }}"></script>
<script src="{{ public_mix('/assets/frontend/js/vendor.js') }}"></script>
<script src="{{ public_mix('/assets/frontend/js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
  (function ($) {
    "use strict";

    setTimeout(function () {
      if ($('#spinner').length > 0) {
        $('#spinner').removeClass('show');
      }
    }, 1);

    $(window).on('scroll', function () {
      if ($(this).scrollTop() > 300) {
        $('.back-to-top').fadeIn('slow');
      } else {
        $('.back-to-top').fadeOut('slow');
      }
    });

    $('.back-to-top').on('click', function () {
      $('html, body').animate({scrollTop: 0}, 600);
      return false;
    });
  })(jQuery);
</script>

@include('scripts.bs_theme')
@yield('scripts')

{{--
It's probably safe to keep this to ensure you're in compliance
with the EU Cookie Law https://privacypolicies.com/blog/eu-cookie-law
--}}
<script>
  window.addEventListener("load", function () {
    window.cookieconsent.initialise({
      palette: {
        popup: {
          background: "#edeff5",
          text: "#838391"
        },
        button: {
          "background": "#067ec1"
        }
      },
      position: "top",
    })
  });
</script>
{{-- End the required tags block --}}

<script>
  $(document).ready(function () {
    $("select.select2").select2({width: 'resolve'});
  });
</script>

@php
  $gtag = setting('general.google_analytics_id');
@endphp
@if($gtag)
  <script async src="https://www.googletagmanager.com/gtag/js?id={{ $gtag }}"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '{{ $gtag }}');
  </script>
@endif

</body>
</html>

<!DOCTYPE html>  
<html lang="{{ App::getlocale() }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        {{-- generate seo info --}}
        {!! SEO::generate() !!}
        {!! JsonLdMulti::generate() !!}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!--=====================================
                    CSS LINK PART START
        =======================================-->
        <!-- FOR PAGE ICON -->
        <link rel="icon" href="{{ asset('uploads/'.domain_info('user_id').'/favicon.ico') }}">
        @php 
        Helper::autoload_site_data();        
        @endphp
        <style type="text/css">
           :root {
              --main-theme-color: {{ Cache::get(domain_info('user_id').'theme_color','#dc3545') }};   
          }
        </style>
        <!-- FOR FONT ICON -->
       <link rel="stylesheet" href="{{ asset('assets/css/fontawsome/all.min.css') }}">
       <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700;800;900&display=swap">
        <!-- FOR SLICK SLIDER -->
        <link rel="stylesheet" href="{{ asset('frontend/'.domain_info('user_id').'/bigbag/css/slick.css') }}">

        <!-- FOR BOOTSTRAP -->
        <link rel="stylesheet" href="{{ asset('frontend/'.domain_info('user_id').'/bigbag/css/bootstrap.min.css') }}">
         @stack('css')
        <!-- FOR STYLE -->
        <link rel="stylesheet" href="{{ asset('frontend/'.domain_info('user_id').'/bigbag/css/main.css') }}">
       
        <!--=====================================
                    CSS LINK PART END
        =======================================-->
        {{ load_header() }}
    </head>
<body>
 


{{-- load partials views --}}      
@include('frontend/'.domain_info('user_id').'/bigbag/layouts/header')
@yield('content')
@include('frontend/'.domain_info('user_id').'/bigbag/layouts/footer')

{{-- end load --}}





{{-- load whatsapp api --}}
{{ load_whatsapp() }}
{{-- end whatsapp api loading --}}

@php
$currency_info=currency_info();
$currency_names = $currency_info["currency_name"];
$currency_icon = "";
$to_currency = Session::get('to_currency');
$default_arr = [$currency_info["currency_default"]->currency_name => $currency_info["currency_default"]->currency_icon];
$arr = (array)$currency_names;
$arr[$currency_info["currency_default"]->currency_name] = $currency_info["currency_default"]->currency_icon;

foreach($arr as $key => $value){
  if($key == $to_currency){
    $currency_icon = $value;
  }
}
@endphp
 
<input type="hidden" id="currency_position" value="{{ $currency_info['currency_position'] }}">
<input type="hidden" id="currency_name" value= "{{$to_currency}}" >
<input type="hidden" id="currency_icon" value= "{{$currency_icon}}" >
<input type="hidden" id="preloader" value="{{ asset('uploads/preload.webp') }}">
<input type="hidden" id="base_url" value="{{ url('/') }}">
<input type="hidden" id="theme_color" value="{{ Cache::get(domain_info('user_id').'theme_color','#dc3545') }}">
<input type="hidden" id="rate" value="{{Session::get('rate_base')}}" >

<!--=====================================
             JS LINK PART START
 =======================================-->
 <!-- FOR BOOTSTRAP -->
 <script src="{{ asset('frontend/'.domain_info('user_id').'/bigbag/js/jquery-3.5.1.min.js')}}"></script>
 <script src="{{ asset('assets/js/jquery.unveil.js') }}"></script>
 <script src="{{ asset('frontend/'.domain_info('user_id').'/bigbag/js/cart.js')}}"></script>
 <script src="{{ asset('frontend/'.domain_info('user_id').'/bigbag/js/popper.min.js')}}"></script>
 <script src="{{ asset('frontend/'.domain_info('user_id').'/bigbag/js/bootstrap.min.js')}}"></script>
 <!-- FOR SLICK SLIDER -->
 <script src="{{ asset('frontend/'.domain_info('user_id').'/bigbag/js/slick.min.js')}}"></script>
 <script src="{{ asset('frontend/'.domain_info('user_id').'/bigbag/js/slick.js')}}"></script>
 <!-- FOR NICESCROLL -->
 <script src="{{ asset('frontend/'.domain_info('user_id').'/bigbag/js/nicescroll.min.js')}}"></script>

  @stack('js')
 <!-- FOR INTERACTION -->
 <script src="{{ asset('frontend/'.domain_info('user_id').'/bigbag/js/main.js')}}"></script>
 <script src="{{ asset('frontend/'.domain_info('user_id').'/bigbag/js/form.js')}}"></script>
 <script src="{{ asset('frontend/'.domain_info('user_id').'/bigbag/js/sweetalert2.all.min.js')}}"></script>
 {{ load_footer() }}
<!--=====================================
    JS LINK PART END
=======================================-->
    </body>
</html>
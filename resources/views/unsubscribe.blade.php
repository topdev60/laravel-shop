@extends('main.app')
@section('content')
<section class="page-title bg-1">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <span class="text-white">{{ __('Unsubscribe') }}</span>
          <h1 class="text-capitalize mb-5 text-lg">{{ __('Do not receive Our Emails') }}</h1>
        </div>
      </div>
    </div>
  </div>
</section>


@if(Cache::has('site_info'))
@php
$info=Cache::get('site_info','');
@endphp
@endif
<section class="contact-form-wrap section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        
          <form action="{{ route('register_unsubscriber') }}" method="post" class="basicform_with_reset contact__form">
              @csrf
          <!-- form message -->
          

          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <input name="name" id="name"   required type="text" class="form-control" placeholder="Your Full Name">
              </div>
            </div>

            <div class="col-lg-6">
              <div class="form-group">
                <input name="email" id="email"  type="email" class="form-control" placeholder="Your Email Address" required>
              </div>
            </div>
           
          </div>

          @if(env('NOCAPTCHA_SITEKEY') != null)
          <div class="form-group">
            {!! NoCaptcha::renderJs() !!}
            {!! NoCaptcha::display() !!}
          </div>
          @endif 
          <div>
            <input class="btn btn-main btn-round-full basicbtn" name="submit" type="submit" value="Unsubscribe"></input>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>



@endsection
@push('js')
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush
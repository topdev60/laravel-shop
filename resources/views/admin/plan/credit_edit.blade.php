@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>'Edit Credit Plan'])
@endsection
@section('content') 
<div class="row">
  <div class="col-12 mt-2">
    <div class="card">
      <div class="card-body">
         <form method="post" action="{{ route('admin.plans.credit.update', $credit->id) }}" >
            @csrf
            <div class="form-group">
                <label for="numerical">Numerical Credits:</label>
                <input type="number" name="numerical" class="form-control" step="1000" min="1000" value="{{$credit->num}}" require="">
            </div>
            <div class="form-group">
                <label for="original_price">Original Price:</label>
                <input type="number" name="original_price" class="form-control" min="0" value="{{$credit->original_price}}" require="">
              </div>
            <div class="form-group">
                <label for="discount_price">Discount Price:</label>
                <input type="number" name="discount_price" class="form-control" min="0" value="{{$credit->discount_price}}" require="">
            </div>
            <div class="form-check-inline">
                <label class="form-check-label">
                   <input type="radio" name="set_step" class="form-check-input" value="1" @if($credit->set_step) checked @endif>Set Step 
                </label>
            </div>
            <div class="form-check-inline">
                <label class="form-check-label">
                   <input type="radio" name="set_step" class="form-check-input" value="0" @if(!$credit->set_step) checked @endif>Don't Set Step 
                </label>
            </div>
            <button type="Submit" class="btn btn-info">Submit</button>
       </form>
     </div>
   </div>
 </div>
</div>

@endsection

@push('js')
<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush
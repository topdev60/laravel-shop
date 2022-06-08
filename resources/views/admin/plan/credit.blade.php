@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>'Email Plans'])
@endsection
@section('content') 
<div class="row">
  <div class="col-12 mt-2">
    <div class="card">
      <div class="card-body">
          <form method="post" action="{{ route('admin.plans.credits.destroys') }}" class="basicform_with_reload">
            @csrf
            <div class="float-left mb-1">
              <div class="input-group">
                <select class="form-control" name="type">
                  <option value="" >{{ __('Select Action') }}</option>
                  <option value="delete" >{{ __('Delete Permanently') }}</option>
                </select>
                <div class="input-group-append">                                            
                  <button class="btn btn-primary" type="submit">{{ __('Submit') }}</button>
                </div>
              </div>
            </div>
            <div class="float-right">
              @can('plan.create')
              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#create_EmailPlan_modal" >{{ __('Create Email Plan') }}</a>
              @endcan
            </div>
        
          <div class="table-responsive">
            <table class="table table-striped table-hover text-center table-borderless">
              <thead>
                <tr>
                  <th><input type="checkbox" class="checkAll"></th>

                  <th>{{ __('Numeric') }}</th>
                  <th>{{ __('Original Price') }}</th>
                  <th>{{ __('Discount Price') }}</th>
                  <th>{{ __('Set Step') }}</th>
                  <th>{{ __('Created at') }}</th>
                  <th>{{ __('Action') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($credits as $credit)
                    <tr id="{{'row'.$credit->id}}">
                      <td><input type="checkbox" name="ids[]" value="{{ $credit->id }}"></td>
                       <td>{{$credit->num}}</td>
                      <td>{{amount_admin_format($credit->original_price)}}</td>
                      <td>{{amount_admin_format($credit->discount_price)}}</td>
                      <td>@if($credit->set_step){{'Setted as Step'}}@endif</td>
                      <td>{{$credit->created_at->diffforHumans()}}</td>
                      <td>
                        <a href="{{ route('admin.plans.credit.edit', $credit->id) }}" class="btn btn-primary btn-sm text-center"><i class="far fa-edit"></i></a>
                      </td>
                    </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                 <th><input type="checkbox" class="checkAll"></th>

                 <th>{{ __('Name') }}</th>
                 <th>{{ __('Original Price') }}</th>
                 <th>{{ __('Discount Price') }}</th>
                 <th>{{ __('Set Step') }}</th>
                 <th>{{ __('Created at') }}</th>
                 <th>{{ __('Action') }}</th>
               </tr>
             </tfoot>
           </table>
         </div>
       </form>
     </div>
   </div>
 </div>
</div>

<!-- The Create Email Plan Modal -->
  <div class="modal" id="create_EmailPlan_modal">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h1 class="modal-title">Create Email Plan</h1>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <form action="{{route('admin.plans.credit.create')}}" method="post" class="basicform_with_reload">
            <!-- Modal body -->
            <div class="modal-body">
              <div class="form-group">
                  <label for="numerical">Numerical Credits:</label>
                  <input type="number" name="numerical" class="form-control" step="1000" min="1000" value="1000" require="">
              </div>
              <div class="form-group">
                  <label for="original_price">Original Price:</label>
                  <input type="number" name="original_price" class="form-control" min="0" value="0" require="">
              </div>
              <div class="form-group">
                  <label for="discounted_price">Discount Price:</label>
                  <input type="number" name="discount_price" class="form-control" min="0" value="0" require="">
              </div>
              <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" name="set_step" class="form-check-input" value="1">Set Step 
                  </label>
              </div>
              <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" name="set_step" class="form-check-input" value="0" checked>Don't Set Step 
                  </label>
              </div>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="Submit" class="btn btn-info">Submit</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </form>
        
      </div>
    </div>
  </div>

@endsection

@push('js')
<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush
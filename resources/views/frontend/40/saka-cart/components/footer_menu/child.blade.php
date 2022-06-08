@if ($childrens)
  	<li>
  			
  	<a  href="{{ url($childrens->href) }}" @if(!empty($childrens->target)) target={{ $childrens->target }} @endif>{{ $childrens->text }}</a>
		@if (isset($childrens->children)) 
		<ul  class="outer-footer__list-wrap">
			@foreach($childrens->children as $row)
			 @include('frontend.'.domain_info('user_id').'.saka-cart.components.footer_menu.child', ['childrens' => $row])
			@endforeach
		</ul>	
		@endif
	</li>
@endif

{{-- <div class="stars rtl-text-right" data-range={{ round($get_meat->meatsrating->avg('ratting')) }}>
    @for($i = 1; $i <= 5; $i++)
    @if($i <= round($get_meat->meatsrating->avg('ratting')))
	@php
	$checked = 'checked';
	@endphp
	@else
	@php
	$checked = '';
	@endphp
	@endif
    <input id="star{{ $i }}" class="stars_rating" name="rating" value="{{ $i }}"
     type="radio" {{ $checked }}><label for="star{{ $i }}"></label>
    @endfor
</div> --}}

<ul class="list-inline rtl-text-right" data-range="{{ round($get_meat->meatsrating->avg('ratting')) }}">
    <li class="lsit-inline-item">
        <span>{{ trans('sentence.Your Rating') }}: </span>
    </li>
	@for($i = 1; $i <= 5; $i++)
	@if($i <= round($get_meat->meatsrating->avg('ratting')))
	@php
	$color = 'rate-text-danger';
	@endphp
	@else
	@php
	$color = 'rate-text-divider';
	@endphp
    @endif
    <li class="list-inline-item h4 product-rating cursor-pointer {{ $color }}" 
    title="Rate {{ $i }} Stars"
     id="{{ json_decode($get_meat->id) }}-{{ $i }}" data-index="{{ $i }}"
      data-product_id="{{ $get_meat->id }}"
       data-rating="{{ round($get_meat->meatsrating->avg('ratting')) }}">&#9733;</li>
       @endfor
</ul>
@php
	$burgerColour = get_field('burger_menu_colour', get_the_ID());
@endphp

<svg class="burger" width="30" height="16" viewBox="0 0 32 18" fill="none" xmlns="http://www.w3.org/2000/svg">
	<path class="line" d="M1 1H31" stroke="{{ $burgerColour === 'dark' ? '#000' : '#fff' }}" stroke-width="2" stroke-linecap="round"/>
	<path class="line" d="M1 9H31" stroke="{{ $burgerColour === 'dark' ? '#000' : '#fff' }}" stroke-width="2" stroke-linecap="round"/>
	<path class="line" d="M1 17H31" stroke="{{ $burgerColour === 'dark' ? '#000' : '#fff' }}" stroke-width="2" stroke-linecap="round"/>
</svg>

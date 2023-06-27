<header class="banner">
	@php
		$site_logo = get_field('site_logo', 'options');
		$burger_menu_colour = get_field('burger_menu_colour', get_the_ID());
	@endphp
	
	@if ($site_logo)
		<a class="logo {!! $burger_menu_colour ?: $burger_menu_colour !!}" href="{{ home_url('/') }}">
			<img class="logo-img" src="{!! esc_url($site_logo['url']) !!}" alt="{!! esc_attr($site_logo['alt']) !!}" />
		</a>
	@endif

	<button type="button" class="menu-toggle">
		@include('partials.burger-icon')

		<span class="screen-reader-text">
			{{ _e('Menu', 'leveldesignltd') }}
		</span>
	</button>
	
	<nav class="nav-mobile">		
		@include('partials.nav-menu')
		<div class="blob-nav"></div>
	</nav>
</header>
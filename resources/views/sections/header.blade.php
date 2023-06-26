<header class="banner">
	@php $site_logo = get_field('site_logo', 'options') @endphp
	
	@if ($site_logo)
		<a class="logo" href="{{ home_url('/') }}">
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
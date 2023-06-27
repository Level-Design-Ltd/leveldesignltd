<footer class="footer">
	<div class="wide-container">
		<div class="half">
			@php $site_logo = get_field('site_logo', 'options') @endphp
		
			@if ($site_logo)
				<a class="footer-logo" href="{{ home_url('/') }}">
					<img class="logo-img" src="{!! esc_url($site_logo['url']) !!}" alt="{!! esc_attr($site_logo['alt']) !!}" />
				</a>
			@endif

			{!! __('© 2023 Level Design Ltd', 'leveldesignltd') !!}
		</div>
		<div class="half">
			{!! __('Privacy Policy', 'leveldesignltd') !!}
			{!! __('Terms & Conditions', 'leveldesignltd') !!}
		</div>
	</div>
</footer>

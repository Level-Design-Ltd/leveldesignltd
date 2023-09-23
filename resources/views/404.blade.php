@extends('layouts.app')

@php
	$hero_image = get_field('404_featured_image', 'options');
	$hero_heading = get_field('404_heading', 'options');
	$hero_subheading = get_field('404_subheading', 'options');
@endphp

@section('content')
	@if ($hero_image  && $hero_heading && $hero_subheading)
		<section class="wp-block-group hero-banner has-white-color has-brand-dark-background-color has-text-color has-background is-layout-constrained wp-container-4 wp-block-group-is-layout-constrained">
			<div class="wp-block-columns are-vertically-aligned-center is-layout-flex wp-container-3 wp-block-columns-is-layout-flex">
				<div class="wp-block-column is-vertically-aligned-center is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:90%">
					<h1 class="wp-block-post-title">{{ $hero_heading }}</h1>
					<p>{{ $hero_subheading }}</p>
				</div>
				<div class="wp-block-column is-vertically-aligned-center hero-blob is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:10%">
					<figure class="wp-block-image size-full"><img decoding="async" fetchpriority="high" width="2048" height="2560" src="{{ $hero_image['url'] }}" alt="{{ $hero_image['alt'] }}" srcset="{{ $hero_image['url'] }} 2048w, {{ $hero_image['url'] }} 240w" sizes="(max-width: 2048px) 100vw, 2048px"></figure>
				</div>
			</div>
		</section>
	@endif
@endsection

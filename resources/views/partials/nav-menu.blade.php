@if (has_nav_menu('primary_navigation'))
	{!! 
		wp_nav_menu([
			'theme_location' => 'primary_navigation', 
			'menu_class' => 'nav',
			'depth' => 2,
			'walker' => new App\PrimaryNavWalker()
		]) 
	!!}
@endif
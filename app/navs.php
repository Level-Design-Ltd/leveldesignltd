<?php

namespace App;

function add_menu_title( $item_output, $item, $depth, $args )
{
	global $title;
	$title = $item->post_title;
	return $item_output;
}
// add_filter( 'walker_nav_menu_start_el', 'add_menu_title', 10, 4);

class PrimaryNavWalker extends \Walker_Nav_Menu
{
	function start_el(&$output, $item, $depth = 0, $args = NULL, $id = 0)
	{
		global $wp_query;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';
		$subTitleClass = $item->menu_item_parent == 0 ? 'class="sub-menu-title"' : '';
		
		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
		
		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' ' . $subTitleClass . ' href="' . esc_attr( $item->url ) .'"' : '';

		$description = ! empty( $item->description ) ? '<span class="description">'.esc_attr( $item->description ).'</span>' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $description.$args->link_after;
		$item_output .= $args->link_before . mb_strimwidth($item->title, 0, 15, '') ;
		$item_output .= '</a>';
		$item_output .= $args->after;
		
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function start_lvl(&$output, $depth = 0, $args = array())
	{
		global $title;
		global $description;

		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class='sub-menu'>
								<a class='back' href='#'></a>
								<span>$title</span>\n";
	}

	function end_lvl(&$output, $depth = 0, $args = array())
	{
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}
}

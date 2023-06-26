<?php

/**
 * Disable Gutenberg Native Blocks
 *
 * @return string
 */
// if ( false !== strpos( $_SERVER['REQUEST_URI'], '/wp-admin/post.php' ) || false !== strpos( $_SERVER['REQUEST_URI'], '/wp-admin/post-new.php' ) ) {
// 	add_filter( 'allowed_block_types_all', function () {
// 		return array(
// 			'core/container',
// 			'core/image',
// 			'core/cover',
// 			'core/paragraph',
// 			'core/heading',
// 			'core/columns',
// 			'core/buttons',
// 			'core/spacer',
// 			'core/html',
// 			// 'gravityforms/form',
// 			'acf/test',
// 		);
// 	});
// }
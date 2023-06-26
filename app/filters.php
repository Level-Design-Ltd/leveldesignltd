<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Custom Filters
 *
 * @return void
 */
// require_once(get_template_directory() . '/app/Filters/admin-menu.php');

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'leveldesignltd'));
});

/**
 * Remove Primary Category
 *
 * @return void
 */
add_filter('wpseo_primary_term_taxonomies', '__return_empty_array');
<?php 

function acf_block_render_callback( $block ) {
 
    // convert name ("acf/testimonial") into path friendly slug ("testimonial")
    $slug = str_replace('acf/', '', $block['name']);
    
    // include a template part from within the "template-parts/blocks" folder
    if( file_exists( get_theme_file_path("/resources/views/blocks/{$slug}.php") ) ) {
        include( get_theme_file_path("/resources/views/blocks/{$slug}.php") );
    }
}
 
// Register the block with ACF
function custom_acf_init() {
 
    // check function exists
    if( function_exists('acf_register_block_type') ) {
        
        // register a testimonial block
        acf_register_block_type(array(
            'name'              => 'test',
            'title'             => __('Test'),
            'description'       => __('A custom test block.'),
            'render_callback'   => 'acf_block_render_callback',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'test', 'block' ),
        ));
    }
}
 
// Check if ACF is installed and activated
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'custom_acf_init');
}
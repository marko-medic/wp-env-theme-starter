<?php
function starter_theme_setup() {
    // Add support for title tag
    add_theme_support('title-tag');

    // Add support for post thumbnails
    add_theme_support('post-thumbnails');

    // Add support for editor styles
    add_theme_support('editor-styles');
    
    // Add support for full site editing features
    add_theme_support( 'block-templates' );
    add_theme_support( 'block-template-parts' );

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'starter-theme'),
    ));
}

add_action('init', 'starter_theme_setup');

function starter_theme_frontend_scripts() {
    // Enqueue the main stylesheet
    wp_enqueue_style( 'main-style', get_stylesheet_uri() );
    wp_enqueue_style('starter-theme-style', get_template_directory_uri() . '/build/frontend/frontend.css');

    // Load the asset file to get dependencies and version
    $asset_file = include get_template_directory() . '/build/frontend/frontend.asset.php';

    // Enqueue the block editor script
    wp_enqueue_script(
        'starter-theme-editor-script',
        get_template_directory_uri() . '/build/frontend/frontend.js', // Path to the transpiled JS file
        $asset_file['dependencies'], // Dependencies from index.asset.php
        $asset_file['version'], // Version from index.asset.php
        true // Load in footer
    );
}

add_action('wp_enqueue_scripts', 'starter_theme_frontend_scripts');

function starter_theme_block_editor_scripts() {
    // Enqueue the main stylesheet
    wp_enqueue_style('starter-theme-style', get_template_directory_uri() . '/build/block-editor/block-editor.css');

    // Load the asset file to get dependencies and version
    $asset_file = include get_template_directory() . '/build/block-editor/block-editor.asset.php';

    // Enqueue the block editor script
    wp_enqueue_script(
        'starter-theme-editor-script',
        get_template_directory_uri() . '/build/block-editor/block-editor.js', // Path to the transpiled JS file
        $asset_file['dependencies'], // Dependencies from index.asset.php
        $asset_file['version'], // Version from index.asset.php
        true // Load in footer
    );
}

add_action('enqueue_block_editor_assets', 'starter_theme_block_editor_scripts');

function disable_query_ordering( $query ) {
    if ( ! is_admin() && $query->is_main_query() ) {
        $query->set( 'orderby', 'date' );
        $query->set( 'order', 'DESC' );
        $query->set( 'posts_per_page', 15 );
    }
}
// add_action( 'pre_get_posts', 'disable_query_ordering' );



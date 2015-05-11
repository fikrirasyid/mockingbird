<?php

/**
 * Load scripts
 * 
 * @return void
 */
function mockingbird_scripts(){
	wp_enqueue_style( 'mockingbird_style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'mockingbird_scripts' );
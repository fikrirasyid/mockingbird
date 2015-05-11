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

/**
 * Modify excerpts' hellips
 * 
 * @param string
 * @return string
 */
function mockingbird_excerpt_more( $excerpt ){
	global $post;

	if( ! isset( $post->ID) )
		return;
	
	$more_url 		= esc_url( get_permalink( $post->ID ) );
	$more_title 	= sprintf( __( 'Permanent link to %s', 'mockingbird' ), esc_attr( $post->post_title ) );
	$more_copy 		= __( 'Continue Reading', 'mockingbird' );

	return "&hellip; </p><p><a href='{$more_url}' title='{$more_title}' class='more-link'>{$more_copy} &rarr;</a>";
}
add_filter( 'excerpt_more', 'mockingbird_excerpt_more' );
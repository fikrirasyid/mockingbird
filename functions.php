<?php

/**
 * Theme setup
 * 
 * @return void
 */
function mockingbird_setup(){
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );	

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );	
}
add_action( 'after_setup_theme', 'mockingbird_setup' );

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
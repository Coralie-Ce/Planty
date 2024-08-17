<?php

add_action('wp_enqueue_scripts','theme_enqueue_style');
function theme_enqueue_style()
{
   // wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
   // wp_enqueue_style('enfant-style', get_stylesheet_directory_uri() . '/css/theme.css', 'oceanwp-style', 
  //  filemtime(get_stylesheet_directory() . '/css/theme.css'));
}
//add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
// function my_theme_enqueue_styles() {
//     $parenthandle = 'oceanwp-style'; // This is 'twenty-twenty-one-style' for the Twenty Twenty-one theme.
//     $theme = wp_get_theme();
//     wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css', 
//         array(), // if the parent theme code has a dependency, copy it to here
//         $theme->parent()->get('Version')
//     );
//     wp_enqueue_style( 'custom-style', get_stylesheet_uri(),
//         array( $parenthandle ),
//         $theme->get('Version') // this only works if you have Version in the style header
//     );
//     wp_enqueue_style('enfant-style', get_stylesheet_directory_uri() . '/css/theme.css', 'oceanwp-style', 
//     filemtime(get_stylesheet_directory() . '/css/theme.css'));
// }

function oceanwp_child_enqueue_parent_style() {

	// Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update the theme).
	$theme   = wp_get_theme( 'OceanWP' );
	$version = $theme->get( 'Version' );

	// Load the stylesheet.
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/css/theme.css', array( 'oceanwp-style' ), $version );
	
}

add_action( 'wp_enqueue_scripts', 'oceanwp_child_enqueue_parent_style' );

function register_custom_menu(){
    register_nav_menu('header', 'En tête du menu');
}

function menu_admin($items, $args){
	/*if (is_user_logged_in() && ($args->theme_location == 'mobile_menu' || $args->theme_location == 'main_menu')){*/


		if (is_user_logged_in() && in_array($args->theme_location, ['mobile_menu','main_menu'])){
	/*if (is_user_logged_in() && $args->theme_location == 'main_menu'){*/
		$items .='<li><a href="' . admin_url() .'">Admin</a></li>';
	}
	return $items;
}
add_filter('wp_nav_menu_items', 'menu_admin', 10, 2);
?> 
<?php

// Add custom Theme Functions here

//Add js 

function wp_include_js()

{

wp_enqueue_script('main-js', get_theme_root_uri().'/flatsome-child/main.js', array(), false, true);

wp_enqueue_script('hieu-js', get_theme_root_uri().'/flatsome-child/hieu.js', array(), false, true);


}



add_action('wp_enqueue_scripts', 'wp_include_js');

//Add font awesome

function wp_include_css()

{

wp_enqueue_style('awesome-style', get_theme_root_uri().'/flatsome-child/hieu.css', array(), false, 'all');

}



add_action('wp_enqueue_scripts', 'wp_include_css');



//add fontawmsome

wp_register_style( 'Font_Awesome', 'https://use.fontawesome.com/releases/v5.14.0/css/all.css' );

wp_enqueue_style('Font_Awesome');






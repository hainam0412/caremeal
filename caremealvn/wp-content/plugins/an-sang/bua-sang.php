<?php

/**

 * Plugin Name: Món ăn

 * Plugin URI: https://fti-fpt.com

 * Description: Đây là plugin nhập món ăn, Nhìn ngon vãi

 * Version: 1.0

 * Author: Ba Vu

 * Author URI: https://www.facebook.com/vu.ba1

 * License: GPLv2

 */

define( 'BUA_SANG_PATH', plugin_dir_path( __FILE__ ) );

define( 'BUA_SANG_URL', plugin_dir_url( __FILE__ ) );

require_once 'inc/admin-dashboard/ql-bua-sang.php';

require_once 'inc/admin-dashboard/nhap-bua-sang.php';

require_once 'inc/admin-dashboard/nhap-thuc-don.php';

require_once 'inc/admin-dashboard/thucdon.php';

function plugin_bua_sang() {

    require_once 'inc/functions/create-database.php';

}

register_activation_hook( __FILE__, 'plugin_bua_sang' );

// Add css to admin WordPress

function bua_sang_custom_css() {

    wp_enqueue_style( 'bua_sang_custom_css', BUA_SANG_URL .'inc/css/admin-custombs.css');

    wp_enqueue_script('hieu-js',  BUA_SANG_URL .'inc/css/moment.min.js');

}

add_action( 'admin_enqueue_scripts', 'bua_sang_custom_css' );
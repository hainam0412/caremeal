<?php
/**
 * Plugin Name: Nguyên liệu
 * Plugin URI: https://fti-fpt.com
 * Description: Đây là plugin nhập nguyên liệu
 * Version: 1.0
 * Author: Ba Vu
 * Author URI: https://www.facebook.com/vu.ba1
 * License: GPLv2
 */
define( 'NGUYEN_LIEU_PATH', plugin_dir_path( __FILE__ ) );
define( 'NGUYEN_LIEU_URL', plugin_dir_url( __FILE__ ) );
require_once 'inc/admin-dashboard/quan-ly-nguyen-lieu.php';
require_once 'inc/admin-dashboard/nhap-nguyen-lieu.php';
function plugin_nguyen_lieu() {
    require_once 'inc/functions/create-database.php';
}
register_activation_hook( __FILE__, 'plugin_nguyen_lieu' );
// Add css to admin WordPress
function admin_custom_cssnl() {
    wp_enqueue_style( 'admin_custom_cssnl', NGUYEN_LIEU_URL .'inc/css/admin-custom.css');
}
add_action( 'admin_enqueue_scripts', 'admin_custom_cssnl' );
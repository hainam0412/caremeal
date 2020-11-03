<?php

/**

 * Plugin Name: Nhu cầu năng lượng

 * Plugin URI: https://fti-fpt.com

 * Description: Nhầu cầu năng lượng khuyến nghị cho người Việt Nam

 * Version: 1.0

 * Author: Ba Vu

 * Author URI: https://www.facebook.com/vu.ba1

 * License: GPLv2

 */

define( 'NANG_LUONG_PATH', plugin_dir_path( __FILE__ ) );

define( 'NANG_LUONG_URL', plugin_dir_url( __FILE__ ) );

require_once 'inc/admin-dashboard/ql-nang-luong.php';

require_once 'inc/admin-dashboard/nhap-nang-luong.php';

require_once 'inc/shortcode.php';

require_once 'inc/shortcodehome.php';

require_once 'inc/shortcodethucdon.php';

require_once 'inc/shortcodethongke.php';

function plugin_nang_luong() {

    require_once 'inc/functions/create-database.php';

}

register_activation_hook( __FILE__, 'plugin_nang_luong' );

// Add css to admin WordPress

function nang_luong_custom_css() {

    wp_enqueue_style( 'nang_luong_custom_css', NANG_LUONG_URL .'inc/css/admin-customnl.css');

}

add_action( 'admin_enqueue_scripts', 'nang_luong_custom_css' );
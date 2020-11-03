<?php
//--------------------------------------------------------------------------
//Mô tả plugin
//▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
/**
 * Plugin Name: Care Meal
 * Plugin URI: https://caremeal.vn/
 * Description: Plugin quản lý dinh dưỡng cho học sinh
 * Version: 1.0
 * Author: Nhóm Care Meal
 * Author URI: https://caremeal.vn/
 * License: GPLv2
 */

//--------------------------------------------------------------------------
//Khởi tạo đường dẫn đến thư mục plugin
//▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
define( 'CARE_MEAL_PATH', plugin_dir_path( __FILE__ ) );
define( 'CARE_MEAL_URL', plugin_dir_url( __FILE__ ) );

//--------------------------------------------------------------------------
//Thêm các file php
//▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
require_once 'functions/functions.php';

//--------------------------------------------------------------------------
//Khởi tạo DB
//▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function plugin_care_meal() {
  require_once 'functions/create-database.php';
}
register_activation_hook( __FILE__, 'plugin_care_meal' );



<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );
if (!empty($_POST['ngay'])) {
	global $wpdb;
    $list_thuc_don = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'thuc_don WHERE td_ngay = "'.$_POST['ngay'].'"' );
    if (!empty($list_thuc_don)) {
        echo json_encode($list_thuc_don);
    } else {
    	echo 0;
    }
}else{
	echo 0;
}
die();
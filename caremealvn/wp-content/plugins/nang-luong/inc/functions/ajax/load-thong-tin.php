<?php 

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );

require_once( $parse_uri[0] . 'wp-load.php' );

if (!empty($_POST['tuoi']) && !empty($_POST['nc_gt']) ) {

	global $wpdb;

    $list_nang_luong = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'nang_luong WHERE nc_tuoi = "'.$_POST['tuoi'].'" AND nc_gt = "'.$_POST['nc_gt'].'"' );

    if (!empty($list_nang_luong)) {

        echo json_encode($list_nang_luong);

    } else {

    	echo 0;

    }

}else {

	echo 0;

}

die();
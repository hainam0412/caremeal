<?php 

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );

require_once( $parse_uri[0] . 'wp-load.php' );

if (!empty($_POST['nangluong']) && !empty($_POST['nhom'])) {

	global $wpdb;

     $list_nguyen_lieu = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'nguyen_lieu WHERE nl_nang_luong_kcal < "'.$_POST['nangluong'].'" AND nl_nhom =  "'.$_POST['nhom'].'"' );

    if (!empty($list_nguyen_lieu)) {

        echo json_encode($list_nguyen_lieu);

    } else {

    	echo 0;

    }

}else {

	echo 01;

}

die();
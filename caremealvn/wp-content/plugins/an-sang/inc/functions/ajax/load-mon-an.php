<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );
if (!empty($_POST['sang'])) {
	global $wpdb;
    $list_mon_an = $wpdb->get_results( 'SELECT bs_ten, bs_e, bs_b, bs_l, bs_g, bs_fe, bs_zn, bs_xo, bs_ca, bs_na, bs_cho FROM '.$wpdb->prefix.'bua_sang WHERE bs_ten = "'.$_POST['sang'].'"' );
    if (!empty($list_mon_an)) {
        echo json_encode($list_mon_an);
    } else {
    	echo 0;
    }
}else {
	echo 0;
}
die();
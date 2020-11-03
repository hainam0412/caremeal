<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );
if (!empty($_POST['tuoi'])) {
	global $wpdb;
    $list_nang_luong = $wpdb->get_results( 'SELECT nc_nl, nc_gt, nc_protid, nc_ca, nc_sat, nc_vtm_a, nc_vtm_b1, nc_vtm_b2, nc_vtm_pp, nc_vtm_c FROM '.$wpdb->prefix.'nang_luong WHERE nc_tuoi = "'.$_POST['tuoi'].'"' );
    if (!empty($list_nang_luong)) {
        echo json_encode($list_nang_luong);
    } else {
    	echo 0;
    }
}else {
	echo 0;
}
die();

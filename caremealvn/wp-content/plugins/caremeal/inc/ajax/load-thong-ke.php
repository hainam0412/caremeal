<?php 
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );
if (!empty($_POST['thang'])) {
	global $wpdb;
    $thong_ke = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'thong_ke WHERE thang = "'.$_POST['thang'].'"' );
    if (!empty($thong_ke)) {
        echo json_encode($thong_ke);
    } else {
    	echo 0;
    }
}else {
	echo 0;
}
die();
<?php
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
global $wpdb;
$sql = 'CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'nang_luong (
    id bigint(20) not null auto_increment,
    nc_tuoi varchar(200),
    nc_tuoi_min varchar(20),
    nc_tuoi_max varchar(20),
    nc_nl varchar(20),
    nc_gt varchar(20),
    nc_protid varchar(20),
    nc_ca varchar(20),
    nc_sat varchar(20),
    nc_vtm_a varchar(20),
    nc_vtm_b1 varchar(20),
    nc_vtm_b2 varchar(20),
    nc_vtm_pp varchar(20),
    nc_vtm_c varchar(20),
    primary key (id)
) default character set utf8mb4 collate utf8mb4_unicode_ci;
';
dbDelta( $sql );
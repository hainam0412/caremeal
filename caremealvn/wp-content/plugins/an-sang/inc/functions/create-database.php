<?php
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
global $wpdb;
$sql = 'CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'bua_sang (
    id bigint(20) not null auto_increment,
    bs_ten varchar(20) UNIQUE,
    bs_nl1 varchar(250),
    bs_nl2 varchar(250),
    bs_nl3 varchar(250),
    bs_nl4 varchar(250),
    bs_nl5 varchar(250),
    bs_nl6 varchar(250),
    bs_nl7 varchar(250),
    bs_nl8 varchar(250),
    bs_nl9 varchar(250),
    bs_nl10 varchar(250),
    bs_e varchar(20),
    bs_p varchar(20),
    bs_l varchar(20),
    bs_g varchar(20),
    bs_fe varchar(20),
    bs_zn varchar(20),
    bs_xo varchar(20),
    bs_ca varchar(20),
    bs_na varchar(20),
    bs_cho varchar(20),
    bs_f1 int(20), 
    bs_f2 int(20), 
    bs_f3 int(20), 
    bs_f4 int(20), 
    bs_f5 int(20), 
    bs_f6 int(20), 
    bs_f7 int(20), 
    bs_f8 int(20), 
    bs_f9 int(20), 
    bs_f10 int(20),
    primary key (id)
) default character set utf8mb4 collate utf8mb4_unicode_ci;
';
dbDelta( $sql );
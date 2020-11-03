<?php
/*
 Template Name: Chi tiết nguyên liệu
 */
?>
<?php get_header(); ?>
<?php 
if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
	$pageURL = "https://";
} else {
	$pageURL = 'http://';
}
$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
global $wpdb;
$results = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'cm_nguyen_lieu WHERE url = "'.$pageURL.'"' ); ?>
<img src="<?php echo getCurURL(); echo $results[0]->anh_if; ?>">
<div class="vb-download">
	<a href="<?php echo getCurURL(); echo $results[0]->anh_if; ?>" download>Tải xuống</a>
</div>
<?php get_footer(); ?>
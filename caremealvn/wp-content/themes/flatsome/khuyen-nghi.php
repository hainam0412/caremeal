<?php
/*
 Template Name: khuyến nghị
 */
?>
<?php get_header(); ?>
<?php
	global $wpdb;
	$list_monan = $wpdb->get_results( 'SELECT bs_ten FROM '.$wpdb->prefix.'bua_sang WHERE bs_ten != "" AND bs_ten IS NOT NULL GROUP BY bs_ten ORDER BY bs_ten ASC' );
	$table_monan = $wpdb->prefix.'bua_sang';
	$results_monan = $wpdb->get_results( 'SELECT * FROM '.$table_monan);
	$table_nangluong = $wpdb->prefix.'nang_luong';
	$results_nangluong = $wpdb->get_results( 'SELECT * FROM '.$table_nangluong);
	$table_nguyenlieu = $wpdb->prefix.'nguyen_lieu';
	$results_nguyen_lieu = $wpdb->get_results( 'SELECT * FROM '.$table_nguyenlieu );
	
	
	$vbtuoi=$_POST['xd_tuoi'];
	if(strpos($vbtuoi, 'thang')||strpos($vbtuoi, 'tháng')){
	    $vbtuoi=preg_replace('/[^0-9]/', '', $vbtuoi);
	    $vbtuoi=(float)$vbtuoi;
	    $vbtuoi=$vbtuoi/12;
	}
	$vbgioitinh=$_POST['xd_gioitinh'];
	$vblaodong=$_POST['xd_laodong'];
?>
<div class="vb-main container">
    <div class="vb-kpa-header"><h1>Xây Dựng Khẩu Phần Ăn</h1></div>
    <div class="vb-tt">
        <h2>Thông ti cơ bản</h2>
        <p><span>Tuổi: </span><?php echo $_POST['xd_tuoi']; ?></p>
        <?php 
            if($_POST['xd_gioitinh'] !="0"){
                if($_POST['xd_gioitinh']=="nam"){
                    $vbgt="Nam";
                } else{
                     $vbgt="Nữ";
                }
                echo "<p><span>Giới tính: </span>".$vbgt."</p>";
            } 
             if($_POST['xd_laodong'] != "khong"){
                 if($_POST['xd_laodong']=="nang"){
                    $vbld="Nặng";
                } else if($_POST['xd_laodong']=="vua"){
                     $vbld="Vừa";
                }else {
                     $vbld="Nhẹ";
                }
                echo "<p><span>Loại lao động: </span>".$vbld."</p>";
            } 
        ?>
    </div>
    <div class="vb-tt">
        <h2>Mức dinh dưỡng khuyến nghị</h2>
        <p>Năng lượng</p>
    </div>    
</div>
<?php get_footer(); ?>
<?php
/*
 Template Name: Chi tiết món ăn
 */
?>
<?php get_header(); ?>
<?php 
    function unicode_converta($str){
 if(!$str) return false;
 $unicode = array(
  'a'=>array('á','à','ả','ã','ạ','à','ă','ắ','ặ','ằ','ẳ','ẵ','â','ấ','ầ','ẩ','ẫ','ậ','Á','À','Ả','á','Ã','Ạ','Ă','Ắ','Ặ','Ằ','Ẳ','Ẵ','Â','Ấ','Ầ','Ẩ','Ẫ','Ậ','ạ'),
  'd'=>array('đ','Đ'),
  'e'=>array('é','è','ẻ','ẽ','ẹ','é','ê','ế','ề','ể','ễ','ệ','É','È','Ẻ','Ẽ','Ẹ','Ê','Ế','Ề','é','Ể','Ễ','Ệ','ẻ'),
  'i'=>array('í','ì','ỉ','ĩ','ị','Í','Ì','Ỉ','Ĩ','Ị'),
  'o'=>array('ơ','ó','ò','ỏ','õ','ọ','ô','ố','ở','ồ','ổ','ỗ','ộ','õ','ớ','ờ','ở','ỡ','ợ','Ó','Ò','Ỏ','Õ','Ọ','Ô','Ố','Ồ','Ổ','Ỗ','Ộ','Õ','Ơ','Ớ','Ờ','ợ','Ở','Ỡ','Ợ'),
  'u'=>array('ú','ư','Ư','ù','ủ','ũ','ụ','ý','ú','ứ','ừ','ử','ữ','ự','Ú','Ù','Ủ','Ũ','Ụ','Ý','Ứ','Ừ','Ử','Ữ','Ự','ứ'),
  'y'=>array('ý','ỳ','ỷ','ỹ','ỵ','Ý','Ỳ','Ỷ','ỳ','Ỹ','Ỵ'),
 );
 foreach($unicode as $nonUnicode=>$uni){
  foreach($uni as $value)
   $str = str_replace($value,$nonUnicode,$str);
 }
 return $str;
}
    global $wpdb;
    $table_name = $wpdb->prefix.'bua_sang';
     $results = $wpdb->get_results( 'SELECT * FROM '.$table_name);
     $vbnlink = $_SERVER["QUERY_STRING"];
 
     foreach ($results as $result) { 
         $bs_ten=array(str_replace(' ','-',unicode_converta(strtolower($result->bs_ten))),$result->bs_ten);
        
         if($bs_ten[0]==$vbnlink){
            // $nl_anh='https://'.strstr($nl_ten[2],'caremea');
              echo $bs_ten[1];
             ?>


             <?php
         }
     }
?>

<?php get_footer(); ?>
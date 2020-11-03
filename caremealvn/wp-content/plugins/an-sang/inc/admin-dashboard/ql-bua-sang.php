<?php
// Hook for adding admin menus
add_action('admin_menu', 'bua_sang_add_pages');
// action function for above hook
function bua_sang_add_pages() {
    // Add a new top-level menu (ill-advised):
    add_menu_page( __('Món ăn','theme-wp'), __('Món ăn','theme-wp'), 'manage_options', 'bua_sang','bua_sang','dashicons-food', 5 );
}
function getCurURLma()
{
    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
        $pageURL = "https://";
    } else {
      $pageURL = 'http://';
    }
   
        $pageURL .= $_SERVER["SERVER_NAME"] ;
    
    return $pageURL;
}
 function unicode_convertma($str){
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
function bua_sang(){
    if (!empty($_GET['edit_bua_sang'])) {
        require_once 'edit-bua-sang.php';
    } else {
        global $wpdb;
        $table_name = $wpdb->prefix.'bua_sang';
        if (!empty($_GET['delete_id'])) {
            $xoa = $wpdb->delete( $table_name, array( 'id' => $_GET['delete_id'] ), array( '%d' ) );
        }
        $where = $search = '';
        if (!empty($_REQUEST['xoa_bua_sang'])) {
            $xoa = $wpdb->query('DELETE FROM '.$wpdb->prefix.'bua_sang WHERE id IN('.implode(',', $_REQUEST['xoa_bua_sang']).')');
        } else {
            if (!empty($_REQUEST['search'])) {
                $where .= ' WHERE bs_ten LIKE "%'.$_REQUEST['search'].'%"';
                $search .= '&search='.$_REQUEST['search'];
            }
        }
        $count = $wpdb->get_var( 'SELECT COUNT(id) AS dem FROM '.$table_name.$where );
        $ppage = 100;
        if ($count > $ppage) {
            $maxpage = ceil($count/$ppage);
            if(isset($_REQUEST['paged'])){
                $trang = $_REQUEST['paged'];
                if($trang > $maxpage) $trang = $maxpage;
            }else{
                $trang = 1;
            }
            $dau = ($trang-1)*$ppage;
            $results = $wpdb->get_results( 'SELECT * FROM '.$table_name.$where.' ORDER BY id DESC LIMIT '.$dau.', '.$ppage );
        } else {
            $results = $wpdb->get_results( 'SELECT * FROM '.$table_name.$where.' ORDER BY id DESC' );
        }
        ?>
        <div class="wrap">
            <form method="GET" class="form-horizontal" role="form" action="">
                <input type="hidden" name="page" value="bua_sang">
                <h1 class="wp-heading-inline">Món ăn</h1>
                <a class="page-title-action" href="<?php echo get_admin_url().'admin.php?page=nhap_bua_sang'; ?>">Thêm bữa sáng</a>
                <?php if (!empty($xoa)): ?>
                    <div class="updated notice is-dismissible"> 
                        <p><strong>Đã xoá thành công.</strong></p>
                    </div>
                <?php endif ?>
                <h2>Có tất cả <?php echo $count; ?> món ăn <?php echo (!empty($_REQUEST['search'])) ? 'khớp với từ khóa "'.$_REQUEST['search'].'"' : ''; ?></h2>
                <h2>Tìm kiếm</h2>
                <table>
                    <tr>
                        <td>
                            <input type="text" name="search" placeholder="Tìm theo tên bữa sáng" style="width: 200px">
                        </td>
                        <td><input type="submit" name="xem" value="Tìm kiếm" class="button button-primary"></td>
                        <td><input type="submit" name="xoa" value="Xoá món ăn đã chọn" class="button button-primary"></td></td>
                    </tr>
                </table><br>
                <?php if ($count > $ppage): ?>
                    <div class="tablenav">
                        <div class="tablenav-pages"><span class="displaying-num"><?php echo $count; ?> Món ăn</span>
                            <span class="pagination-links">
                                <?php if ($trang == 1): ?>
                                    <span class="tablenav-pages-navspan" aria-hidden="true">«</span>
                                    <span class="tablenav-pages-navspan" aria-hidden="true">‹</span>
                                <?php else: ?>
                                    <a class="first-page" href="<?php echo get_admin_url().'admin.php?page=bua_sang'.$search; ?>"><span class="screen-reader-text">Trang Tĩnh Đầu Tiên</span><span aria-hidden="true">«</span></a> 
                                    <a class="prev-page" href="<?php echo get_admin_url().'admin.php?page=bua_sang&paged='.($trang-1).$search; ?>"><span class="screen-reader-text">Trang trước</span><span aria-hidden="true">‹</span></a>
                                <?php endif ?>
                                <span class="paging-input"><input class="current-page" id="current-page-selector" type="text" name="paged" value="<?php echo $trang; ?>" size="4" aria-describedby="table-paging"><span class="tablenav-paging-text"> trên <span class="total-pages"><?php echo $maxpage; ?></span></span></span>
                                <?php if ($trang == $maxpage): ?>
                                    <span class="tablenav-pages-navspan" aria-hidden="true">›</span>
                                    <span class="tablenav-pages-navspan" aria-hidden="true">»</span>
                                <?php else: ?>
                                    <a class="next-page" href="<?php echo get_admin_url().'admin.php?page=bua_sang&paged='.($trang+1).$search; ?>"><span class="screen-reader-text">Trang sau</span><span aria-hidden="true">›</span></a>
                                    <a class="last-page" href="<?php echo get_admin_url().'admin.php?page=bua_sang&paged='.($maxpage).$search; ?>"><span class="screen-reader-text">Trang cuối</span><span aria-hidden="true">»</span></a>
                                <?php endif ?>
                            </span>
                        </div>
                        <br class="clear">
                    </div>
                <?php endif ?>
                <?php if ($count > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 20px"><input type="checkbox" name="xoa_all" value="ok"></th>
                                    <th style="width: 24px;">STT</th>
                                    <th>Tên món ăn</th>
                                    <th>Quản trị</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = (!empty($dau)) ? ($dau+1) : 1;
                                foreach ($results as $result) { ?>
                                    <tr>
                                        <td>
                                            <input class="input_xoa_bua_sang" type="checkbox" name="xoa_bua_sang[]" value="<?php echo $result->id ?>">
                                        </td>
                                        <td><?php echo $i;?></td>
                                        <td>
                                            <?php
                                            
                                            $vblinkup=getCurURLma().'/mon-an/?'.str_replace(' ','-',unicode_convertma(strtolower($result->bs_ten)));
                                            $datav= array(
                                                'bs_link' => $vblinkup
                                                );
                                                $idv=$result->id;
                                           $update = $wpdb->update(
                                            $table_name,
                                            $datav,
                                            array('id' => $idv)
                                             ); 
                                            ?>
                                            <a href="<?php echo getCurURLma().'/mon-an/?'.str_replace(' ','-',unicode_convertma(strtolower($result->bs_ten))); ?>"><?php echo $result->bs_ten; ?></a>
                                        </td>
                                        <td>
                                             <a href="<?php echo getCurURLma().'/mon-an/?'.str_replace(' ','-',unicode_convertma(strtolower($result->bs_ten))); ?>" class="button button-primary">Xem</a>
                                            <a href="<?php echo get_admin_url().'admin.php?page=bua_sang&edit_bua_sang='.$result->id; ?>" class="button button-primary">Sửa</a>
                                            <a href="<?php echo get_admin_url().'admin.php?page=bua_sang&delete_id='.$result->id; ?>" class="button button-primary" onclick="return confirm('Bạn có chắc chắn muốn xoá bữa sáng này không?');">Xoá</a>
                                        </td>
                                    </tr>
                                <?php 
                                $i++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <script type="text/javascript">
                        jQuery(document).ready(function() {
                            jQuery('input[name="xoa_all"]').change(function() {
                                if (jQuery(this).prop('checked') == true) {
                                    jQuery('.input_xoa_bua_sang').prop('checked', true);
                                } else {
                                    jQuery('.input_xoa_bua_sang').prop('checked', false);
                                }
                            });
                        });
                    </script>
                <?php else: ?>
                   <h3>Không tìm thấy bữa sáng nào.</h3>
                <?php endif ?>
            </form>
        </div>
    <?php }
}
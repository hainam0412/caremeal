<?php
// Hook for adding admin menus
add_action('admin_menu', 'nang_luong_add_pages');
// action function for above hook
function nang_luong_add_pages() {
    // Add a new top-level menu (ill-advised):
    add_menu_page( __('Nhu cầu năng lượng','theme-wp'), __('Nhu cầu năng lượng','theme-wp'), 'manage_options', 'nang_luong','nang_luong','dashicons-chart-pie', 5 );
}
function nang_luong(){
    if (!empty($_GET['edit_nang_luong'])) {
        require_once 'edit-nang-luong.php';
    } else {
        global $wpdb;
        $table_name = $wpdb->prefix.'nang_luong';
        if (!empty($_GET['delete_id'])) {
            $xoa = $wpdb->delete( $table_name, array( 'id' => $_GET['delete_id'] ), array( '%d' ) );
        }
        $where = $search = '';
        if (!empty($_REQUEST['xoa_nang_luong'])) {
            $xoa = $wpdb->query('DELETE FROM '.$wpdb->prefix.'nang_luong WHERE id IN('.implode(',', $_REQUEST['xoa_nang_luong']).')');
        } else {
            if (!empty($_REQUEST['search'])) {
                $where .= ' WHERE nc_tuoi LIKE "%'.$_REQUEST['search'].'%"';
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
                <input type="hidden" name="page" value="nang_luong">
                <h1 class="wp-heading-inline">Năng lượng khuyến nghị</h1>
                <a class="page-title-action" href="<?php echo get_admin_url().'admin.php?page=nhap_nang_luong'; ?>">Thêm</a>
                <?php if (!empty($xoa)): ?>
                    <div class="updated notice is-dismissible"> 
                        <p><strong>Đã xoá thành công.</strong></p>
                    </div>
                <?php endif ?>
                <h2>Có tất cả <?php echo $count; ?> Bản ghi <?php echo (!empty($_REQUEST['search'])) ? 'khớp với từ khóa "'.$_REQUEST['search'].'"' : ''; ?></h2>
                <h2>Tìm kiếm</h2>
                <table>
                    <tr>
                        <td>
                            <input type="text" name="search" placeholder="Tìm theo độ tuổi" style="width: 200px">
                        </td>
                        <td><input type="submit" name="xem" value="Tìm kiếm" class="button button-primary"></td>
                        <td><input type="submit" name="xoa" value="Xoá mục đã chọn" class="button button-primary"></td></td>
                    </tr>
                </table><br>
                <?php if ($count > $ppage): ?>
                    <div class="tablenav">
                        <div class="tablenav-pages"><span class="displaying-num"><?php echo $count; ?> bản ghi</span>
                            <span class="pagination-links">
                                <?php if ($trang == 1): ?>
                                    <span class="tablenav-pages-navspan" aria-hidden="true">«</span>
                                    <span class="tablenav-pages-navspan" aria-hidden="true">‹</span>
                                <?php else: ?>
                                    <a class="first-page" href="<?php echo get_admin_url().'admin.php?page=nang_luong'.$search; ?>"><span class="screen-reader-text">Trang Tĩnh Đầu Tiên</span><span aria-hidden="true">«</span></a> 
                                    <a class="prev-page" href="<?php echo get_admin_url().'admin.php?page=nang_luong&paged='.($trang-1).$search; ?>"><span class="screen-reader-text">Trang trước</span><span aria-hidden="true">‹</span></a>
                                <?php endif ?>
                                <span class="paging-input"><input class="current-page" id="current-page-selector" type="text" name="paged" value="<?php echo $trang; ?>" size="4" aria-describedby="table-paging"><span class="tablenav-paging-text"> trên <span class="total-pages"><?php echo $maxpage; ?></span></span></span>
                                <?php if ($trang == $maxpage): ?>
                                    <span class="tablenav-pages-navspan" aria-hidden="true">›</span>
                                    <span class="tablenav-pages-navspan" aria-hidden="true">»</span>
                                <?php else: ?>
                                    <a class="next-page" href="<?php echo get_admin_url().'admin.php?page=nang_luong&paged='.($trang+1).$search; ?>"><span class="screen-reader-text">Trang sau</span><span aria-hidden="true">›</span></a>
                                    <a class="last-page" href="<?php echo get_admin_url().'admin.php?page=nang_luong&paged='.($maxpage).$search; ?>"><span class="screen-reader-text">Trang cuối</span><span aria-hidden="true">»</span></a>
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
                                    <th>Độ tuổi</th>
                                    <th>Quản trị</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = (!empty($dau)) ? ($dau+1) : 1;
                                foreach ($results as $result) { ?>
                                    <tr>
                                        <td>
                                            <input class="input_xoa_nang_luong" type="checkbox" name="xoa_nang_luong[]" value="<?php echo $result->id ?>">
                                        </td>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $result->nc_tuoi; ?> (<?php echo $result->nc_gt; ?>)</td>
                                        <td>
                                            <a href="<?php echo get_admin_url().'admin.php?page=nang_luong&edit_nang_luong='.$result->id; ?>" class="button button-primary">Sửa</a> 
                                            <a href="<?php echo get_admin_url().'admin.php?page=nang_luong&delete_id='.$result->id; ?>" class="button button-primary" onclick="return confirm('Bạn có chắc chắn muốn xoá nội dung này không?');">Xoá</a>
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
                                    jQuery('.input_xoa_nang_luong').prop('checked', true);
                                } else {
                                    jQuery('.input_xoa_nang_luong').prop('checked', false);
                                }
                            });
                        });
                    </script>
                <?php else: ?>
                   <h3>Không tìm thấy nội dung nào.</h3>
                <?php endif ?>
            </form>
        </div>
    <?php }
}
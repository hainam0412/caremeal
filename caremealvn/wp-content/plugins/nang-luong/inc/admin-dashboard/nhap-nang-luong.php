<?php

// Hook for adding admin menus

add_action('admin_menu', 'nhap_nang_luong_add_pages');

// action function for above hook

function nhap_nang_luong_add_pages() {

    add_submenu_page(

        'Thêm',

        __( 'Thêm', 'theme-wp' ),

        __( 'Thêm', 'theme-wp' ),

        'manage_options',

        'nhap_nang_luong',

        'nhap_nang_luong'

    );

}

function nhap_nang_luong(){ 

  ob_start();

  global $wpdb;

  ?>



    <div class="wrap">

    <form method="POST" class="form-horizontal" role="form" action="" enctype="multipart/form-data">

      <h1>Nhập thông tin</h1>

      <?php if (!empty($_POST['save'])):

        if (!empty($_POST['nc_tuoi_min'])) {

          global $wpdb;

          $insert = $wpdb->insert( 

            $wpdb->prefix.'nang_luong', 

            array( 

              'nc_tuoi_min' => $_POST['nc_tuoi_min'],

              'nc_tuoi_max' => $_POST['nc_tuoi_max'],

              'nc_gt' => $_POST['nc_gt'],

              'nc_nl' => $_POST['nc_nl'], 

              'nc_protid' => $_POST['nc_protid'],  

              'nc_glucid' => $_POST['nc_glucid'], 

              'nc_lipid' => $_POST['nc_lipid'],     

              'nc_ca' => $_POST['nc_ca'],

              'nc_sat' => $_POST['nc_sat'],

              'nc_vtm_a' => $_POST['nc_vtm_a'],

              'nc_vtm_b1' => $_POST['nc_vtm_b1'],

              'nc_vtm_b2' => $_POST['nc_vtm_b2'],

              'nc_vtm_pp' => $_POST['nc_vtm_pp'],

              'nc_vtm_c' => $_POST['nc_vtm_c'],

            ), 

            '%s'

          );

        }  else {

          $error = 'Không đủ dữ liệu';

        }

        if (!empty($insert)): ?>

          <div class="updated notice is-dismissible"> 

            <p><strong>Thêm thông tin thành công.</strong></p>

          </div>

        <?php elseif (!empty($error)): ?>

          <div class="error notice is-dismissible"> 

            <p><strong><?php echo $error; ?></strong></p>

          </div>

        <?php else: ?>

          <div class="error notice is-dismissible"> 

            <p><strong>Thêm thông tin thất bại. Độ tuổi đã tồn tại</strong></p>

          </div>

        <?php endif;

      endif; ?>

      <table class="vb-nhap-nl">

        <tr class="vb-header">

          <td><b>Độ tuổi:</b></td>

          <td style="display:none"><input type="text" name="nc_tuoi" style="width: 100%"></td>

          <td>Từ: <input type="text" name="nc_tuoi_min" style="width: 100%"> Đến:  <input type="text" name="nc_tuoi_max" style="width: 100%"></td>

          <td><b>Giới tính: </b></td>

          <td style="display: none"><input type="text" name="nc_gt" style="width: 100%" value="0"></td>

          <td class="vb-gioitinh">

            <input type="radio" name="nc_gtr" value="nam" style="width: 100%"> Nam

            <input type="radio" name="nc_gtr" value="nu" style="width: 100%"> Nữ

          </td>

        </tr>

        <tr class="vb-header">

        

        </tr>

        <tr class="vb-header">

          <td><b>Năng lượng khuyến nghị: </b></td>

          <td><input type="text" name="nc_nl" style="width: 100%"></td>

          <td><b>Protetin: </b></td>

          <td><input type="text" name="nc_protid" style="width: 100%"></td>

          <td><b>glucid: </b></td>

          <td><input type="text" name="nc_glucid" style="width: 100%"></td>

          <td><b>Lipid: </b></td>

          <td><input type="text" name="nc_lipid" style="width: 100%"></td>


        </tr>

    

        <tr class="vb-header">
           <td><b>Canxi: </b></td>

          <td><input type="text" name="nc_ca" style="width: 100%"></td>

          <td><b>Sắt: </b></td>

          <td><input type="text" name="nc_sat" style="width: 100%"></td>

          <td><b>Vitamin A: </b></td>

          <td><input type="text" name="nc_vtm_a" style="width: 100%"></td>

          <td><b>Vitamin B1: </b></td>

          <td><input type="text" name="nc_vtm_b1" style="width: 100%"></td>

        </tr>

        

        <tr class="vb-header">

          <td><b>Vitamin B2: </b></td>

          <td><input type="text" name="nc_vtm_b2" style="width: 100%"></td>

          <td><b>Vitamin PP: </b></td>

          <td><input type="text" name="nc_vtm_pp" style="width: 100%"></td>

          <td><b>Vitamin C: </b></td>

          <td><input type="text" name="nc_vtm_c" style="width: 100%"></td>

          <td></td>

          <td></td>

        </tr>

              

      </table>

          <input type="submit" name="save" value="Thêm" class="button button-primary">

    </form>

  </div>

  <script>

  (function($){
        $('input[name="nc_nl"]').change(function(){
          var vbcalo=Number($(this).val());
            $('input[name="nc_protid"]').val(Math.round(vbcalo*0.17/4 * 100) / 100);
            $('input[name="nc_lipid"]').val(Math.round(vbcalo*0.23/9 * 100) / 100);
            $('input[name="nc_glucid"]').val(Math.round(vbcalo*0.4/4 * 100) / 100);
        });

        $( '.vb-gioitinh input[type="radio"]' ).on( "click", function() {

            $('input[name="nc_gt"]').val($( '.vb-gioitinh input[type="radio"]:checked' ).val());

        });

        $('input[name="nc_tuoi_min"]').change(function(){

            let vbtuoimin=$(this).val();

        });

        $('input[name="nc_tuoi_max"]').change(function(){

            let vbtuoimax=$(this).val();

        });

        if(Number(vbtuoimin)==Number(Max)){

            let vbtuoi= vbtuoimin+" tuổi";

        }

        else{

             let vbtuoi= vbtuoimin+" - "+vbtuoimax+" tuổi";

        }

        $('input[name="nc_tuoi_"]').val(vbtuoi);

  })(jQuery);

  </script>

<?php

}
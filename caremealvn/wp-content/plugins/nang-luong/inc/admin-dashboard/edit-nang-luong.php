<?php if (!empty($_GET['edit_nang_luong']) && current_user_can( 'administrator' )): ?>

	<div class="wrap">

		<form action="" method="POST" class="form-horizontal" role="form">

			<?php global $wpdb;

			if (!empty($_POST['save'])):

				$update = $wpdb->update( 

		            $wpdb->prefix.'nang_luong',

		            array(

		                'nc_tuoi' => $_POST['nc_tuoi'],

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

		            array( 'id' => $_GET['edit_nang_luong'] ), 

		            '%s',

		            '%s'

		        );

		        if (!empty($update)): ?>

					<div class="updated notice is-dismissible"> 

						<p><strong>Đã sửa thành công.</strong></p>

					</div>

				<?php elseif (!empty($error)): ?>

					<div class="error notice is-dismissible"> 

						<p><strong><?php echo $error; ?></strong></p>

					</div>

				<?php else: ?>

					<div class="error notice is-dismissible"> 

						<p><strong>Sửa thông tin thất bại.</strong></p>

					</div>

				<?php endif;

			endif;

			$result = $wpdb->get_row( 'SELECT * FROM '.$wpdb->prefix.'nang_luong WHERE id = "'.$_GET['edit_nang_luong'].'"' ); 

			$list_nl = $wpdb->get_results( 'SELECT nc_tuoi FROM '.$wpdb->prefix.'nang_luong WHERE nc_tuoi != "" AND nc_tuoi IS NOT NULL GROUP BY nc_tuoi ORDER BY nc_tuoi ASC' );

			?>



			<h1>Sửa thông tin</h1>

			<?php if (!empty($result)): ?>

			<table class="vb-nhap-nl">

				<tr class="vb-header">

					<td><b>Độ tuổi:</b></td>

					<td><input type="text" name="nc_tuoi" style="width: 100%" value="<?php echo $result->nc_tuoi ?>"></td>

					<td><b>Giới tính: </b></td>

					<td><input type="text" name="" style="width: 100%"></td>

					<td>

						<input type="radio" name="nc_gt" value="Nam" style="width: 100%">

						<input type="radio" name="nc_gt" value="Nữ" style="width: 100%">

					</td>

				</tr>

				<tr class="vb-tr-main">

					<td><b>Năng lượng khuyến nghị: </b></td>

					<td><input type="text" name="nc_nl" style="width: 100%" value="<?php echo $result->nc_nl ?>"></td>

					<td><b>Protein: </b></td>

					<td><input type="text" name="nc_protid" style="width: 100%" value="<?php echo $result->nc_protid ?>"></td>

					<td><b>Glucid: </b></td>

					<td><input type="text" name="nc_glucid" style="width: 100%" value="<?php echo $result->nc_protid ?>"></td>

					<td><b>Lipid: </b></td>

					<td><input type="text" name="nc_lipid" style="width: 100%" value="<?php echo $result->nc_protid ?>"></td>

					

				</tr>

				<tr class="vb-tr-main">
					<td><b>Vitamin C: </b></td>

          			<td><input type="text" name="nc_vtm_c" style="width: 100%"></td>

					<td><b>Sắt: </b></td>

					<td><input type="text" name="nc_sat" style="width: 100%" value="<?php echo $result->nc_sat ?>"></td>

					<td><b>Vitamin A: </b></td>

					<td><input type="text" name="nc_vtm_a" style="width: 100%" value="<?php echo $result->nc_vtm_a ?>"></td>

					<td><b>Vitamin B1: </b></td>

					<td><input type="text" name="nc_vtm_b1" style="width: 100%" value="<?php echo $result->nc_vtm_b1 ?>"></td>

				</tr>

				<tr class="vb-tr-main">

					<td><b>Vitamin B2: </b></td>

					<td><input type="text" name="nc_vtm_b2" style="width: 100%" value="<?php echo $result->nc_vtm_b2 ?>"></td>

					<td><b>Vitamin PP: </b></td>

					<td><input type="text" name="nc_vtm_pp" style="width: 100%" value="<?php echo $result->nc_vtm_pp ?>"></td>

					<td><b>Vitamin C: </b></td>

					<td><input type="text" name="nc_vtm_c" style="width: 100%" value="<?php echo $result->nc_vtm_c ?>"></td>

					<td></td>

					<td></td>

				</tr>				

			</table>

				<br>

		        <input type="submit" name="save" value="Cập nhật" class="button button-primary">

			<?php else: ?>

				<div class="error notice"><p>ID không hợp lệ.</p></div>

			<?php endif ?>

		</form>

	</div>

<?php else: ?>

	<div class="wrap"><div class="error notice"><p>ID không hợp lệ hoặc bạn không đủ quyền truy cập.</p></div></div>

<?php endif; ?>

<script>

  (function($){
        $('input[name="nc_nl"]').change(function(){
          var vbcalo=Number($(this).val());
            $('input[name="nc_protid"]').val(Math.round(vbcalo*0.17/4 * 100) / 100);
            $('input[name="nc_lipid"]').val(Math.round(vbcalo*0.23/9 * 100) / 100);
            $('input[name="nc_glucid"]').val(Math.round(vbcalo*0.4/4 * 100) / 100);
        });


  })(jQuery);

  </script>


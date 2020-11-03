<?php
// Hook for adding admin menus
add_action('admin_menu', 'nhap_bua_sang_add_pages');
// action function for above hook
function nhap_bua_sang_add_pages() {
    add_submenu_page(
        'bua_sang',
        __( 'Nhập món ăn', 'theme-wp' ),
        __( 'Nhập món ăn', 'theme-wp' ),
        'manage_options',
        'nhap_bua_sang',
        'nhap_bua_sang'
    );
}
function nhap_bua_sang(){ 
	ob_start();
	global $wpdb;
	$list_nl = $wpdb->get_results( 'SELECT nl_ten FROM '.$wpdb->prefix.'nguyen_lieu WHERE nl_ten != "" AND nl_ten IS NOT NULL GROUP BY nl_ten ORDER BY nl_ten ASC' );
	?>

    <div class="wrap">
		<form method="POST" class="form-horizontal" role="form" action="" enctype="multipart/form-data">
			<h1>Nhập món ăn</h1>
			<?php if (!empty($_POST['save'])):
				if (!empty($_POST['bs_ten'])) {
					global $wpdb;
					$insert = $wpdb->insert( 
						$wpdb->prefix.'bua_sang', 
						array( 
							'bs_ten' => $_POST['bs_ten'],
							'bs_nl1' => $_POST['bs_nl1'],	
							'bs_nl2' => $_POST['bs_nl2'],				
							'bs_nl3' => $_POST['bs_nl3'],
							'bs_nl4' => $_POST['bs_nl4'],
							'bs_nl5' => $_POST['bs_nl5'],
							'bs_nl6' => $_POST['bs_nl6'],
							'bs_nl7' => $_POST['bs_nl7'],
							'bs_nl8' => $_POST['bs_nl8'],
							'bs_nl9' => $_POST['bs_nl9'],
							'bs_nl10' => $_POST['bs_nl10'],
							'bs_e' => $_POST['bs_e'],
							'bs_p' => $_POST['bs_p'],
							'bs_l' => $_POST['bs_l'],
							'bs_g' => $_POST['bs_g'],
							'bs_fe' => $_POST['bs_fe'],
							'bs_zn' => $_POST['bs_zn'],
							'bs_xo' => $_POST['bs_xo'],
							'bs_ca' => $_POST['bs_ca'],
							'bs_na' => $_POST['bs_na'],
							'bs_cho' => $_POST['bs_cho'],
						), 
						'%s'
					);
				}  else {
					$error = 'Không đủ dữ liệu';
				}
				if (!empty($insert)): ?>
					<div class="updated notice is-dismissible"> 
						<p><strong>Thêm món ăn thành công.</strong></p>
					</div>
				<?php elseif (!empty($error)): ?>
					<div class="error notice is-dismissible"> 
						<p><strong><?php echo $error; ?></strong></p>
					</div>
				<?php else: ?>
					<div class="error notice is-dismissible"> 
						<p><strong>Thêm món ăn thất bại. Tên món ăn đã tồn tại</strong></p>
					</div>
				<?php endif;
			endif; ?>
			<table class="vb-nhap-nl">
				<tr class="vb-header">
					<td><b>Tên món ăn:</b></td>
					<td><input type="text" name="bs_ten" style="width: 100%"></td>
				</tr>
				<tr class="vb-tr-main">
				<td><b>Nguyên liệu:</b></td>
				<td class="vb-nguyenlieu-bs">
						<input type="text" name="bs_nl1" class="vb-nl-ip" value="" style="display: none">
						<div>
						<select class="vb-nl-sl">
                  			<option>Nguyên liệu</option>
                  				<?php if (!empty($list_nl)): ?>
                      				<?php foreach ($list_nl as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['nl_ten']) && $_REQUEST['nl_ten'] == $value->nl_ten ? ' selected=""' : '' ?> value="<?php echo $value->nl_ten ?>"><?php echo $value->nl_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
                		<p>Khối lượng: <input class="vb-kl" value=""></p>
                		</div>
				</td>
				<td class="vb-nguyenlieu-bs">
						<input type="text" name="bs_nl2" class="vb-nl-ip" value="" style="display: none">
						<div>
						<select class="vb-nl-sl">
                  			<option>Nguyên liệu</option>
                  				<?php if (!empty($list_nl)): ?>
                      				<?php foreach ($list_nl as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['nl_ten']) && $_REQUEST['nl_ten'] == $value->nl_ten ? ' selected=""' : '' ?> value="<?php echo $value->nl_ten ?>"><?php echo $value->nl_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
                		<p>Khối lượng: <input class="vb-kl" value=""></p>
                		</div>
				</td>
				<td class="vb-nguyenlieu-bs">
						<input type="text" name="bs_nl3" class="vb-nl-ip" value="" style="display: none">
						<div>
						<select class="vb-nl-sl">
                  			<option>Nguyên liệu</option>
                  				<?php if (!empty($list_nl)): ?>
                      				<?php foreach ($list_nl as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['nl_ten']) && $_REQUEST['nl_ten'] == $value->nl_ten ? ' selected=""' : '' ?> value="<?php echo $value->nl_ten ?>"><?php echo $value->nl_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
                		<p>Khối lượng: <input class="vb-kl" value=""></p>
                		</div>
				</td>
				<td class="vb-nguyenlieu-bs">
						<input type="text" name="bs_nl4" class="vb-nl-ip" value="" style="display: none">
						<div>
						<select class="vb-nl-sl">
                  			<option>Nguyên liệu</option>
                  				<?php if (!empty($list_nl)): ?>
                      				<?php foreach ($list_nl as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['nl_ten']) && $_REQUEST['nl_ten'] == $value->nl_ten ? ' selected=""' : '' ?> value="<?php echo $value->nl_ten ?>"><?php echo $value->nl_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
                		<p>Khối lượng: <input class="vb-kl" value=""></p>
                		</div>
				</td>
				<td class="vb-nguyenlieu-bs">
						<input type="text" name="bs_nl5" class="vb-nl-ip" value="" style="display: none">
						<div>
						<select class="vb-nl-sl">
                  			<option>Nguyên liệu</option>
                  				<?php if (!empty($list_nl)): ?>
                      				<?php foreach ($list_nl as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['nl_ten']) && $_REQUEST['nl_ten'] == $value->nl_ten ? ' selected=""' : '' ?> value="<?php echo $value->nl_ten ?>"><?php echo $value->nl_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
                		<p>Khối lượng: <input class="vb-kl" value=""></p>
                		</div>
				</td>
				</tr>
				<tr class="vb-tr-main">
				<td class="vb-nguyenlieu-bs">
						<input type="text" name="bs_nl6" class="vb-nl-ip" value="" style="display: none">
						<div>
						<select class="vb-nl-sl">
                  			<option>Nguyên liệu</option>
                  				<?php if (!empty($list_nl)): ?>
                      				<?php foreach ($list_nl as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['nl_ten']) && $_REQUEST['nl_ten'] == $value->nl_ten ? ' selected=""' : '' ?> value="<?php echo $value->nl_ten ?>"><?php echo $value->nl_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
                		<p>Khối lượng: <input class="vb-kl" value=""></p>
                		</div>
				</td>
				<td class="vb-nguyenlieu-bs">
						<input type="text" name="bs_nl7" class="vb-nl-ip" value="" style="display: none">
						<div>
						<select class="vb-nl-sl">
                  			<option>Nguyên liệu</option>
                  				<?php if (!empty($list_nl)): ?>
                      				<?php foreach ($list_nl as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['nl_ten']) && $_REQUEST['nl_ten'] == $value->nl_ten ? ' selected=""' : '' ?> value="<?php echo $value->nl_ten ?>"><?php echo $value->nl_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
                		<p>Khối lượng: <input class="vb-kl" value=""></p>
                		</div>
				</td>
				<td class="vb-nguyenlieu-bs">
						<input type="text" name="bs_nl8" class="vb-nl-ip" value="" style="display: none">
						<div>
						<select class="vb-nl-sl">
                  			<option>Nguyên liệu</option>
                  				<?php if (!empty($list_nl)): ?>
                      				<?php foreach ($list_nl as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['nl_ten']) && $_REQUEST['nl_ten'] == $value->nl_ten ? ' selected=""' : '' ?> value="<?php echo $value->nl_ten ?>"><?php echo $value->nl_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
                		<p>Khối lượng: <input class="vb-kl" value=""></p>
                		</div>
				</td>
				<td class="vb-nguyenlieu-bs">
						<input type="text" name="bs_nl9" class="vb-nl-ip" value="" style="display: none">
						<div>
						<select class="vb-nl-sl">
                  			<option>Nguyên liệu</option>
                  				<?php if (!empty($list_nl)): ?>
                      				<?php foreach ($list_nl as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['nl_ten']) && $_REQUEST['nl_ten'] == $value->nl_ten ? ' selected=""' : '' ?> value="<?php echo $value->nl_ten ?>"><?php echo $value->nl_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
                		<p>Khối lượng: <input class="vb-kl" value=""></p>
                		</div>
				</td>
				<td class="vb-nguyenlieu-bs">
						<input type="text" name="bs_nl10" class="vb-nl-ip" value="" style="display: none">
						<div>
						<select class="vb-nl-sl">
                  			<option>Nguyên liệu</option>
                  				<?php if (!empty($list_nl)): ?>
                      				<?php foreach ($list_nl as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['nl_ten']) && $_REQUEST['nl_ten'] == $value->nl_ten ? ' selected=""' : '' ?> value="<?php echo $value->nl_ten ?>"><?php echo $value->nl_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
                		<p>Khối lượng: <input class="vb-kl" value=""></p>
                		</div>
				</td>
				</tr>										
				<tr>
					<td><b>Năng lượng (E):</b><input type="text" name="bs_e"></td>
				</tr>
				<tr>
					<td><b>Protein (P):</b><input type="text" name="bs_p"></td>
					<td><b>Chất Béo (L):</b><input type="text" name="bs_l"></td>
					<td><b>Cacbohydrate (G):</b><input type="text" name="bs_g"></td>
				</tr>
				<tr>
					<td><b>Sắt (Fe):</b><input type="text" name="bs_fe"></td>
					<td><b>Kém (Zn):</b><input type="text" name="bs_zn"></td>
					<td><b>Chất Xơ:</b><input type="text" name="bs_xo"></td>
				</tr>
				<tr>
					<td><b>Canxi (Ca):</b><input type="text" name="bs_ca"></td>
					<td><b>Natri (Na):</b><input type="text" name="bs_na"></td>
					<td><b>Cholestrol (Cho):</b><input type="text" name="bs_cho"></td>
				</tr>
			</table>
	        <input type="submit" name="save" value="Thêm nguyên liệu" class="button button-primary">
		</form>
	</div>
	<script type="text/javascript">
		(function ($) {
			$('.vb-nguyenlieu-bs').each(function(){
				$(this).find(".vb-nl-sl").change(function(){
        			var nl = $(this).val();
        			if(nl.toUpperCase().trim()=="NGUYÊN LIỆU"){
        				nl="";
        			} 
        			var nlslt=nl;
        			$(this).parent().parent().find('.vb-nl-ip').val(nlslt);  
         			$(this).parent().parent().find('.vb-kl').change(function(){
         				var nlsl = $(this).val();
         				 nlslt +=(" "+nlsl);
         				$(this).parent().parent().parent().find('.vb-nl-ip').val(nlslt);       	
    				 });     			  	
    			});
			});
	   		
		})(jQuery);		
	</script>
    <?php
}
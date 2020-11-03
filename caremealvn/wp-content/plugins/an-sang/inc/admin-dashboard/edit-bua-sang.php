<?php if (!empty($_GET['edit_bua_sang']) && current_user_can( 'administrator' )): ?>
	<div class="wrap">
		<form action="" method="POST" class="form-horizontal" role="form">
			<?php global $wpdb;
			if (!empty($_POST['save'])):
				$update = $wpdb->update( 
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
		            array( 'id' => $_GET['edit_bua_sang'] ), 
		            '%s',
		            '%s'
		        );
		        if (!empty($update)): ?>
					<div class="updated notice is-dismissible"> 
						<p><strong>Đã sửa món ăn.</strong></p>
					</div>
				<?php elseif (!empty($error)): ?>
					<div class="error notice is-dismissible"> 
						<p><strong><?php echo $error; ?></strong></p>
					</div>
				<?php else: ?>
					<div class="error notice is-dismissible"> 
						<p><strong>Sửa món thất bại.</strong></p>
					</div>
				<?php endif;
			endif;
			$result = $wpdb->get_row( 'SELECT * FROM '.$wpdb->prefix.'bua_sang WHERE id = "'.$_GET['edit_bua_sang'].'"' ); 
			$list_nl = $wpdb->get_results( 'SELECT nl_ten FROM '.$wpdb->prefix.'nguyen_lieu WHERE nl_ten != "" AND nl_ten IS NOT NULL GROUP BY nl_ten ORDER BY nl_ten ASC' );
			?>

			<h1>Sửa món ăn</h1>
			<?php if (!empty($result)): ?>
				<table class="vb-nhap-nl">
				<tr class="vb-header">
					<td><b>Tên món ăn:</b></td>
					<td><input type="text" name="bs_ten" style="width: 100%" value="<?php echo $result->bs_ten ?>"></td>
				</tr>
				<tr class="vb-tr-main">
				<td><b>Nguyên liệu:</b></td>
				<td class="vb-nguyenlieu-bs">
						<input type="text" name="bs_nl1" class="vb-nl-ip" style="display: none" value="<?php echo $result->bs_nl1 ?>">
						<div>
						
						<select class="vb-nl-sl" value="<?php echo $piecesten; ?>">
							<?php 
							$vbnl1=$result->bs_nl1;
							if($vbnl1 != ""){
								$pieces = explode(" ", $vbnl1);
								$pieceslng=count($pieces);	
								$piecesten="";
								$i=0;
								for($i=0;$i<$pieceslng-1;$i++)	{
									$piecesten .= $pieces[$i]." ";
								} ?>
								<option value="<?php echo $piecesten ?>"><?php echo $piecesten ?></option>
								<?php													
							}
						?>
							
                  			<option>Nguyên liệu</option>
                  				<?php if (!empty($list_nl)): ?>
                      				<?php foreach ($list_nl as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['nl_ten']) && $_REQUEST['nl_ten'] == $value->nl_ten ? ' selected=""' : '' ?> value="<?php echo $value->nl_ten ?>"><?php echo $value->nl_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
                		<p>Khối lượng: <input class="vb-kl" value="<?php echo $pieces[$pieceslng-1]; ?>"></p>
                		</div>
				</td>
				<td class="vb-nguyenlieu-bs">
						<input type="text" name="bs_nl2" class="vb-nl-ip"  style="display: none" value="<?php echo $result->bs_nl2 ?>">
						<div>
						<select class="vb-nl-sl">
							<?php 
							$vbnl2=$result->bs_nl2;
							if($vbnl2 != ""){
								$pieces2 = explode(" ", $vbnl2);
								$pieceslng2=count($pieces2);	
								$piecesten2="";
								$i=0;
								for($i=0;$i<$pieceslng2-1;$i++)	{
									$piecesten2 .= $pieces2[$i]." ";
								} ?>
								<option value="<?php echo $piecesten2 ?>"><?php echo $piecesten2 ?></option>
								<?php													
							} ?>
                  			<option>Nguyên liệu</option>
                  				<?php if (!empty($list_nl)): ?>
                      				<?php foreach ($list_nl as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['nl_ten']) && $_REQUEST['nl_ten'] == $value->nl_ten ? ' selected=""' : '' ?> value="<?php echo $value->nl_ten ?>"><?php echo $value->nl_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
                		<p>Khối lượng: <input class="vb-kl" value="<?php echo $pieces2[$pieceslng2-1]; ?>"></p>
                		</div>
				</td>
				<td class="vb-nguyenlieu-bs">
						<input type="text" name="bs_nl3" class="vb-nl-ip" style="display: none" value="<?php echo $result->bs_nl3 ?>">
						<div>
						<select class="vb-nl-sl">
							<?php 
							$vbnl3=$result->bs_nl3;
							if($vbnl3 != ""){
								$pieces3 = explode(" ", $vbnl3);
								$pieceslng3=count($pieces3);	
								$piecesten3="";
								$i=0;
								for($i=0;$i<$pieceslng3-1;$i++)	{
									$piecesten3 .= $pieces3[$i]." ";
								} ?>
								<option value="<?php echo $piecesten3 ?>"><?php echo $piecesten3 ?></option>
								<?php													
							} ?>
                  			<option>Nguyên liệu</option>
                  				<?php if (!empty($list_nl)): ?>
                      				<?php foreach ($list_nl as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['nl_ten']) && $_REQUEST['nl_ten'] == $value->nl_ten ? ' selected=""' : '' ?> value="<?php echo $value->nl_ten ?>"><?php echo $value->nl_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
                		<p>Khối lượng: <input class="vb-kl" value="<?php echo $pieces3[$pieceslng3-1]; ?>"></p>
                		</div>
				</td>
				<td class="vb-nguyenlieu-bs">
						<input type="text" name="bs_nl4" class="vb-nl-ip"  style="display: none" value="<?php echo $result->bs_nl4 ?>">
						<div>
						<select class="vb-nl-sl">
							<?php 
							$vbnl4=$result->bs_nl4;
							if($vbnl4 != ""){
								$pieces = explode(" ", $vbnl4);
								$pieceslng4=count($pieces4);	
								$piecesten4="";
								$i=0;
								for($i=0;$i<$pieceslng4-1;$i++)	{
									$piecesten4 .= $pieces4[$i]." ";
								} ?>
								<option value="<?php echo $piecesten4 ?>"><?php echo $piecesten4 ?></option>
								<?php													
							}?>
                  			<option>Nguyên liệu</option>
                  				<?php if (!empty($list_nl)): ?>
                      				<?php foreach ($list_nl as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['nl_ten']) && $_REQUEST['nl_ten'] == $value->nl_ten ? ' selected=""' : '' ?> value="<?php echo $value->nl_ten ?>"><?php echo $value->nl_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
                		<p>Khối lượng: <input class="vb-kl" value="<?php echo $pieces4[$pieceslng4-1]; ?>"></p>
                		</div>
				</td>
				<td class="vb-nguyenlieu-bs">
						<input type="text" name="bs_nl5" class="vb-nl-ip"  style="display: none" value="<?php echo $result->bs_nl5 ?>">
						<div>
						<select class="vb-nl-sl">
							<?php 
							$vbnl5=$result->bs_nl5;
							if($vbnl5 != ""){
								$pieces = explode(" ", $vbnl5);
								$pieceslng5=count($pieces5);	
								$piecesten5="";
								$i=0;
								for($i=0;$i<$pieceslng5-1;$i++)	{
									$piecesten5 .= $pieces5[$i]." ";
								} ?>
								<option value="<?php echo $piecesten5 ?>"><?php echo $piecesten5 ?></option>
								<?php													
							}?>
                  			<option>Nguyên liệu</option>
                  				<?php if (!empty($list_nl)): ?>
                      				<?php foreach ($list_nl as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['nl_ten']) && $_REQUEST['nl_ten'] == $value->nl_ten ? ' selected=""' : '' ?> value="<?php echo $value->nl_ten ?>"><?php echo $value->nl_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
                		<p>Khối lượng: <input class="vb-kl" value="<?php echo $pieces5[$pieceslng5-1]; ?>"></p>
                		</div>
				</td>
				</tr>
				<tr class="vb-tr-main">
				<td class="vb-nguyenlieu-bs">
						<input type="text" name="bs_nl6" class="vb-nl-ip"  style="display: none" value="<?php echo $result->bs_nl6 ?>">
						<div>
						<select class="vb-nl-sl">
							<?php 
							$vbnl6=$result->bs_nl6;
							if($vbnl6 != ""){
								$pieces = explode(" ", $vbnl6);
								$pieceslng6=count($pieces6);	
								$piecesten6="";
								$i=0;
								for($i=0;$i<$pieceslng6-1;$i++)	{
									$piecesten6 .= $pieces6[$i]." ";
								} ?>
								<option value="<?php echo $piecesten6 ?>"><?php echo $piecesten6 ?></option>
								<?php													
							}?>
                  			<option>Nguyên liệu</option>
                  				<?php if (!empty($list_nl)): ?>
                      				<?php foreach ($list_nl as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['nl_ten']) && $_REQUEST['nl_ten'] == $value->nl_ten ? ' selected=""' : '' ?> value="<?php echo $value->nl_ten ?>"><?php echo $value->nl_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
                		<p>Khối lượng: <input class="vb-kl" value="<?php echo $pieces6[$pieceslng6-1]; ?>"></p>
                		</div>
				</td>
				<td class="vb-nguyenlieu-bs">
						<input type="text" name="bs_nl7" class="vb-nl-ip"  style="display: none" value="<?php echo $result->bs_nl7 ?>">
						<div>
						<select class="vb-nl-sl">
							<?php 
							$vbnl7=$result->bs_nl7;
							if($vbnl7 != ""){
								$pieces = explode(" ", $vbnl7);
								$pieceslng7=count($pieces7);	
								$piecesten7="";
								$i=0;
								for($i=0;$i<$pieceslng7-1;$i++)	{
									$piecesten7 .= $pieces7[$i]." ";
								} ?>
								<option value="<?php echo $piecesten7 ?>"><?php echo $piecesten7 ?></option>
								<?php													
							}?>
                  			<option>Nguyên liệu</option>
                  				<?php if (!empty($list_nl)): ?>
                      				<?php foreach ($list_nl as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['nl_ten']) && $_REQUEST['nl_ten'] == $value->nl_ten ? ' selected=""' : '' ?> value="<?php echo $value->nl_ten ?>"><?php echo $value->nl_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
                		<p>Khối lượng: <input class="vb-kl" value="<?php echo $pieces7[$pieceslng7-1]; ?>"></p>
                		</div>
				</td>
				<td class="vb-nguyenlieu-bs">
						<input type="text" name="bs_nl8" class="vb-nl-ip" style="display: none" value="<?php echo $result->bs_nl8 ?>">
						<div>
						<select class="vb-nl-sl">
							<?php 
							$vbnl8=$result->bs_nl8;
							if($vbnl8 != ""){
								$pieces8 = explode(" ", $vbnl8);
								$pieceslng8=count($pieces8);	
								$piecesten8="";
								$i=0;
								for($i=0;$i<$pieceslng8-1;$i++)	{
									$piecesten8 .= $pieces8[$i]." ";
								} ?>
								<option value="<?php echo $piecesten8 ?>"><?php echo $piecesten8 ?></option>
								<?php													
							}?>
                  			<option>Nguyên liệu</option>
                  				<?php if (!empty($list_nl)): ?>
                      				<?php foreach ($list_nl as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['nl_ten']) && $_REQUEST['nl_ten'] == $value->nl_ten ? ' selected=""' : '' ?> value="<?php echo $value->nl_ten ?>"><?php echo $value->nl_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
                		<p>Khối lượng: <input class="vb-kl" value="<?php echo $pieces8[$pieceslng8-1]; ?>"></p>
                		</div>
				</td>
				<td class="vb-nguyenlieu-bs">
						<input type="text" name="bs_nl9" class="vb-nl-ip"  style="display: none" value="<?php echo $result->bs_nl9 ?>">
						<div>
						<select class="vb-nl-sl">
							<?php 
							$vbnl9=$result->bs_nl9;
							if($vbnl9 != ""){
								$pieces = explode(" ", $vbnl9);
								$pieceslng9=count($pieces9);	
								$piecesten9="";
								$i=0;
								for($i=0;$i<$pieceslng9-1;$i++)	{
									$piecesten9 .= $pieces9[$i]." ";
								} ?>
								<option value="<?php echo $piecesten9 ?>"><?php echo $piecesten9 ?></option>
								<?php													
							}?>
                  			<option>Nguyên liệu</option>
                  				<?php if (!empty($list_nl)): ?>
                      				<?php foreach ($list_nl as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['nl_ten']) && $_REQUEST['nl_ten'] == $value->nl_ten ? ' selected=""' : '' ?> value="<?php echo $value->nl_ten ?>"><?php echo $value->nl_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
                		<p>Khối lượng: <input class="vb-kl" value="<?php echo $pieces9[$pieceslng9-1]; ?>"></p>
                		</div>
				</td>
				<td class="vb-nguyenlieu-bs">
						<input type="text" name="bs_nl10" class="vb-nl-ip"  style="display: none" value="<?php echo $result->bs_nl10 ?>">
						<div>
						<select class="vb-nl-sl">
							<?php 
							$vbnl10=$result->bs_nl19;
							if($vbnl10 != ""){
								$pieces10 = explode(" ", $vbnl10);
								$pieceslng10=count($pieces10);	
								$piecesten10="";
								$i=0;
								for($i=0;$i<$pieceslng10-1;$i++)	{
									$piecesten10 .= $pieces10[$i]." ";
								} ?>
								<option value="<?php echo $piecesten10 ?>"><?php echo $piecesten10 ?></option>
								<?php													
							}?>
                  			<option>Nguyên liệu</option>
                  				<?php if (!empty($list_nl)): ?>
                      				<?php foreach ($list_nl as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['nl_ten']) && $_REQUEST['nl_ten'] == $value->nl_ten ? ' selected=""' : '' ?> value="<?php echo $value->nl_ten ?>"><?php echo $value->nl_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
                		<p>Khối lượng: <input class="vb-kl" value="<?php echo $pieces10[$pieceslng10-1]; ?>"></p>
                		</div>
				</td>
				</tr>										
				<tr>
					<td><b>Năng lượng (E):</b><input type="text" name="bs_e" value="<?php echo $result->bs_e ?>"></td>
				</tr>
				<tr>
					<td><b>Protein (P):</b><input type="text" name="bs_p" value="<?php echo $result->bs_p ?>"></td>
					<td><b>Chất Béo (L):</b><input type="text" name="bs_l" value="<?php echo $result->bs_l ?>"></td>
					<td><b>Cacbohydrate (G):</b><input type="text" name="bs_g" value="<?php echo $result->bs_g ?>"></td>
				</tr>
				<tr>
					<td><b>Sắt (Fe):</b><input type="text" name="bs_fe" value="<?php echo $result->bs_fe ?>"></td>
					<td><b>Kém (Zn):</b><input type="text" name="bs_zn" value="<?php echo $result->bs_zn ?>"></td>
					<td><b>Chất Xơ:</b><input type="text" name="bs_xo" value="<?php echo $result->bs_xo ?>"></td>
				</tr>
				<tr>
					<td><b>Canxi (Ca):</b><input type="text" name="bs_ca" value="<?php echo $result->bs_ca ?>"></td>
					<td><b>Natri (Na):</b><input type="text" name="bs_na" value="<?php echo $result->bs_na ?>"></td>
					<td><b>Cholestrol (Cho):</b><input type="text" name="bs_cho" value="<?php echo $result->bs_cho ?>"></td>
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
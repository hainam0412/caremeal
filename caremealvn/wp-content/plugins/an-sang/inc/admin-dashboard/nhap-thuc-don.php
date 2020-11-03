<?php
// Hook for adding admin menus
add_action('admin_menu', 'nhap_thuc_don_add_pages');
// action function for above hook
function nhap_thuc_don_add_pages() {
    add_submenu_page(
        'thuc_don',
        __( 'Nhập thực đơn', 'theme-wp' ),
        __( 'Nhập thực đơn', 'theme-wp' ),
        'manage_options',
        'nhap_thuc_don',
        'nhap_thuc_don'
    );
}
function nhap_thuc_don(){ 
	ob_start();
	global $wpdb;
	$list_mon_an = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'bua_sang WHERE bs_ten != "" AND bs_ten IS NOT NULL GROUP BY bs_ten ORDER BY bs_ten ASC' );
	?>

    <div class="wrap">
		<form method="POST" class="form-horizontal" role="form" action="" enctype="multipart/form-data">
			<h1>Nhập thực đơn</h1>
			<?php if (!empty($_POST['save'])):
				if (!empty($_POST['td_ngay'])) {
					global $wpdb;
					$insert = $wpdb->insert( 
						$wpdb->prefix.'thuc_don', 
						array( 
							'td_ngay' => $_POST['td_ngay'],
							'td_ma1' => $_POST['td_ma1'],	
							'td_ma2' => $_POST['td_ma2'],				
							'td_ma3' => $_POST['td_ma3'],
							'td_ma4' => $_POST['td_ma4'],
							'td_ma5' => $_POST['td_ma5'],
							'td_ma6' => $_POST['td_ma6'],
							'td_ma7' => $_POST['td_ma7'],
							'td_ma8' => $_POST['td_ma8'],
							'td_ma9' => $_POST['td_ma9'],
							'td_ma10' => $_POST['td_ma10'],
							'td_e' => $_POST['td_e'],
							'td_p' => $_POST['td_p'],
							'td_l' => $_POST['td_l'],
							'td_g' => $_POST['td_g'],
							'td_fe' => $_POST['td_fe'],
							'td_zn' => $_POST['td_zn'],
							'td_xo' => $_POST['td_xo'],
							'td_ca' => $_POST['td_ca'],
							'td_na' => $_POST['td_na'],
							'td_cho' => $_POST['td_cho'],
							'td_thu' => $_POST['td_thu'],
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
						<p><strong>Thêm thực đơn thất bại. Ngày đã tồn tại</strong></p>
					</div>
				<?php endif;
			endif; ?>
			<table class="vb-nhap-nl">
				<tr class="vb-header">
					<td><b>Ngày:</b></td>
					<td>
						<input type="date" id="dt" onchange="mydate1();" style="width: 100%">
						<input type="text" id="ndt" name="td_ngay" style="width: 100%; display: none">
						<input type="text" id="day" name="td_thu" value="0" style="width: 100%; display: none">
					</td>
				</tr>
				
				<tr class="vb-tr-main">
					<td><b>Món ăn:</b></td>
				</tr>
				<tr class="vb-tr-main">
				<td class="vb-nguyenlieu-bs">
					<input type="text" name="td_ma1" style="display: none" value="0">
						<select class="vb-nl-sl1">
                  			<option value="Món ăn">Món ăn</option>
                  				<?php if (!empty($list_mon_an)): ?>
                      				<?php foreach ($list_mon_an as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['bs_ten']) && $_REQUEST['bs_ten'] == $value->bs_ten ? ' selected=""' : '' ?> value="<?php echo $value->bs_ten ?>"><?php echo $value->bs_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>	
				</td>
				
				<td class="vb-nguyenlieu-bs">
					<input type="text" name="td_ma2" style="display: none" value="0">
						<select class="vb-nl-sl2">
                  			<option>Món ăn</option>
                  				<?php if (!empty($list_mon_an)): ?>
                      				<?php foreach ($list_mon_an as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['bs_ten']) && $_REQUEST['bs_ten'] == $value->bs_ten ? ' selected=""' : '' ?> value="<?php echo $value->bs_ten ?>"><?php echo $value->bs_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
				</td>
				<td class="vb-nguyenlieu-bs">
					<input type="text" name="td_ma3" style="display: none" value="0">
						<select class="vb-nl-sl3">
                  			<option>Món ăn</option>
                  				<?php if (!empty($list_mon_an)): ?>
                      				<?php foreach ($list_mon_an as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['bs_ten']) && $_REQUEST['bs_ten'] == $value->bs_ten ? ' selected=""' : '' ?> value="<?php echo $value->bs_ten ?>"><?php echo $value->bs_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
				</td>
				<td class="vb-nguyenlieu-bs">
					<input type="text" name="td_ma4" style="display: none" value="0">
						<select class="vb-nl-sl4">
                  			<option>Món ăn</option>
                  				<?php if (!empty($list_mon_an)): ?>
                      				<?php foreach ($list_mon_an as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['bs_ten']) && $_REQUEST['bs_ten'] == $value->bs_ten ? ' selected=""' : '' ?> value="<?php echo $value->bs_ten ?>"><?php echo $value->bs_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
				</td>
				<td class="vb-nguyenlieu-bs">
					<input type="text" name="td_ma5" style="display: none" value="0">
						<select class="vb-nl-sl5">
                  			<option>Món ăn</option>
                  				<?php if (!empty($list_mon_an)): ?>
                      				<?php foreach ($list_mon_an as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['bs_ten']) && $_REQUEST['bs_ten'] == $value->bs_ten ? ' selected=""' : '' ?> value="<?php echo $value->bs_ten ?>"><?php echo $value->bs_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
				</td>
				</tr>
				<tr class="vb-tr-main">
				<td class="vb-nguyenlieu-bs">
					<input type="text" name="td_ma6" style="display: none" value="0">
						<select class="vb-nl-sl6">
                  			<option value="Món ăn">Món ăn</option>
                  				<?php if (!empty($list_mon_an)): ?>
                      				<?php foreach ($list_mon_an as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['bs_ten']) && $_REQUEST['bs_ten'] == $value->bs_ten ? ' selected=""' : '' ?> value="<?php echo $value->bs_ten ?>"><?php echo $value->bs_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>	
				</td>
				
				<td class="vb-nguyenlieu-bs">
					<input type="text" name="td_ma7" style="display: none" value="0">
						<select class="vb-nl-sl7">
                  			<option>Món ăn</option>
                  				<?php if (!empty($list_mon_an)): ?>
                      				<?php foreach ($list_mon_an as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['bs_ten']) && $_REQUEST['bs_ten'] == $value->bs_ten ? ' selected=""' : '' ?> value="<?php echo $value->bs_ten ?>"><?php echo $value->bs_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
				</td>
				<td class="vb-nguyenlieu-bs">
					<input type="text" name="td_ma8" style="display: none" value="0">
						<select class="vb-nl-sl8">
                  			<option>Món ăn</option>
                  				<?php if (!empty($list_mon_an)): ?>
                      				<?php foreach ($list_mon_an as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['bs_ten']) && $_REQUEST['bs_ten'] == $value->bs_ten ? ' selected=""' : '' ?> value="<?php echo $value->bs_ten ?>"><?php echo $value->bs_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
				</td>
				<td class="vb-nguyenlieu-bs">
					<input type="text" name="td_ma9" style="display: none" value="0">
						<select class="vb-nl-sl9">
                  			<option>Món ăn</option>
                  				<?php if (!empty($list_mon_an)): ?>
                      				<?php foreach ($list_mon_an as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['bs_ten']) && $_REQUEST['bs_ten'] == $value->bs_ten ? ' selected=""' : '' ?> value="<?php echo $value->bs_ten ?>"><?php echo $value->bs_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
				</td>
				<td class="vb-nguyenlieu-bs">
					<input type="text" name="td_ma10" style="display: none" value="0">
						<select class="vb-nl-sl10">
                  			<option>Món ăn</option>
                  				<?php if (!empty($list_mon_an)): ?>
                      				<?php foreach ($list_mon_an as $key => $value): ?>
                        				<option<?php echo !empty($_REQUEST['bs_ten']) && $_REQUEST['bs_ten'] == $value->bs_ten ? ' selected=""' : '' ?> value="<?php echo $value->bs_ten ?>"><?php echo $value->bs_ten ?></option>
                      			<?php endforeach ?>
                  			<?php endif ?>
                		</select>
				</td>
				</tr>										
				<tr style="display:none">
					<td><b>Năng lượng (E):</b><input type="text" name="td_e" value="0"></td>
				</tr>
				<tr style="display:none">
					<td><b>Protein (P):</b><input type="text" name="td_p" value="0"></td>
					<td><b>Chất Béo (L):</b><input type="text" name="td_l" value="0"></td>
					<td><b>Cacbohydrate (G):</b><input type="text" name="td_g" value="0"></td>
				</tr>
				<tr style="display:none">
					<td><b>Sắt (Fe):</b><input type="text" name="td_fe" value="0"></td>
					<td><b>Kém (Zn):</b><input type="text" name="td_zn" value="0"></td>
					<td><b>Chất Xơ:</b><input type="text" name="td_xo" value="0"></td>
				</tr>
				<tr style="display:none">
					<td><b>Canxi (Ca):</b><input type="text" name="td_ca" value="0"></td>
					<td><b>Natri (Na):</b><input type="text" name="td_na" value="0"></td>
					<td><b>Cholestrol (Cho):</b><input type="text" name="td_cho" value="0"></td>
				</tr>
			</table>
	        <input type="submit" name="save" value="Thêm" class="button button-primary">
		</form>
	</div>
	<script type="text/javascript">

	function mydate1(){
 		d=new Date(document.getElementById("dt").value);
		dt=d.getDate();
		mn=d.getMonth();
		mn++;
		yy=d.getFullYear();
		day=d.getDay();
		switch(day){
			case 0:{
				day="Chủ nhật";
				break;
			}
			case 1:{
				day="Thứ 2";
				break;
			}
			case 2:{
				day="Thứ 3";
				break;
			}
			case 3:{
				day="Thứ 4";
				break;
			}
			case 4:{
				day="Thứ 5";
				break;
			}
			case 5:{
				day="Thứ 6";
				break;
			}
			default: {
				day="Thứ 7";
				break;
			}
		}
		document.getElementById("ndt").value=dt+"/"+mn+"/"+yy;
		document.getElementById("day").value=day;
	}
		(function ($) {
			$('input[type="date"]').change(function(){
				var vbdate=$('input[type="date"]').val().trim();
				vbdate=vbdate.split('-');
				vbdate=vbdate[2]+'/'+vbdate[1]+'/'+vbdate[0];
				$('input[name="td_ngay"]').val(vbdate);
			});		
		})(jQuery);	
		let td_e=0,td_e1=0,td_e10=0,td_e2=0,td_e3=0,td_e4=0,td_e5=0,td_e6=0,td_e7=0,td_e8=0,td_e9=0; 
		let td_p=0,td_p1=0,td_p10=0,td_p2=0,td_p3=0,td_p4=0,td_p5=0,td_p6=0,td_p7=0,td_p8=0,td_p9=0;
		let td_l=0,td_l1=0,td_l10=0,td_l2=0,td_l3=0,td_l4=0,td_l5=0,td_l6=0,td_l7=0,td_l8=0,td_l9=0;
		let td_g=0,td_g1=0,td_g10=0,td_g2=0,td_g3=0,td_g4=0,td_g5=0,td_g6=0,td_g7=0,td_g8=0,td_g9=0;
		let td_fe=0,td_fe1=0,td_fe10=0,td_fe2=0,td_fe3=0,td_fe4=0,td_fe5=0,td_fe6=0,td_fe7=0,td_fe8=0,td_fe9=0;
		let td_xo=0,td_xo1=0,td_xo10=0,td_xo2=0,td_xo3=0,td_xo4=0,td_xo5=0,td_xo6=0,td_xo7=0,td_xo8=0,td_xo9=0;
		let td_ca=0,td_ca1=0,td_ca10=0,td_ca2=0,td_ca3=0,td_ca4=0,td_ca5=0,td_ca6=0,td_ca7=0,td_ca8=0,td_ca9=0;
		let td_na=0,td_na1=0,td_na10=0,td_na2=0,td_na3=0,td_na4=0,td_na5=0,td_na6=0,td_na7=0,td_na8=0,td_na9=0;
		let td_zn=0,td_zn1=0,td_zn10=0,td_zn2=0,td_zn3=0,td_zn4=0,td_zn5=0,td_zn6=0,td_zn7=0,td_zn8=0,td_zn9=0;
		let td_cho=0,td_cho1=0,td_cho10=0,td_cho2=0,td_cho3=0,td_cho4=0,td_cho5=0,td_cho6=0,td_cho7=0,td_cho8=0,td_cho9=0;
		let number1=0,number2=0,number3=0,number4=0,number5=0,number6=0,number7=0,number8=0,number9=0,number10=0;
		let number11=0,number21=0,number31=0,number41=0,number51=0,number61=0,number71=0,number81=0,number91=0,number101=0;
		let number12=0,number22=0,number32=0,number42=0,number52=0,number62=0,number72=0,number82=0,number92=0,number102=0;
		let number13=0,number23=0,number33=0,number43=0,number53=0,number63=0,number73=0,number83=0,number93=0,number103=0;
		let number14=0,number24=0,number34=0,number44=0,number54=0,number64=0,number74=0,number84=0,number94=0,number104=0;
		let number15=0,number25=0,number35=0,number45=0,number55=0,number65=0,number75=0,number85=0,number95=0,number105=0;
		let number16=0,number26=0,number36=0,number46=0,number56=0,number66=0,number76=0,number86=0,number96=0,number106=0;
		let number17=0,number27=0,number37=0,number47=0,number57=0,number67=0,number77=0,number87=0,number97=0,number107=0;
		let number18=0,number28=0,number38=0,number48=0,number58=0,number68=0,number78=0,number88=0,number98=0,number108=0;
		let number19=0,number29=0,number39=0,number49=0,number59=0,number69=0,number79=0,number89=0,number99=0,number109=0;
		jQuery('select.vb-nl-sl1').change(function() {        
            if(jQuery('select.vb-nl-sl1 option:selected').val()!="Món ăn"){
            jQuery('input[name="td_ma1"]').val(jQuery('select.vb-nl-sl1 option:selected').val());
            td_e1=0;td_p1=0;td_l1=0;td_g1=0;td_fe1=0;td_xo1=0;td_ca1=0;td_na1=0;td_zn1=0;td_cho1=0;
            td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 			jQuery('input[name="td_e"]').val(td_e);
 			jQuery('input[name="td_p"]').val(td_p);
 			jQuery('input[name="td_l"]').val(td_l);
 			jQuery('input[name="td_g"]').val(td_g);
 			jQuery('input[name="td_fe"]').val(td_fe);
 			jQuery('input[name="td_xo"]').val(td_xo);
 			jQuery('input[name="td_ca"]').val(td_ca);
 			jQuery('input[name="td_na"]').val(td_na);
 			jQuery('input[name="td_zn"]').val(td_zn);
 			jQuery('input[name="td_cho"]').val(td_cho);
            jQuery.ajax({
                type:"POST",
                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',
                beforeSend: function( xhr ){
                jQuery('.loading-web').removeClass('hidden');
                },
                data:{'sang':jQuery('select.vb-nl-sl1 option:selected').val()},
                success:function(response){ 
                    if (response != 0) {
                        response = JSON.parse(response);
						number1 = Number((response[0].bs_e.match(/\d/g)).join(""));
                        td_e1=number1;
                        number2 = Number((response[0].bs_p.match(/\d/g)).join(""));
                        td_p1=number2;
                        number3 = Number((response[0].bs_l.match(/\d/g)).join(""));
                        td_l1=number3;
                        number4 = Number((response[0].bs_g.match(/\d/g)).join(""));
                        td_g1=number4;
                        number5 = Number((response[0].bs_fe.match(/\d/g)).join(""));
                        td_fe1=number5;
                        number6 = Number((response[0].bs_xo.match(/\d/g)).join(""));
                        td_xo1=number6;
                        number7 = Number((response[0].bs_ca.match(/\d/g)).join(""));
                        td_ca1=number7;
                        number8 = Number((response[0].bs_na.match(/\d/g)).join(""));
                        td_na1=number8;
                        number9 = Number((response[0].bs_zn.match(/\d/g)).join(""));
                        td_zn1=number9;                       
                        number10 = Number((response[0].bs_cho.match(/\d/g)).join(""));
                        td_cho1=number10;
                        td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            			td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            			td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            			td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            			td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            			td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            			td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            			td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            			td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            			td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 						jQuery('input[name="td_e"]').val(td_e);
 						jQuery('input[name="td_p"]').val(td_p);
 						jQuery('input[name="td_g"]').val(td_g);
 						jQuery('input[name="td_l"]').val(td_l);
 						jQuery('input[name="td_fe"]').val(td_fe);
 						jQuery('input[name="td_xo"]').val(td_xo);
 						jQuery('input[name="td_ca"]').val(td_ca);
 						jQuery('input[name="td_na"]').val(td_na);
 						jQuery('input[name="td_zn"]').val(td_zn);
 						jQuery('input[name="td_cho"]').val(td_cho);
                        jQuery('.loading-web').addClass('hidden');
                    }
                }
            });
            }else{
            	jQuery('input[name="td_ma1"]').val("0");
            	td_e1=td_e1-number1; 
            	td_p1=td_p1-number2;
            	td_l1=td_l1-number3;
            	td_g1=td_g1-number4;
            	td_fe1=td_fe1-number5;
            	td_xo1=td_xo1-number6;
            	td_ca1=td_ca1-number7;
            	td_na1=td_na1-number8;
            	td_zn1=td_zn1-number9;
            	td_cho1=td_cho1-number10;
                td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            	td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            	td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            	td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            	td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            	td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            	td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            	td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            	td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            	td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 				jQuery('input[name="td_e"]').val(td_e);
 				jQuery('input[name="td_p"]').val(td_p);
 				jQuery('input[name="td_g"]').val(td_g);
 				jQuery('input[name="td_l"]').val(td_l);
 				jQuery('input[name="td_fe"]').val(td_fe);
 				jQuery('input[name="td_xo"]').val(td_xo);
 				jQuery('input[name="td_ca"]').val(td_ca);
 				jQuery('input[name="td_na"]').val(td_na);
 				jQuery('input[name="td_zn"]').val(td_zn);
 				jQuery('input[name="td_cho"]').val(td_cho);
            }
        });	
		jQuery('select.vb-nl-sl2').change(function() {        
            if(jQuery('select.vb-nl-sl2 option:selected').val()!="Món ăn"){
            	jQuery('input[name="td_ma2"]').val(jQuery('select.vb-nl-sl2 option:selected').val());
            td_e2=0;td_p2=0;td_l2=0;td_g2=0;td_fe2=0;td_xo2=0;td_ca2=0;td_na2=0;td_zn2=0;td_cho2=0;
            td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 			jQuery('input[name="td_e"]').val(td_e);
 			jQuery('input[name="td_p"]').val(td_p);
 			jQuery('input[name="td_l"]').val(td_l);
 			jQuery('input[name="td_g"]').val(td_g);
 			jQuery('input[name="td_fe"]').val(td_fe);
 			jQuery('input[name="td_xo"]').val(td_xo);
 			jQuery('input[name="td_ca"]').val(td_ca);
 			jQuery('input[name="td_na"]').val(td_na);
 			jQuery('input[name="td_zn"]').val(td_zn);
 			jQuery('input[name="td_cho"]').val(td_cho);
            jQuery.ajax({
                type:"POST",
                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',
                beforeSend: function( xhr ){
                jQuery('.loading-web').removeClass('hidden');
                },
                data:{'sang':jQuery('select.vb-nl-sl2 option:selected').val()},
                success:function(response){ 
                    if (response != 0) {
                        response = JSON.parse(response);
						number11 = Number((response[0].bs_e.match(/\d/g)).join(""));
                        td_e2=number11;
                        number21 = Number((response[0].bs_p.match(/\d/g)).join(""));
                        td_p2=number21;
                        number31 = Number((response[0].bs_l.match(/\d/g)).join(""));
                        td_l2=number31;
                        number41 = Number((response[0].bs_g.match(/\d/g)).join(""));
                        td_g2=number41;
                        number51 = Number((response[0].bs_fe.match(/\d/g)).join(""));
                        td_fe2=number51;
                        number61 = Number((response[0].bs_xo.match(/\d/g)).join(""));
                        td_xo2=number61;
                        number71 = Number((response[0].bs_ca.match(/\d/g)).join(""));
                        td_ca2=number71;
                        number81 = Number((response[0].bs_na.match(/\d/g)).join(""));
                        td_na2=number81;
                        number91 = Number((response[0].bs_zn.match(/\d/g)).join(""));
                        td_zn2=number91;                       
                        number101 = Number((response[0].bs_cho.match(/\d/g)).join(""));
                        td_cho2=number101;
                        td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            			td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            			td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            			td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            			td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            			td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            			td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            			td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            			td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            			td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 						jQuery('input[name="td_e"]').val(td_e);
 						jQuery('input[name="td_p"]').val(td_p);
 						jQuery('input[name="td_g"]').val(td_g);
 						jQuery('input[name="td_l"]').val(td_l);
 						jQuery('input[name="td_fe"]').val(td_fe);
 						jQuery('input[name="td_xo"]').val(td_xo);
 						jQuery('input[name="td_ca"]').val(td_ca);
 						jQuery('input[name="td_na"]').val(td_na);
 						jQuery('input[name="td_zn"]').val(td_zn);
 						jQuery('input[name="td_cho"]').val(td_cho);
                        jQuery('.loading-web').addClass('hidden');
                    }
                }
            });
            }else{
            	jQuery('input[name="td_ma2"]').val("0");
            	td_e2=td_e2-number11; 
            	td_p2=td_p2-number21;
            	td_l2=td_l2-number31;
            	td_g2=td_g2-number41;
            	td_fe2=td_fe2-number51;
            	td_xo2=td_xo2-number61;
            	td_ca2=td_ca2-number71;
            	td_na2=td_na2-number81;
            	td_zn2=td_zn2-number91;
            	td_cho2=td_cho2-number101;
                td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            	td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            	td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            	td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            	td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            	td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            	td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            	td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            	td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            	td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 				jQuery('input[name="td_e"]').val(td_e);
 				jQuery('input[name="td_p"]').val(td_p);
 				jQuery('input[name="td_g"]').val(td_g);
 				jQuery('input[name="td_l"]').val(td_l);
 				jQuery('input[name="td_fe"]').val(td_fe);
 				jQuery('input[name="td_xo"]').val(td_xo);
 				jQuery('input[name="td_ca"]').val(td_ca);
 				jQuery('input[name="td_na"]').val(td_na);
 				jQuery('input[name="td_zn"]').val(td_zn);
 				jQuery('input[name="td_cho"]').val(td_cho);
            }
        });	
jQuery('select.vb-nl-sl3').change(function() {        
            if(jQuery('select.vb-nl-sl3 option:selected').val()!="Món ăn"){
            	jQuery('input[name="td_ma3"]').val(jQuery('select.vb-nl-sl3 option:selected').val());
            td_e3=0;td_p3=0;td_l3=0;td_g3=0;td_fe3=0;td_xo3=0;td_ca3=0;td_na3=0;td_zn3=0;td_cho3=0;
            td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 			jQuery('input[name="td_e"]').val(td_e);
 			jQuery('input[name="td_p"]').val(td_p);
 			jQuery('input[name="td_l"]').val(td_l);
 			jQuery('input[name="td_g"]').val(td_g);
 			jQuery('input[name="td_fe"]').val(td_fe);
 			jQuery('input[name="td_xo"]').val(td_xo);
 			jQuery('input[name="td_ca"]').val(td_ca);
 			jQuery('input[name="td_na"]').val(td_na);
 			jQuery('input[name="td_zn"]').val(td_zn);
 			jQuery('input[name="td_cho"]').val(td_cho);
            jQuery.ajax({
                type:"POST",
                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',
                beforeSend: function( xhr ){
                jQuery('.loading-web').removeClass('hidden');
                },
                data:{'sang':jQuery('select.vb-nl-sl3 option:selected').val()},
                success:function(response){ 
                    if (response != 0) {
                        response = JSON.parse(response);
						number12 = Number((response[0].bs_e.match(/\d/g)).join(""));
                        td_e3=number12;
                        number22 = Number((response[0].bs_p.match(/\d/g)).join(""));
                        td_p3=number22;
                        number32 = Number((response[0].bs_l.match(/\d/g)).join(""));
                        td_l3=number32;
                        number42 = Number((response[0].bs_g.match(/\d/g)).join(""));
                        td_g3=number42;
                        number52 = Number((response[0].bs_fe.match(/\d/g)).join(""));
                        td_fe3=number52;
                        number62 = Number((response[0].bs_xo.match(/\d/g)).join(""));
                        td_xo3=number62;
                        number72 = Number((response[0].bs_ca.match(/\d/g)).join(""));
                        td_ca3=number72;
                        number82 = Number((response[0].bs_na.match(/\d/g)).join(""));
                        td_na3=number82;
                        number92 = Number((response[0].bs_zn.match(/\d/g)).join(""));
                        td_zn3=number92;                       
                        number102 = Number((response[0].bs_cho.match(/\d/g)).join(""));
                        td_cho3=number102;
                        td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            			td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            			td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            			td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            			td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            			td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            			td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            			td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            			td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            			td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 						jQuery('input[name="td_e"]').val(td_e);
 						jQuery('input[name="td_p"]').val(td_p);
 						jQuery('input[name="td_g"]').val(td_g);
 						jQuery('input[name="td_l"]').val(td_l);
 						jQuery('input[name="td_fe"]').val(td_fe);
 						jQuery('input[name="td_xo"]').val(td_xo);
 						jQuery('input[name="td_ca"]').val(td_ca);
 						jQuery('input[name="td_na"]').val(td_na);
 						jQuery('input[name="td_zn"]').val(td_zn);
 						jQuery('input[name="td_cho"]').val(td_cho);
                        jQuery('.loading-web').addClass('hidden');
                    }
                }
            });
            }else{
            	jQuery('input[name="td_ma3"]').val("0");
            	td_e3=td_e3-number12; 
            	td_p3=td_p3-number22;
            	td_l3=td_l3-number32;
            	td_g3=td_g3-number42;
            	td_fe3=td_fe3-number52;
            	td_xo3=td_xo3-number62;
            	td_ca3=td_ca3-number72;
            	td_na3=td_na3-number82;
            	td_zn3=td_zn3-number92;
            	td_cho3=td_cho3-number102;
                td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            	td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            	td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            	td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            	td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            	td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            	td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            	td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            	td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            	td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 				jQuery('input[name="td_e"]').val(td_e);
 				jQuery('input[name="td_p"]').val(td_p);
 				jQuery('input[name="td_g"]').val(td_g);
 				jQuery('input[name="td_l"]').val(td_l);
 				jQuery('input[name="td_fe"]').val(td_fe);
 				jQuery('input[name="td_xo"]').val(td_xo);
 				jQuery('input[name="td_ca"]').val(td_ca);
 				jQuery('input[name="td_na"]').val(td_na);
 				jQuery('input[name="td_zn"]').val(td_zn);
 				jQuery('input[name="td_cho"]').val(td_cho);
            }
        });
jQuery('select.vb-nl-sl4').change(function() {        
            if(jQuery('select.vb-nl-sl4 option:selected').val()!="Món ăn"){
            	jQuery('input[name="td_ma4"]').val(jQuery('select.vb-nl-sl4 option:selected').val());
            td_e4=0;td_p4=0;td_l4=0;td_g4=0;td_fe4=0;td_xo4=0;td_ca4=0;td_na4=0;td_zn4=0;td_cho4=0;
            td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 			jQuery('input[name="td_e"]').val(td_e);
 			jQuery('input[name="td_p"]').val(td_p);
 			jQuery('input[name="td_l"]').val(td_l);
 			jQuery('input[name="td_g"]').val(td_g);
 			jQuery('input[name="td_fe"]').val(td_fe);
 			jQuery('input[name="td_xo"]').val(td_xo);
 			jQuery('input[name="td_ca"]').val(td_ca);
 			jQuery('input[name="td_na"]').val(td_na);
 			jQuery('input[name="td_zn"]').val(td_zn);
 			jQuery('input[name="td_cho"]').val(td_cho);
            jQuery.ajax({
                type:"POST",
                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',
                beforeSend: function( xhr ){
                jQuery('.loading-web').removeClass('hidden');
                },
                data:{'sang':jQuery('select.vb-nl-sl4 option:selected').val()},
                success:function(response){ 
                    if (response != 0) {
                        response = JSON.parse(response);
						number13 = Number((response[0].bs_e.match(/\d/g)).join(""));
                        td_e4=number13;
                        number23 = Number((response[0].bs_p.match(/\d/g)).join(""));
                        td_p4=number23;
                        number33 = Number((response[0].bs_l.match(/\d/g)).join(""));
                        td_l4=number33;
                        number43 = Number((response[0].bs_g.match(/\d/g)).join(""));
                        td_g4=number43;
                        number53 = Number((response[0].bs_fe.match(/\d/g)).join(""));
                        td_fe4=number53;
                        number63 = Number((response[0].bs_xo.match(/\d/g)).join(""));
                        td_xo4=number63;
                        number73 = Number((response[0].bs_ca.match(/\d/g)).join(""));
                        td_ca4=number73;
                        number83 = Number((response[0].bs_na.match(/\d/g)).join(""));
                        td_na4=number83;
                        number93 = Number((response[0].bs_zn.match(/\d/g)).join(""));
                        td_zn4=number93;                       
                        number103 = Number((response[0].bs_cho.match(/\d/g)).join(""));
                        td_cho4=number103;
                        td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            			td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            			td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            			td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            			td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            			td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            			td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            			td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            			td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            			td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 						jQuery('input[name="td_e"]').val(td_e);
 						jQuery('input[name="td_p"]').val(td_p);
 						jQuery('input[name="td_g"]').val(td_g);
 						jQuery('input[name="td_l"]').val(td_l);
 						jQuery('input[name="td_fe"]').val(td_fe);
 						jQuery('input[name="td_xo"]').val(td_xo);
 						jQuery('input[name="td_ca"]').val(td_ca);
 						jQuery('input[name="td_na"]').val(td_na);
 						jQuery('input[name="td_zn"]').val(td_zn);
 						jQuery('input[name="td_cho"]').val(td_cho);
                        jQuery('.loading-web').addClass('hidden');
                    }
                }
            });
            }else{
            	jQuery('input[name="td_ma4"]').val("0");
            	td_e4=td_e4-number13; 
            	td_p4=td_p4-number23;
            	td_l4=td_l4-number33;
            	td_g4=td_g4-number43;
            	td_fe4=td_fe4-number53;
            	td_xo4=td_xo4-number63;
            	td_ca4=td_ca4-number73;
            	td_na4=td_na4-number83;
            	td_zn4=td_zn4-number93;
            	td_cho4=td_cho4-number103;
                td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            	td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            	td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            	td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            	td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            	td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            	td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            	td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            	td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            	td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 				jQuery('input[name="td_e"]').val(td_e);
 				jQuery('input[name="td_p"]').val(td_p);
 				jQuery('input[name="td_g"]').val(td_g);
 				jQuery('input[name="td_l"]').val(td_l);
 				jQuery('input[name="td_fe"]').val(td_fe);
 				jQuery('input[name="td_xo"]').val(td_xo);
 				jQuery('input[name="td_ca"]').val(td_ca);
 				jQuery('input[name="td_na"]').val(td_na);
 				jQuery('input[name="td_zn"]').val(td_zn);
 				jQuery('input[name="td_cho"]').val(td_cho);
            }
        });
jQuery('select.vb-nl-sl5').change(function() {        
            if(jQuery('select.vb-nl-sl5 option:selected').val()!="Món ăn"){
            	jQuery('input[name="td_ma5"]').val(jQuery('select.vb-nl-sl5 option:selected').val());
            td_e5=0;td_p5=0;td_l5=0;td_g5=0;td_fe5=0;td_xo5=0;td_ca5=0;td_na5=0;td_zn5=0;td_cho5=0;
            td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 			jQuery('input[name="td_e"]').val(td_e);
 			jQuery('input[name="td_p"]').val(td_p);
 			jQuery('input[name="td_l"]').val(td_l);
 			jQuery('input[name="td_g"]').val(td_g);
 			jQuery('input[name="td_fe"]').val(td_fe);
 			jQuery('input[name="td_xo"]').val(td_xo);
 			jQuery('input[name="td_ca"]').val(td_ca);
 			jQuery('input[name="td_na"]').val(td_na);
 			jQuery('input[name="td_zn"]').val(td_zn);
 			jQuery('input[name="td_cho"]').val(td_cho);
            jQuery.ajax({
                type:"POST",
                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',
                beforeSend: function( xhr ){
                jQuery('.loading-web').removeClass('hidden');
                },
                data:{'sang':jQuery('select.vb-nl-sl5 option:selected').val()},
                success:function(response){ 
                    if (response != 0) {
                        response = JSON.parse(response);
						number14 = Number((response[0].bs_e.match(/\d/g)).join(""));
                        td_e5=number14;
                        number24 = Number((response[0].bs_p.match(/\d/g)).join(""));
                        td_p5=number24;
                        number34 = Number((response[0].bs_l.match(/\d/g)).join(""));
                        td_l5=number34;
                        number44 = Number((response[0].bs_g.match(/\d/g)).join(""));
                        td_g5=number44;
                        number54 = Number((response[0].bs_fe.match(/\d/g)).join(""));
                        td_fe5=number54;
                        number64 = Number((response[0].bs_xo.match(/\d/g)).join(""));
                        td_xo5=number64;
                        number74 = Number((response[0].bs_ca.match(/\d/g)).join(""));
                        td_ca5=number74;
                        number84 = Number((response[0].bs_na.match(/\d/g)).join(""));
                        td_na5=number84;
                        number94 = Number((response[0].bs_zn.match(/\d/g)).join(""));
                        td_zn5=number94;                       
                        number104 = Number((response[0].bs_cho.match(/\d/g)).join(""));
                        td_cho5=number104;
                        td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            			td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            			td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            			td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            			td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            			td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            			td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            			td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            			td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            			td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 						jQuery('input[name="td_e"]').val(td_e);
 						jQuery('input[name="td_p"]').val(td_p);
 						jQuery('input[name="td_g"]').val(td_g);
 						jQuery('input[name="td_l"]').val(td_l);
 						jQuery('input[name="td_fe"]').val(td_fe);
 						jQuery('input[name="td_xo"]').val(td_xo);
 						jQuery('input[name="td_ca"]').val(td_ca);
 						jQuery('input[name="td_na"]').val(td_na);
 						jQuery('input[name="td_zn"]').val(td_zn);
 						jQuery('input[name="td_cho"]').val(td_cho);
                        jQuery('.loading-web').addClass('hidden');
                    }
                }
            });
            }else{
            	jQuery('input[name="td_ma5"]').val("0");
            	td_e5=td_e5-number14; 
            	td_p5=td_p5-number24;
            	td_l5=td_l5-number34;
            	td_g5=td_g5-number44;
            	td_fe5=td_fe5-number54;
            	td_xo5=td_xo5-number64;
            	td_ca5=td_ca5-number74;
            	td_na5=td_na5-number84;
            	td_zn5=td_zn5-number94;
            	td_cho5=td_cho5-number104;
                td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            	td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            	td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            	td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            	td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            	td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            	td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            	td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            	td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            	td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 				jQuery('input[name="td_e"]').val(td_e);
 				jQuery('input[name="td_p"]').val(td_p);
 				jQuery('input[name="td_g"]').val(td_g);
 				jQuery('input[name="td_l"]').val(td_l);
 				jQuery('input[name="td_fe"]').val(td_fe);
 				jQuery('input[name="td_xo"]').val(td_xo);
 				jQuery('input[name="td_ca"]').val(td_ca);
 				jQuery('input[name="td_na"]').val(td_na);
 				jQuery('input[name="td_zn"]').val(td_zn);
 				jQuery('input[name="td_cho"]').val(td_cho);
            }
        });
jQuery('select.vb-nl-sl6').change(function() {        
            if(jQuery('select.vb-nl-sl6 option:selected').val()!="Món ăn"){
            	jQuery('input[name="td_ma6"]').val(jQuery('select.vb-nl-sl6 option:selected').val());
            td_e6=0;td_p6=0;td_l6=0;td_g6=0;td_fe6=0;td_xo6=0;td_ca6=0;td_na6=0;td_zn6=0;td_cho6=0;
            td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 			jQuery('input[name="td_e"]').val(td_e);
 			jQuery('input[name="td_p"]').val(td_p);
 			jQuery('input[name="td_l"]').val(td_l);
 			jQuery('input[name="td_g"]').val(td_g);
 			jQuery('input[name="td_fe"]').val(td_fe);
 			jQuery('input[name="td_xo"]').val(td_xo);
 			jQuery('input[name="td_ca"]').val(td_ca);
 			jQuery('input[name="td_na"]').val(td_na);
 			jQuery('input[name="td_zn"]').val(td_zn);
 			jQuery('input[name="td_cho"]').val(td_cho);
            jQuery.ajax({
                type:"POST",
                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',
                beforeSend: function( xhr ){
                jQuery('.loading-web').removeClass('hidden');
                },
                data:{'sang':jQuery('select.vb-nl-sl6 option:selected').val()},
                success:function(response){ 
                    if (response != 0) {
                        response = JSON.parse(response);
						number15 = Number((response[0].bs_e.match(/\d/g)).join(""));
                        td_e6=number15;
                        number25 = Number((response[0].bs_p.match(/\d/g)).join(""));
                        td_p6=number25;
                        number35 = Number((response[0].bs_l.match(/\d/g)).join(""));
                        td_l6=number35;
                        number45 = Number((response[0].bs_g.match(/\d/g)).join(""));
                        td_g6=number45;
                        number55 = Number((response[0].bs_fe.match(/\d/g)).join(""));
                        td_fe6=number55;
                        number65 = Number((response[0].bs_xo.match(/\d/g)).join(""));
                        td_xo6=number65;
                        number75 = Number((response[0].bs_ca.match(/\d/g)).join(""));
                        td_ca6=number75;
                        number85 = Number((response[0].bs_na.match(/\d/g)).join(""));
                        td_na6=number85;
                        number95 = Number((response[0].bs_zn.match(/\d/g)).join(""));
                        td_zn6=number95;                       
                        number105 = Number((response[0].bs_cho.match(/\d/g)).join(""));
                        td_cho6=number105;
                        td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            			td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            			td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            			td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            			td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            			td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            			td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            			td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            			td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            			td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 						jQuery('input[name="td_e"]').val(td_e);
 						jQuery('input[name="td_p"]').val(td_p);
 						jQuery('input[name="td_g"]').val(td_g);
 						jQuery('input[name="td_l"]').val(td_l);
 						jQuery('input[name="td_fe"]').val(td_fe);
 						jQuery('input[name="td_xo"]').val(td_xo);
 						jQuery('input[name="td_ca"]').val(td_ca);
 						jQuery('input[name="td_na"]').val(td_na);
 						jQuery('input[name="td_zn"]').val(td_zn);
 						jQuery('input[name="td_cho"]').val(td_cho);
                        jQuery('.loading-web').addClass('hidden');
                    }
                }
            });
            }else{
            	jQuery('input[name="td_ma6"]').val("0");
            	td_e6=td_e6-number15; 
            	td_p6=td_p6-number25;
            	td_l6=td_l6-number35;
            	td_g6=td_g6-number45;
            	td_fe6=td_fe6-number55;
            	td_xo6=td_xo6-number65;
            	td_ca6=td_ca6-number75;
            	td_na6=td_na6-number85;
            	td_zn6=td_zn6-number95;
            	td_cho6=td_cho6-number105;
                td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            	td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            	td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            	td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            	td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            	td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            	td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            	td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            	td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            	td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 				jQuery('input[name="td_e"]').val(td_e);
 				jQuery('input[name="td_p"]').val(td_p);
 				jQuery('input[name="td_g"]').val(td_g);
 				jQuery('input[name="td_l"]').val(td_l);
 				jQuery('input[name="td_fe"]').val(td_fe);
 				jQuery('input[name="td_xo"]').val(td_xo);
 				jQuery('input[name="td_ca"]').val(td_ca);
 				jQuery('input[name="td_na"]').val(td_na);
 				jQuery('input[name="td_zn"]').val(td_zn);
 				jQuery('input[name="td_cho"]').val(td_cho);
            }
        });
jQuery('select.vb-nl-sl7').change(function() {        
            if(jQuery('select.vb-nl-sl7 option:selected').val()!="Món ăn"){
            	jQuery('input[name="td_ma7"]').val(jQuery('select.vb-nl-sl7 option:selected').val());
            td_e7=0;td_p7=0;td_l7=0;td_g7=0;td_fe7=0;td_xo7=0;td_ca7=0;td_na7=0;td_zn7=0;td_cho7=0;
            td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 			jQuery('input[name="td_e"]').val(td_e);
 			jQuery('input[name="td_p"]').val(td_p);
 			jQuery('input[name="td_l"]').val(td_l);
 			jQuery('input[name="td_g"]').val(td_g);
 			jQuery('input[name="td_fe"]').val(td_fe);
 			jQuery('input[name="td_xo"]').val(td_xo);
 			jQuery('input[name="td_ca"]').val(td_ca);
 			jQuery('input[name="td_na"]').val(td_na);
 			jQuery('input[name="td_zn"]').val(td_zn);
 			jQuery('input[name="td_cho"]').val(td_cho);
            jQuery.ajax({
                type:"POST",
                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',
                beforeSend: function( xhr ){
                jQuery('.loading-web').removeClass('hidden');
                },
                data:{'sang':jQuery('select.vb-nl-sl7 option:selected').val()},
                success:function(response){ 
                    if (response != 0) {
                        response = JSON.parse(response);
						number16 = Number((response[0].bs_e.match(/\d/g)).join(""));
                        td_e7=number16;
                        number26 = Number((response[0].bs_p.match(/\d/g)).join(""));
                        td_p7=number26;
                        number36 = Number((response[0].bs_l.match(/\d/g)).join(""));
                        td_l7=number36;
                        number46 = Number((response[0].bs_g.match(/\d/g)).join(""));
                        td_g7=number46;
                        number56 = Number((response[0].bs_fe.match(/\d/g)).join(""));
                        td_fe7=number56;
                        number66 = Number((response[0].bs_xo.match(/\d/g)).join(""));
                        td_xo7=number66;
                        number76 = Number((response[0].bs_ca.match(/\d/g)).join(""));
                        td_ca7=number76;
                        number86 = Number((response[0].bs_na.match(/\d/g)).join(""));
                        td_na7=number86;
                        number96 = Number((response[0].bs_zn.match(/\d/g)).join(""));
                        td_zn7=number96;                       
                        number106 = Number((response[0].bs_cho.match(/\d/g)).join(""));
                        td_cho7=number106;
                        td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            			td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            			td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            			td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            			td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            			td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            			td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            			td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            			td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            			td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 						jQuery('input[name="td_e"]').val(td_e);
 						jQuery('input[name="td_p"]').val(td_p);
 						jQuery('input[name="td_g"]').val(td_g);
 						jQuery('input[name="td_l"]').val(td_l);
 						jQuery('input[name="td_fe"]').val(td_fe);
 						jQuery('input[name="td_xo"]').val(td_xo);
 						jQuery('input[name="td_ca"]').val(td_ca);
 						jQuery('input[name="td_na"]').val(td_na);
 						jQuery('input[name="td_zn"]').val(td_zn);
 						jQuery('input[name="td_cho"]').val(td_cho);
                        jQuery('.loading-web').addClass('hidden');
                    }
                }
            });
            }else{
            	jQuery('input[name="td_ma7"]').val("0");
            	td_e7=td_e7-number16; 
            	td_p7=td_p7-number26;
            	td_l7=td_l7-number36;
            	td_g7=td_g7-number46;
            	td_fe7=td_fe7-number56;
            	td_xo7=td_xo7-number66;
            	td_ca7=td_ca7-number76;
            	td_na7=td_na7-number86;
            	td_zn7=td_zn7-number96;
            	td_cho7=td_cho7-number106;
                td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            	td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            	td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            	td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            	td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            	td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            	td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            	td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            	td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            	td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 				jQuery('input[name="td_e"]').val(td_e);
 				jQuery('input[name="td_p"]').val(td_p);
 				jQuery('input[name="td_g"]').val(td_g);
 				jQuery('input[name="td_l"]').val(td_l);
 				jQuery('input[name="td_fe"]').val(td_fe);
 				jQuery('input[name="td_xo"]').val(td_xo);
 				jQuery('input[name="td_ca"]').val(td_ca);
 				jQuery('input[name="td_na"]').val(td_na);
 				jQuery('input[name="td_zn"]').val(td_zn);
 				jQuery('input[name="td_cho"]').val(td_cho);
            }
        });
jQuery('select.vb-nl-sl8').change(function() {        
            if(jQuery('select.vb-nl-sl8 option:selected').val()!="Món ăn"){
            	jQuery('input[name="td_ma8"]').val(jQuery('select.vb-nl-sl8 option:selected').val());
            td_e8=0;td_p8=0;td_l8=0;td_g8=0;td_fe8=0;td_xo8=0;td_ca8=0;td_na8=0;td_zn8=0;td_cho8=0;
            td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 			jQuery('input[name="td_e"]').val(td_e);
 			jQuery('input[name="td_p"]').val(td_p);
 			jQuery('input[name="td_l"]').val(td_l);
 			jQuery('input[name="td_g"]').val(td_g);
 			jQuery('input[name="td_fe"]').val(td_fe);
 			jQuery('input[name="td_xo"]').val(td_xo);
 			jQuery('input[name="td_ca"]').val(td_ca);
 			jQuery('input[name="td_na"]').val(td_na);
 			jQuery('input[name="td_zn"]').val(td_zn);
 			jQuery('input[name="td_cho"]').val(td_cho);
            jQuery.ajax({
                type:"POST",
                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',
                beforeSend: function( xhr ){
                jQuery('.loading-web').removeClass('hidden');
                },
                data:{'sang':jQuery('select.vb-nl-sl8 option:selected').val()},
                success:function(response){ 
                    if (response != 0) {
                        response = JSON.parse(response);
						number17 = Number((response[0].bs_e.match(/\d/g)).join(""));
                        td_e8=number17;
                        number27 = Number((response[0].bs_p.match(/\d/g)).join(""));
                        td_p8=number27;
                        number37 = Number((response[0].bs_l.match(/\d/g)).join(""));
                        td_l8=number37;
                        number47 = Number((response[0].bs_g.match(/\d/g)).join(""));
                        td_g8=number47;
                        number57 = Number((response[0].bs_fe.match(/\d/g)).join(""));
                        td_fe8=number57;
                        number67 = Number((response[0].bs_xo.match(/\d/g)).join(""));
                        td_xo8=number67;
                        number77 = Number((response[0].bs_ca.match(/\d/g)).join(""));
                        td_ca8=number77;
                        number87 = Number((response[0].bs_na.match(/\d/g)).join(""));
                        td_na8=number87;
                        number97 = Number((response[0].bs_zn.match(/\d/g)).join(""));
                        td_zn8=number97;                       
                        number107 = Number((response[0].bs_cho.match(/\d/g)).join(""));
                        td_cho8=number107;
                        td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            			td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            			td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            			td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            			td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            			td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            			td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            			td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            			td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            			td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 						jQuery('input[name="td_e"]').val(td_e);
 						jQuery('input[name="td_p"]').val(td_p);
 						jQuery('input[name="td_g"]').val(td_g);
 						jQuery('input[name="td_l"]').val(td_l);
 						jQuery('input[name="td_fe"]').val(td_fe);
 						jQuery('input[name="td_xo"]').val(td_xo);
 						jQuery('input[name="td_ca"]').val(td_ca);
 						jQuery('input[name="td_na"]').val(td_na);
 						jQuery('input[name="td_zn"]').val(td_zn);
 						jQuery('input[name="td_cho"]').val(td_cho);
                        jQuery('.loading-web').addClass('hidden');
                    }
                }
            });
            }else{
            	jQuery('input[name="td_ma8"]').val("0");
            	td_e8=td_e8-number17; 
            	td_p8=td_p8-number27;
            	td_l8=td_l8-number37;
            	td_g8=td_g8-number47;
            	td_fe8=td_fe8-number57;
            	td_xo8=td_xo8-number67;
            	td_ca8=td_ca8-number77;
            	td_na8=td_na8-number87;
            	td_zn8=td_zn8-number97;
            	td_cho8=td_cho8-number107;
                td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            	td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            	td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            	td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            	td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            	td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            	td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            	td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            	td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            	td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 				jQuery('input[name="td_e"]').val(td_e);
 				jQuery('input[name="td_p"]').val(td_p);
 				jQuery('input[name="td_g"]').val(td_g);
 				jQuery('input[name="td_l"]').val(td_l);
 				jQuery('input[name="td_fe"]').val(td_fe);
 				jQuery('input[name="td_xo"]').val(td_xo);
 				jQuery('input[name="td_ca"]').val(td_ca);
 				jQuery('input[name="td_na"]').val(td_na);
 				jQuery('input[name="td_zn"]').val(td_zn);
 				jQuery('input[name="td_cho"]').val(td_cho);
            }
        });
jQuery('select.vb-nl-sl9').change(function() {        
            if(jQuery('select.vb-nl-sl9 option:selected').val()!="Món ăn"){
            	jQuery('input[name="td_ma9"]').val(jQuery('select.vb-nl-sl9 option:selected').val());
            td_e9=0;td_p9=0;td_l9=0;td_g9=0;td_fe9=0;td_xo9=0;td_ca9=0;td_na9=0;td_zn9=0;td_cho9=0;
            td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 			jQuery('input[name="td_e"]').val(td_e);
 			jQuery('input[name="td_p"]').val(td_p);
 			jQuery('input[name="td_l"]').val(td_l);
 			jQuery('input[name="td_g"]').val(td_g);
 			jQuery('input[name="td_fe"]').val(td_fe);
 			jQuery('input[name="td_xo"]').val(td_xo);
 			jQuery('input[name="td_ca"]').val(td_ca);
 			jQuery('input[name="td_na"]').val(td_na);
 			jQuery('input[name="td_zn"]').val(td_zn);
 			jQuery('input[name="td_cho"]').val(td_cho);
            jQuery.ajax({
                type:"POST",
                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',
                beforeSend: function( xhr ){
                jQuery('.loading-web').removeClass('hidden');
                },
                data:{'sang':jQuery('select.vb-nl-sl9 option:selected').val()},
                success:function(response){ 
                    if (response != 0) {
                        response = JSON.parse(response);
						number18 = Number((response[0].bs_e.match(/\d/g)).join(""));
                        td_e9=number18;
                        number28 = Number((response[0].bs_p.match(/\d/g)).join(""));
                        td_p9=number28;
                        number38 = Number((response[0].bs_l.match(/\d/g)).join(""));
                        td_l9=number38;
                        number48 = Number((response[0].bs_g.match(/\d/g)).join(""));
                        td_g9=number48;
                        number58 = Number((response[0].bs_fe.match(/\d/g)).join(""));
                        td_fe9=number58;
                        number68 = Number((response[0].bs_xo.match(/\d/g)).join(""));
                        td_xo9=number68;
                        number78 = Number((response[0].bs_ca.match(/\d/g)).join(""));
                        td_ca9=number78;
                        number88 = Number((response[0].bs_na.match(/\d/g)).join(""));
                        td_na9=number88;
                        number98 = Number((response[0].bs_zn.match(/\d/g)).join(""));
                        td_zn9=number98;                       
                        number108 = Number((response[0].bs_cho.match(/\d/g)).join(""));
                        td_cho9=number108;
                        td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            			td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            			td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            			td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            			td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            			td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            			td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            			td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            			td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            			td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 						jQuery('input[name="td_e"]').val(td_e);
 						jQuery('input[name="td_p"]').val(td_p);
 						jQuery('input[name="td_g"]').val(td_g);
 						jQuery('input[name="td_l"]').val(td_l);
 						jQuery('input[name="td_fe"]').val(td_fe);
 						jQuery('input[name="td_xo"]').val(td_xo);
 						jQuery('input[name="td_ca"]').val(td_ca);
 						jQuery('input[name="td_na"]').val(td_na);
 						jQuery('input[name="td_zn"]').val(td_zn);
 						jQuery('input[name="td_cho"]').val(td_cho);
                        jQuery('.loading-web').addClass('hidden');
                    }
                }
            });
            }else{
            	jQuery('input[name="td_ma9"]').val("0");
            	td_e9=td_e9-number18; 
            	td_p9=td_p9-number28;
            	td_l9=td_l9-number38;
            	td_g9=td_g9-number48;
            	td_fe9=td_fe9-number58;
            	td_xo9=td_xo9-number68;
            	td_ca9=td_ca9-number78;
            	td_na9=td_na9-number88;
            	td_zn9=td_zn9-number98;
            	td_cho9=td_cho9-number108;
                td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            	td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            	td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            	td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            	td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            	td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            	td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            	td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            	td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            	td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 				jQuery('input[name="td_e"]').val(td_e);
 				jQuery('input[name="td_p"]').val(td_p);
 				jQuery('input[name="td_g"]').val(td_g);
 				jQuery('input[name="td_l"]').val(td_l);
 				jQuery('input[name="td_fe"]').val(td_fe);
 				jQuery('input[name="td_xo"]').val(td_xo);
 				jQuery('input[name="td_ca"]').val(td_ca);
 				jQuery('input[name="td_na"]').val(td_na);
 				jQuery('input[name="td_zn"]').val(td_zn);
 				jQuery('input[name="td_cho"]').val(td_cho);
            }
        });
jQuery('select.vb-nl-sl10').change(function() {        
            if(jQuery('select.vb-nl-sl10 option:selected').val()!="Món ăn"){
            	jQuery('input[name="td_ma10"]').val(jQuery('select.vb-nl-sl10 option:selected').val());
            td_e10=0;td_p10=0;td_l10=0;td_g10=0;td_fe10=0;td_xo10=0;td_ca10=0;td_na10=0;td_zn10=0;td_cho10=0;
            td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 			jQuery('input[name="td_e"]').val(td_e);
 			jQuery('input[name="td_p"]').val(td_p);
 			jQuery('input[name="td_l"]').val(td_l);
 			jQuery('input[name="td_g"]').val(td_g);
 			jQuery('input[name="td_fe"]').val(td_fe);
 			jQuery('input[name="td_xo"]').val(td_xo);
 			jQuery('input[name="td_ca"]').val(td_ca);
 			jQuery('input[name="td_na"]').val(td_na);
 			jQuery('input[name="td_zn"]').val(td_zn);
 			jQuery('input[name="td_cho"]').val(td_cho);
            jQuery.ajax({
                type:"POST",
                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',
                beforeSend: function( xhr ){
                jQuery('.loading-web').removeClass('hidden');
                },
                data:{'sang':jQuery('select.vb-nl-sl10 option:selected').val()},
                success:function(response){ 
                    if (response != 0) {
                        response = JSON.parse(response);
						number19 = Number((response[0].bs_e.match(/\d/g)).join(""));
                        td_e10=number19;
                        number29 = Number((response[0].bs_p.match(/\d/g)).join(""));
                        td_p10=number29;
                        number39 = Number((response[0].bs_l.match(/\d/g)).join(""));
                        td_l10=number39;
                        number49 = Number((response[0].bs_g.match(/\d/g)).join(""));
                        td_g10=number49;
                        number59 = Number((response[0].bs_fe.match(/\d/g)).join(""));
                        td_fe10=number59;
                        number69 = Number((response[0].bs_xo.match(/\d/g)).join(""));
                        td_xo10=number69;
                        number79 = Number((response[0].bs_ca.match(/\d/g)).join(""));
                        td_ca10=number79;
                        number89 = Number((response[0].bs_na.match(/\d/g)).join(""));
                        td_na10=number89;
                        number99 = Number((response[0].bs_zn.match(/\d/g)).join(""));
                        td_zn10=number99;                       
                        number109 = Number((response[0].bs_cho.match(/\d/g)).join(""));
                        td_cho10=number109;
                        td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            			td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            			td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            			td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            			td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            			td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            			td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            			td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            			td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            			td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 						jQuery('input[name="td_e"]').val(td_e);
 						jQuery('input[name="td_p"]').val(td_p);
 						jQuery('input[name="td_g"]').val(td_g);
 						jQuery('input[name="td_l"]').val(td_l);
 						jQuery('input[name="td_fe"]').val(td_fe);
 						jQuery('input[name="td_xo"]').val(td_xo);
 						jQuery('input[name="td_ca"]').val(td_ca);
 						jQuery('input[name="td_na"]').val(td_na);
 						jQuery('input[name="td_zn"]').val(td_zn);
 						jQuery('input[name="td_cho"]').val(td_cho);
                        jQuery('.loading-web').addClass('hidden');
                    }
                }
            });
            }else{
            	jQuery('input[name="td_ma10"]').val("0");
            	td_e10=td_e10-number19; 
            	td_p10=td_p10-number29;
            	td_l10=td_l10-number39;
            	td_g10=td_g10-number49;
            	td_fe10=td_fe10-number59;
            	td_xo10=td_xo10-number69;
            	td_ca10=td_ca10-number79;
            	td_na10=td_na10-number89;
            	td_zn10=td_zn10-number99;
            	td_cho10=td_cho10-number109;
                td_e=td_e1+td_e2+td_e3+td_e4+td_e5+td_e6+td_e7+td_e8+td_e9+td_e10;
            	td_p=td_p1+td_p2+td_p3+td_p4+td_p5+td_p6+td_p7+td_p8+td_p9+td_p10;
            	td_l=td_l1+td_l2+td_l3+td_l4+td_l5+td_l6+td_l7+td_l8+td_l9+td_l10;
            	td_g=td_g1+td_g2+td_g3+td_g4+td_g5+td_g6+td_g7+td_g8+td_g9+td_g10;
            	td_fe=td_fe1+td_fe2+td_fe3+td_fe4+td_fe5+td_fe6+td_fe7+td_fe8+td_fe9+td_fe10;
            	td_xo=td_xo1+td_xo2+td_xo3+td_xo4+td_xo5+td_xo6+td_xo7+td_xo8+td_xo9+td_xo10;
            	td_ca=td_ca1+td_ca2+td_ca3+td_ca4+td_ca5+td_ca6+td_ca7+td_ca8+td_ca9+td_ca10;
            	td_na=td_na1+td_na2+td_na3+td_na4+td_na5+td_na6+td_na7+td_na8+td_na9+td_na10;
            	td_zn=td_zn1+td_zn2+td_zn3+td_zn4+td_zn5+td_zn6+td_zn7+td_zn8+td_zn9+td_zn10;
            	td_cho=td_cho1+td_cho2+td_cho3+td_cho4+td_cho5+td_cho6+td_cho7+td_cho8+td_cho9+td_cho10;
 				jQuery('input[name="td_e"]').val(td_e);
 				jQuery('input[name="td_p"]').val(td_p);
 				jQuery('input[name="td_g"]').val(td_g);
 				jQuery('input[name="td_l"]').val(td_l);
 				jQuery('input[name="td_fe"]').val(td_fe);
 				jQuery('input[name="td_xo"]').val(td_xo);
 				jQuery('input[name="td_ca"]').val(td_ca);
 				jQuery('input[name="td_na"]').val(td_na);
 				jQuery('input[name="td_zn"]').val(td_zn);
 				jQuery('input[name="td_cho"]').val(td_cho);
            }
        });
	</script>
    <?php
}
<?php if (!empty($_GET['edit_nguyen_lieu']) && current_user_can( 'administrator' )): ?>

	<div class="wrap">

		<form action="" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">

			<?php global $wpdb;

			if (!empty($_POST['save'])):
				require 'upload-photo.php';
				$rs_anh = $wpdb->get_results('SELECT * FROM wp_nguyen_lieu WHERE id="'.$_GET['edit_nguyen_lieu'].'";');
				$rs_anh = json_decode(json_encode($rs_anh), true);
				if (empty($_FILES['profilepicture']['tmp_name'])){
					$new_file_path = $rs_anh[0]['nl_anh_av'];
					$av_id = $rs_anh[0]['nl_anh_av_id'];
				}
				if (empty($_FILES['profilepicture_2']['tmp_name'])){
					$new_file_path_2 = $rs_anh[0]['nl_anh_if'];
					$if_id = $rs_anh[0]['nl_anh_if_id'];
				}
				$update = $wpdb->update( 

		            $wpdb->prefix.'nguyen_lieu',

		            array(

		                'nl_ten' => $_POST['nl_ten'],

							'nl_nuoc' => $_POST['nl_nuoc'],

							'nl_nang_luong_kcal' => $_POST['nl_nang_luong_kcal'],

							'nl_nang_luong_kj' => $_POST['nl_nang_luong_kj'],

							'nl_protein' => $_POST['nl_protein'],

							'nl_lipid' => $_POST['nl_lipid'],

							'nl_glucid' => $_POST['nl_glucid'],

							'nl_tro' => $_POST['nl_tro'],

							'nl_duong_total' => $_POST['nl_duong_total'],

							'nl_galactoza' => $_POST['nl_galactoza'],

							'nl_maltoza' => $_POST['nl_maltoza'],

							'nl_lactoza' => $_POST['nl_lactoza'],

							'nl_fructoza' => $_POST['nl_fructoza'],

							'nl_glucoza' => $_POST['nl_glucoza'],

							'nl_sacaroza' => $_POST['nl_sacaroza'],

							'nl_calci' => $_POST['nl_calci'],

							'nl_sat' => $_POST['nl_sat'],

							'nl_magie' => $_POST['nl_magie'],

							'nl_mangan' => $_POST['nl_mangan'],

							'nl_phospho' => $_POST['nl_phospho'],

							'nl_kali' => $_POST['nl_kali'],

							'nl_natri' => $_POST['nl_natri'],

							'nl_kem' => $_POST['nl_kem'],

							'nl_dong' => $_POST['nl_dong'],

							'nl_selen' => $_POST['nl_selen'],

							'nl_vitamin_c' => $_POST['nl_vitamin_c'],

							'nl_vitamin_b1' => $_POST['nl_vitamin_b1'],

							'nl_vitamin_b2' => $_POST['nl_vitamin_b2'],

							'nl_vitamin_pp' => $_POST['nl_vitamin_pp'],

							'nl_vitamin_b5' => $_POST['nl_vitamin_b5'],

							'nl_vitamin_b6' => $_POST['nl_vitamin_b6'],

							'nl_vitamin_b9' => $_POST['nl_vitamin_b9'],

							'nl_vitamin_h' => $_POST['nl_vitamin_h'],

							'nl_vitamin_b12' => $_POST['nl_vitamin_b12'],

							'nl_vitamin_a' => $_POST['nl_vitamin_a'],

							'nl_vitamin_d' => $_POST['nl_vitamin_d'],

							'nl_vitamin_e' => $_POST['nl_vitamin_e'],

							'nl_vitamin_k' => $_POST['nl_vitamin_k'],

							'nl_folat' => $_POST['nl_folat'],

							'nl_beta_caroten' => $_POST['nl_beta_caroten'],

							'nl_alpha_caroten' => $_POST['nl_alpha_caroten'],

							'nl_beta_cryptoxanthin' => $_POST['nl_beta_cryptoxanthin'],

							'nl_lycopen' => $_POST['nl_lycopen'],

							'nl_lutein_zeaxanthin' => $_POST['nl_lutein_zeaxanthin'],

							'nl_purin' => $_POST['nl_purin'],

							'nl_isoflavon_total' => $_POST['nl_isoflavon_total'],

							'nl_daidzein' => $_POST['nl_daidzein'],

							'nl_genistein' => $_POST['nl_genistein'],

							'nl_glycetin' => $_POST['nl_glycetin'],

							'nl_acid_beo_no_total' => $_POST['nl_acid_beo_no_total'],

							'nl_palmitic' => $_POST['nl_palmitic'],

							'nl_margaric' => $_POST['nl_margaric'],

							'nl_stearic' => $_POST['nl_stearic'],

							'nl_arachidic' => $_POST['nl_arachidic'],

							'nl_behenic' => $_POST['nl_behenic'],

							'nl_lignoceric' => $_POST['nl_lignoceric'],

							'nl_acid_beo_k_no_1_nd_total' => $_POST['nl_acid_beo_k_no_1_nd_total'],

							'nl_myristoleic' => $_POST['nl_myristoleic'],

							'nl_palmitoleic' => $_POST['nl_palmitoleic'],

							'nl_oleic' => $_POST['nl_oleic'],

							'nl_acid_beo_n_no_n_nd_total' => $_POST['nl_acid_beo_n_no_n_nd_total'],

							'nl_linolenic' => $_POST['nl_linolenic'],

							'nl_arachidonic' => $_POST['nl_arachidonic'],

							'nl_linoleic' => $_POST['nl_linoleic'],

							'nl_eicosapentaenoic' => $_POST['nl_eicosapentaenoic'],

							'nl_docosahexaenoic' => $_POST['nl_docosahexaenoic'],

							'nl_acid_beo_trans_total' => $_POST['nl_acid_beo_trans_total'],

							'nl_cholesterol' => $_POST['nl_cholesterol'],

							'nl_phytosterol' => $_POST['nl_phytosterol'],

							'nl_lysin' => $_POST['nl_lysin'],

							'nl_methionin' => $_POST['nl_methionin'],

							'nl_tryptophan' => $_POST['nl_tryptophan'],

							'nl_phenylalanin' => $_POST['nl_phenylalanin'],

							'nl_threonin' => $_POST['nl_threonin'],

							'nl_valin' => $_POST['nl_valin'],

							'nl_leucin' => $_POST['nl_leucin'],

							'nl_isoleucin' => $_POST['nl_isoleucin'],

							'nl_arginin' => $_POST['nl_arginin'],

							'nl_histidin' => $_POST['nl_histidin'],

							'nl_cystin' => $_POST['nl_cystin'],

							'nl_tyrosin' => $_POST['nl_tyrosin'],

							'nl_alanin' => $_POST['nl_alanin'],

							'nl_acid_aspartic' => $_POST['nl_acid_aspartic'],

							'nl_acid_glutamic' => $_POST['nl_acid_glutamic'],

							'nl_glycin' => $_POST['nl_glycin'],

							'nl_prolin' => $_POST['nl_prolin'],

							'nl_serin' => $_POST['nl_serin'],

							'nl_celluloza' => $_POST['nl_celluloza'],	
							
							'nl_anh_av' => $new_file_path,

							'nl_anh_if' => $new_file_path_2,	

							'nl_anh_av_id' => $av_id,	
												
							'nl_anh_if_id' => $if_id,
							
							'nl_nhom' => $_POST['nl_nhom'],

		            ), 

		            array( 'id' => $_GET['edit_nguyen_lieu'] ), 

		            '%s',

		            '%s'

		        );

		        if (!empty($update)): ?>

					<div class="updated notice is-dismissible"> 

						<p><strong>Đã sửa nguyên liệu.</strong></p>

					</div>

				<?php elseif (!empty($error)): ?>

					<div class="error notice is-dismissible"> 

						<p><strong><?php echo $error; ?></strong></p>

					</div>

				<?php else: ?>

					<div class="error notice is-dismissible"> 

						<p><strong>Sửa nguyên liệu thất bại.</strong></p>

					</div>

				<?php endif;

			endif;

			$result = $wpdb->get_row( 'SELECT * FROM '.$wpdb->prefix.'nguyen_lieu WHERE id = "'.$_GET['edit_nguyen_lieu'].'"' ); ?>

			<h1>Sửa nguyên liệu</h1>

			<?php if (!empty($result)): ?>

				<table class="vb-nhap-nl">

				<tr class="vb-header">

					<td><p><b>Tên nguyên liệu:</b></p></td>
					<td><input type="text" name="nl_ten" style="width: 100%" value="<?php echo $result->nl_ten ?>"></td>
					<?php
						$results_av_id = $wpdb->get_results('SELECT nl_anh_av_id FROM wp_nguyen_lieu WHERE id="'.$_GET['edit_nguyen_lieu'].'";');
						$results_av_id = json_decode(json_encode($results_av_id), true);
						$abc = $results_av_id[0]['nl_anh_av_id'];
						$results_id_img = $wpdb->get_results('SELECT ID FROM wp_posts WHERE post_excerpt="'.$abc.'";');
						$results_id_img = json_decode(json_encode($results_id_img), true);
						$id_id_img = $results_id_img[0]['ID'];
						$image_attributes = wp_get_attachment_image_src( $attachment_id = $id_id_img );
                        if ( $image_attributes ){
							$link_ava =  $image_attributes[0];
						} else {
							$link_ava = '/wp-content/uploads/2020/09/add-image.png';
						} 

						$results_if_id = $wpdb->get_results('SELECT nl_anh_if_id FROM wp_nguyen_lieu WHERE id="'.$_GET['edit_nguyen_lieu'].'";');
						$results_if_id = json_decode(json_encode($results_if_id), true);
						$def = $results_if_id[0]['nl_anh_if_id'];
						$results_id_img_if = $wpdb->get_results('SELECT ID FROM wp_posts WHERE post_excerpt="'.$def.'";');
						$results_id_img_if = json_decode(json_encode($results_id_img_if), true);
						$id_id_img_if = $results_id_img_if[0]['ID'];
						$image_attributes_if = wp_get_attachment_image_src( $attachment_id = $id_id_img_if );
                        if ( $image_attributes_if ){
							$link_ava_if =  $image_attributes_if[0];
						} else {
							$link_ava_if = '/wp-content/uploads/2020/09/add-image.png';
						}
						// edit 
						?>
					<td style='padding-left: 20px;'>
							<p style='width:200px;'>Ảnh nguyên liệu:</p> <input id="imgInp" type="file" name="profilepicture" size="25" style="display: none;" />
							<input type="button" value="Chọn" onclick="document.getElementById('imgInp').click();" />
							<img style='border: 1px solid rgb(118, 118, 118);margin-left: 5px;border-radius: 3px;' id="blah" src="<?php echo $link_ava; ?>" width='50' height='50' />
							<script  type="text/javascript">
							function readURL(input) {
								if (input.files && input.files[0]) {
									var reader = new FileReader();
									
									reader.onload = function(e) {
									jQuery('#blah').attr('src', e.target.result);
									}
									
									reader.readAsDataURL(input.files[0]); // convert to base64 string
								}
							}

							jQuery("#imgInp").change(function() {
								readURL(this);
							});
							</script>
					</td>
					<td style='padding-left: 20px;'>
							<p style='width:200px;'>Ảnh thông tin chi tiết:</p> <input id="imgInp_2" type="file" name="profilepicture_2" size="25" style="display: none;" />
							<input type="button" value="Chọn" onclick="document.getElementById('imgInp_2').click();" />
							<img style='border: 1px solid rgb(118, 118, 118);margin-left: 5px;border-radius: 3px;' id="blah_2" src="<?php echo $link_ava_if; ?>" width='50' height='50' />
							<script  type="text/javascript">
							function readURL_2(input) {
								if (input.files && input.files[0]) {
									var reader_2 = new FileReader();
									
									reader_2.onload = function(e) {
									jQuery('#blah_2').attr('src', e.target.result);
									}
									
									reader_2.readAsDataURL(input.files[0]); // convert to base64 string
								}
							}

							jQuery("#imgInp_2").change(function() {
								readURL_2(this);
							});
							</script>
							
					</td>

				</tr>
                <tr>
				    <td><b>Nhóm thực phẩm</b>
				        <select>
				            <option value="<?php echo $result->nl_nhom ?>">
				                <?php
				                    $vbngom=$result->nl_nhom;
				                    if($vbngom=="nhom-1"){
				                        $vbngom="Ngũ cốc và sản phẩm chế biến";
				                    } else if($vbngom=="nhom-2"){
				                        $vbngom="Khoai củ và sản phẩm chế biến";
				                    }
				                    else if($vbngom=="nhom-3"){
				                        $vbngom="Hạt, quả giàu đạm, béo và sản phẩm chế biến";
				                    }
				                    else if($vbngom=="nhom-4"){
				                        $vbngom="Rau, quả, củ dùng làm rau";
				                    }
				                    else if($vbngom=="nhom-5"){
				                        $vbngom="Quả chín";
				                    }
				                    else if($vbngom=="nhom-6"){
				                        $vbngom="Dầu, mỡ, bơ ";
				                    }
				                    else if($vbngom=="nhom-7"){
				                        $vbngom="Thịt và sản phẩm chế biến ";
				                    }
				                    else if($vbngom=="nhom-8"){
				                        $vbngom="Thủy sản và sản phẩm chế biến ";
				                    }
				                    else if($vbngom=="nhom-9"){
				                        $vbngom="Sữa và sản phẩm chế biến";
				                    }
				                    else if($vbngom=="nhom-10"){
				                        $vbngom="Trứng và sản phẩm chế biến";
				                    }
				                    else if($vbngom=="nhom-11"){
				                        $vbngom="Đồ hộp";
				                    }
				                    else if($vbngom=="nhom-12"){
				                        $vbngom="Đồ ngọt (đường, bánh, mứt, kẹo) ";
				                    }
				                    else if($vbngom=="nhom-13"){
				                        $vbngom="Gia vị, nước chấm";
				                    }
				                    else if($vbngom=="nhom-14"){
				                        $vbngom="Nước giải khát, bia, rượu";
				                    }
				                    echo "$vbngom";
				                ?>
				                
				            </option>
				            <option value="nhom-1">Ngũ cốc và sản phẩm chế biến</option>
				            <option value="nhom-2">Khoai củ và sản phẩm chế biến</option>
				            <option value="nhom-3">Hạt, quả giàu đạm, béo và sản phẩm chế biến</option>
				            <option value="nhom-4">Rau, quả, củ dùng làm rau</option>
				            <option value="nhom-5">Quả chín</option>
				            <option value="nhom-6">Dầu, mỡ, bơ</option>
				            <option value="nhom-7">Thịt và sản phẩm chế biến</option>
				            <option value="nhom-8">Thủy sản và sản phẩm chế biến </option>
				            <option value="nhom-9">Trứng và sản phẩm chế biến</option>
				            <option value="nhom-10">Sữa và sản phẩm chế biến</option>
				            <option value="nhom-11">Đồ hộp</option>
				            <option value="nhom-12">Đồ ngọt (đường, bánh, mứt, kẹo)</option>
				            <option value="nhom-13"> Gia vị, nước chấm</option>
				            <option value="nhom-14">Nước giải khát, bia, rượu</option>
				        </select>
				    </td>
				    <td style="display:none"><input type="text" name="nl_nhom" value="<?php echo $result->nl_nhom ?>"></td>
				</tr>
				<tr>

					<td><b>Nước:</b><input type="text" name="nl_nuoc" value="<?php echo $result->nl_nuoc ?>"></td>

					<td><b>Năng lượng (KCal):</b><input type="text" name="nl_nang_luong_kcal" value="<?php echo $result->nl_nang_luong_kcal ?>"></td>

					<td><b>Năng lượng (KJ):</b><input type="text" name="nl_nang_luong_kj" value="<?php echo $result->nl_nang_luong_kj ?>"></td>

					<td><b>Protein:</b><input type="text" name="nl_protein" value="<?php echo $result->nl_protein ?>"></td>

					<td><b>Lipid:</b><input type="text" name="nl_lipid" value="<?php echo $result->nl_lipid ?>"></td>

					<td><b>Glucid:</b><input type="text" name="nl_glucid" value="<?php echo $result->nl_glucid ?>"></td>

				</tr>

				<tr>

					<td><b>Celluloza:</b><input type="text" name="nl_celluloza" value="<?php echo $result->nl_celluloza ?>"></td>

					<td><b>Tro:</b><input type="text" name="nl_tro" value="<?php echo $result->nl_tro ?>"></td>

					<td><b>Đường tổng số:</b><input type="text" name="nl_duong_total" value="<?php echo $result->nl_duong_total ?>"></td>

					<td><b>Galactoza:</b><input type="text" name="nl_galactoza" value="<?php echo $result->nl_galactoza ?>"></td>

					<td><b>Maltoza:</b><input type="text" name="nl_maltoza" value="<?php echo $result->nl_maltoza ?>"></td>

					<td><b>Lactoza:</b><input type="text" name="nl_lactoza" value="<?php echo $result->nl_lactoza ?>"></td>

				</tr>	

				<tr>

					<td><b>Glucoza:</b><input type="text" name="nl_glucoza" value="<?php echo $result->nl_glucoza ?>"></td>			

					<td><b>Fructoza:</b><input type="text" name="nl_fructoza" value="<?php echo $result->nl_fructoza ?>"></td>

					<td><b>Sacaroza:</b><input type="text" name="nl_sacaroza" value="<?php echo $result->nl_sacaroza ?>"></td>

					<td><b>Calci:</b><input type="text" name="nl_calci" value="<?php echo $result->nl_calci ?>"></td>

					<td><b>Sắt:</b><input type="text" name="nl_sat" value="<?php echo $result->nl_sat ?>"></td>

					<td><b>Magiê:</b><input type="text" name="nl_magie" value="<?php echo $result->nl_magie ?>"></td>

				</tr>	

				<tr>

					<td><b>Mangan:</b><input type="text" name="nl_mangan" value="<?php echo $result->nl_mangan ?>"></td>

					<td><b>Phospho:</b><input type="text" name="nl_phospho" value="<?php echo $result->nl_phospho ?>"></td>				

					<td><b>Kali:</b><input type="text" name="nl_kali" value="<?php echo $result->nl_kali ?>"></td>

					<td><b>Natri:</b><input type="text" name="nl_natri" value="<?php echo $result->nl_natri ?>"></td>

					<td><b>Kẽm:</b><input type="text" name="nl_kem" value="<?php echo $result->nl_kem ?>"></td>

					<td><b>Đồng:</b><input type="text" name="nl_dong" value="<?php echo $result->nl_dong ?>"></td>

				</tr>	

				<tr>

					<td><b>Selen:</b><input type="text" name="nl_selen" value="<?php echo $result->nl_selen ?>"></td>

					<td><b>Vitamin C:</b><input type="text" name="nl_vitamin_c" value="<?php echo $result->nl_vitamin_c ?>"></td>

					<td><b>Vitamin B1:</b><input type="text" name="nl_vitamin_b1" value="<?php echo $result->nl_vitamin_b1 ?>"></td>

					<td><b>Vitamin B2:</b><input type="text" name="nl_vitamin_b2" value="<?php echo $result->nl_vitamin_b2 ?>"></td>

					<td><b>Vitamin PP:</b><input type="text" name="nl_vitamin_pp" value="<?php echo $result->nl_vitamin_pp ?>"></td>

					<td><b>Vitamin B5:</b><input type="text" name="nl_vitamin_b5" value="<?php echo $result->nl_vitamin_b5 ?>"></td>

				</tr>	

				<tr>

					<td><b>Vitamin B6:</b><input type="text" name="nl_vitamin_b6" value="<?php echo $result->nl_vitamin_b6 ?>"></td>

					<td><b>Vitamin B9:</b><input type="text" name="nl_vitamin_b9" value="<?php echo $result->nl_vitamin_b9 ?>"></td>				

					<td><b>Vitamin H:</b><input type="text" name="nl_vitamin_h" value="<?php echo $result->nl_vitamin_h ?>"></td>

					<td><b>Vitamin B12:</b><input type="text" name="nl_vitamin_b12" value="<?php echo $result->nl_vitamin_b12 ?>"></td>

					<td><b>Vitamin A:</b><input type="text" name="nl_vitamin_a" value="<?php echo $result->nl_vitamin_a ?>"></td>

					<td><b>Vitamin D:</b><input type="text" name="nl_vitamin_d" value="<?php echo $result->nl_vitamin_d ?>"></td>

				</tr>	

				<tr>

					<td><b>Vitamin E:</b><input type="text" name="nl_vitamin_e" value="<?php echo $result->nl_vitamin_e ?>"></td>

					<td><b>Vitamin K:</b><input type="text" name="nl_vitamin_k" value="<?php echo $result->nl_vitamin_k ?>"></td>

					<td><b>Folat:</b><input type="text" name="nl_folat" value="<?php echo $result->nl_folat ?>"></td>

					<td><b>Beta-caroten:</b><input type="text" name="nl_beta_caroten" value="<?php echo $result->nl_beta_caroten ?>"></td>

					<td><b>Alpha-caroten:</b><input type="text" name="nl_alpha_caroten" value="<?php echo $result->nl_alpha_caroten ?>"></td>

					<td><b>Beta-cryptoxanthin:</b><input type="text" name="nl_beta_cryptoxanthin" value="<?php echo $result->nl_beta_cryptoxanthin ?>"></td>

				</tr>	

				<tr>

					<td><b>Lycopen:</b><input type="text" name="nl_lycopen" value="<?php echo $result->nl_lycopen ?>"></td>

					<td><b>Lutein + Zeaxanthin:</b><input type="text" name="nl_lutein_zeaxanthin" value="<?php echo $result->nl_lutein_zeaxanthin ?>"></td>

					<td><b>Purin:</b><input type="text" name="nl_purin" value="<?php echo $result->nl_purin ?>"></td>

					<td><b>Tổng số isoflavon:</b><input type="text" name="nl_isoflavon_total" value="<?php echo $result->nl_isoflavon_total ?>"></td>

					<td><b>Daidzein:</b><input type="text" name="nl_daidzein" value="<?php echo $result->nl_daidzein ?>"></td>

					<td><b>Genistein:</b><input type="text" name="nl_genistein" value="<?php echo $result->nl_genistein ?>"></td>

				</tr>	

				<tr>

					<td><b>Glycetin:</b><input type="text" name="nl_glycetin" value="<?php echo $result->nl_glycetin ?>"></td>

					<td><b>Tổng số acid béo no:</b><input type="text" name="nl_acid_beo_no_total" value="<?php echo $result->nl_acid_beo_no_total ?>"></td>

					<td><b>Palmitic:</b><input type="text" name="nl_palmitic" value="<?php echo $result->nl_palmitic ?>"></td>

					<td><b>Margaric:</b><input type="text" name="nl_margaric" value="<?php echo $result->nl_margaric ?>"></td>

					<td><b>Stearic:</b><input type="text" name="nl_stearic" value="<?php echo $result->nl_stearic ?>"></td>

					<td><b>Arachidic:</b><input type="text" name="nl_arachidic" value="<?php echo $result->nl_arachidic ?>"></td>

				</tr>	

				<tr>

					<td><b>Behenic:</b><input type="text" name="nl_behenic" value="<?php echo $result->nl_behenic ?>"></td>

					<td><b>Lignoceric:</b><input type="text" name="nl_lignoceric" value="<?php echo $result->nl_lignoceric ?>"></td>

					<td><b>TS acid béo không no 1 nối đôi:</b><input type="text" name="nl_acid_beo_k_no_1_nd_total" value="<?php echo $result->nl_acid_beo_k_no_1_nd_total ?>"></td>

					<td><b>Myristoleic:</b><input type="text" name="nl_myristoleic" value="<?php echo $result->nl_myristoleic ?>"></td>

					<td><b>Palmitoleic:</b><input type="text" name="nl_palmitoleic" value="<?php echo $result->nl_palmitoleic ?>"></td>

					<td><b>Oleic:</b><input type="text" name="nl_oleic" value="<?php echo $result->nl_oleic ?>"></td>

				</tr>	

				<tr>

					<td><b>TS acid béo không no nhiều nối đôi:</b><input type="text" name="nl_acid_beo_n_no_n_nd_total" value="<?php echo $result->nl_acid_beo_n_no_n_nd_total ?>"></td>

					<td><b>Linoleic:</b><input type="text" name="nl_linoleic" value="<?php echo $result->nl_linoleic ?>"></td>

					<td><b>Linolenic:</b><input type="text" name="nl_linolenic" value="<?php echo $result->nl_linolenic ?>"></td>

					<td><b>Arachidonic:</b><input type="text" name="nl_arachidonic" value="<?php echo $result->nl_arachidonic ?>"></td>

					<td><b>Eicosapentaenoic:</b><input type="text" name="nl_eicosapentaenoic" value="<?php echo $result->nl_eicosapentaenoic ?>"></td>

					<td><b>Docosahexaenoic:</b><input type="text" name="nl_docosahexaenoic" value="<?php echo $result->nl_docosahexaenoic ?>"></td>

				</tr>	

				<tr>

					<td><b>TS acid béo trans:</b><input type="text" name="nl_acid_beo_trans_total" value="<?php echo $result->nl_acid_beo_trans_total ?>"></td>

					<td><b>Cholesterol:</b><input type="text" name="nl_cholesterol" value="<?php echo $result->nl_cholesterol ?>"></td>

					<td><b>Phytosterol:</b><input type="text" name="nl_phytosterol" value="<?php echo $result->nl_phytosterol ?>"></td>

					<td><b>Lysin:</b><input type="text" name="nl_lysin" value="<?php echo $result->nl_lysin ?>"></td>

					<td><b>Methionin:</b><input type="text" name="nl_methionin" value="<?php echo $result->nl_methionin ?>"></td>

					<td><b>Tryptophan:</b><input type="text" name="nl_tryptophan" value="<?php echo $result->nl_tryptophan ?>"></td>

				</tr>	

				<tr>

					<td><b>Phenylalanin:</b><input type="text" name="nl_phenylalanin" value="<?php echo $result->nl_phenylalanin ?>"></td>

					<td><b>Threonin:</b><input type="text" name="nl_threonin" value="<?php echo $result->nl_threonin ?>"></td>

					<td><b>Valin:</b><input type="text" name="nl_valin" value="<?php echo $result->nl_valin ?>"></td>

					<td><b>Leucin:</b><input type="text" name="nl_leucin" value="<?php echo $result->nl_leucin ?>"></td>

					<td><b>Isoleucin:</b><input type="text" name="nl_isoleucin" value="<?php echo $result->nl_isoleucin ?>"></td>

					<td><b>Arginin:</b><input type="text" name="nl_arginin" value="<?php echo $result->nl_arginin ?>"></td>

				</tr>	

				<tr>

					<td><b>Histidin:</b><input type="text" name="nl_histidin" value="<?php echo $result->nl_histidin ?>"></td>

					<td><b>Cystin:</b><input type="text" name="nl_cystin" value="<?php echo $result->nl_cystin ?>"></td>

					<td><b>Tyrosin:</b><input type="text" name="nl_tyrosin" value="<?php echo $result->nl_tyrosin ?>"></td>

					<td><b>Alanin:</b><input type="text" name="nl_alanin" value="<?php echo $result->nl_alanin ?>"></td>

					<td><b>Acid aspartic:</b><input type="text" name="nl_acid_aspartic" value="<?php echo $result->nl_acid_aspartic ?>"></td>

					<td><b>Acid glutamic:</b><input type="text" name="nl_acid_glutamic" value="<?php echo $result->nl_acid_glutamic ?>"></td>

				</tr>	

				<tr>

					<td><b>Glycin:</b><input type="text" name="nl_glycin" value="<?php echo $result->nl_glycin ?>"></td>

					<td><b>Prolin:</b><input type="text" name="nl_prolin" value="<?php echo $result->nl_prolin ?>"></td>

					<td><b>Serin:</b><input type="text" name="nl_serin" value="<?php echo $result->nl_serin ?>"></td>

				</tr>

			</table><br>

		        <input type="submit" name="save" value="Cập nhật" class="button button-primary">

			<?php else: ?>

				<div class="error notice"><p>ID không hợp lệ.</p></div>

			<?php endif ?>

		</form>

	</div>
	 <script type="text/javascript">
	 jQuery('select').change(function(){
	     jQuery('input[name="nl_nhom"]').val(jQuery('select option:selected').val());
	 });
	 </script>
<?php else: ?>

	<div class="wrap"><div class="error notice"><p>ID không hợp lệ hoặc bạn không đủ quyền truy cập.</p></div></div>

<?php endif; ?>
<?php
// Hook for adding admin menus
add_action('admin_menu', 'nhap_nguyen_lieu_add_pages');
// action function for above hook
function nhap_nguyen_lieu_add_pages() {
    add_submenu_page(
        'nguyen_lieu',
        __( 'Nhập nguyên liệu', 'theme-wp' ),
        __( 'Nhập nguyên liệu', 'theme-wp' ),
        'manage_options',
        'nhap_nguyen_lieu',
        'nhap_nguyen_lieu'
    );
}
function nhap_nguyen_lieu(){ ?>
    <div class="wrap">
		<form method="POST" class="form-horizontal" role="form" action="" enctype="multipart/form-data">
			<h1>Nhập nguyên liệu</h1>
			<?php if (!empty($_POST['save'])):
				if (!empty($_POST['nl_ten'])) {
					global $wpdb;
					require 'upload-photo.php';
					$insert = $wpdb->insert( 
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
						'%s'
					);
				}  else {
					$error = 'Không đủ dữ liệu';
				}
				if (!empty($insert)): ?>
					<div class="updated notice is-dismissible"> 
						<p><strong>Thêm nguyên liệu thành công.</strong></p>
					</div>
				<?php elseif (!empty($error)): ?>
					<div class="error notice is-dismissible"> 
						<p><strong><?php echo $error; ?></strong></p>
					</div>
				<?php else: ?>
					<div class="error notice is-dismissible"> 
						<p><strong>Thêm nguyên liệu thất bại. Tên nguyên liệu đã tồn tại</strong></p>
					</div>
				<?php endif;
			endif; ?>
			<table class="vb-nhap-nl">
				<tr class="vb-header">
					<td><b>Tên nguyên liệu:</b></td>
					<td><input type="text" name="nl_ten" style="width: 100%"></td>
					<td>
							Ảnh nguyên liệu: <input id="imgInp" type="file" name="profilepicture" size="25" style="display: none;" />
							<input type="button" value="Chọn" onclick="document.getElementById('imgInp').click();" />
							<img id="blah" src="#" width='50' height='50' />
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
					<td>
							Ảnh thông tin chi tiết: <input id="imgInp_2" type="file" name="profilepicture_2" size="25" style="display: none;" />
							<input type="button" value="Chọn" onclick="document.getElementById('imgInp_2').click();" />
							<img id="blah_2" src="#" width='50' height='50' />
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
				            <option value="nhom-1"> Ngũ cốc và sản phẩm chế biến</option>
				            <option value="nhom-2"> Khoai củ và sản phẩm chế biến </option>
				            <option value="nhom-3">Hạt, quả giàu đạm, béo và sản phẩm chế biến  </option>
				            <option value="nhom-4">Rau, quả, củ dùng làm rau </option>
				            <option value="nhom-5">Quả chín </option>
				            <option value="nhom-6">Dầu, mỡ, bơ   </option>
				            <option value="nhom-7">Thịt và sản phẩm chế biến  </option>
				            <option value="nhom-8">Thủy sản và sản phẩm chế biến </option>
				            <option value="nhom-9">Trứng và sản phẩm chế biến</option>
				            <option value="nhom-10">Sữa và sản phẩm chế biến </option>
				            <option value="nhom-11">Đồ hộp</option>
				            <option value="nhom-12">Đồ ngọt (đường, bánh, mứt, kẹo) </option>
				            <option value="nhom-13"> Gia vị, nước chấm </option>
				            <option value="nhom-14">Nước giải khát, bia, rượu </option>
				            
				        </select>
				    </td>
				    <td style="display:none"><input type="text" name="nl_nhom" value="nhom-1"></td>
				</tr>
				<tr>
					<td><b>Nước:</b><input type="text" name="nl_nuoc"></td>
					<td><b>Năng lượng (KCal):</b><input type="text" name="nl_nang_luong_kcal"></td>
					<td><b>Năng lượng (KJ):</b><input type="text" name="nl_nang_luong_kj"></td>
					<td><b>Protein:</b><input type="text" name="nl_protein"></td>
					<td><b>Lipid:</b><input type="text" name="nl_lipid"></td>
					<td><b>Glucid:</b><input type="text" name="nl_glucid"></td>
				</tr>
				<tr>
					<td><b>Celluloza:</b><input type="text" name="nl_celluloza"></td>
					<td><b>Tro:</b><input type="text" name="nl_tro"></td>
					<td><b>Đường tổng số:</b><input type="text" name="nl_duong_total"></td>
					<td><b>Galactoza:</b><input type="text" name="nl_galactoza"></td>
					<td><b>Maltoza:</b><input type="text" name="nl_maltoza"></td>
					<td><b>Lactoza:</b><input type="text" name="nl_lactoza"></td>
				</tr>	
				<tr>
					<td><b>Glucoza:</b><input type="text" name="nl_glucoza"></td>			
					<td><b>Fructoza:</b><input type="text" name="nl_fructoza"></td>
					<td><b>Sacaroza:</b><input type="text" name="nl_sacaroza"></td>
					<td><b>Calci:</b><input type="text" name="nl_calci"></td>
					<td><b>Sắt:</b><input type="text" name="nl_sat"></td>
					<td><b>Magiê:</b><input type="text" name="nl_magie"></td>
				</tr>	
				<tr>
					<td><b>Mangan:</b><input type="text" name="nl_mangan"></td>
					<td><b>Phospho:</b><input type="text" name="nl_phospho"></td>				
					<td><b>Kali:</b><input type="text" name="nl_kali"></td>
					<td><b>Natri:</b><input type="text" name="nl_natri"></td>
					<td><b>Kẽm:</b><input type="text" name="nl_kem"></td>
					<td><b>Đồng:</b><input type="text" name="nl_dong"></td>
				</tr>	
				<tr>
					<td><b>Selen:</b><input type="text" name="nl_selen"></td>
					<td><b>Vitamin C:</b><input type="text" name="nl_vitamin_c"></td>
					<td><b>Vitamin B1:</b><input type="text" name="nl_vitamin_b1"></td>
					<td><b>Vitamin B2:</b><input type="text" name="nl_vitamin_b2"></td>
					<td><b>Vitamin PP:</b><input type="text" name="nl_vitamin_pp"></td>
					<td><b>Vitamin B5:</b><input type="text" name="nl_vitamin_b5"></td>
				</tr>	
				<tr>
					<td><b>Vitamin B6:</b><input type="text" name="nl_vitamin_b6"></td>
					<td><b>Vitamin B9:</b><input type="text" name="nl_vitamin_b9"></td>				
					<td><b>Vitamin H:</b><input type="text" name="nl_vitamin_h"></td>
					<td><b>Vitamin B12:</b><input type="text" name="nl_vitamin_b12"></td>
					<td><b>Vitamin A:</b><input type="text" name="nl_vitamin_a"></td>
					<td><b>Vitamin D:</b><input type="text" name="nl_vitamin_d"></td>
				</tr>	
				<tr>
					<td><b>Vitamin E:</b><input type="text" name="nl_vitamin_e"></td>
					<td><b>Vitamin K:</b><input type="text" name="nl_vitamin_k"></td>
					<td><b>Folat:</b><input type="text" name="nl_folat"></td>
					<td><b>Beta-caroten:</b><input type="text" name="nl_beta_caroten"></td>
					<td><b>Alpha-caroten:</b><input type="text" name="nl_alpha_caroten"></td>
					<td><b>Beta-cryptoxanthin:</b><input type="text" name="nl_beta_cryptoxanthin"></td>
				</tr>	
				<tr>
					<td><b>Lycopen:</b><input type="text" name="nl_lycopen"></td>
					<td><b>Lutein + Zeaxanthin:</b><input type="text" name="nl_lutein_zeaxanthin"></td>
					<td><b>Purin:</b><input type="text" name="nl_purin"></td>
					<td><b>Tổng số isoflavon:</b><input type="text" name="nl_isoflavon_total"></td>
					<td><b>Daidzein:</b><input type="text" name="nl_daidzein"></td>
					<td><b>Genistein:</b><input type="text" name="nl_genistein"></td>
				</tr>	
				<tr>
					<td><b>Glycetin:</b><input type="text" name="nl_glycetin"></td>
					<td><b>Tổng số acid béo no:</b><input type="text" name="nl_acid_beo_no_total"></td>
					<td><b>Palmitic:</b><input type="text" name="nl_palmitic"></td>
					<td><b>Margaric:</b><input type="text" name="nl_margaric"></td>
					<td><b>Stearic:</b><input type="text" name="nl_stearic"></td>
					<td><b>Arachidic:</b><input type="text" name="nl_arachidic"></td>
				</tr>	
				<tr>
					<td><b>Behenic:</b><input type="text" name="nl_behenic"></td>
					<td><b>Lignoceric:</b><input type="text" name="nl_lignoceric"></td>
					<td><b>TS acid béo không no 1 nối đôi:</b><input type="text" name="nl_acid_beo_k_no_1_nd_total"></td>
					<td><b>Myristoleic:</b><input type="text" name="nl_myristoleic"></td>
					<td><b>Palmitoleic:</b><input type="text" name="nl_palmitoleic"></td>
					<td><b>Oleic:</b><input type="text" name="nl_oleic"></td>
				</tr>	
				<tr>
					<td><b>TS acid béo không no nhiều nối đôi:</b><input type="text" name="nl_acid_beo_n_no_n_nd_total"></td>
					<td><b>Linoleic:</b><input type="text" name="nl_linoleic"></td>
					<td><b>Linolenic:</b><input type="text" name="nl_linolenic"></td>
					<td><b>Arachidonic:</b><input type="text" name="nl_arachidonic"></td>
					<td><b>Eicosapentaenoic:</b><input type="text" name="nl_eicosapentaenoic"></td>
					<td><b>Docosahexaenoic:</b><input type="text" name="nl_docosahexaenoic"></td>
				</tr>	
				<tr>
					<td><b>TS acid béo trans:</b><input type="text" name="nl_acid_beo_trans_total"></td>
					<td><b>Cholesterol:</b><input type="text" name="nl_cholesterol"></td>
					<td><b>Phytosterol:</b><input type="text" name="nl_phytosterol"></td>
					<td><b>Lysin:</b><input type="text" name="nl_lysin"></td>
					<td><b>Methionin:</b><input type="text" name="nl_methionin"></td>
					<td><b>Tryptophan:</b><input type="text" name="nl_tryptophan"></td>
				</tr>	
				<tr>
					<td><b>Phenylalanin:</b><input type="text" name="nl_phenylalanin"></td>
					<td><b>Threonin:</b><input type="text" name="nl_threonin"></td>
					<td><b>Valin:</b><input type="text" name="nl_valin"></td>
					<td><b>Leucin:</b><input type="text" name="nl_leucin"></td>
					<td><b>Isoleucin:</b><input type="text" name="nl_isoleucin"></td>
					<td><b>Arginin:</b><input type="text" name="nl_arginin"></td>
				</tr>	
				<tr>
					<td><b>Histidin:</b><input type="text" name="nl_histidin"></td>
					<td><b>Cystin:</b><input type="text" name="nl_cystin"></td>
					<td><b>Tyrosin:</b><input type="text" name="nl_tyrosin"></td>
					<td><b>Alanin:</b><input type="text" name="nl_alanin"></td>
					<td><b>Acid aspartic:</b><input type="text" name="nl_acid_aspartic"></td>
					<td><b>Acid glutamic:</b><input type="text" name="nl_acid_glutamic"></td>
				</tr>	
				<tr>
					<td><b>Glycin:</b><input type="text" name="nl_glycin"></td>
					<td><b>Prolin:</b><input type="text" name="nl_prolin"></td>
					<td><b>Serin:</b><input type="text" name="nl_serin"></td>
				</tr>
			</table>
	        <input type="submit" name="save" value="Thêm nguyên liệu" class="button button-primary">
		</form>
	</div>
	 <script type="text/javascript">
	 jQuery('select').change(function(){
	     jQuery('input[name="nl_nhom"]').val(jQuery('select option:selected').val());
	 });
	 </script>
    <?php
}
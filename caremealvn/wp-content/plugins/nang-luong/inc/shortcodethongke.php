<?php
// Shortcode
function create_shortcode_thong_ke() {
    ob_start();
    global $wpdb;
    $vbusser=wp_get_current_user();
    $list_sang = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'bua_sang WHERE bs_true = "1" AND bs_ten IS NOT NULL GROUP BY bs_ten ORDER BY bs_ten ASC' );
    $list_toi = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'bua_sang WHERE bs_true != "1" AND bs_ten IS NOT NULL GROUP BY bs_ten ORDER BY bs_ten ASC' );
    $list_ngay = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'thuc_don');
    $tra_cuu = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'thong_ke ORDER BY ngay ASC');
    ?>
    <div class="row row-large ">
      <div class="large-12 col">
        <div class="col-inner">
        	<div class="vb-nhap-thong-tin-main">
        	<div class="vb-nhap-thong-tin-bg">
        	</div>	
          <div id="vb-nhap-thong-tin">
              <?php if (!empty($_POST['save'])):
                $insert = $wpdb->insert( 
                  $wpdb->prefix.'thong_ke', 
                  array( 
                    'user_id' => $vbusser->ID,
                    'ngay' => $_POST['td_ngay'],
                    'thang' => $_POST['thang'],
                    'an_sang' => $_POST['an_sang'],
                    'sang_e' => $_POST['sang_e'],
                    'sang_p' => $_POST['sang_p'], 
                    'sang_g' => $_POST['sang_g'],  
                    'sang_l' => $_POST['sang_l'], 
                    'an_trua' => $_POST['an_trua'],
                    'trua_e' => $_POST['trua_e'],     
                    'trua_p' => $_POST['trua_p'],
                    'trua_g' => $_POST['trua_g'],
                    'trua_l' => $_POST['trua_l'],
                    'an_toi' => $_POST['an_toi'],
                    'toi_e' => $_POST['toi_e'],
                    'toi_p' => $_POST['toi_p'],
                    'toi_g' => $_POST['toi_g'],
                    'toi_l' => $_POST['toi_l'],
                    'tong_e' => $_POST['tong_e'],
                    'tong_p' => $_POST['tong_p'],
                    'tong_g' => $_POST['tong_g'],
                    'tong_l' => $_POST['tong_l'],
                  ), 
                  '%s'
                ); 
        if (!empty($insert)): ?>
         	<script type="text/javascript"> 
            	alert("Thêm thông tin thành công");
         	</script>
        <?php elseif (!empty($error)): ?>
			<script type="text/javascript"> 
            	alert("<?php echo $error; ?>");
         	</script>
        <?php else: ?>
         	<script type="text/javascript"> 
            	alert("Thêm thông tin thất bại. Ngày <?php echo $_POST['td_ngay']; ?> đã có trong CSDL");
         	</script>
        <?php endif;               
              endif; ?>
    <form method="POST" class="form-horizontal" role="form" action="" enctype="multipart/form-data">
       <h2>Nhập thông tin</h2><i class="far fa-times-circle"></i>
      <table class="vb-nhap-nl">
      	<tr>
      		<td><b>Ngày:</b></td>
      		<td>
      			<input type="date" id="dt" onchange="mydate2();">
           		<input type="text" id="ndt" name="td_ngay" style="display: none !important">
           		<input type="text" id="ndtthang" name="thang" style="display: none !important">
      		</td>
      	</tr>
      	<tr class="vb-header">
      		<th>Bữa ăn</th>
      		<th>Món ăn</th>
      		<th>Năng lượng</th>
      		<th>Protein</th>
      		<th>Glucid</th>
      		<th>Lipid</th>
      	</tr>
        <tr class="vb-sang">
          <td><b>Ăn Sáng: </b></td>
          <td><select class="vb-nl-sl1">
               <option value="Món ăn">Món ăn</option>
                <?php if (!empty($list_sang)): ?>
                    <?php foreach ($list_sang as $key => $value): ?>
                      <option<?php echo !empty($_REQUEST['bs_ten']) && $_REQUEST['bs_ten'] == $value->bs_ten ? ' selected=""' : '' ?> value="<?php echo $value->bs_ten ?>"><?php echo $value->bs_ten ?></option>
                    <?php endforeach ?>
                <?php endif ?>
            </select> 
          </td>
            <td style="display: none"><input type="text" name="an_sang"  value="0"></td>
            <td><input type="text" name="sang_e"></td>
            <td><input type="text" name="sang_p"></td>
            <td><input type="text" name="sang_g"></td>
            <td><input type="text" name="sang_l"></td>
        </tr>    

        <tr class="vb-trua">
          <td><b>Ăn trưa:</b>
            </td>
            <td><input type="text" name="an_trua"></td>
            <td><input type="text" name="trua_e"></td>
            <td><input type="text" name="trua_p"></td>
            <td><input type="text" name="trua_g"></td>
            <td><input type="text" name="trua_l">
          </td>
        </tr>

        <tr class="vb-toi">
          <td><b>Ăn tối:</b></td>
          <td><select class="vb-nl-sl2">
               <option value="Món ăn">Món ăn</option>
                <?php if (!empty($list_toi)): ?>
                    <?php foreach ($list_toi as $key => $value): ?>
                      <option<?php echo !empty($_REQUEST['bs_ten']) && $_REQUEST['bs_ten'] == $value->bs_ten ? ' selected=""' : '' ?> value="<?php echo $value->bs_ten ?>"><?php echo $value->bs_ten ?></option>
                    <?php endforeach ?>
                <?php endif ?>
            </select> 
          </td>
            <td style="display: none"><input type="text" name="an_toi"  value="0"></td>
            <td><input type="text" name="toi_e"></td>
            <td><input type="text" name="toi_p"></td>
            <td><input type="text" name="toi_g"></td>
            <td><input type="text" name="toi_l"></td>
            
        </tr>      
        <tr class="vb-header">
          <td><b>Tổng</b></td>
          <td></td>
            <td><input type="text" name="tong_e" style="width: 100%; display: none"></td>
            <td><input type="text" name="tong_p" style="width: 100%; display: none"></td>
            <td><input type="text" name="tong_g" style="width: 100%; display: none"></td>
            <td><input type="text" name="tong_l" style="width: 100%; display: none">
          </td>
        </tr>              
      </table>
          <input type="submit" name="save" value="Thêm" class="button button-primary">
           </form>
          </div>
        </div>
    </div>
      </div>
    <div class="large-12 col">
        <div class="col-inner">
				<h2 class="vb-title-h2__fix">Tra cứu dinh dưỡng</h2>
        </div>
    </div>
    </div>
    <div id="vb-flex-fix" class="row row-small ">
      <div class="large-2 col">
        <div class="col-inner">       
          <div class="vb-tracuu__thang">
          	<?php 
          	$vb_check_month_year=[];
          	if (!empty($tra_cuu)): ?>
                    <?php foreach ($tra_cuu as $key => $value): ?>
                    <?php 
                    $vb_check_date = $value->ngay; 
                    array_push($vb_check_month_year,substr($vb_check_date,3,7));
                    ?>
                    <?php endforeach ;
                    $vb_check_month_year=array_unique($vb_check_month_year);
                    $vb_check_month_year=array_values($vb_check_month_year); 
                    for($i=count($vb_check_month_year)-1;$i>=0;$i--){ ?>
                    	<div class="vb-month-year">
                    		<h3><?php echo "Tháng ".$vb_check_month_year[$i]; ?></h3>
                    			
                    	</div>
                    <?php } ?>
                <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="large-10 col">
      	<div class="col-inner">
      		<div class="vb-fill"></div>
      	</div>
      </div>
    </div>
    <div class="loading-web hidden">
      <table style="height: 100vh">
        <tr>
          <td class="text-center"><div class="lds-hourglass"></div></td>
        </tr>
      </table>
    </div>
    <style type="text/css">
      .loading-web{
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        z-index: 999999;
        background: rgba(0,0,0, .5);
      }
      .lds-hourglass {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
      }
      .lds-hourglass:after {
        content: " ";
        display: block;
        border-radius: 50%;
        width: 0;
        height: 0;
        margin: 8px;
        box-sizing: border-box;
        border: 32px solid #fff;
        border-color: #fff transparent #fff transparent;
        animation: lds-hourglass 1.2s infinite;
      }
      @keyframes lds-hourglass {
        0% {
          transform: rotate(0);
          animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
        }
        50% {
          transform: rotate(900deg);
          animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
        }
        100% {
          transform: rotate(1800deg);
        }
      }

    </style>
    <script type="text/javascript" src="/wp-content/themes/flatsome-child/highcharts.js">
    </script>
    <script type="text/javascript">
      let tong_e=0, tong_p=0, tong_g=0,tong_l=0;
      //Lấy thực đơn từ ngày
      function mydate2(){
          d=new Date(document.getElementById("dt").value);
          dt=d.getDate();
          mn=d.getMonth();
          mn++;
          yy=d.getFullYear();
          if(dt<10){
            if(mn<10){
              document.getElementById("ndt").value="0"+dt+"/0"+mn+"/"+yy;
              document.getElementById("ndtthang").value="0"+mn+"/"+yy;
            }
            else{
              document.getElementById("ndt").value="0"+dt+"/"+mn+"/"+yy;
              document.getElementById("ndtthang").value=mn+"/"+yy;
            }
          }else if(mn<10){
             document.getElementById("ndt").value=dt+"/0"+mn+"/"+yy;
             document.getElementById("ndtthang").value="0"+mn+"/"+yy;
          } else{
             document.getElementById("ndt").value=dt+"/"+mn+"/"+yy;
              document.getElementById("ndtthang").value=mn+"/"+yy;
          }
          jQuery.ajax({
            type:"POST",
            url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',
            beforeSend: function( xhr ){
            jQuery('.loading-web').removeClass('hidden');
            },
            data:{'ngay':jQuery('input[name="td_ngay"]').val().trim()},
            success:function(response){ 
                if (response != 0) {
                    response = JSON.parse(response);
                    var an_trua="";
                    if(response[0].td_ma1 !=0){
                    	an_trua+=response[0].td_ma1+ ",";
                    }
                    if(response[0].td_ma2 !=0){
                    	an_trua+=response[0].td_ma2+ ",";
                    }
                    if(response[0].td_ma3 !=0){
                    	an_trua+=response[0].td_ma3+ ",";
                    }
                    if(response[0].td_ma4 !=0){
                    	an_trua+=response[0].td_ma4+ ",";
                    }
                    if(response[0].td_ma5 !=0){
                    	an_trua+=response[0].td_ma5+ ",";
                    }
                    if(response[0].td_ma6 !=0){
                    	an_trua+=response[0].td_ma6+ ",";
                    }
                    if(response[0].td_ma7 !=0){
                    	an_trua+=response[0].td_ma7+ ",";
                    }
                    if(response[0].td_ma8 !=0){
                    	an_trua+=response[0].td_ma8+ ",";
                    }
                    if(response[0].td_ma9 !=0){
                    	an_trua+=response[0].td_ma9+ ",";
                    }
                    if(response[0].td_ma10 !=0){
                    	an_trua+=response[0].td_ma10+ ",";
                    }
                    jQuery('input[name="an_trua"]').val(an_trua);
                    jQuery('input[name="trua_e"]').val(response[0].td_e+"kcal");
                    jQuery('input[name="trua_p"]').val(response[0].td_p+"g");
                    jQuery('input[name="trua_g"]').val(response[0].td_g+"g");
                    jQuery('input[name="trua_l"]').val(response[0].td_l+"g"); 
                    ketquatk();                         
                    jQuery('.loading-web').addClass('hidden');
                } else{
                	alert("Ngày cuối tuần không có thực đơn ở trường");
                	jQuery('input[name="an_trua"]').val("");
                    jQuery('input[name="trua_e"]').val("");
                    jQuery('input[name="trua_p"]').val("");
                    jQuery('input[name="trua_g"]').val("");
                    jQuery('input[name="trua_l"]').val(""); 
                    ketquatk();                         
                	jQuery('.loading-web').addClass('hidden');
                }
            }
          });
      }
      //Lấy dữ liệu ăn sáng
      jQuery('select.vb-nl-sl1').change(function() {        
        if(jQuery('select.vb-nl-sl1 option:selected').val()!="Món ăn"){
          jQuery('input[name="an_sang"]').val(jQuery('select.vb-nl-sl1 option:selected').val());
          jQuery.ajax({
            type:"POST",
            url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',
            beforeSend: function( xhr ){
            jQuery('.loading-web').removeClass('hidden');
            },
            data:{'sang':jQuery('input[name="an_sang"]').val().trim()},
            success:function(response){ 
                if (response != 0) {
                    response = JSON.parse(response);
                    jQuery('input[name="sang_e"]').val(response[0].bs_e);
                    jQuery('input[name="sang_p"]').val(response[0].bs_p);
                    jQuery('input[name="sang_g"]').val(response[0].bs_g);
                    jQuery('input[name="sang_l"]').val(response[0].bs_l);  
                    ketquatk();                        
                    jQuery('.loading-web').addClass('hidden');
                }
            }
          });
        }
      });
      //Lấy dữ liệu ăn tối
      jQuery('select.vb-nl-sl2').change(function() {        
        if(jQuery('select.vb-nl-sl2 option:selected').val()!="Món ăn"){
          jQuery('input[name="an_toi"]').val(jQuery('select.vb-nl-sl2 option:selected').val());
          jQuery.ajax({
            type:"POST",
            url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',
            beforeSend: function( xhr ){
            jQuery('.loading-web').removeClass('hidden');
            },
            data:{'sang':jQuery('input[name="an_toi"]').val().trim()},
            success:function(response){ 
                if (response != 0) {
                    response = JSON.parse(response);
                    jQuery('input[name="toi_e"]').val(response[0].bs_e);
                    jQuery('input[name="toi_p"]').val(response[0].bs_p);
                    jQuery('input[name="toi_g"]').val(response[0].bs_g);
                    jQuery('input[name="toi_l"]').val(response[0].bs_l); 
                    ketquatk();                       
                    jQuery('.loading-web').addClass('hidden');
                }
            }
          });
        }
      });
      //Tính tổng
      function ketquatk(){
            //Lấy dữ liệu năng lượng món sáng
            var sang_e = Number(jQuery('input[name="sang_e"]').val().replace(/[^0-9.]+/ig, ""));
            var sang_p = Number(jQuery('input[name="sang_p"]').val().replace(/[^0-9.]+/ig, ""));
            var sang_g = Number(jQuery('input[name="sang_g"]').val().replace(/[^0-9.]+/ig, ""));
            var sang_l = Number(jQuery('input[name="sang_l"]').val().replace(/[^0-9.]+/ig, ""));

            //Lấy dữ liệu năng lượng món trưa
            var trua_e = Number(jQuery('input[name="trua_e"]').val().replace(/[^0-9.]+/ig, ""));
            var trua_p = Number(jQuery('input[name="trua_p"]').val().replace(/[^0-9.]+/ig, ""));
            var trua_g = Number(jQuery('input[name="trua_g"]').val().replace(/[^0-9.]+/ig, ""));
            var trua_l = Number(jQuery('input[name="trua_l"]').val().replace(/[^0-9.]+/ig, ""));

            //Lấy dữ liệu năng lượng món tối
            var toi_e = Number(jQuery('input[name="toi_e"]').val().replace(/[^0-9.]+/ig, ""));
            var toi_p = Number(jQuery('input[name="toi_p"]').val().replace(/[^0-9.]+/ig, ""));
            var toi_g = Number(jQuery('input[name="toi_g"]').val().replace(/[^0-9.]+/ig, ""));
            var toi_l = Number(jQuery('input[name="toi_l"]').val().replace(/[^0-9.]+/ig, ""));
           
            //Tổng
            var tong_e=jQuery('input[name="tong_e"]').val(Math.round((sang_e+trua_e+toi_e)*100)/100+"kcal");
            var tong_p=jQuery('input[name="tong_p"]').val(Math.round((sang_p+trua_p+toi_p)*100)/100+"g");
            var tong_g=jQuery('input[name="tong_g"]').val(Math.round((sang_g+trua_g+toi_g)*100)/100+"g");
            var tong_l=jQuery('input[name="tong_l"]').val(Math.round((sang_l+trua_l+toi_l)*100)/100+"g");
        }
        //Show/Hide form nhập liệu
        jQuery('#vb-add_dl').click(function(e){
        	e.preventDefault();
        	jQuery('.vb-nhap-thong-tin-main').css({
        		"top": "0",
        		"z-index": "999",
    			"opacity": "1",
    			"visibility": "visible",
    			"transition": "all ease-in-out 0.3s"
        	});
        })
        jQuery('.vb-nhap-thong-tin-bg').click(function(){
        	jQuery('.vb-nhap-thong-tin-main').css({
        		"top": "100%",
        		"z-index": "0",
    			"opacity": "0",
    			"visibility": "hidden",
    			"transition": "all ease-in-out 0.3s"
        	});
        })
        jQuery('#vb-nhap-thong-tin .fa-times-circle').click(function(){
        	jQuery('.vb-nhap-thong-tin-main').css({
        		"top": "100%",
        		"z-index": "0",
    			"opacity": "0",
    			"visibility": "hidden",
    			"transition": "all ease-in-out 0.3s"
        	});
        });
jQuery('.vb-month-year').each(function(){
	jQuery(this).find('h3').click(function(){
		jQuery('.vb-show__tk').removeClass('vb-show__tk');
		jQuery(this).parent().addClass('vb-show__tk');
		jQuery('.vb-fill').html('');
		var thang=jQuery(this).text().slice(6).trim(); console.log(thang);
        jQuery.ajax({
            type:"POST",
            url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thong-ke.php',
            beforeSend: function( xhr ){
            jQuery('.loading-web').removeClass('hidden');
            },
            data:{'thang':thang},
            success:function(response){ 
                if (response != 0) {
                    response = JSON.parse(response); 
                    jQuery('.vb-fill').append('<figure class="highcharts-figure"><div id="container"></div><p class="highcharts-description"></p></figure>');
                    var cate=[],nangluong=[],protein=[],glucid=[],lipid=[];
                    for(j=0;j < response.length;j++){
    					cate[j]	=response[j].ngay+"<p>("+response[j].tong_e+")</p>";
    					protein[j]=Number(response[j].tong_p.replace(/[^0-9.]+/ig, ""));
    					glucid[j]=Number(response[j].tong_g.replace(/[^0-9.]+/ig, ""));
    					lipid[j]=Number(response[j].tong_l.replace(/[^0-9.]+/ig, ""));
    				}
                     //Biểu đồ
					Highcharts.chart('container', {
  						chart: {
    						type: 'column'
  						},
  						title: {
    						text: 'Thống kê tháng '+response[0].thang
  						},
  						xAxis: {
    						categories: cate,
    						crosshair: true
  						},
  						yAxis: {
    						min: 0,
    						title: {
      						text: 'Mass (g)'
    						}
  						},
  						tooltip: {
    						headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
    						pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y:.1f} g</b></td></tr>',
    						footerFormat: '</table>',
    						shared: true,
    						useHTML: true
  						},
  						plotOptions: {
    						column: {
      						pointPadding: 0.2,
      						borderWidth: 0
    						}
  						},
 						 series: [{
   						 name: 'Protein',
    						data: protein

  						}, {
   						 name: 'Glucid',
    						data: glucid

  						}, {
   						 name: 'Lipid',
   						 data: lipid

  						}]
					});                      
                    jQuery('.loading-web').addClass('hidden');
                }
            }
          });
	});
});
	jQuery(window).load(function(){
		var today = new Date();
		var toyear=today.getFullYear();
		var tomonth=today.getMonth()+1;
		if(tomonth<10){
			tomonth="0"+tomonth;
		}
		var vbcheck_month="Tháng "+tomonth+"/"+toyear;
		jQuery('.vb-month-year').each(function(){
			if(jQuery(this).find("h3").text().trim()==vbcheck_month){
				jQuery(this).find("h3").trigger('click');
			}
		});
	});
    </script>
    
    <?php $vb_thongke = ob_get_contents(); 
    ob_end_clean();
    return  $vb_thongke;
}
add_shortcode('thong_ke', 'create_shortcode_thong_ke');
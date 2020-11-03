<?php

function create_shortcode_nang_luong_home() {

    global $wpdb;

    $list_tuoi = $wpdb->get_results( 'SELECT nc_tuoi, id FROM '.$wpdb->prefix.'nang_luong WHERE nc_tuoi != ""  ORDER BY id ASC'  );

   unset($list_tuoi[1],$list_tuoi[3],$list_tuoi[5],$list_tuoi[7],$list_tuoi[9]);

	$list_tuoi = array_values($list_tuoi); 

    $list_monan = $wpdb->get_results( 'SELECT bs_ten FROM '.$wpdb->prefix.'bua_sang WHERE bs_true != "1"' );
    $list_monansang = $wpdb->get_results( 'SELECT bs_ten FROM '.$wpdb->prefix.'bua_sang WHERE bs_true = "1"' );

?>

    <div class="vb-tinh row">

        <div class="col medium-6 small-12 large-6">

            <div class="col-inner text-left">

                <h2>Nhập thông tin</h2>

                <form class=" align-equal vb-nang-luong" action="" method="GET">

                    <div>

                        <h3>Tuổi</h3>

                        <select name="tuoi" required="">

                            <option>Tuổi</option>

                            <?php if (!empty($list_tuoi)): ?>

                            <?php foreach ($list_tuoi as $key => $value): ?>

                                <option<?php echo !empty($_REQUEST['nc_tuoi']) && $_REQUEST['nc_tuoi'] == $value->nc_tuoi ? ' selected=""' : '' ?> value="<?php echo $value->nc_tuoi ?>"><?php echo $value->nc_tuoi ?></option>

                            <?php endforeach ?>

                            <?php endif ?>

                        </select>

                    </div>

                    <div class="vb-gioitinh">

                        <h3>Giới tính</h3>

                        <select name="nc_gt" class="text-capitalize" style="display: none">

                           

                        </select>

                        <input type="radio" name="vb-gth" value="nam"> Nam

                        <input type="radio" name="vb-gth" value="nu"> Nữ

                    </div>

                    <div>

                        <h3>Ăn sáng</h3>

                        <select name="sang">

                            <option>Món ăn</option>

                            <?php if (!empty($list_monansang)): ?>

                            <?php foreach ($list_monansang as $key => $value): ?>

                                <option<?php echo !empty($_REQUEST['bs_ten']) && $_REQUEST['bs_ten'] == $value->bs_ten ? ' selected=""' : '' ?> value="<?php echo $value->bs_ten ?>"><?php echo $value->bs_ten ?></option>

                            <?php endforeach ?>

                            <?php endif ?>

                        </select>

                    </div>

                    <div>

                        <h3>Ăn trưa</h3>

                        <select name="trua">

                            <option>Món ăn</option>

                            <?php if (!empty($list_monan)): ?>

                            <?php foreach ($list_monan as $key => $value): ?>

                                <option<?php echo !empty($_REQUEST['bs_ten']) && $_REQUEST['bs_ten'] == $value->bs_ten ? ' selected=""' : '' ?> value="<?php echo $value->bs_ten ?>"><?php echo $value->bs_ten ?></option>

                            <?php endforeach ?>

                            <?php endif ?>

                        </select> 

                    </div>

                </form>

            </div>

        </div>

        <div class="col medium-6 small-12 large-6">

            <div class="col-inner text-left">

                <h2>Kết Quả</h2>

                <div id="ketqua">

                    

                </div>

                <div id="ketqua-sang">

                   

                </div>

                <div id="ketqua-trua">

                   

                </div>

                <div id="ketqua-thieu">

                   

                </div>

 

            </div>

        </div>

        <div class="col medium-12 small-12 large-12">

        <div id="goi-y">

             <div id="nhom1"></div>  

             <div id="nhom2"></div>  

             <div id="nhom3"></div>  

             <div id="nhom4"></div>  

             <div id="nhom5"></div>               

             <div id="nhom6"></div> 

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

    <script type="text/javascript">

    // _____________________Load Nhu cầu năng lượng hàng ngày_____________________________

        jQuery( '.vb-gioitinh input[type="radio"]' ).on( "click", function() {

            var vbtreem=jQuery('select[name="tuoi"]').val();

            if(vbtreem=="Tuổi"){

                jQuery( '.vb-gioitinh input[type="radio"]' ).each(function(){

                    jQuery(this).prop("checked", false);

                });

                alert("Xin vui lòng chọn tuổi");



            }

            var vbcheck=jQuery( '.vb-gioitinh input[type="radio"]:checked' ).val();

            if(vbcheck == "nam"){

                jQuery('option[value="nam"]').selected();

                jQuery('select[name="nc_gt"]').change();

            }

            if(vbcheck == "nu"){

                jQuery('option[value="nu"]').selected();

                jQuery('select[name="nc_gt"]').change();

            }

        });

        jQuery('select[name="tuoi"]').change(function() {

            jQuery('select[name="nc_gt"]').html('<option> </option>');

             jQuery('body').removeClass('vb-showtt');

             jQuery( '.vb-gioitinh input[type="radio"]' ).each(function(){

                 jQuery(this).prop("checked", false);

             });

            if(jQuery('select[name="tuoi"] option:selected').val()!="Tuổi"){

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-nang-luong.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'tuoi':jQuery('select[name="tuoi"] option:selected').val()},

                success:function(response){ 

                    if (response != 0) {

                        response = JSON.parse(response);

                        jQuery('#ketqua').html('');

                        var list_quan = [];

                        for(j=0;j < response.length;j++){

                            if (response[j].nc_gt != undefined && response[j].nc_gt != '') {

                                if (list_quan.indexOf(response[j].nc_gt.trim().toLowerCase()) == -1) {

                                    list_quan.push(response[j].nc_gt.trim().toLowerCase());

                                }

                            }

                        }

                        list_quan = list_quan.sort();

                        for (var z = 0; z < list_quan.length; z++) {

                            jQuery('select[name="nc_gt"]').append('<option value="'+list_quan[z]+'">'+list_quan[z].replace("\\'", "'")+'</option>');

                        }

                        jQuery('.loading-web').addClass('hidden');

                                                ketqua();

                         goi_y();

                    }

                }

            });

            }

        });

        jQuery('select[name="nc_gt"]').change(function() {

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thong-tin.php', 

                beforeSend: function( xhr ){ 

                jQuery('.loading-web').removeClass('hidden');

                jQuery('body').removeClass('vb-showtt');

                },

                data:{'tuoi':jQuery('select[name="tuoi"] option:selected').val(), 'nc_gt':jQuery('select[name="nc_gt"] option:selected').val()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        jQuery('#ketqua').html('');

                        for(j=0;j < response.length;j++){

                            jQuery('#ketqua').append('<div class="vb-ketqua"></div>');

                            jQuery('.vb-ketqua').append('<div class="vb-nhucau-hang-ngay"></div>');

                            jQuery('.vb-nhucau-hang-ngay').append('<h2>Nhu cầu dinh dưỡng hàng ngày</h2>');

                             jQuery('.vb-nhucau-hang-ngay').append('<p><span><b>Năng lượng: </b>'+response[j].nc_nl+'kcal</span><span><b>Protein: </b>'+response[j].nc_protid+'g</span><span><b>Glucid: </b>'+response[j].nc_glucid+'g</span><span><b>Lipid: </b>'+response[j].nc_lipid+'g</span><p>');

                        } 

                        jQuery('.loading-web').addClass('hidden');

                        jQuery('body').addClass('vb-showtt');

                                                ketqua();

                         goi_y();

                    } 

                }

            });

        });

        // _____________________Load món ăn sáng_____________________________

        jQuery('select[name="sang"]').change(function() {

            if(jQuery('select[name="sang"] option:selected').val() !="Món ăn"){

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'sang':jQuery('select[name="sang"] option:selected').val()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response); 

                        jQuery('#ketqua-sang').html('');

                        for(j=0;j < response.length;j++){

                            jQuery('#ketqua-sang').append('<div class="vb-ketqua-sang"></div>');

                            jQuery('.vb-ketqua-sang').append('<div class="vb-mon-sang"></div>');

                            jQuery('.vb-mon-sang').append('<h2>Dinh dưỡng từ món ăn sáng : '+response[j].bs_ten+'</h2>');

                             jQuery('.vb-mon-sang').append('<p><span><b>Năng lượng: </b>'+response[j].bs_e+'</span><span><b>Protein: </b>'+response[j].bs_p+'</span><span><b>Glucid: </b>'+response[j].bs_g+'</span><span><b>Lipid: </b>'+response[j].bs_l+'</span><p>');

                        } 

                        jQuery('.loading-web').addClass('hidden');

                         ketqua();

                         goi_y();

                    } 

                }

            });

            }else{

                jQuery('#ketqua-sang').html('');

                jQuery('#ketqua-thieu .vb-ketqua-thieu').remove();

            }

        });

        // _____________________End món ăn sáng_____________________________

        // _____________________Load món ăn trưa_____________________________

        jQuery('select[name="trua"]').change(function() {

             if(jQuery('select[name="trua"] option:selected').val() !="Món ăn"){

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'sang':jQuery('select[name="trua"] option:selected').val()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response); 

                        jQuery('#ketqua-trua').html('');

                        for(j=0;j < response.length;j++){

                            jQuery('#ketqua-trua').append('<div class="vb-ketqua-trua"></div>');

                            jQuery('.vb-ketqua-trua').append('<div class="vb-mon-trua"></div>');

                            jQuery('.vb-mon-trua').append('<h2>Dinh dưỡng từ món ăn trưa: '+response[j].bs_ten+'</h2>');

                            jQuery('.vb-mon-trua').append('<p><span><b>Năng lượng: </b>'+response[j].bs_e+'</span><span><b>Protein: </b>'+response[j].bs_p+'</span><span><b>Glucid: </b>'+response[j].bs_g+'</span><span><b>Lipid: </b>'+response[j].bs_l+'</span><p>');

                        } 

                        jQuery('.loading-web').addClass('hidden');

                      

                         ketqua();

                         goi_y();

                    }

                }

            });

            }else{

                jQuery('#ketqua-trua').html('');

                jQuery('#ketqua-thieu .vb-ketqua-thieu').remove();

            }

        });

        function ketqua(){

            jQuery('#ketqua-thieu .vb-ketqua-thieu').remove();

                       

            //Lấy dữ liệu năng lượng tổng

            var vbnltotal = Number(jQuery(jQuery('.vb-ketqua span')[0]).text().replace(/[^0-9.]+/ig, ""));

            var vbptotal = Number(jQuery(jQuery('.vb-ketqua span')[1]).text().replace(/[^0-9.]+/ig, ""));

            var vbcltotal = Number(jQuery(jQuery('.vb-ketqua span')[2]).text().replace(/[^0-9.]+/ig, ""));

            var vbsltotal = Number(jQuery(jQuery('.vb-ketqua span')[3]).text().replace(/[^0-9.]+/ig, ""));

            //Lấy dữ liệu năng lượng món sáng

            var vbnlsang = Number(jQuery(jQuery('.vb-mon-sang span')[0]).text().replace(/[^0-9.]+/ig, ""));

            var vbpsang = Number(jQuery(jQuery('.vb-mon-sang span')[1]).text().replace(/[^0-9.]+/ig, ""));

            var vbclsang = Number(jQuery(jQuery('.vb-mon-sang span')[2]).text().replace(/[^0-9.]+/ig, ""));

            var vbslsang = Number(jQuery(jQuery('.vb-mon-sang span')[3]).text().replace(/[^0-9.]+/ig, ""));

            //Lấy dữ liệu năng lượng món trưa

            var vbnltrua = Number(jQuery(jQuery('.vb-mon-trua  span')[0]).text().replace(/[^0-9.]+/ig, ""));

            var vbptrua = Number(jQuery(jQuery('.vb-mon-trua  span')[1]).text().replace(/[^0-9.]+/ig, ""));

            var vbcltrua = Number(jQuery(jQuery('.vb-mon-trua  span')[2]).text().replace(/[^0-9.]+/ig, ""));

            var vbsltrua = Number(jQuery(jQuery('.vb-mon-trua  span')[3]).text().replace(/[^0-9.]+/ig, ""));

            if(vbnltotal>0 && vbnlsang >0 && vbnltrua>0){

                //Lấy dữ liệu năng lượng còn thiếu

                var vbnlthieu=Math.round((vbnltotal-vbnlsang-vbnltrua)*100)/100;

                var vbnlpthieu=Math.round((vbptotal-vbpsang-vbptrua)*100)/100;

                var vbnlcthieu=Math.round((vbcltotal-vbclsang-vbcltrua)*100)/100;

                var vbnlsthieu=Math.round((vbsltotal-vbslsang-vbsltrua)*100)/100;

                var vbclass0 ="";

                var vbclass1 ="";

                var vbclass2 ="";

                if(vbnlpthieu<0){

                     vbclass0='class="b-red"';

                }

                if(vbnlcthieu<0){

                     vbclass1='class="b-red"';

                }

                if(vbnlsthieu<0){

                     vbclass2='class="b-red"';

                }

                jQuery('#ketqua-thieu').append('<div class="vb-ketqua-thieu"></div>');

                jQuery('.vb-ketqua-thieu').append('<div class="vb-thieu"></div>');

                jQuery('.vb-thieu').append('<h2>Năng lượng còn thiếu : </h2>');

                jQuery('.vb-thieu').append('<p><span><b>Năng lượng: </b>'+vbnlthieu+'kcal</span><span '+ vbclass0+'><b>Protein: </b>'+vbnlpthieu+'g</span><span '+ vbclass1+'><b>Glucid: </b>'+vbnlcthieu+'g</span><span '+ vbclass2+'><b>Lipid: </b>'+vbnlsthieu+'g</span><p>');

            }

        }

        function goi_y(){

            jQuery('#goi-y h1').remove();

            jQuery('#goi-y').prepend('<h1>Gợi ý nguyên liệu</h1>');

            var vbnl = Number(jQuery(jQuery('.vb-thieu span')[0]).text().replace(/[^0-9.-]+/ig, ""));

            var vbp = Number(jQuery(jQuery('.vb-nhucau-hang-ngay span')[1]).text().replace(/[^0-9.-]+/ig, ""))-10;

            var vbc = Number(jQuery(jQuery('.vb-nhucau-hang-ngay span')[2]).text().replace(/[^0-9.-]+/ig, ""))/2;

            var vbs = Number(jQuery(jQuery('.vb-nhucau-hang-ngay span')[3]).text().replace(/[^0-9.-]+/ig, ""))-1;

            if(vbnl>0){

                jQuery.ajax({

                    type:"POST",

                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-nguyen-lieu.php', 

                    beforeSend: function( xhr ){ 

                    jQuery('.loading-web').removeClass('hidden');
                    var vbtuoicheck=jQuery('select[name="tuoi"]').val().trim();
                    if(vbtuoicheck.indexOf("6")>-1 || vbtuoicheck.indexOf("8")>-1 || vbtuoicheck.indexOf("10")>-1){
                        jQuery('#goi-y').prepend('<img src="/wp-content/uploads/2020/10/6-11.jpg">');
                    }
                    else if(vbtuoicheck.indexOf("12")>-1){
                        jQuery('#goi-y').prepend('<img src="/wp-content/uploads/2020/10/12-14.jpg">');
                    }
                    else if(vbtuoicheck.indexOf("15")>-1){
                        jQuery('#goi-y').prepend('<img src="/wp-content/uploads/2020/10/15-18.jpg">');
                    }
                    },

                    data:{'nangluong':vbnl, 'nhom':'nhom-1'  },

                    success:function(response){

                        if (response != 0) {

                            response = JSON.parse(response);

                            jQuery('#nhom1').html('');

                            jQuery('#nhom1').prepend('<div class="thucpham-nhom1"><h2>Ngũ cốc và sản phẩm chế biến</h2></div>');

                            for(j=0;j < response.length;j++){

                                jQuery('#nhom1 .thucpham-nhom1').append('<a href="'+response[j].nl_link+'"><div><p>'+response[j].nl_ten+' ('+response[j].nl_nang_luong_kcal+'kcal)</p><p>Protein: '+response[j].nl_protein+'g - Glucid: '+response[j].nl_glucid+'g - Lipid: '+response[j].nl_lipid+'g</p></div></a>');

                            } 

                            jQuery('.loading-web').addClass('hidden');

                        }

                    }

                });

                jQuery.ajax({

                    type:"POST",

                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-nguyen-lieu.php', 

                    beforeSend: function( xhr ){ 

                    jQuery('.loading-web').removeClass('hidden');

                    },

                    data:{'nangluong':vbnl, 'nhom':'nhom-2'  },

                    success:function(response){ 

                        if (response != 0) {

                            response = JSON.parse(response);

                            jQuery('#nhom2').html('');

                            jQuery('#nhom2').prepend('<div class="thucpham-nhom1"><h2> Khoai củ và sản phẩm chế biến </h2></div>');

                            for(j=0;j < response.length;j++){

                                jQuery('#nhom2 .thucpham-nhom1').append('<a href="'+response[j].nl_link+'"><div><p>'+response[j].nl_ten+' ('+response[j].nl_nang_luong_kcal+'kcal)</p><p>Protein: '+response[j].nl_protein+'g - Glucid: '+response[j].nl_glucid+'mg - Lipid: '+response[j].nl_lipid+'g</p></div></a>');

                            } 

                            jQuery('.loading-web').addClass('hidden');

                        }

                    }

                });

                jQuery.ajax({

                    type:"POST",

                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-nguyen-lieu.php', 

                    beforeSend: function( xhr ){ 

                    jQuery('.loading-web').removeClass('hidden');

                    },

                    data:{'nangluong':vbnl, 'nhom':'nhom-4'  },

                    success:function(response){ 

                        if (response != 0) {

                            response = JSON.parse(response);

                            jQuery('#nhom3').html('');

                            jQuery('#nhom3').prepend('<div class="thucpham-nhom1"><h2>Rau, quả, củ dùng làm rau </h2></div>');

                            for(j=0;j < response.length;j++){

                                jQuery('#nhom3 .thucpham-nhom1').append('<a href="'+response[j].nl_link+'"><div><p>'+response[j].nl_ten+' ('+response[j].nl_nang_luong_kcal+'kcal)</p><p>Protein: '+response[j].nl_protein+'g - Glucid: '+response[j].nl_glucid+'mg - Lipid: '+response[j].nl_lipid+'g</p></div></a>');

                            } 

                            jQuery('.loading-web').addClass('hidden');

                        }

                    }

                });

                jQuery.ajax({

                    type:"POST",

                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-nguyen-lieu.php', 

                    beforeSend: function( xhr ){ 

                    jQuery('.loading-web').removeClass('hidden');

                    },

                    data:{'nangluong':vbnl, 'nhom':'nhom-7'  },

                    success:function(response){ 

                        if (response != 0) {

                            response = JSON.parse(response);

                            jQuery('#nhom4').html('');

                            jQuery('#nhom4').prepend('<div class="thucpham-nhom1"><h2>Thịt và sản phẩm chế biến </h2></div>');

                            for(j=0;j < response.length;j++){

                                jQuery('#nhom4 .thucpham-nhom1').append('<a href="'+response[j].nl_link+'"><div><p>'+response[j].nl_ten+' ('+response[j].nl_nang_luong_kcal+'kcal)</p><p>Protein: '+response[j].nl_protein+'g - Glucid: '+response[j].nl_glucid+'mg - Lipid: '+response[j].nl_lipid+'g</p></div></a>');

                            } 

                            jQuery('.loading-web').addClass('hidden');

                        }

                    }

                });

                jQuery.ajax({

                    type:"POST",

                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-nguyen-lieu.php', 

                    beforeSend: function( xhr ){ 

                    jQuery('.loading-web').removeClass('hidden');

                    },

                    data:{'nangluong':vbnl, 'nhom':'nhom-8', 'protid':vbp, 'canxi':vbc, 'sat':vbs  },

                    success:function(response){ 

                        if (response != 0) {

                            response = JSON.parse(response);

                            jQuery('#nhom5').html('');

                            jQuery('#nhom5').prepend('<div class="thucpham-nhom1"><h2>Thủy sản và sản phẩm chế biến </h2></div>');

                            for(j=0;j < response.length;j++){

                                jQuery('#nhom5 .thucpham-nhom1').append('<a href="'+response[j].nl_link+'"><div><p>'+response[j].nl_ten+' ('+response[j].nl_nang_luong_kcal+'kcal)</p><p>Protein: '+response[j].nl_protein+'g - Glucid: '+response[j].nl_glucid+'mg - Lipid: '+response[j].nl_lipid+'g</p></div></a>');

                            } 

                            jQuery('.loading-web').addClass('hidden');

                        }

                    }

                });

                jQuery.ajax({

                    type:"POST",

                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-nguyen-lieu.php', 

                    beforeSend: function( xhr ){ 

                    jQuery('.loading-web').removeClass('hidden');

                    },

                    data:{'nangluong':vbnl, 'nhom':'nhom-9'  },

                    success:function(response){ 

                        if (response != 0) {

                            response = JSON.parse(response);

                            jQuery('#nhom6').html('');

                            jQuery('#nhom6').prepend('<div class="thucpham-nhom1"><h2>Trứng và sản phẩm chế biến  </h2></div>');

                            for(j=0;j < response.length;j++){

                                jQuery('#nhom6 .thucpham-nhom1').append('<a href="'+response[j].nl_link+'"><div><p>'+response[j].nl_ten+' ('+response[j].nl_nang_luong_kcal+'kcal)</p><p>Protein: '+response[j].nl_protein+'g - Glucid: '+response[j].nl_glucid+'mg - Lipid: '+response[j].nl_lipid+'g</p></div></a>');

                            } 

                            jQuery('.loading-web').addClass('hidden');

                        }

                    }

                });

            } 

        }

    </script>

<?php



}



add_shortcode( 'nang_luong_home', 'create_shortcode_nang_luong_home' );
<?php

function create_shortcode_thu2() {

    global $wpdb;

    $list_ngay = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'thuc_don WHERE td_thu = "Thứ 2"');
    $date = getdate();
    $date['mon'];
    $list_monan = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'thuc_don WHERE td_ngay != ""');

?>

    <div class="vb-thucdon">

        <ul>
            <?php if (!empty($list_ngay)): $vbi=0; ?>
            		
                <?php foreach ($list_ngay as $key => $value): ?>
                	<?php $vbngay=$value->td_ngay;
                	$vbngay=substr($vbngay, 3,2);  
                	if($vbngay==$date['mon']):
                	?>
                    <li class="vbthu2-<?php echo $vbi ?>"><?php echo $value->td_ngay;?></li>

					<?php $vbi ++; endif ?>
                <?php endforeach ?>

            <?php endif ?>

        </ul>

        <table class="monanthu2">

            <tr>

                <th>Món ăn</th>

                <th>Calo</th>

                <th>Protein</th>

                <th>Glucid</th>

                <th>Lipid</th>

            </tr>

        </table>

        <table class="tongmonanthu2">

            <tr>

                <th>Tổng</th>

                <th class="tongmonanthu2calo"></th>

                <th class="tongmonanthu2protein"></th>

                <th class="tongmonanthu2glucid"></th>

                <th class="tongmonanthu2lipid"></th>

            </tr>

        </table>

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

        jQuery(window).load(function() {

            var vbtr=jQuery('.monanthu2 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu2 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }
            jQuery('.tongmonanthu2calo').html('');

            jQuery('.tongmonanthu2protein').html('');

            jQuery('.tongmonanthu2glucid').html('');

             jQuery('.tongmonanthu2lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu2-0').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu2calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu2protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu2glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu2lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td1"></tr>');

                                jQuery('.monanthu2td1').append('<td class="monanthu2td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td1').append('<td>'+response[j].bs_l+'</td>');


                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td2"></tr>');

                                jQuery('.monanthu2td2').append('<td class="monanthu2td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td2').append('<td>'+response[j].bs_p+'</td>');  

                                            jQuery('.monanthu2td2').append('<td>'+response[j].bs_g+'</td>'); 

                                            jQuery('.monanthu2td2').append('<td>'+response[j].bs_l+'</td>');                                          

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td3"></tr>');

                                jQuery('.monanthu2td3').append('<td class="monanthu2td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td3').append('<td>'+response[j].bs_l+'</td>');


                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td4"></tr>');

                                jQuery('.monanthu2td4').append('<td class="monanthu2td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td9"></tr>');

                                jQuery('.monanthu2td9').append('<td class="monanthu2td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td5"></tr>');

                                jQuery('.monanthu2td5').append('<td class="monanthu2td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td5').append('<td>'+response[j].bs_l+'</td>');
                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td6"></tr>');

                                jQuery('.monanthu2td6').append('<td class="monanthu2td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td7"></tr>');

                                jQuery('.monanthu2td7').append('<td class="monanthu2td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td8"></tr>');

                                jQuery('.monanthu2td8').append('<td class="monanthu2td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td10"></tr>');

                                jQuery('.monanthu2td10').append('<td class="monanthu2td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }



                                });

                            } 

                            

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu2-0').click(function() {

            var vbtr=jQuery('.monanthu2 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu2 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu2calo').html('');

            jQuery('.tongmonanthu2protein').html('');

            jQuery('.tongmonanthu2glucid').html('');

             jQuery('.tongmonanthu2lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu2-0').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu2calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu2protein').text(response[j].td_p+'g');

                            jQuery('.monanthu2glucid').append('<td>'+response[j].bs_g+'</td>');

                            jQuery('.monanthu2lipid').append('<td>'+response[j].bs_l+'</td>');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td1"></tr>');

                                jQuery('.monanthu2td1').append('<td class="monanthu2td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td2"></tr>');

                                jQuery('.monanthu2td2').append('<td class="monanthu2td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td3"></tr>');

                                jQuery('.monanthu2td3').append('<td class="monanthu2td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td4"></tr>');

                                jQuery('.monanthu2td4').append('<td class="monanthu2td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td9"></tr>');

                                jQuery('.monanthu2td9').append('<td class="monanthu2td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td5"></tr>');

                                jQuery('.monanthu2td5').append('<td class="monanthu2td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td6"></tr>');

                                jQuery('.monanthu2td6').append('<td class="monanthu2td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td7"></tr>');

                                jQuery('.monanthu2td7').append('<td class="monanthu2td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td8"></tr>');

                                jQuery('.monanthu2td8').append('<td class="monanthu2td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td10"></tr>');

                                jQuery('.monanthu2td10').append('<td class="monanthu2td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }



                                });

                            } 

                            

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu2-1').click(function() {

            var vbtr=jQuery('.monanthu2 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu2 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu2calo').html('');

            jQuery('.tongmonanthu2protein').html('');

            jQuery('.tongmonanthu2glucid').html('');

             jQuery('.tongmonanthu2lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu2-1').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu2calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu2protein').text(response[j].td_p+'g');

                            jQuery('.monanthu2glucid').append('<td>'+response[j].bs_g+'</td>');

                            jQuery('.monanthu2lipid').append('<td>'+response[j].bs_l+'</td>');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td1"></tr>');

                                jQuery('.monanthu2td1').append('<td class="monanthu2td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td2"></tr>');

                                jQuery('.monanthu2td2').append('<td class="monanthu2td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td3"></tr>');

                                jQuery('.monanthu2td3').append('<td class="monanthu2td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td4"></tr>');

                                jQuery('.monanthu2td4').append('<td class="monanthu2td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td9"></tr>');

                                jQuery('.monanthu2td9').append('<td class="monanthu2td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td5"></tr>');

                                jQuery('.monanthu2td5').append('<td class="monanthu2td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td6"></tr>');

                                jQuery('.monanthu2td6').append('<td class="monanthu2td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td7"></tr>');

                                jQuery('.monanthu2td7').append('<td class="monanthu2td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td8"></tr>');

                                jQuery('.monanthu2td8').append('<td class="monanthu2td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td10"></tr>');

                                jQuery('.monanthu2td10').append('<td class="monanthu2td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu2-2').click(function() {

            var vbtr=jQuery('.monanthu2 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu2 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu2calo').html('');

            jQuery('.tongmonanthu2protein').html('');

            jQuery('.tongmonanthu2glucid').html('');

             jQuery('.tongmonanthu2lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu2-2').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu2calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu2protein').text(response[j].td_p+'g');

                            jQuery('.monanthu2glucid').text(response[j].td_g+'g');

                            jQuery('.monanthu2lipid').text(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td1"></tr>');

                                jQuery('.monanthu2td1').append('<td class="monanthu2td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td2"></tr>');

                                jQuery('.monanthu2td2').append('<td class="monanthu2td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td3"></tr>');

                                jQuery('.monanthu2td3').append('<td class="monanthu2td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td4"></tr>');

                                jQuery('.monanthu2td4').append('<td class="monanthu2td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td9"></tr>');

                                jQuery('.monanthu2td9').append('<td class="monanthu2td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td5"></tr>');

                                jQuery('.monanthu2td5').append('<td class="monanthu2td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td6"></tr>');

                                jQuery('.monanthu2td6').append('<td class="monanthu2td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td7"></tr>');

                                jQuery('.monanthu2td7').append('<td class="monanthu2td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td8"></tr>');

                                jQuery('.monanthu2td8').append('<td class="monanthu2td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td10"></tr>');

                                jQuery('.monanthu2td10').append('<td class="monanthu2td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu2-3').click(function() {

            var vbtr=jQuery('.monanthu2 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu2 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu2calo').html('');

            jQuery('.tongmonanthu2protein').html('');

            jQuery('.tongmonanthu2glucid').html('');

             jQuery('.tongmonanthu2lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu2-3').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu2calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu2protein').text(response[j].td_p+'g');

                            jQuery('.monanthu2glucid').text(response[j].td_g+'g');

                            jQuery('.monanthu2lipid').text(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td1"></tr>');

                                jQuery('.monanthu2td1').append('<td class="monanthu2td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td2"></tr>');

                                jQuery('.monanthu2td2').append('<td class="monanthu2td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td3"></tr>');

                                jQuery('.monanthu2td3').append('<td class="monanthu2td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td4"></tr>');

                                jQuery('.monanthu2td4').append('<td class="monanthu2td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td9"></tr>');

                                jQuery('.monanthu2td9').append('<td class="monanthu2td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td5"></tr>');

                                jQuery('.monanthu2td5').append('<td class="monanthu2td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td6"></tr>');

                                jQuery('.monanthu2td6').append('<td class="monanthu2td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td7"></tr>');

                                jQuery('.monanthu2td7').append('<td class="monanthu2td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td8"></tr>');

                                jQuery('.monanthu2td8').append('<td class="monanthu2td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td10"></tr>');

                                jQuery('.monanthu2td10').append('<td class="monanthu2td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu2-4').click(function() {

            var vbtr=jQuery('.monanthu2 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu2 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu2calo').html('');

            jQuery('.tongmonanthu2protein').html('');

            jQuery('.tongmonanthu2glucid').html('');

             jQuery('.tongmonanthu2lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu2-4').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu2calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu2protein').text(response[j].td_p+'g');

                            jQuery('.monanthu2glucid').text(response[j].td_g+'g');

                            jQuery('.monanthu2lipid').text(response[j].td_l+'g');
                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td1"></tr>');

                                jQuery('.monanthu2td1').append('<td class="monanthu2td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td2"></tr>');

                                jQuery('.monanthu2td2').append('<td class="monanthu2td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td3"></tr>');

                                jQuery('.monanthu2td3').append('<td class="monanthu2td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td4"></tr>');

                                jQuery('.monanthu2td4').append('<td class="monanthu2td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td9"></tr>');

                                jQuery('.monanthu2td9').append('<td class="monanthu2td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td5"></tr>');

                                jQuery('.monanthu2td5').append('<td class="monanthu2td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td6"></tr>');

                                jQuery('.monanthu2td6').append('<td class="monanthu2td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td7"></tr>');

                                jQuery('.monanthu2td7').append('<td class="monanthu2td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td8"></tr>');

                                jQuery('.monanthu2td8').append('<td class="monanthu2td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu2').append('<tr class="monanthu2td10"></tr>');

                                jQuery('.monanthu2td10').append('<td class="monanthu2td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu2td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu2td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu2td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu2td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu2td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

    </script>

    

<?php



}



add_shortcode( 'thu2', 'create_shortcode_thu2' );

// ++++++++++++++++++++++++++++++Thứ 3++++++++++++++++++++++++++++++++++++++++

function create_shortcode_thu3() {

    global $wpdb;

    $list_ngay = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'thuc_don WHERE td_thu = "Thứ 3"');
	$date = getdate();
    $date['mon'];
    $list_monan = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'thuc_don WHERE td_ngay != ""');

?>

    <div class="vb-thucdon">

        <ul>
            <?php if (!empty($list_ngay)): $vbi=0; ?>
            		
                <?php foreach ($list_ngay as $key => $value): ?>
                	<?php $vbngay=$value->td_ngay;
                	$vbngay=substr($vbngay, 3,2);  
                	if($vbngay==$date['mon']):
                	?>
                    <li class="vbthu3-<?php echo $vbi ?>"><?php echo $value->td_ngay;?></li>

					<?php $vbi ++; endif ?>
                <?php endforeach ?>

            <?php endif ?>

        </ul>

        <table class="monanthu3">

            <tr>

                <th>Món ăn</th>

                <th>Calo</th>

                <th>Protein</th>

                <th>Glucid</th>

                <th>Lipid</th>

            </tr>

        </table>

        <table class="tongmonanthu3">

            <tr>

                <th>Tổng</th>

                <th class="tongmonanthu3calo"></th>

                <th class="tongmonanthu3protein"></th>

                <th class="tongmonanthu3glucid"></th>

                <th class="tongmonanthu3lipid"></th>

            </tr>

        </table>

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

        jQuery(window).load(function() {

            var vbtr=jQuery('.monanthu3 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu3 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu3calo').html('');

            jQuery('.tongmonanthu3protein').html('');

            jQuery('.tongmonanthu3glucid').html('');

             jQuery('.tongmonanthu3lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu3-0').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu3calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu3protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu3glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu3lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td1"></tr>');

                                jQuery('.monanthu3td1').append('<td class="monanthu3td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td2"></tr>');

                                jQuery('.monanthu3td2').append('<td class="monanthu3td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td3"></tr>');

                                jQuery('.monanthu3td3').append('<td class="monanthu3td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td4"></tr>');

                                jQuery('.monanthu3td4').append('<td class="monanthu3td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td9"></tr>');

                                jQuery('.monanthu3td9').append('<td class="monanthu3td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td5"></tr>');

                                jQuery('.monanthu3td5').append('<td class="monanthu3td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td6"></tr>');

                                jQuery('.monanthu3td6').append('<td class="monanthu3td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td7"></tr>');

                                jQuery('.monanthu3td7').append('<td class="monanthu3td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td8"></tr>');

                                jQuery('.monanthu3td8').append('<td class="monanthu3td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td10"></tr>');

                                jQuery('.monanthu3td10').append('<td class="monanthu3td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }



                                });

                            } 

                            

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu3-0').click(function() {

            var vbtr=jQuery('.monanthu3 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu3 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu3calo').html('');

            jQuery('.tongmonanthu3protein').html('');

            jQuery('.tongmonanthu3glucid').html('');

             jQuery('.tongmonanthu3lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu3-0').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu3calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu3protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu3glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu3lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td1"></tr>');

                                jQuery('.monanthu3td1').append('<td class="monanthu3td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td2"></tr>');

                                jQuery('.monanthu3td2').append('<td class="monanthu3td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td3"></tr>');

                                jQuery('.monanthu3td3').append('<td class="monanthu3td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td4"></tr>');

                                jQuery('.monanthu3td4').append('<td class="monanthu3td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td9"></tr>');

                                jQuery('.monanthu3td9').append('<td class="monanthu3td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td5"></tr>');

                                jQuery('.monanthu3td5').append('<td class="monanthu3td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td6"></tr>');

                                jQuery('.monanthu3td6').append('<td class="monanthu3td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td7"></tr>');

                                jQuery('.monanthu3td7').append('<td class="monanthu3td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td8"></tr>');

                                jQuery('.monanthu3td8').append('<td class="monanthu3td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td10"></tr>');

                                jQuery('.monanthu3td10').append('<td class="monanthu3td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }



                                });

                            } 

                            

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu3-1').click(function() {

            var vbtr=jQuery('.monanthu3 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu3 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu3calo').html('');

            jQuery('.tongmonanthu3protein').html('');

            jQuery('.tongmonanthu3glucid').html('');

             jQuery('.tongmonanthu3lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu3-1').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu3calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu3protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu3glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu3lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td1"></tr>');

                                jQuery('.monanthu3td1').append('<td class="monanthu3td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td2"></tr>');

                                jQuery('.monanthu3td2').append('<td class="monanthu3td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td3"></tr>');

                                jQuery('.monanthu3td3').append('<td class="monanthu3td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td4"></tr>');

                                jQuery('.monanthu3td4').append('<td class="monanthu3td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td9"></tr>');

                                jQuery('.monanthu3td9').append('<td class="monanthu3td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td5"></tr>');

                                jQuery('.monanthu3td5').append('<td class="monanthu3td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td6"></tr>');

                                jQuery('.monanthu3td6').append('<td class="monanthu3td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td7"></tr>');

                                jQuery('.monanthu3td7').append('<td class="monanthu3td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td8"></tr>');

                                jQuery('.monanthu3td8').append('<td class="monanthu3td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td10"></tr>');

                                jQuery('.monanthu3td10').append('<td class="monanthu3td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu3-2').click(function() {

            var vbtr=jQuery('.monanthu3 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu3 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu3calo').html('');

            jQuery('.tongmonanthu3protein').html('');

            jQuery('.tongmonanthu3glucid').html('');

             jQuery('.tongmonanthu3lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu3-2').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu3calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu3protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu3glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu3lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td1"></tr>');

                                jQuery('.monanthu3td1').append('<td class="monanthu3td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td2"></tr>');

                                jQuery('.monanthu3td2').append('<td class="monanthu3td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td3"></tr>');

                                jQuery('.monanthu3td3').append('<td class="monanthu3td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td4"></tr>');

                                jQuery('.monanthu3td4').append('<td class="monanthu3td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td9"></tr>');

                                jQuery('.monanthu3td9').append('<td class="monanthu3td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td5"></tr>');

                                jQuery('.monanthu3td5').append('<td class="monanthu3td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td6"></tr>');

                                jQuery('.monanthu3td6').append('<td class="monanthu3td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td7"></tr>');

                                jQuery('.monanthu3td7').append('<td class="monanthu3td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td8"></tr>');

                                jQuery('.monanthu3td8').append('<td class="monanthu3td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td10"></tr>');

                                jQuery('.monanthu3td10').append('<td class="monanthu3td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu3-3').click(function() {

            var vbtr=jQuery('.monanthu3 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu3 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu3calo').html('');

            jQuery('.tongmonanthu3protein').html('');

            jQuery('.tongmonanthu3glucid').html('');

             jQuery('.tongmonanthu3lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu3-3').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu3calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu3protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu3glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu3lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td1"></tr>');

                                jQuery('.monanthu3td1').append('<td class="monanthu3td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td2"></tr>');

                                jQuery('.monanthu3td2').append('<td class="monanthu3td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td3"></tr>');

                                jQuery('.monanthu3td3').append('<td class="monanthu3td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td4"></tr>');

                                jQuery('.monanthu3td4').append('<td class="monanthu3td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td9"></tr>');

                                jQuery('.monanthu3td9').append('<td class="monanthu3td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td5"></tr>');

                                jQuery('.monanthu3td5').append('<td class="monanthu3td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td6"></tr>');

                                jQuery('.monanthu3td6').append('<td class="monanthu3td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td7"></tr>');

                                jQuery('.monanthu3td7').append('<td class="monanthu3td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td8"></tr>');

                                jQuery('.monanthu3td8').append('<td class="monanthu3td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td10"></tr>');

                                jQuery('.monanthu3td10').append('<td class="monanthu3td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu3-4').click(function() {

            var vbtr=jQuery('.monanthu3 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu3 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu3calo').html('');

            jQuery('.tongmonanthu3protein').html('');

            jQuery('.tongmonanthu3glucid').html('');

             jQuery('.tongmonanthu3lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu3-4').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu3calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu3protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu3glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu3lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td1"></tr>');

                                jQuery('.monanthu3td1').append('<td class="monanthu3td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td2"></tr>');

                                jQuery('.monanthu3td2').append('<td class="monanthu3td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td3"></tr>');

                                jQuery('.monanthu3td3').append('<td class="monanthu3td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td4"></tr>');

                                jQuery('.monanthu3td4').append('<td class="monanthu3td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td9"></tr>');

                                jQuery('.monanthu3td9').append('<td class="monanthu3td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td5"></tr>');

                                jQuery('.monanthu3td5').append('<td class="monanthu3td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td6"></tr>');

                                jQuery('.monanthu3td6').append('<td class="monanthu3td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td7"></tr>');

                                jQuery('.monanthu3td7').append('<td class="monanthu3td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td8"></tr>');

                                jQuery('.monanthu3td8').append('<td class="monanthu3td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu3').append('<tr class="monanthu3td10"></tr>');

                                jQuery('.monanthu3td10').append('<td class="monanthu3td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu3td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu3td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu3td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu3td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu3td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

    </script>

    

<?php



}



add_shortcode( 'thu3', 'create_shortcode_thu3' );

// ++++++++++++++++++++++++++++++Thứ 4++++++++++++++++++++++++++++++++++++++++

function create_shortcode_thu4() {

    global $wpdb;

    $list_ngay = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'thuc_don WHERE td_thu = "Thứ 4"');

    $date = getdate();
    $date['mon'];
    $list_monan = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'thuc_don WHERE td_ngay != ""');

?>

    <div class="vb-thucdon">

        <ul>
            <?php if (!empty($list_ngay)): $vbi=0; ?>
            		
                <?php foreach ($list_ngay as $key => $value): ?>
                	<?php $vbngay=$value->td_ngay;
                	$vbngay=substr($vbngay, 3,2);  
                	if($vbngay==$date['mon']):
                	?>
                    <li class="vbthu4-<?php echo $vbi ?>"><?php echo $value->td_ngay;?></li>

					<?php $vbi ++; endif ?>
                <?php endforeach ?>

            <?php endif ?>

        </ul>

        <table class="monanthu4">

            <tr>

                <th>Món ăn</th>

                <th>Calo</th>

                <th>Protein</th>

                <th>Glucid</th>

                <th>Lipid</th>

            </tr>

        </table>

        <table class="tongmonanthu4">

            <tr>

                <th>Tổng</th>

                <th class="tongmonanthu4calo"></th>

                <th class="tongmonanthu4protein"></th>

                <th class="tongmonanthu4glucid"></th>

                <th class="tongmonanthu4lipid"></th>

            </tr>

        </table>

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

        jQuery(window).load(function() {

            var vbtr=jQuery('.monanthu4 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu4 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu4calo').html('');

            jQuery('.tongmonanthu4protein').html('');

            jQuery('.tongmonanthu4glucid').html('');

             jQuery('.tongmonanthu4lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu4-0').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu4calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu4protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu4glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu4lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td1"></tr>');

                                jQuery('.monanthu4td1').append('<td class="monanthu4td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td2"></tr>');

                                jQuery('.monanthu4td2').append('<td class="monanthu4td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td3"></tr>');

                                jQuery('.monanthu4td3').append('<td class="monanthu4td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td4"></tr>');

                                jQuery('.monanthu4td4').append('<td class="monanthu4td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td9"></tr>');

                                jQuery('.monanthu4td9').append('<td class="monanthu4td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td5"></tr>');

                                jQuery('.monanthu4td5').append('<td class="monanthu4td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td6"></tr>');

                                jQuery('.monanthu4td6').append('<td class="monanthu4td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td7"></tr>');

                                jQuery('.monanthu4td7').append('<td class="monanthu4td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td8"></tr>');

                                jQuery('.monanthu4td8').append('<td class="monanthu4td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td10"></tr>');

                                jQuery('.monanthu4td10').append('<td class="monanthu4td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }



                                });

                            } 

                            

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu4-0').click(function() {

            var vbtr=jQuery('.monanthu4 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu4 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu4calo').html('');

            jQuery('.tongmonanthu4protein').html('');

            jQuery('.tongmonanthu4glucid').html('');jQuery('.tongmonanthu4lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu4-0').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu4calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu4protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu4glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu4lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td1"></tr>');

                                jQuery('.monanthu4td1').append('<td class="monanthu4td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td2"></tr>');

                                jQuery('.monanthu4td2').append('<td class="monanthu4td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td3"></tr>');

                                jQuery('.monanthu4td3').append('<td class="monanthu4td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td4"></tr>');

                                jQuery('.monanthu4td4').append('<td class="monanthu4td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td9"></tr>');

                                jQuery('.monanthu4td9').append('<td class="monanthu4td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td5"></tr>');

                                jQuery('.monanthu4td5').append('<td class="monanthu4td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td6"></tr>');

                                jQuery('.monanthu4td6').append('<td class="monanthu4td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td7"></tr>');

                                jQuery('.monanthu4td7').append('<td class="monanthu4td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td8"></tr>');

                                jQuery('.monanthu4td8').append('<td class="monanthu4td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td10"></tr>');

                                jQuery('.monanthu4td10').append('<td class="monanthu4td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }



                                });

                            } 

                            

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu4-1').click(function() {

            var vbtr=jQuery('.monanthu4 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu4 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu4calo').html('');

            jQuery('.tongmonanthu4protein').html('');

            jQuery('.tongmonanthu4glucid').html('');jQuery('.tongmonanthu4lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu4-1').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu4calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu4protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu4glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu4lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td1"></tr>');

                                jQuery('.monanthu4td1').append('<td class="monanthu4td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td2"></tr>');

                                jQuery('.monanthu4td2').append('<td class="monanthu4td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td3"></tr>');

                                jQuery('.monanthu4td3').append('<td class="monanthu4td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td4"></tr>');

                                jQuery('.monanthu4td4').append('<td class="monanthu4td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td9"></tr>');

                                jQuery('.monanthu4td9').append('<td class="monanthu4td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td5"></tr>');

                                jQuery('.monanthu4td5').append('<td class="monanthu4td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td6"></tr>');

                                jQuery('.monanthu4td6').append('<td class="monanthu4td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td7"></tr>');

                                jQuery('.monanthu4td7').append('<td class="monanthu4td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td8"></tr>');

                                jQuery('.monanthu4td8').append('<td class="monanthu4td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td10"></tr>');

                                jQuery('.monanthu4td10').append('<td class="monanthu4td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu4-2').click(function() {

            var vbtr=jQuery('.monanthu4 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu4 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu4calo').html('');

            jQuery('.tongmonanthu4protein').html('');

            jQuery('.tongmonanthu4glucid').html('');jQuery('.tongmonanthu4lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu4-2').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu4calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu4protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu4glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu4lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td1"></tr>');

                                jQuery('.monanthu4td1').append('<td class="monanthu4td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td2"></tr>');

                                jQuery('.monanthu4td2').append('<td class="monanthu4td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td3"></tr>');

                                jQuery('.monanthu4td3').append('<td class="monanthu4td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td4"></tr>');

                                jQuery('.monanthu4td4').append('<td class="monanthu4td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td9"></tr>');

                                jQuery('.monanthu4td9').append('<td class="monanthu4td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td5"></tr>');

                                jQuery('.monanthu4td5').append('<td class="monanthu4td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td6"></tr>');

                                jQuery('.monanthu4td6').append('<td class="monanthu4td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td7"></tr>');

                                jQuery('.monanthu4td7').append('<td class="monanthu4td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td8"></tr>');

                                jQuery('.monanthu4td8').append('<td class="monanthu4td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td10"></tr>');

                                jQuery('.monanthu4td10').append('<td class="monanthu4td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu4-3').click(function() {

            var vbtr=jQuery('.monanthu4 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu4 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu4calo').html('');

            jQuery('.tongmonanthu4protein').html('');

            jQuery('.tongmonanthu4glucid').html('');jQuery('.tongmonanthu4lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu4-3').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu4calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu4protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu4glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu4lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td1"></tr>');

                                jQuery('.monanthu4td1').append('<td class="monanthu4td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td2"></tr>');

                                jQuery('.monanthu4td2').append('<td class="monanthu4td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td3"></tr>');

                                jQuery('.monanthu4td3').append('<td class="monanthu4td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td4"></tr>');

                                jQuery('.monanthu4td4').append('<td class="monanthu4td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td9"></tr>');

                                jQuery('.monanthu4td9').append('<td class="monanthu4td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td5"></tr>');

                                jQuery('.monanthu4td5').append('<td class="monanthu4td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td6"></tr>');

                                jQuery('.monanthu4td6').append('<td class="monanthu4td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td7"></tr>');

                                jQuery('.monanthu4td7').append('<td class="monanthu4td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td8"></tr>');

                                jQuery('.monanthu4td8').append('<td class="monanthu4td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td10"></tr>');

                                jQuery('.monanthu4td10').append('<td class="monanthu4td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu4-4').click(function() {

            var vbtr=jQuery('.monanthu4 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu4 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu4calo').html('');

            jQuery('.tongmonanthu4protein').html('');

            jQuery('.tongmonanthu4glucid').html('');jQuery('.tongmonanthu4lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu4-4').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu4calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu4protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu4glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu4lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td1"></tr>');

                                jQuery('.monanthu4td1').append('<td class="monanthu4td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td2"></tr>');

                                jQuery('.monanthu4td2').append('<td class="monanthu4td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td3"></tr>');

                                jQuery('.monanthu4td3').append('<td class="monanthu4td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td4"></tr>');

                                jQuery('.monanthu4td4').append('<td class="monanthu4td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td9"></tr>');

                                jQuery('.monanthu4td9').append('<td class="monanthu4td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td5"></tr>');

                                jQuery('.monanthu4td5').append('<td class="monanthu4td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td6"></tr>');

                                jQuery('.monanthu4td6').append('<td class="monanthu4td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td7"></tr>');

                                jQuery('.monanthu4td7').append('<td class="monanthu4td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td8"></tr>');

                                jQuery('.monanthu4td8').append('<td class="monanthu4td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu4').append('<tr class="monanthu4td10"></tr>');

                                jQuery('.monanthu4td10').append('<td class="monanthu4td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu4td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu4td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu4td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu4td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu4td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

    </script>

    

<?php



}



add_shortcode( 'thu4', 'create_shortcode_thu4' );

// ++++++++++++++++++++++++++++++Thứ 5++++++++++++++++++++++++++++++++++++++++

function create_shortcode_thu5() {

    global $wpdb;

    $list_ngay = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'thuc_don WHERE td_thu = "Thứ 5"');

    $date = getdate();
    $date['mon'];
    $list_monan = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'thuc_don WHERE td_ngay != ""');

?>

    <div class="vb-thucdon">

        <ul>
            <?php if (!empty($list_ngay)): $vbi=0; ?>
            		
                <?php foreach ($list_ngay as $key => $value): ?>
                	<?php $vbngay=$value->td_ngay;
                	$vbngay=substr($vbngay, 3,2);  
                	if($vbngay==$date['mon']):
                	?>
                    <li class="vbthu5-<?php echo $vbi ?>"><?php echo $value->td_ngay;?></li>

					<?php $vbi ++; endif ?>
                <?php endforeach ?>

            <?php endif ?>

        </ul>

        <table class="monanthu5">

            <tr>

                <th>Món ăn</th>

                <th>Calo</th>

                <th>Protein</th>

                <th>Glucid</th>

                <th>Lipid</th>

            </tr>

        </table>

        <table class="tongmonanthu5">

            <tr>

                <th>Tổng</th>

                <th class="tongmonanthu5calo"></th>

                <th class="tongmonanthu5protein"></th>

                <th class="tongmonanthu5glucid"></th>

                <th class="tongmonanthu5lipid"></th>

            </tr>

        </table>

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

        jQuery(window).load(function() {

            var vbtr=jQuery('.monanthu5 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu5 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu5calo').html('');

            jQuery('.tongmonanthu5protein').html('');

            jQuery('.tongmonanthu5glucid').html('');jQuery('.tongmonanthu5lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu5-0').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu5calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu5protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu5glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu5lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td1"></tr>');

                                jQuery('.monanthu5td1').append('<td class="monanthu5td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td2"></tr>');

                                jQuery('.monanthu5td2').append('<td class="monanthu5td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td3"></tr>');

                                jQuery('.monanthu5td3').append('<td class="monanthu5td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td4"></tr>');

                                jQuery('.monanthu5td4').append('<td class="monanthu5td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td9"></tr>');

                                jQuery('.monanthu5td9').append('<td class="monanthu5td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td5"></tr>');

                                jQuery('.monanthu5td5').append('<td class="monanthu5td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td6"></tr>');

                                jQuery('.monanthu5td6').append('<td class="monanthu5td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td7"></tr>');

                                jQuery('.monanthu5td7').append('<td class="monanthu5td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td8"></tr>');

                                jQuery('.monanthu5td8').append('<td class="monanthu5td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td10"></tr>');

                                jQuery('.monanthu5td10').append('<td class="monanthu5td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }



                                });

                            } 

                            

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu5-0').click(function() {

            var vbtr=jQuery('.monanthu5 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu5 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu5calo').html('');

            jQuery('.tongmonanthu5protein').html('');

            jQuery('.tongmonanthu5glucid').html('');jQuery('.tongmonanthu5lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu5-0').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu5calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu5protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu5glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu5lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td1"></tr>');

                                jQuery('.monanthu5td1').append('<td class="monanthu5td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td2"></tr>');

                                jQuery('.monanthu5td2').append('<td class="monanthu5td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td3"></tr>');

                                jQuery('.monanthu5td3').append('<td class="monanthu5td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td4"></tr>');

                                jQuery('.monanthu5td4').append('<td class="monanthu5td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td9"></tr>');

                                jQuery('.monanthu5td9').append('<td class="monanthu5td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td5"></tr>');

                                jQuery('.monanthu5td5').append('<td class="monanthu5td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td6"></tr>');

                                jQuery('.monanthu5td6').append('<td class="monanthu5td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td7"></tr>');

                                jQuery('.monanthu5td7').append('<td class="monanthu5td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td8"></tr>');

                                jQuery('.monanthu5td8').append('<td class="monanthu5td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td10"></tr>');

                                jQuery('.monanthu5td10').append('<td class="monanthu5td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }



                                });

                            } 

                            

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu5-1').click(function() {

            var vbtr=jQuery('.monanthu5 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu5 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu5calo').html('');

            jQuery('.tongmonanthu5protein').html('');

            jQuery('.tongmonanthu5glucid').html('');jQuery('.tongmonanthu5lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu5-1').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu5calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu5protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu5glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu5lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td1"></tr>');

                                jQuery('.monanthu5td1').append('<td class="monanthu5td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td2"></tr>');

                                jQuery('.monanthu5td2').append('<td class="monanthu5td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td3"></tr>');

                                jQuery('.monanthu5td3').append('<td class="monanthu5td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td4"></tr>');

                                jQuery('.monanthu5td4').append('<td class="monanthu5td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td9"></tr>');

                                jQuery('.monanthu5td9').append('<td class="monanthu5td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td5"></tr>');

                                jQuery('.monanthu5td5').append('<td class="monanthu5td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td6"></tr>');

                                jQuery('.monanthu5td6').append('<td class="monanthu5td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td7"></tr>');

                                jQuery('.monanthu5td7').append('<td class="monanthu5td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td8"></tr>');

                                jQuery('.monanthu5td8').append('<td class="monanthu5td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td10"></tr>');

                                jQuery('.monanthu5td10').append('<td class="monanthu5td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu5-2').click(function() {

            var vbtr=jQuery('.monanthu5 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu5 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu5calo').html('');

            jQuery('.tongmonanthu5protein').html('');

            jQuery('.tongmonanthu5glucid').html('');jQuery('.tongmonanthu5lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu5-2').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu5calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu5protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu5glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu5lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td1"></tr>');

                                jQuery('.monanthu5td1').append('<td class="monanthu5td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td2"></tr>');

                                jQuery('.monanthu5td2').append('<td class="monanthu5td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td3"></tr>');

                                jQuery('.monanthu5td3').append('<td class="monanthu5td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td4"></tr>');

                                jQuery('.monanthu5td4').append('<td class="monanthu5td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td9"></tr>');

                                jQuery('.monanthu5td9').append('<td class="monanthu5td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td5"></tr>');

                                jQuery('.monanthu5td5').append('<td class="monanthu5td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td6"></tr>');

                                jQuery('.monanthu5td6').append('<td class="monanthu5td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td7"></tr>');

                                jQuery('.monanthu5td7').append('<td class="monanthu5td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td8"></tr>');

                                jQuery('.monanthu5td8').append('<td class="monanthu5td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td10"></tr>');

                                jQuery('.monanthu5td10').append('<td class="monanthu5td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu5-3').click(function() {

            var vbtr=jQuery('.monanthu5 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu5 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu5calo').html('');

            jQuery('.tongmonanthu5protein').html('');

            jQuery('.tongmonanthu5glucid').html('');jQuery('.tongmonanthu5lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu5-3').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu5calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu5protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu5glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu5lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td1"></tr>');

                                jQuery('.monanthu5td1').append('<td class="monanthu5td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td2"></tr>');

                                jQuery('.monanthu5td2').append('<td class="monanthu5td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td3"></tr>');

                                jQuery('.monanthu5td3').append('<td class="monanthu5td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td4"></tr>');

                                jQuery('.monanthu5td4').append('<td class="monanthu5td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td9"></tr>');

                                jQuery('.monanthu5td9').append('<td class="monanthu5td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td5"></tr>');

                                jQuery('.monanthu5td5').append('<td class="monanthu5td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td6"></tr>');

                                jQuery('.monanthu5td6').append('<td class="monanthu5td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td7"></tr>');

                                jQuery('.monanthu5td7').append('<td class="monanthu5td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td8"></tr>');

                                jQuery('.monanthu5td8').append('<td class="monanthu5td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td10"></tr>');

                                jQuery('.monanthu5td10').append('<td class="monanthu5td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu5-4').click(function() {

            var vbtr=jQuery('.monanthu5 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu5 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu5calo').html('');

            jQuery('.tongmonanthu5protein').html('');

            jQuery('.tongmonanthu5glucid').html('');jQuery('.tongmonanthu5lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu5-4').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu5calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu5protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu5glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu5lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td1"></tr>');

                                jQuery('.monanthu5td1').append('<td class="monanthu5td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td2"></tr>');

                                jQuery('.monanthu5td2').append('<td class="monanthu5td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td3"></tr>');

                                jQuery('.monanthu5td3').append('<td class="monanthu5td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td4"></tr>');

                                jQuery('.monanthu5td4').append('<td class="monanthu5td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td9"></tr>');

                                jQuery('.monanthu5td9').append('<td class="monanthu5td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td5"></tr>');

                                jQuery('.monanthu5td5').append('<td class="monanthu5td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td6"></tr>');

                                jQuery('.monanthu5td6').append('<td class="monanthu5td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td7"></tr>');

                                jQuery('.monanthu5td7').append('<td class="monanthu5td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td8"></tr>');

                                jQuery('.monanthu5td8').append('<td class="monanthu5td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu5').append('<tr class="monanthu5td10"></tr>');

                                jQuery('.monanthu5td10').append('<td class="monanthu5td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu5td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu5td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu5td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu5td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu5td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

    </script>

    

<?php



}



add_shortcode( 'thu5', 'create_shortcode_thu5' );

// ++++++++++++++++++++++++++++++Thứ 6++++++++++++++++++++++++++++++++++++++++

function create_shortcode_thu6() {

    global $wpdb;

    $list_ngay = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'thuc_don WHERE td_thu = "Thứ 6"');

    $date = getdate();
    $date['mon'];
    $list_monan = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'thuc_don WHERE td_ngay != ""');

?>

    <div class="vb-thucdon">

        <ul>
            <?php if (!empty($list_ngay)): $vbi=0; ?>
            		
                <?php foreach ($list_ngay as $key => $value): ?>
                	<?php $vbngay=$value->td_ngay;
                	$vbngay=substr($vbngay, 3,2);  
                	if($vbngay==$date['mon']):
                	?>
                    <li class="vbthu6-<?php echo $vbi ?>"><?php echo $value->td_ngay;?></li>

					<?php $vbi ++; endif ?>
                <?php endforeach ?>

            <?php endif ?>

        </ul>

        <table class="monanthu6">

            <tr>

                <th>Món ăn</th>

                <th>Calo</th>

                <th>Protein</th>

                <th>Glucid</th>

                <th>Lipid</th>

            </tr>

        </table>

        <table class="tongmonanthu6">

            <tr>

                <th>Tổng</th>

                <th class="tongmonanthu6calo"></th>

                <th class="tongmonanthu6protein"></th>

                <th class="tongmonanthu6glucid"></th>

                <th class="tongmonanthu6lipid"></th>

            </tr>

        </table>

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

        jQuery(window).load(function() {

            var vbtr=jQuery('.monanthu6 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu6 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu6calo').html('');

            jQuery('.tongmonanthu6protein').html('');

            jQuery('.tongmonanthu6glucid').html('');jQuery('.tongmonanthu6lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu6-0').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu6calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu6protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu6glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu6lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td1"></tr>');

                                jQuery('.monanthu6td1').append('<td class="monanthu6td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td2"></tr>');

                                jQuery('.monanthu6td2').append('<td class="monanthu6td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td3"></tr>');

                                jQuery('.monanthu6td3').append('<td class="monanthu6td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td4"></tr>');

                                jQuery('.monanthu6td4').append('<td class="monanthu6td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td9"></tr>');

                                jQuery('.monanthu6td9').append('<td class="monanthu6td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td5"></tr>');

                                jQuery('.monanthu6td5').append('<td class="monanthu6td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td6"></tr>');

                                jQuery('.monanthu6td6').append('<td class="monanthu6td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td7"></tr>');

                                jQuery('.monanthu6td7').append('<td class="monanthu6td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td8"></tr>');

                                jQuery('.monanthu6td8').append('<td class="monanthu6td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td10"></tr>');

                                jQuery('.monanthu6td10').append('<td class="monanthu6td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }



                                });

                            } 

                            

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu6-0').click(function() {

            var vbtr=jQuery('.monanthu6 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu6 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu6calo').html('');

            jQuery('.tongmonanthu6protein').html('');

            jQuery('.tongmonanthu6glucid').html('');jQuery('.tongmonanthu6lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu6-0').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu6calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu6protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu6glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu6lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td1"></tr>');

                                jQuery('.monanthu6td1').append('<td class="monanthu6td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td2"></tr>');

                                jQuery('.monanthu6td2').append('<td class="monanthu6td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td3"></tr>');

                                jQuery('.monanthu6td3').append('<td class="monanthu6td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td4"></tr>');

                                jQuery('.monanthu6td4').append('<td class="monanthu6td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td9"></tr>');

                                jQuery('.monanthu6td9').append('<td class="monanthu6td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td5"></tr>');

                                jQuery('.monanthu6td5').append('<td class="monanthu6td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td6"></tr>');

                                jQuery('.monanthu6td6').append('<td class="monanthu6td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td7"></tr>');

                                jQuery('.monanthu6td7').append('<td class="monanthu6td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td8"></tr>');

                                jQuery('.monanthu6td8').append('<td class="monanthu6td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td10"></tr>');

                                jQuery('.monanthu6td10').append('<td class="monanthu6td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }



                                });

                            } 

                            

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu6-1').click(function() {

            var vbtr=jQuery('.monanthu6 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu6 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu6calo').html('');

            jQuery('.tongmonanthu6protein').html('');

            jQuery('.tongmonanthu6glucid').html('');jQuery('.tongmonanthu6lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu6-1').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu6calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu6protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu6glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu6lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td1"></tr>');

                                jQuery('.monanthu6td1').append('<td class="monanthu6td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td2"></tr>');

                                jQuery('.monanthu6td2').append('<td class="monanthu6td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td3"></tr>');

                                jQuery('.monanthu6td3').append('<td class="monanthu6td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td4"></tr>');

                                jQuery('.monanthu6td4').append('<td class="monanthu6td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td9"></tr>');

                                jQuery('.monanthu6td9').append('<td class="monanthu6td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td5"></tr>');

                                jQuery('.monanthu6td5').append('<td class="monanthu6td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td6"></tr>');

                                jQuery('.monanthu6td6').append('<td class="monanthu6td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td7"></tr>');

                                jQuery('.monanthu6td7').append('<td class="monanthu6td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td8"></tr>');

                                jQuery('.monanthu6td8').append('<td class="monanthu6td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td10"></tr>');

                                jQuery('.monanthu6td10').append('<td class="monanthu6td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu6-2').click(function() {

            var vbtr=jQuery('.monanthu6 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu6 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu6calo').html('');

            jQuery('.tongmonanthu6protein').html('');

            jQuery('.tongmonanthu6glucid').html('');jQuery('.tongmonanthu6lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu6-2').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu6calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu6protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu6glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu6lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td1"></tr>');

                                jQuery('.monanthu6td1').append('<td class="monanthu6td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td2"></tr>');

                                jQuery('.monanthu6td2').append('<td class="monanthu6td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td3"></tr>');

                                jQuery('.monanthu6td3').append('<td class="monanthu6td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td4"></tr>');

                                jQuery('.monanthu6td4').append('<td class="monanthu6td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td9"></tr>');

                                jQuery('.monanthu6td9').append('<td class="monanthu6td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td5"></tr>');

                                jQuery('.monanthu6td5').append('<td class="monanthu6td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td6"></tr>');

                                jQuery('.monanthu6td6').append('<td class="monanthu6td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td7"></tr>');

                                jQuery('.monanthu6td7').append('<td class="monanthu6td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td8"></tr>');

                                jQuery('.monanthu6td8').append('<td class="monanthu6td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td10"></tr>');

                                jQuery('.monanthu6td10').append('<td class="monanthu6td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu6-3').click(function() {

            var vbtr=jQuery('.monanthu6 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu6 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu6calo').html('');

            jQuery('.tongmonanthu6protein').html('');

            jQuery('.tongmonanthu6glucid').html('');jQuery('.tongmonanthu6lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu6-3').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu6calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu6protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu6glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu6lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td1"></tr>');

                                jQuery('.monanthu6td1').append('<td class="monanthu6td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td2"></tr>');

                                jQuery('.monanthu6td2').append('<td class="monanthu6td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td3"></tr>');

                                jQuery('.monanthu6td3').append('<td class="monanthu6td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td4"></tr>');

                                jQuery('.monanthu6td4').append('<td class="monanthu6td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td9"></tr>');

                                jQuery('.monanthu6td9').append('<td class="monanthu6td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td5"></tr>');

                                jQuery('.monanthu6td5').append('<td class="monanthu6td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td6"></tr>');

                                jQuery('.monanthu6td6').append('<td class="monanthu6td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td7"></tr>');

                                jQuery('.monanthu6td7').append('<td class="monanthu6td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td8"></tr>');

                                jQuery('.monanthu6td8').append('<td class="monanthu6td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td10"></tr>');

                                jQuery('.monanthu6td10').append('<td class="monanthu6td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu6-4').click(function() {

            var vbtr=jQuery('.monanthu6 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu6 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu6calo').html('');

            jQuery('.tongmonanthu6protein').html('');

            jQuery('.tongmonanthu6glucid').html('');jQuery('.tongmonanthu6lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu6-4').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu6calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu6protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu6glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu6lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td1"></tr>');

                                jQuery('.monanthu6td1').append('<td class="monanthu6td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td2"></tr>');

                                jQuery('.monanthu6td2').append('<td class="monanthu6td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td3"></tr>');

                                jQuery('.monanthu6td3').append('<td class="monanthu6td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td4"></tr>');

                                jQuery('.monanthu6td4').append('<td class="monanthu6td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td9"></tr>');

                                jQuery('.monanthu6td9').append('<td class="monanthu6td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td5"></tr>');

                                jQuery('.monanthu6td5').append('<td class="monanthu6td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td6"></tr>');

                                jQuery('.monanthu6td6').append('<td class="monanthu6td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td7"></tr>');

                                jQuery('.monanthu6td7').append('<td class="monanthu6td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td8"></tr>');

                                jQuery('.monanthu6td8').append('<td class="monanthu6td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu6').append('<tr class="monanthu6td10"></tr>');

                                jQuery('.monanthu6td10').append('<td class="monanthu6td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu6td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu6td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu6td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu6td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu6td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

    </script>

    

<?php



}



add_shortcode( 'thu6', 'create_shortcode_thu6' );

// ++++++++++++++++++++++++++++++Thứ 7++++++++++++++++++++++++++++++++++++++++

function create_shortcode_thu7() {

    global $wpdb;

    $list_ngay = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'thuc_don WHERE td_thu = "Thứ 7"');

    $date = getdate();
    $date['mon'];
    $list_monan = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'thuc_don WHERE td_ngay != ""');

?>

    <div class="vb-thucdon">

        <ul>
            <?php if (!empty($list_ngay)): $vbi=0; ?>
            		
                <?php foreach ($list_ngay as $key => $value): ?>
                	<?php $vbngay=$value->td_ngay;
                	$vbngay=substr($vbngay, 3,2);  
                	if($vbngay==$date['mon']):
                	?>
                    <li class="vbthu7-<?php echo $vbi ?>"><?php echo $value->td_ngay;?></li>

					<?php $vbi ++; endif ?>
                <?php endforeach ?>

            <?php endif ?>

        </ul>

        <table class="monanthu7">

            <tr>

                <th>Món ăn</th>

                <th>Calo</th>

                <th>Protein</th>

                <th>Glucid</th>

                <th>Lipid</th>

            </tr>

        </table>

        <table class="tongmonanthu7">

            <tr>

                <th>Tổng</th>

                <th class="tongmonanthu7calo"></th>

                <th class="tongmonanthu7protein"></th>

                <th class="tongmonanthu7glucid"></th>

                <th class="tongmonanthu7lipid"></th>

            </tr>

        </table>

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

        jQuery(window).load(function() {

            var vbtr=jQuery('.monanthu7 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu7 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu7calo').html('');

            jQuery('.tongmonanthu7protein').html('');

            jQjQuery('.tongmonanthu7glucid').html('');jQuery('.tongmonanthu7lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu7-0').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu7calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu7protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu7glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu7lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td1"></tr>');

                                jQuery('.monanthu7td1').append('<td class="monanthu7td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td2"></tr>');

                                jQuery('.monanthu7td2').append('<td class="monanthu7td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td3"></tr>');

                                jQuery('.monanthu7td3').append('<td class="monanthu7td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td4"></tr>');

                                jQuery('.monanthu7td4').append('<td class="monanthu7td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td9"></tr>');

                                jQuery('.monanthu7td9').append('<td class="monanthu7td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td5"></tr>');

                                jQuery('.monanthu7td5').append('<td class="monanthu7td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td6"></tr>');

                                jQuery('.monanthu7td6').append('<td class="monanthu7td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td7"></tr>');

                                jQuery('.monanthu7td7').append('<td class="monanthu7td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td8"></tr>');

                                jQuery('.monanthu7td8').append('<td class="monanthu7td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td10"></tr>');

                                jQuery('.monanthu7td10').append('<td class="monanthu7td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }



                                });

                            } 

                            

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu7-0').click(function() {

            var vbtr=jQuery('.monanthu7 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu7 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu7calo').html('');

            jQuery('.tongmonanthu7protein').html('');

            jQjQuery('.tongmonanthu7glucid').html('');jQuery('.tongmonanthu7lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu7-0').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu7calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu7protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu7glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu7lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td1"></tr>');

                                jQuery('.monanthu7td1').append('<td class="monanthu7td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td2"></tr>');

                                jQuery('.monanthu7td2').append('<td class="monanthu7td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td3"></tr>');

                                jQuery('.monanthu7td3').append('<td class="monanthu7td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td4"></tr>');

                                jQuery('.monanthu7td4').append('<td class="monanthu7td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td9"></tr>');

                                jQuery('.monanthu7td9').append('<td class="monanthu7td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td5"></tr>');

                                jQuery('.monanthu7td5').append('<td class="monanthu7td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td6"></tr>');

                                jQuery('.monanthu7td6').append('<td class="monanthu7td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td7"></tr>');

                                jQuery('.monanthu7td7').append('<td class="monanthu7td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td8"></tr>');

                                jQuery('.monanthu7td8').append('<td class="monanthu7td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td10"></tr>');

                                jQuery('.monanthu7td10').append('<td class="monanthu7td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }



                                });

                            } 

                            

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu7-1').click(function() {

            var vbtr=jQuery('.monanthu7 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu7 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu7calo').html('');

            jQuery('.tongmonanthu7protein').html('');

            jQjQuery('.tongmonanthu7glucid').html('');jQuery('.tongmonanthu7lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu7-1').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu7calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu7protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu7glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu7lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td1"></tr>');

                                jQuery('.monanthu7td1').append('<td class="monanthu7td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td2"></tr>');

                                jQuery('.monanthu7td2').append('<td class="monanthu7td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td3"></tr>');

                                jQuery('.monanthu7td3').append('<td class="monanthu7td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td4"></tr>');

                                jQuery('.monanthu7td4').append('<td class="monanthu7td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td9"></tr>');

                                jQuery('.monanthu7td9').append('<td class="monanthu7td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td5"></tr>');

                                jQuery('.monanthu7td5').append('<td class="monanthu7td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td6"></tr>');

                                jQuery('.monanthu7td6').append('<td class="monanthu7td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td7"></tr>');

                                jQuery('.monanthu7td7').append('<td class="monanthu7td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td8"></tr>');

                                jQuery('.monanthu7td8').append('<td class="monanthu7td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td10"></tr>');

                                jQuery('.monanthu7td10').append('<td class="monanthu7td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu7-2').click(function() {

            var vbtr=jQuery('.monanthu7 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu7 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu7calo').html('');

            jQuery('.tongmonanthu7protein').html('');

            jQjQuery('.tongmonanthu7glucid').html('');jQuery('.tongmonanthu7lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu7-2').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu7calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu7protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu7glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu7lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td1"></tr>');

                                jQuery('.monanthu7td1').append('<td class="monanthu7td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td2"></tr>');

                                jQuery('.monanthu7td2').append('<td class="monanthu7td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td3"></tr>');

                                jQuery('.monanthu7td3').append('<td class="monanthu7td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td4"></tr>');

                                jQuery('.monanthu7td4').append('<td class="monanthu7td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td9"></tr>');

                                jQuery('.monanthu7td9').append('<td class="monanthu7td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td5"></tr>');

                                jQuery('.monanthu7td5').append('<td class="monanthu7td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td6"></tr>');

                                jQuery('.monanthu7td6').append('<td class="monanthu7td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td7"></tr>');

                                jQuery('.monanthu7td7').append('<td class="monanthu7td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td8"></tr>');

                                jQuery('.monanthu7td8').append('<td class="monanthu7td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td10"></tr>');

                                jQuery('.monanthu7td10').append('<td class="monanthu7td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu7-3').click(function() {

            var vbtr=jQuery('.monanthu7 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu7 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu7calo').html('');

            jQuery('.tongmonanthu7protein').html('');

            jQjQuery('.tongmonanthu7glucid').html('');jQuery('.tongmonanthu7lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu7-3').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu7calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu7protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu7glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu7lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td1"></tr>');

                                jQuery('.monanthu7td1').append('<td class="monanthu7td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td2"></tr>');

                                jQuery('.monanthu7td2').append('<td class="monanthu7td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td3"></tr>');

                                jQuery('.monanthu7td3').append('<td class="monanthu7td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td4"></tr>');

                                jQuery('.monanthu7td4').append('<td class="monanthu7td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td9"></tr>');

                                jQuery('.monanthu7td9').append('<td class="monanthu7td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td5"></tr>');

                                jQuery('.monanthu7td5').append('<td class="monanthu7td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td6"></tr>');

                                jQuery('.monanthu7td6').append('<td class="monanthu7td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td7"></tr>');

                                jQuery('.monanthu7td7').append('<td class="monanthu7td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td8"></tr>');

                                jQuery('.monanthu7td8').append('<td class="monanthu7td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td10"></tr>');

                                jQuery('.monanthu7td10').append('<td class="monanthu7td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

        jQuery('.vbthu7-4').click(function() {

            var vbtr=jQuery('.monanthu7 tr').size();

            if(vbtr>1){

                for (var i = 1; i<vbtr ; i++) {

                    jQuery(jQuery('.monanthu7 tr')[i]).addClass("vbremove");

                }

                jQuery('.vbremove').remove();

            }

            jQuery('.tongmonanthu7calo').html('');

            jQuery('.tongmonanthu7protein').html('');

            jQjQuery('.tongmonanthu7glucid').html('');jQuery('.tongmonanthu7lipid').html('');

            jQuery.ajax({

                type:"POST",

                url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-thuc-don.php',

                beforeSend: function( xhr ){

                jQuery('.loading-web').removeClass('hidden');

                },

                data:{'ngay':jQuery('.vbthu7-4').text().trim()},

                success:function(response){

                    if (response != 0) {

                        response = JSON.parse(response);

                        for(j=0;j < response.length;j++){ 

                            jQuery('.tongmonanthu7calo').text(response[j].td_e+'kcal');

                            jQuery('.tongmonanthu7protein').text(response[j].td_p+'g');

                            jQuery('.tongmonanthu7glucid').append(response[j].td_g+'g');

                            jQuery('.tongmonanthu7lipid').append(response[j].td_l+'g');

                            if(response[j].td_ma1 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td1"></tr>');

                                jQuery('.monanthu7td1').append('<td class="monanthu7td">'+response[j].td_ma1+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td1 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td1').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td1').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td1').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td1').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                            if(response[j].td_ma2 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td2"></tr>');

                                jQuery('.monanthu7td2').append('<td class="monanthu7td">'+response[j].td_ma2+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td2 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td2').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td2').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td2').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td2').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma3 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td3"></tr>');

                                jQuery('.monanthu7td3').append('<td class="monanthu7td">'+response[j].td_ma3+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td3 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td3').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td3').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td3').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td3').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma4 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td4"></tr>');

                                jQuery('.monanthu7td4').append('<td class="monanthu7td">'+response[j].td_ma4+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td4 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td4').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td4').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td4').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td4').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma9 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td9"></tr>');

                                jQuery('.monanthu7td9').append('<td class="monanthu7td">'+response[j].td_ma9+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td9 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td9').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td9').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td9').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td9').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma5 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td5"></tr>');

                                jQuery('.monanthu7td5').append('<td class="monanthu7td">'+response[j].td_ma5+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td5 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td5').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td5').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td5').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td5').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma6 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td6"></tr>');

                                jQuery('.monanthu7td6').append('<td class="monanthu7td">'+response[j].td_ma6+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td6 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td6').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td6').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td6').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td6').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }                             

                            if(response[j].td_ma7 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td7"></tr>');

                                jQuery('.monanthu7td7').append('<td class="monanthu7td">'+response[j].td_ma7+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td7 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td7').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td7').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td7').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td7').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma8 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td8"></tr>');

                                jQuery('.monanthu7td8').append('<td class="monanthu7td">'+response[j].td_ma8+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td8 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td8').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td8').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td8').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td8').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            }  

                            if(response[j].td_ma10 != "0"){

                                jQuery('.monanthu7').append('<tr class="monanthu7td10"></tr>');

                                jQuery('.monanthu7td10').append('<td class="monanthu7td">'+response[j].td_ma10+'</td>');

                                jQuery.ajax({

                                    type:"POST",

                                    url:'<?php echo NANG_LUONG_URL ?>inc/functions/ajax/load-mon-an.php',

                                    beforeSend: function( xhr ){

                                    jQuery('.loading-web').removeClass('hidden');

                                    },

                                    data:{'sang':jQuery('.monanthu7td10 td').text().trim()},

                                    success:function(response){ 

                                    if (response != 0) {

                                        response = JSON.parse(response);

                                        for(j=0;j < response.length;j++){ 

                                            jQuery('.monanthu7td10').append('<td>'+response[j].bs_e+'</td>');

                                            jQuery('.monanthu7td10').append('<td>'+response[j].bs_p+'</td>');

                                            jQuery('.monanthu7td10').append('<td>'+response[j].bs_g+'</td>');

                                            jQuery('.monanthu7td10').append('<td>'+response[j].bs_l+'</td>');

                                            }

                                            jQuery('.loading-web').addClass('hidden');

                                        }

                                    }

                                });

                            } 

                        }

                        jQuery('.loading-web').addClass('hidden');

                    }

                }

            });

        });

    </script>

    

<?php



}



add_shortcode( 'thu7', 'create_shortcode_thu7' );
//anh Ba
jQuery('.vb-tinh').appendTo('.vb-tinh-main');
jQuery(window).load(function() {
    jQuery('.vb-thucdon').each(function(){
        jQuery(jQuery(this).find('li')[0]).addClass('vb-showli');
        jQuery(this).find('li').each(function(){
        jQuery(this).click(function(){
        jQuery(this).parent().find('.vb-showli').removeClass('vb-showli');
        jQuery(this).addClass('vb-showli');
        });
    });
    });
    // jQuery('.vb-thucdon ul li').each(function(){
    //     jQuery(this).click(function(){
    //     jQuery('body').find('.vb-showli').removeClass('vb-showli');
    //     jQuery(this).addClass('vb-showli');
    //     });
    // });
});

//End A.Ba
var arrCHCB_nam = [700, 900, 980, 1140, 1330, 1520, 1610];
        var arrCHCB_nu = [660, 840, 920, 1050, 1260, 1410, 1310];
        var arrNCNL_nhe = [1.35, 1.45, 1.35, 1.4, 1.45, 1.5, 1.55];
        var arrNCNL_vua = [1.35, 1.45, 1.55, 1.6, 1.65, 1.7, 1.75];
        var arrNCNL_nang = [1.35, 1.45, 1.75, 1.8, 1.85, 1.9, 1.95];
function nhapKcal() {
            jQuery('.panel-tinh .panel:first-child').addClass('active');
            jQuery('.panel-tinh .panel:nth-child(2)').removeClass('active');
            jQuery('.tab-tinh .tab:first-child').addClass('active');
            jQuery('.tab-tinh .tab:nth-child(2)').removeClass('active');
        }
        function nhapKcal1() {
            jQuery('.panel-tinh .panel:first-child').addClass('active');
            jQuery('.tab-tinh .tab:first-child').addClass('active');
            jQuery('.tab-tinh .tab:nth-child(2)').removeClass('active');
        }
        function tinhKcal() {
            jQuery('.noti-warning').remove();
            jQuery('.panel-tinh .panel:nth-child(2)').addClass('active');
            jQuery('.panel-tinh .panel:first-child').removeClass('active');
            jQuery('.tab-tinh .tab:nth-child(2)').addClass('active');
            jQuery('.tab-tinh .tab:first-child').removeClass('active');
            var tuoi = Math.round(jQuery('#age').val());
            var gioiTinh = jQuery('#gioitinh').val();
            var cdld = jQuery('#cdld').val();

            if (tuoi == '') {
                nhapKcal();
                jQuery('label.age').append('<div class="noti-warning">Số tuổi bị bỏ trống</div>');
                jQuery('label.age').click();
            } else if (tuoi <= 0 || tuoi > 19) {
                nhapKcal();
                jQuery('label.age').append('<div class="noti-warning">Vui lòng nhập số tuổi hợp lệ (1 - 19)</div>');
                jQuery('label.age').click();
            } else {
                var ketQua;
                var keyAr;
                if (tuoi == 1 || tuoi == 2) {
                    keyAr = 0;
                } else if (tuoi == 3 || tuoi == 4 || tuoi == 5) {
                    keyAr = 1;
                } else if (tuoi == 6 || tuoi == 7) {
                    keyAr = 2;
                } else if (tuoi == 8 || tuoi == 9) {
                    keyAr = 3;
                } else if (tuoi == 10 || tuoi == 11) {
                    keyAr = 4;
                } else if (tuoi == 12 || tuoi == 13 || tuoi == 14) {
                    keyAr = 5;
                } else {
                    keyAr = 6;
                }
                if (gioiTinh == 'gioitinh_nam') {
                    var b = arrCHCB_nam;
                    gioiTinh = 'Nam';
                } else {
                    var b = arrCHCB_nu;
                    gioiTinh = 'Nữ';
                }
                if (cdld == 'cdld_nhe') {
                    var c = arrNCNL_nhe;
                    cdld = 'Nhẹ';
                } else if (cdld == 'cdld_vua') {
                    var c = arrNCNL_vua;
                    cdld = 'Vừa';
                } else {
                    var c = arrNCNL_nang;
                    cdld = 'Nặng';
                }
                ketQua = b[keyAr] * c[keyAr];

                jQuery('.ket-qua').text(ketQua.toFixed(2));
                jQuery('.kq-age').text(tuoi);
                jQuery('.kq-gt').text(gioiTinh);
                jQuery('.kq-cdld').text(cdld);

            }
        }
(function($){
    jQuery(document).ready(function(){
        jQuery(document).scroll(function(){
            jQuery('.slider .flickity-slider .col').css('height','100%');
            jQuery('.slider .flickity-slider .col-inner').css('height','100%');
            var allTitle = jQuery('.ovelay .post-title');
            var numberTitle = allTitle.length;
            for (i = 0; i < numberTitle; i++) {
                var textL = allTitle.eq(i).text();
                if (textL.length > 35) {
                    allTitle.eq(i).text(textL.slice(0, 35) + ' ...');
                }
            }
        });
        

    });
    
var input = jQuery('#search-tra_cuu');
var typingTimer;              
var doneTypingInterval = 1000;

//on keyup, start the countdown
input.on('keyup', function () {
  clearTimeout(typingTimer);
  typingTimer = setTimeout(fetchD, doneTypingInterval);
});

//on keydown, clear the countdown 
input.on('keydown', function () {
  clearTimeout(typingTimer);
});
    function fetchD() {
        // GET SEARCH TERM
        var data = new FormData();
        data.append('search-tra_cuu', document.getElementById("search-tra_cuu").value);
        data.append('ajax', 1);
        // AJAX SEARCH REQUEST
        var xhr = new XMLHttpRequest();
        xhr.open('POST', "/wp-content/plugins/nguyenlieu/inc/khoi-de-nho/tra-cuu.php", true);
        xhr.onload = function () {
          if (this.status==200) {
            var results = JSON.parse(this.response),
                wrapper = document.getElementById("results");
                wrapper_2 = document.getElementById("results_2");
            wrapper.innerHTML = "<table></table>";
            wrapper_2.innerHTML = "<table></table>";
            jQuery('<td><h1>Nguyên liệu</h1></td>').appendTo('#results table');
            jQuery('<td><h1>Món ăn sáng</h1></td>').appendTo('#results_2 table');
            if (results.length > 0) {
              for(var res of results) {
                var i = 0;
                var j = 0;
                var line = document.createElement("tr");
                var line_2 = document.createElement("tr");
                // line.innerHTML = res['user_login'] + " - " + res['user_email'];
                if (parseInt(res['id']) !== 0) {
                line.innerHTML = '<td>' + res['nl_ten'] + ' </td><td>Năng lượng: ' + res['nl_nang_luong_kcal'] + " KCal/100g" + '</td><td>Protein: ' + res['nl_protein'] + ' </td><td>Chất béo: ' + res['nl_lipid'] + ' </td><td style="width:111px;"><a href="'+res['nl_link']+'" style="color: #ffab00;">Chi tiết</a></td>';
                i++;
                } else {
                    line_2.innerHTML = '<td>' + res['nl_f2'] + ' </td><td>Năng lượng: ' + res['nl_f3'] + " KCal" + '</td><td>Protein: ' + res['nl_f4'] + ' </td><td>Chất béo: ' + res['nl_f5'] + ' </td><td style="width:111px;"><a href="#" style="color: #ffab00;">Chi tiết</a></td>';
                j++;
                }
                jQuery(line).appendTo('#results table');
                jQuery(line_2).appendTo('#results_2 table');
                if (document.getElementById("search-tra_cuu").value == '') {
                    line.innerHTML = '';
                    line_2.innerHTML = '';
                }
              }
                if ( i == 0 ) {
                    jQuery('<p>Không có Nguyên liệu</p>').appendTo('#results table')
                }
                if ( j == 0 ) {
                    jQuery('<p>Không có Món ăn</p>').appendTo('#results_2 table')
                }
            } else {
              wrapper.innerHTML = "Không có kết quả";
              wrapper_2.innerHTML = "";
            }
          } else {
            alert("ERROR LOADING FILE!");
          }
        };
        xhr.send(data);
        return false;
      }
})(jQuery)



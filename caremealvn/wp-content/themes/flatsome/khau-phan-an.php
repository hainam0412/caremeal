<?php
/*
 Template Name: khẩu phần ăn
 */
?>
<?php get_header(); ?>
<?php
	global $wpdb;
	$list_monan = $wpdb->get_results( 'SELECT bs_ten FROM '.$wpdb->prefix.'bua_sang WHERE bs_ten != "" AND bs_ten IS NOT NULL GROUP BY bs_ten ORDER BY bs_ten ASC' );
?>
<div class="vb-main container">
    <div class="vb-kpa-header"><h1>Xây Dựng Khẩu Phần Ăn</h1></div>
    <div class="vb-nhap-thongtin">
        <form  method="post" action="/khuyen-nghi" >
            <label>Nhập tuổi (Với trẻ em dưới 1 tuổi điền theo tháng. Vd: 5 tháng)<br>
                <input type="text" name="xd_tuoi" >
            </label>
            <label class="vb-gioitinh">Giới tính<br>
                <input type="text" name="xd_gioitinh" style="display:none" value="0">
                <input type="radio" name="vb_gioitinh" value="nam">Nam
                <input type="radio" name="vb_gioitinh" value="nu">Nữ
            </label>
            <label class="vb-phunu">Bỏ qua nếu không thuộc 2 trường hợp bên dưới<br>
                <input type="text" name="xd_phunu" style="display:none" value="0">
                <input type="radio" name="vb_phunu" value="pnct">Phụ nữ đã có thai(6 tháng cuối)
                <input type="radio" name="vb_phunu" value="pncbu">Phụ nữ cho con bú (6 tháng đầu)
            </label>
            <label class="vb-laodong">Loại lao động<br>
                <input type="text" name="xd_laodong" style="display:none" value="khong">
                <input type="radio" name="vb_laodong" value="nhe">Nhẹ
                <input type="radio" name="vb_laodong" value="vua">Vừa
                <input type="radio" name="vb_laodong" value="nang">Nặng
            </label>
            <label>Chọn bữa ăn sáng<br>
                <input type="text" name="xd_sang" style="display: none" value="0">
                <select class="vb-xd-sang">
                    <option>Món ăn</option>
                    <?php if (!empty($list_monan)): ?>
                        <?php foreach ($list_monan as $key => $value): ?>
                            <option<?php echo !empty($_REQUEST['bs_ten']) && $_REQUEST['bs_ten'] == $value->bs_ten ? ' selected=""' : '' ?> value="<?php echo $value->bs_ten ?>"><?php echo $value->bs_ten ?></option>
                        <?php endforeach ?>
                    <?php endif ?>
                </select>
            </label>
            <label>Chọn bữa ăn trưa<br>
                <input type="text" name="xd_trua" style="display: none" value="0">
                <select class="vb-xd-trua">
                    <option>Món ăn</option>
                    <?php if (!empty($list_monan)): ?>
                        <?php foreach ($list_monan as $key => $value): ?>
                            <option<?php echo !empty($_REQUEST['bs_ten']) && $_REQUEST['bs_ten'] == $value->bs_ten ? ' selected=""' : '' ?> value="<?php echo $value->bs_ten ?>"><?php echo $value->bs_ten ?></option>
                        <?php endforeach ?>
                    <?php endif ?>
                </select>
            </label>
            <input type="submit" value="gửi" style="display:none">
            <a href="#" class="vb-ktra btn default">Kiểm tra</a>
        </form>
    </div>
</div>
<script>
    (function($){
        $('.vb-gioitinh').hide();
        $('.vb-phunu').hide();
        $('.vb-laodong').hide();
        $('input[name="xd_tuoi"]').change(function(){
            var a = $(this).val();
            a=a.trim();
            a=a.toLowerCase();
            var b = a.match(/\d/g);
            let c = b.join(""); 
            if(a.indexOf('tháng')>=0 || a.indexOf('thang')>=0){
                $('.vb-gioitinh').slideUp(); 
                $('.vb-phunu').slideUp();
                $('.vb-laodong').slideUp();
                $('input[name="xd_gioitinh"]').val("0");
                $('input[name="xd_phunu"]').val("0");
                $('input[name="xd_laodong"]').val("khong");
            }
            else  if(Number(c)<10){
                $('.vb-gioitinh').slideUp(); 
                $('.vb-phunu').slideUp();
                $('.vb-laodong').slideUp();
                $('input[name="xd_gioitinh"]').val("0");
                $('input[name="xd_phunu"]').val("0");
                $('input[name="xd_laodong"]').val("khong");
            } else if(Number(c)<18){
                $('.vb-gioitinh').slideDown(); 
                $('.vb-laodong').slideUp();
                $('input[name="xd_laodong"]').val("khong");
            }else{
                 $('.vb-gioitinh').slideDown(); 
                $('.vb-laodong').slideDown();
            }
            $( '.vb-gioitinh input[type="radio"]' ).on( "click", function() {
                $('input[name="xd_gioitinh"]').val($( '.vb-gioitinh input[type="radio"]:checked' ).val());
                if(jQuery( '.vb-gioitinh input[type="radio"]:checked' ).val().trim()=="nu"){
                    jQuery('.vb-phunu').slideDown(); 
                } else{jQuery('.vb-phunu').slideUp(); }
            });
            $( '.vb-phunu input[type="radio"]' ).on( "click", function() {
                $('input[name="xd_phunu"]').val($( '.vb-phunu input[type="radio"]:checked' ).val());
            });
             $( '.vb-laodong input[type="radio"]' ).on( "click", function() {
                $('input[name="xd_laodong"]').val($( '.vb-laodong input[type="radio"]:checked' ).val());
            });
        });
//Lấy dữ liệu bữa sáng + bữa trưa
        $('.vb-xd-sang').change(function(){
            var vbsang = $(this).val();
            if(vbsang.toUpperCase().trim()=="MÓN ĂN"){
        	    vbsang="0";
        	} 
        	$('input[name="xd_sang"]').val(vbsang);
        });
        $('.vb-xd-trua').change(function(){
            var vbtrua = $(this).val();
            if(vbtrua.toUpperCase().trim()=="MÓN ĂN"){
        	    vbtrua="0";
        	} 
        	$('input[name="xd_trua"]').val(vbtrua);
        });
//Xây dựng nút Button kiểm tra
        $('.vb-ktra').click(function(e){
            e.preventDefault();
            var x = $('input[name="xd_tuoi"]').val().trim();
            var y = x.match(/\d/g);
            let vbtt="";
            if(y==null){
                alert("Chưa nhập tuổi");
            }else if(	$('input[name="xd_sang"]').val().trim()=="0"){
                alert("Chưa chọn món ăn bữa sáng");
            }
            else if(	$('input[name="xd_trua"]').val().trim()=="0"){
                alert("Chưa chọn món ăn bữa trưa");
            }else{
                let z = y.join("");
                if(Number(z)>=10){
                    if($('input[name="xd_gioitinh"]').val().trim()=="0"){
                        alert("Chưa nhập giới tính");
                    }else if(Number(z)>=18){
                        if($('input[name="xd_laodong"]').val().trim()=="khong"){
                        alert("Chưa chọn loại lao động");
                        }else{
                             $('input[type="submit"]').trigger('click');
                        }
                    }
                }else{
                    $('input[type="submit"]').trigger('click');
                }
            } 
        });
    })(jQuery);
</script>
<?php get_footer(); ?>
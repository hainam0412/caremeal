//--------------------------------------------------------------------------
//Input ảnh đại diện (Nguyên liệu, món ăn)
//▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();                
    reader.onload = function(e) {
      jQuery('#blah').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]); 
  }
}
jQuery("#imgInp").change(function() {
  readURL(this);
});

//--------------------------------------------------------------------------
//Input ảnh chi tiết (Nguyên liệu)
//▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
function readURL_2(input) {
  if (input.files && input.files[0]) {
    var reader_2 = new FileReader();
    reader_2.onload = function(e) {
      jQuery('#blah_2').attr('src', e.target.result);
    }
    reader_2.readAsDataURL(input.files[0]); 
  }
}
jQuery("#imgInp_2").change(function() {
  readURL_2(this);
});

//--------------------------------------------------------------------------
//Input nhóm nguyên liệu
//▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
jQuery('.vb-nhap__thong-tin select').change(function(){
  jQuery('input[name="nhom"]').val(jQuery('.vb-nhap__thong-tin select option:selected').val());
});

//--------------------------------------------------------------------------
//Xóa nguyên liệu
//▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
jQuery('input[name="xoa_all_nguyen_lieu"]').change(function() {
  if (jQuery(this).prop('checked') == true) {
    jQuery('.input_xoa_nguyen_lieu').prop('checked', true);
  } else {
    jQuery('.input_xoa_nguyen_lieu').prop('checked', false);
  }
});

//--------------------------------------------------------------------------
//Thêm nhóm món ăn
//▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
if(jQuery('.cm-add__mon-an #ma1').prop('checked')){
  jQuery('.cm-add__mon-an input[name="nhom"]').val()
}
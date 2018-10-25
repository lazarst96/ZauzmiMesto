$(".custom-select2").select2({
   	minimumResultsForSearch: -1
});
$(".custom-select-kw").select2({
    placeholder:"Keywords",
    allowClear: true
});
$(".select-map-search").change(function(){
	var val = $(this).val();
	var parent = $(this).parent();
	var txt = parent.find(".select2-selection__rendered").text();
	if(val!=""){
		var rez = '<i class="fas fa-check blue_text mr-1"></i>'+txt;
		parent.find(".select2-selection__rendered").html(rez);
	}else{
		parent.find(".select2-selection__rendered").html(txt);
	}
});
$(function () {
	$('[data-toggle="popover"]').popover()
});
$("#sort").change(function(){
	$("#orderby").val($("#sort").val());
});

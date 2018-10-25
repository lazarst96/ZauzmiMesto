function update_state(type,table_id,el){
	var csrf = $("input[name=csrf_test_name]").val();
	var nth=parseInt(el.attr("data-num"))+1;
	var target = $(".number_tables:nth-child("+nth+")").find("span");
	var full = parseInt(el.attr("data-full"));
	var val = parseInt(target.text())+((type)?1:-1);

	if(val>=0 && val<=full){
		$.ajax({
		    method: "POST",
		    url:"http://localhost/ZauzmiMesto/Ajax/update_status",
		    data: {csrf_test_name:csrf, table_id:table_id, flag:type},
		    error: function(xhr, status, error) {
		      console.log(xhr.responseText);
		    },
		    success: function(data){
		    	data = JSON.parse(data);
		    	$("input[name=csrf_test_name]").val(data.csrf);
		    	target.text(parseInt(target.text())+((type)?1:-1));
		    	$("#message_up_st").text("");
		    }
		  });
	}else{
			
		$("#message_up_st").text("Broj stolova ide van granica.");
		
	}
	if(val==full || !val){
		el.prop( "disabled", true );
		//alert();

	}
}
$(".minus").click(function(){
	update_state(0,$(this).attr("data-table"),$(this))
});
$(".plus").click(function(){
	update_state(1,$(this).attr("data-table"),$(this));
});
$(".kanta").click(function(){
	var csrf = $("input[name=csrf_test_name]").val();
	var res_id = parseInt($(this).attr("data-res"));
	var nth = parseInt($(this).attr("data-nth"));
	var size = parseInt($("#tbody").attr("data-num"));
	var el = $(this);
	$.ajax({
	    method: "POST",
	    url:"http://localhost/ZauzmiMesto/Ajax/dalete_res",
	    data: {csrf_test_name:csrf, res_id:res_id},
	    error: function(xhr, status, error) {
	      console.log(xhr.responseText);
	    }
	}).done(function(data){
	    data = JSON.parse(data);
	    $("input[name=csrf_test_name]").val(data.csrf);
	   	el.parent().parent().remove();
	   	for(var i=1;i<=size-1;++i){
	   		$(".res_row:nth-child("+i+")").find("td:first-child").text(i);
	   		$(".res_row:nth-child("+i+")").find("td:last-child").find(".kanta").attr("data-nth",i);
	   	}
	     
	});
});

/*API_KEY=AIzaSyDU4qKYPgufm4rTQ_SZmBcJzqgbg2Qhc9Y*/
$(document).ready(function(){
	$('.regular').slick({
		infinite: true,
		speed: 500,
		slidesToShow: 3,
		slidesToScroll: 1,
		swipeToSlide:true,
		autoplay: true,
  		autoplaySpeed: 4000,
  		arrows: false,
		
		responsive: [
			{
			    breakpoint: 768,
			    settings: {
			    	slidesToShow: 1,
			    	slidesToScroll: 1,
			    	speed: 500,
				}
			},
			{
			    breakpoint: 960,
			    settings: {
			    	slidesToShow: 2,
			    	slidesToScroll: 1,
			    	speed: 500,
				}
			},
			{
			    breakpoint: 1920,
			    settings: {
			    	slidesToShow: 3,
			    	slidesToScroll: 1,
			    	speed: 500,
				}
			}

		]
	});
	$(function () {
		$('[data-toggle="popover"]').popover()
	});
	$(".custom-select").select2({
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
	$("#collapse_button").click(function(){
		if($(".navbar-collapse").hasClass("logged_user_nav_content") && $(".logged_user_nav_content").hasClass("flag_class")){
			
			setTimeout(function(){ 
				$(".logged_user_nav_content").removeClass("flag_class");
				$(".logged_user_nav_content").removeClass("flag2_class");
				var content=$(".nekaklasa").html();
				$(".logged_user_nav_content").html(content);
			 }, 300);
			
		}else{
			$(".logged_user_nav_content").addClass("flag_class");
			$(".logged_user_nav_content").addClass("flag2_class");
			var content='<div class="nekaklasa">'+$(".logged_user_nav_content").html()+'</div>';
			$(".logged_user_nav_content").html(content);
		}
		
	});
	$(window).resize(function(){
		if($(window).width()>=978 && $(".logged_user_nav_content").hasClass("flag_class") && $(".logged_user_nav_content").hasClass("flag2_class")){

			$(".logged_user_nav_content").removeClass("flag2_class");
			var content=$(".nekaklasa").html();
			$(".logged_user_nav_content").html(content);
			
		}
		if($(window).width()<978 && $(".logged_user_nav_content").hasClass("flag_class") && !$(".logged_user_nav_content").hasClass("flag2_class")){
			$(".logged_user_nav_content").addClass("flag2_class");
			var content='<div class="nekaklasa">'+$(".logged_user_nav_content").html()+'</div>';
			$(".logged_user_nav_content").html(content);
		}
	});
	$("#dugme").click(function(){
		getLocation();
	});
	function animateValue(id, duration) {
	var end= parseInt($(id).attr("data-number"));
	var start=0;
    var range = end - start;
    var current = start;
    var increment = end > start? 1 : -1;
    var stepTime = Math.abs(Math.floor(duration / range));
    var obj = $(id);
    var timer = setInterval(function() {
        current += increment;
        obj.html(current);
        if (current == end) {
            clearInterval(timer);
        }
    }, stepTime);
}

function elementInView(elem){
  return $(window).scrollTop() < $(elem).offset().top && $(window).scrollTop()+ $(window).height() > $(elem).offset().top+ $(elem).height();
};
var start_count1=false;
var start_count2=false;
var start_count3=false;
$(window).scroll(function(){
  if (elementInView($("#num_inf1"))){
  	if(!start_count1){
  		start_count1 = true;
  		animateValue("#num_inf1", 500);
  	}
  }
  if (elementInView($("#num_inf2"))){
  	if(!start_count2){
  		start_count2 = true;
  		animateValue("#num_inf2", 500);
  	}
  }
  if (elementInView($("#num_inf3"))){
  	if(!start_count3){
  		start_count3 = true;
  		animateValue("#num_inf3", 500);
  	}
  }
});

	


});
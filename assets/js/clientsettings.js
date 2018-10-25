$(document).ready(function(){
   	$("body").on('click','.change',function(){
   		var s = $(this).attr("data");
   		if (s=="izmenibroj"){
   			$("#pozivni").prop('disabled',false);
   			$("#mobilni").prop('disabled',false);
   			$("body").find("#pozivni").css("color", 'black');
   			$("body").find("#pozivni").css("background-color", 'white');
   			$("body").find("#mobilni").css("color", 'black');
   			$("body").find("#mobilni").css("background-color", 'white');
   		} else if (s=="izmenilozinku"){
   			var html = '<div class="form-group input-group"> <div class="input-group-prepend"> <span class="input-group-text"> <i class="fas fa-lock"></i> </span> </div> <input name="password" id="staralozinka" class="form-control" placeholder="Unesi staru lozinku" type="password">    <div class="input-group-prepend">    </div>  </div>  ';
   			var html1 = '<div class="form-group input-group"> <div class="input-group-prepend"> <span class="input-group-text"> <i class="fas fa-lock"></i> </span> </div> <input name="new_password" id="novalozinka1" class="form-control" placeholder="Nova lozinka" type="password">    <div class="input-group-prepend">  </div>  </div>  ';
   			var html2 = '<div class="form-group input-group"> <div class="input-group-prepend"> <span class="input-group-text"> <i class="fas fa-lock"></i> </span> </div> <input name="conf_password" id="novalozinka2" class="form-control lozinka" placeholder="Ponovi novu lozinku" type="password" >    <div class="input-group-prepend">   </div>  </div> <div id="provera"> </div> ';
   			var celo = html + html1 + html2;
   			$("#zalozinku").html(celo);
   
   
   		}
   
   
   		else{
   			$("body").find("#"+s).prop('disabled',false);
   			$("body").find("#"+s).css("color", 'black');
   			$("body").find("#"+s).css("background-color", 'white');
   			
   		}
   		
   	});
   	$("body").on('keyup','input.lozinka',function(){
   		var loz1 = $("#novalozinka1").val();
   		var loz2 = $("#novalozinka2").val();
   		if (loz1!=loz2){
   			$("#provera").html("<p style='color:red'> Lozinke se ne podudaraju</p>");
   		}else{
   			if (loz1.length < 8){
   				$("#provera").html("<p style='color:red'> Nova lozinka prekratka</p>");
   			}else{
   				$("#provera").html("<p style='color:green'> Lozinke se podudaraju</p>")
   			}
   		}
   	});
      function readURL(input) {

        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e) {
            $('#img_reg').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
        }
      }

      $("#profil_image").change(function() {
        readURL(this);
      });
});

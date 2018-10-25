<footer>
		<ul class="list_pictures_foot clearfix">
			<?php shuffle($all)?>
			<?php for($i=0;$i<20;++$i):?>
			<?php $place = $all[$i%count($all)]?>
			<li class="float-left" title="<?=$place->name?>">
				<a href=<?=company_href($place->username, $place->email)?>>
					<div class="picture_avatar">
						<img src=<?=base_url("assets/Slike/profil_pictures/".$place->user_id."/".$place->image)?> alt="">
						<div class="picture_overlay"></div>
					</div>
				</a>
			</li>
			<?php endfor?>
		</ul>
		<div class="all_rights">
			<div class="text-white">©All rights reserved Rasa and Laza.</div>
		</div>
</footer>


	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<?php foreach ($scripts as $link):?>
	<script type="text/javascript" src=<?=$link?>></script>
	<?php endforeach; ?>
	
	
	<!--
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDU4qKYPgufm4rTQ_SZmBcJzqgbg2Qhc9Y&callback=initMap"
    	async defer></script>
    -->
</body>
</html>
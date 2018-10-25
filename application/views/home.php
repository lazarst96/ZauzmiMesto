<div id="content" class="clearfix">
		<div class="map">
	      <div id="map"></div>
	      <div class="search-box-map">
	      	<h3 class="search-box-header font-weight-light">Pretraži objekte u okolini</h3>
	      	<?=form_open("",array("class"=>"form-search", "id"=>"form-search"))?>

	      		<div class="form-group">
                	 <select class="custom-select custom-select-kw darkblue_bg text-light" multiple="multiple" id="inputGroupSelect00">
                	 	<?php foreach ($keywords as $keyword):?>
	                    	<option value=<?=$keyword->id?>><?=$keyword->content?></option>
	                    <?php endforeach?>
	                </select>
                </div> 
                <div id="infolat" data-latitude="" data-longitude=""></div> 
                <div class="form-group">
	                <select class="custom-select  select-map-search" id="inputGroupSelect01">
	                    <option value="">Grad</option>
	                    <?php foreach ($cities as $city):?>
	                    	<option value=<?=$city->id?>><?=$city->name?></option>
	                    <?php endforeach?>
	                </select>
                </div>
                <div class="form-group">
                    <select class="custom-select select-map-search" id="inputGroupSelect02">
                        <option value="">Vrsta objekta</option>
                         <?php foreach ($company_types as $type):?>
	                    	<option value=<?=$type->id?>><?=$type->name?></option>
	                    <?php endforeach?>
                    </select>
                </div>
                <div class="form-group">
                    <select class="custom-select select-map-search" id="inputGroupSelect03">
                        <option value="">Udaljenost</option>
                        <?php foreach ($distances as $distance):?>
	                    	<option value=<?=$distance->id?>><?=$distance->value?></option>
	                    <?php endforeach?>
                    </select>
                </div>
                <!--<div class="form-group">
                    <select class="custom-select select-map-search" id="inputGroupSelect04">
                        <option value="">Specijalne ponude</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>-->
                <div class="form-group">
                    <button type="button" class="btn text-white font-weight-bold blue_bg col-4 col-md-6 m-auto d-block" id="dugme">Pretraži</button>
                </div>
            <?=form_close()?>
	      </div>
	    </div>
		<div class="section_header text-secondary d-flex justify-content-between align-items-center">
			<div>Najpopularniji</div>
			<a class="all_object_link text-secondary" href=<?=base_url("/search")?>>
				Svi objekti
				<i class="fas fa-angle-right blue_text"></i>
			</a>

		</div>
		<div class="regular slider">
		    <?php $i=0?>
		    <?php foreach ($most_popular as $place):?>
		    <div class="object_div">
		    	<span class="badge badge-light object_type" data-toggle="popover" title=<?=$place->type_name?> data-content="<?=$place->type_description?>">
					<?=badge($place->company_type)?>
		    	</span>
		    	<?php $i++?>
		    	<div class="image_div" style="background-image: url('<?=base_url("assets/Slike/profil_pictures/".$place->user_id."/".$place->image)?>');">
		    		<a href="<?=company_href($place->username,$place->email)?>" class="object_content">
		    			<h2 class="object_header text-white"><?=$place->name?></h2>
		    			<div class="object_adress text-white">
		    				<?=$place->country?>, <span class="blue_text font-weight-bold"><?=$place->city?></span>, <?=$place->address?>
		    			</div>
		    		</a>
		    		
		    	</div>
		    	<div class="object_info">
		    		<?php if($place->free){
		    				$class="blue_text";
		    				$text = "Slobodno";
		    			}else{
		    				$class="text-danger";
		    				$text = "Zauzeto";
		    			}
		    		?>
		    		<div class="row w-100 m-0">
		    			<div class="col-4 text-center text-white text-small d-flex align-items-center p-4">Trenutno: <span class="<?=$class?> font-weight-bold ml-1"><?=$text?></span></div>
		    			<?php if(working_status($place->open, $place->start_hour, $place->end_hour)!="Zatvoreno"){
		    				$class = "blue_text";
		    				$text = "Otvoreno";

		    			}else{
		    				$class = "text-danger";
		    				$text = "Zatvoreno";

		    			}?>
		    			<div class="col-4 text-center text-white text-small d-flex align-items-center p-2">Status: <span class="<?=$class?> font-weight-bold ml-1"><?=$text?></span></div>
		    			<div class="col-4 text-center text-white text-small d-flex align-items-center p-2">Slobodna Mesta: <span class="font-weight-bold ml-1"><?=$place->free_places?></span></div>
		    		</div>
		    	</div>
		    </div>
			<?php endforeach?>
		    
		</div>
		<div class="section_header text-secondary d-flex justify-content-between align-items-center">
			<div>Slobodna mesta</div>
			<a class="all_object_link text-secondary" href="<?=base_url("/search")?>">
				Svi objekti
				<i class="fas fa-angle-right blue_text"></i>
			</a>
			

		</div>
		<div class="object_list clearfix">
			<?php foreach ($free as $place):?>
			<div class="object_div new_user_obj_div float-left">
		    	<span class="badge badge-light object_type" data-toggle="popover" title=<?=$place->type_name?> data-content="<?=$place->type_description?>">
		    		<?=badge($place->company_type)?>
		    	</span>
		    	<div class="image_div" style="background-image: url('<?=base_url("assets/Slike/profil_pictures/".$place->user_id."/".$place->image)?>');">
					<a href="<?=company_href($place->username,$place->email)?>">
			    		<div class="object_content">
			    			<h2 class="object_header text-white"><?=$place->name?></h2>
			    			<div class="object_adress text-white">
			    				<?=$place->country?>, <span class="blue_text font-weight-bold"><?=$place->city?></span>, <?=$place->address?>
			    			</div>
			    		</div>
			    	</a>
		    		
		    	</div>
		    	<div class="object_info">
		    		<?php if($place->free){
		    				$class="blue_text";
		    				$text = "Slobodno";
		    			}else{
		    				$class="text-danger";
		    				$text = "Zauzeto";
		    			}
		    		?>
		    		<div class="row h-100 m-0">
		    			<div class="col-6 text-center text-white text-small1 d-flex align-items-center p-3">Trenutno: <span class="<?=$class?> font-weight-bold ml-1"><?=$text?></span></div>
		    			<?php if(working_status($place->open, $place->start_hour, $place->end_hour)!="Zatvoreno"){
		    				$class = "blue_text";
		    				$text = "Otvoreno";

		    			}else{
		    				$class = "text-danger";
		    				$text = "Zatvoreno";

		    			}?>
		    			<div class="col-4 text-center text-white text-small1 d-flex align-items-center p-2">Status: <span class="<?=$class?> font-weight-bold ml-1"><?=$text?></span></div>
		    		</div>
		    	</div>
		    </div>
			<?php endforeach ?>
		</div>
		<div class="section_header text-secondary d-flex justify-content-between align-items-center">
			<div>Statistika</div>
		</div>
		<div class="statistic_bloc row">
			<div class="col-md-4 col-12">
					<div class="border blue_border info_box w-75 m-auto p-3">
						<div class="border blue_border darkblue_bg badge_box d-flex ml-auto mr-auto align-items-center justify-content-around">
							<i class="fas fa-user-tie text-white"></i>
						</div>
						<div id="num_inf1" class="info_numbers display-4 p-2 text-center" data-number="<?=$active_users_count?>">
							0
						</div>
						<div class="header_stat h4 text-center p-3">Aktivnih Korisnika</div>
					</div>
				</div>
				<div class="col-md-4 col-12">
					<div class="border blue_border info_box w-75 m-auto p-3">
						<div class="border blue_border darkblue_bg badge_box d-flex ml-auto mr-auto align-items-center justify-content-around">
							<i class="fa fa-building text-white"></i>
						</div>
						<div id="num_inf2" class="info_numbers display-4 p-2 text-center" data-number="<?=$city_count?>">
							0
						</div>
						<div class="header_stat h4 text-center p-3">Broj Gradova</div>
					</div>
				</div><div class="col-md-4 col-12">
					<div class="border blue_border info_box w-75 m-auto p-3">
						<div class="border blue_border darkblue_bg badge_box d-flex ml-auto mr-auto align-items-center justify-content-around">
							<i class="fa fa-users text-white"></i>
						</div>
						<div id="num_inf3" class="info_numbers display-4 p-2 text-center" data-number="<?=$users_count?>">
							0
						</div>
						<div class="header_stat h4 text-center p-3">Ukupno Korisnika</div>
					</div>
				</div>
		</div>
		<div class="section_header text-secondary d-flex justify-content-between align-items-center">
			<div>Novi korisnici</div>
			<a class="all_object_link text-secondary" href="<?=base_url("/search")?>">
				Svi objekti
				<i class="fas fa-angle-right blue_text"></i>
			</a>

		</div>
		<div class="object_list clearfix">
			<?php foreach ($new as $place):?>
			<div class="object_div new_user_obj_div float-left">
		    	<span class="badge badge-light object_type" data-toggle="popover" title=<?=$place->type_name?> data-content="<?=$place->type_description?>">
		    		<?=badge($place->company_type)?>
		    	</span>
		    	<div class="image_div" style="background-image: url('<?=base_url("assets/Slike/profil_pictures/".$place->user_id."/".$place->image)?>');">
					<a href="<?=company_href($place->username,$place->email)?>">
			    		<div class="object_content">
			    			<h2 class="object_header text-white"><?=$place->name?></h2>
			    			<div class="object_adress text-white">
			    				<?=$place->country?>, <span class="blue_text font-weight-bold"><?=$place->city?></span>, <?=$place->address?>
			    			</div>
			    		</div>
		    		</a>
		    		
		    	</div>
		    	<div class="object_info">
		    		<div class="row h-100 m-0">
		    			<?php if($place->free){
		    				$class="blue_text";
		    				$text = "Slobodno";
		    			}else{
		    				$class="text-danger";
		    				$text = "Zauzeto";
		    			}?>
		    			<div class="col-6 text-center text-white text-small1 d-flex align-items-center p-3">Trenutno: <span class="<?=$class?> font-weight-bold ml-1"><?=$text?></span></div>
		    			<?php if(working_status($place->open, $place->start_hour, $place->end_hour)!="Zatvoreno"){
		    				$class = "blue_text";
		    				$text = "Otvoreno";

		    			}else{
		    				$class = "text-danger";
		    				$text = "Zatvoreno";

		    			}?>
		    			<div class="col-4 text-center text-white text-small1 d-flex align-items-center p-2">Status: <span class="<?=$class?> font-weight-bold ml-1"><?=$text?></span></div>
		    		</div>
		    	</div>
		    </div>
			<?php endforeach ?>
		</div>
	</div>
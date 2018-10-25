<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<title><?=$title?>::ZauzmiMesto.com</title>
	<meta charset="utf-8">

	<link rel="icon" href=<?=base_url("assets/Slike/logo.png")?> type="image/png" sizes="16x16">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href=<?=base_url("assets/bootstrap/css/bootstrap.min.css")?> />
	<link rel="stylesheet" type="text/css" href=<?=base_url("assets/fontawesome/css/fontawesome-all.css")?> />
	
	<?php foreach ($styles as $link): ?>
	<link rel="stylesheet" type="text/css" href=<?=$link?> />
	<?php endforeach?>
	
	<link rel="stylesheet" type="text/css" href=<?=base_url("assets/css/pocetnastyle.css")?> />

</head>
<body>
	<nav class="navbar  navbar-expand-lg navbar-light bg-white">
		<a class="navbar-brand font-weight-light" href=<?=base_url()?>>
		    <img src=<?=base_url("assets/Slike/logo.png")?> width="30" height="30" class="d-inline-block align-top" alt="">
		    ZauzmiMesto.com
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" id="collapse_button">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse clearfix logged_user_nav_content" id="navbarSupportedContent">
			<?php if($loggedin):?>
		  	<ul class="navbar-nav mr-auto ml-lg-4 proba">
		  		 <li class="nav-item">
			        <a class="nav-link" href=<?=base_url()?>>Početna</a>
			     </li>
			     <li class="nav-item">
			        <a class="nav-link" href=<?=base_url("/search")?>>Svi Objekti</a>
			     </li>
			     <li class="nav-item">
			        <a class="nav-link" href="<?=href($type, $username, $email)?>">Profil</a>
			     </li>
			        <?php if($type=="1"):?>
					<li class="nav-item">
			        	<a class="nav-link" href="<?=base_url("dashboard/")?>">Dashboard</a>
			     	</li>
					<?php endif?>
					<?php if($type=="0"):?>
					<li class="nav-item">
			        	<a class="nav-link" href="<?=base_url("admin/")?>">Dashboard</a>
			     	</li>
					<?php endif?>
			     <li class="nav-item small_window_list">
				    	<a class="nav-link" href="<?=settings_href($type)?>">Podesavanja</a>
				 </li>
				 <li class="nav-item small_window_list">
				    <a class="nav-link" href="<?=base_url('user/logout')?>">Odjavi se</a>
				 </li>
		  	</ul>
		  	
		  	<div class="navbar-nav d-flex align-items-center loggedin-user-info" >
		  		<div class="img_profil_nav"><img class="d-block" src=<?=base_url("assets/Slike/profil_pictures/".$id."/".$image)?>></div>
		  		<div class="info_profil_nav">
		  			<a href="<?=href($type, $username, $email)?>">
		  				<div class="name_nav text-dark">
		  					<?php 
		  						if($type!=1) echo $firstname." ".$lastname;
		  						else echo $name;
		  					?>
		  				</div>
		  			</a>
		  			<div class="type_account_nav blue_text font-weight-bold">
		  				<?php 
		  					if($type==0) echo "Admin";
		  					if($type==2) echo "Korisnik";
		  					if($type==1) {
		  						echo $company_type;
		  					}
		  				?>
		  			</div>
		  		</div>
		  		<div class="arrow_dropdown_nav">
		  			<!--<div class="arrow_for_dd"></div>
		  			<ul class="dropdown_menu">
		  				<li class="item_dropdown"></li>
		  				<li class="item_dropdown"></li>
		  				<li class="item_dropdown"></li>
		  				<li class="item_dropdown"></li>
		  				<div class="dropdown-divider"></div>
		  				<li class="item_dropdown"></li>
		  			</ul>-->

		  			<div class="btn btn-lg btn-white dropdown-toggle dropdown-toggle-split arrow_dropdown_nav-btn" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		  			</div>

					<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					    <a class="dropdown-item" href="<?=href($type, $username, $email)?>">Profil</a>
					    <a class="dropdown-item" href="<?=settings_href($type)?>">Podešavanja</a>
					    <?php if($type=="1"):?>
					    	<a class="dropdown-item" href="<?=base_url("dashboard/")?>">Dashboard</a>
					    <?php endif?>
					    <?php if($type=="0"):?>
					    	<a class="dropdown-item" href="<?=base_url("admin/")?>">Dashboard</a>
					    <?php endif?>
					    <div class="dropdown-divider"></div>
					    <a class="dropdown-item" href="<?=base_url("user/logout")?>">Odjavi se</a>
					  </div>
		  		</div>
		  	</div>
		  	<?php else:?>
		  	<ul class="navbar-nav mr-auto"></ul>
		  	<ul class="navbar-nav">
		      	<li class="nav-item">
		      		<a class="nav-link font-weight-bold blue_text" id ="blue_text"href=<?=base_url("/register")?>>Registruj se</a>
		      	</li>
		     	<li class="nav-item">
		        	<a class="nav-link" href=<?=base_url("/login")?>>Uloguj se</a>
		      	</li>
		    </ul>
			<?php endif ?>
		    
		    
		</div>




	</nav>


	
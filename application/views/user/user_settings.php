<div class="container">
   <div class="content">
      <article class="card-body mx-auto" style="max-width: 400px;">
         <div class="section_header text-secondary d-flex justify-content-between align-items-center">
            <div class="m-auto">Izmena  podataka</div>
         </div>
         <div class="prozorce-image" id="slikareg">
            <img src="<?=base_url("assets/Slike/profil_pictures/".$user->user_id."/".$user->image)?>" class="img-responsive slika " weight=100   id="img_reg"/>
            <div class="text-center font-weight-bold text-danger small p-0 mb-2"><?=substr($error,3,strlen($error)-7)?></div>
            <label for="profil_image" class="btn input-group blue_bg ml-auto mr-auto mb-2 w-50 ">
              <div class="input-group-prepend">
                <div class="input-group-text blue_bg border-0">
                  <i class="fas fa-cloud-upload-alt"></i>
                </div>
              </div>
              <div class="ml-2 mt-1 text-light">Ubaci sliku</div>
            </label> 
            <?=form_open_multipart("")?>
               <input type="file" name="profil_image" class="d-none" id="profil_image">
               <button type="submit" name="submit" class="btn input-group blue_bg ml-auto mr-auto mb-4 w-50 "><div class="m-auto  text-light">Promeni profilnu</div></button>
            <?=form_close()?>

         </div>
         <?=form_open()?>
            <div class="form-group input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fa fa-user"></i> </span>
               </div>
               
               <input name="firstname" id="izmeniime" class="form-control" placeholder="<?=$user->name?>" type="text" disabled="">
               <div class="input-group-prepend">
                  <span class="input-group-text" style="background-color: transparent;border: none">
                  <div data="izmeniime" value="user_name"  class="change fas fa-pencil-alt"></div></span>
               </div>
            </div>
            <?=form_error('firstname', '<div class="font-weight-bold text-danger small p-0">', '</div>')?>
            
            <div class="form-group input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fa fa-user"></i> </span>
               </div>
               <input name="lastname" id="izmeniprezime" class="form-control" placeholder="<?=$user->lastname?>" type="text" disabled="">
               <div class="input-group-prepend">
                  <span class="input-group-text" style="background-color: transparent;border: none">
                  <div data="izmeniprezime"   class="change fas fa-pencil-alt"></div></span>
               </div>
            </div>
            <?=form_error('lastname', '<div class="font-weight-bold text-danger small p-0">', '</div>')?>
           
            <div class="form-group input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
               </div>
               <input name="phone" id="mobilni" class="form-control" placeholder="<?=$user->phone?>" type="text" disabled="">
               <div class="input-group-prepend">
                  <span class="input-group-text" style="background-color: transparent;border: none">
                  <div data="izmenibroj"   class="change fas fa-pencil-alt"></div></span>
               </div>
            </div>
            <?=form_error('phone', '<div class="font-weight-bold text-danger small p-0">', '</div>')?>
            
            <div class="form-group input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fa fa-transgender"></i> </span>
               </div>
               <select id="izmenipol" class="form-control" disabled="" name="gender">
                  <option value="1" <?php if($user->gender==1) echo 'selected=""';?>>Muški</option>
                  <option value ="2" <?php if($user->gender!=1) echo 'selected=""';?>>Ženski</option>
               </select>
               <div class="input-group-prepend">
                  <span class="input-group-text" style="background-color: transparent;border: none">
                  <div data="izmenipol"   class="change fas fa-pencil-alt"></div></span>
               </div>
            </div>
            <?=form_error('gender', '<div class="font-weight-bold text-danger small p-0">', '</div>')?>
            
            <div class="form-group input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fa fa-building"></i> </span>
               </div>
               <select id="izmenigrad" class="form-control" disabled="" name="city">
                  <?php foreach ($cities as $city):?>
                     <option value="<?=$city->id?>" <?php if($user->city_id==$city->id) echo 'selected=""';?>><?=$city->name?></option>
                  <?php endforeach?>
               </select>
               <div class="input-group-prepend">
                  <span class="input-group-text" style="background-color: transparent;border: none">
                  <div data="izmenigrad"   class="change fas fa-pencil-alt"></div></span>
               </div>
            </div>
            <?=form_error('city', '<div class="font-weight-bold text-danger small p-0">', '</div>')?>
            <div class="form-group">
               <button type="text" class="btn blue_bg text-light btn-block" value="2" name="submit"> Potvrdi izmene  </button>
            </div>
                  
         <?=form_close()?>
      </article>
      <article class="card-body mx-auto" style="max-width: 400px;">
         <div class="section_header text-secondary d-flex justify-content-between align-items-center">
            <div class="m-auto">Promena Lozinke</div>
         </div>
         <?=form_open()?>
            <div >
               <div class="form-group input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text"> <i class="fas fa-lock"></i> </span>
                  </div>
                  <input id="izmenilozinku1" class="form-control" placeholder="Stara Lozinka" type="password" name="password">
               </div>
            </div>
            <?=form_error('password', '<div class="font-weight-bold text-danger small p-0">', '</div>')?>
            <div>
               <div class="form-group input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text"> <i class="fas fa-lock"></i> </span>
                  </div>
                  <input id="izmenilozinku2" class="form-control" placeholder="Nova Lozinka" type="password" name="new_password" >
                  
               </div>
            </div>
            <?=form_error('new_password', '<div class="font-weight-bold text-danger small p-0">', '</div>')?>
            <div >
               <div class="form-group input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text"> <i class="fas fa-lock"></i> </span>
                  </div>
                  <input id="izmenilozinku3" class="form-control" placeholder="Potvrdite Novu Lozinku" type="password" name="conf_password" >
               </div>
            </div>
            <?=form_error('conf_password', '<div class=" font-weight-bold text-danger small p-0">', '</div>')?>
            <?php if($message != ""):?>
               <div class="text-center font-weight-bold text-success small p-2">
                  <?=$message?>
               </div>
            <?php endif?>
            <div class="form-group">
               <button type="text" class="btn blue_bg text-light btn-block" value="1" name="submit"> Promeni lozinku</button>
            </div>
         <?=form_close()?>
      </article>
   </div>
</div>
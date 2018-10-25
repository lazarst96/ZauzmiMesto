<div class="container">
   <div class="content">
      <article class="card-body mx-auto" style="max-width: 600px;">
         <div class="section_header text-secondary d-flex justify-content-between align-items-center">
            <div class="m-auto">Izmena  podataka</div>
         </div>
         
         <?=form_open()?>
            <div class="form-group input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fas fa-utensils"></i> </span>
               </div>
               <input id="objectname" class="form-control" placeholder="<?=$company->name?>"  type="text" disabled name="name">
               <div class="input-group-prepend">
                  <span class="input-group-text" style="background-color: transparent;border: none">
                  <a style="color:#007bff" data="objectname" value="objectname"  class="fas fa-pencil-alt"></a></span>
               </div>
            </div>
            <?=form_error('name', '<div class="small font-weight-bold text-danger p-0">', '</div>')?>

            <!-- form-group// -->
            <div class="form-group input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
               </div>
               <input id="mobilni" class="form-control"  placeholder="<?=$company->phone1?>"  type="text" disabled name="phone1">
               <div class="input-group-prepend">
                  <span class="input-group-text" style="background-color: transparent;border: none">
                  <a style="color:#007bff" data="izmenibroj1" value="number1"  class="fas fa-pencil-alt"></a></span>
               </div>
            </div>
            <?=form_error('phone1', '<div class="small font-weight-bold text-danger p-0">', '</div>')?>

            <!-- form-group// -->
            <div class="form-group input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
               </div>
               <input id="mobilni2" class="form-control" placeholder="<?=$company->phone2?>" type="text" disabled name="phone2"/>
               <div class="input-group-prepend">
                  <span class="input-group-text" style="background-color: transparent;border: none">
                  <a style="color:#007bff" data="izmenibroj2" value="number2"  class="fas fa-pencil-alt"></a></span>
               </div>
            </div>
            <?=form_error('phone2', '<div class="small font-weight-bold text-danger p-0">', '</div>')?>

            <div class="form-group input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fas fa-building"></i> </span>
               </div>
               <select id="grad" class="custom-select" style="max-width: " disabled name="city"/>
                  <?php foreach($cities as $city):?>
                  <option <?php if($city->id==$company->city_id) echo 'selected=""';?> value="<?=$city->id?>"><?=$city->name?></option>
                  <?php endforeach?>
               </select>
               <div class="input-group-prepend">
                  <span class="input-group-text" style="background-color: transparent;border: none">
                  <a style="color:#007bff" data="grad" value="grad"  class="fas fa-pencil-alt"></a></span>
               </div>
            </div>
            <?=form_error('city', '<div class="small font-weight-bold text-danger p-0">', '</div>')?>

            <div class="form-group input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fas fa-globe"></i> </span>
               </div>
               <input id="izmenisajt" class="form-control" placeholder="<?=$company->website?>" type="text" disabled name="website"/>
               <div class="input-group-prepend">
                  <span class="input-group-text" style="background-color: transparent;border: none">
                  <a style="color:#007bff" data="izmenisajt" value="izmenisajt"  class="fas fa-pencil-alt"></a></span>
               </div>
            </div>
            <?=form_error('website', '<div class="small font-weight-bold text-danger p-0">', '</div>')?>

            <div class="form-group input-group">
               <textarea class="form-control" rows="4" cols="50" placeholder="<?=$company->info?>" style="resize: none" name="info" id="tekstarea" disabled=""></textarea>
               <div class="input-group-prepend">
                  <span class="input-group-text" style="background-color: transparent;border: none">
                  <a style="color:#007bff" data="tekstarea" value="tekstarea"  class="fas fa-pencil-alt"></a></span>
               </div>
            </div>
            <?php if($message_chdata):?>
               <div class="text-center font-weight-bold text-success small p-2">
                  <?=$message_chdata?>
               </div>
            <?php endif?>
            <div class="form-group">
               <button type="submit" class="btn blue_bg text-light btn-block" value="1" name="submit"> Potvrdi izmene  </button>
            </div>
            
         <?=form_close()?>
            
            <div class="section_header text-secondary d-flex justify-content-between align-items-center">
               <div class="m-auto">Postavi radno vreme i raspored stolova</div>
            </div>

         <?=form_open()?>
         <table class="table_shed">
               <thead>
                  <td colspan="7">Raspored stolova</td>
               </thead>
               <tbody>
                  <tr>
                     <th class="table_capacity"><i class="fa fa-users"></i></th>
                     <?php foreach ($tables as $key => $value):?>
                        <td><?=$key?></td>
                     <?php endforeach?>
                  </tr>
                  <tr>
                     <th class="table_count"><i class="fa fa-cubes"></i></th>
                     <?php foreach ($tables as $key => $value):?>
                        <td><input class="form-control" type="number" min=0 name="table<?=$key?>" value="<?=$value?>"></td>
                     <?php endforeach?>
                  </tr>
               </tbody>
            </table>
            <table class="table_shed table_wtime">
               <thead>
                  <td colspan="8">Radno vreme</td>
               </thead>
               <tbody>
                  <tr>
                     <th class="table_capacity"><i class="fa fa-calendar-alt"></i></th>
                     <td>Pon</td>
                     <td>Uto</td>
                     <td>Sre</td>
                     <td>Čet</td>
                     <td>Pet</td>
                     <td>Sub</td>
                     <td>Ned</td>
                  </tr>
                  <tr>
                     <th class="table_count" title="Početak radnog vremena"><i class="fa fa-door-open"></i></th>
                     <?php foreach ($working_time as $key => $day):?>
                        <td><input class="form-control" type="number" min=0 max=23 name="start<?=$key+1?>" value="<?=$day->start_hour?>"></td>
                     <?php endforeach?>
                  </tr>
                  <tr>
                     <th class="table_count" title="Kraj radnog vremena"><i class="fa fa-door-closed"></i></th>
                     <?php foreach ($working_time as $key => $day):?>
                        <td><input class="form-control" type="number" min=0 max=23 name="end<?=$key+1?>" value="<?=$day->end_hour?>"></td>
                     <?php endforeach?>
                  </tr>
                  <tr>
                     <th class="table_count" title="Radni dan"><i class="fa fa-check-circle"></i></th>
                     <?php foreach ($working_time as $key => $day):?>
                        <td><input class="form-control" type="checkbox" <?=($day->open)?'checked=""':""?> name="workday<?=$key+1?>"></td>
                     <?php endforeach?>
                  </tr>
               </tbody>
            </table>
            <div class="form-group">
               <button type="submit" value="4" name="submit" class="btn blue_bg text-light btn-block"> Potvrdi izmene</button>
            </div>
         <?=form_close()?>

         <?=form_open()?>
            <div class="section_header text-secondary d-flex justify-content-between align-items-center">
               <div class="m-auto">Promeni lozinku</div>
            </div>
            <div class="form-group input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fas fa-lock"></i> </span>
               </div>
               <input class="form-control" placeholder="Unesite trenutnu lozinku"  type="password"   name="password"/>
            </div>
            <?=form_error('password', '<div class="font-weight-bold text-danger small p-0">', '</div>')?>
            <div class="form-group input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fas fa-lock"></i> </span>
               </div>
               <input id="novalozinka1" class="form-control lozinka" placeholder="Unesite novu lozinku"  type="password"  name="new_password" />
            </div>
            <?=form_error('new_password', '<div class="font-weight-bold text-danger small p-0">', '</div>')?>
            <div class="form-group input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fas fa-lock"></i> </span>
               </div>
               <input id="novalozinka2" class="form-control lozinka" placeholder="Ponovite novu lozinku" name="conf_password"  type="password"   />
            </div>
            <?=form_error('conf_password', '<div class="font-weight-bold text-danger small p-0">', '</div>')?>
            <div id="provera"> </div>
            <?php if($message_chpass):?>
               <div class="text-center font-weight-bold text-success small p-2">
                  <?=$message_chpass?>
               </div>
            <?php endif?>
            <div class="form-group">
               <button type="submit" value="2" name="submit" class="btn blue_bg text-light btn-block"> Promeni lozinku  </button>
            </div>
         <?=form_close()?>
         <div class="section_header text-secondary d-flex justify-content-between align-items-center">
            <div class="m-auto">Promena lokacije</div>
         </div>
         <div class="map">
            <div id="map"></div>
         </div>
         <?=form_open()?>
            <div class="form-group input-group">
               <input type="hidden" name="latitude" id="latitude" value="<?=$company->latitude?>" />
            </div>
            <div class="form-group input-group">
               <input type="hidden" name="longitude" id="longitude" value="<?=$company->longitude?>"/>
            </div>
            <?php if($message_uploc):?>
               <div class="text-center font-weight-bold text-success small p-2">
                  <?=$message_uploc?>
               </div>
            <?php endif?>
            <div class="form-group">
               <button type="submit" value="3" name="submit" class="btn blue_bg btn-block text-light"> Ažuriraj lokaciju  </button>
            </div>
         <?=form_close()?>
         <div class="section_header text-secondary d-flex justify-content-between align-items-center">
         <div class="m-auto">Fotografije korisnika</div>
      </div>
      <div class="   text-secondary d-flex justify-content-between align-items-center"  ">
         <div class="m-auto" style="display:inline-block;"><input type="radio"  name="opcijaeditovanja" id="radio1" value="1" class="radio1" checked /> Postavi profilnu
            <input type="radio" id="radio2" value="2" class="radio1"  name="opcijaeditovanja" /> Obeleži za brisanje
         </div>
      </div>
      
      </article>
      <?=form_open()?>
         <div class="content">
            <div class="clearfix">
               <?php foreach ($images as $image):?>
                  <div class="slikaprof col-6 col-lg-3 float-left p-2">
                     <div class="inputi">
                        <input type="radio" name="profil" class="inputzaprofil m-3" style="width:16px;height:16px" value="<?=$image?>" <?php if($image == $company->image) echo 'checked=""'; ?>>
                        <input type="checkbox" name="MyArray[]" class="zabrisanje m-3" style="width:16px;height:16px"
                        <?php if($image == $company->image) echo 'disabled=""';  ?> value="<?=$image?>">
                     </div>
                     <img class="slika" src="<?=base_url("assets/Slike/profil_pictures/".$company->user_id."/".$image)?>" width="100%">
                  </div>
               <?php endforeach?>
            </div>
            <button type="submit" name="submit-image" class="btn input-group blue_bg ml-auto mr-auto mb-2 col-6" id="dugmebrisanje" style="max-width: 600px" value="1">
                  <div class="m-auto text-light"><i class="fas fa-portrait mr-2"></i>Postavi profilnu</div>
            </button>
            <?php if($message_ch_prof):?>
               <div class="text-center font-weight-bold text-success small p-2">
                  <?=$message_ch_prof?>
               </div>
                  
            <?php endif?>
            <?php if($message_del_im):?>
               <div class="text-center font-weight-bold text-success small p-2">
                  <?=$message_del_im?>
               </div>
                  
            <?php endif?>
         </div>
      <?=form_close()?>
      <div class="container">
         <div class="content">
            <?=form_open_multipart("",array("id"=>"image_form"))?>
               <div class="text-center font-weight-bold text-danger small p-0 mb-2"></div>
               
                  <label for="upload_image" class="m-auto btn input-group blue_bg col-6 h-100 text-white text-center" style="max-width: 600px;">
                     <div class="m-auto text-light">
                        <i class="fas fa-cloud-upload-alt"></i>
                        Dodaj fotografiju
                     </div>
                  </label>
                  <?php if($error_upim ):?>
                     <div class="text-center font-weight-bold text-danger small p-2">
                        <?=(($error_upim!="<p></p>")?"Greška pri dodavanju fotografije. ":"").$error_upim?>
                     </div>
                  <?php else:?>
                     <div class="text-center font-weight-bold text-success small p-2">
                        Uspešno ste dodali fotografiju.
                     </div>
                  <?php endif?>
               
               
               <input type="file" id="upload_image" name="upload_image" class="d-none"/>
               
            <?=form_close()?>
         </div>
      </div>
      </div>
      </div>
   </div>
</div>
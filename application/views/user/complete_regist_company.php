<div class="container">
   <div class="content">
      <article class="card-body mx-auto" style="max-width: 600px;">
         <div class="section_header text-secondary d-flex justify-content-between align-items-center" id="azuriranje">
            <div class="m-auto">Ažuriranje podataka</div>
         </div>
         <div id='mapa'></div>
         
         <?=form_open()?>
            
            <div class="form-group input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fas fa-utensils"></i> </span>
               </div>
               <input class="form-control" placeholder="Ime objekta" type="text" name="name">
               
            </div>
            <?=form_error('name', '<div class="small font-weight-bold text-danger p-0">', '</div>')?>
            <!-- form-group// -->
            <div class="form-group input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
               </div>
               <select class="custom-select" style="max-width: 120px;" name="prefix1">
                  <option selected="" value="+381">+381</option>
                  <option value="+382">+382</option>
                  <option value="+389">+389</option>
               </select>
               <input class="form-control" placeholder="Broj telefona za rezervacije" type="text" name="phone1">
               
            </div>
            <?=form_error('phone1', '<div class="small font-weight-bold text-danger p-0">', '</div>')?>
            <!-- form-group// -->
            <div class="form-group input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
               </div>
               <select class="custom-select" style="max-width: 120px;" name="prefix2">
                  <option selected="" value="+381">+381</option>
                  <option value="+382">+382</option>
                  <option value="+389">+389</option>
               </select>
               <input class="form-control" placeholder="Broj telefona za rezervacije" type="text" name="phone2">
               
            </div>
            <?=form_error('phone2', '<div class="small font-weight-bold text-danger p-0">', '</div>')?>
            <!-- form-group// -->
            <div class="form-group input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fa fa-building"></i> </span>
               </div>
               <select class="form-control" name="city">
                  <option selected="" value=""> Grad</option>
                  <?php foreach ($cities as $city):?>
                     <option value=<?=$city->id?>><?=$city->name?></option>
                  <?php endforeach ?>
               </select>
            </div>
            <?=form_error('city', '<div class="small font-weight-bold text-danger p-0">', '</div>')?>
            <div class="form-group input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fas fa-map-marker-alt"></i> </span>
               </div>
               <input class="form-control" placeholder="Adresa" type="text" name="address">
               <input type="hidden" value="" id="latitude" name="latitude">
               <input type="hidden" value="" id="longitude" name="longitude">
            </div>
            <?=form_error('address', '<div class="small font-weight-bold text-danger p-0">', '</div>')?>
            <div class="form-group input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fas fa-briefcase"></i> </span>
               </div>
               <select class="form-control" name="type">
                  <option selected=""> Tip objekta</option>
                  <?php foreach ($types as $type):?>
                     <option value=<?=$type->id?>><?=$type->name?></option>
                  <?php endforeach ?>
               </select>
               
            </div>
            <?=form_error('type', '<div class="small font-weight-bold text-danger p-0">', '</div>')?>
            <!-- form-group end.// -->
            <div class="form-group input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fas fa-globe"></i> </span>
               </div>
               <input class="form-control" placeholder="Website" type="text" name="website"/>
            </div>
            <?=form_error('website', '<div class="small font-weight-bold text-danger p-0">', '</div>')?>
            <table class="table_shed">
               <thead>
                  <td colspan="7">Raspored stolova</td>
               </thead>
               <tbody>
                  <tr>
                     <th class="table_capacity"><i class="fa fa-users"></i></th>
                     <td>2</td>
                     <td>4</td>
                     <td>6</td>
                     <td>8</td>
                     <td>10</td>
                     <td>12</td>
                  </tr>
                  <tr>
                     <th class="table_count"><i class="fa fa-cubes"></i></th>
                     <td><input class="form-control" type="number" min=0 name="table2" value="0"></td>
                     <td><input class="form-control" type="number" min=0 name="table4" value="0"></td>
                     <td><input class="form-control" type="number" min=0 name="table6" value="0"></td>
                     <td><input class="form-control" type="number" min=0 name="table8" value="0"></td>
                     <td><input class="form-control" type="number" min=0 name="table10" value="0"></td>
                     <td><input class="form-control" type="number" min=0 name="table12" value="0"></td>
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
                     <td><input class="form-control" type="number" min=0 max=23 name="start1" value="0"></td>
                     <td><input class="form-control" type="number" min=0 max=23 name="start2" value="0"></td>
                     <td><input class="form-control" type="number" min=0 max=23 name="start3" value="0"></td>
                     <td><input class="form-control" type="number" min=0 max=23 name="start4" value="0"></td>
                     <td><input class="form-control" type="number" min=0 max=23 name="start5" value="0"></td>
                     <td><input class="form-control" type="number" min=0 max=23 name="start6" value="0"></td>
                     <td><input class="form-control" type="number" min=0 max=23  name="start7" value="0"></td>
                  </tr>
                  <tr>
                     <th class="table_count" title="Kraj radnog vremena"><i class="fa fa-door-closed"></i></th>
                     <td><input class="form-control" type="number" min=0 max=23 name="end1" value="0"></td>
                     <td><input class="form-control" type="number" min=0 max=23 name="end2" value="0"></td>
                     <td><input class="form-control" type="number" min=0 max=23 name="end3" value="0"></td>
                     <td><input class="form-control" type="number" min=0 max=23 name="end4" value="0"></td>
                     <td><input class="form-control" type="number" min=0 max=23 name="end5" value="0"></td>
                     <td><input class="form-control" type="number" min=0 max=23 name="end6" value="0"></td>
                     <td><input class="form-control" type="number" min=0 max=23  name="end7" value="0"></td>
                  </tr>
                  <tr>
                     <th class="table_count" title="Radni dan"><i class="fa fa-check-circle"></i></th>
                     <td><input class="form-control" type="checkbox" checked="" name="workday1"></td>
                     <td><input class="form-control" type="checkbox" checked="" name="workday2"></td>
                     <td><input class="form-control" type="checkbox" checked="" name="workday3"></td>
                     <td><input class="form-control" type="checkbox" checked="" name="workday4"></td>
                     <td><input class="form-control" type="checkbox" checked="" name="workday5"></td>
                     <td><input class="form-control" type="checkbox" checked="" name="workday6"></td>
                     <td><input class="form-control" type="checkbox" checked="" name="workday7"></td>
                  </tr>
               </tbody>
            </table>
            <!-- form-group// -->        
            <div class="form-group input-group">
               <textarea class="form-control" rows="4" cols="50" placeholder="Ukratko o restoranu..." style="resize: none" name="description"></textarea> 
            </div>
            
            <!-- form-group// -->    
            <div class="form-group">
               <button type="submit" class="btn blue_bg text-white  btn-block"> Ažuriraj podatke  </button>
            </div>
            <!-- form-group// -->      
            <div class="center">
               <figure class="note">*Dodatne slike objekta se dodaju naknadno* 
               </figure>
            </div>
         <?=form_close()?>
      </article>
   </div>
</div>
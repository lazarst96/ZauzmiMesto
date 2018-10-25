<div class="container">
   <div class="content">
      <article class="card-body mx-auto" style="max-width: 400px;">
         <div class="section_header text-secondary d-flex justify-content-between align-items-center">
            <div class="m-auto">Ažuriranje podataka</div>
         </div>
         <?=form_open()?>
            <div class="form-group input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fa fa-user"></i> </span>
               </div>
               <input name="firstname" class="form-control" placeholder="Ime" type="text" required="">
            </div>
            <?=form_error('firstname', '<div class="small font-weight-bold text-danger p-0">', '</div>')?>
            <!-- form-group// -->
            <div class="form-group input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fa fa-user"></i> </span>
               </div>
               <input name="lastname" class="form-control" placeholder="Prezime" type="text" required="">
            </div>
            <?=form_error('lastname', '<div class="small font-weight-bold text-danger p-0">', '</div>')?>
            <!-- form-group// -->
            <div class="form-group input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
               </div>
               <select class="custom-select" style="max-width: 120px;" name="phone_prefix">
                  <option selected="">+381</option>
                  <option value="1">+382</option>
                  <option value="2">+389</option>
               </select>
               <input name="phone" class="form-control" placeholder="Broj telefona" type="text">
            </div>
            <?=form_error('phone', '<div class="small font-weight-bold text-danger p-0">', '</div>')?>
            <!-- form-group// -->
            <div class="form-group input-group">
               <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fa fa-transgender"></i> </span>
               </div>
               <select class="form-control" name="gender">
                  <option selected="" value=""> Pol</option>
                  <option value="1">Muški</option>
                  <option value="2">Ženski</option>
               </select>
            </div>
            <?=form_error('gender', '<div class="small font-weight-bold text-danger p-0">', '</div>')?>
            <!-- form-group end.// -->
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
            <!-- form-group// -->                                      
            <div class="form-group">
               <button type="text" class="btn btn-primary btn-block"> Ažuriraj podatke  </button>
            </div>
            <!-- form-group// -->      
         <?=form_close()?>
      </article>
   </div>
</div>
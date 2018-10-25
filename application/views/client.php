<div class="container mt-4" style="padding-left: 0;padding-right: 0">
   <div class="clearfix" id = "content">
      <div class="col-md-9 col-sm-9">
         <div class="row">
            <div class="object_list clearfix">
               <header>
                  <h1><?=$client->name." ".$client->lastname?></h1>
               </header>
               <section>
                  <div class="row">
                     <div class="col-md-3 col-sm-3">
                        <figure class="slika-profil"><img class="" id="profilnaslika" style="max-width: 100%;max-height: 100%" alt="" src="<?=base_url("assets/Slike/profil_pictures/".$client->user_id."/".$client->image)?>" ></figure>
                     </div>
                     <!-- /.col-md-3 -->
                     <div class="col-md-5 col-sm-5">
                        <h3 style="margin-top: 0">Informacije</h3>
                        <dl>
                           <dt>Email:</dt>
                           <dd>
                              <p><?=$client->email?></p>
                           </dd>
                           <dt>Telefon:</dt>
                           <dd>
                              <p><?=$client->phone?></p>
                           </dd>
                           <dt>Pozitivne ocene:</dt>
                           <dd>
                              <p><?=$client->positive?></p>
                           </dd>
                           <dt>Negativne ocene: </dt>
                           <dd>
                              <p><?=$client->negative?></p>
                           </dd>
                        </dl>
                     </div>
                     <div class="col-md-4 col-sm-4" style="">
                        <?php if($type==1):?>
                        <h3 style="margin-top: 0">Ocenite korisnika</h3>
                        <div class="saocenama" style="justify-content:center;align-items: center;display: flex;">
                           <a href="<?=base_url("client/add_mark/".$client->user_id."?value=1")?>" class="dobreocene" style="margin-right: 15px;margin-top: 20px;cursor: pointer;" ><img width="50px" height="50px" src="<?=base_url("assets/Slike/gore.png")?>" class="fas fa-thumbs-up"/></a>
                           <a href="<?=base_url("client/add_mark/".$client->user_id."?value=0")?>" class="lose" style="margin-left: 15px;margin-top: 20px;cursor: pointer;">  <img width="50px" height="50px" src="<?=base_url("assets/Slike/dole.png")?>" class="fas fa-thumbs-up"/> </a>
                        </div>
                        <?php endif?>
                     </div>
                  </div>
               </section>
            </div>
         </div>
         <?php if($same):?>
         <div class="layout-expandable">
            <header>
               <h1> Mapa zakazanih mesta  </h1>
            </header>
            <div class="map">
               <div id="map"></div>
               <?=form_open()?>
                  <div id="forid" data-val="<?=$client->user_id?>"></div>
               <?=form_close()?>
            </div>
         </div>
         <div class="layout-expandable" >
            <header>
               <h1> Vaša zakazivanja </h1>
            </header>
            <div class="row">
               <?php foreach ($reserved_tables as $table):?>
               <div class="col-md-4 col-sm-4">
                  <div class="property">
                     <figure class="type"><span class="badge badge-light object_type" data-toggle="popover" title="<?=$table->type?>" data-content="<?=$table->type_description?>">
                        <?=badge($table->company_type)?>
                     </span></figure>
                     <div class="property-image"><a href="<?=company_href($table->username,$table->email)?>"><img class="img-responsive" alt="" src="<?=base_url("assets/Slike/profil_pictures/".$table->user_id."/".$table->image)?>"></a></div>
                     <div class="overlay">
                        <div class="info">
                           <h3><?=$table->name?></h3>
                           <figure><?=$table->address?>, <?=$table->city?></figure>
                        </div>
                        <ul class="additional-info">
                           <li>
                              <header>Rezervacija za:</header>
                              <figure><?=format_time($table->start_time)?></figure>
                           </li>
                           <li>
                              <header>Mesta:</header>
                              <figure><?=$table->capacity?></figure>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <?php endforeach?>
            </div>
         </div>
      <?php endif?>
      </div>
      <div class="col-md-3 col-sm-3">
         <div class="sidebar">
            <h3>Preporuka</h3>
            <?php foreach ($suggests as $place):?>
            <div class="property small">
               <figure class="type"><span class="badge badge-light object_type" data-toggle="popover" title=<?=$place->type_name?> data-content="<?=$place->type_description?>">
               <?=badge($place->company_type)?>
            </span></figure>
               <div class="property-image"><a href="<?=company_href($place->username,$place->email)?>"><img class="img-responsive" alt="" src="<?=base_url("assets/Slike/profil_pictures/".$place->user_id."/".$place->image)?>"></a></div>
               <div class="overlay">
                  <div class="info">
                     <h3><?=$place->name?></h3>
                     <figure><?=$place->address?>, <?=$place->city?></figure>
                  </div>
                  <ul class="additional-info">
                     <li>
                        <header>Slobodna mesta:</header>
                        <figure><?=$place->free_places?></figure>
                     </li>
                  </ul>
               </div>
            </div>
            <?php endforeach?>
            </aside>
         </div>
      </div>
   </div>
</div>
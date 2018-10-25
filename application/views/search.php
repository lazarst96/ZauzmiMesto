<div class="container">
   <div id="content" class="clearfix">
      <div class="col-md-9 col-sm-9">
         <div class="section_header text-secondary d-flex justify-content-between align-items-center">
            <div>Svi objekti</div>
         </div>
         <section id="properties" class="properties masonry loaded">
            <section id="search-filter" class="search-filter">
               <figure>
                  <h3>Rezultati:</h3>
                  <span class="search-count"></span>
                  <div class="sorting">
                     <div id="form-sort" class="form-group form-sort">
                        <select class="custom-select" id="sort" name="sort" >
                           <option value="1">Najstariji</option>
                           <option value="2">Najnoviji</option>
                        </select>
                     </div>
                           <!-- /.form-group -->
                  </div>
               </figure>
            </section>
            <div class="grid" style="position: relative;">
               <div class="row">
                  <?php foreach ($objects as $object):?>
                  <div id="restoran1" class="prozorce restorani" >
                     <div class="inner" data-scroll-reveal="" data-scroll-reveal-initialized="true" data-scroll-reveal-complete="true">
                        <a href=""></a>
                        <div class="prozorce-image">
                           <figure class="type" style="width:26px;height:26px">
                              <span class="badge badge-light object_type" data-toggle="popover" title=<?=$object->type_name?> data-content="<?=$object->type_description?>">
                                 <?=badge($object->company_type)?>
                              </span>
                           </figure>
                           <div class="overlay">
                              <a href=""></a>
                              <div class="info">
                                 <a href=""></a>
                                 <div class="actions">
                                    <a href=""></a>
                                    <a href="#" class="bookmark bookmark-added" data-restoranid="1"></a>
                                 </div>
                              </div>
                           </div>
                           <img class="img-responsive" src=<?=base_url("assets/Slike/profil_pictures/".$object->user_id."/".$object->image)?> alt="">
                        </div>
                        <aside>
                           <header>
                              <a href=<?=company_href($object->username,$object->email)?>>
                                 <h3><?=$object->name?></h3>
                              </a>
                              <p class="card-text">
                                <span class="blue_text"><?=$object->city?></span>, <?=$object->address?>
                              </p>
                           </header>
                           <p><?=$object->info?></p>
                           <dl>
                              <dt>Mesta:</dt>
                              <dd><?=$object->places?></dd>
                              <dt>Slobodna mesta:</dt>
                              <dd><?=$object->free_places?></dd>
                           </dl>
                           <a href=<?=company_href($object->username,$object->email)?> class="link-arrow d-flex align-items-center">Dodatno<i class="fa fa-chevron-right blue_text ml-2"></i></a>
                        </aside>
                     </div>
                  </div>
                  <?php endforeach?>
               </div>
            </div>
            <?php if(empty($objects)):?>
               <p>Nijedan objekat ne zadovoljava kriterijume pretrage.</p>
            <?php endif?>
            <div class="center" role="navigation" data-max="<?=$page_max?>">
               <ul class="pagination loop-pagination">
                  <?php if($page>1):?>
                     <li><a href=<?=base_url("/search?page=".($page-1))?>>Prethodna</a></li>
                  <?php endif?>
                  <li class="active"><a href=""><?=$page?></a></li>
                  <?php if($page+1<=$page_max):?>
                     <li ><a href=<?=base_url("/search?page=".($page+1))?>><?=$page+1?></a></li>
                  <?php endif?>
                  <?php if($page+2<=$page_max):?>
                  <li><a href=<?=base_url("/search?page=".($page+2))?>><?=$page+2?></a></li>
                  <?php endif?>
                  <?php if($page+1<=$page_max):?>
                  <li><a href=<?=base_url("/search?page=".($page+1))?>>Sledeća</a></li>
                  <?php endif?>
               </ul>
            </div>
         </section>
      </div>
      <div class="col-md-3  col-sm-3">
         <div class="section_header text-secondary d-flex justify-content-between align-items-center">
            <div>Pretraga</div>
         </div>
         <div class="sidebar">
            <?=form_open("",array("class"=>"form-search","id"=>"form-sidebar"))?>
               <!--<input type="text" name="sb-keyword" class="form-group" id="sb-keyword" placeholder="Ključna reč" />  -->
               <div class="form-group">
                   <select class="custom-select2 custom-select-kw darkblue_bg text-light" multiple="multiple" id="inputGroupSelect00" name="keywords[]">
                     <?php foreach ($keywords as $keyword):?>
                        <option <?php if(in_array($keyword->id,$set)) echo 'selected=""'?> value=<?=$keyword->id?>><?=$keyword->content?></option>
                       <?php endforeach?>
                   </select>
                </div>
               <div class="form-group">
                  <select class="custom-select2  select-map-search" id="inputGroupSelect01" name="city">
                     <option value="">Grad</option>
                       <?php foreach ($cities as $city):?>
                        <option <?php if($City == $city->id) echo 'selected=""'?> value=<?=$city->id?>><?=$city->name?></option>
                       <?php endforeach?>
                  </select>
               </div>
               <div class="form-group">
                  <select class="custom-select2  select-map-search" id="inputGroupSelect02" name="type">
                     <option value="">Vrsta objekta</option>
                         <?php foreach ($company_types as $type):?>
                        <option <?php if($Type == $type->id) echo 'selected=""'?> value=<?=$type->id?>><?=$type->name?></option>
                       <?php endforeach?>
                  </select>
               </div>
               <input type="hidden" name="order" id="orderby"value="">
               <div class="form-group">
                  <button type="submit" class="dugme" id="dugme">Pretraži</button>
               </div>
            <?=form_close()?>
         </div>
             <div class="section_header text-secondary d-flex justify-content-between align-items-center">
               <div>Preporuka</div>
            </div>
            <?php foreach ($new as $object):?>
            <div class="card my-2">
      			<img class="card-img" src=<?=base_url("assets/Slike/profil_pictures/".$object->user_id."/".$object->image)?> alt="Card image cap">
      			<div class="card-body">
      				<a href="<?=company_href($object->username,$object->email)?>">
                     <h5 class="card-title"><?=$object->name?></h5>
                  </a>
      				<p class="card-text">
      				  <span class="blue_text"><?=$object->city?></span>, <?=$object->address?>
      				</p>
      				<p class="card-text">
      				   <p class="text-muted">
      				    	Trenutno slobdnih mesta:<span class="font-weight-bold blue_text ml-1"><?=$object->free_places?></span>
      				   </p>
      				</p>
      			</div>
   			</div>
            <?php endforeach?> 
            <div class="section_header text-secondary d-flex justify-content-between align-items-center">
               <div>Najpopularniji</div>
            </div>
            <?php foreach ($most_popular as $object):?>
            <div class="card my-2">
               <img class="card-img" src=<?=base_url("assets/Slike/profil_pictures/".$object->user_id."/".$object->image)?> alt="Card image cap">
               <div class="card-body">
                  <a href="<?=company_href($object->username,$object->email)?>">
                     <h5 class="card-title"><?=$object->name?></h5>
                  </a>
                  <p class="card-text">
                     <span class="blue_text"><?=$object->city?></span>, <?=$object->address?>
                  </p>
                  <p class="card-text">
                      <p class="text-muted">
                        Trenutno slobdnih mesta:<span class="font-weight-bold blue_text ml-1"><?=$object->free_places?></span>
                     </p>
                  </p>
               </div>
            </div>
            <?php endforeach?>
         </div>
      </div>
   </div>
</div>
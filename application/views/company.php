<div class="container mt-4">
         <div class="row mb-5">
            <div class="col-md-8 col">
               <article id="post-506">
                  <section id="property-detail">
                     <header class="property-title">
                        <h1 id="name"><?=$company->name?></h1>
                        <div><a id="city" title="<?=$company->city?>" href="#" rel="nofollow"><?=$company->city?></a>, <?=$company->address?></div>
                     </header>
                     
                        <div class="owl-carousel property-carousel owl-theme owl-responsive-640 owl-loaded">
                           <div class="sliderobjekat">
                           <?php foreach($images as $image):?>
 			                    <div><img  src="<?=base_url("assets/Slike/profil_pictures/".$company->user_id."/".$image)?>" alt=""/></div>
                           <?php endforeach?>
							      </div>
						<div class="owl-controls">
							<div class="owl-nav">
								<div class="owl-prev">
									
								</div>
								<div class="owl-next">
									
								</div></div><div class="owl-dots" style="display: none;"></div></div>
                        </div>
				
                  

                     <div class="row mt-5">
                        <div class="col-md-4 col-sm-12">
                           <section class="clearfix" id="quick-summary">
                              <header>
                                 <h2>Informacije</h2>
                              </header>
                              <dl>
                              	<script>
                              		
                              	</script>
                                 <dt>Broj slobodnih mesta</dt><dd><?=$company->free_places?></dd>
                                 <dt>Radno vreme</dt>  <dd><?=$company->start_hour."-".$company->end_hour?></dd>
                                 <dt>Tip objekta:</dt><dd><?=$company->type_name?></dd>
                               	<dt>Trenutno:</dt>	<dd><?=working_status($company->open, $company->start_hour, $company->end_hour)?></dd>
                                 <?php if($company->phone1):?>
                               	<dt>Broj telefona:</dt>	<dd><?=$company->phone1?></dd>
                                 <?php endif?>
                                 <?php if($company->phone2):?>
                               	<dt>Broj telefona:</dt>	<dd><?=$company->phone2?></dd>
                                 <?php endif?>
                               	<dt>Email:</dt>	<dd><?=$company->email?></dd>
                                 <?php if($company->website):?>
                               	<dt>Website:</dt>	<dd><?=$company->website?></dd>
                                 <?php endif?>
                                 <dt>Ocena</dt> <dd title="<?=$company->rate/2?>">
                                 <?php for($i=0;$i<intval(number_star($company->rate));$i++):?>
                                    <span> <i class="fas fa-star"></i> </span>
                                 <?php endfor?>
      								   <?php if((number_star($company->rate)*2)%2):?>
							               <span><i class="fas fa-star-half"></i></span>
                                 <?php endif?>
                                 </dd>
                                 
                        	</dl>
                                 
                                
                                 
                                
                       
                        <?php $id = $company->user_id?>
                        </section>
                     </div>
                     <div class="col-sm-12 col-md-8">
                        <section id="">
                           <header>
                              <h2>O nama</h2>
                           </header>
                           <p><?=$company->info?></p>
                        </section>
                        <section id="">
                           <header>
                              <h2>Nudimo</h2>
                           </header>
                           <ul class="list-unstyled property_features-list">
                              <?php foreach ($keywords as $keyword):?>
                                 <li><?=$keyword->content?></li>
                              <?php endforeach?>
                           </ul>
                        </section>
                        <section id="property-map">
                           <header>
                              <h2 data-latitude="<?=$company->latitude?>" data-longitude="<?=$company->longitude?>" data-type="<?=$company->company_type?>" data-free="<?=$company->free?>" data-country="<?=$company->country?>" data-address="<?=$company->address?>" data-image="<?=base_url('assets/Slike/profil_pictures/'.$company->user_id."/".$company->image)?>"id="map-info">Lokacija</h2>
                           </header>
                           <div id="map"></div>
                        </section>
                        <?php if($this->session->userdata("user_data") && $this->session->user_data["type"]!=1):?>
                        <section id="property-rating">
                           <header>
                              <h2>Ocenite</h2>
                           </header>
                           <div class="clearfix">
                              <aside>
                                 <header>Vaša ocena</header>
                                 <?=form_open()?>
                                    <div class="rating rating-user">
                                       <fieldset class="rating">
                                          <input type="radio" id="star5" name="rating" value="10" /><label class = "full" for="star5" title="Odlično - 5 zvezde"></label>
                                          <input type="radio" id="star4half" name="rating" value="9" /><label class="half" for="star4half" title="Veoma dobro - 4.5 zvezde"></label>
                                          <input type="radio" id="star4" name="rating" value="8" /><label class = "full" for="star4" title="Veoma dobro - 4 zvezde"></label>
                                          <input type="radio" id="star3half" name="rating" value="7" /><label class="half" for="star3half" title="Nije loše - 3.5 zvezde"></label>
                                          <input type="radio" id="star3" name="rating" value="6" /><label class = "full" for="star3" title="Nije loše - 3 zvezde"></label>
                                          <input type="radio" id="star2half" name="rating" value="5" /><label class="half" for="star2half" title="Ufff - 2.5 zvezde"></label>
                                          <input type="radio" id="star2" name="rating" value="4" /><label class = "full" for="star2" title="Uffff - 2 zvezde"></label>
                                          <input type="radio" id="star1half" name="rating" value="3" /><label class="half" for="star1half" title="Loše - 1.5 zvezda"></label>
                                          <input type="radio" id="star1" name="rating" value="2" /><label class = "full" for="star1" title="Loše - 1 zvezda"></label>
                                          <input type="radio" id="starhalf" name="rating" value="1" /><label class="half" for="starhalf" title="Haos tebra - 0.5 zvezda"></label>
                                       </fieldset>
                                       <textarea class="form-control" rows="4" cols="50" placeholder="Ukratko o restoranu" name="text" id="textbox">
						                     </textarea>
                                       <div class="form-group clearfix">
                                          <button class="btn pull-right btn-default"  type="submit" >Pošalji komentar</button>
                                       </div>
                                    </div>
                                 <?=form_close()?>
                              </aside>
                           </div>
                          
                        </section>
                     <?php endif?>
                         
                     </div>
                  </section>
                  <hr class="thick">
                  <section id="similar-properties">
                     <header>
                        <h2 class="no-border">Pogledajte još</h2>
                     </header>
                     <div class="regular slider" >
                        <?php $id=$company->user_id;?>
                        <?php foreach ($suggestions as $company):?>
                        <?php if($company->user_id!=$id):?>
                        <div class="object_div">
                           <span class="badge badge-light object_type" data-toggle="popover" title="<?=$company->type_name?>" data-content="<?=$company->type_description?>"><?=badge($company->company_type)?></span>
                           <div class="image_div" style="background-image: url('<?=base_url("assets/Slike/profil_pictures/".$company->user_id."/".$company->image)?>');">
                              <a href=<?=company_href($company->username, $company->email)?> class="object_content">
                                 <h2 class="object_header text-white"><?=$company->name?></h2>
                                 
                                 <div class="object_adress text-white">
                                    <?=$company->country?>, <span class="blue_text font-weight-bold"><?=$company->city?></span>, <?=$company->address?>
                                 </div>
                              </a>
                           </div>
                           <div class="object_info">
                              <div class="row h-100 m-0">
                                 <?php if($company->free){
                                    $Class="blue_text";
                                    $text = "Slobodno";
                                 }else{
                                    $Class="text-danger";
                                    $text = "Zauzeto";
                                 }
                                 ?>
                                 <div class="col-6 text-center text-white text-small1 d-flex align-items-center p-3">Trenutno: <span class="<?=$Class?> font-weight-bold ml-1"><?=$text?></span></div>
                                 <?php if(working_status($company->open, $company->start_hour, $company->end_hour)!="Zatvoreno"){
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
                        <?php endif;endforeach?>
                     </div>
                  </section>
                  <hr class="thick">
                  <section class="comments-area comments" id="comments">
                     <header>
                        <h2 class="no-border"><?=comment_grammar(count($comments))?></h2>
                     </header>
                     <ul class="comment-list">
                        <?php foreach ($comments as $comment):?>
                        <li class="comment even thread-even depth-1" id="comment-150">
                           <figure>
                              <div class="image">
                                 <img width="100%" class="img-responsive" style="width: 86px; height: 86px;" alt="" data-holder-rendered="true" src="<?=base_url("assets/Slike/profil_pictures/".$comment->user_id."/".$comment->image)?>">					
                              </div>
                           </figure>
                           <div class="comment-wrapper">
                              <div class="name"><?=$comment->name." ".$comment->lastname?></div>
                              <span class="date"><span class="fa fa-calendar"></span><?=$comment->time?></span>
                              <div class="ocenakomentara" id="ocenakomentara" title="<?=$comment->value/2?>">
                                 <?php for($i=0;$i<intdiv($comment->value,2);$i++):?>
                                    <span> <i class="fas fa-star"></i></span>
                                 <?php endfor?>
                                 <?php if($comment->value%2):?>
                                    <span><i class="fas fa-star-half"></i></span>
                                 <?php endif?>
                              </div>
                              <p><?=$comment->text?></p>
                              <hr>
                           </div>
                        </li>
                     <?php endforeach?>
                     </ul>
                  </section>
            </div>
         
      <div class="col-md-4 col">
         <div class="sidebar" id="sidebar">
            <aside class="widget search-property" id="zoner-wsp-1">
               <?php if($loggedin && $type!=1):?>
               <h3 class="widget-title">Zakazivanje</h3>
               <span class="d-none" id="company_infi" data-num="<?=$id?>"></span>
               <div class="form-group input-group">
                  
                  <input id="day" class="form-control col" name="day"  type="date" min="<?=date('Y-m-d')?>"  />
                  <input type="hidden" name="csrf_test_name" value="<?=$this->security->get_csrf_hash()?>">
                  
               </div>
               <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="mymodal">
                 <div class="modal-dialog modal-lg">
                   <div class="modal-content">
                     <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel" >Zakazivanje</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                       </button>
                     </div>
                     <div id="za_tabelu"></div>
                     <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                       <button type="button" class="btn text-white blue_bg" id="rezervisi">Rezerviši</button>
                     </div>
                     <div id="result_text" class="font-weight-bold p-3 m-3"></div>
                  </div>
               </div>
            <?php endif?>
            </aside>
         </div>
      </div>
      </div>
      </div>
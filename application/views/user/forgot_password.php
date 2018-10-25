<div id="content" style="height: 100vh;">
   <div class="section_header text-secondary d-flex justify-content-between align-items-center">
      <div>Zaboravljena Lozinka</div>
   </div>
   <div class="input_box">
      <div class="container">
         <div class="row">
            <div class="wpb_column vc_column_container vc_col-sm-3">
               <div class="vc_column-inner ">
                  <div class="wpb_wrapper">
                  </div>
               </div>
            </div>
            <div class="wpb_column vc_column_container vc_col-sm-6">
               <div class="vc_column-inner ">
                  <div class="wpb_wrapper">
                     <div class="wrapper-sigin-form">
                     	<?php if(!$success):?>
                        <?=form_open(base_url("user/forgotpassword"))?>
                           <!-- /.form-group -->
                           <div class="form-group">
                              <label for="username">Korisničko ime:</label>
                              <input name="username" class="form-control input" id="username" aria-required="true" required="" type="text">
                           </div>
                           <!-- /.form-group -->
                           <div class="form-group">
                              <label for="e-mail">E-Mail:</label>
                              <input name="email" class="form-control input" id="e-mail" aria-required="true" required="" type="email">
                           </div>
                           <?=form_error('email', '<div class="font-weight-bold text-danger p-4">', '</div>')?>
                           <div class="form-group clearfix">
                              <button class="btn pull-right btn-default" id="account-submit" type="submit" onclick="validate()">Pošalji</button>
                           </div>
                           <!-- /.form-group -->
                        <?=form_close()?>
                        <hr>
                        <div class="center">
                           <p>Na E-mail adresi koju ste naveli u registraciji biće poslat mail koji sadrži link za postavljanje nove lozinke na vešem nalogu.</p>
                        </div>
                        <?php else:?>
                        <div class="center">
                           <p><?=$message_succ?></p>
                        </div>
                    <?php endif?>
                     </div>
                  </div>
               </div>
            </div>
            <div class="wpb_column vc_column_container vc_col-sm-3">
               <div class="vc_column-inner ">
                  <div class="wpb_wrapper"></div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
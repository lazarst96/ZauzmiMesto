<div id="content" style="height: 100vh;">
   <div class="section_header text-secondary d-flex justify-content-between align-items-center">
      <div>Promena Lozinke</div>
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
                        <?=form_open()?>
                           <!-- /.form-group -->
                           <div class="form-group">
                              <label for="password">Lozinka:</label>
                              <input name="password" class="form-control input" id="password" aria-required="true" required="" type="password">
                           </div>
                           <?=form_error('password', '<div class="font-weight-bold text-danger p-4">', '</div>')?>
                           <!-- /.form-group -->
                           <div class="form-group">
                              <label for="conf_password">Potvrđena Lozinka:</label>
                              <input name="conf_password" class="form-control input" id="conf_password" aria-required="true" required="" type="password">
                           </div>
                           <?=form_error('conf_password', '<div class="font-weight-bold text-danger p-4">', '</div>')?>
                           <div class="form-group clearfix">
                              <button class="btn pull-right btn-default" id="account-submit" type="submit" onclick="validate()">Promeni Lozinku</button>
                           </div>
                           <!-- /.form-group -->
                        <?=form_close()?>
                        <hr>
                        
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
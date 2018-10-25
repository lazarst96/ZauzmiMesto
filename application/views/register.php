<div id="content">
		<div class="section_header text-secondary d-flex justify-content-between align-items-center">
			<div>Registracija</div>
		</div>		
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12">	
					<article id="post-468" class="post-468 page type-page status-publish hentry">			
						<section id="legal" class="legal">
							<section class="vc_row wpb_row vc_row-fluid block">
								<div class="container">
									<div class="row">
										<div class="wpb_column vc_column_container vc_col-sm-4">
											<div class="vc_column-inner ">
												<div class="wpb_wrapper">
												</div>
											</div>
										</div>
										<input type="hidden" id="create_profile" name="create_profile" value="d531d75a03" />
										<input type="hidden" name="_wp_http_referer" value="/register/" />
										<div class="wpb_column vc_column_container vc_col-sm-4">
											<div class="vc_column-inner ">
												<div class="wpb_wrapper">
												<h3>Tip naloga</h3>
												<?=form_open(base_url("register"))?>
													<div class="radio" id="create-account-user">
													<label>
													<input type="radio" id="id_radio1" value="2" name="account-type" required checked=checked>Korisnik
													</label>
													</div>
													<div class="radio" id="agent-switch" data-agent-state="">
													<label>
													<input type="radio" id="id_radio2" value="1"  name="account-type" required >Firma
													</label>
													</div>
													
														
															<div class="form-group">
																<label for="ca-login-name">Korisničko ime:
																</label>
																<input type="text" class="form-control" placeholder="Unesite korisničko ime" id="ca-login-name" name="username" value="" required>
																<?=form_error('username', '<div class="small font-weight-bold text-danger p-0">', '</div>')?>
															</div>
															<div class="form-group">
																<label for="ca-email">Email:
																</label>
																<input type="email" class="form-control" placeholder="Unesite email" id="ca-email" name="email" value="" required>
																<?=form_error('email', '<div class="font-weight-bold text-danger small p-0">', '</div>')?>
															</div>
															<div class="form-group">
  																<label for="inputPassword6">Lozinka
  																</label>
   																<input type="password" id="inputPassword6" placeholder="Mora biti duža od 8 karaktera i kraća od 20"  aria-describedby="passwordHelpInline" name="password" required>
  	 															<?=form_error('password', '<div class="font-weight-bold small text-danger p-0">', '</div>')?>
  															</div>
  															<div class="form-group">
  																<label for="inputPassword6">Potvrdite Lozinku
  																</label>
   																<input type="password" id="inputPassword7" placeholder="Ne sme se razlikovati od prvobitne lozinke"  aria-describedby="passwordHelpInline" name="conf_password" required>
  	 															<?=form_error('conf_password', '<div class="font-weight-bold small text-danger p-0">', '</div>')?>
  															</div>
														
													
													
		
													<div class="form-group clearfix">
														<button type="submit" class="btn pull-right btn-default" id="account-submit">Kreiraj nalog
														</button>
													</div>
												<?=form_close()?>
												<hr>
													<div class="center">
														<figure class="note">Klikom na dugme kreiraj nalog prihvatate uslove korišćenja sajta 
														</figure>
													</div>
												</div>
											</div>
										</div>
										<div class="wpb_column vc_column_container vc_col-sm-4">
											<div class="vc_column-inner ">
												<div class="wpb_wrapper">
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>							
		                </section><!-- .legal -->
	                </article><!-- #post-## -->
                </div>
			</div>
		</div>
	</div>
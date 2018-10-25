<style>
   body{
      font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
   }
   .sidebar{
      z-index:0!important;
      box-shadow: 1px -20px 20px rgba(0, 0, 0, 0.08);
      height:80%;
   }
   #wraprer{
      z-index:0!important;
   }
   footer{
      margin-top: 0;
      z-index:1004!important;
   }
   nav, .all_rights{
      z-index:1004!important;  
   }
</style>
<div id="wrapper">
   <!-- ============================================================== -->
   <!-- Topbar header - style you can find in pages.scss -->
   <!-- ============================================================== -->
   <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
               <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigacija</span></h3>
                </div>
         <ul class="nav" id="side-menu">
            <li style="padding: 100px 0 0;">
               <a href="<?=base_url('admin')?>" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>Prikaz</a>
            </li>
            <li>
               <a href="<?=base_url('admin/members/')?>" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i>Članovi</a>
            </li>
            <li>
               <a href="<?=base_url('admin/settings')?>" class="waves-effect"><i class="fa fa-columns fa-fw" aria-hidden="true"></i>Podešavanje portala</a>
            </li>
         </ul>
      </div>
   </div>
   <!-- ============================================================== -->
   <!-- End Left Sidebar -->
   <!-- ============================================================== -->
   <!-- ============================================================== -->
   <!-- Page Content -->
   <!-- ============================================================== -->
   <div id="page-wrapper">
      <div class="container-fluid">
         <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
               <h4 class="page-title">Statistika</h4>
            </div>
            <!-- /.col-lg-12 -->
         </div>
         <!-- /.row -->
         <!-- ============================================================== -->
         <!-- Different data widgets -->
         <!-- ============================================================== -->
         <!-- .row -->
         <div class="row">
            <div class="col-lg-4 col-sm-6 col-xs-12">
               <div class="white-box analytics-info">
                  <h3 class="box-title">Broj korisnika</h3>
                  <ul class="list-inline two-part">
                     <li>
                        <div id="sparklinedash"></div>
                     </li>
                     <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success"><?=$num_users?></span></li>
                  </ul>
               </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-xs-12">
               <div class="white-box analytics-info">
                  <h3 class="box-title">Broj objekata</h3>
                  <ul class="list-inline two-part">
                     <li>
                        <div id="sparklinedash2"></div>
                     </li>
                     <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="counter text-purple"><?=$num_companies?></span></li>
                  </ul>
               </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-xs-12">
               <div class="white-box analytics-info">
                  <h3 class="box-title">Broj rezervacija</h3>
                  <ul class="list-inline two-part">
                     <li>
                        <div id="sparklinedash3"></div>
                     </li>
                     <li class="text-right"><i class="ti-arrow-up text-info"></i> <span class="counter text-info"><?=$num_reservations?></span></li>
                  </ul>
               </div>
            </div>
         </div>
         <!--/.row -->
         <!--row -->
         <!-- /.row -->
         <!-- ============================================================== -->
         <!-- table -->
         <!-- ============================================================== -->
         <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
               <div class="white-box">
                  <div class="col-md-3 col-sm-4 col-xs-6 pull-right">
                  </div>
                  <h3 class="box-title">Skorašnje rezervacije</h3>
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>Korisnik</th>
                              <th>Kafana</th>
                              <th>Datum</th>
                              <th>Rezervisano mesta</th>
                           </tr>
                        </thead>
                        <tbody>
                        <?php $i=1?>
                        <?php foreach ($tables as $table):?>
                           <tr>
                              <td><?=$i?></td>
                              <td><a class="text-dark" href="<?=client_href($table->username, $table->email)?>"><?=$table->firstname." ".$table->lastname?></a></td>
                              <td><?=$table->name?></td>
                              <td><?=$table->start_time?></td>
                              <td><?=$table->capacity?></td>
                           </tr>
                           <?php ++$i?>
                        <?php endforeach?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
               <div class="white-box">
                  <div class="col-md-3 col-sm-4 col-xs-6 pull-right">
                  </div>
                  <h3 class="box-title">Novi članovi</h3>
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>Korisničko ime</th>
                              <th>Email</th>
                              <th>Datum</th>
                              <th>Tip</th>
                           </tr>
                        </thead>
                        <tbody>
                        <?php foreach($new_users as $index => $user):?>
                           <tr>
                              <td><?=$index+1?></td>
                              <td class="txt-oflo"><a class="text-dark" href=<?=($user->type==1)?company_href($user->username, $user->email):client_href($user->username, $user->email)?>><?=$user->username?></a></td>
                              <td><?=$user->email?></td>
                              <td class="txt-oflo"><?=$user->join_time?></td>
                              <td><span class="text-success"><?=($user->type==1)?"Objekat":"Korisnik"?></span></td>
                           </tr>
                        <?php endforeach?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
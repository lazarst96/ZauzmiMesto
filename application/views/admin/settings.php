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
            
                
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Brisanje korisnika</h3>
                            <form>
  <div class="input-group form">
    <input type="text" class="form-control" placeholder="Pretraži">
    <div class="input-group-btn">
      <button class="btn btn-default" type="submit">
        <i class="glyphicon glyphicon-search"></i>
      </button>
    </div>
  </div>
</form>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Ime</th>
                                            <th>Korisničko ime </th>
                                            <th>Email</th>
                                              <th>Tip</th>
                                            <th>Obriši</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Zoran</td>
                                            <td>beergarden</td>
                                            <td>beergarden1@gmail.com</td>
                                            <td>objekat</td>
                                            <td><i class="fa p-2 fa-trash kanta"> </i>  </td>
                                        </tr>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
           
        </div>
        <!-- /#page-wrapper -->
    </div>
</div>
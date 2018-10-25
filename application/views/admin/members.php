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
                            <h3 class="box-title">Tabela korisnika</h3>
                            
                            <label class="radio-inline">Korisnik</label>
    <input type="radio" id="input1" name="tipkorisnika" class="tipusera" checked="checked" / >
    <label class="radio-inline">Restoran</label> 
    <input type="radio" id="input1" class="tipusera" name="tipkorisnika" / >

                            <div class="table-responsive" id="content">
                                <table id="table_clients" class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th id="user_1">Ime </th>
                                            <th id="user_2">Prezime</th>
                                            <th id="user_3">Korisničko ime</th>
                                            <th id="user_4">Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php foreach ($clients as $key => $client):?>
                                        <tr>
                                            <td><?=$key+1?></td>
                                            <td><?=$client->firstname?></td>
                                            <td><?=$client->lastname?></td>
                                            <td><a href="<?=client_href($client->username, $client->email)?>"><?=$client->username?></a></td>
                                            <td><?=$client->email?></td>
                                        </tr>
                                       <?php endforeach?>
                                    </tbody>
                                </table>
                                <table id="table_companies" class="table d-none">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th id="user_1">Ime objekta</th>
                                            <th id="user_2">Tip objekta</th>
                                            <th id="user_3">Korisničko ime</th>
                                            <th id="user_4">Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php foreach ($companies as $key => $client):?>
                                        <tr>
                                            <td><?=$key+1?></td>
                                            <td><?=$client->name?></td>
                                            <td><?=$client->type?></td>
                                            <td><a href="<?=company_href($client->username, $client->email)?>"><?=$client->username?></a></td>
                                            <td><?=$client->email?></td>
                                        </tr>
                                       <?php endforeach?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
           
        </div>
</div>
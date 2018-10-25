<style>
   body{
      font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
   }
   .plus, .minus, .kanta{
   border-radius: 5px;
   cursor:pointer;
   background: transparent;
   }
   .plus:hover,.kanta:hover, .minus:hover{
   background: rgba(0,0,0,0.2);
   transition-duration: 0.5s; 
   }
   footer{
      margin-top: 0;
   }
</style>
<div class="preloader">
   <svg class="circular" viewBox="25 25 50 50">
      <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
   </svg>
</div>
<!-- ============================================================== -->
<!-- Wrapper -->
<!-- ============================================================== -->
<div id="wrapper" >
<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- End Left Sidebar -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Page Content -->
<!-- ============================================================== -->
<div id="page-wrapper" class="ml-0">
<div class="container-fluid">
   <div class="row bg-title">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
         <h4 class="page-title">Dashboard</h4>
      </div>
      <!-- /.col-lg-12 -->
   </div>
   <!-- /.row -->
   <!-- ============================================================== -->
   <!-- Different data widgets -->
   <!-- ============================================================== -->
   <!-- .row -->
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
            <h3 class="box-title">Trenutno stanje stolova</h3>
            <div class="table-responsive">
               <table class="table" style="table-layout:fixed">
                  <thead>
                     <tr>
                        <th>Kapacitet</th>
                        <?php foreach($tables as $capacity => $table):?>
                           <th><?=$capacity?></th>
                        <?php endforeach?>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>Broj slobodnih</td>
                        <?php foreach($tables as $capacity => $table):?>
                           <td class="number_tables"><span><?=$table->number?></span>/<?=$table->full?></td>
                        <?php endforeach?>
                     </tr>
                     <tr>
                        <td>Oslobodi/Zauzmi</td>
                        <?php $i=1?>
                        <?php foreach($tables as $capacity => $table):?>
                        <td><i class="fa fa-plus text-success mr-3 p-2 plus" data-table="<?=$table->table_id?>" data-num="<?=$i?>" data-full="<?=$table->full?>"></i><i class="fa fa-minus text-danger p-2 minus"data-table="<?=$table->table_id?>" data-num="<?=$i?>" data-full="<?=$table->full?>"></i></td>
                        <?php $i++?>
                        <?php endforeach?>
                     </tr>
                  </tbody>
               </table>
               <h3 class="text-danger" id="message_up_st"></h3>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <input type="hidden" name="csrf_test_name" value="<?=$this->security->get_csrf_hash()?>">
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
                        <th>Korisničko ime</th>
                        <th>Od</th>
                        <th>Do</th>
                        <th>Rezervisano mesta</th>
                        <th>Obriši</th>
                     </tr>
                  </thead>
                  <tbody id="tbody" data-num="<?=count($reserved_tables)?>">
                     <?php
                        $i=0;
                        foreach ($reserved_tables as $item):
                        ++$i;
                     ?> 
                     <tr class="res_row">
                        <td><?=$i?></td>
                        <td><a class="text-dark" href="<?=client_href($item->username, $item->email)?>"><?=$item->firstname." ".$item->lastname?></a></td>
                        <td><a class="text-dark" href="<?=client_href($item->username, $item->email)?>"><?=$item->username?></a></td>
                        <td><?=$item->start_time?></td>
                        <td><?=$item->end_time?></td>
                        <td><?=$item->capacity?></td>
                        <td><i class="fa p-2 fa-trash kanta blue_text" data-res="<?=$item->id?>" data-nth="<?=$i?>"> </i>  </td>
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
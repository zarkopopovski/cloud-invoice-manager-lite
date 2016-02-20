

<link href="<?php echo base_url('assets/css/pages/dashboard.css') ?>" rel="stylesheet" />


<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <?php

        createCustomeMenuForBaseURL(FALSE, 0, 0);

      ?>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
<!-- /subnavbar -->
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
       
        <div class="span6">

          <div class="widget">
            <div class="widget-header"> <i class="icon-bookmark"></i>
              <h3>Important Shortcuts</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="shortcuts"> 
                
                <?php

                      echo "<a  href='".site_url('customerdashboard/categories')."' class='shortcut'><i class='shortcut-icon icon-th-list'></i><span class='shortcut-label'>".lang('products_categories')."</span> </a>
                      <a  href='".site_url('customerdashboard/create_products')."' class='shortcut'><i class='shortcut-icon icon-th-large'></i><span class='shortcut-label'>".lang('products_new_product')."</span> </a>";
                                    
                      echo "<a  href='".site_url('customerdashboard/create_client')."' class='shortcut'><i class='shortcut-icon icon-user'></i> <span class='shortcut-label'>".lang('clients_new_client')."</span> </a>";
                
                      echo "<a  href='".site_url('customerdashboard/create_output_invoices')."' class='shortcut'><i class='shortcut-icon icon-arrow-up'></i><span class='shortcut-label'>".lang('invoices_new_output_invoice1')."</span> </a>";
                  

                ?>

                </div>
              <!-- /shortcuts --> 
            </div>
            <!-- /widget-content --> 
          </div>
          <!-- /widget -->
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
              <h3> <?php echo lang('dashboard_not_paid_inovices_due_date'); ?></h3>
            </div>
            <!-- /widget-header -->
               <div class="widget-content">
                      <table >
                        <thead>
                          <tr style='background-color: lightgray'>
                            <th width="5%"> <?php echo lang('invoices_invoice_number'); ?></th>
                            <th width="20%"> <?php echo lang('invoices_client'); ?></th>
                            <th width="10%"> <?php echo lang('invoices_sum'); ?></th>
                            <th width="5%"> <?php echo lang('invoices_due_date'); ?></th>
                            <th width="5%"> <?php echo lang('invoices_view'); ?></th>
                          </tr>
                        </thead>
                        <tbody>
                                <?php

                                  if (isset($getInvoices) && sizeof($getInvoices) > 0){                               

                                  foreach ($getInvoices as $row) {

                                    
                                        echo "<tr>";
                                        echo "<td align='center'>" . $row['invoice_number'] . "</td>";
                                        echo "<td align='center'>" . $row['name'] . "</td>";
                                        echo "<td align='center'>" . $row['invoice_sum'] . "</td>";
                                        echo "<td align='center'>" . $row['due_date'] . "</td>";
                                        echo "<td align='center'><a class='btn btn-small btn-primary' href='customerdashboard/view_invoice?id=". $row['id'] . "'>VIEW</a></td>";
                                        echo "</tr>";                      
                                  
                                        }

                                      } else {

                                                 echo "<tr>";
                                                 echo "<td colspan='6'>";              
                                                 echo "<div><span class='news-item-month'><p align='center'>". lang('dashboard_no_invoices') ."</p></span> ";
                                                 echo "</div>";                    
                                                 echo "</td>";
                                                 echo "</tr>";

                                              }

                                  ?>
                        
                        </tbody>
                      </table>
                <!-- /widget-content --> 
              </div>
            </div>
         
        </div>
        <!-- /span6 -->

        <div class="span6">
          

          <div class="widget widget-nopad">
            <!-- <div class="widget-header"> <i class="icon-list-alt"></i>
              <h3> Today's Stats</h3>
            </div> -->
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="widget big-stats-container">
                <div class="widget-header"> <i class="icon-book"></i>
              <h3> <?php echo lang('dashboard_not_paid_inovices_due_date'); ?></h3>
            </div>
                <div class="widget-content">

                  </br>

                   <h4 align="center"><?php echo lang('dashboard_output_invoices'); ?></h4>
                  
                  <div id="big_stats" class="cf">
                   
                     <div class="stat"> <h6><?php echo lang('dashboard_total'); ?></h6> <span class="value"><?php if(isset($invoicesCounter)) { echo $invoicesCounter['outNumber']; } else {echo "0";} ?></span> </div>
                    <!-- .stat -->
                    
                     <div class="stat"> <h6><?php echo lang('dashboard_sum'); ?></h6> <span class="value"><?php if(isset($invoicesCounter)) { echo $invoicesCounter['outSumAll']; } else {echo "0";} ?></span> </div>
                    <!-- .stat -->
                     <div class="stat"> <h6><?php echo lang('dashboard_total_paid'); ?></h6> <span class="value"><?php if(isset($invoicesCounter)) { echo $invoicesCounter['outNumPaid']; } else {echo "0";} ?></span> </div>
                    <!-- .stat -->
                    
                     <div class="stat"> <h6><?php echo lang('dashboard_paid_sum'); ?></h6> <span class="value"><?php if(isset($invoicesCounter)) { echo $invoicesCounter['outSumPaid']; } else {echo "0";} ?></span> </div>
                    <!-- .stat -->
                    
                   </div>
                  <hr>


                   <h4 align="center"><?php echo lang('dashboard_invoices_not_paid'); ?></h4>
                  
                  <div id="big_stats" class="cf">
                   
                    <!-- .stat -->
                      <div class="stat"> <h6><?php echo lang('dashboard_output_total'); ?></h6> <span class="value"><?php if(isset($invoicesCounter)) { echo $invoicesCounter['outNumNotPaid']; } else {echo "0";} ?></span> </div>
                    <!-- .stat -->
                    
                     <div class="stat"> <h6><?php echo lang('dashboard_output_sum'); ?></h6> <span class="value"><?php if(isset($invoicesCounter)) { echo $invoicesCounter['outSumNotPaid']; } else {echo "0";} ?></span> </div>
                    <!-- .stat -->
                    
                  </div>
                  

                </div>
                <!-- /widget-content --> 
                
              </div>
            </div>
          </div>
          
        </div>
        <!-- /span6 --> 

      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!-- /main -->
<div class="extra">

  <div class="extra-inner">

    <div class="container">

      <div class="row">
                    <div class="span3">
                        <h4>
                            Cloud Invoice Manager Lite</h4>
                        <ul>
                            <li><a href="<?= site_url('customerdashboard/products') ?>"><?php echo lang('menu_products'); ?></a></li>
                            <li><a href="<?= site_url('customerdashboard/clients') ?>"><?php echo lang('menu_clients'); ?></a> </li>
                            <li><a href="<?= site_url('customerdashboard/invoices') ?>"><?php echo lang('menu_invoices'); ?></a> </li>
                            <li><a href="<?= site_url('customerdashboard/expenses') ?>"><?php echo lang('menu_expenses'); ?></a> </li>
                            <li><a href="<?= site_url('customerdashboard/notes') ?>"><?php echo lang('menu_notes'); ?></a> </li>
                            
                  
                        </ul>
                    </div>
                    <!-- /span3 -->
                    <div class="span3">
                        <h4>
                            Support</h4>
                        <ul>
                            <li><a href="javascript:;"><?php echo lang('menu_frequently_asked_questions'); ?></a></li>
                            <li><a href="javascript:;"><?php echo lang('menu_ask_a_question'); ?></a></li>
                            <li><a href="javascript:;"><?php echo lang('menu_video_tutorial'); ?></a></li>
                            <li><a href="javascript:;"><?php echo lang('menu_feedback'); ?></a></li>
                        </ul>
                    </div>
                    <!-- /span3 -->
                    <div class="span3">
                        <h4>
                            Something Legal</h4>
                        <ul>
                            <li><a href="javascript:;"><?php echo lang('menu_read_license'); ?></a></li>
                            <li><a href="javascript:;"><?php echo lang('menu_terms_of_use'); ?></a></li>
                            <li><a href="javascript:;"><?php echo lang('menu_privacy_policy'); ?></a></li>
                        </ul>
                    </div>
                    <!-- /span3 -->
                    <div class="span3">
                        <h4>
                            Settings & user Management</h4>
                        <ul>
                            <li><a href="<?= site_url('customerdashboard/usermanagement') ?>"><?php echo lang('menu_user_management'); ?></a> </li>
                            <li><a href="<?= site_url('customerdashboard/settings') ?>"><?php echo lang('menu_settings'); ?></a> </li>

                        </ul>
                    </div>
                    <!-- /span3 -->
                </div> <!-- /row -->

    </div> <!-- /container -->

  </div> <!-- /extra-inner -->

</div> <!-- /extra -->


    
    
<div class="footer">
  
  <div class="footer-inner">
    
    <div class="container">
      
      <div class="row">
        
          <div class="span12">
            &copy; 2014 <a href="http://www.egrappler.com/">Cloud Invoice Manager Lite</a>.
          </div> <!-- /span12 -->
          
        </div> <!-- /row -->
        
    </div> <!-- /container -->
    
  </div> <!-- /footer-inner -->
  
</div> <!-- /footer -->
<!-- Le javascript
================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 



<script src="<?php echo base_url('assets/js/excanvas.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/chart.min.js') ?>" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url('assets/js/full-calendar/fullcalendar.min.js') ?>"></script>

<script src="js/base.js"></script> 


<script type="text/javascript">
  var showErrorAlert = "<?php if (isset($errormsg)) echo $errormsg; else echo "0";?>";
  
  if (showErrorAlert != 0) {
    //alert(showErrorAlert);
  } 

       

</script>




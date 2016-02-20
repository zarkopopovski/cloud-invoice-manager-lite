


<link href="css/pages/plans.css" rel="stylesheet"> 

    <script type="text/javascript" charset="utf-8">
            /* Global var for counter */
            var giCount = 1;
            
            $(document).ready(function() {
                $('#example').dataTable();
            } );
            
            
        </script>

    
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <?php

        createCustomeMenuForBaseURL(FALSE, 3, 0);

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
	      	
	      	<div class="span12">
	      		
	      		

	      		<?php
                   
                       

                         echo "<div class='btn-group'>
                                <button class='btn'>Create NEW Invoice</button>
                                <button class='btn dropdown-toggle' data-toggle='dropdown'>
                                <span class='caret'></span>
                                </button>
                                <ul class='dropdown-menu'>
                                <li><a href='".site_url('customerdashboard/create_output_invoices')."'>".lang('invoices_new_output_invoice')."</a></li>
                                </ul>
                               </div></br>";

                ?>

                <div class="widget-content">

                <div class="form-horizontal">
					
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                  <tr>
                    <th> <?php echo lang('invoices_invoice_number'); ?></th>
                    <th width="20%"> <?php echo lang('invoices_client'); ?></th>
                    <th> <?php echo lang('invoices_sum'); ?></th>
                    <th> <?php echo lang('invoices_tax'); ?></th>
                    <th> <?php echo lang('invoices_total'); ?></th>                    
                    <th> <?php echo lang('invoices_due_date'); ?></th>
                    <th> <?php echo lang('invoices_paid_date'); ?></th>
                    <th> <?php echo lang('invoices_status'); ?></th>
                    <th> <?php echo lang('invoices_options'); ?></th>
                    
                  </tr>
                </thead>
                
                <tbody>

					<?php

					  if (isset($results) && sizeof($results) > 0){

                       

					  foreach ($results as $row) {

                         $paidDate = $row['paid_date'];

                        if(is_null($row['paid_date'])) {
                        $paidDate = "/";
                        }

                        $paidStatus = "<td align='center'>" . $row['status'] . "</td>";

                        if($row['status'] == 'NOTPAID') {
                            $paidStatus =  "<td align='center'><a class='btn btn-small btn-primary' href='update_invoice_status?id=". $row['id'] . "'>SET PAID</a></td>";
    
                        } 

                        $editInvoice = "&nbsp;<a class='btn btn-small btn-success' href='edit_invoice?id=". $row['id'] . "'>EDIT</a>";
						
					  echo "<tr>";
					  echo "<td align='center'>" . $row['invoice_number'] . "</td>";
					  echo "<td align='center'>" . $row['name'] . "</td>";
                      echo "<td align='center'>" . $row['invoice_subtotal'] . "</td>";
                      echo "<td align='center'>" . $row['invoice_tax_sum'] . "</td>";
					  echo "<td align='center'>" . $row['invoice_sum'] . "</td>";
					  echo "<td align='center'>" . $row['due_date'] . "</td>";
					  echo "<td align='center'>" . $paidDate . "</td>";
					  echo  $paidStatus;
					  echo "<td align='center'><a class='btn btn-small btn-primary' href='view_invoice?id=". $row['id'] . "'>VIEW</a>";

                      echo $editInvoice;
                      echo "&nbsp;<a class='btn btn-danger btn-small' href='delete_invoice?id=". $row['id'] . "'  onclick='return runMyFunction();''>X</a></td>";
					 
                      echo "</tr>";

					  
					  }

					}

					  ?>


                 
                                 
                </tbody>
              </table>
  
								
					</div>
                    </div>

				</div> <!-- /widget content  TABLE-->
						
				</div> <!-- /widget -->					
				
		    </div> <!-- /span12 -->     	
	      	
	      	
	      </div> <!-- /row -->
	
	    </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    
</div> <!-- /main -->
    


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

<script type="text/javascript">

    function runMyFunction() {

        
        if (confirm("Are you sure to delete that product?") == true) {
            return true;
        } else {
          return false;
        }
        
     

    }
   
    


</script>

<script src="js/base.js"></script>

 

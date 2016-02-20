


<link href="css/pages/plans.css" rel="stylesheet"> 

    <script type="text/javascript" charset="utf-8">
            $(document).ready(function() {

                $('#example1').dataTable();
            } );
        </script>

    
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <?php

        createCustomeMenuForBaseURL(FALSE, 2, 0);

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
	      		
	      		<div class="widget">

	      		

	      		<div class="tab-pane">
				<div >
                <?php
                   
                    echo "<div class='btn-group'>
                            <button class='btn'>".lang('client_groups_title')."</button>
                            <button class='btn dropdown-toggle' data-toggle='dropdown'>
                            <span class='caret'></span>
                            </button>
                            <ul class='dropdown-menu'>
                            <li><a href='".site_url('customerdashboard/create_client')."'>".lang('clients_new_client')."</a></li>
                            <li><a href='".site_url('customerdashboard/client_groups')."'>".lang('client_groups')."</a></li>
                            </ul>
                           </div></br>";


                ?>

				</div>
				
                </div>

                <div class="widget-content">
                <div class="form-horizontal">
					
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="example1">
                <thead>
                  <tr>
                    <th width="35%"> <?php echo lang('clients_client_name'); ?> </th>
                    <th width="20%"> <?php echo lang('clients_city'); ?></th>
                    <th width="30%"> <?php echo lang('clients_email'); ?></th>
                    <th width="15%"> <?php echo lang('clients_options'); ?></th>
                  </tr>
                </thead>
                
                <tbody>

					<?php

					  if (isset($results) && sizeof($results) > 0){

					  foreach ($results as $row) {
						
					  echo "<tr>";
					  echo "<td align='center'>" . $row['name'] . "</td>";
					  echo "<td align='center'>" . $row['city'] . "</td>";
					  echo "<td align='center'>" . $row['email'] . "</td>";
					  echo "<td align='center'><a class='btn btn-small btn-primary' href='view_client?id=". $row['id'] . "'>VIEW</a>";
					  
                      
                      echo "&nbsp;<a class='btn btn-small btn-success' href='edit_client?id=". $row['id'] . "'>EDIT</a>";
					  echo "&nbsp;<a class='btn btn-danger btn-small' href='delete_client?id=". $row['id'] . "'  onclick='return runMyFunction(\"". $row['id'] . "\");'>X</a></td>";
                      
                      
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

    function runMyFunction(id) {       
        
        
        if (confirm("Are you sure to delete that client?") == true) {


             $.post("<?php echo base_url();?>index.php/customerdashboard/check_clients",
                {"client_id":id}).done(function(data) {
                    if (data) {
                        
                        var productsJSON = JSON.parse(data);
                                                
                        if (productsJSON.status == 'valid') {
                            alert("DELETE ERROR: Client exist in invoices");
                            return false;
                        } else{
                            return true;
                        }
                        
                    }
                  },"json");

                return false;

           
        } else {
          return false;
        }
        
     
    }
   
    


</script>

<script src="js/base.js"></script>

 

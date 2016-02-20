


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

	      		<div class="widget-content">
						
					<div >

					<div >
											
					<div >
					
				<table class="table">
                <thead>
                  <tr>
                    <th><h4 style="color:#006600;">CLIENT: </h4><h3><?php if(isset($results)) echo $results['name']; ?></h3> </th>
                    <th></th>
                    <th></th>

                    
                    
                  </tr>
                </thead>
                
                <tbody>

					<tr>
					<th><h4 style="color:#006600;">EMAIL: </h4><h4><?php if(isset($results)) echo $results['email']; ?></h4></h4>
					<th><h4 style="color:#006600;">ADDRESS 1: </h4><h4><?php if(isset($results)) echo $results['address']; ?></h4></h4>
					<th><h4 style="color:#006600;">ADDRESS 2: </h4><h4><?php if(isset($results)) echo $results['address2']; ?></h4></h4>
					
					</tr>
					<tr>
					<th><h4 style="color:#006600;">ZIP: </h4><h4><?php if(isset($results)) echo $results['zip']; ?></h4></h4>
					<th><h4 style="color:#006600;">CITY: </h4><h4><?php if(isset($results)) echo $results['city']; ?></h4></th>
					<th><h4 style="color:#006600;">COUNTRY: </h4><h4><?php if(isset($results)) echo $results['country']; ?></h4></th>
					</tr>

					<tr>
					<th><h4 style="color:#006600;">PHONE 1: </h4><h4><?php if(isset($results)) echo $results['tel1']; ?></h4></th>
					<th><h4 style="color:#006600;">PHONE 2: </h4><h4><?php if(isset($results)) echo $results['tel2']; ?></h4></th>
					<th></th>
					</tr>

					<tr>
					<th><h4 style="color:#006600;">Registration Number: </h4><h4><?php if(isset($results)) echo $results['registration_number']; ?></h4></h4>
					<th><h4 style="color:#006600;">Unique Number: </h4><h4><?php if(isset($results)) echo $results['unique_number']; ?></h4></th>
					<th><h4 style="color:#006600;">Unique Number: </h4><h4><?php if(isset($results)) echo $results['tax_number']; ?></h4></th>
					</tr>

					<tr>
					<th colspan="3"><h4 style="color:#006600;">Client Group: </h4><h4><?php if(isset($results)) echo $results['group_name']; ?></h4></h4>
					</tr>

					<tr>
					<th></th>
					<th>

					<?php

						

							echo"<form action='".site_url('customerdashboard/edit_client')."' method='post' >";
							echo"<input type='hidden' id='id' name='id' size='20' maxlength='40' value='".((isset($results))?$results['id']:"")."'/> ";
	    					echo"&nbsp;<input type='submit' id='submit' name = 'submit' class='btn btn-primary' value='".lang('clients_edit_details')."' /> 
					 		</form> ";

						



					?>
		
					</th>
					<th></th>
					</tr>
                                 
                </tbody>
              </table>

					
					</div> <!-- /view client -->
								
					</div> 
				</div>

				</div> <!-- /widget content  INPUT-->

				<br/>

				<div class="widget-content">
				<div align='right'>

				<?php

					$clientID = $_GET["id"];

					
						echo "<a href='".site_url('customerdashboard/create_clocation?id='.$clientID)."' class='btn btn-primary' >New Location</a>";
					


				?>

				</div>
				</br>


           		<div class="form-horizontal">
				<table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                <thead>
                  <tr>
                    <th align='center'> Name</th>
                    <th align='center'> Address</th>
                    <th align='center'> City</th>
                    <th align='center'> Zip</th>
                    <th align='center'> Tel</th>
                    <th align='center'> Options </th>
                    
                  </tr>
                </thead>
                
                <tbody>

					<?php

					  if (isset($clientLocations) && sizeof($clientLocations) > 0){

                       

						foreach ($clientLocations as $row) {
							
						  echo "<tr>";
						  echo "<td>" . $row['name'] . "</td>";
						  echo "<td>" . $row['address'] . "</td>";
						  echo "<td>" . $row['city'] . "</td>";
						  echo "<td>" . $row['zip'] . "</td>";
						  echo "<td>" . $row['tel'] . "</td>";					  
						  
						  
						  	echo "<td align='center'><a class='btn btn-small btn-success' href='edit_clocation?id=".$clientID."&loc_id=". $row['id'] . "'>EDIT</a> &nbsp;";
						  	echo "<a class='btn btn-danger btn-small' href='delete_clocation?loc_id=". $row['id'] . "'>X</a></td>"; 					  
						  
						  echo "</tr>";

						  
						  }

					}

					  ?>


                 
                                 
                </tbody>
              </table>
				
              	</div>
  
								
					</div>

				</div> <!-- /widget content  TABLE-->


				<br/>

				<div class="widget-content">
				<div align='right'>

				<?php

					if (isset($permissionMap) && $permissionMap["invoices_manage_invoices"] == "ENABLE") {
						echo "<a href='".site_url('customerdashboard/create_invoices')."' class='btn btn-primary' >New Invoice</a>";
					}


				?>

				</div>
				</br>


           		<div class="form-horizontal">
					
				<table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                <thead>
                  <tr>
                    <th> Invoice Number</th>
                    <th> Status</th>
                    <th> Sum</th>
                    <th> Due Date</th>
                    <th> Paid Date</th>
                    <th> Confirmed</th>
                    <th> Options</th>
					</tr>
                </thead>
                
                <tbody>

					<?php

					  if (isset($clientInvoices) && sizeof($clientInvoices) > 0){

                       

					  foreach ($clientInvoices as $row) {

                         $paidDate = $row['paid_date'];

                        if(is_null($row['paid_date'])) {
                        $paidDate = "/";
                        }
						
					  echo "<tr>";
					  echo "<td>" . $row['invoice_number'] . "</td>";
					  echo "<td>" . $row['confirmed'] . "</td>";
					  echo "<td>" . $row['invoice_sum'] . "</td>";
					  echo "<td>" . $row['due_date'] . "</td>";
					  echo "<td>" . $row['paid_date'] . "</td>";					  
					  echo "<td>" . $row['status'] . "</td>";
					  echo "<td><a class='btn btn-small btn-primary' href='view_invoice?id=". $row['id'] . "'>VIEW</a>";
					  
					  echo "&nbsp;<a class='btn btn-small btn-success' href='edit_invoice?id=". $row['id'] . "'>EDIT</a>";
					  echo "&nbsp;<a class='btn btn-danger btn-small' href='delete_invoice?id=". $row['id'] . "'>X</a></td>"; 					  
					  
					  echo "</tr>";

					  
					  }

					}

					  ?>


                 
                                 
                </tbody>
              </table>
              </div>
  
								
					</div>

				</div> <!-- /widget content  TABLE-->

	      		
						
				</div> <!--		widget	 -->				
				
		    </div> <!-- /span12     -->	
	      	
	      	
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
        					<li><a href="categories">Categories</a> </li>
					        <li><a href="products">Products</a></li>
					        <li><a href="clients">Clients</a> </li>
					        <li><a href="invoices">Invoices</a> </li>
					        <li><a href="expenses">Expenses</a> </li>
					        
                        </ul>
                    </div>
                    <!-- /span3 -->
                    <div class="span3">
                        <h4>
                            Support</h4>
                        <ul>
                            <li><a href="javascript:;">Frequently Asked Questions</a></li>
                            <li><a href="javascript:;">Ask a Question</a></li>
                            <li><a href="javascript:;">Video Tutorial</a></li>
                            <li><a href="javascript:;">Feedback</a></li>
                        </ul>
                    </div>
                    <!-- /span3 -->
                    <div class="span3">
                        <h4>
                            Something Legal</h4>
                        <ul>
                            <li><a href="javascript:;">Read License</a></li>
                            <li><a href="javascript:;">Terms of Use</a></li>
                            <li><a href="javascript:;">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <!-- /span3 -->
                    <div class="span3">
                        <h4>
                            Settings & user Management</h4>
                        <ul>
                            <li><a href="settings">Settings</a> </li>
					        <li><a href="usermanagement">User Management</a> </li>
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

<script src="js/base.js"></script>

 

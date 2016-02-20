


<link href="css/pages/plans.css" rel="stylesheet"> 

<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable();
			} );
		</script>
    

    
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
      	<li><a href="<?= site_url('admindashboard') ?>"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
        <li class="active"><a href="usermanagement"><i class="icon-list-alt"></i><span>User Management</span> </a> </li>
<!--         <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-long-arrow-down"></i><span>Drops</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="icons.html">Icons</a></li>
            <li><a href="faq.html">FAQ</a></li>
            <li><a href="pricing.html">Pricing Plans</a></li>
            <li><a href="login.html">Login</a></li>
            <li><a href="signup.html">Signup</a></li>
            <li><a href="error.html">404</a></li>
          </ul>
        </li> -->
      </ul>
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
						
					<div class="tab-pane" id="formcontrols">
								<form action="add_child_customer" method="post" id="edit-profile" class="form-horizontal">
									<fieldset>
										
																			
										
										<div class="control-group">											
											<label class="control-label" for="name">Full Name:</label>
											<div class="controls">
												<input type="text" class="span6" id="full_name" name="full_name" value="<?php if (isset($customerData)) echo $customerData['name']; ?>"/>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										
										<div class="control-group">											
											<label class="control-label" for="email">Email Address:</label>
											<div class="controls">
												<input type="text" class="span6" id="email" name="email" value="<?php if (isset($customerData)) echo $customerData['email']; ?>"/>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

										<div class="control-group">											
											<label class="control-label" for="email">Password:</label>
											<div class="controls">
												<input type="password" class="span6" id="password" name="password" />
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">											
											<label class="control-label" for="type">Type:</label>
											<div class="controls">
												<select class="spbtn btn-primary dropdown-togglean6" id="type" name="type" value="0">
												  <optgroup label="type">
					  								<option value="ADMIN" <?php if (isset($customerData)) echo (($customerData["type"]=="ADMIN")?"selected":""); ?> >ADMINISTRATOR</option>
					  								<option value="RESELLER" <?php if (isset($customerData)) echo (($customerData["type"]=="RESELLER")?"selected":""); ?>>RESELLER</option>
					  								<option value="CUSTOMER" <?php if (isset($customerData)) echo (($customerData["type"]=="CUSTOMER")?"selected":""); ?>>CUSTOMER</option>
					  								<option value="VIEWER" <?php if (isset($customerData)) echo (($customerData["type"]=="VIEWER")?"selected":""); ?>>VIEWER</option>
												  </optgroup>
												</select>	
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">											
											<label class="control-label" for="email">Status:</label>
											<div class="controls">
												<select class="spbtn btn-primary dropdown-togglean6" id="status" name="status" value="0">
												  <optgroup label="status">
					  								<option value="ENABLE" <?php if (isset($customerData)) echo (($customerData["status"]=="ENABLE")?"selected":""); ?> >ENABLED</option>
					  								<option value="DISABLE" <?php if (isset($customerData)) echo (($customerData["status"]=="DISABLE")?"selected":""); ?>>DISABLED</option>
												  </optgroup>
												</select>	
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
											
										<div class="form-actions">
											<button type="submit" id="submit" class="btn btn-primary">Save</button> 
											<?php if (isset($customerData)) echo "<input type='hidden' name='customer_id' value='".$customerData["id"]."'/>"; ?>
										</div> <!-- /form-actions -->
									</fieldset>
								</form>
								</div>

				</div> <!-- /widget content  INPUT-->

	      		<div class="widget-content">
						
					
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                  <tr>
                    <th width="30%"> Full Name </th>
                    <th width="30%"> Email </th>
                    <th> Type </th>
                    <th> Status </th>
                    <th>  </th>
                    <th>  </th>
                    <th>  </th>
                    <th>  </th>
                  </tr>
                </thead>
                
                <tbody>

					<?php

					  if (isset($results) && sizeof($results) > 0){

					  foreach ($results as $row) {
						
					  echo "<tr>";
					  echo "<td>" . $row['name'] . "</td>";
					  echo "<td>" . $row['email'] . "</td>";
					  echo "<td>" . $row['type'] . "</td>";
					  echo "<td>" . (($row['status']=="ENABLE")?"ENABLED":"DISABLED") . "</td>";
					  echo "<td align='center'><a class='btn btn-small btn-success' href='view_user_data?customer_id=". $row['id'] . "'>View</a></td>";
					  echo "<td align='center'><a class='btn btn-small btn-success' href='userpermissions?customer_id=". $row['id'] . "'>PERMISSIONS</a></td>";
					  echo "<td align='center'><a class='btn btn-small btn-success' href='edit_child_customer?customer_id=". $row['id'] . "'>EDIT</a></td>";
					  echo "<td align='center'><a class='btn btn-danger btn-small' href='delete_child_customer?customer_id=". $row['id'] . "'>DELETE</a></td>";
					  echo "</tr>";

					  
					  }

					}

					  ?>


                 
                                 
                </tbody>
              </table>
  
								
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

 

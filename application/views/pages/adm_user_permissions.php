


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
								<form action="save_customer_permissions" method="post" id="edit-profile" class="form-horizontal">
									<fieldset>
										<br/>
																			
										
										<div class="control-group">											
											<label class="control-label" for="name">Full Name:</label>
											<div class="controls">
												<input type="text" class="span6" id="full_name" name="full_name" value="<?php if (isset($customerData)) echo $customerData['name']; ?>" disabled/>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										
										<div class="control-group">											
											<label class="control-label" for="email">Email Address:</label>
											<div class="controls">
												<input type="text" class="span6" id="email" name="email" value="<?php if (isset($customerData)) echo $customerData['email']; ?>" disabled/>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<br/>
										<hr>	
										<p>Users</p>
										<div class="control-group">											
											<label class="control-label" for="email">User Management:</label>
											<div class="controls">
												<select class="spbtn btn-primary dropdown-togglean6" id="user_mng" name="user_mng" value="0">
												  <optgroup label="status">
					  								<option value="ENABLE" <?php if (isset($permissionsMap)) echo (($permissionsMap["user_management"]=="ENABLE")?"selected":""); ?> >ENABLED</option>
					  								<option value="DISABLE" <?php if (isset($permissionsMap)) echo (($permissionsMap["user_management"]=="DISABLE")?"selected":""); else echo "selected"; ?> >DISABLED</option>
												  </optgroup>
												</select>	
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<hr>
										<p>Inventory</p>
										<div class="control-group">								
											<label class="control-label" for="email">View Products:</label>
											<div class="controls">
												<select class="spbtn btn-primary dropdown-togglean6" id="inv_view_prod" name="inv_view_prod" value="0">
												  <optgroup label="status">
					  								<option value="ENABLE" <?php if (isset($permissionsMap)) echo (($permissionsMap["inventory_view_products"]=="ENABLE")?"selected":""); ?> >ENABLED</option>
					  								<option value="DISABLE" <?php if (isset($permissionsMap)) echo (($permissionsMap["inventory_view_products"]=="DISABLE")?"selected":""); else echo "selected"; ?> >DISABLED</option>
												  </optgroup>
												</select>	
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">								
											<label class="control-label" for="email">Manage Products:</label>
											<div class="controls">
												<select class="spbtn btn-primary dropdown-togglean6" id="inv_mng_prod" name="inv_mng_prod" value="0">
												  <optgroup label="status">
					  								<option value="ENABLE" <?php if (isset($permissionsMap)) echo (($permissionsMap["inventory_manage_products"]=="ENABLE")?"selected":""); ?> >ENABLED</option>
					  								<option value="DISABLE" <?php if (isset($permissionsMap)) echo (($permissionsMap["inventory_manage_products"]=="DISABLE")?"selected":""); else echo "selected"; ?> >DISABLED</option>
												  </optgroup>
												</select>	
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<hr>
										<p>Expenses</p>
										<div class="control-group">								
											<label class="control-label" for="email">View Expenses:</label>
											<div class="controls">
												<select class="spbtn btn-primary dropdown-togglean6" id="exp_view_exp" name="exp_view_exp" value="0">
												  <optgroup label="status">
					  								<option value="ENABLE" <?php if (isset($permissionsMap)) echo (($permissionsMap["expenses_view_expenses"]=="ENABLE")?"selected":""); ?> >ENABLED</option>
					  								<option value="DISABLE" <?php if (isset($permissionsMap)) echo (($permissionsMap["expenses_view_expenses"]=="DISABLE")?"selected":""); else echo "selected"; ?> >DISABLED</option>
												  </optgroup>
												</select>	
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">								
											<label class="control-label" for="email">Manage Expenses:</label>
											<div class="controls">
												<select class="spbtn btn-primary dropdown-togglean6" id="exp_mng_exp" name="exp_mng_exp" value="0">
												  <optgroup label="status">
					  								<option value="ENABLE" <?php if (isset($permissionsMap)) echo (($permissionsMap["expenses_manage_expenses"]=="ENABLE")?"selected":""); ?> >ENABLED</option>
					  								<option value="DISABLE" <?php if (isset($permissionsMap)) echo (($permissionsMap["expenses_manage_expenses"]=="DISABLE")?"selected":""); else echo "selected"; ?> >DISABLED</option>
												  </optgroup>
												</select>	
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<hr>
										<p>Products</p>
										<div class="control-group">								
											<label class="control-label" for="email">View Products:</label>
											<div class="controls">
												<select class="spbtn btn-primary dropdown-togglean6" id="prod_view_prod" name="prod_view_prod" value="0">
												  <optgroup label="status">
					  								<option value="ENABLE" <?php if (isset($permissionsMap)) echo (($permissionsMap["products_view_products"]=="ENABLE")?"selected":""); ?> >ENABLED</option>
					  								<option value="DISABLE" <?php if (isset($permissionsMap)) echo (($permissionsMap["products_view_products"]=="DISABLE")?"selected":""); else echo "selected"; ?> >DISABLED</option>
												  </optgroup>
												</select>	
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">								
											<label class="control-label" for="email">Manage Products:</label>
											<div class="controls">
												<select class="spbtn btn-primary dropdown-togglean6" id="prod_mng_prod" name="prod_mng_prod" value="0">
												  <optgroup label="status">
					  								<option value="ENABLE" <?php if (isset($permissionsMap)) echo (($permissionsMap["products_manage_products"]=="ENABLE")?"selected":""); ?> >ENABLED</option>
					  								<option value="DISABLE" <?php if (isset($permissionsMap)) echo (($permissionsMap["products_manage_products"]=="DISABLE")?"selected":""); else echo "selected"; ?> >DISABLED</option>
												  </optgroup>
												</select>	
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<hr>
										<p>Invoices</p>
										<div class="control-group">								
											<label class="control-label" for="email">View Invoices:</label>
											<div class="controls">
												<select class="spbtn btn-primary dropdown-togglean6" id="ivc_view_ivc" name="ivc_view_ivc" value="0">
												  <optgroup label="status">
					  								<option value="ENABLE" <?php if (isset($permissionsMap)) echo (($permissionsMap["invoices_view_invoices"]=="ENABLE")?"selected":""); ?> >ENABLED</option>
					  								<option value="DISABLE" <?php if (isset($permissionsMap)) echo (($permissionsMap["invoices_view_invoices"]=="DISABLE")?"selected":""); else echo "selected"; ?> >DISABLED</option>
												  </optgroup>
												</select>	
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">								
											<label class="control-label" for="email">Manage Invoices:</label>
											<div class="controls">
												<select class="spbtn btn-primary dropdown-togglean6" id="ivc_mng_ivc" name="ivc_mng_ivc" value="0">
												  <optgroup label="status">
					  								<option value="ENABLE" <?php if (isset($permissionsMap)) echo (($permissionsMap["invoices_manage_invoices"]=="ENABLE")?"selected":""); ?> >ENABLED</option>
					  								<option value="DISABLE" <?php if (isset($permissionsMap)) echo (($permissionsMap["invoices_manage_invoices"]=="DISABLE")?"selected":""); else echo "selected"; ?> >DISABLED</option>
												  </optgroup>
												</select>	
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<br/>
										<div class="form-actions">
											<button type="submit" id="submit" class="btn btn-primary">Save Permissions</button> 
											<input type="hidden" name="customer_id" value="<?php echo $_GET['customer_id'];?>"/>
										</div> <!-- /form-actions -->
									</fieldset>
								</form>
								</div>

				</div> <!-- /widget content  INPUT-->

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

 

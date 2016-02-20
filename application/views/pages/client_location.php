


<link href="css/pages/plans.css" rel="stylesheet"> 

    

    
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
     <?php

        createCustomeMenuForBaseURL(FALSE, 2, $permissionMap);

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
						
					<div class="tab-pane" id="formcontrols">
								<form action="<?= site_url('customerdashboard/add_client_locations') ?>" method="post" id="edit-profile" class="form-horizontal">
									<fieldset>
													
										<div class="control-group">											
											<label class="control-label" for="name"><?php echo lang('client_location_title'); ?></label>
											<div class="controls">
												<input type="text" class="span6" id="name" name="name" value="<?php if(isset($results)) echo $results['name']; ?>">
												<input type="hidden" class="span3" id="id" name="id" value="<?php if(isset($results)) echo $results['id']; ?>">
												<input type="hidden" class="span3" id="id" name="client_id" value="<?php if(isset($client_id)) echo $client_id; ?>">
												<input type="hidden" class="span3" id="id" name="mode" value="<?php if(isset($mode)) echo "edit"; else echo "create"; ?>">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										
										<div class="control-group">											
											<label class="control-label" for="description"><?php echo lang('client_location_address'); ?></label>
											<div class="controls">
												<textarea type="text" class="span6" id="description" name="address"><?php if(isset($results)) echo $results['address']; ?></textarea>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										<div class="control-group">											
											<label class="control-label" for="description"><?php echo lang('client_location_city'); ?></label>
											<div class="controls">
												<input type="text" class="span3" id="name" name="city" value="<?php if(isset($results)) echo $results['city']; ?>">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

										<div class="control-group">											
											<label class="control-label" for="zip"><?php echo lang('client_location_zip'); ?></label>
											<div class="controls">
												<input type="text" class="span3" id="name" name="zip" value="<?php if(isset($results)) echo $results['zip']; ?>">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

										<div class="control-group">											
											<label class="control-label" for="description"><?php echo lang('client_location_tel'); ?></label>
											<div class="controls">
												<input type="text" class="span3" id="name" name="tel" value="<?php if(isset($results)) echo $results['tel']; ?>">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
											
										<div class="form-actions">
											<button type="submit" id="submit" class="btn btn-primary"><?php echo lang('client_location_save'); ?></button> 
											
										</div> <!-- /form-actions -->
									</fieldset>
								</form>
								</div>

				</div> <!-- /widget content  INPUT-->

						
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

 

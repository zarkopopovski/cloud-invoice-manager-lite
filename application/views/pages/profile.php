


<link href="css/pages/plans.css" rel="stylesheet"> 


<script type="text/javascript">



   
  
 </script>

    

    
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <?php

        createCustomeMenuForBaseURL(FALSE, 7, 0);

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
								<form action="edit_profile" method="post" id="edit-profile" class="form-horizontal">
									<fieldset>
										
																			
										
										<div class="control-group">											
											<label class="control-label" for="first_name"><?php echo lang('profile_first_name'); ?></label>
											<div class="controls">
												<input type="text" class="span6" id="first_name" name="first_name" value="<?php if(isset($results)) echo $results['first_name']; ?>">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										
										<div class="control-group">											
											<label class="control-label" for="last_name"><?php echo lang('profile_last_name'); ?></label>
											<div class="controls">
												<input type="text" class="span6" id="last_name" name="last_name" value="<?php if(isset($results)) echo $results['last_name']; ?>">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->


										<div class="control-group">											
											<label class="control-label" for="email"><?php echo lang('profile_email_address'); ?></label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="email" name="email" value="<?php if(isset($email)) echo $email; ?>" disabled>
												<p class="help-block"><?php echo lang('profile_email_change'); ?></p>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

										</br>

										<div class="control-group">											
											<label class="control-label" for="tel1"><?php echo lang('profile_phone1'); ?></label>
											<div class="controls">
												<input type="text" class="span4" id="tel1" name="tel1" value="<?php if(isset($results)) echo $results['tel1']; ?>">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->


										<div class="control-group">											
											<label class="control-label" for="tel2"><?php echo lang('profile_phone2'); ?></label>
											<div class="controls">
												<input type="text" class="span4" id="tel2" name="tel2" value="<?php if(isset($results)) echo $results['tel2']; ?>">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->


										<br />
										
											
										<div class="form-actions">
											<button type="submit" id="submit" class="btn btn-primary"><?php echo lang('profile_save'); ?></button> 
											
										</div> <!-- /form-actions -->
									</fieldset>
								</form>
								</div>



				</div>/ <!-- /widget content -->
						
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

<script src="js/base.js"></script>

<script type="text/javascript">

		 function setSelectedOptions() {

		   var country = document.getElementById('country');
		   
		   
		   var defaultCountry = "<?php if (isset($results)) { echo $results['country']; }?>";

		   //console.log(country.options.length);
		  

		  

		   for (i = 0; i < country.options.length; i++) {
		    if (country.options[i].value == defaultCountry) {
		     
		     country.options[i].selected = true;

		     break;
		    } 
		   }

		}


         setSelectedOptions();

        </script>

 

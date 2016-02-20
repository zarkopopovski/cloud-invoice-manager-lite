<link href="css/pages/plans.css" rel="stylesheet"> 

    

    
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <?php

        createCustomeMenuForBaseURL(FALSE, 1, 0);

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
								<form action="<?= site_url('customerdashboard/update_products') ?>" method="post" id="edit-profile" class="form-horizontal">
									<fieldset>
										
										<input type="hidden" class="span6" id="id" name="product_id" value="<?php if(isset($results)) echo $results['id']; ?>">								
										
										<div class="form-actions">											
											<label class="control-label" for="name"><?php echo lang('products_product_name'); ?></label>
											<div class="controls">
												<input type="text" class="span6" id="name" name="name" value="<?php if(isset($results)) echo $results['name']; ?>">
											</div> <!-- /controls -->		
											</br>
											<label class="control-label" for="product_code"><?php echo lang('products_product_code'); ?></label>
											<div class="controls">
												<input type="text" class="span6" id="product_code" name="product_code" value="<?php if(isset($results)) echo $results['product_code']; ?>">
											</div> <!-- /controls -->		

										</div> <!-- /control-group -->
										
										
										<div class="form-actions">											
											<label class="control-label" for="description"><?php echo lang('products_product_description'); ?></label>
											<div class="controls">
												<textarea type="text" class="span6" id="description" name="description"><?php if(isset($results)) echo $results['description']; ?></textarea>
											</div> <!-- /controls -->	
											</br>

											<label class="control-label" for="output_price"><?php echo lang('products_product_output_price'); ?></label>
											<div class="controls">
												<input type="text" class="span6" id="output_price" name="output_price" value="<?php if(isset($results)) echo $results['output_price']; ?>"></input>
											</div> <!-- /controls -->	
											</br>
														
											<label class="control-label" for="category"><?php echo lang('products_product_category'); ?></label>
											<div class="controls">
												<!-- <input type="text" class="span6" id="category" name="category"></input> -->
												<select class="spbtn btn-primary dropdown-togglean6" id="category" name="category" value="" >
												  <optgroup label="Category" >

												   <?php


					 								 if (isset($categories) && sizeof($categories) > 0){



					 									 foreach ($categories as $row) {
					 									 	if($row['id'] == $results['category_id']) {

				  												echo  "<option value=". $row['id'] ." selected>". $row['name'] ."</option>";
					 									 	} else {

					 									 		echo  "<option value=". $row['id'] ." >". $row['name'] ."</option>";


					 									 	}


						
												 			}
												 		}
												 	?>
												  </optgroup>
												</select>
											</div> <!-- /controls -->


											</br>

											<label class="control-label" for="tax"><?php echo lang('products_product_tax'); ?></label>
											<div class="controls">
												<input type="text" class="span3" id="tax" name="tax" value="<?php if(isset($results)) echo $results['tax']; ?>"></input>
											</div> <!-- /controls -->	
											</br>

											<label class="control-label" for="unit"><?php echo lang('products_product_unit'); ?></label>
											<div class="controls">
												<select class="spbtn btn-primary dropdown-togglean6" id="unit" name="unit">
												  <optgroup label="Unit">
												   	<option value="kg" <?php if(isset($results) && $results["unit"] == "kg") echo "selected";?>><?php echo lang('unit_kg');?></option>
												   	<option value="g" <?php if(isset($results) && $results["unit"] == "g") echo "selected";?>><?php echo lang('unit_g');?></option>
												   	<option value="l" <?php if(isset($results) && $results["unit"] == "l") echo "selected";?>><?php echo lang('unit_l');?></option>
												   	<option value="m" <?php if(isset($results) && $results["unit"] == "m") echo "selected";?>><?php echo lang('unit_m');?></option>
												   	<option value="cm" <?php if(isset($results) && $results["unit"] == "cm") echo "selected";?>><?php echo lang('unit_cm');?></option>
												   	<option value="mm" <?php if(isset($results) && $results["unit"] == "mm") echo "selected";?>><?php echo lang('unit_mm');?></option>
												   	<option value="h" <?php if(isset($results) && $results["unit"] == "h") echo "selected";?>><?php echo lang('unit_h');?></option>
												   	<option value="m" <?php if(isset($results) && $results["unit"] == "m") echo "selected";?>><?php echo lang('unit_mi');?></option>
												   	<option value="s" <?php if(isset($results) && $results["unit"] == "s") echo "selected";?>><?php echo lang('unit_s');?></option>
												   	<option value="p" <?php if(isset($results) && $results["unit"] == "p") echo "selected";?>><?php echo lang('unit_p');?></option>
												  </optgroup>
												</select>
											</div> <!-- /controls -->	

											<br/>

										</div> <!-- /control-group -->
							
										<div class="form-actions" align="center">
											<button type="submit" id="submit" class="btn btn-primary"><?php echo lang('products_save_product'); ?></button> 
											
											<input type="hidden" name="old_input_price" id="old_input_price" value="<?php if(isset($results)) echo $results['input_price']; ?>" />
											<input type="hidden" name="old_output_price" id="old_output_price" value="<?php if(isset($results)) echo $results['output_price']; ?>" />
											<input type="hidden" name="old_tax" id="old_tax" value="<?php if(isset($results)) echo $results['tax']; ?>" />
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
    
<script type="text/javascript">

</script>


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
<script type="text/javascript">
// jQuery.noConflict();

// $('#input_price').maskMoney();
// $('#output_price').maskMoney();
</script>
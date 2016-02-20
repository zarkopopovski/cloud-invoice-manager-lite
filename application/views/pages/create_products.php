


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
								<form id="add_product" action="<?= site_url('customerdashboard/add_products') ?>" method="post" id="edit-profile" class="form-horizontal">
									<fieldset>
										
										<div class="form-actions">											
											<label class="control-label" for="name"><?php echo lang('products_product_name'); ?></label>
											<div class="controls">
												<input type="text" class="span6" id="name" name="name" >
											</div> <!-- /controls -->	
											</br>
											<label class="control-label" for="product_code"><?php echo lang('products_product_code'); ?></label>
											<div class="controls">
												<input type="text" class="span4" id="product_code" name="product_code" >
											</div> <!-- /controls -->			
										</div> <!-- /control-group -->
										
										
										<div class="form-actions">											
											<label class="control-label" for="description"><?php echo lang('products_product_description'); ?></label>
											<div class="controls">
												<textarea type="text" class="span6" id="description" name="description"></textarea>
											</div> <!-- /controls -->	
											

										</div>


										<div class="form-actions">	
											
											<div id="outputPrice1">
											<label class="control-label" for="output_price"><?php echo lang('products_product_output_price'); ?></label>
											<div class="controls" >
												<input type="text" class="span4" id="output_price" name="output_price"></input>
											</div><!-- /controls -->
											</div>	
											
											
										</div>

										<div class="form-actions">	


											<label class="control-label" for="category"><?php echo lang('products_product_category'); ?></label>
											<div class="controls">
												<!-- <input type="text" class="span6" id="category" name="category"></input> -->
												<select class="spbtn btn-primary dropdown-togglean6" id="category" name="category">
												  <optgroup label="Category">
												   <?php

					 								 if (isset($results) && sizeof($results) > 0){

					 									 foreach ($results as $row) {
						
					  										echo  "<option value=". $row['id'] .">". $row['name'] ."</option>";
												 			}
												 		}
												 	?>
												  </optgroup>
												</select>
											</div> <!-- /controls -->






											</br>

											<label class="control-label" for="tax"><?php echo lang('products_product_tax'); ?></label>
											<div class="controls">
												<input type="text" class="span3" id="tax" name="tax"></input>
											</div> <!-- /controls -->	
											</br>
	
											<label class="control-label" for="unit"><?php echo lang('products_product_unit'); ?></label>
											<div class="controls">
												<select class="spbtn btn-primary dropdown-togglean6" id="unit" name="unit">
												  <optgroup label="Unit">
												   	<option value="kg"><?php echo lang('unit_kg');?></option>
												   	<option value="g"><?php echo lang('unit_g');?></option>
												   	<option value="l"><?php echo lang('unit_l');?></option>
												   	<option value="m"><?php echo lang('unit_m');?></option>
												   	<option value="cm"><?php echo lang('unit_cm');?></option>
												   	<option value="mm"><?php echo lang('unit_mm');?></option>
												   	<option value="h"><?php echo lang('unit_h');?></option>
												   	<option value="m"><?php echo lang('unit_mi');?></option>
												   	<option value="s"><?php echo lang('unit_s');?></option>
												   	<option value="p"><?php echo lang('unit_p');?></option>
												  </optgroup>
												</select>
											</div> <!-- /controls -->	

											<br/>

										</div> <!-- /control-group -->
							
										
																													
											
										<div class="form-actions" align="center">
											<button name="submit_product" id="submit_product" class="btn btn-primary"><?php echo lang('products_save_product'); ?></button> 
											
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

// jQuery.noConflict();

// $('#input_price').maskMoney();
// $('#output_price').maskMoney();

$("#submit_product").click(function(evt){
    evt.preventDefault();

    $("#add_product").submit();

    return false;

});

</script>

 

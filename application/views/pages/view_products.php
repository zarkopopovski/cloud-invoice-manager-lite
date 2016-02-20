


<link href="css/pages/plans.css" rel="stylesheet"> 

    

    
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
     <?php

        createCustomeMenuForBaseURL(FALSE, 1, $permissionMap);

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
                    <th><h4 style="color:#006600;"><?php echo lang('products_product_product1'); ?></h4><h3><?php if(isset($results)) echo $results['name']; ?></h3> </th>
                    <th></th>
                    <th></th>

                    
                    
                  </tr>
                </thead>
                
                <tbody>

					<tr>
					<th><h4 style="color:#006600;"><?php echo lang('products_product_description1'); ?></h4><h4><?php if(isset($results)) echo $results['description']; ?></h4></h4>
					<th><h4 style="color:#006600;"><?php echo lang('products_product_category1'); ?></h4><h4>

						 							<?php
						 								
						 								 if (isset($categories)) {
						 								 	echo $categories["name"];
						 									 
													 	}
												 	?>						


						</h4></h4>
					
					
					</tr>
					<tr>
					<th><h4 style="color:#006600;"><?php echo lang('products_product_output_price1'); ?></h4><h4><?php if(isset($results)) echo $results['output_price']; ?></h4></h4>
					<th></th>
					</tr>
					<tr>	
					<th><h4 style="color:#006600;"><?php echo lang('products_product_tax1'); ?></h4><h4><?php if(isset($results)) echo $results['tax']; ?></h4></th>
					<th><h4 style="color:#006600;"><?php echo lang('products_product_unit1'); ?></h4><h4><?php if(isset($results)) echo $results['unit']; ?></h4></th>
					</tr>

					

					<tr>
					<th></th>
				<th>

				</br>

				<?php
					 
					
						echo"<form action='".site_url('customerdashboard/edit_products')."' method='post' >";

            $productID = "";

            if (isset($results)) {
              $productID = $results['id'];
            }

						echo"	 <input type='hidden' id='id' name='id' size='20' maxlength='40' value='".$productID."'/> ";
    					echo"	 <input type='submit' id='submit' name = 'submit' class='btn btn-primary' value='".lang('products_product_epsd')."' /> 
				 		</form> ";
		
					



				?>

				</th>
					<th></th>
					</tr>
                                 
                </tbody>
              </table>




					

                 
                                 
                </tbody>
              </table>



					</div>
					
					
					
					</div> <!-- /view client -->
								
					</div> 

				</div> <!-- /widget content  INPUT-->

	      		
						
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

 

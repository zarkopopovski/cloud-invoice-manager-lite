


<link href="css/pages/plans.css" rel="stylesheet"> 
<!-- <script src="assets/js/jquery.confirm.js"></script> -->
<link href="<?php echo base_url('assets/css/pages/dashboard.css') ?>" rel="stylesheet" />

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

                <div class="shortcuts" >
                   

                    <?php
                    
                         echo "<div class='btn-group'>
                                <button class='btn'>".lang('products_categories_title')."</button>
                                <button class='btn dropdown-toggle' data-toggle='dropdown'>
                                <span class='caret'></span>
                                </button>
                                <ul class='dropdown-menu'>
                                <li><a href='".site_url('customerdashboard/create_products')."'>".lang('products_new_product')."</a></li>
                                <li><a href='".site_url('customerdashboard/categories')."'>".lang('products_categories')."</a></li>
                                </ul>
                               </div></br>";
                                                
                        
                ?>
                    
                </div>  



                <div class="widget-content">
                <div class="form-horizontal">
            <!-- <p><a href="javascript:void(0);" onclick="fnClickAddRow();">Click to add a new row</a></p> -->
					
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                  <tr>
                    <th width="20%"> <?php echo lang('products_product_name'); ?> </th>
                    <th> <?php echo lang('products_product_code'); ?> </th>
                    <th width="20%"> <?php echo lang('products_product_description'); ?></th>
                    <th> <?php echo lang('products_product_output_price'); ?></th>
                    <th> <?php echo lang('products_product_category'); ?></th>
                    <th> <?php echo lang('products_product_tax'); ?></th>
                    <th> <?php echo lang('products_product_unit'); ?></th>
                    <th> <?php echo lang('products_product_view'); ?></th>
                    <?php
                        if (isset($permissionMap) && $permissionMap["products_manage_products"] == "ENABLE") {
                            echo "<th>".lang('products_product_edit')."</th>";
                            echo "<th>".lang('products_product_delete')."</th>";
                        }
                    ?>
                    
                  </tr>
                </thead>
                
                <tbody>

					<?php

					  if (isset($results) && sizeof($results) > 0){

					  foreach ($results as $row) {
						
					  echo "<tr>";
					  echo "<td align='center'>" . $row['product_name'] . "</td>";
                       echo "<td align='center'>" . $row['product_code'] . "</td>";
					  echo "<td align='center'>" . $row['description'] . "</td>";
                      echo "<td align='center'>" . $row['output_price'] . "</td>";
					  echo "<td align='center'>" . $row['category_name'] . "</td>";
					  echo "<td align='center'>" . $row['tax'] . "%</td>";
					  echo "<td align='center'>" . $row['unit'] . "</td>";
					  echo "<td align='center'><p><a class='btn btn-small btn-primary' href='view_products?id=". $row['id'] . "&cat_id=".$row['category_id']."'>VIEW</a></p></td>";
					  
                      if (isset($permissionMap) && $permissionMap["products_manage_products"] == "ENABLE") {
                        echo "<td align='center'><p><a class='btn btn-small btn-success' href='edit_products?id=". $row['id'] . "'>EDIT</a></p></td>";
					    echo "<td align='center'><p><a class='btn btn-danger btn-small' href='delete_products?id=". $row['id'] . "'  onclick='return runMyFunction(\"". $row['id'] . "\");'>X</a></p></td>";
                      }
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
        
        
        
        if (confirm("Are you sure to delete that product?") == true) {


             $.post("<?php echo base_url();?>index.php/customerdashboard/check_products",
                {"product_id":id}).done(function(data) {
                    if (data) {
                        
                        var productsJSON = JSON.parse(data);
                                                
                        if (productsJSON.status == 'valid') {
                            alert("DELETE ERROR:Product exist");
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


 

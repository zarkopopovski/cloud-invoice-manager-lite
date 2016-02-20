


<link href="css/pages/plans.css" rel="stylesheet"> 
<script src="<?php echo base_url('assets/js/jquery.datetimepicker.js') ?>"></script>

<link href="<?php echo base_url('assets/css/jquery.datetimepicker.css') ?>" rel="stylesheet" />

<script type="text/javascript" charset="utf-8">
			/* Global var for counter */
			var productsJSON = null;
			var invoicesProducts = [];
			var clientId = null;
			var invoiceSum = 0;
			var taxSum = 0;
			var subTotal = 0;
			var isInventoryUsed = false;
			var usedInventoryID = null;
			
		</script>

    

    
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
     <?php

        createCustomeMenuForBaseURL(FALSE, 3, 0);

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
								<div id="edit-profile" class="form-horizontal">
									<fieldset>
										
																			
										
										<div class="form-actions">											
											<label class="control-label" for="invoice_number"><?php echo lang('invoices_output_invoice_number'); ?></label>
											
											<div class="controls">
												<input type="text" class="span2" id="invoice_number" name="invoice_number" value="<?php if(isset($formatted_invoice_number)) echo $formatted_invoice_number;?>" disabled>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										<table> <!-- tablea za clinet i prikazuvanje na klient -->

										<tr>

										<td>

										<div class="form-actions">											
											

											<label class="control-label" for="due_date"><?php echo lang('invoices_due_date'); ?></label>
											<div class="controls">
												

												<input type="text" class="span2" id="due_date" name="due_date" value=""></input>	
												
														
													

											</div> <!-- /controls -->	
											</br>
											
											<label class="control-label" for="client"><?php echo lang('invoices_client'); ?></label>
											<div class="controls">


											<select class="spbtn btn-primary dropdown-togglean6" id="client" name="client" value="">
												  <optgroup label="client">
												   <?php

												   		echo  "<option value=''> Select Client</option>";

					 								 if (isset($clients) && sizeof($clients) > 0){



					 									 foreach ($clients as $row) {
						
					  										echo  "<option value=". $row['id'] .">". $row['name'] ."</option>";
												 			}
												 		}
												 	?>
												  </optgroup>
											</select>	
											</br>

											</div>

											</br>

										</div> <!-- /controls -->



										</td>
										
										<td>

										<div class="" >											
											

										<label class="control-label" for=""><?php echo lang('invoices_address'); ?></label>
											
											<div class="controls">
											
											<text type="text" class="span2" id="client_address" name="client_address"></text>	
											
											</div> <!-- /controls -->	
											</br>

										<label class="control-label" for="client_city"><?php echo lang('invoices_city'); ?></label>
											
											<div class="controls">
											
											<text type="text" class="span2" id="client_city" name="client_city"></text>	
											
											</div> <!-- /controls -->	
											</br>	

										<label class="control-label" for="client_country"><?php echo lang('invoices_country'); ?></label>
											
											<div class="controls">
											
											<text type="text" class="span2" id="client_country" name="client_country"></text>	
											
											</div> <!-- /controls -->	
											</br>

										</div> <!-- /controls -->



										</td>

										</tr>
										</table>

										
										<button id="show_products"  class="btn btn-primary"><?php echo lang('invoices_click_to_add_products'); ?></button>
										
										</br>

										<div > <!-- TABLE FOR PRODUCTS -->
										</br>
											<div id="products1">	
												<div id="products_table"> 

												</div>
												

									              </br>
									              <button id="add" style="display:none" class="btn btn-primary"><?php echo lang('invoices_add_products'); ?></button>



											
											<!-- <label class="control-label">Select Products</label>
											
                                            
                                            <div class="controls">
                                            <label class="checkbox inline">
                                              <input type="checkbox"> Option 01
                                            </label>
                                            
                                            <label class="checkbox inline">
                                              <input type="checkbox"> Option 02
                                            </label>
											</div>
 -->
											

											</div>



										</div>
										</br>

<div >

										<div id="preview_products"> 

										<table cellpadding="0" cellspacing="0" border="0" class="display" id="example1">
									                <thead>
									                  <tr>
									                   <th> <?php echo lang('products_product_code'); ?></th>
									                    <th> <?php echo lang('products_product_name'); ?></th>
									                    <th> <?php echo lang('products_product_description'); ?></th>
									                    <th> <?php echo lang('invoices_quantity'); ?></th>
									                    <th> <?php echo lang('expense_price'); ?></th>
									                    <th> <?php echo lang('invoices_tax_%'); ?></th>
									                    <th> <?php echo lang('invoices_discount_%'); ?></th>
									                    <th> <?php echo lang('invoices_sum'); ?></th>
									                    <th> <?php echo lang('invoices_tax'); ?></th>
									                    <th> <?php echo lang('invoices_line_total'); ?></th>
									                    <th> <?php echo lang('expense_delete'); ?></th>
									                    
									                  </tr>
									                </thead>
									                
									                <tbody>

									                	

														<!-- //   if (isset($results) && sizeof($results) > 0){

														//   foreach ($results as $row) {
															
														//   echo "<tr>";
														//   echo "<td>" . $row['products'] . "</td>";
														//   echo "<td>" . $row['quantity'] . "</td>";
														//   echo "<td>" . $row['price'] . "</td>";
														//   echo "<td>" . $row['discount'] . "</td>";
														//   echo "<td>" . $row['sum'] . "%</td>";
														//   echo "</tr>";

														  
														//   }

														// } -->

														

									                                 
									                </tbody>

									             </table>

									             </br>
									             <div>
									             <hr size="4" noshade>
									             <table align="right">

									             <th><p><b><?php echo lang('invoices_subtotal'); ?>&nbsp;&nbsp;</p></th>
									             <th><p id="sub_total">0</p></th>
									             <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>

									             <th><p><b><?php echo lang('invoices_gst'); ?>&nbsp;&nbsp;</p></th>
									             <th><p id="taxsum">0</p></th>
									             <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>

									             <th><p><b><?php echo lang('invoices_total1'); ?>&nbsp;&nbsp;</p></th>
									             <th><p id="invoice_sum">0</p></th>
									             <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
									              

									             </table>
									             </div>
									             </br>


									             </div>

									             </div>


									    <div class="form-actions" >											
										<label class="control-label" for="comment"><?php echo lang('invoices_comment'); ?></label>
										<div class="controls" align="right">
											<textarea type="text" class="span8" id="comment" name="comment"></textarea>
										</div> <!-- /controls -->				
										</div> <!-- /control-group -->

									
											
										<div class="form-actions" align="center">
											<button  id="save_invoice" class="btn btn-primary"><?php echo lang('invoices_save_invoice'); ?></button> 
											
										</div> <!-- /form-actions -->
									</fieldset>
								</div>
								</div>

				
						
				</div> 

				</div>
				</div>				
				


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

$("#show_products").click(function(){

	if (productsJSON != null) {

		$('#example').dataTable();

		$("#example").show();
		    $("#products1").show();
		    $('#show_products').hide();
		    $('#add').show();

	}

	    return false;
});

$('#products1').hide();
$('#add').hide();

function drawProductsTable() {

	$('#products_table').empty();

	var tableData = '<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">' +
	'<thead> <tr> <th>Select</th><th>Product Code</th><th>Product Name</th><th> Description</th><th> Quantity</th><th> Discount</th><th> Price</th><th> Tax</th><th> Unit</th></tr></thead><tbody>';

	for (i = 0; i < productsJSON.length; i++) {

		var productObject = productsJSON[i];

		if(productObject.output_price != 0) {

		tableData += '<tr id="product">' +
			'<td><label><input type="checkbox" value="'+productObject.id+'" id="check" ></label></td>' +
			'<td>'+productObject.product_code+'</td>' +
			'<td>'+productObject.product_name+'</td>' +
			'<td>'+productObject.description+'</td>' +
			'<td><input type="text" class="span1" id="input_'+productObject.id+'" name="quantity"></input>' +
			'<td><input type="text" class="span1" id="discount_'+productObject.id+'" name="discount"></input>' +
			'<td>'+productObject.output_price+'</td>' +
			'<td>'+productObject.tax+'</td>' +
			'<td>'+productObject.unit+'</td>' +
			'</tr>';

		}

	}

	tableData += '</tbody> </table>';
	$('#products_table').html(tableData);
}

$('#active_inventory').change(function(){
	inventoryId = this.value;

	usedInventoryID = inventoryId;

	if (!isInventoryUsed) {

		$.post("<?php echo base_url();?>index.php/customerdashboard/get_inventory_products_data",
		{"inventory_id":inventoryId}).done(function(data) {

			if (data) {
				productsJSON = JSON.parse(data);

				$('#products_table').empty();
				console.log(productsJSON);

				var tableData = '<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" >' +
				'<thead> <tr> <th>Select</th><th>Product Code</th><th>Product Name</th><th> Description</th><th> Quantity</th><th> <?php echo lang("product_active_quantity");?></th><th> Discount</th><th> Price</th><th> Tax</th><th> Unit</th></tr></thead><tbody>';
			
				for (i = 0; i < productsJSON.length; i++) {

					var productObject = productsJSON[i];

						if(productObject.output_price != 0) {

						tableData += '<tr id="product">' +
							'<td><label><input type="checkbox" value="'+productObject.id+'" id="check" ></label></td>' +
							'<td>'+productObject.product_code+'</td>' +
							'<td>'+productObject.product_name+'</td>' +
							'<td>'+productObject.description+'</td>' +
							'<td><input type="text" class="span1" id="input_'+productObject.id+'" name="quantity"></input>' +
							'<td>'+productObject.quantity+'</td>' +
							'<td><input type="text" class="span1" id="discount_'+productObject.id+'" name="discount"></input>' +
							'<td>'+productObject.output_price+'</td>' +
							'<td>'+productObject.tax+'</td>' +
							'<td>'+productObject.unit+'</td>' +
							'</tr>';

						}

				}

				tableData += '</tbody> </table>';
				$('#products_table').html(tableData);

				//console.log(tableData);

			}
		  },"json");

	} else {
		alert("Inventory is already selected. You cant add products from different inventories in same document.");

		$('#active_inventory option[value="'+usedInventoryID+'"]').prop('selected', 'selected');
	}

});



$("#add").click(function(){
	    $("#products1").hide();	
	    $('#add').hide();
	    $('#show_products').show();



   $('input[type="checkbox"]:checked').each(function(){
    	var inputId = $(this).val();

    	var quantity = $('#input_'+inputId).val();
    	var discount = $('#discount_'+inputId).val();

    	var objectExist = false;

    	isInventoryUsed = true;

    	if (invoicesProducts && invoicesProducts.length > 0) {
    		
        	for (var i =0; i < invoicesProducts.length; i++) {

        		var objectInInv = invoicesProducts[i];

        		if (objectInInv.product.id == inputId) {

        			objectExist = true;
        			break;

        		};

        	}

    	};

    	if (!objectExist) {
    		 
    	for (i = 0; i < productsJSON.length; i++) {

			var productObject = productsJSON[i];

			if(productObject.id == inputId) {

				var tax = productObject.tax;

				var sumBasic = (productObject.output_price * quantity);
				var discountPrice = sumBasic / 100 * discount;
				var sumAll = sumBasic - discountPrice;
				var taxPrice = sumAll / 100 * tax;
				var lineTotal = sumAll + taxPrice;

				invoiceSum+=lineTotal;
				taxSum+=taxPrice;
				subTotal += sumAll;


				invoicesProducts.push({
								product:productObject,
								originalQuantity:productObject.quantity,
								quantity:quantity, 
								discount:discount, 
								sumAll:sumAll, 
								tax:tax});

				var tableData = '<tr id="product_'+productObject.id+'">' +
					'<td align="center">'+productObject.product_code+'</td>' +
					'<td align="center">'+productObject.product_name+'</td>' +
					'<td>'+productObject.description+'</td>' +
					'<td align="center"><input type="text" class="span1" id="quantityNew_'+productObject.id+'" data="'+productObject.id+'" tax="'+productObject.tax+'" price="'+productObject.output_price+'" value="'+quantity+'"></input></td>' +
					'<td align="center">'+productObject.output_price+'</td>' +
					'<td align="center">'+productObject.tax+'</td>' +
					'<td align="center"><input type="text" class="span1" id="discountNew_'+productObject.id+'" discount="'+productObject.id+'" tax="'+productObject.tax+'" name="discount" price="'+productObject.output_price+'" value="'+discount+'"></input></td>' +
					'<td align="center"><p id="sumall_'+productObject.id+'">'+Math.round(sumAll)+'</p></td>' +
					'<td align="center"><p id="taxprice_'+productObject.id+'">'+Math.round(taxPrice)+'</p></td>' +
					'<td align="center"><p id="linetotal_'+productObject.id+'">'+Math.round(lineTotal)+'</p></td>' +
					'<td align="center"><p class="btn btn-danger btn-small" id="delete_'+productObject.id+'" value="'+productObject.id+'">x</p></td>' +
					'</tr>';
				
				$('#preview_products > table ').append(tableData);
				

				$(this).attr('checked', false);

				$('#input_'+inputId).val("");
				$('#discount_'+inputId).val("");



				$("#delete_"+productObject.id).click(function(){

					var id = $(this).attr("value"); 
					var suma = $('#linetotal_'+id).text();
					var subtotalsum = $('#sumall_'+id).text();
					
					invoiceSum -= suma;
					taxSum-=taxPrice;
					subTotal-= subtotalsum;
					
					
					$('#taxsum').html("<span>"+Math.round(taxSum)+"</span>");
					$('#invoice_sum').html("<span>"+Math.round(invoiceSum)+"</span>");
					$('#sub_total').html("<span>"+Math.round(subTotal)+"</span>");

					$("#product_"+id).remove();

					for (var idx = 0; idx < invoicesProducts.length; idx++) {
						var invoiceProduct = invoicesProducts[idx];
						if (invoiceProduct.product.id == id) {
							invoicesProducts.splice(idx, 1);
						};

					}

				});	

				$('#quantityNew_'+productObject.id).change(function () {

					var newQuantity = $(this).val();
					var invoiceProductID = $(this).attr("data");
					var newPrice = $(this).attr("price");
					var tax1 = $(this).attr("tax");

					

					for (var i = 0; i < invoicesProducts.length; i++) {
						
						if (invoicesProducts[i].product.id == invoiceProductID) {

							var quantityD = 0;
							var sumBasic1 = 0;
							var discountPrice1 = 0;
							var sumAll1 = 0;
							var sumallNew = 0;
							var lineTotal1 = 0;
							var taxPrice1 = 0;
							var taxPrice0 = 0;


																	
							if (newQuantity > invoicesProducts[i].quantity) {

								quantityD = newQuantity - invoicesProducts[i].quantity;

								sumBasic1 = (newPrice * quantityD);
								discountPrice1 = sumBasic1 / 100 * invoicesProducts[i].discount;
								sumAll1 = sumBasic1 - discountPrice1;
								taxPrice = sumAll1 / 100 * tax1;	
								var sumAll2 = sumAll1 + taxPrice;


								var sumBasic2 = (newPrice * newQuantity);
								var discountPrice2 = sumBasic2 / 100 * invoicesProducts[i].discount;																					
								sumallNew = sumBasic2 - discountPrice2;											
								taxPrice1 = sumallNew / 100 * tax1;	



								lineTotal1 = sumallNew + taxPrice1;
								lineTotalOld = sumAll1 + taxPrice;




								var taxPriceNew = taxPrice1 - taxPrice;
								var finalTotal = lineTotal1 - lineTotalOld;
								
								invoiceSum+=sumAll2;
								subTotal += sumAll1;
								taxSum+=taxPrice;

								invoicesProducts[i].quantity = newQuantity;

								$('#sumall_'+invoiceProductID).html("<span>"+Math.round(sumallNew)+"</span>");
								$('#linetotal_'+invoiceProductID).html("<span>"+Math.round(lineTotal1)+"</span>");
								$('#taxprice_'+invoiceProductID).html("<span>"+Math.round(taxPrice1)+"</span>");
								$('#taxsum').html("<span>"+taxSum+"</span>");

								$('#invoice_sum').html("<span>"+Math.round(invoiceSum)+"</span>");
								 $('#sub_total').html("<span>"+Math.round(subTotal)+"</span>");


								

							} else {

								if (newQuantity > 0) {

									quantityD = invoicesProducts[i].quantity - newQuantity;

									sumBasic1 = (newPrice * quantityD);
									discountPrice1 = sumBasic1 / 100 * invoicesProducts[i].discount;
									sumAll1 = sumBasic1 - discountPrice1;
									taxPrice = sumAll1 / 100 * tax1;	
									var sumAll2 = sumAll1 + taxPrice;

									
									var sumBasic2 = (newPrice * newQuantity);
									var discountPrice2 = sumBasic2 / 100 * invoicesProducts[i].discount;
									sumallNew = sumBasic2 - discountPrice2;
									taxPrice1 = sumallNew / 100 * tax1;	

									lineTotal1 = sumallNew + taxPrice1;
									lineTotalOld = sumAll1 + taxPrice;

									var taxPriceNew = taxPrice - taxPrice1
									var finalTotal = lineTotalOld - lineTotal1;

									invoiceSum-=sumAll2;
									subTotal -= sumAll1;
									taxSum-=taxPrice;

									
									invoicesProducts[i].quantity = newQuantity;

									$('#sumall_'+invoiceProductID).html("<span>"+Math.round(sumallNew)+"</span>");
									$('#linetotal_'+invoiceProductID).html("<span>"+Math.round(lineTotal1)+"</span>");
									$('#taxprice_'+invoiceProductID).html("<span>"+Math.round(taxPrice1)+"</span>");
									$('#taxsum').html("<span>"+taxSum+"</span>");

									$('#invoice_sum').html("<span>"+Math.round(invoiceSum)+"</span>");
									 $('#sub_total').html("<span>"+Math.round(subTotal)+"</span>");
									
									

								} else {

									quantityD = invoicesProducts[i].quantity - newQuantity;

									sumBasic1 = (newPrice * quantityD);
									discountPrice1 = sumBasic1 / 100 * invoicesProducts[i].discount;
									sumAll1 = sumBasic1 - discountPrice1;
									invoiceSum-=sumAll1;
									subTotal -= sumAll1;
									taxPrice = 0;
									sumAllNew = 0;
									lineTotal1 = 0;

									invoicesProducts[i].quantity = newQuantity;

									$('#sumall_'+invoiceProductID).html("<span>"+Math.round(sumallNew)+"</span>");
									$('#linetotal_'+invoiceProductID).html("<span>"+Math.round(lineTotal1)+"</span>");
									$('#taxprice_'+invoiceProductID).html("<span>"+Math.round(taxPrice)+"</span>");
									$('#taxsum').html("<span>"+Math.round(taxSum)+"</span>");

									$('#invoice_sum').html("<span>"+Math.round(invoiceSum)+"</span>");
									$('#sub_total').html("<span>"+Math.round(subTotal)+"</span>");

								}

							}

							
							

							break;

						}

					};


				});

				$('#discountNew_'+productObject.id).change(function () {

					var newDiscount = $(this).val();
					var invoiceProductID = $(this).attr("discount");
					var newPrice = $(this).attr("price");
					var tax1 = $(this).attr("tax");



					for (var i = 0; i < invoicesProducts.length; i++) {
						
						if (invoicesProducts[i].product.id == invoiceProductID) {

							var discountD = 0;
							var sumBasic1 = 0;
							var discountPrice1 = 0;
							var sumAll1 = 0;
							var sumAllNew = 0;
							var lineTotal1 = 0;
							var taxPrice1 = 0;
							var taxPrice0 = 0;


							
							if (newDiscount > invoicesProducts[i].discount) {

								discountD = invoicesProducts[i].discount;											
								sumBasic1 = (newPrice * invoicesProducts[i].quantity);											
								discountPrice1 = sumBasic1 / 100 * discountD;
								sumAll1 = sumBasic1 - discountPrice1;

								

								var discountPrice2 = sumBasic1 / 100 * newDiscount;
								sumAllNew = sumBasic1 - discountPrice2;
								

								taxPrice1 = sumAll1 / 100 * tax1;
								taxPrice = sumAllNew / 100 * tax1;		
								
								var taxPriceNew = taxPrice - taxPrice1

								lineTotal1 = sumAllNew + taxPrice;
								var lineTotalOld = sumAll1 + taxPrice1;
								
								taxSum+=taxPriceNew;

								var finalTotal = lineTotal1 - lineTotalOld;


								var finalSum = sumAll1 - sumAllNew;

								

								invoiceSum+=finalTotal;
								subTotal-=finalSum;
								//taxSum-=taxPrice;


								invoicesProducts[i].discount = newDiscount;
								

								$('#sumall_'+invoiceProductID).html("<span>"+Math.round(sumAllNew)+"</span>");
								$('#sub_total').html("<span>"+Math.round(subTotal)+"</span>");
								$('#invoice_sum').html("<span>"+Math.round(invoiceSum)+"</span>");
								$('#taxprice_'+invoiceProductID).html("<span>"+Math.round(taxPrice)+"</span>");
								$('#taxsum').html("<span>"+Math.round(taxSum)+"</span>");
								$('#linetotal_'+invoiceProductID).html("<span>"+Math.round(lineTotal1)+"</span>");

								break;

							} else {

								if (invoicesProducts[i].discount > newDiscount) {

									discountD = invoicesProducts[i].discount
									sumBasic1 = (newPrice * invoicesProducts[i].quantity);
									discountPrice1 = sumBasic1 / 100 * discountD;
									sumAll1 = sumBasic1 - discountPrice1;
																				
									

									var discountPrice2 = sumBasic1 / 100 * newDiscount;
									sumAllNew = sumBasic1 - discountPrice2;

									taxPrice1 = sumAll1 / 100 * tax1;
									taxPrice = sumAllNew / 100 * tax1;		
									
									var taxPriceNew = taxPrice1 - taxPrice

									lineTotal1 = sumAllNew + taxPrice;	
									var lineTotalOld = sumAll1 + taxPrice1;
								
									taxSum-=taxPriceNew;

									var finalTotal = lineTotal1 - lineTotalOld;


									var finalSum = sumAll1 - sumAllNew;

									

									invoiceSum+=finalTotal;
									subTotal-=finalSum;
									//taxSum-=taxPrice;



									invoicesProducts[i].discount = newDiscount;
									

									$('#sumall_'+invoiceProductID).html("<span>"+Math.round(sumAllNew)+"</span>");
									$('#sub_total').html("<span>"+Math.round(subTotal)+"</span>");
									$('#invoice_sum').html("<span>"+Math.round(invoiceSum)+"</span>");
									$('#taxprice_'+invoiceProductID).html("<span>"+Math.round(taxPrice)+"</span>");
									$('#taxsum').html("<span>"+Math.round(taxSum)+"</span>");
									$('#linetotal_'+invoiceProductID).html("<span>"+Math.round(lineTotal1)+"</span>");

									break;

								} else {

									if (newDiscount == 0) {

										discountD = invoicesProducts[i].discount - newDiscount
										invoicesProducts[i].tax = tax1;

										sumBasic1 = (newPrice * quantity);
										discountPrice1 = sumBasic1 / 100 * 0;
										sumall1 = sumBasic1;
										subTotal-=sumBasic1;
										invoiceSum-=sumBasic1;
										sumAllNew = sumBasic1;


										
										invoicesProducts[i].discount = newDiscount;

										$('#sumall_'+invoiceProductID).html("<span>"+Math.round(sumAllNew)+"</span>");
										$('#sub_total').html("<span>"+Math.round(subTotal)+"</span>");
										$('#invoice_sum').html("<span>"+Math.round(invoiceSum)+"</span>");
										$('#taxprice_'+invoiceProductID).html("<span>"+Math.round(taxPrice)+"</span>");
										$('#taxsum').html("<span>"+Math.round(taxSum)+"</span>");
										$('#linetotal_'+invoiceProductID).html("<span>"+Math.round(lineTotal1)+"</span>");

										break;
									}

								}

							}


							break;

						}

					};


				});


				break;
			
			}	



	    }

	    } else {
			alert("Product already exists");
		}

	    $('#taxsum').html("<span>"+Math.round(taxSum)+"</span>");
	    $('#sub_total').html("<span>"+Math.round(subTotal)+"</span>");

	    $('#invoice_sum').html("<span>"+Math.round(invoiceSum)+"</span>");


    });


	    return false;

    });


</script>

<script type="text/javascript">
	//drawProductsTable();
	function loadProductsInTable() {
		$('#products_table').empty();

		productsJSON = <?php if (isset($products_json)) {echo $products_json;};?>;

		console.log(productsJSON);

		var tableData = '<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" >' +
		'<thead> <tr> <th>Select</th><th>Product Code</th><th>Product Name</th><th> Description</th><th> Quantity</th><th> Discount</th><th> Price</th><th> Tax</th><th> Unit</th></tr></thead><tbody>';

		for (i = 0; i < productsJSON.length; i++) {

			var productObject = productsJSON[i];

				if(productObject.output_price != 0) {

				tableData += '<tr id="product">' +
					'<td width="5%"><label><input type="checkbox" value="'+productObject.id+'" id="check" ></label></td>' +
					'<td>'+productObject.product_code+'</td>' +
					'<td>'+productObject.product_name+'</td>' +
					'<td>'+productObject.description+'</td>' +
					'<td><input type="text" class="span1" id="input_'+productObject.id+'" name="quantity"></input>' +
					'<td><input type="text" class="span1" id="discount_'+productObject.id+'" name="discount"></input>' +
					'<td>'+productObject.output_price+'</td>' +
					'<td>'+productObject.tax+'</td>' +
					'<td>'+productObject.unit+'</td>' +
					'</tr>';

				}

		}

		tableData += '</tbody> </table>';
		$('#products_table').html(tableData);
	}
			loadProductsInTable();
			$('#client').change(function () {
				clientId = this.value;

		        $.post("<?php echo base_url();?>index.php/customerdashboard/get_client_data",
				{"clientId":clientId}).done(function(data) {
					if (data) {
						var objectsData = JSON.parse(data);

						$("#client_address").text(objectsData.address);
						$("#client_city").text(objectsData.city);
						$("#client_country").text(objectsData.country);
					}
				  },"json");
		       
			});


			$('#due_date').datetimepicker({
					 lang:'de',
					 i18n:{
					  de:{
					   months:[
					    'Januar','Februar','März','April',
					    'Mai','Juni','Juli','August',
					    'September','Oktober','November','Dezember',
					   ],
					   dayOfWeek:[
					    "So.", "Mo", "Di", "Mi", 
					    "Do", "Fr", "Sa.",
					   ]
					  }
					 },
					 timepicker:false,
					 format:'Y-m-d'
			});


			$("#save_invoice").click(function(){
	   		   
	   		   var invoiceNumber = '<?php if(isset($formatted_invoice_number)) echo $formatted_invoice_number;?>';
	   		   var dueDate = $('#due_date').val();
	   		   var invoice_sum = Math.round(invoiceSum);
	   		   var invoice_tax_sum = Math.round(taxSum);
	   		   var invoice_subtotal = Math.round(subTotal);
	   		   var comment = $('#comment').val();
	   		   var invoice_type = "OUTPUT";
	   		   var inventoryID = 0;
	   		  
	   		   
	   		   $.post("<?php echo base_url();?>index.php/customerdashboard/save_invoice",
				{
					"clientId":clientId, 
					"invoicesProducts":invoicesProducts, 
					"invoiceNumber":invoiceNumber, 
					"dueDate":dueDate, 
					"invoice_sum":invoice_sum, 
					"invoice_tax_sum":invoice_tax_sum, 
					"invoice_subtotal":invoice_subtotal, 
					"comment":comment, 
					"invoice_type":invoice_type,
					"shop_id":"",
					"note_for":"",
					"inventory_id":inventoryID
				}).done(function(data) {
					if (data) {

						var objectsData = data;

						if (!objectsData.ERROR) {
							alert(objectsData.MESSAGE);
							window.location.href = "<?php echo base_url();?>index.php/customerdashboard/invoices";
						} else {
							alert(objectsData.MESSAGE);
						}

						
					}
				  },"json");

			});
</script>
<script src="js/base.js"></script>



		
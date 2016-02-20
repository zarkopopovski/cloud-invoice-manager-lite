


<link href="css/pages/plans.css" rel="stylesheet"> 
<script src="<?php echo base_url('assets/js/jquery.datetimepicker.js') ?>"></script>

<link href="<?php echo base_url('assets/css/jquery.datetimepicker.css') ?>" rel="stylesheet" />

<script type="text/javascript" charset="utf-8">
			/* Global var for counter */
			var productsJSON = <?php echo json_encode($results);?>;
			var invoiceProductsJSON = <?php echo json_encode($products); ?>;
			var invoiceJSON = <?php echo json_encode($invoice); ?>;
			var invoicesProducts = [];
			var invoicesProductsOld = [];
			var invoiceTax = [];
			var clientId = null;
			var invoiceSum = 0;
			var taxSum = 0;
			var subTotal = 0;
			//var invoiceNum = invoiceJSON.invoice_number;
			var invoiceNum = '<?php echo $formatted_invoice_number; ?>';
			var invoiceClient = invoiceJSON.name;
			var invoice_due_date = invoiceJSON.due_date;
			var invoiceID1 = invoiceJSON.id;
			var comment = invoiceJSON.comment;

			$(document).ready(function() {
				
				$('#invoice_number').val(invoiceNum);
				$('#client').val(invoiceClient);
				$('#due_date').val(invoice_due_date);
				$('#comment').text(comment);

				clientId =invoiceJSON.clients_id;

		        $.post("<?php echo base_url();?>index.php/customerdashboard/get_client_data",
				{"clientId":clientId}).done(function(data) {
					if (data) {
						
						var objectsData = JSON.parse(data);

						$("#client_address").text(objectsData.address);
						$("#client_city").text(objectsData.city);
						$("#client_country").text(objectsData.country);
						
					}
				  },"json");


				var tableData = '<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">' +
				'<thead> <tr> <th> Product Code</th><th> Product Name</th><th> Quantity</th> <th> Price</th> <th> Tax %</th> <th> Discount %</th> <th> SUM</th> <th> Tax</th> <th> Line Total</th></tr></thead><tbody>';
			


	   		     for (i = 0; i < invoiceProductsJSON.length; i++) {

						var productObject = invoiceProductsJSON[i];
						var quantity = productObject.quantity;
						var discount = productObject.discount;
						var tax = productObject.tax;
						var sumBasic = (productObject.output_price * productObject.quantity);
						var discountPrice = sumBasic / 100 * productObject.discount;
						var sumAll = sumBasic - discountPrice;
						
						var taxPrice = sumAll / 100 * tax;
						var lineTotal = sumAll + taxPrice;

						var taxDiferent = 0;
						var taxSumDiferent = 0;

						invoiceSum+=lineTotal;
						taxSum+=taxPrice;
						subTotal += sumAll;

						
						

						if (invoiceTax.length == 0) {

							invoiceTax.push({taxDifferent:productObject.tax, taxSumDifferent:taxPrice });							

						} else {

							for (var j = 0; j < invoiceTax.length; j++) {
								if (invoiceTax[j].taxDifferent == productObject.tax) {
									invoiceTax[j].taxSumDifferent+=taxPrice;									
								} else {
									invoiceTax.push({taxDifferent:productObject.tax, taxSumDifferent:taxPrice });
									break;
								}
							};

						} 

						
						tableData += '<tr id="product_'+productObject.id+'">' +
								'<td align="center">'+productObject.product_code+'</td>' +
								'<td align="center">'+productObject.name+'</td>' +
								'<td align="center">'+productObject.quantity+'</td>' +
								'<td align="center">'+productObject.output_price+'</td>' +
								'<td align="center">'+productObject.tax+'</td>' +
								'<td align="center">'+productObject.discount+'</td>' +
								'<td align="center"><p id="sumall_'+productObject.id+'">'+Math.round(sumAll)+'</p></td>' +
								'<td align="center"><p id="taxprice_'+productObject.id+'">'+Math.round(taxPrice)+'</p></td>' +
								'<td align="center"><p id="linetotal_'+productObject.id+'">'+Math.round(lineTotal)+'</p></td>' +
								'</tr>';
																	
										
					}

					tableData += '</tbody> </table>';

					$('#preview_products').html(tableData);
					$('#example').dataTable();



					$('#taxsum').html("<span>"+Math.round(taxSum)+"</span>");
				    $('#sub_total').html("<span>"+Math.round(subTotal)+"</span>");

				    $('#invoice_sum').html("<span>"+Math.round(invoiceSum)+"</span>");

				    console.log(invoiceTax);



				    var tableData1 =  '<hr size="4" noshade><table align="right">';


				    for (var g = 0; g < invoiceTax.length; g++) {
				    	

				    	tableData1 += '<tr>' +
				    				  '<th><p><b>tax '+invoiceTax[g].taxDifferent+'%:&nbsp;&nbsp;</p></th>' +
							          '<th><p id="sub_total">'+Math.round(invoiceTax[g].taxSumDifferent)+'&nbsp;&nbsp;</p></th>' +
							          '</tr>';
							          

							             }; 

					tableData1+= '</table>';
					$('#preview_tax').html(tableData1);

					var showErrorAlert = "<?php if (isset($errormsg)) echo $errormsg; else echo "0";?>";
 
					if (showErrorAlert != 0) {
					  alert(showErrorAlert);
					}

			});	
				
			
			
			
			
		</script>

    

    
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <?php

        createCustomeMenuForBaseURL(FALSE, 3, $permissionMap);

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

	      		<a href='<?= site_url('documentsservice/print_invoice_in_pdf?invoice_id='.$invoice_id) ?>' class="btn btn-primary" ><?php echo lang('invoices_as_pdf'); ?></a>
	      		<a href='#' class="btn btn-primary btn-lg" id="modal_email_form" data-invoice="<?php echo $invoice_id; ?>" data-toggle="modal" data-target="#email_form"><?php echo lang('invoices_to_mail'); ?></a>
	      		<br/><br/>

				<!-- Modal -->
				<div class="modal fade" id="email_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title" id="myModalLabel"><?php echo lang('requests_client_modal_title'); ?></h4>
				      </div>
				      <div class="modal-body">
				        <div>											
							<label class="control-label" for="email_address"><?php echo lang('requests_client_modal_email_address'); ?></label>
							<div class="controls">
								<input type="text" class="span3" id="email_address" name="email_address">
							</div> <!-- /controls -->				
							<label class="control-label" for="email_subject"><?php echo lang('requests_client_modal_subject_message'); ?></label>
							<div class="controls">
								<input type="text" class="span6" id="email_subject" name="email_subject">
							</div> <!-- /controls -->	
							<label class="control-label" for="email_body"><?php echo lang('requests_client_modal_body'); ?></label>
							<div class="controls">
								<textarea id="email_body" name="email_body" class="span6"></textarea>
							</div> <!-- /controls -->				
						</div>
				      </div>

				      <div class="modal-footer">
				      	<img src="<?php echo base_url('assets/img/ajax-loader.gif') ?>" id="ajax-loader" style="display:none"/>
				        <button type="button" class="btn btn-default" id="close_modal" data-dismiss="modal"><?php echo lang('requests_client_modal_button_close'); ?></button>
				        <button type="button" class="btn btn-primary" id="mail_to_client" data-invoice="<?php echo $invoice_id; ?>"><?php echo lang('requests_client_modal_button_send_email'); ?></button>
				      </div>
				    </div>
				  </div>
				</div>
	      		<div class="widget-content">
						
					<div class="tab-pane" id="formcontrols">
								<div id="edit-profile" class="form-horizontal">
									<fieldset>
										
																			
										
										<div class="form-actions">											
											<label class="control-label" for="invoice_number"><?php echo lang('invoices_new_output_invoice'); ?></label>
											<div class="controls">
												<input type="text" class="span2 disabled" id="invoice_number" name="invoice_number" value="" disabled>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										<table> <!-- tablea za clinet i prikazuvanje na klient -->

										<tr>

										<td>

										<div class="form-actions">											
											

											<label class="control-label" for="client"><?php echo lang('invoices_client'); ?></label>
											<div class="controls">

											<input type="text" class="span2 disabled" id="client" name="client" value="" disabled>
						
											
											</br>

											</div>

											</br>

												

											<label class="control-label" for="due_date"><?php echo lang('invoices_due_date'); ?></label>
											<div class="controls">
												

												<input type="text" class="span2 disabled" id="due_date" name="due_date" value="" disabled></input>	
												
														
													

											</div> <!-- /controls -->	
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

										</table>

										<div > <!-- TABLE FOR PRODUCTS -->
										</br>
											

										<div id="preview_products"> 

										</div>

										<div > 
										
										

							             </br>
							             				             

							             </div>
							             </br>

							             <div id="preview_tax">
							             </div>
							             </br>
							             </br>
							            

							             </br>



							             <div>	
							             
							             <table align="right">

							             <th><p><b><?php echo lang('invoices_subtotal'); ?>&nbsp;&nbsp;</p></th>
							             <th><p id="sub_total">0</p></th>
							             <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>

							             <th><p><b><?php echo lang('invoices_gst'); ?>&nbsp;&nbsp;</p></th>
							             <th><p id="taxsum">0</p></th>
							             <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>

							             <th><p><b><?php echo lang('invoices_total1'); ?>&nbsp;&nbsp;</p></th>
							             <th><p id="invoice_sum">0</p></th>
							             <th>&nbsp;&nbsp;</th>
							             

							             </table>
							             </div>
							             </br>


							            <div class="form-actions" >											
										<label class="control-label" for="comment"><?php echo lang('expense_comment'); ?></label>
										<div class="controls" align="right">
											<textarea type="text" class="span8 disabled" id="comment" name="comment" disabled></textarea>
										</div> <!-- /controls -->				
										</div> <!-- /control-group -->


									
											
										<!--<div class="form-actions" align="center">-->
											<!--<button  id="back_invoice" class="btn btn-primary"><?php //echo lang('invoices_back'); ?></button> -->
											
										<!--</div> -->
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


	//drawProductsTable();

			$("#back_invoice").click(function(){
	   		   
	   		  window.location.href = "<?php echo base_url();?>index.php/customerdashboard/invoices";
	   		    
	        });

			$("#mail_to_client").click(function(){

			 	if ($("#email_address").val() == "") {
			 		alert("Email address is required");
			 	} else {
			 		$("#ajax-loader").show();
		        	$(this).attr('disabled','disabled');

		        	$.post("<?php echo base_url();?>index.php/documentsservice/mail_invoice_to_client",
					{"invoice_id":$(this).attr("data-invoice"), 
					"email_address":$("#email_address").val(),
					"email_subject":$("#email_subject").val(),
					"email_body":$("#email_body").val()}).done(function(data) {
						if (data) {
							
							//var objectsData = JSON.parse(data);
							$("#ajax-loader").hide();
							$("#mail_to_client").removeAttr("disabled");
							//alert(data);

							$("#email_address").val("");
							$("#email_subject").val("");
							$("#email_body").val("");

							alert(data);

							$("#close_modal").trigger("click");
						}
					  },"json");

			 	};

	        });

</script>
<script src="js/base.js"></script>





 

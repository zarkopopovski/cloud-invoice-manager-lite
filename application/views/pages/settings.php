


<link href="css/pages/plans.css" rel="stylesheet"> 
<link href="<?php echo base_url('assets/css/pages/dashboard.css') ?>" rel="stylesheet" />

<script type="text/javascript" charset="utf-8">
			/* Global var for counter */
			var productsJSON = JSON.parse('<?php echo $results_json;?>');
			

			
			
			$(document).ready(function() {
				
				$('#default_language').val(productsJSON.default_language);
				$('#default_currency').val(productsJSON.default_currency);
				
				$('#output_invoice_number').val(productsJSON.output_invoice_number);
				$('#tax_visible').val(productsJSON.tax_visible);
				$('#tax_calculate').val(productsJSON.tax_calculate);

	   		    $('#output_invoice_no').val(productsJSON.output_invoice_no);
	   		    $('#output_invoice_no_pre').val(productsJSON.output_invoice_number_pre);

	   		    $("#input_invoice_no_format option[value="+productsJSON.input_invoice_number_format+"]").prop('selected', 'selected');
				$("#output_invoice_no_format option[value="+productsJSON.output_invoice_number_format+"]").prop('selected', 'selected');
				$("#draft_invoice_no_format option[value="+productsJSON.draft_invoice_number_format+"]").prop('selected', 'selected');

			});



			
			
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


	      		<?php
                   
                       

                         echo "<div class='btn-group'>
                                <button class='btn'>EDIT Profile</button>
                                <button class='btn dropdown-toggle' data-toggle='dropdown'>
                                <span class='caret'></span>
                                </button>
                                <ul class='dropdown-menu'>
                         		<li><a href='".site_url('customerdashboard/profile')."'>".lang('settings_edit_profile')."</a></li>";                                
                        
                        	echo  "<li><a href='".site_url('customerdashboard/company_profile')."'>".lang('settings_edit_company_profile')."</a></li>";
                        

                        echo  "</ul>
                               </div></br>";
                                            

                ?>
	      		
	      		
	           
	      		<div class="widget-content">

	      			
					<div class="tab-pane" id="formcontrols">
								<form action="edit_profile" method="post" id="edit-profile" class="form-horizontal">
									<fieldset>
										
																			
										
										<div class="control-group">											
											<label class="control-label" for="default_language"><?php echo lang('settings_default_language'); ?></label>
											<div class="controls">
												
												<select class="spbtn btn-default dropdown-togglean6" id="default_language" name="default_language" value="0">
												  <optgroup label="default_language">
						
					  								<option value="0">Македонски</option>
					  								<option value="1">Англиски</option>
					  								<option value="2">Албански</option>
					  								<option value="3">Српски</option>
												 			
												  </optgroup>
											</select>	


											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

										<div class="control-group">											
											<label class="control-label" for="default_currency"><?php echo lang('settings_default_currency'); ?></label>
											<div class="controls">
												
												<select class="spbtn btn-default dropdown-togglean6" id="default_currency" name="default_currency" value="">
												  <optgroup label="default_currency">
						
					  								<option value="USD" selected>US Dollar . USD</option>
													<option value="AFN">Afghanistan Afghani . AFN</option>
													<option value="ALL">Albanian Lek . ALL</option>
													<option value="DZD">Algerian Dinar . DZD</option>
													<option value="ADF">Andorran Franc . ADF</option>
													<option value="ADP">Andorran Peseta . ADP</option>
													<option value="AOA">Angolan Kwanza . AOA</option>
													<option value="AON">Angolan New Kwanza . AON</option>
													<option value="ARS">Argentine Peso . ARS</option>
													<option value="AMD">Armenian Dram . AMD</option>
													<option value="AWG">Aruban Florin . AWG</option>
													<option value="AUD">Australian Dollar . AUD</option>
													<option value="ATS">Austrian Schilling . ATS</option>
													<option value="AZM">Azerbaijan Manat . AZM</option>
													<option value="AZN">Azerbaijan New Manat . AZN</option>
													<option value="BSD">Bahamian Dollar . BSD</option>
													<option value="BHD">Bahraini Dinar . BHD</option>
													<option value="BDT">Bangladeshi Taka . BDT</option>
													<option value="BBD">Barbados Dollar . BBD</option>
													<option value="BYR">Belarusian Ruble . BYR</option>
													<option value="BEF">Belgian Franc . BEF</option>
													<option value="BZD">Belize Dollar . BZD</option>
													<option value="BMD">Bermudian Dollar . BMD</option>
													<option value="BTN">Bhutan Ngultrum . BTN</option>
													<option value="BOB">Bolivian Boliviano . BOB</option>
													<option value="BAM">Bosnian Mark . BAM</option>
													<option value="BWP">Botswana Pula . BWP</option>
													<option value="BRL">Brazilian Real . BRL</option>
													<option value="GBP">British Pound . GBP</option>
													<option value="BND">Brunei Dollar . BND</option>
													<option value="BGN">Bulgarian Lev . BGN</option>
													<option value="BIF">Burundi Franc . BIF</option>
													<option value="XOF">CFA Franc BCEAO . XOF</option>
													<option value="XAF">CFA Franc BEAC . XAF</option>
													<option value="XPF">CFP Franc . XPF</option>
													<option value="KHR">Cambodian Riel . KHR</option>
													<option value="CAD">Canadian Dollar . CAD</option>
													<option value="CVE">Cape Verde Escudo . CVE</option>
													<option value="KYD">Cayman Islands Dollar . KYD</option>
													<option value="CLP">Chilean Peso . CLP</option>
													<option value="CNY">Chinese Yuan Renminbi . CNY</option>
													<option value="COP">Colombian Peso . COP</option>
													<option value="KMF">Comoros Franc . KMF</option>
													<option value="CDF">Congolese Franc . CDF</option>
													<option value="CRC">Costa Rican Colon . CRC</option>
													<option value="HRK">Croatian Kuna . HRK</option>
													<option value="CUC">Cuban Convertible Peso . CUC</option>
													<option value="CUP">Cuban Peso . CUP</option>
													<option value="CYP">Cyprus Pound . CYP</option>
													<option value="CZK">Czech Koruna . CZK</option>
													<option value="DKK">Danish Krone . DKK</option>
													<option value="DJF">Djibouti Franc . DJF</option>
													<option value="DOP">Dominican R. Peso . DOP</option>
													<option value="NLG">Dutch Guilder . NLG</option>
													<option value="XEU">ECU . XEU</option>
													<option value="XCD">East Caribbean Dollar . XCD</option>
													<option value="ECS">Ecuador Sucre . ECS</option>
													<option value="EGP">Egyptian Pound . EGP</option>
													<option value="SVC">El Salvador Colon . SVC</option>
													<option value="EEK">Estonian Kroon . EEK</option>
													<option value="ETB">Ethiopian Birr . ETB</option>
													<option value="EUR">Euro . EUR</option>
													<option value="FKP">Falkland Islands Pound . FKP</option>
													<option value="FJD">Fiji Dollar . FJD</option>
													<option value="FIM">Finnish Markka . FIM</option>
													<option value="FRF">French Franc . FRF</option>
													<option value="GMD">Gambian Dalasi . GMD</option>
													<option value="GEL">Georgian Lari . GEL</option>
													<option value="DEM">German Mark . DEM</option>
													<option value="GHC">Ghanaian Cedi . GHC</option>
													<option value="GHS">Ghanaian New Cedi . GHS</option>
													<option value="GIP">Gibraltar Pound . GIP</option>
													<option value="XAU">Gold (oz.) . XAU</option>
													<option value="GRD">Greek Drachma . GRD</option>
													<option value="GTQ">Guatemalan Quetzal . GTQ</option>
													<option value="GNF">Guinea Franc . GNF</option>
													<option value="GYD">Guyanese Dollar . GYD</option>
													<option value="HTG">Haitian Gourde . HTG</option>
													<option value="HNL">Honduran Lempira . HNL</option>
													<option value="HKD">Hong Kong Dollar . HKD</option>
													<option value="HUF">Hungarian Forint . HUF</option>
													<option value="ISK">Iceland Krona . ISK</option>
													<option value="INR">Indian Rupee . INR</option>
													<option value="IDR">Indonesian Rupiah . IDR</option>
													<option value="IRR">Iranian Rial . IRR</option>
													<option value="IQD">Iraqi Dinar . IQD</option>
													<option value="IEP">Irish Punt . IEP</option>
													<option value="ILS">Israeli New Shekel . ILS</option>
													<option value="ITL">Italian Lira . ITL</option>
													<option value="JMD">Jamaican Dollar . JMD</option>
													<option value="JPY">Japanese Yen . JPY</option>
													<option value="JOD">Jordanian Dinar . JOD</option>
													<option value="KZT">Kazakhstan Tenge . KZT</option>
													<option value="KES">Kenyan Shilling . KES</option>
													<option value="KWD">Kuwaiti Dinar . KWD</option>
													<option value="KGS">Kyrgyzstanian Som . KGS</option>
													<option value="LAK">Lao Kip . LAK</option>
													<option value="LVL">Latvian Lats . LVL</option>
													<option value="LBP">Lebanese Pound . LBP</option>
													<option value="LSL">Lesotho Loti . LSL</option>
													<option value="LRD">Liberian Dollar . LRD</option>
													<option value="LYD">Libyan Dinar . LYD</option>
													<option value="LTL">Lithuanian Litas . LTL</option>
													<option value="LUF">Luxembourg Franc . LUF</option>
													<option value="MOP">Macau Pataca . MOP</option>
													<option value="MKD">Macedonian Denar . MKD</option>
													<option value="MGA">Malagasy Ariary . MGA</option>
													<option value="MGF">Malagasy Franc . MGF</option>
													<option value="MWK">Malawi Kwacha . MWK</option>
													<option value="MYR">Malaysian Ringgit . MYR</option>
													<option value="MVR">Maldive Rufiyaa . MVR</option>
													<option value="MTL">Maltese Lira . MTL</option>
													<option value="MRO">Mauritanian Ouguiya . MRO</option>
													<option value="MUR">Mauritius Rupee . MUR</option>
													<option value="MXN">Mexican Peso . MXN</option>
													<option value="MDL">Moldovan Leu . MDL</option>
													<option value="MNT">Mongolian Tugrik . MNT</option>
													<option value="MAD">Moroccan Dirham . MAD</option>
													<option value="MZM">Mozambique Metical . MZM</option>
													<option value="MZN">Mozambique New Metical . MZN</option>
													<option value="MMK">Myanmar Kyat . MMK</option>
													<option value="ANG">NL Antillian Guilder . ANG</option>
													<option value="NAD">Namibia Dollar . NAD</option>
													<option value="NPR">Nepalese Rupee . NPR</option>
													<option value="NZD">New Zealand Dollar . NZD</option>
													<option value="NIO">Nicaraguan Cordoba Oro . NIO</option>
													<option value="NGN">Nigerian Naira . NGN</option>
													<option value="KPW">North Korean Won . KPW</option>
													<option value="NOK">Norwegian Kroner . NOK</option>
													<option value="OMR">Omani Rial . OMR</option>
													<option value="PKR">Pakistan Rupee . PKR</option>
													<option value="XPD">Palladium (oz.) . XPD</option>
													<option value="PAB">Panamanian Balboa . PAB</option>
													<option value="PGK">Papua New Guinea Kina . PGK</option>
													<option value="PYG">Paraguay Guarani . PYG</option>
													<option value="PEN">Peruvian Nuevo Sol . PEN</option>
													<option value="PHP">Philippine Peso . PHP</option>
													<option value="XPT">Platinum (oz.) . XPT</option>
													<option value="PLN">Polish Zloty . PLN</option>
													<option value="PTE">Portuguese Escudo . PTE</option>
													<option value="QAR">Qatari Rial . QAR</option>
													<option value="ROL">Romanian Lei . ROL</option>
													<option value="RON">Romanian New Lei . RON</option>
													<option value="RUB">Russian Rouble . RUB</option>
													<option value="RWF">Rwandan Franc . RWF</option>
													<option value="WST">Samoan Tala . WST</option>
													<option value="STD">Sao Tome/Principe Dobra . STD</option>
													<option value="SAR">Saudi Riyal . SAR</option>
													<option value="RSD">Serbian Dinar . RSD</option>
													<option value="SCR">Seychelles Rupee . SCR</option>
													<option value="SLL">Sierra Leone Leone . SLL</option>
													<option value="XAG">Silver (oz.) . XAG</option>
													<option value="SGD">Singapore Dollar . SGD</option>
													<option value="SKK">Slovak Koruna . SKK</option>
													<option value="SIT">Slovenian Tolar . SIT</option>
													<option value="SBD">Solomon Islands Dollar . SBD</option>
													<option value="SOS">Somali Shilling . SOS</option>
													<option value="ZAR">South African Rand . ZAR</option>
													<option value="KRW">South-Korean Won . KRW</option>
													<option value="ESP">Spanish Peseta . ESP</option>
													<option value="LKR">Sri Lanka Rupee . LKR</option>
													<option value="SHP">St. Helena Pound . SHP</option>
													<option value="SDD">Sudanese Dinar . SDD</option>
													<option value="SDP">Sudanese Old Pound . SDP</option>
													<option value="SDG">Sudanese Pound . SDG</option>
													<option value="SRD">Suriname Dollar . SRD</option>
													<option value="SRG">Suriname Guilder . SRG</option>
													<option value="SZL">Swaziland Lilangeni . SZL</option>
													<option value="SEK">Swedish Krona . SEK</option>
													<option value="CHF">Swiss Franc . CHF</option>
													<option value="SYP">Syrian Pound . SYP</option>
													<option value="TWD">Taiwan Dollar . TWD</option>
													<option value="TJS">Tajikistani Somoni . TJS</option>
													<option value="TZS">Tanzanian Shilling . TZS</option>
													<option value="THB">Thai Baht . THB</option>
													<option value="TOP">Tonga Pa'anga . TOP</option>
													<option value="TTD">Trinidad/Tobago Dollar . TTD</option>
													<option value="TND">Tunisian Dinar . TND</option>
													<option value="TRY">Turkish Lira . TRY</option>
													<option value="TRL">Turkish Old Lira . TRL</option>
													<option value="TMM">Turkmenistan Manat . TMM</option>
													<option value="TMT">Turkmenistan New Manat . TMT</option>
													<option value="UGX">Uganda Shilling . UGX</option>
													<option value="UAH">Ukraine Hryvnia . UAH</option>
													<option value="UYU">Uruguayan Peso . UYU</option>
													<option value="AED">Utd. Arab Emir. Dirham . AED</option>
													<option value="UZS">Uzbekistan Som . UZS</option>
													<option value="VUV">Vanuatu Vatu . VUV</option>
													<option value="VEB">Venezuelan Bolivar . VEB</option>
													<option value="VEF">Venezuelan Bolivar Fuerte . VEF</option>
													<option value="VND">Vietnamese Dong . VND</option>
													<option value="YER">Yemeni Rial . YER</option>
													<option value="YUN">Yugoslav Dinar . YUN</option>
													<option value="ZMW">Zambian  Kwacha . ZMW</option>
													<option value="ZMK">Zambian Kwacha . ZMK</option>
													<option value="ZWD">Zimbabwe Dollar . ZWD</option>

												 			
												  </optgroup>
											</select>	


											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										<div class="control-group">											
											<label class="control-label" for="tax_calculate"><?php echo lang('settings_tax_calculate'); ?></label>
											<div class="controls">
												
												<select class="spbtn btn-default dropdown-togglean6" id="tax_calculate" name="tax_calculate" value="">
												  <optgroup label="default_option">
						
					  								<option value="0"><?php echo lang('settings_yes'); ?></option>
					  								<option value="1"><?php echo lang('settings_no'); ?></option>
					  								
												 			
												  </optgroup>
											</select>	


											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

										<div class="control-group">											
											<label class="control-label" for="tax_visible"><?php echo lang('settings_tax_visible'); ?></label>
											<div class="controls">
												
												<select class="spbtn btn-default dropdown-togglean6" id="tax_visible" name="tax_visible" value="">
												  <optgroup label="default_option">
						
					  								<option value="0"><?php echo lang('settings_yes'); ?></option>
					  								<option value="1"><?php echo lang('settings_no'); ?></option>
					  								
												 			
												  </optgroup>
											</select>	


											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

										<div class="control-group">											
											<label class="control-label" for="initial_output_invoice_number"><?php echo lang('init_output_invoice_number'); ?></label>
											<div class="controls">
												<input type="text" class="span3" id="output_invoice_no" name="output_invoice_no" value="<?php if(isset($results)) echo $results['output_invoice_no']; ?>">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

										<div class="control-group">											
											<label class="control-label" for="invoice_number_format"><?php echo lang('invoice_number_format'); ?></label>
											<div class="controls">
												<!-- <input type="text" class="span3" id="input_invoice_no_format" name="input_invoice_no_format" value="<?php if(isset($results)) echo $results['input_invoice_no']; ?>"> -->
												<select class="spbtn btn-default dropdown-togglean6" id="output_invoice_no_format" name="output_invoice_no_format" value="">
												  <optgroup label="numbering">
					  								<option value="YEARMINUMBER">2014 - 0000001</option>
					  								<option value="YRMINUMBER">  14 - 0000001</option>
					  								<option value="NUMBERSLYEAR">0000001 / 2014</option>
					  								<option value="NUMBERSLYR">0000001 / 14</option>
					  								<option value="NUMBER">0000001</option>
												  </optgroup>
											</select>	
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

										<div class="control-group">											
											<label class="control-label" for="invoice_number_prefix"><?php echo lang('invoice_number_prefix'); ?></label>
											<div class="controls">
												<input type="text" class="span3" id="output_invoice_no_pre" name="output_invoice_no_pre" value="<?php if(isset($results)) echo $results['input_invoice_no']; ?>">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

											
										 <br />
										
											
										<div class="form-actions">
											<button  id="save_settings" class="btn btn-primary"><?php echo lang('settings_save'); ?></button> 
										</div> <!-- /form-actions -->
									</fieldset>
								</form>
								</div>



				</div> <!-- /widget content -->
						
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

		function setSelectedOptions() {

		   var default_currency = document.getElementById('default_currency');
		   
		   
		   var defaultDefaultcurrency = "<?php if (isset($results)) { echo $results['default_currency']; }?>";

		   //console.log(country.options.length);
		  

		  

		   for (i = 0; i < default_currency.options.length; i++) {
		    if (default_currency.options[i].value == defaultDefaultcurrency) {
		     
		     default_currency.options[i].selected = true;

		     break;
		    } 
		   }

		}


         setSelectedOptions();
	

			


			$("#save_settings").click(function(){
	   		   
	   		   var default_language = $('#default_language').val();
	   		   var default_currency = $('#default_currency').val();
	   		   var invoice_number = $('#invoice_number').val();
	   		   var tax_visible = $('#tax_visible').val();
	   		   var tax_calculate = $('#tax_calculate').val();

	   		   var input_invoice = $('#input_invoice_no').val();
	   		   var input_invoice_number_format = $("#input_invoice_no_format").val();
	   		   var input_invoice_pre = $("#input_invoice_no_pre").val();

	   		   var output_invoice = $('#output_invoice_no').val();
	   		   var output_invoice_number_format = $("#output_invoice_no_format").val();
	   		   var output_invoice_pre = $("#output_invoice_no_pre").val();

	   		   var draft_invoice = $('#draft_invoice_no').val();
			   var draft_invoice_number_format = $("#draft_invoice_no_format").val();
			   var draft_invoice_pre = $("#draft_invoice_no_pre").val();

	   		   var request = $('#request_no').val();
	   		   var received_note_no = $('#received_note_no').val();
	   		   var delivery_note_no = $('#delivery_note_no').val();
	   		   
	   		   //console.log(invoice_number);


	   		   $.post("<?php echo base_url();?>index.php/customerdashboard/update_settings",
				{
					"default_language":default_language, 
					"default_currency":default_currency, 
					"invoice_number":invoice_number, 
					"tax_visible":tax_visible,
					"tax_calculate":tax_calculate,
					"input_invoice_no":input_invoice,
					"input_invoice_no_format":input_invoice_number_format,
					"input_invoice_no_pre":input_invoice_pre,
					"output_invoice_no":output_invoice,
					"output_invoice_no_format":output_invoice_number_format,
					"output_invoice_no_pre":output_invoice_pre,
					"draft_invoice_no":draft_invoice,
					"draft_invoice_no_format":draft_invoice_number_format,
					"draft_invoice_no_pre":draft_invoice_pre,
					"request_no":request,
				    "delivery_note_no":delivery_note_no,
				    "received_note_no":received_note_no,}).done(function(data) {
					if (data) {

						console.log(data);

						var objectsData = JSON.parse(data);


						if (!objectsData.ERROR) {
							alert(objectsData.MESSAGE);
							window.location.href = "<?php echo base_url();?>index.php/customerdashboard";
						} else {
							alert(objectsData.MESSAGE);
						}
						
					}
				  },"json");

					return false;
	   		    
	            });


</script>
<script src="js/base.js"></script>

 




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
								<form action="<?= site_url('customerdashboard/update_client') ?>" method="post" id="edit-profile" class="form-horizontal">
									<fieldset>
										
										<div class="form-actions">											
											<label class="control-label" for="name">Client Name</label>
											<div class="controls">
												<input type="hidden" class="span6" id="id" name="id" value="<?php if(isset($results)) echo $results['id']; ?>" >
												<input type="text" class="span6" id="name" name="name" value="<?php if(isset($results)) echo $results['name']; ?>" >
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										
										
										<div class="form-actions">											
											<label class="control-label" for="address">Address 1</label>
											<div class="controls">
												<input type="text" class="span6" id="address" name="address" value="<?php if(isset($results)) echo $results['address']; ?>"></input>
											</div> <!-- /controls -->	
											</br>

											<label class="control-label" for="address2">Address 2</label>
											<div class="controls">
												<input type="text" class="span6" id="address2" name="address2" value="<?php if(isset($results)) echo $results['address2']; ?>"></input>
											</div> <!-- /controls -->	
											</br>				

											<label class="control-label" for="city">City</label>
											<div class="controls">
												<input type="text" class="span6" id="city" name="city" value="<?php if(isset($results)) echo $results['city']; ?>"></input>
											</div> <!-- /controls -->
											</br>

											<label class="control-label" for="zip">ZIP</label>
											<div class="controls">
												<input type="text" class="span6" id="zip" name="zip" value="<?php if(isset($results)) echo $results['zip']; ?>"></input>
											</div> <!-- /controls -->	
											</br>

											<label class="control-label" for="country">Country</label>
											<div class="controls">
												<select class="spbtn btn-primary dropdown-togglean6" id="country" name="country" value="0">
												  <optgroup label="country">
					  								<option value="">Select Country</option> 
													<option value="United States">United States</option> 
													<option value="United Kingdom">United Kingdom</option> 
													<option value="Afghanistan">Afghanistan</option> 
													<option value="Albania">Albania</option> 
													<option value="Algeria">Algeria</option> 
													<option value="American Samoa">American Samoa</option> 
													<option value="Andorra">Andorra</option> 
													<option value="Angola">Angola</option> 
													<option value="Anguilla">Anguilla</option> 
													<option value="Antarctica">Antarctica</option> 
													<option value="Antigua and Barbuda">Antigua and Barbuda</option> 
													<option value="Argentina">Argentina</option> 
													<option value="Armenia">Armenia</option> 
													<option value="Aruba">Aruba</option> 
													<option value="Australia">Australia</option> 
													<option value="Austria">Austria</option> 
													<option value="Azerbaijan">Azerbaijan</option> 
													<option value="Bahamas">Bahamas</option> 
													<option value="Bahrain">Bahrain</option> 
													<option value="Bangladesh">Bangladesh</option> 
													<option value="Barbados">Barbados</option> 
													<option value="Belarus">Belarus</option> 
													<option value="Belgium">Belgium</option> 
													<option value="Belize">Belize</option> 
													<option value="Benin">Benin</option> 
													<option value="Bermuda">Bermuda</option> 
													<option value="Bhutan">Bhutan</option> 
													<option value="Bolivia">Bolivia</option> 
													<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 
													<option value="Botswana">Botswana</option> 
													<option value="Bouvet Island">Bouvet Island</option> 
													<option value="Brazil">Brazil</option> 
													<option value="British Indian Ocean Territory">British Indian Ocean Territory</option> 
													<option value="Brunei Darussalam">Brunei Darussalam</option> 
													<option value="Bulgaria">Bulgaria</option> 
													<option value="Burkina Faso">Burkina Faso</option> 
													<option value="Burundi">Burundi</option> 
													<option value="Cambodia">Cambodia</option> 
													<option value="Cameroon">Cameroon</option> 
													<option value="Canada">Canada</option> 
													<option value="Cape Verde">Cape Verde</option> 
													<option value="Cayman Islands">Cayman Islands</option> 
													<option value="Central African Republic">Central African Republic</option> 
													<option value="Chad">Chad</option> 
													<option value="Chile">Chile</option> 
													<option value="China">China</option> 
													<option value="Christmas Island">Christmas Island</option> 
													<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option> 
													<option value="Colombia">Colombia</option> 
													<option value="Comoros">Comoros</option> 
													<option value="Congo">Congo</option> 
													<option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option> 
													<option value="Cook Islands">Cook Islands</option> 
													<option value="Costa Rica">Costa Rica</option> 
													<option value="Cote D'ivoire">Cote D'ivoire</option> 
													<option value="Croatia">Croatia</option> 
													<option value="Cuba">Cuba</option> 
													<option value="Cyprus">Cyprus</option> 
													<option value="Czech Republic">Czech Republic</option> 
													<option value="Denmark">Denmark</option> 
													<option value="Djibouti">Djibouti</option> 
													<option value="Dominica">Dominica</option> 
													<option value="Dominican Republic">Dominican Republic</option> 
													<option value="Ecuador">Ecuador</option> 
													<option value="Egypt">Egypt</option> 
													<option value="El Salvador">El Salvador</option> 
													<option value="Equatorial Guinea">Equatorial Guinea</option> 
													<option value="Eritrea">Eritrea</option> 
													<option value="Estonia">Estonia</option> 
													<option value="Ethiopia">Ethiopia</option> 
													<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option> 
													<option value="Faroe Islands">Faroe Islands</option> 
													<option value="Fiji">Fiji</option> 
													<option value="Finland">Finland</option> 
													<option value="France">France</option> 
													<option value="French Guiana">French Guiana</option> 
													<option value="French Polynesia">French Polynesia</option> 
													<option value="French Southern Territories">French Southern Territories</option> 
													<option value="Gabon">Gabon</option> 
													<option value="Gambia">Gambia</option> 
													<option value="Georgia">Georgia</option> 
													<option value="Germany">Germany</option> 
													<option value="Ghana">Ghana</option> 
													<option value="Gibraltar">Gibraltar</option> 
													<option value="Greece">Greece</option> 
													<option value="Greenland">Greenland</option> 
													<option value="Grenada">Grenada</option> 
													<option value="Guadeloupe">Guadeloupe</option> 
													<option value="Guam">Guam</option> 
													<option value="Guatemala">Guatemala</option> 
													<option value="Guinea">Guinea</option> 
													<option value="Guinea-bissau">Guinea-bissau</option> 
													<option value="Guyana">Guyana</option> 
													<option value="Haiti">Haiti</option> 
													<option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option> 
													<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option> 
													<option value="Honduras">Honduras</option> 
													<option value="Hong Kong">Hong Kong</option> 
													<option value="Hungary">Hungary</option> 
													<option value="Iceland">Iceland</option> 
													<option value="India">India</option> 
													<option value="Indonesia">Indonesia</option> 
													<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option> 
													<option value="Iraq">Iraq</option> 
													<option value="Ireland">Ireland</option> 
													<option value="Israel">Israel</option> 
													<option value="Italy">Italy</option> 
													<option value="Jamaica">Jamaica</option> 
													<option value="Japan">Japan</option> 
													<option value="Jordan">Jordan</option> 
													<option value="Kazakhstan">Kazakhstan</option> 
													<option value="Kenya">Kenya</option> 
													<option value="Kiribati">Kiribati</option> 
													<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option> 
													<option value="Korea, Republic of">Korea, Republic of</option> 
													<option value="Kuwait">Kuwait</option> 
													<option value="Kyrgyzstan">Kyrgyzstan</option> 
													<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option> 
													<option value="Latvia">Latvia</option> 
													<option value="Lebanon">Lebanon</option> 
													<option value="Lesotho">Lesotho</option> 
													<option value="Liberia">Liberia</option> 
													<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option> 
													<option value="Liechtenstein">Liechtenstein</option> 
													<option value="Lithuania">Lithuania</option> 
													<option value="Luxembourg">Luxembourg</option> 
													<option value="Macao">Macao</option> 
													<option value="Macedonia">Macedonia</option> 
													<option value="Madagascar">Madagascar</option> 
													<option value="Malawi">Malawi</option> 
													<option value="Malaysia">Malaysia</option> 
													<option value="Maldives">Maldives</option> 
													<option value="Mali">Mali</option> 
													<option value="Malta">Malta</option> 
													<option value="Marshall Islands">Marshall Islands</option> 
													<option value="Martinique">Martinique</option> 
													<option value="Mauritania">Mauritania</option> 
													<option value="Mauritius">Mauritius</option> 
													<option value="Mayotte">Mayotte</option> 
													<option value="Mexico">Mexico</option> 
													<option value="Micronesia, Federated States of">Micronesia, Federated States of</option> 
													<option value="Moldova, Republic of">Moldova, Republic of</option> 
													<option value="Monaco">Monaco</option> 
													<option value="Mongolia">Mongolia</option> 
													<option value="Montserrat">Montserrat</option> 
													<option value="Morocco">Morocco</option> 
													<option value="Mozambique">Mozambique</option> 
													<option value="Myanmar">Myanmar</option> 
													<option value="Namibia">Namibia</option> 
													<option value="Nauru">Nauru</option> 
													<option value="Nepal">Nepal</option> 
													<option value="Netherlands">Netherlands</option> 
													<option value="Netherlands Antilles">Netherlands Antilles</option> 
													<option value="New Caledonia">New Caledonia</option> 
													<option value="New Zealand">New Zealand</option> 
													<option value="Nicaragua">Nicaragua</option> 
													<option value="Niger">Niger</option> 
													<option value="Nigeria">Nigeria</option> 
													<option value="Niue">Niue</option> 
													<option value="Norfolk Island">Norfolk Island</option> 
													<option value="Northern Mariana Islands">Northern Mariana Islands</option> 
													<option value="Norway">Norway</option> 
													<option value="Oman">Oman</option> 
													<option value="Pakistan">Pakistan</option> 
													<option value="Palau">Palau</option> 
													<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option> 
													<option value="Panama">Panama</option> 
													<option value="Papua New Guinea">Papua New Guinea</option> 
													<option value="Paraguay">Paraguay</option> 
													<option value="Peru">Peru</option> 
													<option value="Philippines">Philippines</option> 
													<option value="Pitcairn">Pitcairn</option> 
													<option value="Poland">Poland</option> 
													<option value="Portugal">Portugal</option> 
													<option value="Puerto Rico">Puerto Rico</option> 
													<option value="Qatar">Qatar</option> 
													<option value="Reunion">Reunion</option> 
													<option value="Romania">Romania</option> 
													<option value="Russian Federation">Russian Federation</option> 
													<option value="Rwanda">Rwanda</option> 
													<option value="Saint Helena">Saint Helena</option> 
													<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
													<option value="Saint Lucia">Saint Lucia</option> 
													<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option> 
													<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option> 
													<option value="Samoa">Samoa</option> 
													<option value="San Marino">San Marino</option> 
													<option value="Sao Tome and Principe">Sao Tome and Principe</option> 
													<option value="Saudi Arabia">Saudi Arabia</option> 
													<option value="Senegal">Senegal</option> 
													<option value="Serbia and Montenegro">Serbia and Montenegro</option> 
													<option value="Seychelles">Seychelles</option> 
													<option value="Sierra Leone">Sierra Leone</option> 
													<option value="Singapore">Singapore</option> 
													<option value="Slovakia">Slovakia</option> 
													<option value="Slovenia">Slovenia</option> 
													<option value="Solomon Islands">Solomon Islands</option> 
													<option value="Somalia">Somalia</option> 
													<option value="South Africa">South Africa</option> 
													<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option> 
													<option value="Spain">Spain</option> 
													<option value="Sri Lanka">Sri Lanka</option> 
													<option value="Sudan">Sudan</option> 
													<option value="Suriname">Suriname</option> 
													<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option> 
													<option value="Swaziland">Swaziland</option> 
													<option value="Sweden">Sweden</option> 
													<option value="Switzerland">Switzerland</option> 
													<option value="Syrian Arab Republic">Syrian Arab Republic</option> 
													<option value="Taiwan, Province of China">Taiwan, Province of China</option> 
													<option value="Tajikistan">Tajikistan</option> 
													<option value="Tanzania, United Republic of">Tanzania, United Republic of</option> 
													<option value="Thailand">Thailand</option> 
													<option value="Timor-leste">Timor-leste</option> 
													<option value="Togo">Togo</option> 
													<option value="Tokelau">Tokelau</option> 
													<option value="Tonga">Tonga</option> 
													<option value="Trinidad and Tobago">Trinidad and Tobago</option> 
													<option value="Tunisia">Tunisia</option> 
													<option value="Turkey">Turkey</option> 
													<option value="Turkmenistan">Turkmenistan</option> 
													<option value="Turks and Caicos Islands">Turks and Caicos Islands</option> 
													<option value="Tuvalu">Tuvalu</option> 
													<option value="Uganda">Uganda</option> 
													<option value="Ukraine">Ukraine</option> 
													<option value="United Arab Emirates">United Arab Emirates</option> 
													<option value="United Kingdom">United Kingdom</option> 
													<option value="United States">United States</option> 
													<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option> 
													<option value="Uruguay">Uruguay</option> 
													<option value="Uzbekistan">Uzbekistan</option> 
													<option value="Vanuatu">Vanuatu</option> 
													<option value="Venezuela">Venezuela</option> 
													<option value="Viet Nam">Viet Nam</option> 
													<option value="Virgin Islands, British">Virgin Islands, British</option> 
													<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option> 
													<option value="Wallis and Futuna">Wallis and Futuna</option> 
													<option value="Western Sahara">Western Sahara</option> 
													<option value="Yemen">Yemen</option> 
													<option value="Zambia">Zambia</option> 
													<option value="Zimbabwe">Zimbabwe</option>

												  </optgroup>
												</select>
											</div> <!-- /controls -->	

										</div> <!-- /control-group -->
							
										
										<div class="form-actions">											
											<label class="control-label" for="email">email</label>
											<div class="controls">
												<input type="text" class="span6" id="email" name="email" value="<?php if(isset($results)) echo $results['email']; ?>"></input>
											</div> <!-- /controls -->	
											</br>

											<label class="control-label" for="tel1">Phone 1</label>
											<div class="controls">
												<input type="text" class="span6" id="tel1" name="tel1" value="<?php if(isset($results)) echo $results['tel1']; ?>"></input>
											</div> <!-- /controls -->	
											</br>

											<label class="control-label" for="tel2">Phone 2</label>
											<div class="controls">
												<input type="text" class="span6" id="tel2" name="tel2" value="<?php if(isset($results)) echo $results['tel2']; ?>"></input>
											</div> <!-- /controls -->														
										</div> <!-- /control-group -->


										<div class="form-actions">											
											<label class="control-label" for="registration_number"><?php echo lang('profile_registration_number'); ?></label>
											<div class="controls">
												<input type="text" class="span6" id="registration_number" name="registration_number" value="<?php if(isset($results)) echo $results['registration_number']; ?>"></input>
											</div> <!-- /controls -->				
											</br>
																					
											<label class="control-label" for="unique_number"><?php echo lang('profile_unique_number'); ?></label>
											<div class="controls">
												<input type="text" class="span6" id="unique_number" name="unique_number" value="<?php if(isset($results)) echo $results['unique_number']; ?>"></input>
											</div> <!-- /controls -->				
											</br>

											<label class="control-label" for="tax_number"><?php echo lang('profile_tax_number'); ?></label>
											<div class="controls">
												<input type="text" class="span6" id="tax_number" name="tax_number" value="<?php if(isset($results)) echo $results['tax_number']; ?>"></input>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->

										<div class="form-actions">											
											<label class="control-label" for="id"><?php echo lang('client_groups'); ?></label>
											<div class="controls">
												<input type="hidden" class="span6" id="id" name="group_id" value="<?php if(isset($results)) echo $results['group_id']; ?>" >
												<select class="spbtn btn-primary dropdown-togglean6" id="client_group" name="client_group" value="0">
												 	<optgroup label="<?php echo lang('client_groups_select'); ?>">
					  									<?php 
					  										if ($groups) {
					  											foreach ($groups as $group) {
					  												echo "<option value='".$group["id"]."'>".$group["name"]."</option>";
					  											}
					  										}

					  									?>
					  								</optgroup>
					  							</select>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										

																			
											
										<div class="form-actions" align="center">
											<button type="submit" id="submit" class="btn btn-primary">SAVE Client</button> 
											
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

		$('#client_group option[value=<?php if(isset($results)) echo $results['group_id']; ?>]').prop('selected', 'selected')

         setSelectedOptions();

        </script>
 

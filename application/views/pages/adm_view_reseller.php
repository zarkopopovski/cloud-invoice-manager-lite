


<link href="css/pages/plans.css" rel="stylesheet"> 

   <script type="text/javascript" charset="utf-8">
            /* Global var for counter */
            var giCount = 1;
            
            $(document).ready(function() {
                $('#example1').dataTable();
            } );
            
            
        </script>

    

    
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">

        <li><a href="<?= site_url('admindashboard') ?>"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
        <li class="active"><a href="usermanagement"><i class="icon-list-alt"></i><span>User Management</span> </a> </li>

<!--         <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-long-arrow-down"></i><span>Drops</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="icons.html">Icons</a></li>
            <li><a href="faq.html">FAQ</a></li>
            <li><a href="pricing.html">Pricing Plans</a></li>
            <li><a href="login.html">Login</a></li>
            <li><a href="signup.html">Signup</a></li>
            <li><a href="error.html">404</a></li>
          </ul>
        </li> -->
      </ul>
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
					
					<!-- <h4>email: </h4><p></p>
					<h4>Address 1: </h4><p><?php if(isset($results)) echo $results['address']; ?></p>
					<h4>Address 2: </h4><p><?php if(isset($results)) echo $results['address2']; ?></p>
					<h4>ZIP: </h4><p><?php if(isset($results)) echo $results['zip']; ?></p>
					<H4>City: </H4><p><?php if(isset($results)) echo $results['city']; ?></p>
					<h4>Country: </h4><p><?php if(isset($results)) echo $results['country']; ?></p>
					<h4>Phone 1: </h4><p><?php if(isset($results)) echo $results['tel1']; ?></p>
					<h4>Phone 2: </h4><p><?php if(isset($results)) echo $results['tel2']; ?></p>  -->
				<table class="table">
                <thead>
                  <tr>
                    <th><h4 style="color:#006600;">CLIENT: </h4><h3><?php if(isset($customerData)) echo $customerData['name']; ?></h3> </th>
                    <th></th>
                    <th></th>

                    
                    
                  </tr>
                </thead>
                
                <tbody>

					<tr>
					<th><h4 style="color:#006600;">EMAIL: </h4><h4><?php if(isset($customerData)) echo $customerData['email']; ?></h4></h4>
					
					</tr>
                                 
                </tbody>
              </table>

					
					</div> <!-- /view client -->
								
					</div> 

				</div> <!-- /widget content  INPUT-->

	      		
						
				</div> <!--		widget	 -->				
				
		    </div> <!-- /span12     -->	
	      	
	      	
	      </div> <!-- /row -->
	
	    </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
	

    
</div> <!-- /main -->

<div class="main">
	
	<div class="main-inner">

	    <div class="container">
	
	      <div class="row">
	      	
	      	<div class="span12">
	      		
	      		<div class="widget">

	      		

	      		<div class="widget-content">
				
				</br>


           
					
				<table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                <thead>
                  <tr>
                    <th> Invoice Number</th>
                    <th> Status</th>
                    <th> Sum</th>
                    <th> Due Date</th>
                    <th> Paid Date</th>
                    <th> Confirmed</th>
                    
                    <th> View</th>
                    <th> Delete</th>
                    <th> Edit</th>
                  </tr>
                </thead>
                
                <tbody>

					<?php

					  if (isset($clientInvoices) && sizeof($clientInvoices) > 0){

                       

					  foreach ($clientInvoices as $row) {

                         $paidDate = $row['paid_date'];

                        if(is_null($row['paid_date'])) {
                        $paidDate = "/";
                        }
						
					  echo "<tr>";
					  echo "<td>" . $row['invoice_number'] . "</td>";
					  echo "<td>" . $row['confirmed'] . "</td>";
					  echo "<td>" . $row['invoice_sum'] . "</td>";
					  echo "<td>" . $row['due_date'] . "</td>";
					  echo "<td>" . $row['paid_date'] . "</td>";					  
					  echo "<td>" . $row['status'] . "</td>";
					  echo "<td><a class='btn btn-small btn-success' href='view_invoice?id=". $row['id'] . "'>VIEW</a></td>";
					  echo "<td><a class='btn btn-danger btn-small' href='delete_invoice?id=". $row['id'] . "'>DELETE</a></td>";
					  echo "<td><a class='btn btn-small btn-success' href='edit_invoice?id=". $row['id'] . "'>EDIT</a></td>";
					  echo "</tr>";

					  
					  }

					}

					  ?>


                 
                                 
                </tbody>
              </table>
  
								
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

 

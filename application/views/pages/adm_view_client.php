


<link href="css/pages/plans.css" rel="stylesheet"> 

   <script type="text/javascript" charset="utf-8">
            /* Global var for counter */
                       
            
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
                    <th><h4 style="color:#006600;">CLIENT: </h4><h3><?php if(isset($customerProfile)) echo $customerProfile['first_name'];
                    if(isset($customerProfile)) echo " ".$customerProfile['last_name']; ?></h3> </th>
                    <th></th>
                    <th></th>
                    
                  </tr>
                </thead>
                
                <tbody>

					<tr>
					<th><h4 style="color:#006600;">EMAIL: </h4><h4><?php if(isset($customerData)) echo $customerData['email']; ?></h4></h4>
					<th><h4 style="color:#006600;">ADDRESS 1: </h4><h4><?php if(isset($customerProfile)) echo $customerProfile['address']; ?></h4></h4>
					<th><h4 style="color:#006600;">ADDRESS 2: </h4><h4><?php if(isset($customerProfile)) echo $customerProfile['address2']; ?></h4></h4>
					
					</tr>
					<tr>
					<th><h4 style="color:#006600;">ZIP: </h4><h4><?php if(isset($customerProfile)) echo $customerProfile['zip']; ?></h4></h4>
					<th><h4 style="color:#006600;">CITY: </h4><h4><?php if(isset($customerProfile)) echo $customerProfile['city']; ?></h4></th>
					<th><h4 style="color:#006600;">COUNTRY: </h4><h4><?php if(isset($customerProfile)) echo $customerProfile['country']; ?></h4></th>
					</tr>

					<tr>
					<th><h4 style="color:#006600;">PHONE 1: </h4><h4><?php if(isset($customerProfile)) echo $customerProfile['tel1']; ?></h4></th>
					<th><h4 style="color:#006600;">PHONE 2: </h4><h4><?php if(isset($customerProfile)) echo $customerProfile['tel2']; ?></h4></th>
					<th></th>
					</tr>

					<tr>
					<th></th>
				<th>

				</th>
					<th></th>
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
	

    
</div>

					    


<div class="extra">

	<div class="extra-inner">

		<div class="container">

			<div class="row">
                    <div class="span3">
                        <h4>
                            About Free Admin Template</h4>
                        <ul>
                            <li><a href="javascript:;">EGrappler.com</a></li>
                            <li><a href="javascript:;">Web Development Resources</a></li>
                            <li><a href="javascript:;">Responsive HTML5 Portfolio Templates</a></li>
                            <li><a href="javascript:;">Free Resources and Scripts</a></li>
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
                            Open Source jQuery Plugins</h4>
                        <ul>
                            <li><a href="http://www.egrappler.com">Open Source jQuery Plugins</a></li>
                            <li><a href="http://www.egrappler.com;">HTML5 Responsive Tempaltes</a></li>
                            <li><a href="http://www.egrappler.com;">Free Contact Form Plugin</a></li>
                            <li><a href="http://www.egrappler.com;">Flat UI PSD</a></li>
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
    				&copy; 2013 <a href="http://www.egrappler.com/">Bootstrap Responsive Admin Template</a>.
    			</div> <!-- /span12 -->
    			
    		</div> <!-- /row -->
    		
		</div> <!-- /container -->
		
	</div> <!-- /footer-inner -->
	
</div> <!-- /footer -->
    

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="js/base.js"></script>

 

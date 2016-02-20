<div class="navbar navbar-fixed-top">
    
    <div class="navbar-inner">
        
        <div class="container">
            
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            
            <a class="brand" href="index.html">
                Cloud Invoice Manager Lite               
            </a>        
            
            <div class="nav-collapse">
                <ul class="nav pull-right">
                    
                   

                    <!-- <li class="">                       
                        <a href="index.html" class="">
                            <i class="icon-chevron-left"></i>
                        <?php echo lang('back_to_homepage'); ?>
                        </a>
                        
                    </li> -->

                     <li class="">                       
                      <div class="btn-group">
                       <button class='btn'><?php if(isset($email)) echo $email; ?></button>
                                <button class='btn dropdown-toggle' data-toggle='dropdown'>
                                <span class='caret'></span>
                                </button>
                        <ul class="dropdown-menu" role="menu">
                          
                          
                         <?php   
                                  if (isset($permissionMap) && $permissionMap["user_management"] == "ENABLE") {
                                            echo " <li>
                              <a href='".site_url('customerusersmanagement/usermanagement')."' class='' id='settings'>
                              <i class='icon-user'></i>
                              User Management
                              </a>
                          </li>";
                                    } 
                                  ?> 
                          <li>
                              <a href=<?php echo site_url('customerdashboard/settings'); ?> class="" id="settings">
                              <i class="icon-wrench"></i>
                              Settings
                              </a>
                          </li>
                          <li>
                              <a href="index.html" class="" id="logout">
                              <i class="icon-off"></i>
                              <?php echo lang('log_out'); ?>
                              </a>
                          </li>
                         
                        </ul>
                      </div>
                        
                    </li>

                
                     <li class="">                       
                        
                        
                    </li>
                    
                </ul>
                
            </div><!--/.nav-collapse -->    
    
        </div> <!-- /container -->
        
    </div> <!-- /navbar-inner -->
    
</div> <!-- /navbar -->


<script type="text/javascript">
    

            


            $("#logout").click(function(){
               
              
               window.location.href = "<?php echo base_url();?>index.php/login/logout";

              

                    return false;
                
                });


</script>
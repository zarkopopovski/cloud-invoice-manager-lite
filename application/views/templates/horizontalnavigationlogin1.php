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
                    
                   

                    

                
                     <li class="">                       
                        <a href="index.html" class="" id="logout">
                            <i class="icon-chevron-left"></i>
                            <?php echo lang('sign_in'); ?>
                        </a>
                        
                    </li>
                    
                </ul>
                
            </div><!--/.nav-collapse -->    
    
        </div> <!-- /container -->
        
    </div> <!-- /navbar-inner -->
    
</div> <!-- /navbar -->


<script type="text/javascript">
    

            


            $("#logout").click(function(){
               
              
               window.location.href = "<?php echo base_url();?>index.php/login";

               // $.post("<?php echo base_url();?>index.php/login/logout",
               //  {"default_language":default_language, "default_currency":default_currency, "invoice_number":invoice_number, "tax_visible":tax_visible}).done(function(data) {
               //      if (data) {

               //          //console.log(data);

               //          var objectsData = JSON.parse(data);


               //          if (!objectsData.ERROR) {
               //              alert(objectsData.MESSAGE);
               //              window.location.href = "<?php echo base_url();?>index.php/customerdashboard";
               //          } else {
               //              alert(objectsData.MESSAGE);
               //          }
                        
               //      }
               //    },"json");

                    return false;
                
                });


</script>
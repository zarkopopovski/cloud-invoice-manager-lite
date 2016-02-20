
<link href="<?php echo base_url('assets/css/pages/signin.css') ?>" rel="stylesheet" type="text/css">

<div align="center" style="margin-top:200px">
	<h2><?php if(isset($message)) echo $message;?></h2>	
	<br/>
	<a href="<?= site_url('login') ?>">Go Back</a>
</div>

<script src="<?php echo base_url('assets/js/signin.js') ?>"></script>
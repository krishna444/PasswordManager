<div class="col-sm-offset-2">
	<h2 class="text-muted">Please Login</h2>
</div>
<?php echo form_open('admin','class="form-horizontal"');?>

<div class="form-group"> 
<?php
$attributes = array (
		'class' => 'col-sm-2 control-label' 
);
echo form_label ( 'Email Address:', 'email_address', $attributes );
?>
<div class='col-sm-4'>
<?php
echo form_input ('email_address', set_value ( 'email_address' ), 'id="email_address" class="form-control"' );
?>
</div>
</div>

<div class="form-group">
	
<?php
echo form_label ( 'Password:', 'password', $attributes );
?>
<div class='col-sm-4'>	
<?php
echo form_password ( 'password', '', 'id="password" class="form-control"' );
?>
</div>


</div>
<div class="form-group">
	<div class='col-sm-offset-2 col-sm-10'>
<?php

echo form_submit ( 'submit', 'Login', 'class="btn btn-success"' );
echo form_close ();
?>
</div>
</div>
<div class="alert alert-warning"><?php echo validation_errors();?></div>

</body>
</html>
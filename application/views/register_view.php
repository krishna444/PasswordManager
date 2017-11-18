<div class="col-sm-offset-2">
	<h1 class="text-muted">Registration</h1>
</div>
<?php echo form_open('user/register','class="form-horizontal"');?>

<div class="form-group">
<?php
$attributes = array (
		'class' => 'col-sm-2 control-label' 
);
echo form_label ( 'First Name:', '', $attributes );
?>
<div class='col-sm-4'>
<?php
echo form_input ( 'first_name', set_value ( 'first_name' ), 'id="first_name" class="form-control"' )?>
</div>
</div>

<div class="form-group">
<?php
echo form_label ( 'Last Name:', '', $attributes );
?>
<div class='col-sm-4'>
<?php
echo form_input ( 'last_name', set_value ( 'last_name' ), 'id="last_name" class="form-control"' )?>
</div>
</div>


<div class="form-group">
<?php
echo form_label ( 'Email Address:', '', $attributes );
?>
<div class="col-sm-4">
<?php
echo form_input ( 'email_address', set_value ( 'email_address' ), 'id="email_address" class="form-control"' )?>
</div>
</div>


<div class="form-group">
<?php
echo form_label ( 'Password:', '', $attributes );
?>
<div class="col-sm-4">
<?php
echo form_password ( 'password', '', 'id="password" class="form-control"' )?>
</div>
</div>
<div class="form-group">	
<?php
echo form_label ( 'Confirm Password:', '', $attributes );
?>
<div class="col-sm-4">
<?php
echo form_password ( 'password_confirm', '', 'id="password_confirm" class="form-control"' )?>
</div>
</div>


<div class="form-group">
	<div class='col-sm-offset-2 col-sm-10'>
<?php echo form_submit('submit','Register','class="btn btn-success"');?>
<?php echo form_close();?>
</div>
</div>
<div class="alert alert-warning"><?php echo validation_errors();?></div>
<div class="col-sm-offset-2">
	<h1 class="text-muted">Add New Password</h1>
</div>
<?php echo form_open('/passwords/create','class="form-horizontal"');?>

<div class="form-group">
<?php
$attributes = array (
		'class' => 'col-sm-2 control-label' 
);
echo form_label ( 'Service:', '', $attributes );
?>
<div class='col-sm-4'>
<?php
echo form_input ( 'service', set_value ( 'service' ), 'id="service" class="form-control"' )?>
</div>
</div>

<div class="form-group">
<?php
echo form_label ( 'User Name:', '', $attributes );
?>
<div class='col-sm-4'>
<?php
echo form_input ( 'user_name', set_value ( 'user_name' ), 'id="user_name" class="form-control"' )?>
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
echo form_label ( 'Remarks:', '', $attributes );
?>
<div class="col-sm-4">
<?php
echo form_input ( 'remarks', set_value('remarks'), 'id="remarks" class="form-control"' )?>
</div>
</div>

<div class="form-group">
	<div class='col-sm-offset-2 col-sm-10'>
<?php echo form_submit('submit','Add','class="btn btn-success"');?>
<?php echo form_close();?>
</div>
</div>
<div class="alert alert-warning"><?php echo validation_errors();?></div>

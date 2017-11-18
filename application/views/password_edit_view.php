<div class="col-sm-offset-2">
	<h1 class="text-muted">Edit Password Information</h1>
</div>
<?php echo form_open('/passwords/edit/'.$password->id,'class="form-horizontal"');?>

<div class="form-group">
<?php
$attributes = array (
		'class' => 'col-sm-2 control-label' 
);
echo form_label ( 'Service:', '', $attributes );
?>
<div class='col-sm-4'>
<?php
echo form_input ( 'service', $password->service, 'id="service" class="form-control" readonly="true"' )?>
</div>
</div>

<div class="form-group">
<?php
echo form_label ( 'User Name:', '', $attributes );
?>
<div class='col-sm-4'>
<?php
echo form_input ( 'user_name', $password->user_name, 'id="user_name" class="form-control"' )?>
</div>
</div>


<div class="form-group">
<?php
echo form_label ( 'Password:', '', $attributes );
?>
<div class="col-sm-4">
<?php
echo form_password ( 'password', '', 'id="password" class="form-control" placeholder="Provide new password"' )?>
</div>
</div>

<div class="form-group">
<?php
echo form_label ( 'Remarks:', '', $attributes );
?>
<div class="col-sm-4">
<?php
echo form_input ( 'remarks', $password->remarks, 'id="remarks" class="form-control"' )?>
</div>
</div>

<div class="form-group">
	<div class='col-sm-offset-2 col-sm-10'>
<?php echo form_submit('submit',$password->user_name==''?'Add':'Update','class="btn btn-success"');?>
<?php echo form_close();?>
</div>
</div>
<div class="alert alert-warning"><?php echo validation_errors();?></div>

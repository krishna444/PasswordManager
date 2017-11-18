<html lang="en">
<head>
<meta charset="UTF-8">
<title>Password Manager</title>
<link rel="stylesheet" type="text/css"
	href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
<?php if(session_status()==PHP_SESSION_NONE) session_start();?>
</head>
<body>
	<div class="container">
		<div class="page-header">
			<div class="text-right">
			<?php
			if (isset ( $_SESSION ['username'] )) {
				echo "Logged in as <strong>" . $_SESSION ['username'] . "</strong>. <a href='/admin/logout'>Logout</a>";
			} else {
				echo "<a href='/admin'>Log In</a>|<a href='/user/register'>Register</a>";
			}
			?>	
			</div>
		</div>	
<?php $this->load->view('header_view'); ?>
<?php $this->load->view('nav_view');?>

<?php if(isset($message)){?>
<div class="alert alert-success"><?php echo $message; ?></div><?php }?>
<?php if(isset($error)){?>
<div class="alert alert-warning"><?php echo $error;?></div><?php }?>
	
<?php

if (isset ( $view )) {
	$this->load->view ( $view );
}
$this->load->view ( 'footer_view' );
?>

</div>


</body>
</html>

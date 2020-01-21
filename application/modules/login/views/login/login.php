<?php 
//error_reporting(0);
	

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SBE - <?=PORTAL_NAME?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/AdminLTE/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/AdminLTE/dist/css/style.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/AdminLTE/plugins/iCheck/square/blue.css">

</head>
<body class="hold-transition login-page">
<div class="login-box">
	<div class="login-box-inner">
	  <div class="login-logo">
		<a href="index.php"><b><span>SBE</span></b> Canada Ltd.</a>
		<small class="sub_title">( <?=PORTAL_NAME?> )</small>
	  </div>
	  <!-- /.login-logo -->
	  <div class="login-box-body">
		<p class="login-box-msg">Sign in with your Artemis Credentials !</p>
		<?php if(isset($_GET['user_login']) && $_GET['user_login'] =='false'){ ?>
							<div class="alert alert-danger alert-dismissible">
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								<h4 style="margin-bottom: 0;font-size: 17px;font-weight: 500;"><i class="icon fa fa-ban"></i>Wrong username or password !</h4>
							</div>
		<?php } ?>
		<form action="login" method="post">
		  <div class="form-group has-feedback">
			<input type="text" class="form-control" name ="username" placeholder="Username" required >
			<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		  </div>
		  <div class="form-group has-feedback">
			<input type="password" class="form-control" name="password" placeholder="Password" required >
			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
		  </div>
		  <div class="row">
			<!-- /.col -->
			<div class="col-xs-4">
			  <input type="submit" value="Sign In" name="screen_login" class="btn btn-primary btn-block btn-flat"/>
			</div>
			<!-- /.col -->
		  </div>
		</form>

	  </div>
   </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->



</body>
</html>
<style>
.login-page {
    width: 100%;
    background: url(<?php echo base_url(); ?>assets/backend/AdminLTE/dist/img/bg.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    display: table;
}

.login-box{
	width:100%;
    vertical-align: middle;
    display: table-cell;
}
.login-box-inner {
    width: 360px;
    max-width: 100%;
   margin: 8% auto 0;
}
.login-logo a {
	color: #bfbfbf;
	font-weight:500;
}
.login-logo a b span{
	color: #f39c12;
	font-weight:600;
}
.sub_title {
    color: #5ea7d1;
    font-size: 20px;
    display: block;
    line-height: 1;
    font-weight: 500;
}
</style>

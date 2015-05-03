<!doctype html>
<html lang="en">
	<meta charset="utf-8" />
	
	<title><?php echo $title; ?></title>
	<meta type="description" content="" />
	
	<meta http-equiv="X-UA-Compatible" content="IE-edge" />
	<meta name="viewport" content="width=device-width, initial-scale=0.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/custom.css'); ?>">
	
	<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>
	
	<script>
	// Set path to site
	var site_url = '<?php echo base_url(); ?>';
	</script>
	
	<script src="<?php echo base_url('assets/js/management.js'); ?>"></script>
</head>
<body>

	<nav class="navbar navbar-inverse" role="navigation">
	  <div class="container-fluid">

		<div class="navbar-header">
		  <a class="navbar-brand" href="<?php echo base_url('admin'); ?>">ABC Fleet Management</a>
		</div>
		
		<ul class="nav navbar-nav">
			<li>
				<a href="<?php echo base_url('/'); ?>"><span class="glyphicon glyphicon-home"></span> View site</a>
			</li>
		</ul>

		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, <strong><?php echo $logged->email; ?></strong> <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="<?php echo base_url('admin/user/'.$logged->user_id); ?>">Edit Profile</a></li>
					<li class="divider"></li>
					<li><a href="<?php echo base_url('logout'); ?>">Logout</a></li>
				</ul>
			</li>
		</ul>
		  
	  </div>
	</nav>
		
	<div class="container-fluid">
		<!-- row -->
		<div class="row">		
			<div class="col-sm-3">
				<div class="list-group">
				  <a class="list-group-item" href="<?php echo base_url('admin'); ?>">Dashboard</a></li>
				  <a class="list-group-item" href="<?php echo base_url('admin/users'); ?>">Manage Users</a>
				  <a class="list-group-item" href="<?php echo base_url('admin/cars'); ?>">Manage Cars</a>
				  <a class="list-group-item" href="<?php echo base_url('admin/enquiries'); ?>">Enquiries</a>
				  <a class="list-group-item" href="<?php echo base_url('admin/orders'); ?>">Orders</a>
				</div>
			</div>
			
			<div class="col-sm-9">
				<ol class="breadcrumb">
					<?php foreach ($breadcrumb as $crumb=> $crumb_link) { ?>
					<li><a href="<?php echo $crumb_link; ?>"><?php echo $crumb; ?></a></li>
					<?php } ?>
				</ol>
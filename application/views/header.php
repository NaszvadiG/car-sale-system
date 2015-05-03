<!doctype html>
<html lang="en">
	<meta charset="utf-8" />
	
	<title><?php echo $title; ?></title>
	<meta type="description" content="" />
	
	<meta http-equiv="X-UA-Compatible" content="IE-edge" />
	<meta name="viewport" content="width=device-width, initial-scale=0.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/site-custom.css'); ?>">
	
	<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.cycle2.min.js'); ?>"></script>
	
	<script>
	// Set path to site
	var site_url = '<?php echo base_url(); ?>';
	</script>
	
	<script src="<?php echo base_url('assets/js/abcfleet.js'); ?>"></script>
</head>
<body>

	<nav class="navbar navbar-default" role="navigation">
	  <div class="container">

		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo base_url('/'); ?>">ABC Car Fleet</a>
		</div>
		
		<!-- collapsable -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a href="<?php echo base_url('/'); ?>">Home</a></li>
				<li><a href="<?php echo base_url('browse'); ?>">Browse cars for sale</a></li>
				<li><a href="<?php echo base_url('about'); ?>">About us</a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<?php if ($logged == false) { ?>
				
				<li><a href="<?php echo base_url('login'); ?>" title="">Log In</a></li>
				<li><a href="<?php echo base_url('register'); ?>">Register</a></li>
				
				<?php } else { ?>
				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, <strong><?php echo $logged->email; ?></strong> <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
					
						<?php if ($logged->role_id <= 2) {
							echo '<li><a href="'.base_url('admin').'">Administration panel</a></li>';
						} 
						?>
						
						<li><a href="<?php echo base_url('logout'); ?>">Logout</a></li>
					</ul>
				</li>
				
				<?php } ?>
			</ul>
		</div>
		<!-- end collapse -->
		  
	  </div>
	</nav>
	
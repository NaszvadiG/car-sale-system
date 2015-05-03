	<div class="browse-cars">
		<div class="container text-center">
			<h1>Log In</h1>
			
			<p><a href="<?php echo base_url('register'); ?>" title="Register">Not a member yet? Register now</a></p>
		</div>
	</div>
	
	
	<div class="container content">
		<section>
			
			<!-- form -->
			<div class="center-block">
				<form id="login-form" method="post" role="form">
					<div class="form-group">
						<label for="email">Email address</label>
						<input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
					</div>
					
					<div class="form-group">
						<label for="exampleInputPassword1">Password</label>
						<input type="password" name="password" class="form-control" id="password" placeholder="Password">
					</div>
					
					<!--<div class="checkbox">
						<label>
							<input type="checkbox"> Remember me?
						</label>
					</div>-->
					
					<button type="submit" class="btn btn-primary">Log In</button>
				</form>
			</div>
			<!-- form -->
			
		</section>
	</div>
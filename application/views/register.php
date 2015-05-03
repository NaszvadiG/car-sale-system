	<div class="browse-cars">
		<div class="container text-center">
			<h1>Register</h1>
			
			<p><a href="<?php echo base_url('login'); ?>" title="Log In">Already a member? Log In</a></p>
		</div>
	</div>
	
	
	<div class="container content">
		<section>
			
			<!-- form -->
			<div class="center-block">
				<form id="register-form" method="post" role="form">
					<div class="form-group">
						<label for="email">Email address</label>
						<input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
					</div>
					
					<div class="form-group">
						<label for="exampleInputPassword1">Password</label>
						<input type="password" name="password" class="form-control" id="password" placeholder="Password">
					</div>
					
					<div class="form-group">
						<label for="exampleInputPassword1">Confirm Password</label>
						<input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm Password">
					</div>
					
					<button type="submit" class="btn btn-primary">Register</button>
				</form>
			</div>
			<!-- form -->
			
		</section>
	</div>
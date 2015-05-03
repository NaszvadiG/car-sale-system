<h3>User Details</h3>

<?php if (!empty($form_message)) { ?>
	<div class="alert alert-success" role="alert"><?php echo $form_message; ?></div>
<?php } ?>


<form class="form-horizontal" id="user-form" method="post" role="form">
	<div class="row">
		<div class="col-sm-6">

			<h4>Personal details</h4>
		
			<div class="form-group">
				<label for="" class="col-sm-4 control-label">Email</label>
				
				<div class="col-sm-8">
					<?php if ($is_user == true) { ?>
					<input class="form-control" name="email" value="<?php echo (is_object($user)) ? $user->email : ''; ?>" type="text" disabled>
					<?php } else { ?>
					<input class="form-control" name="email" value="" type="text" placeholder="email">
					<?php } ?>
				</div>
			</div>

			<div class="form-group">
				<label for="role_id" class="col-sm-4 control-label">Role</label>
				
				<div class="col-sm-8">
					<?php echo $role_select; ?>
				</div>
			</div>
			
			<div class="form-group">
				<label for="" class="col-sm-4 control-label">Password</label>
				
				<div class="col-sm-8">
					<input class="form-control" name="password" type="password" placeholder="Password">
				</div>
			</div>
			
			<div class="form-group">
				<label for="" class="col-sm-4 control-label">Confirm password</label>
				
				<div class="col-sm-8">
					<input class="form-control" name="confirm_password" type="password" placeholder="Confirm password">
				</div>
			</div>
			
			<?php if ($is_user == true) { ?>
			
			<h4>Profile</h4>
			
			<div class="form-group">
				<label for="" class="col-sm-4 control-label">First name</label>
				
				<div class="col-sm-8">
					<input class="form-control" name="first_name" type="text" value="<?php echo (is_object($user)) ? $user->first_name : ''; ?>" placeholder="First name">
				</div>
			</div>
			
			<div class="form-group">
				<label for="" class="col-sm-4 control-label">Last name</label>
				
				<div class="col-sm-8">
					<input class="form-control" name="last_name" type="text" value="<?php echo (is_object($user)) ? $user->last_name : ''; ?>" placeholder="Last name">
				</div>
			</div>
			
			<div class="form-group">
				<label for="" class="col-sm-4 control-label">Phone no.</label>
				
				<div class="col-sm-6">
					<input class="form-control" name="phone" type="text"  value="<?php echo (is_object($user)) ? $user->phone : ''; ?>" placeholder="Phone no.">
				</div>
			</div>
			
			<div class="form-group">
				<label for="" class="col-sm-4 control-label">Mobile no.</label>
				
				<div class="col-sm-6">
					<input class="form-control" name="mobile_no" type="text" value="<?php echo (is_object($user)) ? $user->mobile_no : ''; ?>" placeholder="Mobile no.">
				</div>
			</div>
			
			
			<h4>Address</h4>
			
			<div class="form-group">
				<label for="" class="col-sm-4 control-label">Unit no.</label>
				
				<div class="col-sm-3">
					<input class="form-control" name="unit_no" type="text" value="<?php echo (is_object($user)) ? $user->unit_no : ''; ?>" placeholder="0">
				</div>
			</div>
			
			<div class="form-group">
				<label for="" class="col-sm-4 control-label">Street no.</label>
				
				<div class="col-sm-3">
					<input class="form-control" name="street_no" type="text" value="<?php echo (is_object($user)) ? $user->street_no : ''; ?>" placeholder="0">
				</div>
			</div>
			
			<div class="form-group">
				<label for="" class="col-sm-4 control-label">Address</label>
				
				<div class="col-sm-8">
					<input class="form-control" name="address" type="text" value="<?php echo (is_object($user)) ? $user->address : ''; ?>" placeholder="Address/Street name">
				</div>
			</div>

			<div class="form-group">
				<label for="" class="col-sm-4 control-label">City</label>
				
				<div class="col-sm-4">
					<input class="form-control" name="city" type="text" value="<?php echo (is_object($user)) ? $user->city : ''; ?>" placeholder="City">
				</div>
			</div>
			
			<div class="form-group">
				<label for="" class="col-sm-4 control-label">State</label>
				
				<div class="col-sm-4">
					<select class="form-control" name="state">
						<option value="0" disabled selected style="display: none;">Select state</option>
						<option value="nsw">NSW</option>
						<option value="nt">NT</option>
						<option value="qld">QLD</option>
						<option value="sa">SA</option>
						<option value="tas">TAS</option>
						<option value="wa">WA</option>
						<option value="vic">VIC</option>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label for="" class="col-sm-4 control-label">Postcode</label>
				
				<div class="col-sm-4">
					<input class="form-control" name="postcode" type="text" value="<?php echo (is_object($user)) ? $user->postcode : ''; ?>" placeholder="Postcode">
				</div>
			</div>

			
			<?php }?>
			
			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-8 text-right">
					<button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
				</div>
			</div>
		
		</div>
	</div>
</form>
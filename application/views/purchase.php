		<div class="container content">
		
			<h3>Purchasing "<?php echo $car->year.' '.$car->make_name.' '.$car->model_name; ?>"</h3>
			
			<ol class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li>Purchase</li>
				<li><?php echo $car->year.' '.$car->make_name.' '.$car->model_name; ?></li>
			</ol>
		
			<!-- purchase form -->
			<form id="purchase-form" method="post" role="form">
				<div class="col-sm-4 car-details">
					<h4>Car details review</h4>
					
					<div class="row">
						<label class="col-sm-5 control-label">Price</label>
						<div class="col-sm-7">
							$<?php echo number_format($car->price); ?>
						</div>
					</div>
					
					<div class="row">
						<label class="col-sm-5 control-label">Make</label>
						<div class="col-sm-7">
							<?php echo $car->make_name; ?>
						</div>
					</div>
					
					<div class="row">
						<label class="col-sm-5 control-label">Model</label>
						<div class="col-sm-7">
							<?php echo $car->model_name; ?>
						</div>
					</div>
					
					<div class="row">
						<label class="col-sm-5 control-label">Year</label>
						<div class="col-sm-7">
							<?php echo $car->year; ?>
						</div>
					</div>
					
					<div class="row">
						<label class="col-sm-5 control-label">Transmission</label>
						<div class="col-sm-7">
							<?php echo $car->transmission; ?>
						</div>
					</div>
					
					<div class="row">
						<label class="col-sm-5 control-label">Engine</label>
						<div class="col-sm-7">
							<?php echo $car->cylinders; ?> cyl
						</div>
					</div>
					
					<div class="row">
						<label class="col-sm-5 control-label">Body</label>
						<div class="col-sm-7">
							<?php echo $car->body_name; ?>
						</div>
					</div>
					
					<div class="row">
						<label class="col-sm-5 control-label">Condition</label>
						<div class="col-sm-7">
							<?php echo $car->condition; ?>
						</div>
					</div>
					
					<div class="row">
						<label class="col-sm-5 control-label">Odometre</label>
						<div class="col-sm-7">
							<?php echo $car->mileage; ?> kms
						</div>
					</div>
				</div>
				
				<div class="col-sm-8">
				
					<h4>Personal details</h4>
				
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">					
								<label for="first_name" class="control-label">First name</label>
								<input class="form-control" name="first_name" value="<?php echo $user->first_name; ?>" type="text" placeholder="First name">
							</div>
						</div>
						
						<div class="col-sm-6">
							<div class="form-group">					
								<label for="last_name" class="control-label">Last name</label>
								<input class="form-control" name="last_name" value="<?php echo $user->last_name; ?>" type="text" placeholder="First name">
							</div>
						</div>
					</div>
					
					
					<h4>Contact details</h4>
					
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">					
								<label for="phone" class="control-label">Phone</label>
								<input class="form-control" name="phone" value="<?php echo $user->phone; ?>" type="text" placeholder="Phone number">
							</div>
						</div>
						
						<div class="col-sm-6">
							<div class="form-group">					
								<label for="mobile_no" class="control-label">Mobile</label>
								<input class="form-control" name="mobile_no" value="<?php echo $user->mobile_no; ?>" type="text" placeholder="Mobile number">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">					
								<label for="email" class="control-label">Email</label>
								<input class="form-control" name="email" value="<?php echo $user->email; ?>" type="text" placeholder="Email">
							</div>
						</div>
					</div>
					
					
					<h4>Address</h4>
					
					<div class="row">
						<div class="col-sm-2">
							<div class="form-group">					
								<label for="unit_no" class="control-label">Unit no</label>
								<input class="form-control" name="unit_no" value="<?php echo $user->unit_no; ?>" type="text" placeholder="0">
							</div>
						</div>
						
						<div class="col-sm-2">
							<div class="form-group">					
								<label for="street no" class="control-label">Street No</label>
								<input class="form-control" name="street_no" value="<?php echo $user->street_no; ?>" type="text" placeholder="0">
							</div>
						</div>
						
						<div class="col-sm-8">
							<div class="form-group">					
								<label for="address" class="control-label">Address</label>
								<input class="form-control" name="address" value="<?php echo $user->address; ?>" type="text" placeholder="Address">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-5">
							<div class="form-group">					
								<label for="city" class="control-label">City</label>
								<input class="form-control" name="city" value="<?php echo $user->city; ?>" type="text" placeholder="City">
							</div>
						</div>
						
						<div class="col-sm-4">
							<div class="form-group">					
								<label for="state" class="control-label">State</label>
								
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
						
						<div class="col-sm-3">
							<div class="form-group">					
								<label for="postcode" class="control-label">Postcode</label>
								<input class="form-control" name="postcode" value="<?php echo $user->postcode; ?>" type="text" placeholder="Postcode">
							</div>
						</div>
					</div>
					
					
					<h4>Payment</h4>

					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">					
								<label class="control-label">Payment type</label>
								
								<label for="visa" class="card visa">
									<input type="radio" name="payment_type" id="visa" value="visa" checked> <span>Visa</span>
								</label>
								
								<label for="mastercard" class="card mastercard">
									<input type="radio" name="payment_type" id="mastercard" value="mastercard"> <span>Mastercard</span>
								</label>
								
								<label for="amex" class="card amex">
									<input type="radio" name="payment_type" id="amex" value="amex"> <span>American Express</span>
								</label>
							</div>
						</div>
					</div>
						
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">					
								<label for="credit_card_no" class="control-label">Credit card number</label>
								<input class="form-control" name="credit_card_no" value="" type="text" placeholder="Credit card number">
							</div>
						</div>
						
						<div class="col-sm-6">
							<div class="form-group">					
								<label for="card_holder" class="control-label">Card holder's name</label>
								<input class="form-control" name="card_holder" value="" type="text" placeholder="eg. Jeffery T Nielsen">
							</div>
						</div>
					</div>
					
					<div class="row">					
						<div class="col-sm-2">
							<div class="form-group">					
								<label for="csc" class="control-label">CSC</label>
								<input class="form-control" name="csc" value="" type="text" placeholder="CSC">
							</div>
						</div>
					</div>
					
					
					<h4>Agreements</h4>

					<div class="row">	
						<div class="col-sm-12">	
							<p>
								<input type="checkbox" id="agree_1" name="agree_1"> <label for="agree_1">I agree that I have reviewed my details and the details of the car I am purchasing.</label>
							</p>
							
							<p>
								<input type="checkbox" id="agree_2" name="agree_2"> <label for="agree_2">I agree to the <a href="">terms &amp; conditions.</label>
							</p>
						</div>
					</div>
					
					
					<div class="row button-wrap">
						<button type="submit" class="btn btn-success btn-lg btn-block">Send</button>
					</div>
				
				</div>
			</form>
			<!-- end purchase form -->
				
		</div>
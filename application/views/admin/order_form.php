	<h3>Order Details #<?php echo $order->order_id; ?></h3>

	<?php if (!empty($form_message)) { ?>
		<div class="alert alert-success" role="alert"><?php echo $form_message; ?></div>
	<?php } ?>


	<div class="row">
		<div class="col-sm-6">
			<h4>Car details review</h4>

			<div class="row form-group">
				<label for="" class="col-sm-4 control-label">Car id</label>
				
				<div class="col-sm-8">
					<a href="<?php echo base_url('admin/car/'.$car->car_id); ?>">#<?php echo $car->car_id; ?> <?php echo $car->year.' '.$car->make_name.' '.$car->model_name; ?></a>
				</div>
			</div>

			<div class="row form-group">
				<label for="" class="col-sm-4 control-label">Price</label>
				
				<div class="col-sm-8">
					$<?php echo number_format($car->price); ?>
				</div>
			</div>

			<div class="row form-group">
				<label for="" class="col-sm-4 control-label">Purchase date</label>
				
				<div class="col-sm-8">
					<?php echo $order->created_at; ?>
				</div>
			</div>

		</div>
	</div>


	<form class="form-horizontal" id="order-form" method="post" role="form">
		<div class="row">
			<div class="col-sm-6">
			
				<h4>Personal details</h4>
				
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">First name</label>
					
					<div class="col-sm-8">
						<input class="form-control" name="first_name" type="text" value="<?php echo $order->first_name; ?>" placeholder="First name">
					</div>
				</div>
				
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Last name</label>
					
					<div class="col-sm-8">
						<input class="form-control" name="last_name" type="text" value="<?php echo $order->last_name; ?>" placeholder="Last name">
					</div>
				</div>
				
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Phone</label>
					
					<div class="col-sm-8">
						<input class="form-control" name="phone" type="text"  value="<?php echo $order->phone; ?>" placeholder="Phone">
					</div>
				</div>
				
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Mobile no.</label>
					
					<div class="col-sm-8">
						<input class="form-control" name="mobile_no" type="text" value="<?php echo $order->mobile_no; ?>" placeholder="Mobile no">
					</div>
				</div>

				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Email</label>
					
					<div class="col-sm-8">
						<input class="form-control" name="email" type="text" value="<?php echo $order->email; ?>" placeholder="Email">
					</div>
				</div>


				<h4>Address</h4>

				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Unit no</label>
					
					<div class="col-sm-3">
						<input class="form-control" name="unit_no" type="text" value="<?php echo $order->unit_no; ?>" placeholder="Unit no">
					</div>
				</div>
				
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Street no</label>
					
					<div class="col-sm-3">
						<input class="form-control" name="street_no" type="text" value="<?php echo $order->street_no; ?>" placeholder="Street no">
					</div>
				</div>
				
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Address</label>
					
					<div class="col-sm-8">
						<input class="form-control" name="address" type="text"  value="<?php echo $order->address; ?>" placeholder="Address">
					</div>
				</div>
				
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">City</label>
					
					<div class="col-sm-8">
						<input class="form-control" name="city" type="text" value="<?php echo $order->city; ?>" placeholder="City">
					</div>
				</div>

				<div class="form-group">
					<label for="" class="col-sm-4 control-label">State</label>
					
					<div class="col-sm-8">
						<input class="form-control" name="state" type="text" value="<?php echo $order->state; ?>" placeholder="State">
					</div>
				</div>

				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Postocde</label>
					
					<div class="col-sm-4">
						<input class="form-control" name="postcode" type="text" value="<?php echo $order->postcode; ?>" placeholder="Postcode">
					</div>
				</div>


				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8 text-right">
						<button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
					</div>
				</div>
			
			</div>
		</div>
	</form>
	<div class="container content">
		<div class="row">
		
		<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li><a href="#">Back to results</a></li>
			<li><?php echo $car->year.' '.$car->make_name.' '.$car->model_name; ?></li>
		</ol>
		
			<!-- sidebar -->
			<div class="col-sm-3">
				<?php if ($logged == false) { ?>
				
				<div class="form-access">
					<h4>Interest in buying</h4>
					
					<h5> - or - </h5>
					
					<h4>Want to enquire?</h4>
					
					<p>
						<i>You'll need to <a href="<?php echo base_url('login'); ?>" title="Already have an account?">login</a> or 
						<a href="<?php echo base_url('register'); ?>" title="Need to register?">register</a> first.</i>
					</p>
				</div>
				
				<?php } else { ?>
				
				<form id="enquire-form" action="<?php echo base_url('home/enquire'); ?>" method="post" role="form">
					<input type="hidden" name="car_id" value="<?php echo $car->car_id; ?>">
					<div class="form-group">
						<strong>Enquire/Booking</strong>
					</div>
					
					<div class="form-group">
						<input class="form-control" name="fullname" type="text" value="" placeholder="Full name">
					</div>
					
					<div class="form-group">
						<input class="form-control" name="email" type="text" value="" placeholder="Email">
					</div>
					
					<div class="form-group">
						<input class="form-control" name="phone" type="text" value="" placeholder="Phone">
					</div>
					
					<div class="form-group">
						<select class="form-control" name="subject">
							<option value="enquiry">I am making an Enquiry</option>
							<option value="booking">I am making a Booking</option>
						</select>
					</div>
					
					<div class="form-group">
						<textarea class="form-control" name="message" rows="6"></textarea>
					</div>
					
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-info-sign"></span> Send</button>
					</div>
				</form>
				<?php } ?>
			</div>
			<!-- end sidebar -->

			<!-- car details -->
			<div class="col-sm-9">
				<div class="section-header">
					<h4><?php echo $car->year.' '.$car->make_name.' '.$car->model_name; ?></h4>
				</div>
				
				<div class="row">
					<div class="col-sm-8">
						<div class="car-slideshow">
							<div class="slide-container">
							<?php 
							foreach ($car_images as $image) {
								echo '<img src="'.base_url('assets/uploads/'.$image->file).'" alt="">';
							}
							?>
							</div>
							
							<a class="prev" href="#">Prev</a>
							<a class="next" href="#">Next</a>
						</div>
						
						<div class="pager"></div>
					</div>
					
					<div class="col-sm-4">
						<?php if ($logged == true) { ?>
						<div class="place-order">
							<a href="<?php echo base_url('purchase/'.$car->car_id); ?>" class="btn btn-success btn-block btn-lg" title="Place an order"></span> Purchase</a>
						</div>
						<?php } ?>
						
						<h3>$<?php echo number_format($car->price); ?></h3>
						<p><?php echo $car->transmission; ?></p>
						<p><?php echo $car->cylinders; ?>cyl</p>
						<p><?php echo $car->body_name; ?></p>
						<p><?php echo number_format($car->mileage); ?> km</p>
					</div>
				</div>
				
				<div class="panel panel-default car-information">
					<div class="panel-heading">Extra information</div>
					<div class="panel-body">
						<?php 
						if (!empty($car->description)) {
							echo $car->description; 
						} else {
							echo '<i>no information</i>';
						}
						?>
					</div>
				</div>
			</div>
			<!-- end details -->
		
		</div>
	</div>
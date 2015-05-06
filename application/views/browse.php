	<div class="browse-cars">
		<div class="container text-center">
			<h1>Browse cars for sale</h1>	
		</div>
	</div>	
	
	<div class="container content">
		<div class="row">
		
			<!-- filter -->
			<div class="col-sm-3">
				<div class="text-right">
					<a href="<?php echo base_url('browse'); ?>" title="clear fields">clear</a>
				</div>

				<form action="<?php echo base_url('browse'); ?>" method="post" role="form">
					<div class="form-group">
						<?php echo $select_make; ?>
					</div>
					
					<div class="form-group">
						<input type="hidden" name="selected_model" value="<?php echo $car_model_id; ?>">
						<select class="form-control" name="car_model_id" id="car_model">
							<option value="0">All models</option>
							<option value="0" disabled selected style="display: none;">Select Model</option>
						</select>
					</div>
					
					<div class="form-group">
						<input class="form-control" name="min_year" type="text" value="<?php echo $min_year; ?>" placeholder="Min Year">
					</div>
					
					<div class="form-group">
						<input class="form-control" name="max_year" type="text" value="<?php echo $max_year; ?>" placeholder="Max Year">
					</div>
					
					<div class="form-group">
						<?php echo $select_transmission; ?>
					</div>
					
					<div class="form-group">
						<?php echo $select_bodies; ?>
					</div>
					
					<div class="form-group">
						<?php echo $select_cylinders; ?>
					</div>
					
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">$</div>
							<input class="form-control" name="min_price" type="text" value="<?php echo $min_price; ?>" placeholder="Min Price">
						</div>
					</div>
					
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">$</div>
							<input class="form-control" name="max_price" type="text" value="<?php echo $max_price; ?>" placeholder="Max Price">
						</div>
					</div>
					
					<div class="form-group">
						<input class="form-control" name="min_mileage" type="text" value="<?php echo $min_mileage; ?>" placeholder="Min Mileage">
					</div>
					
					<div class="form-group">
						<input class="form-control" name="max_mileage" type="text" value="<?php echo $max_mileage; ?>" placeholder="Max Mileage">
					</div>
					
					<div class="form-group">
						<input class="form-control" name="colour" type="text" value="<?php echo $colour; ?>" placeholder="Colour">
					</div>
					
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">Show cars</button>
					</div>
				</form>
			</div>
			<!-- end filter -->
			
			
			<!-- results -->
			<div class="col-sm-9">
				<div class="section-header">
					<h4>Results</h4>
				</div>
				
				<?php 
				// If no no results, then show message
				// Otherwise show results in else
				if (count($cars) < 1) {
					echo '<div class="row result"><div class="col-sm-12">No results</div></div>';
				} 
				else {
					foreach ($cars as $car) { 
				?>
				
				<div class="row result">
					<div class="col-sm-3">
						<a href="<?php echo base_url('browse/car/'.$car->car_id); ?>" class="thumbnail">
							<span style="display: block; background: #efefef; width: 100%; height: 120px; overflow: hidden;">
								<?php 
								if (! empty($car->file)) {
								echo '<img src="'.base_url('assets/uploads/'.$car->file).'" alt="'.$car->file.'" style="max-height: 120px;">';
								} else {
									echo  '';
								}
								?>
							</span>
						</a>
					</div>
					<div class="col-sm-9">
						<h4><a href="<?php echo base_url('browse/car/'.$car->car_id); ?>"><?php echo $car->year.' '.$car->make_name.' '.$car->model_name; ?></a></h4>
						
						<div class="row">
							<div class="col-sm-12">
								<p><strong>$<?php echo $car->price; ?></strong></p>
							</div>
							
							<div class="col-sm-6">
								<p><?php echo $car->body_name; ?></p>
								<p><?php echo $car->cylinders; ?>cyl</p>
							</div>	
							<div class="col-sm-6">
								<p><?php echo $car->transmission; ?></p>
								<p><?php echo number_format($car->mileage); ?> km</p>
							</div>
						</div>
					</div>
				</div>
				
				<?php 
					}
				} 
				?>
				
			</div>
			<!-- results -->
		
		</div>
	</div>
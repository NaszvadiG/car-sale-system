	<div class="browse-cars">
		<div class="container text-center">
			<h1>Browse cars for sale</h1>	
		</div>
	</div>	
	
	<div class="container content">
		<div class="row">
		
			<!-- filter -->
			<div class="col-sm-3">
				<form action="<?php echo base_url('browse'); ?>" method="post" role="form">
					<div class="form-group">
						<select class="form-control" name="car_make" id="car_make">
							<option value="0" disabled selected style="display: none;">Select Make</option>
							<option value="">All makes</option>
						<?php 
						foreach ($car_makes as $make) {
							echo '<option value="'.$make->car_make_id.'">'.$make->make_name.'</option>';
						}
						?>
						</select>
					</div>
					
					<div class="form-group">
						<select class="form-control" name="car_model" id="car_model">
							<option value="">All models</option>
							<option value="0" disabled selected style="display: none;">Select Model</option>
						</select>
					</div>
					
					<div class="form-group">
						<input class="form-control" name="min_year" type="text" value="<?php echo $field_min_year; ?>" placeholder="Min Year">
					</div>
					
					<div class="form-group">
						<input class="form-control" name="max_year" type="text" value="<?php echo $field_max_year; ?>" placeholder="Max Year">
					</div>
					
					<div class="form-group">
						<select class="form-control" name="transmission">
							<option value="" disabled selected style="display: none;">Transmission</option>
							<option value="">All transmissions</option>
							<option value="automatic">Automatic</option>
							<option value="manual">Manual</option>
						</select>
					</div>
					
					<div class="form-group">
						<select class="form-control" name="car_body">
							<option value="" disabled selected style="display: none;">Body type</option>
							<option value="">All Body types</option>
							<?php 
							foreach ($car_bodies as $body) {
								echo '<option value="'.$body->car_body_id.'">'.$body->body_name.'</option>';
							}
							?>
						</select>
					</div>
					
					<div class="form-group">
						<select class="form-control" name="cylinders">
							<option value="" disabled selected style="display: none;">Cylinders</option>
							<option value="">All Cylinders</option>
							<?php 
							foreach ($car_cylinders as $cyl) {
								echo '<option value="'.$cyl->car_cyl_id.'">'.$cyl->cylinders.'</option>';
							}
							?>
						</select>
					</div>
					
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">$</div>
							<input class="form-control" name="min_price" type="text" placeholder="Min Price">
						</div>
					</div>
					
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">$</div>
							<input class="form-control" name="max_price" type="text" placeholder="Max Price">
						</div>
					</div>
					
					<div class="form-group">
						<input class="form-control" name="min_mileage" type="text" placeholder="Min Mileage">
					</div>
					
					<div class="form-group">
						<input class="form-control" name="max_mileage" type="text" placeholder="Max Mileage">
					</div>
					
					<div class="form-group">
						<input class="form-control" name="colour" type="text" placeholder="Colour">
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
		
		<div class="row">
			<div class="col-sm-offset-3 col-sm-9 text-center">
			
			<ul class="pagination">
			  <li><a href="#">&laquo;</a></li>
			  <li><a href="#">1</a></li>
			  <li><a href="#">&raquo;</a></li>
			</ul>
			
			</div>
		</div>
	</div>
	<div class="browse-cars">
		<div class="container">
			<h4>Quick search</h4>
			
			<form class="form-horizontal" action="<?php echo base_url('browse'); ?>" method="post" id="quick-browse">
			
				<div class="form-group">
					<div class="col-sm-6">
						<select class="form-control" name="car_make_id" id="car_make">
							<option value="0" disabled selected style="display: none;">Select Make</option>
						<?php 
						foreach ($car_makes as $make) {
							echo '<option value="'.$make->car_make_id.'">'.$make->make_name.' ('.$make->count.')</option>';
						}
						?>
						</select>
					</div>
					
					<div class="col-sm-6">
						<select class="form-control" name="car_model_id" id="car_model">
							<option value="0" disabled selected style="display: none;">Select Model</option>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-6">
						<input class="form-control" name="min_price" type="text" placeholder="Min price">
					</div>
					
					<div class="col-sm-6">
						<input class="form-control" name="max_price" type="text" placeholder="Max price">
					</div>
				</div>
				
				<div class="form-group">
					<div class="text-center">
						<button type="submit" class="btn btn-primary">Search</button>
					</div>
				</div>

			</form>
			
		</div>
	</div>
	
	
	<div class="container content">
		<section>
			<div class="section-header">
				<h2>Newest cars for sale</h2>
			</div>
			
			<?php foreach ($cars as $car) { ?>
				<div class="row result">
					<div class="col-sm-2">
						<a href="#" class="thumbnail">
							<span style="display: block; background: #efefef; width: 100%; overflow: hidden; height: 120px;">
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
					<div class="col-sm-10">
						<h4><a href="<?php echo base_url('browse/car/'.$car->car_id); ?>" title="View car details"><?php echo $car->year.' '.$car->make_name.' '.$car->model_name; ?></a></h4>
						
						<div class="row">
							<div class="col-sm-4">
								<p>Price: $<?php echo $car->price; ?></p>
							</div>
							<div class="col-sm-8">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed aliquam orci. Donec at nunc porttitor, semper sem sed, ornare odio. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc vulputate malesuada dignissim.</p>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>

		</section>
	</div>
<h3>Car</h3>

<?php if (!empty($form_message)) { ?>
	<div class="alert alert-success" role="alert"><?php echo $form_message; ?></div>
<?php } ?>


<form class="form-horizontal" id="car-form" method="post" enctype="multipart/form-data" role="form">
	
	<div class="row">
		<div class="col-sm-8">
		
			<h4>Car Details</h4>
			
			<!-- Car Deteails -->
			<div class="input-form">
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Make and model</label>
					
					<div class="col-sm-4">
						<?php echo form_dropdown('car_make', $car_makes, (is_object($car)) ? $car->car_make_id : '', 'class="form-control" id="car_make"'); ?>
					</div>
					
					<div class="col-sm-4">
						<select class="form-control" name="car_model" id="car_model">
							<option value="0" disabled selected style="display: none;">Select Model</option>
						</select>

						<input type="hidden" name="selected_model" value="<?php echo (is_object($car)) ? $car->car_model_id : ''; ?>">
					</div>
				</div>
				
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Year</label>
					
					<div class="col-sm-8">
						<input class="form-control" name="year" type="text" value="<?php echo (is_object($car)) ? $car->year : ''; ?>" placeholder="YYYY">
					</div>
				</div>
				
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Transmission</label>
					
					<div class="col-sm-8">
						<?php echo form_dropdown('transmission', $transmission, (is_object($car)) ? $car->transmission : '', 'class="form-control"'); ?>
					</div>
				</div>
				
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Body type</label>
					
					<div class="col-sm-8">
						<?php echo form_dropdown('car_body', $car_bodies, (is_object($car)) ? $car->car_body_id : '', 'class="form-control"'); ?>
					</div>
				</div>
				
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Cylinders</label>
					
					<div class="col-sm-8">
						<?php echo form_dropdown('car_cyl', $car_cylinders, (is_object($car)) ? $car->car_cyl_id : '', 'class="form-control"'); ?>
					</div>
				</div>
				
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Price</label>
					
					<div class="col-sm-8">
						<div class="input-group">
							<div class="input-group-addon">$</div>
							<input class="form-control" name="price" type="text" value="<?php echo (is_object($car)) ? $car->price : ''; ?>" placeholder="Price">
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Mileage</label>
					
					<div class="col-sm-8">
						<div class="input-group">
							<input class="form-control" name="mileage" type="text" value="<?php echo (is_object($car)) ? $car->mileage : ''; ?>" placeholder="Mileage">
							<div class="input-group-addon">KM</div>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Condition</label>
					
					<div class="col-sm-8">
						<input class="form-control" name="condition" type="text" value="<?php echo (is_object($car)) ? $car->condition : ''; ?>" placeholder="Condition">
					</div>
				</div>
				
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Colour</label>
					
					<div class="col-sm-8">
						<input class="form-control" name="colour" type="text" value="<?php echo (is_object($car)) ? $car->colour : ''; ?>" placeholder="Colour">
					</div>
				</div>		
			</div>
			<!-- end Car Deteails -->
		
	
			<!-- Title and description -->
			<h4>Title &amp; Description</h4>
		
			<div class="input-form">	
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Title <i>optional</i></label>
					
					<div class="col-sm-8">
						<input class="form-control" name="title" type="text" placeholder="Title">
					</div>
				</div>
			
				<div class="form-group">
					<div class="col-sm-12">
						<label for="" class="control-label block-label">Description</label>
						<textarea class="form-control" name="description" rows="5"><?php echo (is_object($car)) ? $car->description : ''; ?></textarea>
					</div>
				</div>
			</div>
			<!-- end Title and description -->
				
				
			<!-- images -->
			<h4>Images</h4>
	
			<div class="row input-form">
				<div class="form-group">
					<div class="col-sm-12">
						Upload images:
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-4">
						<input class="form-control" name="image_1" type="file">
					</div>
					
					<div class="col-sm-4">
						<input class="form-control" name="image_2" type="file">
					</div>
					
					<div class="col-sm-4">
						<input class="form-control" name="image_3" type="file">
					</div>
				</div>
				
				
				<div class="form-group">
					<div class="col-sm-12">
					Current images:
					</div>
				</div>
			
				<div class="form-group">
				
					<?php 
					if (count($car_images) > 0) {					
						foreach ($car_images as $image) { ?>
					
					<div class="col col-sm-4">
						<span id="<?php echo $image->cars_images_id; ?>" class="thumbnail">
							<span style="display: block; background: #efefef; width: 100%; overflow: hidden; height: 120px;">
								<img src="<?php echo base_url('assets/uploads/'.$image->file); ?>" height="120" alt="<?php echo $image->file; ?>">
							</span>
							<a href="#" class="remove-image">X</a>
						</span>	
					</div>
					
					<?php 
						}
					} 
					?>

				</div>
			</div>
			<!-- end images -->
			
			<div class="col-sm-12 button-wrapper">	
			
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block btn-lg">Save</button>
				</div>
				
			</div>
			
		</div>
	</div>	
	
</form>
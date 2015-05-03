	<div class="options">
		<a class="btn btn-default" href="<?php echo base_url('admin/add_car'); ?>" title="Add new car">
			<span class="glyphicon glyphicon-plus"></span> Add New Car
		</a>
	</div>

	<div class="result-details">
		<strong>Total results:</strong> <?php echo $total_rows; ?>
	</div>
	
	<table class="table table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Make</th>
			<th>Model</th>
			<th>Year</th>
			<th class="text-right">Created at</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>

	<?php foreach ($cars as $car) { ?>
		<tr>
			<td><?php echo $car->car_id; ?></td>
			<td><?php echo $car->make_name; ?></td>
			<td><?php echo $car->model_name; ?></td>
			<td><?php echo $car->year; ?></td>
			<td class="text-right"><?php echo $car->created_at; ?></td>
			<td class="text-right">
				<a href="<?php echo base_url('admin/car/'.$car->car_id); ?>" title="edit">
					<span class="glyphicon glyphicon-pencil"></span> edit
				</a>
				 - 
				<a href="<?php echo base_url('admin/remove_car/'.$car->car_id); ?>" title="remove">
					<span class="glyphicon glyphicon-remove"></span> remove
				</a>
			</td>
		</tr>
	<?php } ?>

	</tbody>
    </table>


    <div class="text-center">
    	<?php echo $links; ?>
    </div>
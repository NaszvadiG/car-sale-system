	<div class="result-details">
		<strong>Total results:</strong> <?php echo $total_rows; ?>
	</div>
	
	
	<table class="table table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Full name</th>
			<th>Car reference id</th>
			<th class="text-right">Created at</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>

	<?php foreach ($orders as $order) { ?>
		<tr>
			<td><?php echo $order->order_id; ?></td>
			<td><?php echo $order->first_name.' '.$order->last_name; ?></td>
			<td>
				#<?php echo $order->car_id; ?> - 
				<a href="<?php echo base_url('admin/car/'.$order->car_id); ?>" title="view car"><?php echo $order->year.' '.$order->make_name.' '.$order->model_name; ?></a>
			</td>
			<td class="text-right"><?php echo $order->created_at; ?></td>
			<td class="text-right">
				<a href="<?php echo base_url('admin/order/'.$order->order_id); ?>" title="view">
					<span class="glyphicon glyphicon-search"></span> view
				</a>
				 - 
				<a href="<?php echo base_url('admin/remove_order/'.$order->order_id); ?>" title="remove">
					<span class="glyphicon glyphicon-remove"></span> remove
				</a>
			</td>
		</tr>
	<?php } ?>

	</tbody>
    </table>
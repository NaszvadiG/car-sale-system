	<div class="result-details">
		<strong>Total results:</strong> <?php echo $total_rows; ?>
	</div>
	
	
	<table class="table table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Full name</th>
			<th>Subject</th>
			<th>Car reference id</th>
			<th class="text-right">Created at</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>

	<?php foreach ($enquiries as $enquiry) { ?>
		<tr>
			<td><?php echo $enquiry->enquiry_id; ?></td>
			<td><?php echo $enquiry->fullname; ?></td>
			<td><?php echo $enquiry->subject; ?></td>
			<td>
				#<?php echo $enquiry->car_id; ?> - 
				<a href="<?php echo base_url('admin/car/'.$enquiry->car_id); ?>" title="view car"><?php echo $enquiry->year.' '.$enquiry->make_name.' '.$enquiry->model_name; ?></a>
			</td>
			<td class="text-right"><?php echo $enquiry->created_at; ?></td>
			<td class="text-right">
				<a href="<?php echo base_url('admin/enquiry/'.$enquiry->enquiry_id); ?>" title="view">
					<span class="glyphicon glyphicon-search"></span> view
				</a>
				 - 
				<a href="<?php echo base_url('admin/remove_enquiry/'.$enquiry->enquiry_id); ?>" title="remove">
					<span class="glyphicon glyphicon-remove"></span> remove
				</a>
			</td>
		</tr>
	<?php } ?>

	</tbody>
    </table>
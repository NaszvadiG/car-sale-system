	<div class="options">
		<a class="btn btn-default" href="<?php echo base_url('admin/add_user'); ?>" title="Add new user">
			<span class="glyphicon glyphicon-plus"></span> Add New User
		</a>
	</div>

	<div class="result-details">
		<strong>Total results:</strong> <?php echo $total_rows; ?>
	</div>
	
	
	<table class="table table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Email</th>
			<th>Role</th>
			<th class="text-right">Created at</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>

	<?php foreach ($users as $user) { ?>
		<tr>
			<td><?php echo $user->user_id; ?></td>
			<td><a href="<?php echo base_url('admin/user/'.$user->user_id); ?>" title="view"><?php echo $user->email; ?></a></td>
			<td><?php echo $user->role_name; ?></td>
			<td class="text-right"><?php echo $user->created_at; ?></td>
			<td class="text-right">

				<?php if ($logged->role_id <= $user->role_id) { ?>

				<a href="<?php echo base_url('admin/user/'.$user->user_id); ?>" title="edit">
					<span class="glyphicon glyphicon-pencil"></span> edit
				</a>

				<?php } ?>


				<?php if ($logged->role_id < 2) { ?>
				 - 
				<a href="<?php echo base_url('admin/remove_user/'.$user->user_id); ?>" title="remove">
					<span class="glyphicon glyphicon-remove"></span> remove
				</a>

				<?php } ?>
			</td>
		</tr>
	<?php } ?>

	</tbody>
    </table>
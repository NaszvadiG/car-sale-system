	<!-- results -->
	<div class="col-sm-6">	

		<h3>Results</h3>

		<label for="" class="control-label">Get results from</label>

		<form method="post" role="form">
			<div class="row form-group">
				<div class="col-sm-5">
					<?php echo $date_select; ?>
				</div>
				<div class="col-sm-2">
					<button type="submit" class="btn btn-primary">Change</button>
				</div>
			</div>

			<div class="row form-group">
				<div class="col-sm-12">
					<?php echo (!empty($date_before)) ? '<strong>Results from:</strong> '.$date_before : ''; ?>
				</div>
			</div>
		</form>


		<div class="row">
			<div class="col-sm-6">
				<h4>Enquiries</h4>

				<p>Enquiries submitted: <?php echo $total_enquiry_rows; ?></p>
			</div>
			<div class="col-sm-6">
				<h4>Orders</h4>

				<p>Purchases made: <?php echo $total_order_rows; ?></p>
			</div>
		</div>


		<div class="row">
			<div class="col-sm-6">
				<h4>Users</h4>

				<p>Users registered: <?php echo $total_user_rows; ?></p>
			</div>
			<div class="col-sm-6">
				<h4>Cars</h4>

				<p>Cars added: <?php echo $total_car_rows; ?></p>
			</div>
		</div>

	</div>


	<!-- history -->
	<div class="col-sm-6">
		<h3>History (last 20 results)</h3>

		<div class="overflow-block">
			<?php foreach($history as $htry) { ?>
				
				<div class="row result">
					<div class="col-sm-12">
						<a href=""><span class="glyphicon glyphicon-user"></span> <?php echo $htry->email; ?></a>:
					</div>

					<div class="col-sm-6">
						<?php echo $htry->history_action; ?>
					</div>
					<div class="col-sm-6 text-right">
						<?php echo $htry->created_at; ?>
					</div>
				</div>

			<?php } ?>
		</div>
	</div>
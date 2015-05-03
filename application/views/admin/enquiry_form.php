	<h3>Enquiry Details #<?php echo $enquiry->enquiry_id; ?></h3>

	<form class="form form-horizontal" id="enquiry-form" method="post" role="form">
		<div class="row">
			<div class="col-sm-6">
				
				<div class="form-group">
					<label for="" class="col-sm-4 form-label">First name</label>
					
					<div class="col-sm-8">
						<?php echo $enquiry->fullname; ?>
					</div>
				</div>

				<div class="form-group">
					<label for="" class="col-sm-4 form-label">Email</label>
					
					<div class="col-sm-8">
						<a href="mailto: <?php echo $enquiry->email; ?>"><?php echo $enquiry->email; ?></a>
					</div>
				</div>

				<div class="form-group">
					<label for="" class="col-sm-4 form-label">Phone</label>
					
					<div class="col-sm-8">
						<?php echo $enquiry->phone; ?>
					</div>
				</div>

				<div class="form-group">
					<label for="" class="col-sm-4 form-label">Subject</label>
					
					<div class="col-sm-8">
						<?php echo $enquiry->subject; ?>
					</div>
				</div>

				<div class="form-group">
					<label for="" class="col-sm-4 form-label">Message</label>
					
					<div class="col-sm-8">
						<?php echo $enquiry->message; ?>
					</div>
				</div>
			
			</div>
		</div>
	</form>
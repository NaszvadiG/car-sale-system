$(document).ready(function() {
	/*
	 * car model + make selection
	 */
	// For on load
	var select_make = $('select[name="car_make"]');
	
	if(select_make.val() > 0) {
		get_model(site_url, select_make.val());
	}
	
	// For field change
	select_make.on('change', function() {
		var car_make = $(this).val();
		
		get_model(site_url, car_make);
	});
	
	
	/*
	 * Uploads
	 */
	$('.remove-image').on('click', function() {
		var image_id = $(this).parent().attr('id');
		
		$('#' + image_id).fadeOut(function() {
			$(this).closest('.col').hide();
		});
		
		remove_image(site_url, image_id);
		
		return false;
	});
	
	
	/*
	 * validation
	 */
	$('#car-form').on('click', 'button', function() {
		$('#car-form').validate({
			submitHandler: function(form) {
				form.submit();
			},
			rules: {
				car_make: "required",
				car_model: "required",
				car_body: "required",
				car_cyl: "required",
				transmission: "required",
				price: "required",
				year: "required",
				condition: "required",
				colour: "required",
				mileage: "required",
				description: "required",
			},
			messages: {
			},
			errorPlacement: function() {
				
			},
			highlight: function(element, errorClass, validClass) {
				$(element).closest('.form-group').addClass('has-error has-feedback');
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).closest('.form-group').removeClass('has-error has-feedback');
			}
		});
	});


	$('#user-form').on('click', 'button', function() {
		$('#user-form').validate({
			submitHandler: function(form) {
				form.submit();
			},
			rules: {
				email: {
					required: true,
					email: true
				},
				role_id: 'required'
			},
			messages: {
			},
			errorPlacement: function() {
			},
			highlight: function(element, errorClass, validClass) {
				$(element).closest('.form-group').addClass('has-error has-feedback');
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).closest('.form-group').removeClass('has-error has-feedback');
			}
		});
	});


	$('#order-form button').on('click', function() {
		$('#order-form').validate({
			errorElement: 'em',
			submitHandler: function(form) {
				form.submit();
			},
			rules: {
				first_name: "required",
				last_name: "required",
				phone: "required",
				mobile_no: "required",
				email: "required",
				unit_no: "required",
				street_no: "required",
				address: "required",
				city: "required",
				state: "required",
				postcode: "required",
			},
			errorPlacement: function() {	
			},
			highlight: function(element, errorClass, validClass) {
				$(element).closest('.form-group').addClass('has-error has-feedback');
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).closest('.form-group').removeClass('has-error has-feedback');
			}
		});
	});


	/*
	 * fade out alert
	 */
	$('.alert').delay(2000).fadeOut(function() {
		$(this).hide();
	});
});


function get_model(site_url, car_make) {
	var selected_model = $('input[name="selected_model"').val();

	$.ajax({
		type: "GET",
		url: site_url + 'admin/get_models/' + car_make,
		dataType: "json",
		error: function(response) {
			console.log('Could not retreive data from url: ' + site_url);
		},
		success: function(result) {
			var select_model = $('select[name="car_model"]'),
				row = result;
				
			select_model.empty();
			
			for (i in row) {
				var model_id   = row[i].car_model_id,
					model_name = row[i].model_name;
				
				if (selected_model == model_id) {
					select_model.append('<option value="' + model_id + '" selected="selected">' + model_name + '</option>');
				} else {
					select_model.append('<option value="' + model_id + '">' + model_name + '</option>');
				}
			}
		}
	});	
}

function remove_image(site_url, image_id) {
	$.ajax({
		type: "POST",
		url: site_url + 'admin/remove_image/' + image_id,
		dataType: "json",
		error: function(response) {
			console.log('Could not complete action.');
		},
		success: function(result) {
			console.log('Awesome, action completed.');	
		}
	});
}
$(window).ready(function() {
	/*
	 * car model + make selection
	 */
	// For on load
	var select_make = $('#car_make');
	
	if(select_make.val() > 0) {
		get_model(site_url, select_make.val());
	}
	
	// For field change
	select_make.on('change', function() {
		var car_make = $(this).val();
		
		get_model(site_url, car_make);

		console.log(car_make + ' id was selected.');
	});
	
	
	//// carousel ////
	$('.car-slideshow .slide-container').cycle({
		fx: 'scrollHorz',
		timeout: 0,
		next: '.next',
		prev: '.prev',
		pager: '.pager',
		pagerTemplate: "<a href='#'><img src='{{src}}' height=40></a>"
	});
	
	
	//// validation ////
	$('#login-form button').on('click', function() {
		$('#login-form').validate({
			submitHandler: function(form) {
				form.submit();
			},
			rules: {
				email: "required",
				password: "required",
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
	
	
	$('#register-form button').on('click', function() {
		$('#register-form').validate({
			errorElement: 'em',
			submitHandler: function(form) {
				form.submit();
			},
			rules: {
				email: "required",
				password: {
					required: true,
					minlength: 6,
				},
				confirm_password: {
					required: true,
					minlength: 6,
					equalTo: password,
				},
			},
			messages: {
				confirm_password: {
					equalTo: 'Passowords do not match.',
				},
			},
			errorPlacement: function(error, element) {	
				error.appendTo(element.parent().find('label'));
			},
			highlight: function(element, errorClass, validClass) {
				$(element).closest('.form-group').addClass('has-error has-feedback');
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).closest('.form-group').removeClass('has-error has-feedback');
			}
		});
	});
	
	
	$('#enquire-form button').on('click', function() {
		$('#enquire-form').validate({
			errorElement: 'em',
			submitHandler: function(form) {
				form.submit();
			},
			rules: {
				fullname: "required",
				email: "required",
				phone: "required",
				message: "required",
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

	$('#purchase-form button').on('click', function() {
		$('#purchase-form').validate({
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
				credit_card_no: "required",
				card_holder: "required",
				csc: "required",
				agree_1: "required",
				agree_2: "required",
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
});


/**
 * [get_model description]
 * @param  {[type]} site_url [description]
 * @param  {[type]} car_make [description]
 * @return {[type]}          [description]
 */
function get_model(site_url, car_make) {
	var selected_model  = $('input[name="selected_model"]').val(),
		controller_path = 'browse/get_models/';

	$.ajax({
		type: "GET",
		url: site_url + controller_path + car_make,
		dataType: "json",
		error: function(response) {
			console.log('Could not retreive data from url: ' + site_url);
			console.log('Possible reason: path or file does not exit.');
		},
		success: function(result) {
			console.log('Success!');

			var select_model = $('#car_model'),
				row = result;
				
			select_model.empty();

			select_model.append('<option value="0" selected="selected">All Models</option>');
			
			for (i in row) {
				var model_id   = row[i].car_model_id,
					model_name = row[i].model_name,
					count_cars = row[i].count;
				
				if (selected_model == model_id) {
					select_model.append('<option value="' + model_id + '" selected="selected">' + model_name + ' (' + count_cars + ')</option>');
				} else {
					select_model.append('<option value="' + model_id + '">' + model_name + ' (' + count_cars + ')</option>');
				}
			}
		}
	});	
}
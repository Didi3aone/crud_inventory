$(document).ready(function() {
	var form = $('#form-login');
	var submit = $('#form-login .btn-submit');

	$(form).validate ( {
		errorClass: 'invalid',
		errorElement : 'em',

		highlight : function(element) {
			$(element).parent().removeClass('state-success').addClass('state-error');
			$(element).removeClass('valid');
		},

		unhighlight: function(element) {
			$(element).parent().removeClass("state-error").addClass("state-success");
			$(element).addClass('valid');
		},

		rules: {
			username: {
				required:true,
			},
			password: {
				required: true,
			},
		},

		messages:{},

		submitHandler: function(form) {
			$(form).ajaxSubmit ( {
				dataType: 'json',
				beforeSend: function() {
					$(submit).attr('disabled', false);
				},
				success: function (data) {

					if(data['is_error']) {
						swal("Oops", data['error_msg'],"error");
					} else {
						if(data['redirect_to'] == "") {
							$(form)[0].reset();
							$(submit).attr('disabled', false);
						}
						else {
							$(form)[0].reset();
							$(submit).attr('disabled', false);
							location.href = data['redirect_to'];
						}
					}
				},
				error: function() {
					$(submit).attr("disabled",false);
					swal("Oops!","Something went wrong.","error");
				}
			});
		},
		errorPlacement: function(error, element)
		{
			error.insertAfter(element);
		}
	});
});
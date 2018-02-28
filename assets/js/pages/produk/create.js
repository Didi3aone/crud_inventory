function kategori() {
		//select2 for gudang.
		var element = $("#kategori")
	    $(element).select2({
	        ajax: {
	            url: "/crud_inventory/produk/list_select_kategori",
	            dataType: "json",
	            delay: 500,
	            data: function(params) {
	                return {
	                    q: params.term,
	                    page: params.page,
	                };
	            },
	            processResults: function(data, params) {

	                params.page = params.page || 1;

	                return {
	                    results: $.map(data.get, function(item) {
	                        return {
	                            text: item.kategori_name,
	                            id: item.kategori_produk_id,
	                        }
	                    }),
	                    pagination: {
	                        more: (params.page * data.paging_size) < data.total_data,
	                    }
	                };
	            },
	            cache: true,
	        },
	        minimumInputLength: 0,
	        allowClear: true,
	        placeholder: "Pilih Kategori",
	        tags: false,
	        maximumSelectionLength: 1,
	    });
	}
$(document).ready(function() {
	kategori();

	var form = $('#form-submits');
    var submit = $('#form-submits button[type="submit"]');

    $(form).validate( {
        errorClass      : 'invalid',
        errorElement    : 'em',

        highlight: function(element) {
            $(element).parent().removeClass('state-success').addClass("state-error");
            $(element).removeClass('valid');
        },

        unhighlight: function(element) {
            $(element).parent().removeClass("state-error").addClass('state-success');
            $(element).addClass('valid');
        },

        // Rules for form validation
        rules: {
            name: {
                required: true,
            },
            price: {
            	required: true,
            },
        },

        // Messages for form validation
        messages: {},

        // Ajax form submition.
        submitHandler: function(form)
        {
            $(form).ajaxSubmit({
                dataType: 'json',
                beforeSend: function()
                {
                    $(submit).attr('disabled', true);
                    $('.loading').css("display", "block");
                },
                success: function(data)
                {
                    //validate if error
                    $('.loading').css("display","none");
                    if(data['is_error']) {
                        swal("Oops!", data['error_msg'], "error");
                        $(submit).attr('disabled', false);
                    } 
                    else {
                        //succes
                        $.smallBox({
                                title: '<strong>' + data['notif_title'] + '</strong>',
                                content: data['notif_message'],
                                color: "#659265",
                                iconSmall: "fa fa-check fa-2x fadeInRight animated",
                                timeout: 1000
                            }, function() {
                            if(data['redirect_to'] == "") {
                                $(form)[0].reset();
                                $(submit).attr('disabled', false);
                            } else {
                                
                               location.href = data['redirect_to'];
                            }
                        });
                    }                   
                },
                error: function() {
                    $('.loading').css("display","none");
                    $(submit).attr('disabled', false);
                    swal("Oops", "Something went wrong.", "error");
                }
            });
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element.parent());
            swal("Oops", "Something went wrong.", "error");
        },
    });
});
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/

// When the browser is ready...
  jQuery(function() {
	'use strict';
	var dataTable = '';
	var mpdataTable = '';
	/*Get stripe payout history*/
	dataTable = jQuery('#payout-history-grid').DataTable( {
	"serverSide": true,
	"bAutoWidth": false,
	"order": [[ 2, "desc" ]],
	"columnDefs": [ {
		  "targets": 0,
		  "orderable": false,
		  "searchable": false
		   
		},
		],
	"processing": true,
	"language": {
					"processing": "<div></div><div></div><div></div><div></div><div></div>",
					"emptyTable":     param.empty_table,
					"search":         param.dt_search+":",
					"lengthMenu":     param.dt_show + " _MENU_ " + param.dt_entries,
					"info":           param.dt_showing + " _START_ " + param.dt_to + " _END_ " + param.dt_of + " _TOTAL_ " + param.dt_entries,
					"paginate": {
						first:      param.dt_first,
						previous:   param.dt_previous,
						next:       param.dt_next,
						last:       param.dt_last,
					},
				},
	"ajax":{
		url :ajaxurl, // json datasource
		type: "post",  // method  , by default get
		data: {"action": "get_payout_history","user_id": user_id},
		error: function(){  // error handling
			jQuery(".payout-history-grid-error").html("");
			jQuery("#payout-history-grid").append('<tbody class="payout-history-grid-error"><tr><th colspan="3">'+param.no_data+'</th></tr></tbody>');
			jQuery("#payout-history-grid_processing").css("display","none");
			
		}
	}
	} );
	
	/*Get mangopay payout history*/
	mpdataTable = jQuery('#mp-payout-history-grid').DataTable( {
	"serverSide": true,
	"bAutoWidth": false,
	"order": [[ 2, "desc" ]],
	"columnDefs": [ {
		  "targets": 0,
		  "orderable": false,
		  "searchable": false
		   
		},
		],
	"processing": true,
	"language": {
					"processing": "<div></div><div></div><div></div><div></div><div></div>",
					"emptyTable":     param.empty_table,
					"search":         param.dt_search+":",
					"lengthMenu":     param.dt_show + " _MENU_ " + param.dt_entries,
					"info":           param.dt_showing + " _START_ " + param.dt_to + " _END_ " + param.dt_of + " _TOTAL_ " + param.dt_entries,
					"paginate": {
						first:      param.dt_first,
						previous:   param.dt_previous,
						next:       param.dt_next,
						last:       param.dt_last,
					},
				},
	"ajax":{
		url :ajaxurl, // json datasource
		type: "post",  // method  , by default get
		data: {"action": "get_mp_payout_history","user_id": user_id},
		error: function(){  // error handling
			jQuery(".mp-payout-history-grid-error").html("");
			jQuery("#mp-payout-history-grid").append('<tbody class="mp-payout-history-grid-error"><tr><th colspan="3">'+param.no_data+'</th></tr></tbody>');
			jQuery("#mp-payout-history-grid_processing").css("display","none");
			
		}
	}
	} );
	
	
	/*stripe connect custom account creation with gereral fields*/
    jQuery('.payout-settings')
    .bootstrapValidator({
            message: param.not_valid,
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
				mp_dob: {
					validators: {
						notEmpty: {
							message: param.req
						}
					}
				},
				mp_nationality: {
					validators: {
						notEmpty: {
							message: param.req
						}
					}
				},
				mp_country: {
					validators: {
						notEmpty: {
							message: param.req
						}
					}
				},
            }
        })
    .on('success.form.bv', function(form) {
            // Prevent form submission
			form.preventDefault();
			
			var mp_nationality = jQuery('.payout-settings select[name="mp_nationality"]').val();	
			var mp_country = jQuery('.payout-settings select[name="mp_country"]').val();	
			
			if(mp_nationality == ''){
				jQuery( "<div class='alert alert-danger'>"+param.nationality_req+"</div>" ).insertBefore( "form.payout-settings" );
				return false;
			}
			
			if(mp_country == ''){
				jQuery( "<div class='alert alert-danger'>"+param.signup_country+"</div>" ).insertBefore( "form.payout-settings" );
				return false;
			}

            // Get the form instance
            var $form = jQuery(form.target);
            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');
			
			var data = {
			  "action": "create_mp_account",
			  "user_id": user_id
			};
			
			var formdata = jQuery($form).serialize() + "&" + jQuery.param(data);
			
			jQuery.ajax({

				type: 'POST',

				url: ajaxurl,
				
				dataType: "json",
				
				beforeSend: function() {
					jQuery(".alert-success,.alert-danger").remove();
					jQuery('.loading-area').show();
				},
				
				data: formdata,

				success:function (data, textStatus) {
					jQuery('.loading-area').hide();
					$form.find('input[type="submit"]').prop('disabled', false);
					if(data['status'] == 'success'){
						jQuery( "<div class='alert alert-success'>"+data['suc_message']+"</div>" ).insertBefore( "form.payout-settings" );
								
					}else if(data['status'] == 'error'){
						jQuery( "<div class='alert alert-danger'>"+data['err_message']+"</div>" ).insertBefore( "form.payout-settings" );
					}
				
				}

			});
			
    });
	
	/*stripe connect custom account creation with gereral fields*/
    jQuery('.payout-general')
    .bootstrapValidator({
            message: param.not_valid,
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
				first_name: {
					validators: {
						notEmpty: {
							message: param.req
						}
					}
				},
				last_name: {
					validators: {
						notEmpty: {
							message: param.req
						}
					}
				},
				user_email: {
					validators: {
						notEmpty: {
							message: param.req
						},
						emailAddress: {
							message: param.signup_user_email
						}
					}
				},
				dob: {
					validators: {
						notEmpty: {
							message: param.req
						}
					}
				},
				address: {
					validators: {
						notEmpty: {
							message: param.req
						}
					}
				},
				postal_code: {
					validators: {
						notEmpty: {
							message: param.req
						}
					}
				},
				city: {
					validators: {
						notEmpty: {
							message: param.req
						}
					}
				},
				state: {
					validators: {
						notEmpty: {
							message: param.req
						}
					}
				},
            }
        })
    .on('success.form.bv', function(form) {
            // Prevent form submission
			form.preventDefault();

            // Get the form instance
            var $form = jQuery(form.target);
            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');
			
			var data = {
			  "action": "create_custom_payout_account",
			  "user_id": user_id
			};
			
			var formdata = jQuery($form).serialize() + "&" + jQuery.param(data);
			
			jQuery.ajax({

				type: 'POST',

				url: ajaxurl,
				
				dataType: "json",
				
				beforeSend: function() {
					jQuery(".alert-success,.alert-danger").remove();
					jQuery('.loading-area').show();
				},
				
				data: formdata,

				success:function (data, textStatus) {
					jQuery('.loading-area').hide();
					$form.find('input[type="submit"]').prop('disabled', false);
					if(data['status'] == 'success'){
						jQuery( "<div class='alert alert-success'>"+data['suc_message']+"</div>" ).insertBefore( "form.payout-general" );
						window.setTimeout(function(){
							window.location.href = data['redirect'];
						}, 2000);		
					}else if(data['status'] == 'error'){
						jQuery( "<div class='alert alert-danger'>"+data['err_message']+"</div>" ).insertBefore( "form.payout-general" );
					}
				
				}

			});
			
    });
	
	jQuery('.payout_customer_dob').datepicker({
		format: 'yyyy-mm-dd',													
	})
	.on('changeDate', function(evt) {
		// Revalidate the date field
	}).on('hide', function(event) {
		event.preventDefault();
		event.stopPropagation();
	});
	
	jQuery('.mp_dob').datepicker({
		format: 'yyyy-mm-dd',													
	})
	.on('changeDate', function(evt) {
		// Revalidate the date field
	}).on('hide', function(event) {
		event.preventDefault();
		event.stopPropagation();
	});
	
	/*stripe connect custom account identity verification*/
	jQuery('.stripe-identity-verification')
    .bootstrapValidator({
            message: param.not_valid,
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
				personal_id_number: {
					validators: {
						notEmpty: {
							message: param.req
						}
					}
				},
            }
        })
    .on('success.form.bv', function(form) {
            // Prevent form submission
			form.preventDefault();

            // Get the form instance
            var $form = jQuery(form.target);
            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');
			
			var data = {
			  "action": "stripe_identity_verification",
			  "user_id": user_id
			};
			
			var formdata = jQuery($form).serialize() + "&" + jQuery.param(data);
			
			jQuery.ajax({

				type: 'POST',

				url: ajaxurl,
				
				dataType: "json",
				
				beforeSend: function() {
					jQuery(".alert-success,.alert-danger").remove();
					jQuery('.loading-area').show();
				},
				
				data: formdata,

				success:function (data, textStatus) {
					jQuery('.loading-area').hide();
					$form.find('input[type="submit"]').prop('disabled', false);
					if(data['status'] == 'success'){
						jQuery( "<div class='alert alert-success'>"+data['suc_message']+"</div>" ).insertBefore( "form.stripe-identity-verification" );
						window.setTimeout(function(){
							window.location.href = data['redirect'];
						}, 2000);		
					}else if(data['status'] == 'error'){
						jQuery( "<div class='alert alert-danger'>"+data['err_message']+"</div>" ).insertBefore( "form.stripe-identity-verification" );
					}
				
				}

			});
			
    });
	
	/*stripe connect custom account update with extrnal bank account details*/
	jQuery('.stripe-external-account')
    .bootstrapValidator({
            message: param.not_valid,
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
				currency: {
					validators: {
						notEmpty: {
							message: param.req
						}
					}
				},
				bank_country: {
					validators: {
						notEmpty: {
							message: param.req
						}
					}
				},
				routing_number: {
					validators: {
						notEmpty: {
							message: param.req
						}
					}
				},
				account_number: {
					validators: {
						notEmpty: {
							message: param.req
						}
					}
				},
            }
        })
    .on('success.form.bv', function(form) {
            // Prevent form submission
			form.preventDefault();

            // Get the form instance
            var $form = jQuery(form.target);
            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');
			
			var data = {
			  "action": "update_stripe_external_account",
			  "user_id": user_id
			};
			
			var formdata = jQuery($form).serialize() + "&" + jQuery.param(data);
			
			jQuery.ajax({

				type: 'POST',

				url: ajaxurl,
				
				dataType: "json",
				
				beforeSend: function() {
					jQuery(".alert-success,.alert-danger").remove();
					jQuery('.loading-area').show();
				},
				
				data: formdata,

				success:function (data, textStatus) {
					jQuery('.loading-area').hide();
					$form.find('input[type="submit"]').prop('disabled', false);
					if(data['status'] == 'success'){
						jQuery( "<div class='alert alert-success'>"+data['suc_message']+"</div>" ).insertBefore( "form.stripe-external-account" );
						window.setTimeout(function(){
							window.location.href = data['redirect'];
						}, 2000);
								
					}else if(data['status'] == 'error'){
						jQuery( "<div class='alert alert-danger'>"+data['err_message']+"</div>" ).insertBefore( "form.stripe-external-account" );
					}
				
				}

			});
			
    });
		
  });
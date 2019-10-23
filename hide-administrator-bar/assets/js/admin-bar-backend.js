jQuery(document).ready(function () {

    /**
     * To bind the select element with Multi JS library
     */
    if (jQuery("select.regular-select").length) {
        jQuery('select.regular-select').multiSelect();
    }

    /**
     * Function to update user roles in the database
     */
    if (jQuery(".update-yp-roles").length) {

        jQuery(".update-yp-roles").click(function () {

            if (confirm("Are you sure want to remove admin bar for selected user roles?")) {
                jQuery(".yp_spinner").show();

                var data = {
                    'action': 'ypAddRemoveAdminBar',
                    'yp_roles': jQuery("#adminbar_users").val(),
                };
                jQuery.post(yp_object.yp_ajax_url, data, function (response) {

                    jQuery(".yp_spinner").hide();
                    var message = (JSON.parse(response));

                    if (message.status == "success") {
                        jQuery('.alert-success').html(message.message);
                        jQuery('.alert-success').show();
                        setTimeout(function () {
                            jQuery('.alert-success').fadeOut('slow');
                            document.location.reload();
                        }, 2000);
                    }
                    else {
                        jQuery('.alert-danger').html(message.message);
                        jQuery('.alert-danger').show();
                        setTimeout(function () {
                            jQuery('.alert-danger').fadeOut('slow');
                        }, 2000);
                    }
                });

            } else {
                return false;
            }
        });
    }
});
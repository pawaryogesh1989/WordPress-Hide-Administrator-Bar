<div class="wrap">
    <h2><?php _e('Hide Admin Bar Settings'); ?></h2>
    <hr />
    <h4><?php _e('By Default Admin Bar is visible to all users.'); ?></h4>
    <hr />

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="alert alert-success" style="display:none;">                
            </div>
            <div class="alert alert-danger" style="display:none;">                
            </div>
        </div>
        <div class="col-md-3"></div>
    </div> 

    <div class="container">
        <form method="post" action="options.php">        
            <table class="form-table">            
                <tr valign="top">
                    <th scope="row"><?php _e("Hide Admin Bar For :"); ?></th>
                    <td>
                        <select class="regular-select" name="adminbar_users" id="adminbar_users" multiple="multiple">
                            <?php
                            if (class_exists('Hide_Administrator_Bar')) {
                                $adminBar = new Hide_Administrator_Bar();
                                $userRoles = $adminBar->getSiteUserRoles();
                                $yp_allowed_users = get_option("yp_allowed_users");
                                $allowed_roles = explode(",", $yp_allowed_users);
                            }

                            if (!empty($userRoles)) {
                                foreach ($userRoles as $role => $roleName) {
                                    $selected = "";

                                    if (in_array($role, $allowed_roles)) {
                                        $selected = "checked=checked selected";
                                    }

                                    ?>
                                    <option value="<?php echo $role; ?>" <?php echo $selected; ?>><?php echo $roleName['name']; ?></option>
                                    <?php
                                }
                            }

                            ?>                                                
                        </select><br />
                        <span class="notice" style="font-size: 12px;"><?php _e("Select User Roles for which the Admin Bar should be hidden in Front-end"); ?></span>
                    </td>                
                </tr>                        
            </table>        
        </form>
        <div class="form-group">
            <button type="button" class="btn btn-success update-yp-roles"><span class="glyphicon glyphicon-plus"></span> Restrict Selected Users</button>
            <div id="yp_spinner" class="yp_spinner spinner">            
                <p><?php _e('Please wait while we update permissions'); ?></p>
            </div> 
        </div>
    </div> 

</div>
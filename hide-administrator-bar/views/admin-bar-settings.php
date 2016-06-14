<div class="wrap">
    <h3><?php _e('Hide Admin Bar Settings'); ?></h3>

    <form method="post" action="options.php">
        <?php settings_fields('admin-bar-words-group'); ?>
        <?php do_settings_sections('admin-bar-words-group'); ?>
        <table class="form-table">            
            <tr valign="top">
                <th scope="row"><?php _e("Hide for Admin :"); ?> <span style="font-size: 11px;">(By Default it is Enable)</span></th>
                <td>
                    <select class="regular-select" name="hide_for_admin">
                        <option value="true" <?php selected(get_option('hide_for_admin'), 'true'); ?>><?php _e("Enable"); ?></option>
                        <option value="false" <?php selected(get_option('hide_for_admin'), 'false'); ?>><?php _e("Disable"); ?></option>                   
                    </select>
                </td>                
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e("Hide for all users (Except Admin) :"); ?> <span style="font-size: 11px;">(By Default it is Enable)</span></th>
                <td>
                    <select class="regular-select" name="hide_for_all_users">
                        <option value="true" <?php selected(get_option('hide_for_all_users'), 'true'); ?>><?php _e("Enable"); ?></option>
                        <option value="false" <?php selected(get_option('hide_for_all_users'), 'false'); ?>><?php _e("Disable"); ?></option>                   
                    </select>
                </td>                
            </tr>            
        </table>
        <?php submit_button(); ?>
    </form>
</div>
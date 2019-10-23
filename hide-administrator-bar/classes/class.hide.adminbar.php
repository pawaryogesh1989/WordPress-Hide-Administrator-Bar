<?php

/**
 * Main Class File
 */
class Hide_Administrator_Bar
{

    static $instance;

    //Constructor of the Class
    public function __construct()
    {

        self::$instance = $this;

        add_action('admin_menu', array($this, 'wpAdminBarMenu'));
        add_action('wp_ajax_ypAddRemoveAdminBar', array($this, 'ypAddRemoveAdminBar'));
        add_action('after_setup_theme', array($this, 'removeAdminBarFrontend'));
        add_action('admin_enqueue_scripts', array($this, 'adminBarScripts'));
    }

    public function adminBarScripts()
    {

        $current_page = filter_input(INPUT_GET, 'page');

        if ($current_page == "hide-admin-bar-settings") {

            wp_register_style('bootstrap', plugins_url('/assets/css/bootstrap.min.css', __DIR__));
            wp_register_style('yp-backend-css', plugins_url('/assets/css/yp-multi-select.css', __DIR__));

            wp_register_script('yp-multi-js', plugins_url('/assets/js/jquery.multi-select.js', __DIR__));
            wp_register_script('yp-backend-main', plugins_url('/assets/js/admin-bar-backend.js', __DIR__), array('jquery'));

            wp_enqueue_style('bootstrap');
            wp_enqueue_style('yp-backend-css');

            wp_enqueue_script('yp-multi-js');
            wp_enqueue_script('yp-backend-main');

            wp_localize_script('yp-backend-main', 'yp_object', array('yp_ajax_url' => admin_url('admin-ajax.php')));
        }
    }

    /**
     * Function to add menu
     */
    public function wpAdminBarMenu()
    {
        add_management_page('Admin Bar Settings', 'Admin Bar Settings', 'manage_options', 'hide-admin-bar-settings', array($this, 'loadAdminBarSettingsPage'), '', 86);
    }

    /**
     * Function to remove admin bar for selected Menus
     */
    public function removeAdminBarFrontend()
    {

        $user = wp_get_current_user();

        $userRoles = $this->getSiteUserRoles();
        $yp_allowed_users = get_option("yp_allowed_users");
        $allowed_roles = explode(",", $yp_allowed_users);

        if (!empty($userRoles)) {
            foreach ($userRoles as $role => $roleName) {

                if (in_array($role, $allowed_roles) && in_array($role, (array) $user->roles)) {
                    show_admin_bar(false);
                }
            }
        }
    }

    /**
     * Function to load Settings
     */
    public function loadAdminBarSettingsPage()
    {

        if (current_user_can('manage_options')) {
            if (file_exists(plugin_dir_path(__DIR__) . '/views/admin-bar-settings.php')) {
                require plugin_dir_path(__DIR__) . '/views/admin-bar-settings.php';
            } else {
                die('<br /><h3>Plugin Installation is Incomplete. Please install the plugin again or make sure you have copied all the plugin files.</h3>');
            }
        } else {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }
    }

    /**
     * Function to allow/restrict admin bar for users in frontend
     */
    public function ypAddRemoveAdminBar()
    {

        $allowed_users = implode(",", $_POST['yp_roles']);
        update_option("yp_allowed_users", $allowed_users);

        echo json_encode(array('status' => 'success', 'message' => 'Admin Bar Permissions Updated for selected users!'));
        exit();
    }

    /**
     * Function to get all user roles available in the website
     * @global type $wp_roles
     * @return type
     */
    public function getSiteUserRoles()
    {

        global $wp_roles;

        return $wp_roles->roles;
    }
}

$adminBar = new Hide_Administrator_Bar();

?>
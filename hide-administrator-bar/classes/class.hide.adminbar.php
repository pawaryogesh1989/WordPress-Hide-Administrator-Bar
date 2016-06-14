<?php

class Hide_Administrator_Bar {

    static $instance;

    //Constructor of the Class
    public function __construct() {

        self::$instance = $this;

        add_action('admin_menu', array($this, 'wp_admin_bar_menu'));
        add_action('admin_init', array($this, 'wp_adminbar_words_settings'));
        add_action('after_setup_theme', array($this, 'remove_admin_bar_frontend'));
    }

    public function wp_admin_bar_menu() {
        add_menu_page('Hide Admin Bar Settings', 'Hide Admin Bar Settings', 'manage_options', 'hide-admin-bar-settings', array($this, 'load_hide_admin_bar_settings_page'), '', 86);
    }

    public function remove_admin_bar_frontend() {

        $current_user = wp_get_current_user();

        if (get_option('hide_for_admin') != "false") {
            if ($current_user->roles[0] == "administrator" && $current_user->allcaps['manage_options'] == 1) {
                show_admin_bar(false);
            }
        }

        if (get_option('hide_for_all_users') != "false") {
            if ($current_user->roles[0] != "administrator" && $current_user->allcaps['manage_options'] != 1) {
                show_admin_bar(false);
            }
        }
    }

    public function load_hide_admin_bar_settings_page() {

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

    public function wp_adminbar_words_settings() {

        register_setting('admin-bar-words-group', 'hide_for_admin');
        register_setting('admin-bar-words-group', 'hide_for_all_users');
    }

}

?>
<?php
/**
 * @package Hide Administrator Bar
 */
/*
  Plugin Name: Hide Administrator Bar
  Plugin URI: http://www.clariontechnologies.co.in
  Description: Hide Administrator Bar
  Version: 3.0.0
  Author: Yogesh Pawar, Clarion Technologies
  Author URI: http://www.clariontechnologies.co.in
  License: GPLv2 or later
  Text Domain: Hide Administrator Bar
 */

//Plugin Constant
defined('ABSPATH') or die('Restricted direct access!');
add_action('in_plugin_update_message-' . plugin_basename(__FILE__), 'adminBarupdateNotice');

if (!class_exists('Hide_Administrator_Bar')) {
    require_once 'classes/class.hide.adminbar.php';
}

function adminBarupdateNotice()
{
    $info = __('<br /><br /><strong>Critical update:</strong> Please read the change log and plugin description for latest changes before updating to latest version.');
    echo '<span class="spam">' . ($info) . '</span>';
}

?>
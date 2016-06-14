<?php

/**
 * @package Hide Administrator Bar
 */
/*
  Plugin Name: Hide Administrator Bar
  Plugin URI: http://www.clariontechnologies.co.in
  Description: Hide Administrator Bar
  Version: 1.0.0
  Author: Yogesh Pawar, Clarion Technologies
  Author URI: http://www.clariontechnologies.co.in
  License: GPLv2 or later
  Text Domain: Hide Administrator Bar
 */

//Plugin Constant
defined('ABSPATH') or die('Restricted direct access!');

if (!class_exists('Hide_Administrator_Bar')) {
    require_once 'classes/class.hide.adminbar.php';
}

//Initialising Class Plugin
new Hide_Administrator_Bar();
?>
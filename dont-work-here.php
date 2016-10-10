<?php

/*
 * Plugin Name: Don't Work Here
 * Plugin URI: https://wordpress.org/plugins/quform-max-form-submissions/
 * Description: This plugins permanently shows a prominent message for all users within the administration.
 * Version: 1.0.0
 * Author: MOEWE GbR
 * Author URI: http://www.moewe.io/
 * Text Domain: dont-work-here
 */


class Dont_Work_Here {

    function __construct() {
        add_action('plugins_loaded', array($this, 'load_plugin_textdomain'));
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
        add_action('in_admin_header', array($this, 'show_the_annoying_message'));
    }

    function load_plugin_textdomain() {
        load_plugin_textdomain('dont-work-here', false, basename(dirname(__FILE__)) . '/languages/');
    }

    function admin_enqueue_scripts() {
        wp_enqueue_style('dont-work-here', plugins_url('style.css', __FILE__), false, '1.0.0');
    }

    function show_the_annoying_message() {
        $message = get_option('dont-work-here-message', __("Please don't do anything here. Ask your administrator for more information.", 'dont-work-here'));
        echo '<div id="dont-work-here-message">' . $message . '</div>';
    }
}

new Dont_Work_Here();

/**
 * Check for plugin updates
 */
require __DIR__ . '/libs/plugin-update-checker-3.1/plugin-update-checker.php';
$favpress_updater = PucFactory::buildUpdateChecker(
    'https://raw.githubusercontent.com/moewe-io/wordpress-dont-work-here-plugin/stable/updater.json',
    __FILE__, 'dont-work-here', 24
);
$favpress_updater->throttleRedundantChecks = true;

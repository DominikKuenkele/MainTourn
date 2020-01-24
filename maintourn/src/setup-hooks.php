<?php

namespace Maintourn;

use Maintourn\inlcudes\MaintournActivator;
use Maintourn\inlcudes\MaintournDeactivator;


defined('ABSPATH') or die("Direct access not allowed");


//---------------------------------
// Activation & Deactivation
//---------------------------------

register_activation_hook(MAINTOURN_PLUGIN_FILE, 'maintourn_activate');
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function maintourn_activate()
{
    MaintournActivator::activate();
}

register_deactivation_hook(MAINTOURN_PLUGIN_FILE, 'maintourn_deactivate');
/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function maintourn_deactivate()
{
    MaintournDeactivator::deactivate();
}


//----------------------------------
// Menu
//----------------------------------

add_action('admin_menu', 'add_admin_menu');

function add_admin_menu()
{
    add_menu_page(
        'Maintourn',
        'Maintourn',
        'manage_options',
        'maintourn',
//        'versionpress_page', // The function to be called to output the content for this page.
//        'dashicons-backup',  // The URL to the icon to be used for this menu. 
//        0.001234987          // The position in the menu order this item should appear.
    );
}


//----------------------------------
// CSS & JS
//----------------------------------

add_action('admin_enqueue_scripts', 'enqueue_styles_and_scripts');
add_action('wp_enqueue_scripts', 'enqueue_styles_and_scripts');

function enqueue_styles_and_scripts()
{
    wp_enqueue_style(
        'maintourn_public_style',
        plugin_dir_url(__FILE__) . 'css/public_stylesheet.css'
    );
}

add_action('admin_enqueue_scripts', 'enqueue_admin_styles_and_scripts');

function enqueue_admin_styles_and_scripts()
{
    wp_enqueue_style(
        'maintourn_admin_style',
        plugin_dir_url(__FILE__) . 'css/admin_stylesheet.css'
    );
}

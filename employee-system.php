<?php

/*
Plugin Name: Employee System
Description: This is free plugin.
Requires at least: 5.2
Requires PHP:7.2
Author URI:https://nabinmagar.com/
Author: Nabin Magar
Version: 1.0.0
Text Domain: employee-system

*/

define("EMS_PLUGIN_PATH", plugin_dir_path(__FILE__));

define("EMS_PlUGIN_URL", plugin_dir_url(__FILE__));



// Action hook for admin menu
add_action('admin_menu', 'employee_system_add_admin_menu');

// Add menu
function employee_system_add_admin_menu(){
    add_menu_page
    (
        'Employee System Menu',
         'Employee System',
          'manage_options',
           'employee-system',
            'emd_crud_system',
              'dashicons-admin-plugins',
                23
        );

        add_submenu_page(
          'employee-system',
          'Employee System Submenu',
          'Add Employee',
          'manage_options',
          'employee-system',
          'emd_crud_system',

        );

        add_submenu_page(
          'employee-system',
          'List Employee',
          'List Employee',
          'manage_options',
          'list-employee',
          'ems_list_employee'

        );
}

//Menu Handle Callback
function emd_crud_system(){
   
  include_once(EMS_PLUGIN_PATH.'/pages/add-employee.php');

}

// Submeu Handle Callback
function ems_list_employee(){

  include_once(EMS_PLUGIN_PATH.'/pages/list-employee.php');
 
}

//PLugin Activation Hook
register_activation_hook(__FILE__,'ems_create_table');

//Adding dynamic Table after activating plugin
function ems_create_table(){

  global $wpdb;

  $table_prefix = $wpdb->prefix; 
  $sql = "
      CREATE TABLE {$table_prefix}ems_form_data (
      `Id` int NOT NULL AUTO_INCREMENT,
      `name` varchar(120) DEFAULT NULL,
      `email` varchar(80) DEFAULT NULL,
      `phonenumber` varchar(50) DEFAULT NULL,
      `gender` enum('male','female','other') DEFAULT NULL,
      `designation` varchar(50) DEFAULT NULL,
      PRIMARY KEY (`Id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
  ";

  include_once ABSPATH . "wp-admin/includes/upgrade.php";

  dbDelta($sql);

}

//Plugin deactivation Hook
register_deactivation_hook(__FILE__,'ems_drop_table');

//Deleting dynamic table after deactivating plugin
function ems_drop_table(){

  global $wpdb;
  $table_prefix = $wpdb->prefix;

  $sql = "DROP TABLE IF EXISTS {$table_prefix}ems_form_data";

  $wpdb->query($sql);

}

//ADD CSS/JS to plugin
add_action('admin_enqueue_scripts', 'ems_add_plugin_assets');

//Enqueue CSS and JS Files
function ems_add_plugin_assets(){

  //CSS
  wp_enqueue_style('ems-bootstrap.min.css', EMS_PlUGIN_URL . 'css/bootstrap.min.css', array(), '1.0.0');

  wp_enqueue_style('ems-dataTables.dataTables.min.css', EMS_PlUGIN_URL . 'css/dataTables.dataTables.min.css', array(), '1.0.0');

  wp_enqueue_style('ems-custom.css', EMS_PlUGIN_URL . 'css/custom.css', array(), '1.0.0');

  //JS
  wp_enqueue_script('ems-bootstrap.min.js', EMS_PlUGIN_URL . 'js/bootstrap.min.js', array('jquery'), '1.0.0');

  wp_enqueue_script('ems-dataTables.min.js', EMS_PlUGIN_URL . 'js/dataTables.min.js', array('jquery'), '1.0.0');

  wp_enqueue_script('ems-jquery-validate-min.js', EMS_PlUGIN_URL . 'js/jquery.validate.min.js', array('jquery'), '1.0.0');

  wp_enqueue_script('ems-custom.js', EMS_PlUGIN_URL . 'js/custom.js', array('jquery'), '1.0.0');

}
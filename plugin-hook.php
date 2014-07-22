<?php

    /*
    Plugin Name: ZD Pre Loading
    Description: ZD Pre Loading plugin for your wordpress site. You can easily add a preload function in your wordpress site. 
    Plugin URI: http://#
    Author: Zakir Hossain
    Author URI: http://#
    Version: 1.0
    License: GPL2
    */
    
    /*
    
        Copyright (C) 2014  zakird46@gmail.com
    
        This program is free software; you can redistribute it and/or modify
        it under the terms of the GNU General Public License, version 2, as
        published by the Free Software Foundation.
    
        This program is distributed in the hope that it will be useful,
        but WITHOUT ANY WARRANTY; without even the implied warranty of
        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
        GNU General Public License for more details.
    
        You should have received a copy of the GNU General Public License
        along with this program; if not, write to the Free Software
        Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
    */

 
 
 
require_once dirname( __FILE__ ) . '/setting.php';
require_once dirname( __FILE__ ) . '/output-setting.php';


if ( !class_exists('zd_preloading_Settings_API_Test' ) ):
class zd_preloading_Settings_API_Test {

    private $settings_api;

    function __construct() {
        $this->settings_api = new WeDevs_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
        add_options_page( 'ZD Preload option', 'ZD Preload Options', 'delete_posts', 'settings_api_test', array($this, 'plugin_page') );
    }

    function get_settings_sections() {
        $sections = array(
            array(
                'id' => 'wedevs_basics',
                'title' => __( 'Preloader Settings', 'wedevs' )
            ),
           
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
            'wedevs_basics' => array(
                array(
                    'name' => 'preloadcolor',
                    'label' => __( 'Preload Custom Color ', 'wedevs' ),
                    'desc' => __( 'You can change the Preload color from here.The default color #00A800', 'wedevs' ),
                    'type' => 'color',
                    'default' => '#00A800'
                  
                ),
		
				),
        );

        return $settings_fields;
    }

    function plugin_page() {
        echo '<div class="wrap">';

        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}
endif;
/**
 * Get the value of a settings field
 *
 * @param string $option settings field name
 * @param string $section the section name this field belongs to
 * @param string $default default text if it's not found
 * @return mixed
 */
function my_get_option( $option, $section, $default = '' ) {
 
    $options = get_option( $section );
 
    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }
 
    return $default;
}



$settings = new zd_preloading_Settings_API_Test();
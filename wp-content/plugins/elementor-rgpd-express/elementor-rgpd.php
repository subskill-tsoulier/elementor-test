<?php
/**
 * Elementor Rgpd WordPress Plugin
 *
 * @package ElementorRgpd
 *
 * Plugin Name: Elementor Rgpd
 * Description: Components for custom block for RGPD Express, based on elementor core
 * Plugin URI:  https://www.subskill.com
 * Version:     1.0.0
 * Author:      SUBSKILL
 * Author URI:  https://www.subskill.com
 * Text Domain: elementor-rgpd
 */
define( "ELEMENTOR_RGPD", __FILE__ );
/**
 * Include the Elementor_Rgpd class.
 */
require plugin_dir_path( ELEMENTOR_RGPD ) . 'class-elementor-rgpd.php';
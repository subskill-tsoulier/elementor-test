<?php
/**
 * Rgpd class.
 *
 * @category   Class
 * @package    ElementorRgpd
 * @subpackage WordPress
 * @author     Subskill <contact@subskill.com>
 * @copyright  2022 Subskill
 * @license    https://opensource.org/licenses/GPL-3.0 GPL-3.0-only
 * @link       link(https://www.subskill.com/,
 *             Build Custom Elementor Widgets)
 * @since      1.0.0
 * php version 7.4.2
 */
namespace ElementorRgpd\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
// Security Note: Blocks direct access to the plugin PHP files.
defined( 'ABSPATH' ) || die();
/**
 * Rgpd widget class.
 *
 * @since 1.0.0
 */
class Action extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
        //wp_register_style( 'rgpd', plugins_url( '/assets/css/rgpd.css', ELEMENTOR_ASSYSTEM ), array(), '1.0.0' );
    }

    public function get_name() {
        return 'action';
    }

    public function get_style_depends() {
        return array( 'rgpd' );
    }

    /**
     * Render the widget output on the frontend.
     * Written in PHP and used to generate the final HTML.
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $hn     = "h3";
        $text   = "Hello world";

        require plugin_dir_path((((__FILE__)))) . 'public/'.$this->get_name().'.php';
    }
    /**
     * Render the widget output in the editor.
     * Written as a Backbone JavaScript template and used to generate the live preview.
     * @since 1.0.0
     * @access protected
     */
    protected function content_template() {
        //
    }

}
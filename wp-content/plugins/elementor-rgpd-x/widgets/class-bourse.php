<?php
/**
 * Assystem class.
 *
 * @category   Class
 * @package    ElementorAssystem
 * @subpackage WordPress
 * @author     Subskill <contact@subskill.com>
 * @copyright  2022 Subskill
 * @license    https://opensource.org/licenses/GPL-3.0 GPL-3.0-only
 * @link       link(https://www.subskill.com/,
 *             Build Custom Elementor Widgets)
 * @since      1.0.0
 * php version 7.4.2
 */
namespace ElementorAssystem\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
// Security Note: Blocks direct access to the plugin PHP files.
defined( 'ABSPATH' ) || die();
/**
 * Assystem widget class.
 *
 * @since 1.0.0
 */
class Bourse extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
    }

    public function get_name() {
        return 'bourse';
    }

    public function get_title() {
        return __( 'Bloc bourse', 'assystem' );
    }

    public function get_icon() {
        return 'eicon-product-upsell';
    }

    public function get_categories() {
        return array( 'assystem' );
    }

    public function get_style_depends() {
        return array( 'assystem' );
    }
    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'general',
            array(
                'label' => __( 'Configuration générale', 'assystem' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );
        $this->add_control(
            'overtitle',
            array(
                'label'         => __( 'Sur-titre du bloc', 'assystem' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__("Sur-titre du bloc", "assystem"),
                'default'       => esc_html__("Cours de l'action Assytem", "assystem")
            )
        );
        $this->add_control(
            'title',
            array(
                'label'         => __( 'Titre du bloc', 'assystem' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__("Title", "assystem"),
                'default'       => ""
            )
        );
        $this->end_controls_section();
    }
    /**
     * Render the widget output on the frontend.
     * Written in PHP and used to generate the final HTML.
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        $overtitle          = (!empty($settings['overtitle']))?$settings['overtitle']:'';
        $title              = (!empty($settings['title']))?$settings['title']:'';
        $link_json          = (function_exists("get_field"))?get_field("bourse_link", "option"):"";
        if( !empty($link_json) ) :
            $json_raw           = wp_remote_get($link_json);
            $action_datas       = apply_filters("get_bourse", "getActionAssystem");
        endif;
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
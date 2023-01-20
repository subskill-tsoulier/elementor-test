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
class Cta_Bloc extends Widget_Base {
    // Widget settings
    public function get_name() {
        return 'cta-bloc';
    }

    public function get_title() {
        return __( 'Bloc CTA', 'assystem' );
    }

    public function get_icon() {
        return 'eicon-download-button';
    }

    public function get_categories() {
        return array( 'assystem' );
    }

    public function get_style_depends() {
        return array( 'assystem' );
    }

    // Widget controls
    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'assystem' ),
            ]
        );

        $this->add_control(
            'cta_label',
            array(
                'label'   => __( 'CTA (libellé)', 'assystem' ),
                'type'    => Controls_Manager::TEXT,
                'default' => [],
            )
        );

        $this->add_control(
            'cta_theme',
            [
                'type'      => \Elementor\Controls_Manager::SELECT,
                'label'     => esc_html__( 'CTA (couleur)', 'assystem' ),
                'required'  => true,
                'toggle'    => false,
                'options'   => [
                    'red-decli'  => esc_html__( 'Rouge', 'assystem' ),
                    'blue-decli'   =>  esc_html__( 'Bleu', 'assystem' ),
                    'purple-decli'  => esc_html__( 'Violet', 'assystem' ),
                ],
                'default' => 'red-decli'
            ]
        );

        $this->add_control(
            'cta_position',
            [
                'type'      => \Elementor\Controls_Manager::SELECT,
                'label'     => esc_html__( 'CTA (position)', 'assystem' ),
                'required'  => true,
                'toggle'    => false,
                'options'   => [
                    'cta-center'  => esc_html__( 'Bouton centré', 'assystem' ),
                    'cta-left'   =>  esc_html__( 'Bouton ferré à gauche', 'assystem' ),
                    'cta-right'  => esc_html__( 'Bouton ferré à droite', 'assystem' ),
                ],
                'default' => 'cta-center'
            ]
        );
        $this->add_control(
            'cta_link',
            array(
                'label'   => __( 'CTA (lien)', 'assystem' ),
                'type'    => Controls_Manager::URL,
                'default' => [],
            )
        );

        $this->end_controls_section();
    }

    // Widget output
    protected function render() {
        // Get widget settings
        $settings = $this->get_settings_for_display();


        $cta_link           = (!empty($settings['cta_link']))?$settings['cta_link']:'';
        $cta_label          = (!empty($settings['cta_label']))?$settings['cta_label']:'';
        $cta_theme          = (!empty($settings['cta_theme']))?$settings['cta_theme']:'';
        $cta_position       = (!empty($settings['cta_position']))?$settings['cta_position']:'';
        require plugin_dir_path((((__FILE__)))) . 'public/'.$this->get_name().'.php';
        // Add your custom output here
    }
}

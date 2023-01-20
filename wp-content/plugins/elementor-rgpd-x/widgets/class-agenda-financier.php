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
class Agenda_Financier extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
    }

    public function get_name() {
        return 'agenda-financier';
    }

    public function get_title() {
        return __( 'Bloc agenda financier', 'assystem' );
    }

    public function get_icon() {
        return 'eicon-toggle';
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
            'featured',
            array(
                'label' => __( 'À la une', 'assystem' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );
        $this->add_control(
            'title',
            array(
                'label'         => __( 'Titre du bloc', 'assystem' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__("Titre du bloc", "assystem"),
                'default'       => ""
            )
        );
        $this->add_control(
            'hn',
            [
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label' => esc_html__( 'Type de balise pour le titre', 'assystem' ),
                'required' => true,
                'toggle' => false,
                'options' => [
                    'h1' => [
                        'title' => esc_html__( 'H1', 'assystem' ),
                        'icon' => 'eicon-editor-h1',
                    ],
                    'h2' => [
                        'title' => esc_html__( 'H2', 'assystem' ),
                        'icon' => 'eicon-editor-h2',
                    ],
                    'h3' => [
                        'title' => esc_html__( 'H3', 'assystem' ),
                        'icon' => 'eicon-editor-h3',
                    ],
                    'p' => [
                        'title' => esc_html__( 'P', 'assystem' ),
                        'icon' => 'eicon-editor-paragraph',
                    ],
                ],
                'default' => 'h2',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'title',
                            'operator' => '!=',
                            'value' => ''
                        ],
                    ]
                ],
            ]
        );
        $this->add_control(
            'background-color',
            [
                'type' => \Elementor\Controls_Manager::SELECT,
                'label' => esc_html__( 'Choix du fond de couleur du bloc', 'assystem' ),
                'required' => true,
                'toggle' => false,
                'options' => [
                    'bg-pink'     =>  esc_html__( 'Rouge', 'assystem' ),
                    'bg-white'    => esc_html__( 'Blanc', 'assystem' ),
                    'bg-blue'     => esc_html__( 'Bleu', 'assystem' ),
                    'bg-violet'   => esc_html__( 'Violet', 'assystem' ),
                    'bg-grey'     => esc_html__( 'Gris foncé', 'assystem' ),
                    'bg-light'    => esc_html__( 'Gris clair', 'assystem' )
                ],
                'default' => 'pink'
            ]
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
        $settings   = $this->get_settings_for_display();
        $today      = current_time('mysql');
        $args_agenda_financier = array(
            'post_type'     => 'agenda_financier',
            'lang'          => (function_exists('pll_current_language')?pll_get_post_language( get_the_ID()):'fr'),
            'numberposts'   => -1,
            'meta_key'		=> 'date',
            'orderby'       => 'meta_value',
            'order'			=> 'ASC',
            'meta_query'             => array(
                array(
                    'key'       => 'date',
                    'value'     => $today,
                    'compare'   => '>=',
                ),
            ),
        );
        $post_agenda_financier = get_posts($args_agenda_financier);
        wp_reset_postdata();
        $bgcolor    =   (!empty($settings['background-color']))?$settings['background-color']:'bg-pink';
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
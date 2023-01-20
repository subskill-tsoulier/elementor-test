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
class List_Testimony extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
        //wp_register_style( 'assystem', plugins_url( '/assets/css/assystem.css', ELEMENTOR_ASSYSTEM ), array(), '1.0.0' );
    }

    public function get_name() {
        return 'list-testimonies';
    }

    public function get_title() {
        return __( 'Bloc Liste Témoignages', 'assystem' );
    }

    public function get_icon() {
        return 'eicon-post-list';
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
            )
        );
        $this->add_control(
            'title',
            array(
                'label'   => __( 'Titre du bloc', 'assystem' ),
                'type'    => Controls_Manager::TEXT,
                'placeholder' => esc_html__("Title", "assystem"),
                'default' => "",
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
            'numberposts',
            array(
                'label'   => __( 'Nombre d\'éléments à afficher', 'assystem' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => '',
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
        $settings       = $this->get_settings_for_display();
        $numberposts    = (!empty($settings['numberposts']))?$settings['numberposts']:8;
        $paged          = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $args           = array(
            'post_type'     => 'temoignage',
            'lang'          => (function_exists('pll_current_language')?pll_get_post_language( get_the_ID()):'fr'),
            'posts_per_page'=> $numberposts,
            'numberposts'   => -1
        );

        // TEST DYNAMISATION TYPE FILTERS
        $get_types    = array();
        if( isset($_GET['testimonial_type']) ) {
            foreach($_GET['testimonial_type'] as $get_type) {
                $get_types[]   =   strip_tags($get_type);
            }
//            $args_tag[]   =   array(
//                'key'	 	=> 'testimonial_type',
//                'value'	  	=> $get_types,
//                'compare' 	=> 'IN',
//            );
            $args['meta_query'] = array(
                'relation'		=> 'OR',
                array(
                    'key'	 	=> 'testimonial_type',
                    'value'	  	=> $get_types,
                    'compare' 	=> 'IN',
                )
            );
        }
        $the_query 		= new \WP_Query( $args );

        $title  = $settings['title'];
        $hn     = (!empty($settings['hn']))?$settings['hn']:'h2';
        $title  = (!empty($settings['title']))?$settings['title']:'';

        $chips          = array();
        if( !empty($get_types) ) {
            foreach($get_types as $type) {
                $name       =   __("Article", "assystem"); // default
                if( $type == "podcast" ) {
                    $name   =   __("Podcast", "assystem");
                }
                if( $type == "video" ){
                    $name   =   __("Vidéo", "assystem");
                }
                $chips[]    =   array(
                    'ref'   => 'collapse-type',
                    'id'    => $type,
                    'name'  => $name
                );
            }
        }
        // end TEST

        // $settings < contain all vars
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
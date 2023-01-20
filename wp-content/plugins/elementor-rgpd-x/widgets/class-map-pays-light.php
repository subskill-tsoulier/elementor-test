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
class MapPaysLight extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
        //wp_register_style( 'assystem', plugins_url( '/assets/css/assystem.css', ELEMENTOR_ASSYSTEM ), array(), '1.0.0' );
    }

    public function get_name() {
        return 'map-pays-light';
    }

    public function get_title() {
        return __( 'Bloc map pays (Eco)', 'assystem' );
    }

    public function get_icon() {
        return 'eicon-global-settings';
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
            'text',
            array(
                'label'   => __( 'Texte du bloc', 'assystem' ),
                'type'    => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__("Texte du bloc", "assystem"),
                'default' => "",
            )
        );
        $options    = array();
        $posts      = get_posts(array(
            'lang'              => (function_exists('pll_current_language')?pll_get_post_language( get_the_ID()):'fr'),
            'post_type'         => 'pays',
            'numberposts'       => -1
        ));
        wp_reset_postdata();
        foreach ($posts as $post){
            $options[$post->ID] = $post->post_title;
        }
        $this->add_control(
            'country_id',
            array(
                'label'         => __('Choix du pays à remonter', 'assystem-corpo'),
                'type'          => Controls_Manager::SELECT,
                'options'       => $options,
                'title'         => __('Choix du pays à remonter', 'assystem-corpo'),
                'label_block'   => true,
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
        $settings   =   $this->get_settings_for_display();
        $args_max   =   array(
            'post_type'     => 'local',
            'lang'          => (function_exists('pll_current_language')?pll_get_post_language( get_the_ID()):'fr'),
            'numberposts'   =>  -1
        );
        $locals_max         =   get_posts($args_max);
        $count_locals       =   count($locals_max);
        $args       =   array(
            'post_type'     => 'local',
            'lang'          => (function_exists('pll_current_language')?pll_get_post_language( get_the_ID()):'fr'),
            'numberposts'   =>  6,
            'order'         => 'ASC',
            'orderby'       => 'title'
        );
        $country_id         =   (!empty($settings['country_id']))?$settings['country_id']:'';
        if( !empty($country_id) ):
            $args['meta_key']   =   'country';
            $args['meta_value'] =   $country_id;
        endif;
        $locals             =   get_posts($args);
        wp_reset_postdata();
        $map_zoom           =   (!empty($settings['zoom_level']))?$settings['zoom_level']:4;
        $latitude_map       =   (!empty($settings['latitude']))?$settings['latitude']:24.466667;
        $longitude_map      =   (!empty($settings['longitude']))?$settings['longitude']:54.366669;

        $map_pins           =   array();
        foreach($locals as $local):
            $address    =   (get_field("address", $local->ID));
            if( !empty($address['lat']) && !empty($address['lng']) ) {
                $map_pins[] = array(
                    'lat' => $address['lat'],
                    'lon' => $address['lng']
                );
            }
        endforeach;

        $title              = !empty($settings['title'])?$settings['title']:'';
        $hn                 = (!empty($settings['hn']))?$settings['hn']:'h2';
        $text               = !empty($settings['text'])?$settings['text']:'';
        $latitude           = !empty($settings['latitude'])?$settings['latitude']:'';
        $longitude          = !empty($settings['longitude'])?$settings['longitude']:'';
        $zoom_level         = !empty($settings['zoom_level'])?$settings['zoom_level']:'';
        $custom_map_style   = !empty($settings['custom_map_style'])?$settings['custom_map_style']:'';
        
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
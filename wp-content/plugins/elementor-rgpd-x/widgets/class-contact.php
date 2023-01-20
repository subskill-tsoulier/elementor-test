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
class Contact extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
    }

    public function get_name() {
        return 'contact';
    }

    public function get_title() {
        return __( 'Bloc Contact', 'assystem' );
    }

    public function get_icon() {
        return 'eicon-user-circle-o';
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
                'label' => __( 'Configuration du bloc', 'assystem' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );
        $this->add_control(
            'title',
            array(
                'label'   => __( 'Titre du bloc', 'assystem' ),
                'type'    => Controls_Manager::TEXT,
                'placeholder' => esc_html__("Title", "assystem"),
                'default' => __("UNE QUESTION, UN PROJET ?", "assystem"),
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
            'cta_label',
            array(
                'label'   => __( 'Libellé du lien', 'assystem' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __("Nous contacter", "assystem"),
            )
        );
        $pages  = array();
        $posts = get_posts(array(
            'lang'              => (function_exists('pll_current_language')?pll_get_post_language( get_the_ID()):'fr'),
            'post_type'         => 'page',
            'numberposts'       => -1
        ));
        wp_reset_postdata();
        foreach ($posts as $post){
            $pages[$post->ID] = $post->post_title;
        }
        if( function_exists('get_field') ) {
            $url_default_hub_contact = get_field("business_contact_hub", "option");
        } else {
            $url_default_hub_contact = "";
        }
        $this->add_control(
            'cta_link',
            array(
                'label'         => __('Lien vers page', 'assystem-corpo'),
                'type'          => Controls_Manager::SELECT,
                'options'       => $pages,
                'title'         => __('Lien vers page', 'assystem-corpo'),
                'label_block'   => true,
                'default'       => (!empty($url_default_hub_contact) && !empty($url_default_hub_contact['url']))?url_to_postid($url_default_hub_contact['url']):''
            )
        );
        $this->add_control(
            'background-color',
            [
                'type' => \Elementor\Controls_Manager::SELECT,
                'label' => esc_html__( 'Choix du fond de couleur du bloc', 'assystem' ),
                'required' => true,
                'toggle' => false,
                'options' => [
                    'bg-pink'   =>  esc_html__( 'Rouge principal', 'assystem' ),
                    'bg-white'  => esc_html__( 'Blanc', 'assystem' ),
                    'bg-light'  => esc_html__( 'Gris clair', 'assystem' ),
                    'bg-grey'   => esc_html__( 'Gris foncé', 'assystem' ),
                    'bg-violet' => esc_html__( 'Violet', 'assystem' ),
                    'bg-blue'   => esc_html__( 'Bleu', 'assystem' )
                ],
                'default' => 'bg-pink'
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
        $bgcolor    = (!empty($settings['background-color']))?$settings['background-color']:'bg-pink';
        $bgcolor    = ($bgcolor == "grey")?"bg-light":$bgcolor;
        $bgcolor    = ($bgcolor == "white")?"bg-white":$bgcolor;
        $title      = (!empty($settings['title']))?$settings['title']:'';
        $hn         = (!empty($settings['hn']))?$settings['hn']:'h2';
        $cta_link   = (!empty($settings['cta_link']))?$settings['cta_link']:'';
        $cta_label  = (!empty($settings['cta_label']))?$settings['cta_label']:'';
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
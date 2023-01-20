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
class List_Membres extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
    }

    public function get_name() {
        return 'list-membres';
    }

    public function get_title() {
        return __( 'Bloc liste équipe', 'assystem' );
    }

    public function get_icon() {
        return 'eicon-lock-user';
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
            'background-color',
            [
                'type' => \Elementor\Controls_Manager::SELECT,
                'label' => esc_html__( 'Choix du fond de couleur du bloc', 'assystem' ),
                'required' => true,
                'toggle' => false,
                'options' => [
                    'bg-pink'   =>  esc_html__( 'Couleur principale', 'assystem' ),
                    'bg-white'  => esc_html__( 'Blanc', 'assystem' ),
                    'bg-light'  => esc_html__( 'Gris', 'assystem' )
                ],
                'default' => 'bg-light'
            ]
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
                'type'    => Controls_Manager::WYSIWYG,
                'placeholder' => esc_html__("Texte du bloc", "assystem"),
                'default' => "",
            )
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'elements',
            array(
                'label' => __( 'Éléments', 'assystem' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );
        $pages  = array();
        $posts = get_posts(array(
            'lang'              => (function_exists('pll_current_language')?pll_get_post_language( get_the_ID()):'fr'),
            'post_type'         => 'equipe',
            'numberposts'       => -1
        ));
        wp_reset_postdata();
        foreach ($posts as $post){
            $pages[$post->ID] = $post->post_title;
        }
        // REPEATER
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'post_id',
            array(
                'label'         => __('Contenu à remonter', 'assystem-corpo'),
                'type'          => Controls_Manager::SELECT,
                'options'       => $pages,
                'title'         => __('Contenu à remonter', 'assystem-corpo'),
                'label_block'   => true,
                'prevent_empty' => false,
            )
        );
        $this->add_control(
            'list',
            [
                'label' => __( 'Publications', 'elementor-awesomesauce' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
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
        
        $posts      = array();
        $list       = $settings['list'];
        foreach($list as $li) {
            $posts[]    =   get_post($li['post_id']);
        }
        $title  =   (!empty($settings['title']))?$settings['title']:'';
        $hn     =   (!empty($settings['hn']))?$settings['hn']:'h2';
        $bgcolor=   (!empty($settings['background-color']))?$settings['background-color']:'bg-light';
        $text   =   (!empty($settings['text']))?$settings['text']:'';
        
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
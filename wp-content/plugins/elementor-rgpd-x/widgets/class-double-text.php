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
// Security Note: Blocks direct access to the plugin PHP files.
defined( 'ABSPATH' ) || die();
/**
 * Assystem widget class.
 *
 * @since 1.0.0
 */
class Double_Text extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
        //wp_register_style( 'assystem', plugins_url( '/assets/css/assystem.css', ELEMENTOR_ASSYSTEM ), array(), '1.0.0' );
    }

    public function get_name() {
        return 'double-text';
    }

    public function get_title() {
        return __( 'Bloc double texte (sans séparation)', 'assystem' );
    }

    public function get_icon() {
        return 'eicon-columns';
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
            'col_left',
            array(
                'label' => __( 'Partie gauche', 'assystem' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );
        $this->add_control(
            'col_left_icon',
            [
                'label'         => __( 'Icône du bloc', 'assystem' ),
                'type'          => Controls_Manager::MEDIA,
                'media_types'   => ['svg'],
                'default'       => [],
            ]
        );
        $this->add_control(
            'col_left_title',
            [
                'label'   => __( 'Titre du bloc', 'assystem' ),
                'type' => Controls_Manager::TEXT,
                'default' => ''
            ]
        );
        $this->add_control(
            'col_left_hn',
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
                            'name' => 'col_left_title',
                            'operator' => '!=',
                            'value' => ''
                        ],
                    ]
                ],
            ]
        );
        $this->add_control(
            'col_left_background-color',
            [
                'type' => \Elementor\Controls_Manager::SELECT,
                'label' => esc_html__( 'Choix du fond de couleur du bloc', 'assystem' ),
                'required' => true,
                'toggle' => false,
                'options' => [
                    'bg-pink'   =>  esc_html__( 'Rouge', 'assystem' ),
                    'bg-blue'   =>  esc_html__( 'Bleu', 'assystem' ),
                    'bg-violet' =>  esc_html__( 'Violet', 'assystem' ),
                    'bg-light'  => esc_html__( 'Gris clair', 'assystem' ),
                    'bg-grey'  => esc_html__( 'Gris foncé', 'assystem' ),
                ],
                'default' => 'bg-light'
            ]
        );
        $this->add_control(
            'col_left_text',
            [
                'label'   => __( 'Texte du bloc', 'assystem' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => ''
            ]
        );
        $this->end_controls_section();
        //
        $this->start_controls_section(
            'col_right',
            array(
                'label' => __( 'Bloc droite', 'assystem' ),
            )
        );
        $this->add_control(
            'col_right_icon',
            [
                'label'         => __( 'Icône du bloc', 'assystem' ),
                'type'          => Controls_Manager::MEDIA,
                'media_types'   => ['svg'],
                'default'       => [],
            ]
        );
        $this->add_control(
            'col_right__title',
            array(
                'label'   => __( 'Titre', 'assystem' ),
                'type'    => Controls_Manager::TEXT,
                'placeholder' => esc_html__("Titre", "assystem"),
                'default' => "",
            )
        );
        $this->add_control(
            'col_right_hn',
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
                            'name' => 'col_right__title',
                            'operator' => '!=',
                            'value' => ''
                        ],
                    ]
                ],
            ]
        );
        $this->add_control(
            'col_right_background-color',
            [
                'type' => \Elementor\Controls_Manager::SELECT,
                'label' => esc_html__( 'Choix du fond de couleur du bloc', 'assystem' ),
                'required' => true,
                'toggle' => false,
                'options' => [
                    'bg-pink'   =>  esc_html__( 'Rouge', 'assystem' ),
                    'bg-blue'   =>  esc_html__( 'Bleu', 'assystem' ),
                    'bg-violet' =>  esc_html__( 'Violet', 'assystem' ),
                    'bg-light'  => esc_html__( 'Gris clair', 'assystem' ),
                    'bg-grey'  => esc_html__( 'Gris foncé', 'assystem' ),
                ],
                'default' => 'bg-light'
            ]
        );
        $this->add_control(
            'col_right_text',
            [
                'label'   => __( 'Texte du bloc', 'assystem' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => ''
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
        $settings           = $this->get_settings_for_display();
        $col_left_icon      = (!empty($settings['col_left_icon']))?$settings['col_left_icon']:'';
        $col_left_title     = (!empty($settings['col_left_title']))?$settings['col_left_title']:'';
        $col_left_text      = (!empty($settings['col_left_text']))?$settings['col_left_text']:'';
        $col_left_bg        = (!empty($settings['col_left_background-color']))?$settings['col_left_background-color']:'';
        //
        $col_right_icon     = (!empty($settings['col_right_icon']))?$settings['col_right_icon']:'';
        $col_right__title   = (!empty($settings['col_right_title']))?$settings['col_right_title']:'';
        $col_right_text     = (!empty($settings['col_right_text']))?$settings['col_right_text']:'';
        $col_right_bg       = (!empty($settings['col_right_background-color']))?$settings['col_right_background-color']:'';
        
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
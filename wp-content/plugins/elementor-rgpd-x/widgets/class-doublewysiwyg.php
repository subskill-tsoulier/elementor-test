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
class Doublewysiwyg extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
        //wp_register_style( 'assystem', plugins_url( '/assets/css/assystem.css', ELEMENTOR_ASSYSTEM ), array(), '1.0.0' );
    }

    public function get_name() {
        return 'doublewysiwyg';
    }

    public function get_title() {
        return __( 'Double Wysiwyg', 'assystem' );
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
            'general',
            array(
                'label' => __( 'Configuration du bloc', 'assystem' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );
        $this->add_control(
            'display_title',
            [
                'label'   => __( 'Afficher un titre au bloc', 'assystem' ),
                'description'   => esc_html__("Si vous souhaitez afficher le titre, alors les deux blocs ne seront plus dans des cadres.", "assystem"),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __( 'Hide', 'elementor' ),
                'label_on' => __( 'Show', 'elementor' ),
                'default' => 'no',
            ]
        );
        $this->add_control(
            'title',
            [
                'label'   => __( 'Titre du bloc', 'assystem' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'condition' => [
                    'display_title' => 'yes',
                ],
            ]
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
            'display_link',
            [
                'label'   => __( 'Afficher un lien sous le bloc', 'assystem' ),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __( 'Hide', 'elementor' ),
                'label_on' => __( 'Show', 'elementor' ),
                'default' => 'no',
            ]
        );
        $this->add_control(
            'cta_link',
            [
                'label'   => __( 'CTA (lien) du bloc', 'assystem' ),
                'type' => Controls_Manager::URL,
                'default' => [],
                'condition' => [
                    'display_link' => 'yes',
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
                    'bg-pink'   =>  esc_html__( 'Rouge principal', 'assystem' ),
                    'bg-white'  => esc_html__( 'Blanc', 'assystem' ),
                    'bg-light'  => esc_html__( 'Gris clair', 'assystem' ),
                    'bg-grey'   => esc_html__( 'Gris foncé', 'assystem' ),
                    'bg-violet' => esc_html__( 'Violet', 'assystem' ),
                    'bg-blue'   => esc_html__( 'Bleu', 'assystem' )
                ],
                'default' => 'bg-light'
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'left_content',
            array(
                'label' => __( 'Bloc gauche', 'assystem' ),
            )
        );
        $this->add_control(
            'left_title',
            array(
                'label'   => __( 'Titre', 'assystem' ),
                'type'    => Controls_Manager::TEXT,
                'placeholder' => esc_html__("Titre", "assystem"),
                'default' => "",
            )
        );
        $this->add_control(
            'left_hn',
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
                            'name' => 'left_title',
                            'operator' => '!=',
                            'value' => ''
                        ],
                    ]
                ],
            ]
        );
        $this->add_control(
            'left_description',
            array(
                'label'   => __( 'Texte', 'assystem' ),
                'type'    => Controls_Manager::WYSIWYG,
                'placeholder' => esc_html__("Description", "assystem"),
                'default' => "",
            )
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'right_content',
            array(
                'label' => __( 'Bloc droite', 'assystem' ),
            )
        );
        $this->add_control(
            'right_title',
            array(
                'label'   => __( 'Titre', 'assystem' ),
                'type'    => Controls_Manager::TEXT,
                'placeholder' => esc_html__("Titre", "assystem"),
                'default' => "",
            )
        );
        $this->add_control(
            'right_hn',
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
                            'name' => 'right_title',
                            'operator' => '!=',
                            'value' => ''
                        ],
                    ]
                ],
            ]
        );
        $this->add_control(
            'right_description',
            array(
                'label'   => __( 'Texte', 'assystem' ),
                'type'    => Controls_Manager::WYSIWYG,
                'placeholder' => esc_html__("Description", "assystem"),
                'default' => "",
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
        $hn             = (!empty($settings['hn']))?$settings['hn']:'h2';
        $title          = (!empty($settings['title']))?$settings['title']:'';
        $bgcolor        = (!empty($settings['background-color']))?$settings['background-color']:'bg-pink';
        $display_title  = (!empty($settings['display_title']))?$settings['display_title']:'';
        //
        $left_title     = (!empty($settings['left_title']))?$settings['left_title']:'';
        $left_description= (!empty($settings['left_description']))?$settings['left_description']:'';
        $hn_left        = (!empty($settings['left_hn']))?$settings['left_hn']:'h2';
        //
        $right_title    = (!empty($settings['right_title']))?$settings['right_title']:'';
        $right_description= (!empty($settings['right_description']))?$settings['right_description']:'';
        $hn_right       = (!empty($settings['right_hn']))?$settings['right_hn']:'h2';
        //
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
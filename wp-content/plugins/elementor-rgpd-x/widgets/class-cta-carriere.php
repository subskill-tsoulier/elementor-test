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
class Cta_Carriere extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
    }

    public function get_name() {
        return 'cta-carriere';
    }

    public function get_title() {
        return __( 'Bloc CTA Carrière (Switcher)', 'assystem' );
    }

    public function get_icon() {
        return 'eicon-alert';
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
            'display_as_banner',
            array(
                'label'   => __( 'Bannière', 'assystem' ),
                'type'    => Controls_Manager::SWITCHER,
                'description' => esc_html__("Si vous souhaitez mettre ce bloc en bannière, activez le switch.", "assystem"),
                'label_on' => esc_html__( 'Oui', 'assystem' ),
                'label_off' => esc_html__( 'Non', 'assystem' ),
                'return_value' => 'yes',
                'default'   => 'no',
                'separator' => 'after'
            )
        );
        $this->add_control(
            'display_mode',
            [
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'label'     => esc_html__( 'Type d\'affichage', 'assystem' ),
                'required'  => true,
                'toggle'    => false,
                'options'   => [
                    'horizontal' => [
                        'title' => esc_html__( 'Horizontal', 'assystem' ),
                        'icon'  => 'eicon-navigation-horizontal'
                    ],
                    'vertical' => [
                        'title' => esc_html__( 'Vertical', 'assystem' ),
                        'icon'  => 'eicon-navigation-vertical'
                    ],
                ],
                'default' => 'horizontal',
            ]
        );
        $this->add_control(
            'overtitle',
            array(
                'label'   => __( 'Sur-titre du bloc', 'assystem' ),
                'type'    => Controls_Manager::TEXT,
                'placeholder' => esc_html__("Sur-titre", "assystem"),
                'default' => "",
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
            'background-color',
            [
                'type'      => \Elementor\Controls_Manager::SELECT,
                'label'     => esc_html__( 'Choix du fond de couleur du bloc', 'assystem' ),
                'required'  => true,
                'toggle'    => false,
                'options'   => [
                    'pink'   =>  esc_html__( 'Rouge principal', 'assystem' ),
                    'white'  => esc_html__( 'Blanc', 'assystem' ),
                    'light'  => esc_html__( 'Gris clair', 'assystem' ),
                    'grey'   => esc_html__( 'Gris foncé', 'assystem' ),
                    'violet' => esc_html__( 'Violet', 'assystem' ),
                    'blue'   => esc_html__( 'Bleu', 'assystem' )
                ],
                'default' => 'pink'
            ]
        );
        $this->add_control(
            'text',
            array(
                'label'         => __( 'Texte du bloc', 'assystem' ),
                'type'          => Controls_Manager::WYSIWYG,
                'placeholder'   => esc_html__("Description", "assystem"),
                'default'       => '',
            )
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
            'cta_link',
            array(
                'label'   => __( 'CTA (lien)', 'assystem' ),
                'type'    => Controls_Manager::URL,
                'default' => [],
            )
        );
        $this->add_control(
            'image', [
                'label' => __( 'Image', 'assystem' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
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
        $display_as_banner  = (!empty($settings['display_as_banner']))?$settings['display_as_banner']:false;
        $bgcolor            = (!empty($settings['background-color']))?$settings['background-color']:'pink';
        $image              = !empty($settings['image'])?$settings['image']:'';
        if( !empty($image) ) {
            $image['url']    = wp_get_attachment_image_url($image['id'], 'cta-carriere-img');
        }
        $title              = (!empty($settings['title']))?$settings['title']:'';
        $hn                 = (!empty($settings['hn']))?$settings['hn']:'h2';
        $text               = (!empty($settings['text']))?$settings['text']:'';
        $cta_link           = (!empty($settings['cta_link']))?$settings['cta_link']:'';
        $cta_label          = (!empty($settings['cta_label']))?$settings['cta_label']:'';
        $display_mode       = (!empty($settings['display_mode']))?$settings['display_mode']:'horizontal';
        $overtitle          = (!empty($settings['overtitle']))?$settings['overtitle']:'';
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
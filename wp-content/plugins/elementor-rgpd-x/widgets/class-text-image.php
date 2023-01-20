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
class Text_Image extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
    }

    public function get_name() {
        return 'text-image';
    }

    public function get_title() {
        return __( 'Bloc Texte / Image', 'assystem' );
    }

    public function get_icon() {
        return 'eicon-image-box';
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
            'background-color-text',
            [
                'type'      => \Elementor\Controls_Manager::SELECT,
                'label'     => esc_html__( 'Choix du fond de couleur (texte)', 'assystem' ),
                'required'  => true,
                'toggle'    => false,
                'options'   => [
                    'bg-pink'  =>  esc_html__( 'Couleur rouge', 'assystem' ),
                    'bg-blue'  =>  esc_html__( 'Couleur bleue', 'assystem' ),
                    'bg-violet'=>  esc_html__( 'Couleur violet', 'assystem' ),
                    'bg-white' =>  esc_html__( 'Couleur blanc', 'assystem' ),
                    'bg-grey'  =>  esc_html__( 'Couleur gris foncé', 'assystem' ),
                    'bg-light' =>  esc_html__( 'Couleur gris clair', 'assystem' ),
                ],
                'description' => esc_html__("Couleur principale : le fond du texte est rouge | Gris : le fond du texte est gris | Blanc : Le fond du texte est blanc"),
                'default' => 'red'
            ]
        );
        $this->add_control(
            'background-color-img',
            [
                'type'      => \Elementor\Controls_Manager::SELECT,
                'label'     => esc_html__( 'Choix du fond de couleur (image)', 'assystem' ),
                'required'  => true,
                'toggle'    => false,
                'options'   => [
                    'bg-pink'  =>  esc_html__( 'Couleur principale', 'assystem' ),
                    'bg-white' =>  esc_html__( 'Couleur blanc', 'assystem' ),
                    'bg-blue'  =>  esc_html__( 'Couleur bleue', 'assystem' ),
                    'bg-violet'=>  esc_html__( 'Couleur violet', 'assystem' )
                ],
                'description' => esc_html__("Ce champ définit la couleur de la partie 'image'."),
                'default' => 'bg-pink'
            ]
        );
        $this->add_control(
            'display',
            [
                'type'      => \Elementor\Controls_Manager::SELECT,
                'label'     => esc_html__( 'Affichage du bloc', 'assystem' ),
                'required'  => true,
                'toggle'    => false,
                'options'   => [
                    'half'  =>  esc_html__( '50/50', 'assystem' ),
                    'third' => esc_html__( '40/60', 'assystem' ),
                ],
                'default' => 'half'
            ]
        );
        $this->add_control(
            'display_cover',
            array(
                'label'   => __( 'Afficher l\'image dans toute la zone (couverture)', 'assystem' ),
                'type'    => Controls_Manager::SWITCHER,
                'description' => esc_html__("Si vous souhaitez afficher l'image en plein pot dans la zone dédiée, activez le switch.", "assystem"),
                'label_on' => esc_html__( 'Oui', 'assystem' ),
                'label_off' => esc_html__( 'Non', 'assystem' ),
                'return_value' => 'yes',
                'default' => 'yes',
            )
        );
        $this->add_control(
            'display_right',
            array(
                'label'   => __( 'Afficher l\'image à droite', 'assystem' ),
                'type'    => Controls_Manager::SWITCHER,
                'description' => esc_html__("Si vous souhaitez afficher l'image à gauche, désactivez le switch.", "assystem"),
                'label_on' => esc_html__( 'Oui', 'assystem' ),
                'label_off' => esc_html__( 'Non', 'assystem' ),
                'return_value' => 'yes',
                'default' => 'yes',
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
                'label'   => __( 'Texte', 'assystem' ),
                'type'    => Controls_Manager::WYSIWYG,
                'default' => '',
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
        $this->add_control(
            'display_cta',
            array(
                'label'         => __( 'Afficher un CTA sous le texte', 'assystem' ),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => esc_html__("Si vous souhaitez afficher un CTA, activez le switch.", "assystem"),
                'label_on'      => esc_html__( 'Oui', 'assystem' ),
                'label_off'     => esc_html__( 'Non', 'assystem' ),
                'return_value'  => 'yes',
                'default'       => '',
            )
        );
        $this->add_control(
            'cta_label', [
                'label'         => __( 'Intitulé du lien', 'assystem' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'default'       => "",
                'label_block'   => true,
                'condition'     => [
                    'display_cta'   => 'yes'
                ]
            ]
        );
        $this->add_control(
            'cta_link', [
                'label'         => __( 'Lien (URL)', 'assystem' ),
                'type'          => \Elementor\Controls_Manager::URL,
                'label_block'   => true,
                'condition'     => [
                    'display_cta'   => 'yes'
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
        $backgroundColorImg = !empty($settings['background-color-img'])?$settings['background-color-img']:'';
        $backgroundColorText= !empty($settings['background-color-text'])?$settings['background-color-text']:'';
        $classes            = "";
        if( !empty($backgroundColorText) ):
            switch($backgroundColorText) {
                case "pink":
                    $classes .= "bg-pink ";
                    break;
                case "blue":
                    $classes .= "bg-blue ";
                    break;
                case "violet":
                    $classes .= "bg-violet ";
                    break;
                case "grey":
                    $classes .= "bg-light ";
                    break;
                case "white":
                    $classes .= "bg-white ";
                    break;
                default:
                    $classes .= $backgroundColorText." ";
                    break;
            }
        endif;
        if( !empty($backgroundColorImg) ):
            switch($backgroundColorImg) {
                case "default":
                case "pink":
                    break;
                case "blue":
                    $classes .= "blue-block ";
                    break;
                case "violet":
                    $classes .= "violet-block ";
                    break;
            }
        endif;
        $display            = !empty($settings['display'])?$settings['display']:'no';
        $displayRight       = !empty($settings['display_right'])?$settings['display_right']:'no';
        $displayCta         = !empty($settings['display_cta'])?$settings['display_cta']:'no';
        $displayCover       = !empty($settings['display_cover'])?$settings['display_cover']:'no';
        $title              = !empty($settings['title'])?$settings['title']:'';
        $hn                 = !empty($settings['hn'])?$settings['hn']:'h2';
        $text               = !empty($settings['text'])?$settings['text']:'';
        $image              = !empty($settings['image'])?$settings['image']:'';
        $ctaLabel           = !empty($settings['cta_label'])?$settings['cta_label']:'';
        $ctaLink            = !empty($settings['cta_link'])?$settings['cta_link']:'';
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
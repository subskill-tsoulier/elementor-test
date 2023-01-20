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
class Quote extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
        //wp_register_style( 'assystem', plugins_url( '/assets/css/assystem.css', ELEMENTOR_ASSYSTEM ), array(), '1.0.0' );
    }

    public function get_name() {
        return 'quote';
    }

    public function get_title() {
        return __( 'Bloc Citation', 'assystem' );
    }

    public function get_icon() {
        return 'eicon-editor-quote';
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
            'subtitle',
            array(
                'label'   => __( 'Sous-titre du bloc', 'assystem' ),
                'type'    => Controls_Manager::TEXT,
                'placeholder' => esc_html__("Sous-titre du bloc", "assystem"),
                'default' => "",
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
        $this->add_control(
            'display_quote',
            array(
                'label'         => __( 'Afficher les guillemets', 'assystem' ),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => esc_html__("Si vous souhaitez afficher les guillemets. Lorsque les guillemets ne sont pas affichés, vous pouvez contribuer 2 boutons.", "assystem"),
                'label_on'      => esc_html__( 'Oui', 'assystem' ),
                'label_off'     => esc_html__( 'Non', 'assystem' ),
                'return_value'  => 'yes',
                'default'       => 'yes',
            )
        );
        $this->add_control(
            'display_quote_after_name',
            array(
                'label'         => __( 'Afficher les guillemets après le nom de l\'auteur', 'assystem' ),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => esc_html__("Si vous souhaitez afficher les guillemets après le nom de l'auteur, switchez.", "assystem"),
                'label_on'      => esc_html__( 'Oui', 'assystem' ),
                'label_off'     => esc_html__( 'Non', 'assystem' ),
                'return_value'  => 'yes',
                'default'       => 'no',
            )
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'quote',
            array(
                'label' => __( 'Citation', 'assystem' ),
            )
        );
        $this->add_control(
            'display_image',
            array(
                'label'   => __( 'Afficher une image de fond', 'assystem' ),
                'type'    => Controls_Manager::SWITCHER,
                'description' => esc_html__("Si vous définissez une image, le fond de couleur n'apparaîtra pas.", "assystem"),
                'label_on' => esc_html__( 'Oui', 'assystem' ),
                'label_off' => esc_html__( 'Non', 'assystem' ),
                'return_value' => 'yes',
                'default' => 'no',
            )
        );
        $this->add_control(
            'filtre',
            array(
                'label'   => __( "Ajouter un filtre sur l'image", 'assystem' ),
                'type'    => Controls_Manager::SWITCHER,
                'description' => esc_html__("Un filtre noir sur l'image", "assystem"),
                'label_on' => esc_html__( 'Oui', 'assystem' ),
                'label_off' => esc_html__( 'Non', 'assystem' ),
                'return_value' => 'yes',
                'default' => 'no',
            )
        );
        $this->add_control(
            'image', [
                'label' => __( 'Image', 'assystem' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'display_image',
                            'operator' => '=',
                            'value' => 'yes'
                        ],
                    ]
                ],
            ]
        );
        $this->add_control(
            'text',
            array(
                'label'   => __( 'Citation', 'assystem' ),
                'type'    => Controls_Manager::WYSIWYG,
                'placeholder' => esc_html__("Citation", "assystem"),
                'default' => "",
            )
        );
        $this->add_control(
            'name',
            array(
                'label'   => __( 'Nom', 'assystem' ),
                'type'    => Controls_Manager::TEXT,
                'placeholder' => esc_html__("Nom / Prénom", "assystem"),
                'default' => "",
            )
        );
        $this->add_control(
            'function',
            array(
                'label'   => __( 'Poste', 'assystem' ),
                'type'    => Controls_Manager::TEXT,
                'placeholder' => esc_html__("Poste occupé", "assystem"),
                'default' => "",
            )
        );
        $this->end_controls_section();
        //
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
        //
        $this->start_controls_section(
            'cta_1',
            array(
                'label'     => __( 'CTA (1)', 'assystem' ),
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'display_quote',
                            'operator' => '!=',
                            'value' => 'yes'
                        ],
                    ]
                ],
            )
        );
        $this->add_control(
            'cta_label_1',
            array(
                'label'   => __( 'Libellé du lien', 'assystem' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '',
            )
        );
        $this->add_control(
            'cta_link_1',
            array(
                'label'         => __('Lien vers page', 'assystem-corpo'),
                'type'          => Controls_Manager::SELECT,
                'options'       => $pages,
                'title'         => __('Lien vers page', 'assystem-corpo'),
                'label_block'   => true,
            )
        );
        $this->end_controls_section();
        //
        $this->start_controls_section(
            'cta_2',
            array(
                'label' => __( 'CTA (2)', 'assystem' ),
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'display_quote',
                            'operator' => '!=',
                            'value' => 'yes'
                        ],
                    ]
                ],
            )
        );
        $this->add_control(
            'cta_label_2',
            array(
                'label'   => __( 'Libellé du lien', 'assystem' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '',
            )
        );
        $this->add_control(
            'cta_link_2',
            array(
                'label'         => __('Lien vers page', 'assystem-corpo'),
                'type'          => Controls_Manager::SELECT,
                'options'       => $pages,
                'title'         => __('Lien vers page', 'assystem-corpo'),
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
        $settings       = $this->get_settings_for_display();

        $title          = (!empty($settings['title']))?$settings['title']:'';
        $subtitle       = (!empty($settings['subtitle']))?$settings['subtitle']:'';
        $hn             = (!empty($settings['hn']))?$settings['hn']:'h2';
        $display_quote  = (!empty($settings['display_quote']))?$settings['display_quote']:'';
        $display_quote_after_name = (!empty($settings['display_quote_after_name']))?$settings['display_quote_after_name']:'';
        $display_image  = (!empty($settings['display_image']))?$settings['display_image']:'';
        $image          = (!empty($settings['image']))?$settings['image']:'';
        $filtre         = (!empty($settings['filtre']))?$settings['filtre']:'';
        $text           = (!empty($settings['text']))?$settings['text']:'';
        $name           = (!empty($settings['name']))?$settings['name']:'';
        $function       = (!empty($settings['function']))?$settings['function']:'';
        $cta_1          = !empty($settings['cta_1'])?$settings['cta_1']:'';
        $cta_label_1    = (!empty($settings['cta_label_1']))?$settings['cta_label_1']:'';
        $cta_link_1     = (!empty($settings['cta_link_1']))?$settings['cta_link_1']:'';
        $cta_label_2    = (!empty($settings['cta_label_2']))?$settings['cta_label_2']:'';
        $cta_link_2     = (!empty($settings['cta_link_2']))?$settings['cta_link_2']:'';
        $bgcolor        = (!empty($settings['background-color']))?$settings['background-color']:'bg-pink';
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
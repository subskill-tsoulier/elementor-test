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
class Recap_Finance extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
    }

    public function get_name() {
        return 'recap-finance';
    }

    public function get_title() {
        return __( 'Bloc récapitulatif - Finance (Documents)', 'assystem' );
    }

    public function get_icon() {
        return 'eicon-kit-details';
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
            'financial-document',
            array(
                'label' => __( 'Document à la une', 'assystem' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );
        $this->add_control(
            'overtitle',
            array(
                'label'         => __( 'Sur-titre du bloc', 'assystem' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__("À la une", "assystem"),
                'default'       => esc_html__("À la une", "assystem")
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
            'image', [
                'label' => __( 'Icône / Image', 'assystem' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'media_types' => ['svg'],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );
        $this->add_control(
            'cta_label_1', [
                'label' => __( 'Intitulé du lien n°1', 'assystem' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => "",
                'label_block' => true,
            ]
        );
        $this->add_control(
            'cta_link_1', [
                'label' => __( 'Lien (URL) n°1', 'assystem' ),
                'type' => \Elementor\Controls_Manager::URL,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'cta_label_2', [
                'label' => __( 'Intitulé du lien (n°2)', 'assystem' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => "",
                'label_block' => true,
            ]
        );
        $this->add_control(
            'cta_link_2', [
                'label' => __( 'Lien (URL) n°2', 'assystem' ),
                'type' => \Elementor\Controls_Manager::URL,
                'label_block' => true,
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'financial-news',
            array(
                'label' => __( 'Récapitulatif finance - Actualités', 'assystem' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );
        $pages  = array();
        $posts = get_posts(array(
            'lang'              => (function_exists('pll_current_language')?pll_get_post_language( get_the_ID()):'fr'),
            'post_type'         => 'document_financier',
            'numberposts'       => -1
        ));
        wp_reset_postdata();
        foreach ($posts as $post){
            $pages[$post->ID] = $post->post_title;
        }
        $this->add_control(
            'post_automatic',
            array(
                'label'         => __( 'Automatiser la remontée', 'assystem' ),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => esc_html__("Si vous souhaitez remonter du contenu de la base, activez le switch.", "assystem"),
                'label_on'      => esc_html__( 'Oui', 'assystem' ),
                'label_off'     => esc_html__( 'Non', 'assystem' ),
                'return_value'  => 'yes',
                'default'       => 'yes',
            )
        );
        $this->add_control(
            'post_id',
            array(
                'label'         => __('Contenu automatique à remonter', 'assystem-corpo'),
                'type'          => Controls_Manager::SELECT,
                'options'       => $pages,
                'title'         => __('Contenu automatique à remonter', 'assystem-corpo'),
                'label_block'   => true,
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name'      => 'post_automatic',
                            'operator'  => '=',
                            'value'     => 'yes'
                        ],
                    ]
                ]
            )
        );
        $this->add_control(
            'post_date',
            array(
                'label'         => __( 'Date du contenu', 'assystem' ),
                'type'          => Controls_Manager::DATE_TIME,
                'placeholder'   => esc_html__("Date", "assystem"),
                "picker_options"=> array('enableTime'=>false),
                "dateFormat"    => "d-m-Y",
                'default'       => "",
                'conditions'    => [
                    'relation'  => 'and',
                    'terms'     => [
                        [
                            'name'      => 'post_automatic',
                            'operator'  => '!=',
                            'value'     => 'yes'
                        ],
                    ]
                ]
            )
        );
        $this->add_control(
            'post_title',
            array(
                'label'   => __( 'Titre du contenu', 'assystem' ),
                'type'    => Controls_Manager::TEXT,
                'placeholder' => esc_html__("Titre", "assystem"),
                'default' => "",
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name'      => 'post_automatic',
                            'operator'  => '!=',
                            'value'     => 'yes'
                        ],
                    ]
                ]
            )
        );
        $this->add_control(
            'post_excerpt',
            array(
                'label'         => __( 'Texte du contenu', 'assystem' ),
                'type'          => Controls_Manager::WYSIWYG,
                'placeholder'   => esc_html__("Texte", "assystem"),
                'default'       => "",
                'conditions'    => [
                    'relation'  => 'and',
                    'terms'     => [
                        [
                            'name'      => 'post_automatic',
                            'operator'  => '!=',
                            'value'     => 'yes'
                        ],
                    ]
                ]
            )
        );
        $this->add_control(
            'post_cta_label',
            array(
                'label'   => __( 'Libellé du CTA', 'assystem' ),
                'type'    => Controls_Manager::TEXT,
                'placeholder' => esc_html__("Libellé du CTA", "assystem"),
                'default' => "",
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name'      => 'post_automatic',
                            'operator'  => '!=',
                            'value'     => 'yes'
                        ],
                    ]
                ]
            )
        );
        $this->add_control(
            'post_cta_link',
            array(
                'label'   => __( 'CTA (lien)', 'assystem' ),
                'type'    => Controls_Manager::URL,
                'default' => [],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name'      => 'post_automatic',
                            'operator'  => '!=',
                            'value'     => 'yes'
                        ],
                    ]
                ]
            )
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'financial-agenda',
            array(
                'label' => __( 'Agenda financier', 'assystem' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );
        $this->add_control(
            'agenda_title',
            array(
                'label'         => __( 'Titre du bloc', 'assystem' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__("Titre du bloc", "assystem"),
                'default'       => ""
            )
        );
        $this->add_control(
            'agenda_background',
            array(
                'label'         => __( 'Couleur de fond', 'assystem' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => array(
                    'bg-pink'   => esc_html__("Couleur principale", "assystem"),
                    'bg-light'  => esc_html__("Blanc", "assystem"),
                ),
                'title'         => __('Couleur de fond', 'assystem-corpo'),
                'label_block'   => true,
                'default'       => 'bg-light'
            )
        );
        $this->add_control(
            'agenda_link',
            array(
                'label'         => __( 'Lien vers la page "Agenda"', 'assystem' ),
                'type'          => Controls_Manager::URL,
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
        $settings           = $this->get_settings_for_display();
        // GET LAST NEWS "finance"
        $financial_news     = array();
        $post_automatic     = (!empty($settings['post_automatic']))?$settings['post_automatic']:'';
        if( $post_automatic == "yes" ) {
            if( !empty($settings['post_id']) ){
                $financial_news =   get_post($settings['post_id']);
            }
        } else {
            $financial_news             = new \stdClass();
            $financial_news->post_date  = (!empty($settings['post_date']))?$settings['post_date']:'';
            $financial_news->post_title = (!empty($settings['post_title']))?$settings['post_title']:'';
            $financial_news->post_excerpt = (!empty($settings['post_excerpt']))?$settings['post_excerpt']:'';
            $financial_news->cta_label  = (!empty($settings['post_cta_label']))?$settings['post_cta_label']:'';
            $financial_news->cta_link   = (!empty($settings['post_cta_link']))?$settings['post_cta_link']:'';
        }
        // GET LAST (3) AGENDA FINANCIER
        $title              =   (!empty($settings['title']))?$settings['title']:'';
        $pictogramme        =   (!empty($settings['image']))?$settings['image']:'';
        $cta_link_1         =   (!empty($settings['cta_link_1']))?$settings['cta_link_1']:'';
        $cta_label_1        =   (!empty($settings['cta_label_1']))?$settings['cta_label_1']:'';
        $cta_link_2         =   (!empty($settings['cta_link_2']))?$settings['cta_link_2']:'';
        $cta_label_2        =   (!empty($settings['cta_label_2']))?$settings['cta_label_2']:'';
        $overtitle          =   (!empty($settings['overtitle']))?$settings['overtitle']:'';
        $agenda_background  =   (!empty($settings['agenda_background']))?$settings['agenda_background']:'';
        $agenda_title       =   (!empty($settings['agenda_title']))?$settings['agenda_title']:'';
        $agenda_link        =   (!empty($settings['agenda_link']))?$settings['agenda_link']:'';
        $today              = current_time('mysql');
        $agenda_posts       =   get_posts(
            array(
                'numberposts'   => 2,
                'post_type'     => 'agenda_financier',
                'lang'          => (function_exists('pll_current_language')?pll_get_post_language( get_the_ID()):'fr'),
                'meta_key'	    => 'date',
                'orderby'	    => 'meta_value',
                'order'		    => 'ASC',
                'meta_query'             => array(
                    array(
                        'key'       => 'date',
                        'value'     => $today,
                        'compare'   => '>=',
                    ),
                ),
            )
        );
        wp_reset_postdata();

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
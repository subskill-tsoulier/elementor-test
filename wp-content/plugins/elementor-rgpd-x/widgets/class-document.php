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
class Document extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
        //wp_register_style( 'assystem', plugins_url( '/assets/css/assystem.css', ELEMENTOR_ASSYSTEM ), array(), '1.0.0' );
    }

    public function get_name() {
        return 'featured-document';
    }

    public function get_title() {
        return __( 'Bloc document', 'assystem' );
    }

    public function get_icon() {
        return 'eicon-file-download';
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
            'automatic',
            array(
                'label'         => __( 'Récupérer un document de la base', 'assystem' ),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => esc_html__("Si vous souhaitez récupérer un document de la base, activez le switch.", "assystem"),
                'label_on'      => esc_html__( 'Oui', 'assystem' ),
                'label_off'     => esc_html__( 'Non', 'assystem' ),
                'return_value'  => 'yes',
                'default'       => 'yes',
            )
        );
        $this->add_control(
            'document_title',
            array(
                'label'   => __( 'Titre du document à afficher', 'assystem' ),
                'type'    => Controls_Manager::TEXT,
                'placeholder' => esc_html__("Titre du document à afficher", "assystem"),
                'default' => "",
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'automatic',
                            'operator' => '!=',
                            'value' => 'yes'
                        ],
                    ]
                ]
            )
        );
        $this->add_control(
            'document_file', [
                'label'         => __( 'Document', 'assystem' ),
                'type'          => \Elementor\Controls_Manager::MEDIA,
                // 'media_types'   => ['svg'],
                'default'       => [],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'automatic',
                            'operator' => '!=',
                            'value' => 'yes'
                        ],
                    ]
                ]
            ]
        );
        $options    = array();
        $posts      = get_posts(array(
            'lang'              => (function_exists('pll_current_language')?pll_get_post_language( get_the_ID()):'fr'),
            'post_type'         => 'document_financier',
            'orderby'           => 'name',
            'order'             => 'ASC',
            'numberposts'       => -1
        ));
        wp_reset_postdata();
        foreach ($posts as $post){
            $options[$post->ID] = $post->post_title;
        }
        $this->add_control(
            'post_id',
            array(
                'label'         => __('Choix du document à remonter', 'assystem-corpo'),
                'type'          => Controls_Manager::SELECT,
                'options'       => $options,
                'title'         => __('Choix du document à remonter', 'assystem-corpo'),
                'label_block'   => true,
                'condition' => [
                    'automatic' => 'yes'
                ]
            )
        );
        $this->add_control(
            'image', [
                'label' => __( 'Image', 'assystem' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => []
            ]
        );
        $this->add_control(
            'display_additionnal_cta',
            array(
                'label'         => __( 'Afficher un CTA supplémentaire', 'assystem' ),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => esc_html__("Si vous souhaitez activer un CTA supplémentaire, activez le switch.", "assystem"),
                'label_on'      => esc_html__( 'Oui', 'assystem' ),
                'label_off'     => esc_html__( 'Non', 'assystem' ),
                'separator'     => 'before',
                'return_value'  => 'yes',
                'default'       => '',
            )
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'additionnal_cta',
            array(
                'label'     => __( 'Configuration du CTA supplémentaire', 'assystem' ),
                'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'display_additionnal_cta' => 'yes'
                ]
            )
        );
        $this->add_control(
            'cta_label',
            array(
                'label'   => __( 'Libellé du lien', 'assystem' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '',
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
        $this->end_controls_section();
    }
    /**
     * Render the widget output on the frontend.
     * Written in PHP and used to generate the final HTML.
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $post           = array();
        $doc_type       = "";
        $download_link  = "";
        $document_file  = "";
        $document_thumb = "";
        // 
        $add_cta        = $settings['display_additionnal_cta'];
        $cta_label      = "";
        $cta_link       = "";

        if( !empty($settings['image']) ) {
            $document_thumb = wp_get_attachment_image_url($settings['image']['id'], 'document-img');
        }
        
        if( $add_cta == "yes" ) {
            $cta_label  =   !empty($settings['cta_label'])?$settings['cta_label']:'';
            $cta_link   =   !empty($settings['cta_link'])?$settings['cta_link']:'';
        }

        $automatic  =   (!empty($settings['automatic']))?$settings['automatic']:'';

        if( !empty($automatic) ):
            // IF automatic -> get information about the document
            if( !empty($settings['post_id']) ) {
                $post           = get_post($settings['post_id']);
                if( !empty($post) ) {
                    $download_link  = get_field("fichier", $post->ID);
                    if ( !empty($download_link) ) {
                        $document_file  =   (!empty($download_link))?$download_link['url']:'';
                    }
                }
            }

            if( !empty($post) ):
                $title  =   $post->post_title;
            endif;
        else:
            // IF non-automatic -> get manual fields
            $title          =   !empty($settings['document_title'])?$settings['document_title']:'';
            $document_file  =   (!empty($settings['document_file']))?$settings['document_file']:'';
            $document_file  =   (!empty($document_file))?$document_file['url']:'';
        endif;

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
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
class ListProjetsFilters extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
    }

    public function get_name() {
        return 'list-projets-filters';
    }

    public function get_title() {
        return __( 'Bloc liste projets avec filtres', 'assystem' );
    }

    public function get_icon() {
        return 'eicon-filter';
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
        //
        $this->add_control(
            'numberposts',
            array(
                'label'   => __( 'Nombre d\'éléments à afficher', 'assystem' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => '',
            )
        );
        //
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
        $numberposts    = (!empty($settings['numberposts']))?$settings['numberposts']:8;
        $paged          = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args_pays      = array();
        $args_sector    = array();
        $args_service   = array();
        $args_tag       = array();
        $get_sectors    = array();
        $get_type       = array();
        $get_pays       = array();
        if( isset($_GET['country']) ) {
            foreach($_GET['country'] as $get_pays_item) {
                $get_pays[]   =   strip_tags($get_pays_item);
            }
            $tp_args        = array();
            if( !empty($get_pays) ) {
                $tp_args["relation"]  = 'OR';
                foreach($get_pays as $g_pays) {
                    $tp_args[]     = array(
                        'key'	 	=> 'country',
                        'value'	  	=> $g_pays,
                        'compare' 	=> 'LIKE',
                    );
                }
            }
            $args_pays =   $tp_args;
        }
        if( isset($_GET['sector']) ) {
            foreach($_GET['sector'] as $get_sector) {
                $get_sectors[]   =   strip_tags($get_sector);
            }
            $tp_args        = array();
            if( !empty($get_sectors) ) {
                $tp_args["relation"]  = 'OR';
                foreach($get_sectors as $g_sector) {
                    $tp_args   =   array(
                    'key'	 	=> 'sector',
                    'value'	  	=> $g_sector,
                    'compare' 	=> 'LIKE',
                );
                }
            }
            $args_sector =   $tp_args;
        }
        if( isset($_GET['service']) ) {
            foreach($_GET['service'] as $service) {
                $get_type[]   =   strip_tags($service);
            }
            $args_service   =   array(
                'key'	 	=> 'offer_type',
                'value'	  	=> $get_type,
                'compare' 	=> 'IN',
            );
        }
        $args 	        = array (
            'paged'		        => $paged,
            'post_type'	        => 'reference',
            'posts_per_page'    => $numberposts,
            'meta_query'	=> array(
                'relation'		=> 'AND',
            )
        );
        if( !empty($args_pays) ) {
            $args['meta_query'][]   = $args_pays;
        }
        if( !empty($args_sector) ) {
            $args['meta_query'][]   = $args_sector;
        }
        if( !empty($args_service) ) {
            $args['meta_query'][]   = $args_service;
        }
        $the_query 		= new \WP_Query( $args );
        // GET PAYS
        $args_pays      = array(
            'post_type'     => 'pays',
            'numberposts'   => -1,
            'lang'          => (function_exists('pll_current_language')?pll_get_post_language( get_the_ID()):'fr'),
        );
        $pays           = get_posts($args_pays);
        wp_reset_postdata();
        // GET SECTEURS
        $args_secteurs  = array(
            'post_type'     => 'secteur',
            'numberposts'   => -1,
            'lang'          => (function_exists('pll_current_language')?pll_get_post_language( get_the_ID()):'fr'),
        );
        $secteurs       = get_posts($args_secteurs);
        wp_reset_postdata();
        // chips
        $chips          = array();
        if( !empty($get_sectors) ) {
            foreach($get_sectors as $sector) {
                $the_sector =   get_post($sector);
                $chips[]    =   array(
                    'ref'   => 'collapse-secteur',
                    'id'    => $the_sector->ID,
                    'name'  => $the_sector->post_title
                );
            }
        }
        if( !empty($get_pays) ) {
            foreach($get_pays as $pays_item) {
                $the_pays =   get_post($pays_item);
                $chips[]    =   array(
                    'ref'   => 'collapse-pays',
                    'id'    => $the_pays->ID,
                    'name'  => $the_pays->post_title
                );
            }
        }
        if( !empty($get_type) ) {
            foreach($get_type as $type) {
                $chips[]    =   array(
                    'ref'   => 'collapse-service',
                    'id'    => $type,
                    'name'  => ($type == "digital")?__("Solution digitale", "assystem"):__("Ingénierie", "assystem")
                );
            }
        }
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
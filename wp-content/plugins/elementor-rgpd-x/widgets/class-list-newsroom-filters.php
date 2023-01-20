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
class ListNewsroomFilters extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
    }

    public function get_name() {
        return 'list-newsroom-filters';
    }

    public function get_title() {
        return __( 'Bloc liste newsroom avec filtres', 'assystem' );
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
        $args_tag       = array();
        $get_categories = array();
        $get_sectors    = array();
        if( isset($_GET['sector']) ) {
            foreach($_GET['sector'] as $get_sector) {
                $get_sectors[]   =   strip_tags($get_sector);
            }
            $args_tag[]   =   array(
                'key'	 	=> 'sector',
                'value'	  	=> $get_sectors,
                'compare' 	=> 'IN',
            );
        }
        $args 	        = array (
            'paged'		        => $paged,
            'post_type'	        => 'post',
            'lang'              => (function_exists('pll_current_language')?pll_get_post_language( get_the_ID()):'fr'),
            'posts_per_page'    => $numberposts,
            'meta_query'	=> array(
                'relation'		=> 'AND',
                $args_tag
            )
        );
        if( isset($_GET['category']) ) {
            foreach($_GET['category'] as $get_category) {
                $get_categories[]   =   strip_tags($get_category);
            }
            $args['category__in']   =   $get_categories;
        }
        $the_query 		= new \WP_Query( $args );
        // GET CATEGORIES
        $categories     = get_categories(
            array(
                'taxonomy'      => 'category',
                'hide_empty'    => false,
            )
        );

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
        if( !empty($get_categories) ) {
            foreach($get_categories as $category) {
                $the_category   =   get_term($category);
                $chips[]    =   array(
                    'ref'   => 'collapse-category',
                    'id'    => $the_category->term_id,
                    'name'  => $the_category->name
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
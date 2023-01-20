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
class ListeDocumentsFilters extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
    }

    public function get_name() {
        return 'list-documents-filters';
    }

    public function get_title() {
        return __( 'Bloc liste documents financiers avec filtres', 'assystem' );
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
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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
        $this->add_control(
            'many_categories',
            array(
                'label'         => __( 'Filtrer sur plusieurs catégories', 'assystem' ),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => esc_html__("Si vous souhaitez filtrer sur plusieurs catégories, switchez.", "assystem"),
                'label_on'      => esc_html__( 'Oui', 'assystem' ),
                'label_off'     => esc_html__( 'Non', 'assystem' ),
                'return_value'  => 'yes',
                'default'       => 'no',
            )
        );
        $options    = array();
        // GET CATEGORIES
        $categories     = get_categories(
            array(
                'taxonomy'      => 'categorie_finance',
                'hide_empty'    => false,
                'lang'          => (function_exists('pll_current_language')?pll_get_post_language( get_the_ID()):'fr'),
            )
        );
        foreach ($categories as $category){
            $options[$category->term_id] = $category->name;
        }
        $this->add_control(
            'post_id',
            array(
                'label'         => __('Catégorie du contenu à remonter', 'assystem-corpo'),
                'type'          => Controls_Manager::SELECT,
                'options'       => $options,
                'title'         => __('Catégorie du contenu à remonter', 'assystem-corpo'),
                'label_block'   => true,
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'many_categories',
                            'operator' => '!=',
                            'value' => 'yes'
                        ],
                    ]
                ],
            )
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'item',
            array(
                'label'         => __('Catégorie du contenu à remonter', 'assystem-corpo'),
                'type'          => Controls_Manager::SELECT,
                'options'       => $options,
                'title'         => __('Catégorie du contenu à remonter', 'assystem-corpo'),
                'label_block'   => true,
            )
        );
        // End of repeater
        $this->add_control(
            'posts_id',
            [
                'label' => __( 'Catégories', 'assystem' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
                'condition' => [
                    'many_categories' => 'yes',
                ],
            ]
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
        $get_categories = array();
        $get_years      = array();
        $args_tag       = array();
        $categories_args= array(
            'taxonomy'      => 'categorie_finance',
            'hide_empty'    => false,
            'lang'          => (function_exists('pll_current_language')?pll_get_post_language( get_the_ID()):'fr'),
        );
        if( !empty($settings['many_categories']) && $settings['many_categories'] == "yes" ) {
            // Si on choisit plusieurs catégories
            // On vérifie qu'il y a bien au moins un catégorie définie / choisie
            if( !empty($settings['posts_id']) ) {
                $subcategories_args =   array();
                foreach($settings['posts_id'] as $pid) {
                    $subcategories = get_term_children($pid['item'], 'categorie_finance');
                    if( !empty($subcategories) ) {
                        foreach ($subcategories as $subcategory) {
                            $categories_args['include'][] = $subcategory;
                        }
                    } else {
                        $categories_args['include'][] = $pid['item'];
                    }
                }
            }
        } else {
            if( !empty($settings['post_id']) ) {
                $categories_args['parent'] = $settings['post_id'];
            }
        }
        //
        $meta_query = array(
            'relation'   => 'OR'
        );
        if( isset($_GET['d-year']) ) {
            foreach($_GET['d-year'] as $get_year) {
                $get_years[]    =   strip_tags($get_year);
                $start_date     =   $get_year."-01-01";
                $end_date       =   $get_year."-12-31";
                $meta_query[]   =   array (
                    'key'       => 'date',
                    'value'     => array($start_date, $end_date),
                    'type'      => 'DATE',
                    'compare'   => 'BETWEEN'
                );
            }
        }
        if( isset($_GET['category']) ) {
            foreach($_GET['category'] as $get_category) {
                $get_categories[]   =   strip_tags($get_category);
            }
            $args_tag[] =   array(
                'taxonomy'  => 'categorie_finance',
                'field'     => 'term_id',
                'terms'     => $get_categories,
                'operator'  => 'IN'
            );
        } else {
            $ids    =   array();
            if( !empty($settings['many_categories']) && $settings['many_categories'] == "yes" ) {
                $ids    =   $categories_args['include'];
            } else {
                $ids    =   $categories_args['parent'];
            }
            $args_tag[] =   array(
                'taxonomy'  => 'categorie_finance',
                'field'     => 'term_id',
                'terms'     => $ids,
                'operator'  => 'IN'
            );
        }
        $args 	        = array (
            'paged'		        => $paged,
            'post_type'	        => 'document_financier',
            'posts_per_page'    => $numberposts,
            'lang'              => (function_exists('pll_current_language')?pll_get_post_language( get_the_ID()):'fr'),
            'meta_key'			=> 'date',
            'orderby'			=> 'meta_value',
            'order'				=> 'DESC'
        );
        if( !empty($meta_query) ) {
            $args['meta_query'] = $meta_query;
        }
        if( !empty($args_tag) ) {
            $args['tax_query']  =   array(
                $args_tag
            );
        }

        $the_query 		= new \WP_Query( $args );
        // years (for select)
        $years          = range(date("Y"), 2012);
        // categories (for select)
        $categories     = get_categories($categories_args);
        // chips
        $chips          = array();
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
        if( !empty($get_years) ) {
            foreach($get_years as $year) {
                $chips[]    =   array(
                    'ref'   => 'collapse-year',
                    'id'    => $year,
                    'name'  => $year
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
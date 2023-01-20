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
class OffersFilters extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
    }

    public function get_name() {
        return 'offers-filters';
    }

    public function get_title() {
        return __( 'Filtres Offres', 'assystem' );
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
        $this->add_control(
            'reverse',
            [
                'label' => esc_html__( 'Fond de couleur sur la barre', 'elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'frontend_available' => true,
            ]
        );
        $this->add_control(
            'is-large',
            [
                'label' => esc_html__( 'Barre élargie', 'elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'frontend_available' => true,
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
        $settings   = $this->get_settings_for_display();
        # TODO : Dynamize métiers / secteurs / contrats / localisation
        $metiers        = [];
        $secteurs       = ["industrie","association"];
        $contrats       = [];
        $localisation   = [];
        //print_r($settings['identity']);
        // $settings < contain all vars



        $data_type_search_bar           =
            [
                'offerFamilyCategory', // customcodetable__TS_f05405a5-60ee-4449-a4a6-a6c1e2302a11
                'offerCountry',
                'customcodetable__TS_f4aa7bb7-d976-422f-8f8d-f6a43b0c4192', // JobDescription_customCodeTable1
                'contractType'

            ];

        $data_param_search_bar          = ['start' => 1, 'filter' => 'active'];
        $search_bar_type                = apply_filters('get_referentials_by_type', $data_param_search_bar, $data_type_search_bar);
        $locations                      = [];
        $underLocation                  = [];

        foreach ($search_bar_type[1] as $key_type_1 => $type_1)
        {
            if(!empty($type_1->_links)){
                $locations[$type_1->code] = [
                    'code' => $type_1->code,
                    'label' => $type_1->label
                ];
            }
        }
        foreach ($search_bar_type[1] as $key_type_1 => $type_1)
        {
            if(empty($type_1->_links)){
                $underLocation[$type_1->code] = [
                    'code' => $type_1->code,
                    'label' => $type_1->label,
                    'parent' => $type_1->parentCode
                ];
            }
        }
        foreach ($underLocation as $underLocation_key => $underLocation_item)
        {
            if (array_key_exists($underLocation_item['parent'], $locations)){
                $locations[$underLocation_item['parent']]['child'][] = $underLocation_item;

            }
        }
        if( !function_exists('reorderByName') ) {
            function reorderByName($a, $b) {
                return strcmp($a["label"], $b["label"]);
            }
        }
        usort($locations, 'reorderByName');

        $reverse    =   (!empty($settings['reverse']))?$settings['reverse']:'no';
        $is_large   =   (!empty($settings['is-large']))?$settings['is-large']:'no';
        
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
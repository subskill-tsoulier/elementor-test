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
class Ancres extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
        //wp_register_style( 'assystem', plugins_url( '/assets/css/assystem.css', ELEMENTOR_ASSYSTEM ), array(), '1.0.0' );
    }

    public function get_name() {
        return 'ancres';
    }

    public function get_title() {
        return __( 'Bloc Ancres', 'assystem' );
    }

    public function get_icon() {
        return 'eicon-anchor';
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
            'introduction_section',
            array(
                'label' => __( 'Configuration des ancres', 'assystem' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'title', [
                'label' => __( 'Titre', 'assystem' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => "",
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'choose_anchor_type', [
                'label'         => __( 'Choix :  Section ID ou page/URL' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'description'   => esc_html__("Choisir entre un ID de section ou une page/URL"),
                'label_on'      => esc_html__( 'Section ID', 'assystem' ),
                'label_off'     => esc_html__( 'URL', 'assystem' ),
                'return_value'  => 'yes',
                'default'       => ''
            ]
        );
        $repeater->add_control(
            'selector', [
                'label'         => __( 'Sélecteur / ID de la section', 'assystem' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'default'       => "",
                'label_block'   => true,
                'description'   => esc_html__("Veuillez renseigner le sélecteur qui va permettre de lier l'ancre à un bloc.", "assystem"),
                'condition' => [
                    'choose_anchor_type' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'link', [
                'label'         => __( 'Lien', 'assystem' ),
                'type'          => \Elementor\Controls_Manager::URL,
                'label_block'   => true,
                'description'   => esc_html__("Laissez vide si aucune redirection n'est attendue.", "assystem"),
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name'      => 'choose_anchor_type',
                            'operator'  => '!=',
                            'value'     => 'yes'
                        ],
                    ]
                ]
            ]
        );
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
        $this->add_control(
            'list',
            [
                'label'     => __( 'Répétition', 'elementor-awesomesauce' ),
                'type'      => \Elementor\Controls_Manager::REPEATER,
                'fields'    => $repeater->get_controls(),
                'default'   => [],
                'title_field' => '{{{ title }}}',
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
        $ancres     = !empty($settings['list'])?$settings['list']:[];
        
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
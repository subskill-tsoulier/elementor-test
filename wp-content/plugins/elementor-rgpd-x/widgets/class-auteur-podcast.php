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
class AuteurPodcast extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
        //wp_register_style( 'assystem', plugins_url( '/assets/css/assystem.css', ELEMENTOR_ASSYSTEM ), array(), '1.0.0' );
    }

    public function get_name() {
        return 'auteur-podcast';
    }

    public function get_title() {
        return __( 'Bloc Auteur de podcast', 'assystem' );
    }

    public function get_icon() {
        return 'eicon-user-circle-o';
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
        // TODO : GET RIGHT CPT (documents)
        $options    = array();
        $posts      = get_posts(array(
            'lang'              => (function_exists('pll_current_language')?pll_get_post_language( get_the_ID()):'fr'),
            'post_type'         => 'auteur',
            'numberposts'       => -1
        ));
        wp_reset_postdata();
        foreach ($posts as $post){
            $options[$post->ID] = $post->post_title;
        }
        $this->add_control(
            'post_id',
            array(
                'label'         => __('Choix de l\'auteur à remonter', 'assystem-corpo'),
                'type'          => Controls_Manager::SELECT,
                'options'       => $options,
                'title'         => __('Choix de l\'auteur à remonter', 'assystem-corpo'),
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
        $post_id        = $settings['post_id'];
        $auteur         = get_post($post_id);
        $lastname       = '';
        $firstname      = '';
        $function       = '';
        $profil_picture = '';
        $biography      = '';
        if (!empty($auteur)) :
            $fields         = get_field('identity', $post_id);
            $lastname       = get_field('lastname', $post_id);
            $firstname      = get_field('firstname', $post_id);
            $function       = get_field('function', $post_id);
            $biography      = get_field('biography', $post_id);
            $profil_picture = get_field('profil_picture', $post_id);
            if( !empty($profil_picture) ) {
                $profil_picture   = wp_get_attachment_image_url($profil_picture['id'], 'author-img');
            }
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
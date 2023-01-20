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
defined('ABSPATH') || die();

/**
 * Assystem widget class.
 *
 * @since 1.0.0
 */
class ListNewsroom extends Widget_Base
{

    public function __construct($data = array(), $args = null)
    {
        parent::__construct($data, $args);
    }

    public function get_name()
    {
        return 'list-newsroom';
    }

    public function get_title()
    {
        return __('Bloc liste newsroom', 'assystem');
    }

    public function get_icon()
    {
        return 'eicon-post-list';
    }

    public function get_categories()
    {
        return array('assystem');
    }

    public function get_style_depends()
    {
        return array('assystem');
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
    protected function register_controls()
    {
        $this->start_controls_section(
            'general',
            array(
                'label' => __('Configuration du bloc', 'assystem'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );
        $this->add_control(
            'title',
            array(
                'label' => __('Titre du bloc', 'assystem'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__("Title", "assystem"),
                'default' => "",
            )
        );
        $this->add_control(
            'hn',
            [
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label' => esc_html__('Type de balise pour le titre', 'assystem'),
                'required' => true,
                'toggle' => false,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'assystem'),
                        'icon' => 'eicon-editor-h1',
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'assystem'),
                        'icon' => 'eicon-editor-h2',
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'assystem'),
                        'icon' => 'eicon-editor-h3',
                    ],
                    'p' => [
                        'title' => esc_html__('P', 'assystem'),
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
            'display_image',
            [
                'label' => esc_html__('Afficher l\'image', 'elementor'),
                'type' => Controls_Manager::SWITCHER,
                'frontend_available' => true,
            ]
        );
        // FILTERS
        $pages = array();
        $categories = get_categories(
            array(
                'hide_empty' => false
            )
        );
        foreach ($categories as $category) {
            $pages[$category->term_id] = $category->name;
        }

        $this->add_control(
            'content_filter_by',
            array(
                'label' => __('Filtre par catégorie', 'assystem-corpo'),
                'type' => Controls_Manager::SELECT,
                'options' => $pages,
                'title' => __('Filtre par catégorie', 'assystem-corpo'),
                'label_block' => true,
            )
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'cta',
            array(
                'label' => __('Configuration du CTA', 'assystem'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );
        $this->add_control(
            'cta_label',
            array(
                'label' => __('Libellé du lien', 'assystem'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
            )
        );
        $pages = array();
        $posts = get_posts(array(
            'lang' => (function_exists('pll_current_language') ? pll_get_post_language(get_the_ID()) : 'fr'),
            'post_type' => 'page',
            'numberposts' => -1
        ));
        wp_reset_postdata();
        foreach ($posts as $post) {
            $pages[$post->ID] = $post->post_title;
        }
        $this->add_control(
            'cta_link',
            array(
                'label' => __('Lien vers page', 'assystem-corpo'),
                'type' => Controls_Manager::SELECT,
                'options' => $pages,
                'title' => __('Lien vers page', 'assystem-corpo'),
                'label_block' => true,
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
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $args = array(
            'post_type' => 'post',
            'numberposts' => 3,
            'exclude' => array(get_the_id()),
        );
        if (!empty($settings['content_filter_by'])) {
            $args['category'] = $settings['content_filter_by'];
        }
        $posts = get_posts($args);
        wp_reset_postdata();
        $hn = (!empty($settings['hn'])) ? $settings['hn'] : 'h2';
        $title = (!empty($settings['title'])) ? $settings['title'] : '';
        $display_image = (!empty($settings['display_image'])) ? $settings['display_image'] : 'no';
        require plugin_dir_path((((__FILE__)))) . 'public/' . $this->get_name() . '.php';
    }

    /**
     * Render the widget output in the editor.
     * Written as a Backbone JavaScript template and used to generate the live preview.
     * @since 1.0.0
     * @access protected
     */
    protected function content_template()
    {
        //
    }
}

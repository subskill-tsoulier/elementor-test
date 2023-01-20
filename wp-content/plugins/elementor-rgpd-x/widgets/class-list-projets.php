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
class ListProjets extends Widget_Base
{

    public function __construct($data = array(), $args = null)
    {
        parent::__construct($data, $args);
    }

    public function get_name()
    {
        return 'list-projets';
    }

    public function get_title()
    {
        return __('Bloc liste projets', 'assystem');
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
            'automatic',
            array(
                'label' => __('Remontée automatique', 'assystem'),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__("Si vous souhaitez masquer la première slide dans la navigation, switchez.", "assystem"),
                'label_on' => esc_html__('Oui', 'assystem'),
                'label_off' => esc_html__('Non', 'assystem'),
                'return_value' => 'yes',
                'default' => 'yes',
            )
        );
        // FILTERS
//        $this->add_control(
//            'content_filter_by',
//            array(
//                'required'      => true,
//                'label'         => __('Filtre de contenu', 'assystem-corpo'),
//                'type'          => Controls_Manager::SELECT,
//                'options'       => [
//                    'secteur'   => 'Secteurs',
//                    'pays'      => 'Pays',
//                    'offre'     => 'Offre'
//                ],
//                'default'       => 'secteur',
//                'title'         => __('Filtre de contenu', 'assystem-corpo'),
//                'label_block'   => true,
//            )
//        );

        //  --END CONDITIONNAL FIELDS
        $this->end_controls_section();

        $this->start_controls_section(
            'filter_posts',
            array(
                'label' => __('Configuration remontée de posts', 'assystem'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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


        $pages = array();
        $posts = get_posts(array(
            'lang' => (function_exists('pll_current_language') ? pll_get_post_language(get_the_ID()) : 'fr'),
            'post_type' => 'reference',
            'numberposts' => -1
        ));
        wp_reset_postdata();
        $pages[''] = esc_html__("--", "assystem");
        foreach ($posts as $post) {
            $pages[$post->ID] = $post->post_title;
        }
        $this->add_control(
            'filter_secteur_1',
            array(
                'label' => __('Premier article', 'assystem-corpo'),
                'type' => Controls_Manager::SELECT,
                'options' => $pages,
                'title' => __('Premier article', 'assystem-corpo'),
                'label_block' => true,
//                'condition' => [
//                    'content_filter_by' => 'secteur'
//                ]
            )
        );

        $this->add_control(
            'filter_secteur_2',
            array(
                'label' => __('Second article', 'assystem-corpo'),
                'type' => Controls_Manager::SELECT,
                'options' => $pages,
                'title' => __('Second article', 'assystem-corpo'),
                'label_block' => true,
//                'condition' => [
//                    'content_filter_by' => 'secteur'
//                ]
            )
        );

        $this->add_control(
            'filter_secteur_3',
            array(
                'label' => __('Troisième article', 'assystem-corpo'),
                'type' => Controls_Manager::SELECT,
                'options' => $pages,
                'title' => __('Troisième article', 'assystem-corpo'),
                'label_block' => true,
//                'condition' => [
//                    'content_filter_by' => 'secteur'
//                ]
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'filter_posts_automatic',
            array(
                'label' => __('Configuration remontée de posts', 'assystem'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'automatic' => 'yes'
                ],
            )
        );
        //  CONDITIONNAL FIELDS
        //  Get all "secteur" pages
        $pages = array();
        $posts = get_posts(array(
            'lang' => (function_exists('pll_current_language') ? pll_get_post_language(get_the_ID()) : 'fr'),
            'post_type' => 'secteur',
            'numberposts' => -1
        ));
        wp_reset_postdata();
        $pages[''] = esc_html__("--", "assystem");
        foreach ($posts as $post) {
            $pages[$post->ID] = $post->post_title;
        }
        $this->add_control(
            'filter_secteur',
            array(
                'label' => __('Filtre par secteur', 'assystem-corpo'),
                'type' => Controls_Manager::SELECT,
                'options' => $pages,
                'title' => __('Filtre par secteur', 'assystem-corpo'),
                'label_block' => true,
//                'condition' => [
//                    'content_filter_by' => 'secteur'
//                ]
            )
        );
        //  Get all "pays" pages
        $pages = array();
        $posts = get_posts(array(
            'lang' => (function_exists('pll_current_language') ? pll_get_post_language(get_the_ID()) : 'fr'),
            'post_type' => 'pays',
            'numberposts' => -1
        ));
        wp_reset_postdata();
        $pages[''] = esc_html__("--", "assystem");
        foreach ($posts as $post) {
            $pages[$post->ID] = $post->post_title;
        }
        $this->add_control(
            'filter_pays',
            array(
                'label' => __('Filtre par pays', 'assystem-corpo'),
                'type' => Controls_Manager::SELECT,
                'options' => $pages,
                'title' => __('Filtre par pays', 'assystem-corpo'),
                'label_block' => true
            )
        );
        $this->add_control(
            'filter_offre',
            array(
                'label' => __('Filtre par offre', 'assystem-corpo'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => '--',
                    'ingenierie' => 'Ingénierie',
                    'digital' => 'Digital',
                ],
                'title' => __('Filtre par offre', 'assystem-corpo'),
                'label_block' => true
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
        // Choose the "archive" page
        $this->add_control(
            'cta_link',
            array(
                'label' => __('Lien vers page', 'assystem'),
                'type' => Controls_Manager::URL,
                'title' => __('Lien vers page', 'assystem'),
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
            'post_type' => 'reference',
            'numberposts' => 3,
            'post__not_in' => array(get_the_id()),
            'meta_query' => array(
                'relation' => 'AND',
            )
        );
        if (!empty($settings['filter_offre'])) {
            $args['meta_query'][] = array(
                'key' => 'offer_type',
                'value' => $settings['filter_offre'],
                'compare' => '=',
            );
        }
        if (!empty($settings['filter_pays'])) {
            $args['meta_query'][] = array(
                'relation' => 'OR',
                array(
                    'key' => 'country',
                    'value' => $settings['filter_pays'],
                    'compare' => 'LIKE',
                )
            );
        }

        if (!empty($settings['filter_secteur'])) {
            $the_sector =   get_post($settings['filter_secteur']);
            if( !empty($the_sector) && pll_get_post_language($the_sector->ID) == pll_get_post_language(get_the_ID()) ):
                $args['meta_query'][] = array(
                    'relation' => 'OR',
                    array(
                        'key' => 'sector',
                        'value' => $settings['filter_secteur'],
                        'compare' => 'LIKE',
                    )
                );
            endif;
        }

        if (empty(get_posts($args)) && !empty($settings['filter_secteur'])) {
            $auto = "no";
        } else {
            $auto = (isset($settings['automatic'])) ? $settings['automatic'] : 'yes';
        }
        if ($auto == "yes") {
            $posts = get_posts($args);
        } else {
            $posts_id = [$settings['filter_secteur_1'], $settings['filter_secteur_2'], $settings['filter_secteur_3']];
            foreach ($posts_id as $post_id) {
                if( !empty($post_id) ):
                    $posts[] = get_post($post_id);
                endif;
            }
        }
        
        wp_reset_postdata();
        $hn = (!empty($settings['hn'])) ? $settings['hn'] : 'h2';
        $title = (!empty($settings['title'])) ? $settings['title'] : '';
        $cta_link = (!empty($settings['cta_link'])) ? $settings['cta_link'] : '';
        $cta_label = (!empty($settings['cta_label'])) ? $settings['cta_label'] : '';
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

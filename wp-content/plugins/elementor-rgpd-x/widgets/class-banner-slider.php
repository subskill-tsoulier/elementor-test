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
use Elementor\Group_Control_Image_Size;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Modules\DynamicTags\Module as TagsModule;
// Security Note: Blocks direct access to the plugin PHP files.
defined( 'ABSPATH' ) || die();
/**
 * Assystem widget class.
 *
 * @since 1.0.0
 */
class BannerSlider extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
    }

    public function get_name() {
        return 'banner-slider';
    }

    public function get_title() {
        return __( 'Bloc Bannière slider', 'assystem' );
    }

    public function get_icon() {
        return 'eicon-slider-video';
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
            'hide_first',
            array(
                'label'   => __( 'Masquer la première slide dans la navigation', 'assystem' ),
                'type'    => Controls_Manager::SWITCHER,
                'description' => esc_html__("Si vous souhaitez masquer la première slide dans la navigation, switchez.", "assystem"),
                'label_on' => esc_html__( 'Oui', 'assystem' ),
                'label_off' => esc_html__( 'Non', 'assystem' ),
                'return_value' => 'yes',
                'default' => 'no',
            )
        );
        $pages  = array();
        $posts = get_posts(array(
            'lang'              => (function_exists('pll_current_language')?pll_get_post_language( get_the_ID()):'fr'),
            'post_type'         => array('page','pays','publications','reference'),
            'numberposts'       => -1
        ));
        wp_reset_postdata();
        foreach ($posts as $post){
            $pages[$post->ID] = $post->post_title;
        }
        //
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'display_switch_on',
            array(
                'label'   => __( 'Switch On', 'assystem' ),
                'type'    => Controls_Manager::SWITCHER,
                'description' => esc_html__("Si vous souhaitez activer le titre 'Switch On' switchez.", "assystem"),
                'label_on' => esc_html__( 'Oui', 'assystem' ),
                'label_off' => esc_html__( 'Non', 'assystem' ),
                'return_value' => 'yes',
                'default' => 'no',
            )
        );
        $repeater->add_control(
            'title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__( 'Titre (uniquement pour l\'administration)', 'assystem' ),
                'default' => '',
                'label_block'   => true,
            ]
        );
        $repeater->add_control(
            'hn',
            [
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label' => esc_html__( 'Type de balise pour le titre', 'assystem' ),
                'required' => true,
                'toggle' => false,
                'options' => [
                    'h1' => [
                        'title' => esc_html__( 'H1', 'assystem' ),
                        'icon' => 'eicon-editor-h1',
                    ],
                    'h2' => [
                        'title' => esc_html__( 'H2', 'assystem' ),
                        'icon' => 'eicon-editor-h2',
                    ],
                    'h3' => [
                        'title' => esc_html__( 'H3', 'assystem' ),
                        'icon' => 'eicon-editor-h3',
                    ],
                    'p' => [
                        'title' => esc_html__( 'P', 'assystem' ),
                        'icon' => 'eicon-editor-paragraph',
                    ],
                ],
                'default' => 'h2'
            ]
        );
        $repeater->add_control(
            'cta_label',
            array(
                'label'         => __('Intitulé du bouton', 'assystem-corpo'),
                'type'          => Controls_Manager::TEXT,
                'options'       => $pages,
                'title'         => __('Intitulé du bouton', 'assystem-corpo'),
                'label_block'   => true,
            )
        );
        $repeater->add_control(
            'is_auto',
            array(
                'label'   => __( 'Récupérer le contenu automatiquement ?', 'assystem' ),
                'type'    => Controls_Manager::SWITCHER,
                'description' => esc_html__("Si vous souhaitez récupérer le contenu d'un post automatiquement switchez.", "assystem"),
                'label_on' => esc_html__( 'Oui', 'assystem' ),
                'label_off' => esc_html__( 'Non', 'assystem' ),
                'return_value' => 'yes',
                'default' => 'no',
            )
        );
        // IF it's a post
        $repeater->add_control(
            'post_link',
            array(
                'label'         => __('Lien du contenu vers lequel pointer', 'assystem-corpo'),
                'type'          => Controls_Manager::SELECT,
                'separator'     => "before",
                'options'       => $pages,
                'title'         => __('Lien vers page', 'assystem-corpo'),
                'label_block'   => true,
                'conditions' => [
                    'relation'  => 'and',
                    'terms'     => [
                        [
                            'name' => 'is_auto',
                            'operator' => '=',
                            'value' => 'yes'
                        ],
                    ]
                ],
            )
        );
        // IF it's an URL
        $repeater->add_control(
            'cta_link',
            array(
                'label'         => __('URL', 'assystem-corpo'),
                'type'          => Controls_Manager::URL,
                'separator'     => "before",
                'title'         => __('URL', 'assystem-corpo'),
                'label_block'   => true,
                'conditions' => [
                    'relation'  => 'and',
                    'terms'     => [
                        [
                            'name' => 'is_auto',
                            'operator' => '!=',
                            'value' => 'yes'
                        ],
                    ]
                ],
            )
        );
        // IF no link selected > fields for title / text / tags
        $repeater->add_control(
            'thumb_title',
            array(
                'label'         => __('Titre de l\'onglet (si aucun lien renseigné)', 'assystem-corpo'),
                'type'          => Controls_Manager::TEXT,
                'title'         => __('Titre', 'assystem-corpo'),
                'label_block'   => true,
                'conditions' => [
                    'relation'  => 'and',
                    'terms'     => [
                        [
                            'name' => 'is_auto',
                            'operator' => '!=',
                            'value' => 'yes'
                        ],
                    ]
                ],
            )
        );
        $repeater->add_control(
            'thumb_text',
            array(
                'label'         => __('Texte de l\'onglet (si aucun lien renseigné)', 'assystem-corpo'),
                'type'          => Controls_Manager::TEXT,
                'title'         => __('Titre', 'assystem-corpo'),
                'label_block'   => true,
                'conditions' => [
                    'relation'  => 'and',
                    'terms'     => [
                        [
                            'name' => 'is_auto',
                            'operator' => '!=',
                            'value' => 'yes'
                        ],
                    ]
                ],
            )
        );
        $repeater->add_control(
            'thumb_image',
            array(
                'label'         => __('Image de l\'onglet (si aucun lien renseigné)', 'assystem-corpo'),
                'type'          => Controls_Manager::MEDIA,
                'title'         => __('Image', 'assystem-corpo'),
                'label_block'   => true,
                'conditions' => [
                    'relation'  => 'and',
                    'terms'     => [
                        [
                            'name' => 'is_auto',
                            'operator' => '!=',
                            'value' => 'yes'
                        ],
                    ]
                ],
            )
        );

        // End of repeater
        $this->add_control(
            'list',
            [
                'label' => __( 'Slides', 'assystem' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    'title'     => "",
                    'cta_label' => "",
                    'cta_link'  => "",
                ],
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

        foreach($settings['list'] as $key => $element) {
            $is_auto    =  !empty($element['is_auto'])?$element['is_auto']:'';
            if( !empty($is_auto) && $is_auto == "yes" ) {
                $id_post=  $element['post_link'];
                $post   =  get_post($id_post);
                $settings['list'][$key]['cta_label']    = $element['cta_label'];
                $settings['list'][$key]['cta_link']     = get_permalink($id_post);
                $settings['list'][$key]['post_title']   = $post->post_title;
                $settings['list'][$key]['post_excerpt'] = $post->post_excerpt;
                $settings['list'][$key]['image']        = get_the_post_thumbnail_url($post->ID);
                // TODO : get right size thumb for banner  + ALT (dynamize)
            } else {
                $settings['list'][$key]['post_title']   = $element['thumb_title'];
                $settings['list'][$key]['post_excerpt'] = $element['thumb_text'];
                if( !empty($element['thumb_image']) ) {
                    $settings['list'][$key]['image']    = wp_get_attachment_image_url($element['thumb_image']['id'], 'banner-img');
                } else {
                    $settings['list'][$key]['image']    = '';
                }
            }
        }
        
        $hide_first =   (!empty($settings['hide_first']))?$settings['hide_first']:'';

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
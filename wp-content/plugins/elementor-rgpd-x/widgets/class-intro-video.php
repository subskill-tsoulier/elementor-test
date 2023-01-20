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
use Elementor\Embed;
use Elementor\Group_Control_Image_Size;
use Elementor\Plugin;
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
class Intro_Video extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
    }

    public function get_name() {
        return 'intro-video';
    }

    public function get_title() {
        return __( 'Bloc Intro Vidéo', 'assystem' );
    }

    public function get_icon() {
        return 'eicon-video-playlist';
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
            'title',
            array(
                'label'   => __( 'Titre du bloc', 'assystem' ),
                'type'    => Controls_Manager::TEXT,
                'placeholder' => esc_html__("Title", "assystem"),
                'default' => "",
            )
        );
        $this->add_control(
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
            'text',
            [
                'label'         => __( 'Texte du bloc', 'assystem' ),
                'type'          => Controls_Manager::WYSIWYG,
                'placeholder'   => esc_html__("Texte", "assystem"),
                'default'       => ""
            ]
        );
        $this->add_control(
            'cta_label', [
                'label'         => __( 'CTA (intitulé)', 'assystem' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'default'       => "Voir la vidéo",
                'label_block'   => true,
            ]
        );
        $this->add_control(
            'cta_link', [
                'label'         => __( 'CTA (lien)', 'assystem' ),
                'type'          => \Elementor\Controls_Manager::URL,
                'default'       => [],
                'label_block'   => true,
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'video_section',
            array(
                'label' => __( 'Vidéo', 'assystem' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );
        $this->add_control(
            'video_type',
            [
                'label' => __( 'Source', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'youtube',
                'options' => [
                    'youtube'       => __( 'YouTube', 'elementor' ),
                    'hosted'        => __( 'Fichier vidéo', 'elementor' ),
                ],
            ]
        );
        $this->add_control(
            'youtube_url',
            [
                'label' => __( 'URL', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                    'categories' => [
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::URL_CATEGORY,
                    ],
                ],
                'placeholder' => __( 'https://www.youtube.com/watch?v=...', 'elementor' ),
                'default' => '',
                'label_block' => true,
                'condition' => [
                    'video_type' => 'youtube',
                ],
            ]
        );
        $this->add_control(
            'hosted_url',
            [
                'label' => __( 'URL', 'elementor' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                    'categories' => [
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::MEDIA_CATEGORY,
                    ],
                ],
                'media_type' => 'video',
                'condition' => [
                    'video_type' => 'hosted',
                ],
            ]
        );
        /*$this->add_control(
            'vimeo_url',
            [
                'label' => __( 'URL', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                    'categories' => [
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::URL_CATEGORY,
                    ],
                ],
                'placeholder' => __( 'Enter your Vimeo URL', 'elementor' ),
                'default' => 'https://vimeo.com/235215203',
                'label_block' => true,
                'condition' => [
                    'video_type' => 'vimeo',
                ],
            ]
        );
        $this->add_control(
            'dailymotion_url',
            [
                'label' => __( 'URL', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                    'categories' => [
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::URL_CATEGORY,
                    ],
                ],
                'placeholder' => __( 'Enter your Dailymotion URL', 'elementor' ),
                'default' => 'https://www.dailymotion.com/video/x6koazf',
                'label_block' => true,
                'condition' => [
                    'video_type' => 'dailymotion',
                ],
            ]
        );
        $this->add_control(
            'hosted_url',
            [
                'label' => __( 'URL', 'elementor' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                    'categories' => [
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::MEDIA_CATEGORY,
                    ],
                ],
                'media_type' => 'video',
                'condition' => [
                    'video_type' => 'hosted',
                ],
            ]
        );*/
        // YT
        /*$this->add_control(
            'start',
            [
                'label' => __( 'Start Time', 'elementor' ),
                'type' => Controls_Manager::NUMBER,
                'description' => __( 'Specify a start time (in seconds)', 'elementor' ),
                'condition' => [
                    'loop' => '',
                ],
            ]
        );
        $this->add_control(
            'end',
            [
                'label' => __( 'End Time', 'elementor' ),
                'type' => Controls_Manager::NUMBER,
                'description' => __( 'Specify an end time (in seconds)', 'elementor' ),
                'condition' => [
                    'loop' => '',
                    'video_type' => [ 'youtube', 'hosted' ],
                ],
            ]
        );
        $this->add_control(
            'video_options',
            [
                'label' => __( 'Video Options', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'autoplay',
            [
                'label' => __( 'Autoplay', 'elementor' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control(
            'mute',
            [
                'label' => __( 'Mute', 'elementor' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control(
            'loop',
            [
                'label' => __( 'Loop', 'elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => [
                    'video_type!' => 'dailymotion',
                ],
            ]
        );
        $this->add_control(
            'controls',
            [
                'label' => __( 'Player Controls', 'elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __( 'Hide', 'elementor' ),
                'label_on' => __( 'Show', 'elementor' ),
                'default' => 'yes',
                'condition' => [
                    'video_type!' => 'vimeo',
                ],
            ]
        );
        $this->add_control(
            'showinfo',
            [
                'label' => __( 'Video Info', 'elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __( 'Hide', 'elementor' ),
                'label_on' => __( 'Show', 'elementor' ),
                'default' => 'yes',
                'condition' => [
                    'video_type' => [ 'youtube', 'dailymotion' ],
                ],
            ]
        );
        $this->add_control(
            'modestbranding',
            [
                'label' => __( 'Modest Branding', 'elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => [
                    'video_type' => [ 'youtube' ],
                    'controls' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'logo',
            [
                'label' => __( 'Logo', 'elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __( 'Hide', 'elementor' ),
                'label_on' => __( 'Show', 'elementor' ),
                'default' => 'yes',
                'condition' => [
                    'video_type' => [ 'dailymotion' ],
                ],
            ]
        );
        $this->add_control(
            'color',
            [
                'label' => __( 'Controls Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => [
                    'video_type' => [ 'vimeo', 'dailymotion' ],
                ],
            ]
        );*/
        // YouTube.
        /*$this->add_control(
            'rel',
            [
                'label' => __( 'Suggested Videos', 'elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __( 'Hide', 'elementor' ),
                'label_on' => __( 'Show', 'elementor' ),
                'condition' => [
                    'video_type' => 'youtube',
                ],
            ]
        );
        $this->add_control(
            'yt_privacy',
            [
                'label' => __( 'Privacy Mode', 'elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'description' => __( 'When you turn on privacy mode, YouTube won\'t store information about visitors on your website unless they play the video.', 'elementor' ),
                'condition' => [
                    'video_type' => 'youtube',
                ],
            ]
        );*/
        /*// Vimeo.
        $this->add_control(
            'vimeo_title',
            [
                'label' => __( 'Intro Title', 'elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __( 'Hide', 'elementor' ),
                'label_on' => __( 'Show', 'elementor' ),
                'default' => 'yes',
                'condition' => [
                    'video_type' => 'vimeo',
                ],
            ]
        );
        $this->add_control(
            'vimeo_portrait',
            [
                'label' => __( 'Intro Portrait', 'elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __( 'Hide', 'elementor' ),
                'label_on' => __( 'Show', 'elementor' ),
                'default' => 'yes',
                'condition' => [
                    'video_type' => 'vimeo',
                ],
            ]
        );
        $this->add_control(
            'vimeo_byline',
            [
                'label' => __( 'Intro Byline', 'elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __( 'Hide', 'elementor' ),
                'label_on' => __( 'Show', 'elementor' ),
                'default' => 'yes',
                'condition' => [
                    'video_type' => 'vimeo',
                ],
            ]
        );
        $this->add_control(
            'view',
            [
                'label' => __( 'View', 'elementor' ),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'youtube',
            ]
        );
        */
        $this->end_controls_section();
        $this->start_controls_section(
            'overlay_section',
            [
                'label' => __( 'Image de couverture', 'elementor' ),
            ]
        );
        $this->add_control(
            'show_image_overlay',
            [
                'label' => __( 'Image Overlay', 'elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __( 'Hide', 'elementor' ),
                'label_on' => __( 'Show', 'elementor' ),
            ]
        );
        $this->add_control(
            'image_overlay',
            [
                'label' => __( 'Image', 'elementor' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'show_image_overlay' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image_overlay', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_overlay_size` and `image_overlay_custom_dimension`.
                'default' => 'full',
                'separator' => 'none',
                'condition' => [
                    'show_image_overlay' => 'yes',
                ],
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
        $settings       = $this->get_settings_for_display();
        $video_html     = '';
        $video_id       = '';
        $embed_params   = [];
        $embed_options  = [];
        $video_type     = $settings['video_type'];
        $video_url      = $settings[ $video_type . '_url' ];
        if ( !empty($video_url) ):
            if ( 'hosted' === $video_type ) {
                $video_url      = $this->get_hosted_video_url();
            } else {
                $embed_params   = $this->get_embed_params();
                $embed_options  = $this->get_embed_options();
            }
            if ( empty( $video_url ) ) {
//                return;
            }
            $is_static_render_mode  = Plugin::$instance->frontend->is_static_render_mode();
            $post_id                = get_queried_object_id();
            if ( 'hosted' === $video_type ) {
                $video_html = $this->render_hosted_video();
            } else {
                $video_html = Embed::get_embed_html($video_url, $embed_params, $embed_options, array("class" => "embed-responsive-item"));
                $video_id   = Embed::get_video_properties($video_url);
            }

            if ( empty( $video_html ) || empty($video_id) ) {
//                echo esc_url( $video_url );
//                return;
            }
        
        endif;

        $hn             = (!empty($settings['hn']))?$settings['hn']:'h1';
        $image_overlay  = (!empty($settings['image_overlay']))?$settings['image_overlay']:'';
        if( !empty($image_overlay) && !empty($image_overlay['id']) ) {
            $image_overlay['url']   =   wp_get_attachment_image_url($image_overlay['id'], 'banner-img');   
        }
        $title          = (!empty($settings['title']))?$settings['title']:'';
        $text           = (!empty($settings['text']))?$settings['text']:'';
        $cta_link       = (!empty($settings['cta_link']))?$settings['cta_link']:'';
        $cta_label      = (!empty($settings['cta_label']))?$settings['cta_label']:'';

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

    /**
     * @param bool $from_media
     *
     * @return string
     * @since 2.1.0
     * @access private
     */
    private function get_hosted_video_url() {
        $settings = $this->get_settings_for_display();

        if ( ! empty( $settings['insert_url'] ) ) {
            $video_url = $settings['external_url']['url'];
        } else {
            $video_url = $settings['hosted_url']['url'];
        }

        if ( empty( $video_url ) ) {
            return '';
        }

        if ( !empty($settings['start']) || !empty($settings['end']) ) {
            $video_url .= '#t=';
        }

        if ( !empty($settings['start']) ) {
            $video_url .= $settings['start'];
        }

        if ( !empty($settings['end']) ) {
            $video_url .= ',' . $settings['end'];
        }

        return $video_url;
    }

    /**
     * Get embed params.
     *
     * Retrieve video widget embed parameters.
     *
     * @since 1.5.0
     * @access public
     *
     * @return array Video embed parameters.
     */
    public function get_embed_params() {
        $settings = $this->get_settings_for_display();

        $params = [];

        $params_dictionary = [];

        if ( 'youtube' === $settings['video_type'] ) {
            $params_dictionary = [
                'loop',
                'controls',
                'mute',
                'rel',
                'modestbranding',
            ];
            $params['wmode'] = 'opaque';
        } elseif ( 'vimeo' === $settings['video_type'] ) {
            $params['color']    = str_replace( '#', '', $settings['color'] );
            $params['autopause']= '0';
        } elseif ( 'dailymotion' === $settings['video_type'] ) {
            $params['ui-highlight']     = str_replace( '#', '', $settings['color'] );
            $params['endscreen-enable'] = '0';
        }
        return $params;
    }

    /**
     * @since 2.1.0
     * @access private
     */
    private function get_embed_options() {
        $settings       = $this->get_settings_for_display();
        $embed_options  = [];
        if ( 'youtube' === $settings['video_type'] ) {
            $embed_options['privacy'] = 1;
        }
        $embed_options['lazy_load'] = 0;
        return $embed_options;
    }

    /**
     *
     * @since 2.1.0
     * @access private
     */
    private function render_hosted_video() {
        $video_url = $this->get_hosted_video_url();
        if ( empty( $video_url ) ) {
            return;
        }

        $video_params = $this->get_hosted_params();
        /* Sometimes the video url is base64, therefore we use `esc_attr` in `src`. */
        return '<video class="elementor-video b-lazy" data-src="'. esc_attr( $video_url ) .'" '.$video_params.'></video>';
    }

    /**
     * @since 2.1.0
     * @access private
     */
    private function get_hosted_params() {
        $settings = $this->get_settings_for_display();

        $video_params = [];

        foreach ( [ 'autoplay', 'loop', 'controls' ] as $option_name ) {
            if ( !empty($settings[ $option_name ]) ) {
                $video_params[ $option_name ] = '';
            }
        }

        if( empty($settings['autoplay']) ) {
            $video_params['autoplay'] = 'true';
        }

        if ( !isset($settings['mute']) ) {
            $video_params['muted'] = 'muted';
        }

        if ( !isset($settings['play_on_mobile']) ) {
            $video_params['playsinline'] = 'true';
        }

        if ( ! isset($settings['download_button']) ) {
            $video_params['controlsList'] = 'nodownload';
        }

        if ( isset($settings['poster']['url']) ) {
            $video_params['poster'] = $settings['poster']['url'];
        }

        if( !isset($settings['loop']) ) {
            $video_params['loop']   =   "true";
        }

        $html   =   '';
        foreach( $video_params as $key => $value ) {
            $html.= $key."='".$value."' ";
        }

        return $html;
    }

}
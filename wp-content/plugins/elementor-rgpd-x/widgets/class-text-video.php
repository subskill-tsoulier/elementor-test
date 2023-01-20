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
class Text_Video extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
    }

    public function get_name() {
        return 'text-video';
    }

    public function get_title() {
        return __( 'Bloc Texte / Vidéo', 'assystem' );
    }

    public function get_icon() {
        return 'eicon-video-camera';
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
                'label' => __( 'Configuration générale', 'assystem' ),
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
            array(
                'label'   => __( 'Texte', 'assystem' ),
                'type'    => Controls_Manager::WYSIWYG,
                'default' => '',
            )
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'elements_section',
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
                    'vimeo'         => __( 'Vimeo', 'elementor' ),
                    'dailymotion'   => __( 'Dailymotion', 'elementor' ),
                    'hosted'        => __( 'Self Hosted', 'elementor' ),
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
        $video_html = '';
        $video_type = !empty($settings['video_type'])?$settings['video_type']:'youtube';
        $video_url  = $settings[ $video_type . '_url' ];
        if ( !empty($video_url) ):
            if ( 'hosted' === $video_type ) {
                $video_url = $this->get_hosted_video_url();
            } else {
                $embed_params   = $this->get_embed_params();
                $embed_options  = $this->get_embed_options();
            }

            if ( empty( $video_url ) ) {
                return;
            }

            if ( 'youtube' === $video_type ) {
                $video_html = '<div class="elementor-video"></div>';
            }

            if ( 'hosted' === $video_type ) {
                ob_start();
                $this->render_hosted_video();
                $video_html = ob_get_clean();
            } else {
                $is_static_render_mode  = Plugin::$instance->frontend->is_static_render_mode();
                $post_id                = get_queried_object_id();

                $video_html = Embed::get_embed_html( $video_url, $embed_params, $embed_options, array("class" => "embed-responsive-item") );
            }
        
        endif;
        $hn         =   (!empty($settings['hn']))?$settings['hn']:'h2';
        $title      =   (!empty($settings['title']))?$settings['title']:'';
        $text       =   (!empty($settings['text']))?$settings['text']:'';

        require plugin_dir_path((((__FILE__)))) . 'public/'.$this->get_name().'.php';
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

        if ( $settings['start'] || $settings['end'] ) {
            $video_url .= '#t=';
        }

        if ( $settings['start'] ) {
            $video_url .= $settings['start'];
        }

        if ( $settings['end'] ) {
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
        $settings   = $this->get_settings_for_display();
        $video_type = !empty($settings['video_type'])?$settings['video_type']:'youtube';
        $params     = [];

        $params_dictionary = [];

        if ( 'youtube' === $video_type ) {
            $params_dictionary = [
                'loop',
                'controls',
                'mute',
                'rel',
                'modestbranding',
            ];
            $params['wmode'] = 'opaque';
        } elseif ( 'vimeo' === $video_type ) {
            $params['color']    = str_replace( '#', '', $settings['color'] );
            $params['autopause']= '0';
        } elseif ( 'dailymotion' === $video_type ) {
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
        $video_type     = !empty($settings['video_type'])?$settings['video_type']:'youtube';
        $embed_options  = [];
        if ( 'youtube' === $video_type ) {
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
        ?>
        <video class="elementor-video" src="<?php echo esc_attr( $video_url ); ?>" <?php Utils::print_html_attributes( $video_params ); ?>></video>
        <?php
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
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
class LastOffers extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
    }

    public function get_name() {
        return 'last-offers';
    }

    public function get_title() {
        return __( 'Bloc dernières offres', 'assystem' );
    }

    public function get_icon() {
        return 'eicon-post-list';
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
            'numberposts',
            array(
                'label'   => __( 'Nombre d\'offres à remonter', 'assystem' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => '',
            )
        );
        $this->add_control(
            'automatic',
            array(
                'label'         => __( 'Récupérer automatiquement les offres', 'assystem' ),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => esc_html__("Si vous souhaitez récupérer les offres automatiquement, activez le switch.", "assystem"),
                'label_on'      => esc_html__( 'Oui', 'assystem' ),
                'label_off'     => esc_html__( 'Non', 'assystem' ),
                'return_value'  => 'yes',
                'default'       => 'yes',
            )
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'item_title', [
                'label'         => __( 'Titre', 'assystem' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'default'       => "",
                'label_block'   => true,
            ]
        );
        $repeater->add_control(
            'item_cta_label',
            array(
                'label'   => __( 'Intitulé du lien', 'assystem' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '',
            )
        );
        $repeater->add_control(
            'item_cta_link',
            array(
                'label'         => __( 'Lien vers la page "Offres"', 'assystem' ),
                'type'          => Controls_Manager::URL,
                'label_block'   => true,
            )
        );
        $repeater->add_control(
            'item_contract', [
                'label'         => __( 'Contrat', 'assystem' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'default'       => "",
                'label_block'   => true,
            ]
        );
        $repeater->add_control(
            'item_place', [
                'label'         => __( 'Lieu', 'assystem' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'default'       => "",
                'label_block'   => true,
            ]
        );
        $repeater->add_control(
            'item_date', [
                'label'         => __( 'Date', 'assystem' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'default'       => "",
                'label_block'   => true,
            ]
        );
        $this->add_control(
            'list',
            [
                'label'         => __( 'Répétition', 'elementor-awesomesauce' ),
                'type'          => \Elementor\Controls_Manager::REPEATER,
                'fields'        => $repeater->get_controls(),
                'default'       => [],
                'title_field'   => '{{{ item_title }}}',
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
            ]
        );
        $this->add_control(
            'cta_label',
            array(
                'label'   => __( 'Intitulé du lien', 'assystem' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '',
            )
        );
        $this->add_control(
            'cta_link',
            array(
                'label'         => __( 'Lien vers la page "Offres"', 'assystem' ),
                'type'          => Controls_Manager::URL,
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
        $settings = $this->get_settings_for_display();

        $data_list_no_filter          = [
            'geoip' => "no"
        ];
        $offers_list_no_filter        = apply_filters('offer_list_no_filter', $data_list_no_filter);

        // data send
        $data = [
            'count' => (!empty($settings['numberposts']))?$settings['numberposts']:4
        ];
        $auto       = (isset($settings['automatic']))?$settings['automatic']:'yes';
        // api call
        if( $auto == "yes" ) {
            $offers = apply_filters('offer_list_no_filter', $data);
        } else {
            $list   = !empty($settings['list'])?$settings['list']:[];
            $offers = (object)array(
                'data'  => []
            );
            if( !empty($list) ) {
                foreach($list as $item) {
                    $offers->data[]   =   (object)array(
                        'title'         =>  !empty($item['item_title'])?$item['item_title']:'',
                        'location'      =>  !empty($item['item_place'])?$item['item_place']:'',
                        'date'          =>  !empty($item['item_date'])?$item['item_date']:'',
                        'link'          =>  (object)array(
                            'url'       =>  !empty($item['item_cta_link'])?$item['item_cta_link']:'',
                            'label'     =>  !empty($item['item_cta_label'])?$item['item_cta_label']:''
                        ),
                        'contractType'  =>  (object)array(
                            'label'     =>  !empty($item['item_contract'])?$item['item_contract']:''
                        )
                    );
                }
            }
        }
        $title      = !empty($settings['title'])?$settings['title']:'';
        $hn         = !empty($settings['hn'])?$settings['hn']:'h2';
        $cta_link   = !empty($settings['cta_link'])?$settings['cta_link']:'';
        $cta_label  = !empty($settings['cta_label'])?$settings['cta_label']:'';

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
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
class Picto_Cols extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
    }

    public function get_name() {
        return 'picto-cols';
    }

    public function get_title() {
        return __( 'Bloc pictogramme 3 colonnes', 'assystem' );
    }

    public function get_icon() {
        return 'eicon-columns';
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
            'image',
            array(
                'label'         => __( 'Icône', 'assystem' ),
                'type'          => Controls_Manager::MEDIA,
                'media_types'   => ['svg'],
                'placeholder'   => esc_html__("Title", "assystem"),
                'description'   => esc_html__("Veuillez uploader un SVG.", "assystem"),
            )
        );
        $this->add_control(
            'display_col_1',
            array(
                'label'         => __( 'Afficher la colonne n°1', 'assystem' ),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => esc_html__("Si vous souhaitez activer la première colonne, activez le switch.", "assystem"),
                'label_on'      => esc_html__( 'Oui', 'assystem' ),
                'label_off'     => esc_html__( 'Non', 'assystem' ),
                'return_value'  => 'yes',
                'default'       => 'yes',
            )
        );
        $this->add_control(
            'display_col_2',
            array(
                'label'         => __( 'Afficher la colonne n°2', 'assystem' ),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => esc_html__("Si vous souhaitez activer la deuxième colonne, activez le switch.", "assystem"),
                'label_on'      => esc_html__( 'Oui', 'assystem' ),
                'label_off'     => esc_html__( 'Non', 'assystem' ),
                'return_value'  => 'yes',
                'default'       => 'yes',
            )
        );
        $this->add_control(
            'display_col_3',
            array(
                'label'         => __( 'Afficher la colonne n°3', 'assystem' ),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => esc_html__("Si vous souhaitez activer la troisième colonne, activez le switch.", "assystem"),
                'label_on'      => esc_html__( 'Oui', 'assystem' ),
                'label_off'     => esc_html__( 'Non', 'assystem' ),
                'return_value'  => 'yes',
                'default'       => 'yes',
            )
        );
        $this->add_control(
            'display_double_cols',
            array(
                'label'         => __( 'Afficher la ligne du bloc de couleur', 'assystem' ),
                'type'          => Controls_Manager::SWITCHER,
                'description'   => esc_html__("Si vous souhaitez activer la ligne avec les double colonnes, activez le switch.", "assystem"),
                'label_on'      => esc_html__( 'Oui', 'assystem' ),
                'label_off'     => esc_html__( 'Non', 'assystem' ),
                'return_value'  => 'yes',
                'default'       => '',
            )
        );
        $this->end_controls_section();
        // COL 1
        $this->start_controls_section(
            'col_1',
            array(
                'label'     => __( 'Colonne n°1', 'assystem' ),
                'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
                'conditions'=> [
                    'relation'  => 'and',
                    'terms'     => [
                        [
                            'name'      => 'display_col_1',
                            'operator'  => '=',
                            'value'     => 'yes'
                        ],
                    ]
                ]
            )
        );
        $this->add_control(
            'col_1_icon',
            [
                'label'         => __( 'Icône du bloc', 'assystem' ),
                'type'          => Controls_Manager::MEDIA,
                'media_types'   => ['svg'],
            ]
        );
        $this->add_control(
            'col_1_title',
            array(
                'label'   => __( 'Titre du bloc', 'assystem' ),
                'type'    => Controls_Manager::TEXT,
                'placeholder' => esc_html__("Title", "assystem"),
                'default' => "",
            )
        );
        $this->add_control(
            'col_1_subtitle',
            array(
                'label'   => __( 'Sous-titre du bloc', 'assystem' ),
                'type'    => Controls_Manager::TEXT,
                'placeholder' => esc_html__("Sous-titre du bloc", "assystem"),
                'default' => "",
            )
        );
        $this->add_control(
            'col_1_title_col',
            array(
                'label'         => __( 'Titre de la colonne', 'assystem' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__("Titre de la colonne", "assystem"),
                'default'       => "",
            )
        );
        $this->add_control(
            'col_1_text',
            array(
                'label'         => __( 'Texte de la colonne', 'assystem' ),
                'type'          => Controls_Manager::WYSIWYG,
                'placeholder'   => esc_html__("Texte de la colonne", "assystem"),
                'default'       => "",
            )
        );
        $this->end_controls_section();
        // COL 2
        $this->start_controls_section(
            'col_2',
            array(
                'label'     => __( 'Colonne n°2', 'assystem' ),
                'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
                'conditions'=> [
                    'relation'  => 'and',
                    'terms'     => [
                        [
                            'name'      => 'display_col_2',
                            'operator'  => '=',
                            'value'     => 'yes'
                        ],
                    ]
                ]
            )
        );
        $this->add_control(
            'col_2_icon',
            [
                'label'         => __( 'Icône du bloc', 'assystem' ),
                'type'          => Controls_Manager::MEDIA,
                'media_types'   => ['svg'],
            ]
        );
        $this->add_control(
            'col_2_title',
            array(
                'label'   => __( 'Titre du bloc', 'assystem' ),
                'type'    => Controls_Manager::TEXT,
                'placeholder' => esc_html__("Title", "assystem"),
                'default' => "",
            )
        );
        $this->add_control(
            'col_2_subtitle',
            array(
                'label'   => __( 'Sous-titre du bloc', 'assystem' ),
                'type'    => Controls_Manager::TEXT,
                'placeholder' => esc_html__("Sous-titre du bloc", "assystem"),
                'default' => "",
            )
        );
        $this->add_control(
            'col_2_title_col',
            array(
                'label'         => __( 'Titre de la colonne', 'assystem' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__("Titre de la colonne", "assystem"),
                'default'       => "",
            )
        );
        $this->add_control(
            'col_2_text',
            array(
                'label'         => __( 'Texte de la colonne', 'assystem' ),
                'type'          => Controls_Manager::WYSIWYG,
                'placeholder'   => esc_html__("Texte de la colonne", "assystem"),
                'default'       => "",
            )
        );
        $this->end_controls_section();
        // COL 3
        $this->start_controls_section(
            'col_3',
            array(
                'label'     => __( 'Colonne n°3', 'assystem' ),
                'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
                'conditions'=> [
                    'relation'  => 'and',
                    'terms'     => [
                        [
                            'name'      => 'display_col_3',
                            'operator'  => '=',
                            'value'     => 'yes'
                        ],
                    ]
                ]
            )
        );
        $this->add_control(
            'col_3_icon',
            [
                'label'         => __( 'Icône du bloc', 'assystem' ),
                'type'          => Controls_Manager::MEDIA,
                'media_types'   => ['svg'],
            ]
        );
        $this->add_control(
            'col_3_title',
            array(
                'label'   => __( 'Titre du bloc', 'assystem' ),
                'type'    => Controls_Manager::TEXT,
                'placeholder' => esc_html__("Title", "assystem"),
                'default' => "",
            )
        );
        $this->add_control(
            'col_3_subtitle',
            array(
                'label'   => __( 'Sous-titre du bloc', 'assystem' ),
                'type'    => Controls_Manager::TEXT,
                'placeholder' => esc_html__("Sous-titre du bloc", "assystem"),
                'default' => "",
            )
        );
        $this->add_control(
            'col_3_title_col',
            array(
                'label'         => __( 'Titre de la colonne', 'assystem' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__("Titre de la colonne", "assystem"),
                'default'       => "",
            )
        );
        $this->add_control(
            'col_3_text',
            array(
                'label'         => __( 'Texte de la colonne', 'assystem' ),
                'type'          => Controls_Manager::WYSIWYG,
                'placeholder'   => esc_html__("Texte de la colonne", "assystem"),
                'default'       => "",
            )
        );
        $this->end_controls_section();
        // UNDER ROW
        $this->start_controls_section(
            'double_cols',
            array(
                'label'     => __( 'Bloc double colonne', 'assystem' ),
                'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'display_double_cols' => 'yes'
                ]
            )
        );
        $this->add_control(
            'double_cols_left',
            array(
                'label'         => __( 'Texte de la colonne de gauche', 'assystem' ),
                'type'          => Controls_Manager::WYSIWYG,
                'placeholder'   => esc_html__("Texte de la colonne de gauche", "assystem"),
                'default'       => "",
            )
        );
        $this->add_control(
            'double_cols_right',
            array(
                'label'         => __( 'Texte de la colonne de droite', 'assystem' ),
                'type'          => Controls_Manager::WYSIWYG,
                'placeholder'   => esc_html__("Texte de la colonne de droite", "assystem"),
                'default'       => "",
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
        $settings               = $this->get_settings_for_display();
        $display_double_cols    = (!empty($settings['display_double_cols']))?$settings['display_double_cols']:'no';
        $double_cols_left       = (!empty($settings['double_cols_left']))?$settings['double_cols_left']:'';
        $double_cols_right      = (!empty($settings['double_cols_right']))?$settings['double_cols_right']:'';
        $title                  = (!empty($settings['title']))?$settings['title']:'';
        $hn                     = (!empty($settings['hn']))?$settings['hn']:'h2';
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
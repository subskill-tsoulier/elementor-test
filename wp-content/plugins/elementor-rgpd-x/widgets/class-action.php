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
class Action extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
        //wp_register_style( 'assystem', plugins_url( '/assets/css/assystem.css', ELEMENTOR_ASSYSTEM ), array(), '1.0.0' );
    }

    public function get_name() {
        return 'action';
    }

    public function get_title() {
        return __( 'Bloc tableau action Euronext', 'assystem' );
    }

    public function get_icon() {
        return 'eicon-product-upsell';
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
                'label'         => __( 'Titre du bloc', 'assystem' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__("Titre du bloc", "assystem"),
                'default'       => ""
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
            'subtitle',
            array(
                'label'         => __( 'Sous-titre du bloc', 'assystem' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__("Sous-titre du bloc", "assystem"),
                'default'       => ""
            )
        );
        $this->add_control(
            'subtitle_hn',
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
                            'name' => 'subtitle',
                            'operator' => '!=',
                            'value' => ''
                        ],
                    ]
                ],
            ]
        );
        $this->add_control(
            'subtitle_graph',
            array(
                'label'         => __( 'Sous-titre pour le graph', 'assystem' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__("Sous-titre pour le graph", "assystem"),
                'default'       => ""
            )
        );
        $this->add_control(
            'subtitle_graph_hn',
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
                            'name' => 'subtitle',
                            'operator' => '!=',
                            'value' => ''
                        ],
                    ]
                ],
            ]
        );
        $this->add_control(
            'graph_alt', [
                'label' => __('Texte alternatif pour le graph (accessibilité)', 'assystem'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'title' => __('Text alternatif', 'assystem'),
                'label_block' => true,
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'comparaison',
            array(
                'label' => __( 'Comparaison', 'assystem' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );
        $this->add_control(
            'comparaison_title',
            array(
                'label'         => __( 'Titre du bloc', 'assystem' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__("Titre du bloc", "assystem"),
                'default'       => ""
            )
        );
        $this->add_control(
            'comparaison_hn',
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
                            'name' => 'comparaison_title',
                            'operator' => '!=',
                            'value' => ''
                        ],
                    ]
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'historique',
            array(
                'label' => __( 'Historique', 'assystem' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );
        $this->add_control(
            'historique_title',
            array(
                'label'         => __( 'Titre du bloc', 'assystem' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__("Titre du bloc", "assystem"),
                'default'       => ""
            )
        );
        $this->add_control(
            'historique_hn',
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
                            'name' => 'comparaison_title',
                            'operator' => '!=',
                            'value' => ''
                        ],
                    ]
                ],
            ]
        );
        $this->add_control(
            'bloc_history_graphs', [
                'label' => __('Graphes', 'assystem'),
                'type' => Controls_Manager::REPEATER,
                'default' => [],
                'fields' => [
                    [
                        'name'          => 'bloc_graph_year',
                        'label'         => __('Année', 'assystem'),
                        'type'          => Controls_Manager::TEXT,
                        'title'         => __('Année', 'assystem'),
                        'label_block'   => true,
                    ]
                ]
            ]
        );
        $this->add_control(
            'bloc_history_text', [
                'label' => __('Texte alternatif du graphique historique (accessibilité)', 'assystem'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => '',
                'title' => __('Texte descriptif', 'assystem'),
                'label_block' => true,
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
        $hn             = (!empty($settings['hn']))?$settings['hn']:'h2';
        $title          = (!empty($settings['title']))?$settings['title']:'';
        $subtitle       = (!empty($settings['subtitle']))?$settings['subtitle']:'';
        $subtitle_hn    = (!empty($settings['subtitle_hn']))?$settings['subtitle_hn']:'h3';
        $subtitle_graph       = (!empty($settings['subtitle_graph']))?$settings['subtitle_graph']:'';
        $subtitle_graph_hn    = (!empty($settings['subtitle_graph_hn']))?$settings['subtitle_graph_hn']:'h3';
        $cotation_alt   = (!empty($settings['graph_alt']))?$settings['graph_alt']:'';
        $link_json      = (function_exists("get_field"))?get_field("bourse_link", "option"):"";
        $cotation       = '';
        $comparaison    = '';
        //
        if( !empty($link_json) ):
            $json_raw   = wp_remote_get($link_json);
            $json_arr   = json_decode(wp_remote_retrieve_body($json_raw));
            $cotation   = $this->getCotation($json_arr);
            $comparaison= $this->getComparaison($json_arr);
        endif;
        // Comparaison block
        $comparaison_hn     = (!empty($settings['comparaison_hn']))?$settings['comparaison_hn']:'h3';
        $comparaison_title  = (!empty($settings['comparaison_title']))?$settings['comparaison_title']:'';
        // Historique
        $historique_hn      = (!empty($settings['historique_hn']))?$settings['historique_hn']:'h3';
        $historique_title   = (!empty($settings['historique_title']))?$settings['historique_title']:'';
        $historique_graph   = (!empty($settings['bloc_history_graphs'])) ? $this->get_years($settings['bloc_history_graphs']) : array();
        $historique_alt     = (!empty($settings['bloc_history_text'])) ? $settings['bloc_history_text'] : '';
        $historique         = $this->getHistorique($historique_graph);
        //
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

    private function getHistorique($historique_graph) {
        return array(
            'graph' => array(
                'img'   => (!empty($historique_graph))?"https://gateway.euronext.com/charts/history.gif?PROFILE=blue&FILLED=true&INSTRUMENT=FR0000074148*XPAR*ISIN&STARTDATE=&ENDDATE=&PERIOD=".$historique_graph[0]."Y&ADD_DAY_LAST_PRICE=true&COMP=&DATA_TYPE=PX&ADD_INFO=&QUALITY=RT&WIDTH=820&HEIGHT=320&authKey=ae22289fc7275f246a6040bc1496afc64334b4b2d102e24d2a2a38964eae909a":''
            )
        );
    }

    private function getComparaison($json_arr) {
        //variations
        $week       = round((float) $json_arr->instr->perf[10]->var * 100, 2);
        $week       = ($week > 0)?"+".$week:$week;
        $jan_1      = round((float) $json_arr->instr->perf[8]->var * 100, 2);
        $jan_1      = ($jan_1 > 0)?"+".$jan_1:$jan_1;
        $month_6    = round((float) $json_arr->instr->perf[7]->var * 100, 2);
        $month_6    = ($month_6 > 0)?"+".$month_6:$month_6;
        $month_3    = round((float) $json_arr->instr->perf[9]->var * 100, 2);
        $month_3    = ($month_3 > 0)?"+".$month_3:$month_3;
        $month_1    = round((float) $json_arr->instr->perf[11]->var * 100, 2);
        $month_1    = ($month_1 > 0)?"+".$month_1:$month_1;
        //date
        $week_date      = $this->get_full_date($json_arr->instr->perf[10]->highPxDtTm);
        $jan_1_date     = $this->get_full_date($json_arr->instr->perf[8]->highPxDtTm);
        $month_6_date   = $this->get_full_date($json_arr->instr->perf[7]->highPxDtTm);
        $month_3_date   = $this->get_full_date($json_arr->instr->perf[9]->highPxDtTm);
        $month_1_date   = $this->get_full_date($json_arr->instr->perf[11]->highPxDtTm);
        // High
        $week_high      = round((float) $json_arr->instr->perf[10]->highPx, 2);
        $jan_1_high     = round((float) $json_arr->instr->perf[8]->highPx, 2);
        $month_6_high   = round((float) $json_arr->instr->perf[7]->highPx, 2);
        $month_3_high   = round((float) $json_arr->instr->perf[9]->highPx, 2);
        $month_1_high   = round((float) $json_arr->instr->perf[11]->highPx, 2);
        // Date + Bas
        $week_date_2    = $this->get_full_date($json_arr->instr->perf[10]->lowPxDtTm);
        $jan_1_date_2   = $this->get_full_date($json_arr->instr->perf[8]->lowPxDtTm);
        $month_6_date_2 = $this->get_full_date($json_arr->instr->perf[7]->lowPxDtTm);
        $month_3_date_2 = $this->get_full_date($json_arr->instr->perf[9]->lowPxDtTm);
        $month_1_date_2 = $this->get_full_date($json_arr->instr->perf[11]->lowPxDtTm);
        // low
        $week_low       = round((float) $json_arr->instr->perf[10]->lowPx, 2);
        $jan_1_low      = round((float) $json_arr->instr->perf[8]->lowPx, 2);
        $month_6_low    = round((float) $json_arr->instr->perf[7]->lowPx, 2);
        $month_3_low    = round((float) $json_arr->instr->perf[9]->lowPx, 2);
        $month_1_low    = round((float) $json_arr->instr->perf[11]->lowPx, 2);
        //
        return array (
            'variation'   => array(
                'week'  => $week,
                'jan_1' => $jan_1,
                '6m'    => $month_6,
                '3m'    => $month_3,
                '1m'    => $month_1
            ),
            'variation_class'   => array(
                'week'  => $this->check_100($week),
                'jan_1' => $this->check_100($jan_1),
                '6m'    => $this->check_100($month_6),
                '3m'    => $this->check_100($month_3),
                '1m'    => $this->check_100($month_1)
            ),
            'date'   => array(
                'week'  => $week_date,
                'jan_1' => $jan_1_date,
                '6m'    => $month_6_date,
                '3m'    => $month_3_date,
                '1m'    => $month_1_date
            ),
            'high'   => array(
                'week'  => $week_high,
                'jan_1' => $jan_1_high,
                '6m'    => $month_6_high,
                '3m'    => $month_3_high,
                '1m'    => $month_1_high
            ),
            'date_lower'   => array(
                'week'  => $week_date_2,
                'jan_1' => $jan_1_date_2,
                '6m'    => $month_6_date_2,
                '3m'    => $month_3_date_2,
                '1m'    => $month_1_date_2
            ),
            'low'   => array(
                'week'  => $week_low,
                'jan_1' => $jan_1_low,
                '6m'    => $month_6_low,
                '3m'    => $month_3_low,
                '1m'    => $month_1_low
            )
        );
    }

    private function getCotation($json_arr) {
        $current_date   = $json_arr->instr->currInstrSess->dateTime;
        $cur_date       = substr($current_date, 6, 2) . '/' . substr($current_date, 4, 2) . '/' . substr($current_date, 0, 4);
        $cur_time       = substr($current_date, 9, 8);
        //
        $previous_date  = $json_arr->instr->prevInstrSess->dateTime;
        $prev_date      = substr($previous_date, 6, 2) . '/' . substr($previous_date, 4, 2) . '/' . substr($previous_date, 0, 4);
        $prev_time      = substr($previous_date, 9, 8);
        //
        $cur_var        = round((float) $json_arr->instr->perf[2]->var * 100, 2);
        $cur_var        = ($cur_var > 0)?"+".$cur_var:$cur_var;
        //
        $prev_var       = round((float) $json_arr->instr->perf[0]->var * 100, 2);
        $prev_var       = ($prev_var > 0)?"+".$prev_var:$prev_var;
        //
        $cur_last_px    = $json_arr->instr->currInstrSess->lastPx;
        $prev_last_px   = $json_arr->instr->prevInstrSess->lastPx;
        //
        $cur_perf       = $json_arr->instr->perf[2]->perStartPx;
        $prev_perf      = $json_arr->instr->perf[0]->perStartPx;
        //
        $high_cur_var   = $json_arr->instr->perf[2]->highPx;
        $high_prev_var  = $json_arr->instr->perf[0]->highPx;
        //
        $low_cur_var    = $json_arr->instr->perf[2]->lowPx;
        $low_prev_var   = $json_arr->instr->perf[0]->lowPx;
        //
        $cur_capitaux   = round((float) $json_arr->instr->perf[2]->tradedAmt);
        $prev_capitaux  = round((float) $json_arr->instr->perf[0]->tradedAmt);
        //
        $graph_img      = "https://gateway.euronext.com/charts/intraday.gif?PROFILE=blue&FILLED=true&INSTRUMENT=FR0000074148*XPAR*ISIN&COMP=&DATA_TYPE=PX&ADD_INFO=&QUALITY=RT&WIDTH=510&HEIGHT=260&authKey=ae22289fc7275f246a6040bc1496afc64334b4b2d102e24d2a2a38964eae909a";
        //
        return array (
            'graph' => array(
                'img'   => $graph_img
            ),
            'last'  => array(
                'cur'   => $cur_last_px,
                'prev'  => $prev_last_px
            ),
            'perf'  => array(
                'cur'   => $cur_perf,
                'prev'  => $prev_perf
            ),
            'capitaux'  => array(
                'cur'   => $cur_capitaux,
                'prev'  => $prev_capitaux
            ),
            'high'      => array(
                'cur'   => $high_cur_var,
                'prev'  => $high_prev_var,
            ),
            'low'      => array(
                'cur'   => $low_cur_var,
                'prev'  => $low_prev_var,
            ),
            'date'      => array(
                'cur'   => array(
                    'date'  => $cur_date,
                    'time'  => $cur_time
                ),
                'prev'  => array(
                    'date'  => $prev_date,
                    'time'  => $prev_time
                )
            ),
            'var'      => array(
                'cur'   => array(
                    'val'  => $cur_var,
                    'class'=> $this->check_100($cur_var)
                ),
                'prev'  => array(
                    'val'  => $prev_var,
                    'class'=> $this->check_100($prev_var)
                )
            )
        );
    }

    private function check_100($flt){
        if ((float) $flt < 0){
            return 'down';
        }else{
            return 'up';
        }
    }

    private function get_full_date ($str_date) {
        $cur_date = substr($str_date, 6, 2) . '/' . substr($str_date, 4, 2) . '/' . substr($str_date, 0, 4);
        return $cur_date;
    }

    private function get_years($arr){
        $years = array();
        if(!empty($arr)){
            foreach ($arr as $year){
                $years[] = $year['bloc_graph_year'];
            }
        }
        return $years;
    }

}
<?php
/**
 * rgpd class.
 *
 * @category   Class
 * @package    ElementorRgpd
 * @subpackage WordPress
 * @author     Subskill <contact@subskill.com>
 * @copyright  2022 Subskill
 * @license    https://opensource.org/licenses/GPL-3.0 GPL-3.0-only
 * @link       link(https://www.subskill.com/,
 *             Build Custom Elementor Widgets)
 * @since      1.0.0
 * php version 7.4.2
 */
namespace ElementorRgpd\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
// Security Note: Blocks direct access to the plugin PHP files.
defined( 'ABSPATH' ) || die();
/**
 * rgpd widget class.
 *
 * @since 1.0.0
 */
class TitleText extends Widget_Base {

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
		//wp_register_style( 'rgpd', plugins_url( '/assets/css/rgpd.css', ELEMENTOR_RGPD ), array(), '1.0.0' );
	}

	public function get_name() {
		return 'title-text';
	}

	public function get_title() {
		return __( 'Bloc Titre / Texte', 'rgpd' );
	}

	public function get_icon() {
		return 'eicon-text';
	}

	public function get_categories() {
		return array( 'rgpd' );
	}

	public function get_style_depends() {
		return array( 'rgpd' );
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
				'label' => __( 'Configuration du bloc', 'rgpd' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'background-color',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => esc_html__( 'Choix du fond de couleur du bloc', 'rgpd' ),
				'required' => true,
				'toggle' => false,
				'options' => [
					'bg-pink'   =>  esc_html__( 'Rouge principal', 'rgpd' ),
					'bg-white'  => esc_html__( 'Blanc', 'rgpd' ),
					'bg-light'  => esc_html__( 'Gris clair', 'rgpd' ),
					'bg-grey'   => esc_html__( 'Gris foncé', 'rgpd' ),
					'bg-violet' => esc_html__( 'Violet', 'rgpd' ),
					'bg-blue'   => esc_html__( 'Bleu', 'rgpd' )
				],
				'default' => 'bg-white'
			]
		);
		$this->add_control(
			'in_card',
			[
				'label'         => esc_html__( 'Mettre le bloc dans un cadre blanc', 'rgpd' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => 'yes',
				'description'   => esc_html__( 'Si vous souhaitez', 'rgpd' ),
				'frontend_available' => true,
			]
		);
		$this->add_control(
			'title',
			array(
				'label'   => __( 'Titre du bloc', 'rgpd' ),
				'type'    => Controls_Manager::TEXT,
				'placeholder' => esc_html__("Title", "rgpd"),
				'default' => "",
			)
		);
		$this->add_control(
			'hn',
			[
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'label' => esc_html__( 'Type de balise pour le titre', 'rgpd' ),
				'required' => true,
				'toggle' => false,
				'options' => [
					'h1' => [
						'title' => esc_html__( 'H1', 'rgpd' ),
						'icon' => 'eicon-editor-h1',
					],
					'h2' => [
						'title' => esc_html__( 'H2', 'rgpd' ),
						'icon' => 'eicon-editor-h2',
					],
					'h3' => [
						'title' => esc_html__( 'H3', 'rgpd' ),
						'icon' => 'eicon-editor-h3',
					],
					'p' => [
						'title' => esc_html__( 'P', 'rgpd' ),
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
				'label'   => __( 'Texte', 'rgpd' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => '',
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
		$settings   = $this->get_settings_for_display();

		$hn         = (!empty($settings['hn']))?$settings['hn']:"h2";
		$title      = (!empty($settings['title']))?$settings['title']:"";
		$text       = (!empty($settings['text']))?$settings['text']:"";
		$bg_color   = (!empty($settings['background-color']))?$settings['background-color']:'bg-white';
		$bg_color   = ($bg_color=="grey")?"bg-light":$bg_color;
		$bg_color   = ($bg_color=="white")?"bg-white":$bg_color;
		$in_card    = (!empty($settings['in_card']))?$settings['in_card']:'';

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
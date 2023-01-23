<?php
/**
 * RGPD Class
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

defined( 'ABSPATH' ) || die();

/**
 * RGPD Basic Text
 *
 * @since 1.0.0
 *
 */
class TextClassic extends Widget_Base {
	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
		//wp_register_style( 'rgpd', plugins_url( '/assets/css/rgpd.css', ELEMENTOR_RGPD ), array(), '1.0.0' );
	}

	public function get_name()
	{
		return 'text-classic';
	}

	public function get_title() {
		return __( 'Bloc classique', 'rgpd' );
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

	protected function register_controls()
	{
		$this->start_controls_section(
			'general',
			array(
				'label' => __( 'Configuration du bloc', 'rgpd' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'hn',
			array(
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'label' => esc_html__( 'Title', 'rgpd' ),
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
				],
				'default' => 'h2',
			)
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
			'para_hn',
			array(
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'label' => esc_html__( 'Title', 'rgpd' ),
				'required' => true,
				'toggle' => false,
				'options' => [
					'p' => [
						'title' => esc_html__( 'P', 'rgpd' ),
						'icon' => 'eicon-editor-p',
					],
					'span' => [
						'title' => esc_html__( 'SPAN', 'rgpd' ),
						'icon' => 'eicon-editor-span',
					],
					'H6' => [
						'title' => esc_html__( 'H6', 'rgpd' ),
						'icon' => 'eicon-editor-h5',
					],
				],
				'default' => 'p',
			)
		);
		$this->add_control(
			'paragraph',
			array(
				'label'   => __( 'Texte', 'rgpd' ),
				'type'    => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__("Message", "rgpd"),
				'default' => '',
			)
		);
		$this->add_control(
			'img', [
				'label' => __( 'Image', 'rgpd' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$x = $this->get_settings_for_display();

		$title_hn = ( !empty( $x["hn"] )) ? $x["hn"] : "";
		$title = ( !empty( $x["title"] )) ? $x["title"] : "";
		$para_hn = ( !empty( $x["para_hn"] )) ? $x["para_hn"] : "";
		$paragraph = ( !empty( $x["paragraph"] )) ? $x["paragraph"] : "";
		$img = ( !empty( $x["img"] )) ? $x["img"] : "";

		require plugin_dir_path((((__FILE__)))) . 'public/'.$this->get_name().'.php';
	}

	protected function content_template() {
		// Silence is golden
	}
}
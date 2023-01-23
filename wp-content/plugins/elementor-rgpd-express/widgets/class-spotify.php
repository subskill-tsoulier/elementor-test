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
class Spotify extends Widget_Base {
	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
		//wp_register_style( 'rgpd', plugins_url( '/assets/css/rgpd.css', ELEMENTOR_RGPD ), array(), '1.0.0' );
	}

	public function get_name()
	{
		return 'spotify';
	}

	public function get_title() {
		return __( 'Spotify', 'rgpd' );
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
			'Spotify',
			array(
				'label' => __( 'Configuration du bloc', 'rgpd' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'hn_spotify',
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
			'title_spotify',
			array(
				'label'   => __( 'Titre', 'rgpd' ),
				'type'    => Controls_Manager::TEXT,
				'placeholder' => esc_html__("Title", "rgpd"),
				'default' => "",
			)
		);

		$this->add_control(
			'spotify',
			array(
				'label' => 'spotify',
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->end_controls_section();
	}

	protected function render()
	{
		$x = $this->get_settings_for_display();

		$hn_spotify = ( !empty($x["hn_spotify"] )) ? $x["hn_spotify"] : "";
		$title_spotify = ( !empty($x["title_spotify"] )) ? $x["title_spotify"] : "";
		$spotify = ( !empty( $x["spotify"] )) ? $x["spotify"] : "";

		require plugin_dir_path((((__FILE__)))) . 'public/'.$this->get_name().'.php';
	}

	protected function content_template() {
		// Silence is golden
	}
}
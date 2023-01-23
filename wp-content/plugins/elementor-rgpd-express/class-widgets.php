<?php
/**
 * Widgets class.
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
 * php version 7.3.9
 */

namespace ElementorRgpd;

// Security Note: Blocks direct access to the plugin PHP files.
use Elementor\Plugin;

defined( 'ABSPATH' ) || die();

/**
 * Class Plugin
 *
 * Main Plugin class
 *
 * @since 1.0.0
 */
class Widgets {

    /**
     * Instance
     *
     * @since 1.0.0
     * @access private
     * @static
     *
     * @var Plugin The single instance of the class.
     */
    private static $instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.0.0
     * @access public
     *
     * @return Plugin An instance of the class.
     */
    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Include Widgets files
     *
     * Load widgets files
     *
     * @since 1.0.0
     * @access private
     */
    private function include_widgets_files() {
        require_once 'widgets/class-title-text.php';
        require_once 'widgets/class-text-classic.php';
		require_once 'widgets/class-spotify.php';
    }

    /**
     * Register Widgets
     *
     * Register new Elementor widgets.
     *
     * @since 1.0.0
     * @access public
     */
    public function register_widgets() {
        // It's now safe to include Widgets files.
        $this->include_widgets_files();

        // Register the plugin widget classes.
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\TitleText() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\TextClassic() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Spotify() );
		// Plugin::instance()->widgets_manager->register_widget_type( new Widgets\TitleText() );
    }

    /**
     *  Plugin class constructor
     *
     * Register plugin action hooks and filters
     *
     * @since 1.0.0
     * @access public
     */
    public function __construct() {
        // Register the widgets.
        add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_widgets' ) );
        add_action( 'elementor/elements/categories_registered', array( $this, 'create_new_category' ) );
    }

    public function create_new_category ( $elements_manager ) {
        $elements_manager->add_category(
            'rgpd',
            [
                'title' => __('Rgpd', 'elementor-rgpd'),
                'icon'  => 'eicon-custom',
            ]
        );
    }

}

// Instantiate the Widgets class.
Widgets::instance();

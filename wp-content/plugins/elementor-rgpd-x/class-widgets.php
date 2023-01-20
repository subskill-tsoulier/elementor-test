<?php
/**
 * Widgets class.
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
 * php version 7.3.9
 */

namespace ElementorAssystem;

// Security Note: Blocks direct access to the plugin PHP files.
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
        require_once 'widgets/class-podcast.php';
        require_once 'widgets/class-action.php';
        require_once 'widgets/class-list-testimonies.php';
        require_once 'widgets/class-agenda-financier.php';
        require_once 'widgets/class-document.php';
        require_once 'widgets/class-list-documents-filters.php';
        require_once 'widgets/class-bourse.php';
        require_once 'widgets/class-recap-finance.php';
        require_once 'widgets/class-keynumbers-image.php';
        require_once 'widgets/class-map.php';
        require_once 'widgets/class-list-membres.php';
        require_once 'widgets/class-double-text.php';
        require_once 'widgets/class-picto-cols.php';
        require_once 'widgets/class-form.php';
        require_once 'widgets/class-hub-contact.php';
        require_once 'widgets/class-banner-contact.php';
        require_once 'widgets/class-expertises.php';
        require_once 'widgets/class-activites.php';
        require_once 'widgets/class-image.php';
        require_once 'widgets/class-text-video.php';
        require_once 'widgets/class-ancres.php';
        require_once 'widgets/class-download-share.php';
        require_once 'widgets/class-list-newsroom-filters.php';
        require_once 'widgets/class-auteur.php';
        require_once 'widgets/class-auteur-podcast.php';
        require_once 'widgets/class-form-download.php';
        require_once 'widgets/class-benefices.php';
        require_once 'widgets/class-wysiwyg-ressource.php';
        require_once 'widgets/class-list-publications-filters.php';
        require_once 'widgets/class-map-pays.php';
        require_once 'widgets/class-map-pays-light.php';
        require_once 'widgets/class-text-keynumbers.php';
        require_once 'widgets/class-banner-projet.php';
        require_once 'widgets/class-list-projets-filters.php';
        require_once 'widgets/class-list-publications.php';
        require_once 'widgets/class-parole-expert.php';
        require_once 'widgets/class-list-newsroom.php';
        require_once 'widgets/class-list-projets.php';
        require_once 'widgets/class-banner-slider.php';
        require_once 'widgets/class-testimony.php';
        require_once 'widgets/class-offers-filters.php';
        require_once 'widgets/class-last-offers.php';
        require_once 'widgets/class-doublewysiwyg.php';
        require_once 'widgets/class-quote.php';
        require_once 'widgets/class-keynumbers.php';
        require_once 'widgets/class-title-text.php';
        require_once 'widgets/class-contact.php';
        require_once 'widgets/class-text-image.php';
        require_once 'widgets/class-intro-video.php';
        require_once 'widgets/class-cta-carriere.php';
        require_once 'widgets/class-tweets.php';
        require_once 'widgets/class-pictos.php';
        require_once 'widgets/class-breadcrumb.php';
        require_once 'widgets/class-plan-site.php';
        require_once 'widgets/class-cta-bloc.php';
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
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Action() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\List_Testimony() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Agenda_Financier() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Document() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ListeDocumentsFilters() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Bourse() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Recap_Finance() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Keynumbers_Image() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Map() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\List_Membres() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Double_Text() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Picto_Cols() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Formulaire() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Hub_Contact() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\BannerContact() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Expertises() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Activites() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ImageZoom() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Text_Image() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Text_Video() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Ancres() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\DownloadShare() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ListNewsroomFilters() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Auteur() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\AuteurPodcast() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Podcast() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\FormDownload() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Benefices() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\WysiwygRessource() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ListePublicationsFilters() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\MapPays() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\MapPaysLight() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\TextKeynumbers() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Title_Text() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\BannerProjet() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ListProjetsFilters() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ListPublications() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ParoleExpert() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ListNewsroom() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Cta_Carriere() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ListProjets() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\BannerSlider() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Pictos() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Testimony() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\LastOffers() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\OffersFilters() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Quote() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Doublewysiwyg() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Keynumbers() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Breadcrumb() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Plan_Site() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Cta_Bloc() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Contact() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Intro_Video() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Tweets() );
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
            'assystem',
            [
                'title' => __('Assystem', 'elementor-assystem'),
                'icon'  => 'eicon-custom',
            ]
        );
    }

}

// Instantiate the Widgets class.
Widgets::instance();

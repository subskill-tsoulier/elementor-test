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
// Security Note: Blocks direct access to the plugin PHP files.
defined( 'ABSPATH' ) || die();
/**
 * Assystem widget class.
 *
 * @since 1.0.0
 */
class Tweets extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
        parent::__construct( $data, $args );
        require_once(plugin_dir_path( dirname(__FILE__) ) . 'TwitterAPIExchange.php');
        //wp_register_style( 'assystem', plugins_url( '/assets/css/assystem.css', ELEMENTOR_ASSYSTEM ), array(), '1.0.0' );
    }

    public function get_name() {
        return 'tweets';
    }

    public function get_title() {
        return __( 'Bloc Social Wall (Twitter)', 'assystem' );
    }

    public function get_icon() {
        return 'eicon-posts-masonry';
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
            'display_title',
            [
                'label'   => __( 'Afficher un titre au bloc', 'assystem' ),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __( 'Hide', 'elementor' ),
                'label_on' => __( 'Show', 'elementor' ),
                'default' => 'no',
            ]
        );
        $this->add_control(
            'title',
            [
                'label'   => __( 'Titre du bloc', 'assystem' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'condition' => [
                    'display_title' => 'yes',
                ],
            ]
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
        $tweets     = $this->get_tweets();
        $title      = (!empty($settings['title']))?$settings['title']:'';
        $hn         = (!empty($settings['hn']))?$settings['hn']:'';
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

    public function get_tweets() {
        $tweets = array();
        // TODO : dynamize
        $tw_api_options =   'a:8:{s:3:"url";s:55:"https://api.twitter.com/1.1/statuses/user_timeline.json";s:18:"oauth_access_token";s:50:"274575335-zGJlsteOzxfdNvmc8Zfv22BKyCNWoT2Ka2gT2Vb7";s:25:"oauth_access_token_secret";s:45:"6yMvFLQpaNFSYsYaUpe6X2G5p1JqoAA8PMLAFHzi3DWqz";s:12:"consumer_key";s:25:"avz1ibpaKTpeX8hSewYPudgq6";s:15:"consumer_secret";s:50:"poOKzfGtY1FRbA61SHyCmEm7B6j2HLaOyWEYkQjgcn4leZQYP2";s:4:"user";s:8:"Assystem";s:5:"count";s:1:"7";s:10:"count_more";s:1:"3";}';
        /*$settings = get_option('tw_api_options', array(
            'url' => '',
            'oauth_access_token' => '',
            'oauth_access_token_secret' => '',
            'consumer_key' => '',
            'consumer_secret' => '',
            'user' => '',
            'count' => 1
        ));*/
        $settings   =   unserialize($tw_api_options);
        $url = $settings['url'];
        $requestMethod = "GET";
        $user = $settings['user'];
        $count = $settings['count'];

        $getfield = "?screen_name=$user&count=$count&exclude_replies=true";
        $twitter = new \TwitterAPIExchange($settings);
        $string = json_decode($twitter->setGetfield($getfield)
            ->buildOauth($url, $requestMethod)
            ->performRequest(), $assoc = TRUE);
        if (!empty($string["errors"][0]["message"])) {
            echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>" . $string['errors'][0]["message"] . "</em></p>";
            exit();
        }

        foreach ($string as $items) {
            $dt = $items['created_at'];
            $date = strtotime(date("Y-m-d H:i:s", strtotime($dt)));
            $cur_date = strtotime(date('Y-m-d H:i:s'));
            if ($date > $cur_date - 86400){
                $date = $this->timeago($items['created_at']);
            }else{
                $date = date_i18n(__('\l\e j F', 'assystem-corpo'), $date);
            }
            $str = preg_replace("/@(\w+)/i", "<a href=\"http://twitter.com/$1\">$0</a>", $items['text']);
            $str = preg_replace("/#(\w+)/i", "<a href=\"http://twitter.com/hashtag/$1\">$0</a>", $str);
            $str = make_clickable($str);
            $tweets[] = array(
                'id' => $items['id'],
                'likes' => $items['favorite_count'],
                'date' => $date,
                'screen_name' => $items['user']['screen_name'],
                'text' => $str
            );

        }

        return $tweets;
    }

    public function timeago($date) {
        $timestamp = strtotime($date);

        $strTime = array(
            "fr" => array("seconde", "minute", "heure", "jour", "mois", "année"),
            "en" => array("second", "minute", "hour", "day", "month", "year")
        );
        $length = array("60", "60", "24", "30", "12", "10");

        $currentTime = time();
        $curr_lang = (function_exists('pll_current_language')) ? pll_current_language('slug') : 'fr';
        if ($currentTime >= $timestamp) {
            $diff = time() - $timestamp;
            for ($i = 0; $diff >= $length[$i] && $i < count($length) - 1; $i++) {
                $diff = $diff / $length[$i];
            }

            $diff = round($diff);
            $strDom = $strTime[$curr_lang][$i];
            if ($diff > 1) {
                $strDom = $strTime[$curr_lang][$i] . 's';
            }
            if ($curr_lang == 'en'){
                return  $diff . " " . $strDom . ' ' .__('il y a ', 'assystem-corpo');
            }
            return __('il y a ', 'assystem-corpo') . $diff . " " . $strDom;
        }
    }

}
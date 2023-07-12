<?php
    use Pluggable\Plugin\License;
    use Pluggable\Marketing\Deactivator;

    class Awesome_FloatingForm_Pro_Admin {
        // create static instance

        private static $instance = false;

        public static function get_instance() {
            if ( !self::$instance )
                self::$instance = new self;
            return self::$instance;
        }

        // constructor
        public function __construct() {
            $default_settings = (object) array(
                'adminemail' => (object) array(
                    'name' => 'WordPress Admin Email',
                    'value' => 'wordpress_admin'
                ),
                'contactposition' => (object) array(
                    'name' => 'Bottom Left',
                    'value' => 'sm:left-10 md:left-14 sm:bottom-10 md:bottom-10'
                ),
                'contactanimation' => (object) array(
                    'name' => 'Swing',
                    'value' => 'animate__swing'
                ),
                'contacttext' => 'Contact Us',
                'submittext'  => 'Submit',
                'footertext' => 'Powered By Awesome Floating Form',
                'namelabel' => 'Your Name',
                'emaillabel' => 'Your Email',
                'phonelabel' => 'Your Phone',
                'messegelabel' => 'Message',
            );

            add_option( 'awesome_floatingform_pro_settings', $default_settings, '', 'yes' );
            add_action('admin_menu', array( $this,'awesome_floatingform_admin_menu'));
            add_action('admin_enqueue_scripts', array( $this,'awesome_floatingform_admin_scripts'));
            add_filter( 'script_loader_tag', array( $this,'add_module_attribute'), 10,3 );
            add_action( 'rest_api_init', array( $this, 'awesome_floatingform_settings' ));
            // add_action( 'plugins_loaded', array( $this, 'affpro_license_init' ));
            // add_action( 'init', array( $this, 'affpro_marketing_init' ));
        }

        public function affpro_license_init() {
            global $affpro_license;
            $affpro_license = new License( __FILE__ );
        }

        public function affpro_marketing_init() {
            new Deactivator( __FILE__ );
        }


        public function awesome_floatingform_admin_scripts() {
            $current_screen = get_current_screen();
            $screen = 'toplevel_page_awesome_floatingform_pro_options';            
            $settings = get_option('awesome_floatingform_pro_settings');

            if ($screen == $current_screen->base) {
                wp_enqueue_style( 'front', plugin_dir_url( __FILE__ ) . '../assets/front.css' );
                wp_enqueue_style( 'vuesax', plugin_dir_url( __FILE__ ) . '../assets/index.css' );
                wp_enqueue_script( 'admin', plugin_dir_url( __FILE__ ) . '../assets/admin.js', array(), '2.0', true );
                wp_localize_script( 'admin', 'affpro_settings', array(
                    'root' => esc_url_raw( rest_url() ),
                    'nonce' => wp_create_nonce('wp_rest'),
                    'settings' => $settings,
                    'logopath' => plugins_url( 'aff_logo.png', __FILE__ ),
                ) );
            }
        
    }


    public function add_module_attribute($tag, $handle, $src) {
        // if not your script, do nothing and return original $tag
        if ( 'admin' !== $handle ) {
            return $tag;
        }
        // change the script tag by adding type="module" and return it.
        $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
        return $tag;
    }

        public function awesome_floatingform_admin_menu() {
            $page_title = 'Awesome Floating Form';
            $menu_title = 'Awesome Floating Form';
            $capability = 'manage_options';
            $slug = 'awesome_floatingform_pro_options';
            $icon_url =  plugins_url( 'icon.svg', __FILE__ );
            
            add_menu_page(__( $page_title, AWESOME_FLOATINGFORM_PRO_TEXTDOMAIN ),$menu_title,$capability,$slug,array( $this,'awesome_floatingform_settings_contents'),$icon_url, 99);

            add_submenu_page(
                $slug,
                __( 'General', AWESOME_FLOATINGFORM_PRO_TEXTDOMAIN),
                __( 'General', AWESOME_FLOATINGFORM_PRO_TEXTDOMAIN),
                'manage_options',
                'awesome_floatingform_pro_options#/general',
                array( $this,'awesome_floatingform_settings_contents'),
            );

            add_submenu_page(
                $slug,
                __( 'Form Fields', AWESOME_FLOATINGFORM_PRO_TEXTDOMAIN),
                __( 'Form Fields', AWESOME_FLOATINGFORM_PRO_TEXTDOMAIN),
                'manage_options',
                'awesome_floatingform_pro_options#/form-fields',
                array( $this,'awesome_floatingform_settings_contents'),
            );

            add_submenu_page(
                $slug,
                __( 'Contact Button', AWESOME_FLOATINGFORM_PRO_TEXTDOMAIN),
                __( 'Contact Button', AWESOME_FLOATINGFORM_PRO_TEXTDOMAIN),
                'manage_options',
                'awesome_floatingform_pro_options#/contact-button',
                array( $this,'awesome_floatingform_settings_contents'),
            );

            add_submenu_page(
                $slug,
                __( 'Submit Button', AWESOME_FLOATINGFORM_PRO_TEXTDOMAIN),
                __( 'Submit Button', AWESOME_FLOATINGFORM_PRO_TEXTDOMAIN),
                'manage_options',
                'awesome_floatingform_pro_options#/submit-button',
                array( $this,'awesome_floatingform_settings_contents'),
            );

            // add_submenu_page(
            //     $slug,
            //     __( 'Success Notice', AWESOME_FLOATINGFORM_PRO_TEXTDOMAIN),
            //     __( 'Success Notice', AWESOME_FLOATINGFORM_PRO_TEXTDOMAIN),
            //     'manage_options',
            //     'awesome_floatingform_pro_options#/success-notice',
            //     array( $this,'awesome_floatingform_settings_contents'),
            // );

            // add_submenu_page(
            //     $slug,
            //     __( 'Waiting Notice', AWESOME_FLOATINGFORM_PRO_TEXTDOMAIN),
            //     __( 'Waiting Notice', AWESOME_FLOATINGFORM_PRO_TEXTDOMAIN),
            //     'manage_options',
            //     'awesome_floatingform_pro_options#/waiting-notice',
            //     array( $this,'awesome_floatingform_settings_contents'),
            // );

            // add_submenu_page(
            //     $slug,
            //     __( 'Error Notice', AWESOME_FLOATINGFORM_PRO_TEXTDOMAIN),
            //     __( 'Error Notice', AWESOME_FLOATINGFORM_PRO_TEXTDOMAIN),
            //     'manage_options',
            //     'awesome_floatingform_pro_options#/error-notice',
            //     array( $this,'awesome_floatingform_settings_contents'),
            // );

            remove_submenu_page('awesome_floatingform_pro_options','awesome_floatingform_pro_options'); 

        }
    
        public function awesome_floatingform_settings_contents() {
            ?>
            <div id="affpro-admin"></div>
            <?php
        }

        public function awesome_floatingform_settings() {
            register_rest_route( 'awesome-floatingform-pro/v1', '/settings/save', array(
                'methods' => 'POST',
                'callback' => array( $this, 'awesome_floatingform_set_settings_callback' ),
            ));
        }

        public function awesome_floatingform_set_settings_callback(WP_REST_Request $request){
            $settings = get_option( 'awesome_floatingform_pro_settings' );
            $value = json_decode($request->get_body());
            $newSettings = (object) array_merge((array) $settings, (array) $value);
            update_option( 'awesome_floatingform_pro_settings', $newSettings );
            return $value;
        }

    }

    // initiate instance
    Awesome_FloatingForm_Pro_Admin::get_instance();
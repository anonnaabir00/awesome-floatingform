<?php

    class WP_FloatingForm_Admin {
        // create static instance

        private static $instance = false;

        public static function get_instance() {
            if ( !self::$instance )
                self::$instance = new self;
            return self::$instance;
        }

        // constructor
        public function __construct() {
            add_action('admin_menu', array( $this,'wp_floatingform_admin_menu'));
            add_action('admin_enqueue_scripts', array( $this,'wp_floatingform_admin_scripts'));
            add_filter( 'script_loader_tag', array( $this,'add_module_attribute'), 10,3 );
            add_action( 'rest_api_init', array( $this, 'wp_floatingform_settings' ));
        }


        public function wp_floatingform_admin_scripts() {
            $current_screen = get_current_screen();
            $screen = 'toplevel_page_wp_floatingform_options';
            $settings = get_option( 'wp_floatingform_settings' );

            if ($screen == $current_screen->base) {
                wp_enqueue_style( 'front', plugin_dir_url( __FILE__ ) . '../assets/front.css' );
                wp_enqueue_style( 'vuesax', plugin_dir_url( __FILE__ ) . '../assets/plugin-vue2_normalizer.css' );
                wp_enqueue_script( 'admin', plugin_dir_url( __FILE__ ) . '../assets/admin.js', array(), '1.0', true );
                wp_localize_script( 'admin', 'wff_settings', array(
                    'root' => esc_url_raw( rest_url() ),
                    'nonce' => wp_create_nonce('wp_rest'),
                    'contact_button_text' => $settings->contacttext ?? 'Contact Us',
                    'submit_button_text' => $settings->submittext   ?? 'Submit',
                    'contact_button_color' => $settings->contactcolor ?? '#000',
                    'submit_button_color' => $settings->submitcolor ?? '#000',
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

        public function wp_floatingform_admin_menu() {
            $page_title = 'WP Floating Form';
            $menu_title = 'WP Floating Form';
            $capability = 'manage_options';
            $slug = 'wp_floatingform_options';
            $icon_url =  get_template_directory_uri() . '/lib/icon.svg';
            
            add_menu_page(__( $page_title, WP_FLOATINGFORM_TEXTDOMAIN ),$menu_title,$capability,$slug,array( $this,'wp_floatingform_settings_contents'),$icon_url, 99);

        }
    
        public function wp_floatingform_settings_contents() {
            ?>
            <div id="wff-admin"></div>
            <?php
        }

        public function wp_floatingform_settings() {
            register_rest_route( 'wp-floatingform/v1', '/settings/save', array(
                'methods' => 'POST',
                'callback' => array( $this, 'wp_floatingform_set_settings_callback' ),
            ));
        }

        public function wp_floatingform_set_settings_callback(WP_REST_Request $request){
            $value = json_decode($request->get_body());
            update_option( 'wp_floatingform_settings', $value );
            return $value;
        }

    }

    // initiate instance
    WP_FloatingForm_Admin::get_instance();
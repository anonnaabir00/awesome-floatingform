<?php

    class Awesome_FloatingForm {
        // create static instance

        private static $instance = false;

        public static function get_instance() {
            if ( !self::$instance )
                self::$instance = new self;
            return self::$instance;
        }

        // constructor
        public function __construct() {
            require_once dirname( __FILE__ ) . '/admin.php';

            add_option( 'awesome_floatingform_settings', '', '', 'yes' );
            add_action( 'wp_enqueue_scripts', array($this,'awesome_floatingform_assets'), 10, 1);
            add_action( 'rest_api_init', array( $this, 'awesome_floatingform_email' ));
            add_filter( 'script_loader_tag', array( $this,'add_module_attribute'), 10,3 );
        }
        
        public function awesome_floatingform_assets() {
            $settings = get_option( 'awesome_floatingform_settings' );

            wp_enqueue_style( 'front', plugin_dir_url( __FILE__ ) . '../assets/front.css', array(), '1.0', 'all' );
            wp_enqueue_style( 'main', plugin_dir_url( __FILE__ ) . '../assets/main.css', array(), '1.0', 'all' );
            wp_enqueue_style( 'vuesax', plugin_dir_url( __FILE__ ) . '../assets/plugin-vue2_normalizer.css', array(), '1.0', 'all' );
            wp_enqueue_script( 'wffmain', plugin_dir_url( __FILE__ ) . '../assets/wffmain.js', array(), '2.0', true );
            wp_localize_script( 'wffmain', 'wff_settings', array(
                'root' => esc_url_raw( rest_url() ),
                'nonce' => wp_create_nonce('wp_rest'),
                'contact_button_text' => $settings->contacttext ?? 'Contact Us',
                'submit_button_text' => $settings->submittext   ?? 'Submit',
                'contact_button_color' => $settings->contactcolor ?? '#000',
                'submit_button_color' => $settings->submitcolor ?? '#000',
            ) );
        }

        public function add_module_attribute($tag, $handle, $src) {
            // if not your script, do nothing and return original $tag
            if ( 'wffmain' !== $handle ) {
                return $tag;
            }
            // change the script tag by adding type="module" and return it.
            $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
            return $tag;
        }

        public function awesome_floatingform_email() {
            register_rest_route( 'awesome-floatingform/v1', '/email', array(
                'methods' => 'POST',
                'callback' => array( $this, 'awesome_floatingform_email_callback' ),
            ));
        }

        public function awesome_floatingform_email_callback(WP_REST_Request $request){
            $value = json_decode($request->get_body());
            // wordpress mail function
            $to = get_option( 'admin_email' );
            $subject = $value->subject;
            $message = '  Email: ' . $value->email . '  Message: ' . $value->message;
            $headers = array('Content-Type: text/html; charset=UTF-8');
            wp_mail( $to, $subject, $message, $headers );

            return $value;
        }



    }

    // initiate instance
    Awesome_FloatingForm::get_instance();
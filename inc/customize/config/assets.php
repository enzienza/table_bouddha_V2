<?php
/**
 * Name file: assets
 * Description: this is allows you to add the style and the différent scripts that we need for this theme
 *
 * @package WordPress
 * @subpackage TableBouddha
 * @since 2.1
 */

/* ---------------------------------------------------------
>>>  TABLE OF CONTENTS:
------------------------------------------------------------

# STYLE *********************************
1 - BOOTSTRAP [CDN]
2 - STYLE

# SCRIPT ********************************
1 - BOOTSTRAP [CDN]
2 - POPPER [CDN]
3 - JQUERY [CDN]

----------------------------------------------------------*/

if(!function_exists('tablebouddha_register_assets')){
    function tablebouddha_register_assets(){

        // ===================================================================
        // CSS
        // ===================================================================

        /**
         * BOOTSTRAP - CSS
         *
         * @category CDN
         * @version 4.4.1
         */
        wp_register_style(
            'bootstrap',
            'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css',
            [], '4.4.1'
        );
        wp_enqueue_style('bootstrap');

        // STYLE CUSTOM  .....................................................
        /**
         * STYLE
         *
         * @description Custom Theme Style
         * @version 2.1.0
         */
        wp_enqueue_style(
            'style',
            get_template_directory_uri().'/style.css',
            [], '2.1.0'
        );

        // ===================================================================
        // JAVASCRIP
        // ===================================================================
        /**
         * BOOTSTRAP - JS
         *
         * @category CDN
         * @dependence ['popper', 'jquery']
         * @version 4.4.1
         */
        wp_register_script(
            'bootstrap',
            'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js',
            ['popper', 'jquery'],
            '4.4.1',
            true
        );

        /**
         * POPPER
         *
         * @category CDN
         * @dependence ['popper', 'jquery']
         * @version 1.16.0
         */
        wp_register_script(
            'popper',
            'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js',
            [],
            '1.16.0',
            true
        );
        wp_enqueue_script('bootstrap');

        // SCRIPT CUSTOM  ....................................................
        /**
         * SOLID-NAVBAR
         *
         * @description Navigation transparent au top, mais solid au scroll
         * @version 1.0
         */
        wp_enqueue_script(
            'solid-navbar',
            get_template_directory_uri().'/assets/js/solid-navbar.js',
            [],
            '1.0',
            true
        );

        /**
         * SCROLLTOP
         *
         * @description Permet de remonté la page
         * @version 1.0
         */
        wp_enqueue_script(
            'scroll-top',
            get_template_directory_uri().'/assets/js/scroll-top.js',
            [],
            '1.0',
            true
        );

        /**
         * highlight-today
         *
         * @description Permet de remonté la page
         * @version 1.0
         */
       wp_enqueue_script(
           'highlight-today',
           get_template_directory_uri().'/assets/js/highlight-today.js',
           [],
           '1.0',
           true
       );

        /**
         * JQUERY
         *
         * @category CDN
         * @version 3.5.1
         */
        wp_deregister_script('jquery');
        wp_register_script(
            'jquery',
            'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js',
            [],
            '3.5.1',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'tablebouddha_register_assets');

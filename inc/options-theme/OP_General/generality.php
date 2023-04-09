<?php
/**
 * Name file: generality
 * Description: File about gestion on restaurant generality
 *
 * @package WordPress
 * @subpackage TableBouddha
 * @since 2.1
 */

/* ---------------------------------------------------------
>>>  TABLE OF CONTENTS:
------------------------------------------------------------
  1 - DEFINIR LES ELEMENTS (repeter)
  2 - DEFINIR LES HOOKS ACTIONS
  3 - CONSTRUCTION DE LA PAGE
  4 - TEMPLATE DES PAGES
  5 - ENREGISTRER LES PARAMETTRES D'OPTIONS
  6 - DEFINIR LES SECTIONS DE LA PAGE
  7 - DEFINIR LE TELECHARGEMENT DES FICHIER
  8 - DEFINIR LES CHAMPS POUR RECUPERER LES INFOS
  9 - AJOUT STYLE & SCRIPT
----------------------------------------------------------*/


class tablebouddha_generality{
    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     * afin d'evite les fautes de frappe
     */
    // page info - level 1
    const PERMITION  = 'manage_options';
    const DASHICON   = 'dashicons-admin-generic';
    const GROUP      = 'generality_tablebouddha';
    const NONCE      = '_generality_tablebouddha';


    // definit les section
    const SECTION_IMG    = 'section_image_tablebouddha';
    const SECTION_INFO   = 'section_info_tablebouddha';
    const SECTION_URL    = 'section_url_tablebouddha';

    /**
     * 2 - DEFINIR LES HOOKS ACTIONS
     */
    public static function register(){
        add_action('admin_menu', [self::class, 'addMenu']);
        add_action('admin_init', [self::class, 'registerSettings']);
    }

    /**
     * 3 - CONSTRUCTION DE LA PAGE
     */
    public static function addMenu(){
        add_menu_page(
            __('Généralité', 'TableBouddha'),                   // TITLE_PAGE
            __('Table Bouddha', 'TableBouddha'),                    // TITLE_MENU
            self::PERMITION,                    // CAPABILITY
            self::GROUP,                        // SLUG_PAGE
            [self::class, 'render'],            // CALLBACK
            self::DASHICON,                     // icon
            2                                   // POSITION
        );
    }

    /**
     * 4 - TEMPLATE DES PAGES
     */
    public static function render(){

        ?>
        <div class="wrap">
            <h1 class="wp-heagin-inline"><?php _e('Table Bouddha', 'TableBouddha'); ?></h1>
            <p class="description">
                <?php _e('Sur cette page vous pouvez gérer les informations générales du thème', 'TableBouddha'); ?>
            </p>
            <?php settings_errors(); ?>
        </div>

        <div class="action">
            <input id="reset_form_general" type="reset" value="<?php _e('Effacer le formulaire', 'TableBouddha'); ?>" class="btn-clear" />
            <small><?php _e('Attention action définitive (suppression de la base de données)', 'TableBouddha'); ?></small>
            <script>
              jQuery( function( $ ) {
                $( '#reset_form_general' ).on( 'click', function( e ) {
                  e.preventDefault();
                  $( 'input[type="text"]' ).val( '' ); // Clear input values
                  $( 'input[type="radio"],input[type="checkbox"]' ).prop( 'checked', false ); // Uncheck radio, checkbox
                } );
              } );
            </script>
        </div>

        <form class="myoptions" action="options.php" method="post" enctype="multipart/form-data">
            <?php
            wp_nonce_field(self::NONCE, self::NONCE);
            settings_fields(self::GROUP);
            do_settings_sections(self::GROUP);
            ?>
            <?php submit_button(); ?>
        </form>
        <?php
    }


    /**
     * 5 - ENREGISTRER LES PARAMETTRES D'OPTIONS
     */
    public static function registerSettings(){
        /**
         * SECTION 1 : SECTION_IMG =====================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::SECTION_IMG,                       // SLUG_SECTION
            __('Les médias', 'TableBouddha'),          // TITLE
            [self::class, 'display_section_image'],  // CALLBACK
            self::GROUP
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'logo_tablebouddha',                        // SLUG_FIELD
            __('Image du logo', 'TableBouddha'),                            // LABEL
            [self::class,'field_logo_tablebouddha'],    // CALLBACK
            self::GROUP ,                               // SLUG_PAGE
            self::SECTION_IMG
        );

        // 3. Sauvegarder les champs
        register_setting(self::GROUP,'img_logo', [self::class, 'handle_file_logo']);
        /**
         * SECTION 2 : SECTION_INFO =====================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::SECTION_INFO,                       // SLUG_SECTION
            __('Les informations de contact', 'TableBouddha'), // TITLE
            [self::class, 'display_section_info'],    // CALLBACK
            self::GROUP
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'location_tablebouddha',                       // SLUG_FIELD
            __('Adresse complète', 'TableBouddha'),          // LABEL
            [self::class,'field_location_tablebouddha'],   // CALLBACK
            self::GROUP ,                                  // SLUG_PAGE
            self::SECTION_INFO
        );

        add_settings_field(
            'phone_tablebouddha',                         // SLUG_FIELD
            __('Tépéhone', 'TableBouddha'),                  // LABEL
            [self::class,'field_phone_tablebouddha'],     // CALLBACK
            self::GROUP ,                                 // SLUG_PAGE
            self::SECTION_INFO
        );

        // 3. Sauvegarder les champs
        register_setting(self::GROUP, 'adresse');
        register_setting(self::GROUP, 'phone');


        /**
         * SECTION 3 : SECTION_URL =====================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::SECTION_URL,                       // SLUG_SECTION
            __('Les réseaux sociaux', 'TableBouddha'),  // TITLE
            [self::class, 'display_section_url'],    // CALLBACK
            self::GROUP
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'facebook_tablebouddha',                         // SLUG_FIELD
            __('Facebook (url)', 'TableBouddha'),        // LABEL
            [self::class,'field_facebook_tablebouddha'],     // CALLBACK
            self::GROUP ,                                    // SLUG_PAGE
            self::SECTION_URL
        );

        add_settings_field(
            'instagram_tablebouddha',                         // SLUG_FIELD
            __('Instagram (url)', 'TableBouddha'),             // LABEL
            [self::class,'field_instagram_tablebouddha'],     // CALLBACK
            self::GROUP ,                                     // SLUG_PAGE
            self::SECTION_URL
        );

        add_settings_field(
            'twitter',                         // SLUG_FIELD
            __('Twitter (url)', 'TableBouddha'),        // LABEL
            [self::class,'field_twitter_tablebouddha'],     // CALLBACK
            self::GROUP ,                            // SLUG_PAGE
            self::SECTION_URL
        );

        // 3. Sauvegarder les champs
        /* FACEBOOK */
        register_setting(self::GROUP, 'yes_facebook');
        register_setting(self::GROUP, 'url_facebook');
        /* INSTAGRAM */
        register_setting(self::GROUP, 'yes_instagram');
        register_setting(self::GROUP, 'url_instagram');
        /* TWITTER */
        register_setting(self::GROUP, 'yes_twitter');
        register_setting(self::GROUP, 'url_twitter');
    }

    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */
    // SECTION 1 : SECTION_IMG ======================================
    public static function display_section_image(){
        ?>
        <p class="description">
            <?php _e('Section dédiée aux médias', 'TableBouddha'); ?>
        </p>
        <?php
    }
    // SECTION 2 : SECTION_INFO =====================================
    public static function display_section_info(){
        ?>
        <p class="description">
            <?php _e('Section dédiée aux inforamations de contact', 'TableBouddha'); ?>
        </p>
        <?php
    }
    // SECTION 3 : SECTION_URL ======================================
    public static function display_section_url(){
        ?>
        <p class="description">
            <?php _e('Section dédiée aux réseaux sociaux', 'TableBouddha'); ?>
        </p>
        <?php
    }

    /**
     * 7 - DEFINIR LE TELECHARGEMENT DES FICHIER
     *     le fichier sera stocké dans le dossier upload
     */
    // SECTION 1 : SECTION_IMG ======================================
    public static function handle_file_logo(){
        if(!empty($_FILES['img_logo']['tmp_name'])){
            $urls = wp_handle_upload($_FILES['img_logo'], array('test_form' => FALSE));
            $temp = $urls['url'];
            return $temp;
        } // end -> if(!empty($_FILES['img_logo']['tmp_name']))

        //no upload. old file url is the new value.
        return get_option('img_logo');
    }


    /**
     * 8 - DEFINIR LES CHAMPS POUR RECUPERER LES INFOS
     */
    // SECTION 1 : SECTION_IMG ======================================
    public static function field_logo_tablebouddha(){
        ?>
        <img src="<?php echo get_option('img_logo'); ?>" class="img-logo" alt="" />
        <input type="file" id="img_logo" name="img_logo" value="<?php echo get_option('img_logo'); ?>">
        <?php
    }

    // SECTION 2 : SECTION_INFO =====================================
    public static function field_location_tablebouddha(){
        $adresse = esc_attr(get_option('adresse'));
        ?>
        <input type="text" id="adresse" name="adresse" value="<?php echo $adresse ?>" class="regular-text" placeholder="<?php _e('rue des Mimosas 3, 4020 Liège', 'TableBouddha') ?>"/>
        <?php
    }
    public static function field_phone_tablebouddha(){
        $phone = esc_attr(get_option('phone'));
        ?>
        <input type="text" id="phone" name="phone" value="<?php echo $phone ?>" class="regular-text" placeholder="<?php _e('000000000', 'TableBouddha') ?>"/>
        <?php
    }

    // SECTION 3 : SECTION_URL ======================================
    public static function field_facebook_tablebouddha(){
        $yes_facebook = esc_attr(get_option('yes_facebook'));
        $url_facebook = esc_attr(get_option('url_facebook'));
        ?>
        <input type="hidden" name="yes_facebook" value="0" />
        <input type="checkbox"
               id="yes_facebook"
               name="yes_facebook"
               value="1"
            <?php checked(1, $yes_facebook, true); ?>
        >
        <input type="text"
               id="url_facebook"
               name="url_facebook"
               value="<?php echo $url_facebook ?>"
               class="regular-text"
               placeholder="https://www.facebook.com/"
        />
        <?php
    }

    public static function field_instagram_tablebouddha(){
        $yes_instagram = esc_attr(get_option('yes_instagram'));
        $url_instagram = esc_attr(get_option('url_instagram'));
        ?>
        <input type="hidden" name="yes_instagram" value="0" />
        <input type="checkbox"
               id="yes_instagram"
               name="yes_instagram"
               value="1"
            <?php checked(1, $yes_instagram, true); ?>
        />
        <input type="text"
               id="url_instagram"
               name="url_instagram"
               value="<?php echo $url_instagram ?>"
               class="regular-text"
               placeholder="https://www.instagram.com/"
        />
        <?php
    }

    public static function field_twitter_tablebouddha(){
        $yes_twitter = esc_attr(get_option('yes_twitter'));
        $url_twitter = esc_attr(get_option('url_twitter'));
        ?>
        <input type="hidden" name="yes_twitter" value="0" />
        <input type="checkbox"
               id="yes_twitter"
               name="yes_twitter"
               value="1"
            <?php checked(1, $yes_twitter, true); ?>
        />
        <input type="text"
               id="url_twitter"
               name="url_twitter"
               value="<?php echo $url_twitter ?>"
               class="regular-text"
               placeholder="https://www.twitter.com/"
        />
        <?php
    }

}

if(class_exists('tablebouddha_generality')){
    tablebouddha_generality::register();
}
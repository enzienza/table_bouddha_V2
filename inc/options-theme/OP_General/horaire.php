<?php
/**
 * Name File : horaire
 * Description : File about gestion of restaurant opening hours
 * Parents : Submenu of generatity
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


class tablebouddha_timetable{
    /**
     * 1 - DEFINIR LES ELEMENTS (repeter)
     * afin d'evite les fautes de frappe
     */
    // page info - level 2
    const PERMITION  = 'manage_options';
    const SUB_GROUP  = 'timetable_tablebouddha';
    const NONCE      = '_timetable_tablebouddha';


    // definit les section
    const SECTION_TIMETABLE = 'section_horaire_tablebouddha';

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
        add_submenu_page(
            tablebouddha_generality::GROUP,     // slug parent
            __('Horaire', 'TableBouddha'),                    // page_title
            __('Horaire', 'TableBouddha'),                     // menu_title
            self::PERMITION,                    // capability
            self::SUB_GROUP,                    // slug_menu
            [self::class, 'render']             // CALLBACK
        );
    }

    /**
     * 4 - TEMPLATE DES PAGES
     */
    public static function render(){
        ?>
        <div class="wrap">
            <h1 class="wp-heagin-inline"><?php _e('Horaires', 'TableBouddha'); ?></h1>
            <p class="description">
                <?php _e("Sur cette page vous pouvez gérer les heures d'ouverture du restaurant", 'TableBouddha') ;?>
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
                  $( 'input[type="time"]' ).val( '' ); // Clear input values
                  $( 'input[type="radio"],input[type="checkbox"]' ).prop( 'checked', false ); // Uncheck radio, checkbox
                } );
              } );
            </script>
        </div>

        <form class="form-timetable" action="options.php" method="post" enctype="multipart/form-data">
            <?php
            wp_nonce_field(self::NONCE, self::NONCE);
            settings_fields(self::SUB_GROUP);
            do_settings_sections(self::SUB_GROUP);
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
         * SECTION 1 : SECTION_ACTION =====================================
         *              1. Créer la section
         *              2. Ajouter les éléments du formulaire
         *              3. Sauvegarder les champs
         *
         */
        // 1. Créer la section
        add_settings_section(
            self::SECTION_TIMETABLE,                     // SLUG_SECTION
            __('Les heures d\'ouverture', 'TableBouddha'),                              // TITLE
            [self::class, 'display_section_timetable'],  // CALLBACK
            self::SUB_GROUP
        );

        // 2. Ajouter les éléments du formulaire
        add_settings_field(
            'heure_lundi',                                    // SLUG_FIELD
            __('Lundi', 'TableBouddha'),                                          // LABEL
            [self::class,'field_heure_lundi_tablebouddha'],   // CALLBACK
            self::SUB_GROUP ,                                 // SLUG_PAGE
            self::SECTION_TIMETABLE
        );
        add_settings_field(
            'heure_mardi',                                    // SLUG_FIELD
            __('Mardi', 'TableBouddha'),                                          // LABEL
            [self::class,'field_heure_mardi_tablebouddha'],   // CALLBACK
            self::SUB_GROUP ,                                 // SLUG_PAGE
            self::SECTION_TIMETABLE
        );

        add_settings_field(
            'heure_mercredi',                                  // SLUG_FIELD
            __('Mercredi', 'TableBouddha'),                                        // LABEL
            [self::class,'field_heure_mercredi_tablebouddha'], // CALLBACK
            self::SUB_GROUP ,                                  // SLUG_PAGE
            self::SECTION_TIMETABLE
        );

        add_settings_field(
            'heure_jeudi',                                    // SLUG_FIELD
            __('Jeudi', 'TableBouddha'),                                          // LABEL
            [self::class,'field_heure_jeudi_tablebouddha'],   // CALLBACK
            self::SUB_GROUP ,                                 // SLUG_PAGE
            self::SECTION_TIMETABLE
        );

        add_settings_field(
            'heure_vendredi',                                    // SLUG_FIELD
            __('Vendredi', 'TableBouddha'),                                          // LABEL
            [self::class,'field_heure_vendredi_tablebouddha'],   // CALLBACK
            self::SUB_GROUP ,                                   // SLUG_PAGE
            self::SECTION_TIMETABLE
        );

        add_settings_field(
            'heure_samedi',                                    // SLUG_FIELD
            __('Samedi', 'TableBouddha'),                                          // LABEL
            [self::class,'field_heure_samedi_tablebouddha'],   // CALLBACK
            self::SUB_GROUP ,                                  // SLUG_PAGE
            self::SECTION_TIMETABLE
        );

        add_settings_field(
            'heure_dimanche',                                  // SLUG_FIELD
            __('Dimanche', 'TableBouddha'),                                        // LABEL
            [self::class,'field_heure_dimanche_tablebouddha'], // CALLBACK
            self::SUB_GROUP ,                                  // SLUG_PAGE
            self::SECTION_TIMETABLE
        );

        // 3. Sauvegarder les champs
        /* LUNDI */
        register_setting(self::SUB_GROUP, 'lundi_midi_open');
        register_setting(self::SUB_GROUP, 'lundi_mide_de');
        register_setting(self::SUB_GROUP, 'lundi_mide_a');
        register_setting(self::SUB_GROUP, 'lundi_soir_open');
        register_setting(self::SUB_GROUP, 'lundi_soir_de');
        register_setting(self::SUB_GROUP, 'lundi_soir_a');
        register_setting(self::SUB_GROUP, 'lundi_fermer');
        /* MARDI */
        register_setting(self::SUB_GROUP, 'mardi_mide_open');
        register_setting(self::SUB_GROUP, 'mardi_mide_de');
        register_setting(self::SUB_GROUP, 'mardi_mide_a');
        register_setting(self::SUB_GROUP, 'mardi_soir_de');
        register_setting(self::SUB_GROUP, 'mardi_soir_open');
        register_setting(self::SUB_GROUP, 'mardi_soir_a');
        register_setting(self::SUB_GROUP, 'mardi_fermer');
        /* MERCREDI */
        register_setting(self::SUB_GROUP, 'mercredi_mide_open');
        register_setting(self::SUB_GROUP, 'mercredi_mide_de');
        register_setting(self::SUB_GROUP, 'mercredi_mide_a');
        register_setting(self::SUB_GROUP, 'mercredi_soir_open');
        register_setting(self::SUB_GROUP, 'mercredi_soir_de');
        register_setting(self::SUB_GROUP, 'mercredi_soir_a');
        register_setting(self::SUB_GROUP, 'mercredi_fermer');
        /* JEUDI */
        register_setting(self::SUB_GROUP, 'jeudi_mide_open');
        register_setting(self::SUB_GROUP, 'jeudi_mide_de');
        register_setting(self::SUB_GROUP, 'jeudi_mide_a');
        register_setting(self::SUB_GROUP, 'jeudi_soir_open');
        register_setting(self::SUB_GROUP, 'jeudi_soir_de');
        register_setting(self::SUB_GROUP, 'jeudi_soir_a');
        register_setting(self::SUB_GROUP, 'jeudi_fermer');
        /* VENDREDI */
        register_setting(self::SUB_GROUP, 'vendredi_mide_open');
        register_setting(self::SUB_GROUP, 'vendredi_mide_de');
        register_setting(self::SUB_GROUP, 'vendredi_mide_a');
        register_setting(self::SUB_GROUP, 'vendredi_soir_open');
        register_setting(self::SUB_GROUP, 'vendredi_soir_de');
        register_setting(self::SUB_GROUP, 'vendredi_soir_a');
        register_setting(self::SUB_GROUP, 'vendredi_fermer');
        /* SAMEDI */
        register_setting(self::SUB_GROUP, 'samedi_mide_open');
        register_setting(self::SUB_GROUP, 'samedi_mide_de');
        register_setting(self::SUB_GROUP, 'samedi_mide_a');
        register_setting(self::SUB_GROUP, 'samedi_soir_open');
        register_setting(self::SUB_GROUP, 'samedi_soir_de');
        register_setting(self::SUB_GROUP, 'samedi_soir_a');
        register_setting(self::SUB_GROUP, 'samedi_fermer');
        /* DIMANCHE */
        register_setting(self::SUB_GROUP, 'dimanche_mide_open');
        register_setting(self::SUB_GROUP, 'dimanche_mide_a');
        register_setting(self::SUB_GROUP, 'dimanche_soir_open');
        register_setting(self::SUB_GROUP, 'dimanche_soir_a');
        register_setting(self::SUB_GROUP, 'dimanche_fermer');
    }

    /**
     * 6 - DEFINIR LES SECTIONS DE LA PAGE
     */
    public static function display_section_timetable(){
        ?>
        <p class="section-description">
            <?php _e("Section dédiée uniquement aux heures d'ouverture", 'TableBouddha'); ?>
        </p>
        <?php
    }


    /**
     * 7 - DEFINIR LES CHAMPS POUR RECUPERER LES INFOS
     */
    public static function field_heure_lundi_tablebouddha(){
        $lundi_mide_open = esc_attr(get_option('lundi_mide_open'));
        $lundi_mide_de = esc_attr(get_option('lundi_mide_de'));
        $lundi_mide_a  = esc_attr(get_option('lundi_mide_a'));
        $lundi_soir_open = esc_attr(get_option('lundi_soir_open'));
        $lundi_soir_de = esc_attr(get_option('lundi_soir_de'));
        $lundi_soir_a  = esc_attr(get_option('lundi_soir_a'));
        $lundi_fermer  = esc_attr(get_option('lundi_fermer'));

        ?>
        <div class="service lunch">
            <span class="service-ok">
                <input type="hidden" name="lundi_mide_open" value="0" />
                <input type="checkbox" name="lundi_mide_open" id="lundi_mide_open" value="1" <?php checked(1, $lundi_mide_open, true) ?> />
                <label for=""><?php _e('Service du midi', 'TableBouddha'); ?></label>
            </span>
            <span class="service-de">
                <label for=""><?php _e('de', 'TableBouddha'); ?></label>
                <input type="time" id="lundi_mide_de" name="lundi_mide_de" value="<?php echo $lundi_mide_de ?>"/>
            </span>
            <span class="service-a">
                <label for=""><?php _e('à', 'TableBouddha'); ?></label>
                <input type="time" id="lundi_mide_a" name="lundi_mide_a" value="<?php echo $lundi_mide_a ?>"/>
            </span>
        </div>
        <div class="service dinner">
            <span class="service-ok">
                <input type="hidden" name="lundi_soir_open" value="0" />
                <input type="checkbox" name="lundi_soir_open" id="lundi_soir_open" value="1" <?php checked(1, $lundi_soir_open, true) ?> />
                <label for=""><?php _e('Service du soir', 'TableBouddha'); ?></label>
            </span>
            <span class="service-de">
                <label for=""><?php _e('de', 'TableBouddha'); ?></label>
                <input type="time" id="lundi_soir_de" name="lundi_soir_de" value="<?php echo $lundi_soir_de ?>"/>
            </span>
            <span class="service-a">
                <label for=""><?php _e('à', 'TableBouddha'); ?></label>
                <input type="time" id="lundi_soir_a" name="lundi_soir_a" value="<?php echo $lundi_soir_a ?>"/>
            </span>
        </div>
        <div class="service-close">
            <input type="hidden" name="lundi_fermer" value="0" />
            <input type="checkbox" id="lundi_fermer" name="lundi_fermer" value="1"<?php checked(1, $lundi_fermer, true) ?>/>
            <label for=""><?php _e('Jour de fermeture','TableBouddha'); ?></label>
        </div>
        <?php
    }

    public static function field_heure_mardi_tablebouddha(){
        $mardi_mide_open = esc_attr(get_option('mardi_mide_open'));
        $mardi_mide_de = esc_attr(get_option('mardi_mide_de'));
        $mardi_mide_a  = esc_attr(get_option('mardi_mide_a'));
        $mardi_soir_open = esc_attr(get_option('mardi_soir_open'));
        $mardi_soir_de = esc_attr(get_option('mardi_soir_de'));
        $mardi_soir_a  = esc_attr(get_option('mardi_soir_a'));
        $mardi_fermer  = esc_attr(get_option('mardi_fermer'));
        ?>

        <div class="service lunch">
            <span class="service-ok">
                <input type="hidden" name="mardi_mide_open" value="0" />
                <input type="checkbox" name="mardi_mide_open" id="mardi_mide_open" value="1" <?php checked(1, $mardi_mide_open, true) ?> />
                <label for=""><?php _e('Service du midi', 'TableBouddha'); ?></label>
            </span>
            <span class="service-de">
                <label for=""><?php _e('de', 'TableBouddha'); ?></label>
                <input type="time" id="mardi_mide_de" name="mardi_mide_de" value="<?php echo $mardi_mide_de ?>" />
            </span>
            <span class="service-a">
                <label for=""><?php _e('a', 'TableBouddha'); ?></label>
                <input type="time" id="mardi_mide_a" name="mardi_mide_a" value="<?php echo $mardi_mide_a ?>"/>
            </span>
        </div>
        <div class="service dinner">
            <span class="service-ok">
                <input type="hidden" name="mardi_soir_open" value="0" />
                <input type="checkbox" name="mardi_soir_open" id="mardi_soir_open" value="1" <?php checked(1, $mardi_soir_open, true) ?> />
                <label for=""><?php _e('Service du soir', 'TableBouddha'); ?></label>
            </span>
            <span class="service-de">
                <label for=""><?php _e('de', 'TableBouddha'); ?></label>
                <input type="time" id="mardi_soir_de" name="mardi_soir_de" value="<?php echo $mardi_soir_de ?>"/>
            </span>
            <span class="service-a">
                <label for=""><?php _e('a', 'TableBouddha'); ?></label>
                <input type="time" id="mardi_soir_a" name="mardi_soir_a" value="<?php echo $mardi_soir_a ?>"/>
            </span>
        </div>
        <div class="service-close">
            <input type="hidden" name="mardi_fermer" value="0" />
            <input type="checkbox" id="mardi_fermer" name="mardi_fermer" value="1" <?php checked(1, $mardi_fermer, true) ?> />
            <label for=""><?php _e('Jour de fermeture','TableBouddha'); ?></label>
        </div>
        <?php
    }

    public static function field_heure_mercredi_tablebouddha(){
        $mercredi_mide_open = esc_attr(get_option('mercredi_mide_open'));
        $mercredi_mide_de = esc_attr(get_option('mercredi_mide_de'));
        $mercredi_mide_a  = esc_attr(get_option('mercredi_mide_a'));
        $mercredi_soir_open = esc_attr(get_option('mercredi_soir_open'));
        $mercredi_soir_de = esc_attr(get_option('mercredi_soir_de'));
        $mercredi_soir_a  = esc_attr(get_option('mercredi_soir_a'));
        $mercredi_fermer  = esc_attr(get_option('mercredi_fermer'));
        ?>
        <div class="service lunch">
            <span class="service-ok">
                <input type="hidden" name="mercredi_mide_open" value="0"/>
                <input type="checkbox" name="mercredi_mide_open" id="mercredi_mide_open" value="1" <?php checked(1, $mercredi_mide_open, true); ?> />
                <label for=""><?php _e('Service du midi', 'TableBouddha'); ?></label>
            </span>
            <span class="service-de">
                <label for=""><?php _e('de', 'TableBouddha'); ?></label>
                <input type="time" id="mercredi_mide_de" name="mercredi_mide_de" value="<?php echo $mercredi_mide_de ?>"/>
            </span>
            <span class="service-a">
                <label for=""><?php _e('à', 'TableBouddha'); ?></label>
                <input type="time" id="mercredi_mide_a" name="mercredi_mide_a" value="<?php echo $mercredi_mide_a ?>"/>
            </span>
        </div>
        <div class="service dinner">
            <span class="service-ok">
                <input type="hidden" name="mercredi_soir_open" value="0"/>
                <input type="checkbox" name="mercredi_soir_open" id="" value="1" <?php checked(1, $mercredi_soir_open, true); ?> />
                <label for=""><?php _e('Service du soir', 'TableBouddha'); ?></label>
            </span>
            <span class="service-de">
                <label for=""><?php _e('de', 'TableBouddha'); ?></label>
                <input type="time" id="mercredi_soir_de" name="mercredi_soir_de" value="<?php echo $mercredi_soir_de ?>"/>
            </span>
            <span class="service-a">
                <label for=""><?php _e('à', 'TableBouddha'); ?></label>
                <input type="time" id="mercredi_soir_a" name="mercredi_soir_a" value="<?php echo $mercredi_soir_a ?>"/>
            </span>
        </div>
        <div class="service-close">
            <input type="hidden" name="mercredi_fermer" value="0" />
            <input type="checkbox" id="mercredi_fermer" name="mercredi_fermer" value="1" <?php checked(1, $mercredi_fermer, true) ?> />
            <label for=""><?php _e('Jour de fermeture','TableBouddha'); ?></label>
        </div>
        <?php
    }

    public static function field_heure_jeudi_tablebouddha(){
        $jeudi_mide_open = esc_attr(get_option('jeudi_mide_open'));
        $jeudi_mide_de = esc_attr(get_option('jeudi_mide_de'));
        $jeudi_mide_a  = esc_attr(get_option('jeudi_mide_a'));
        $jeudi_soir_open = esc_attr(get_option('jeudi_soir_open'));
        $jeudi_soir_de = esc_attr(get_option('jeudi_soir_de'));
        $jeudi_soir_a  = esc_attr(get_option('jeudi_soir_a'));
        $jeudi_fermer  = esc_attr(get_option('jeudi_fermer'));
        ?>
        <div class="service lunch">
            <span class="service-ok">
                <input type="hidden" name="jeudi_mide_open" value="0"/>
                <input type="checkbox" name="jeudi_mide_open" id="jeudi_mide_open" value="1" <?php checked(1, $jeudi_mide_open, true); ?> />
                <label for=""><?php _e('Service du midi', 'TableBouddha'); ?></label>
            </span>
            <span class="service-de">
                <label for=""><?php _e('de', 'TableBouddha'); ?></label>
                <input type="time" id="jeudi_mide_de" name="jeudi_mide_de" value="<?php echo $jeudi_mide_de ?>"/>
            </span>
            <span class="service-a">
                <label for=""><?php _e('à', 'TableBouddha'); ?></label>
                <input type="time" id="jeudi_mide_a" name="jeudi_mide_a" value="<?php echo $jeudi_mide_a ?>"/>
            </span>
        </div>
        <div class="service dinner">
            <span class="service-ok">
                <input type="hidden" name="jeudi_soir_open" value="0"/>
                <input type="checkbox" name="jeudi_soir_open" id="jeudi_soir_open" value="1" <?php checked(1, $jeudi_soir_open, true); ?> />
                <label for=""><?php _e('Service du soir', 'TableBouddha'); ?></label>
            </span>
            <span class="service-de">
                <label for=""><?php _e('de', 'TableBouddha'); ?></label>
                <input type="time" id="jeudi_soir_de" name="jeudi_soir_de" value="<?php echo $jeudi_soir_de ?>"/>
            </span>
            <span class="service-a">
                <label for=""><?php _e('à', 'TableBouddha'); ?></label>
                <input type="time" id="jeudi_soir_a" name="jeudi_soir_a" value="<?php echo $jeudi_soir_a ?>"/>
            </span>
        </div>
        <div class="service-close">
            <input type="hidden" name="jeudi_fermer" value="0" />
            <input type="checkbox" id="jeudi_fermer" name="jeudi_fermer" value="1" <?php checked(1, $jeudi_fermer, true) ?> />
            <label for=""><?php _e('Jour de fermeture','TableBouddha'); ?></label>
        </div>
        <?php
    }

    public static function field_heure_vendredi_tablebouddha(){
        $vendredi_mide_open = esc_attr(get_option('vendredi_mide_open'));
        $vendredi_mide_de = esc_attr(get_option('vendredi_mide_de'));
        $vendredi_mide_a  = esc_attr(get_option('vendredi_mide_a'));
        $vendredi_soir_open = esc_attr(get_option('vendredi_soir_open'));
        $vendredi_soir_de = esc_attr(get_option('vendredi_soir_de'));
        $vendredi_soir_a  = esc_attr(get_option('vendredi_soir_a'));
        $vendredi_fermer  = esc_attr(get_option('vendredi_fermer'));
        ?>
        <div class="service lunch">
            <span class="service-ok">
                <input type="hidden" name="vendredi_mide_open" value="0"/>
                <input type="checkbox" name="vendredi_mide_open" id="vendredi_mide_open" value="1" <?php checked(1, $vendredi_mide_open, true); ?> />
                <label for=""><?php _e('Service du midi', 'TableBouddha'); ?></label>
            </span>
            <span class="service-de">
                <label for=""><?php _e('de', 'TableBouddha'); ?></label>
                <input type="time" id="vendredi_mide_de" name="vendredi_mide_de" value="<?php echo $vendredi_mide_de ?>" />
            </span>
            <span class="service-a">
                <label for=""><?php _e('à', 'TableBouddha'); ?></label>
                <input type="time" id="vendredi_mide_a" name="vendredi_mide_a" value="<?php echo $vendredi_mide_a ?>" />
            </span>
        </div>
        <div class="service dinner">
            <span class="service-ok">
                <input type="hidden" name="vendredi_soir_open" value="0"/>
                <input type="checkbox" name="vendredi_soir_open" id="vendredi_soir_open" value="1" <?php checked(1, $vendredi_soir_open, true); ?> />
                <label for=""><?php _e('Service du soir', 'TableBouddha'); ?></label>
            </span>
            <span class="service-de">
                <label for=""><?php _e('de', 'TableBouddha'); ?></label>
                <input type="time" id="vendredi_soir_de" name="vendredi_soir_de" value="<?php echo $vendredi_soir_de ?>" />
            </span>
            <span class="service-a">
                <label for=""><?php _e('à', 'TableBouddha'); ?></label>
                <input type="time" id="vendredi_soir_a" name="vendredi_soir_a" value="<?php echo $vendredi_soir_a ?>" />
            </span>
        </div>
        <div class="service-close">
            <input type="hidden" name="vendredi_fermer" value="0" />
            <input type="checkbox" id="vendredi_fermer" name="vendredi_fermer" value="1" <?php checked(1, $vendredi_fermer, true) ?> />
            <label for=""><?php _e('Jour de fermeture','TableBouddha'); ?></label>
        </div>

        <?php
    }

    public static function field_heure_samedi_tablebouddha(){
        $samedi_mide_open = esc_attr(get_option('samedi_mide_open'));
        $samedi_mide_de = esc_attr(get_option('samedi_mide_de'));
        $samedi_mide_a  = esc_attr(get_option('samedi_mide_a'));
        $samedi_soir_open = esc_attr(get_option('samedi_soir_open'));
        $samedi_soir_de = esc_attr(get_option('samedi_soir_de'));
        $samedi_soir_a  = esc_attr(get_option('samedi_soir_a'));
        $samedi_fermer  = esc_attr(get_option('samedi_fermer'));
        ?>
        <div class="service lunch">
            <span class="service-ok">
                <input type="hidden" name="samedi_mide_open" value="0"/>
                <input type="checkbox" name="samedi_mide_open" id="samedi_mide_open" value="1" <?php checked(1, $samedi_mide_open, true); ?> />
                <label for=""><?php _e('Service du midi', 'TableBouddha'); ?></label>
            </span>
            <span class="service-de">
                <label for=""><?php _e('de', 'TableBouddha'); ?></label>
                <input type="time" id="samedi_mide_de" name="samedi_mide_de" value="<?php echo $samedi_mide_de ?>"/>
            </span>
            <span class="service-a">
                <label for=""><?php _e('à', 'TableBouddha'); ?></label>
                <input type="time" id="samedi_mide_a" name="samedi_mide_a" value="<?php echo $samedi_mide_a ?>"/>
            </span>
        </div>
        <div class="service dinner">
            <span class="service-ok">
                <input type="hidden" name="samedi_soir_open" value="0"/>
                <input type="checkbox" name="samedi_soir_open" id="samedi_soir_open" value="1" <?php checked(1, $samedi_soir_open, true); ?> />
                <label for=""><?php _e('Service du soir', 'TableBouddha'); ?></label>
            </span>
            <span class="service-de">
                <label for=""><?php _e('de', 'TableBouddha'); ?></label>
                <input type="time" id="samedi_soir_de" name="samedi_soir_de" value="<?php echo $samedi_soir_de ?>"/>
            </span>
            <span class="service-a">
                <label for=""><?php _e('à', 'TableBouddha'); ?></label>
                <input type="time" id="samedi_soir_a" name="samedi_soir_a" value="<?php echo $samedi_soir_a ?>"/>
            </span>
        </div>
        <div class="service-close">
            <input type="hidden" name="samedi_fermer" value="0" />
            <input type="checkbox" id="samedi_fermer" name="samedi_fermer" value="1" <?php checked(1, $samedi_fermer, true) ?>/>
            <label for=""><?php _e('Jour de fermeture','TableBouddha'); ?></label>
        </div>
        <?php
    }

    public static function field_heure_dimanche_tablebouddha(){
        $dimanche_mide_open = esc_attr(get_option('dimanche_mide_open'));
        $dimanche_mide_de = esc_attr(get_option('dimanche_mide_de'));
        $dimanche_mide_a  = esc_attr(get_option('dimanche_mide_a'));
        $dimanche_soir_open = esc_attr(get_option('dimanche_soir_open'));
        $dimanche_soir_de = esc_attr(get_option('dimanche_soir_de'));
        $dimanche_soir_a  = esc_attr(get_option('dimanche_soir_a'));
        $dimanche_fermer  = esc_attr(get_option('dimanche_fermer'));
        ?>
        <div class="service lunch">
            <span class="service-ok">
                <input type="hidden" name="dimanche_mide_open" value="0"/>
                <input type="checkbox" name="dimanche_mide_open" id="dimanche_mide_open" value="1" <?php checked(1, $dimanche_mide_open, true); ?> />
                <label for=""><?php _e('Service du midi', 'TableBouddha'); ?></label>
            </span>
            <span class="service-de">
                <label for=""><?php _e('de', 'TableBouddha'); ?></label>
                <input type="time" id="dimanche_mide_de" name="dimanche_mide_de" value="<?php echo $dimanche_mide_de ?>" />
            </span>
            <span class="service-a">
                <label for=""><?php _e('à', 'TableBouddha'); ?></label>
                <input type="time" id="dimanche_mide_a" name="dimanche_mide_a" value="<?php echo $dimanche_mide_a ?>" />
            </span>
        </div>
        <div class="service dinner">
            <span class="service-ok">
                <input type="hidden" name="dimanche_soir_open" value="0"/>
                <input type="checkbox" name="dimanche_soir_open" id="dimanche_soir_open" value="1" <?php checked(1, $dimanche_soir_open, true); ?> />
                <label for=""><?php _e('Service du soir', 'TableBouddha'); ?></label>
            </span>
            <span class="service-de">
                <label for=""><?php _e('de', 'TableBouddha'); ?></label>
                <input type="time" id="dimanche_soir_de" name="dimanche_soir_de" value="<?php echo $dimanche_soir_de ?>" />
            </span>
            <span class="service-a">
                <label for=""><?php _e('à', 'TableBouddha'); ?></label>
                <input type="time" id="dimanche_soir_a" name="dimanche_soir_a" value="<?php echo $dimanche_soir_a ?>" />
            </span>
        </div>
        <div class="service-close">
            <input type="hidden" name="dimanche_fermer" value="0" />
            <input type="checkbox" id="dimanche_fermer" name="dimanche_fermer" value="1" <?php checked(1, $dimanche_fermer, true) ?> />
            <label for=""><?php _e('Jour de fermeture','TableBouddha'); ?></label>
        </div>
        <?php
    }

}

if(class_exists('tablebouddha_timetable')){
    tablebouddha_timetable::register();
}
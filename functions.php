<?php
/**
 * Name file: functions
 * Description: Theme functions and definitions [includes all functions]
 *
 * @package WordPress
 * @subpackage TableBouddha
 * @since 2.1
 */

/* ---------------------------------------------------------
>>>  TABLE OF CONTENTS:
------------------------------------------------------------

1 - Customize
2 - Options-Theme
3 - Post-Type
4 - Metaboxes
5 - Taxonomies

----------------------------------------------------------*/

/** =====================================================
 *  1 - CUSTOMIZE
 *      Directory about customize of theme
 */
require_once ('inc/customize/customize-index.php');

/** =====================================================
 * 2 - Options-Theme
 *     Directory about option of theme
 */
 require_once ('inc/options-theme/API-index.php');

/** =====================================================
 * 3 - Post-Type
 *     Directory about Custom Post Types created for theme
 */
require_once ('inc/post-type/cartes.php');

/** =====================================================
 * 4 - Metaboxes
 *     Directory about metaboxes created for theme
 */
// require_once('inc/metaboxes/meta-index.php');

/** =====================================================
 * 5 - Taxonomys
 *     Directory about taxonomys created for theme
 */
// require_once('inc/metaboxes/taxo-index.php');

<?php
/**
 * Name file: config-theme
 * Description: this file allows you to ass the different elements for we need for this theme
 *
 * @package WordPress
 * @subpackage TableBouddha
 * @since 2.1
 */


/* ---------------------------------------------------------
>>>  TABLE OF CONTENTS:
------------------------------------------------------------

1 - Config Basic
2 - Custom Back-Office

----------------------------------------------------------*/

/** ===============================================================
 *  1 - Config Basic
 *      Obligatory declaration to start the new theme
 */
// declare new theme ......................................
require_once('config/theme.php');

// add style and script (front) ...........................
require_once('config/assets.php');

/** ===============================================================
 * 2 - Custom Back-Office
 *     declaration to customize the back-office
 */
// add style and script (back) ............................
require_once('config/admin.php');

// customize dashboard ....................................
require_once('config/dashboard.php');

// Column for Custom Post-Type ............................
require_once ('column/carte.php');
require_once ('column/boisson.php');
require_once ('column/emporter.php');
require_once ('column/event.php');

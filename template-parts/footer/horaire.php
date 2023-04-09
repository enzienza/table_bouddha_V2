<?php
/**
 * Name file:   horaire
 * Description: display the template part for informations hours opening
 *
 * @package WordPress
 * @subpackage TableBouddha
 * @since 2.1
 */
?>

<table class="table-horaire">

    <tr class="item-days">
        <td class="day"><?php _e('Lundi', 'TableBouddha')?></td>
        <td>
            <?php if(checked(1, get_option('lundi_fermer'), false)) : ?>
            <ul class="hour-list">
                <li class="hour-item"><?php _e('Fermé', 'TableBouddha')?></li>
                <?php else: ?>
                    <?php if(checked(1, get_option('lundi_mide_open'), false)) : ?>
                        <ul class="hour-list">
                            <li class="hour-item"><?php echo get_option('lundi_mide_de') ?></li>
                            <li class="hour-item">-</li>
                            <li class="hour-item"><?php echo get_option('lundi_mide_a') ?></li>
                        </ul>
                    <?php endif; ?>

                    <?php if(checked(1, get_option('lundi_soir_open'), false)) : ?>
                        <ul class="hour-list">
                            <li class="hour-item"><?php echo get_option('lundi_soir_de') ?></li>
                            <li class="hour-item">-</li>
                            <li class="hour-item"><?php echo get_option('lundi_soir_a') ?></li>
                        </ul>
                    <?php endif; ?>
                <?php endif; ?>
        </td>
    </tr>

    <tr class="item-days">
        <td class="day"><?php _e('Mardi', 'TableBouddha'); ?></td>
        <td>
            <?php if(checked(1, get_option('mardi_fermer'), false)) : ?>
                <ul class="hour-list">
                    <li class="hour-item"><?php _e('Fermé', 'TableBouddha')?></li>
                </ul>
            <?php else: ?>
                <?php if(checked(1, get_option('mardi_mide_open'), false)) : ?>
                    <ul class="hour-list">
                        <li class="hour-item"><?php echo get_option('mardi_mide_de') ?></li>
                        <li class="hour-item">-</li>
                        <li class="hour-item"><?php echo get_option('mardi_mide_a') ?></li>
                    </ul>
                <?php endif; ?>

                <?php if(checked(1, get_option('mardi_soir_open'), false)) : ?>
                    <ul class="hour-list">
                        <li class="hour-item"><?php echo get_option('mardi_soir_de') ?></li>
                        <li class="hour-item">-</li>
                        <li class="hour-item"><?php echo get_option('mardi_soir_a') ?></li>
                    </ul>
                <?php endif; ?>
            <?php endif; ?>
        </td>
    </tr>

    <tr class="item-days">
        <td class="day"><?php _e('Mercredi', 'TableBouddha'); ?></td>
        <td>
            <?php if(checked(1, get_option('mercredi_fermer'), false)) : ?>
                <ul class="hour-list">
                    <li class="hour-item"><?php _e('Fermé', 'TableBouddha')?></li>
                </ul>
            <?php else: ?>
                <?php if(checked(1, get_option('mercredi_mide_open'), false)) : ?>
                    <ul class="hour-list">
                        <li class="hour-item"><?php echo get_option('mercredi_mide_de') ?></li>
                        <li class="hour-item">-</li>
                        <li class="hour-item"><?php echo get_option('mercredi_mide_a') ?></li>
                    </ul>
                <?php endif; ?>

                <?php if(checked(1, get_option('mercredi_soir_open'), false)) : ?>
                    <ul class="hour-list">
                        <li class="hour-item"><?php echo get_option('mercredi_soir_de') ?></li>
                        <li class="hour-item">-</li>
                        <li class="hour-item"><?php echo get_option('mercredi_soir_a') ?></li>
                    </ul>
                <?php endif; ?>
            <?php endif; ?>
        </td>
    </tr>

    <tr class="item-days">
        <td class="day"><?php _e('Jeudi', 'TableBouddha'); ?></td>
        <td>
            <?php if(checked(1, get_option('jeudi_fermer'), false)) : ?>
                <ul class="hour-list">
                    <li class="hour-item"><?php _e('Fermé', 'TableBouddha')?></li>
                </ul>
            <?php else: ?>
                <?php if(checked(1, get_option('jeudi_mide_open'), false)) : ?>
                    <ul class="hour-list">
                        <li class="hour-item"><?php echo get_option('jeudi_mide_de') ?></li>
                        <li class="hour-item">-</li>
                        <li class="hour-item"><?php echo get_option('jeudi_mide_a') ?></li>
                    </ul>
                <?php endif; ?>

                <?php if(checked(1, get_option('jeudi_soir_open'), false)) : ?>
                    <ul class="hour-list">
                        <li class="hour-item"><?php echo get_option('jeudi_soir_de') ?></li>
                        <li class="hour-item">-</li>
                        <li class="hour-item"><?php echo get_option('jeudi_soir_a') ?></li>
                    </ul>
                <?php endif; ?>
            <?php endif; ?>
        </td>
    </tr>

    <tr class="item-days">
        <td class="day"><?php _e('Vendredi', 'TableBouddha'); ?></td>
        <td>
            <?php if(checked(1, get_option('vendredi_fermer'), false)) : ?>
                <ul class="hour-list">
                    <li class="hour-item"><?php _e('Fermé', 'TableBouddha')?></li>
                </ul>
            <?php else: ?>
                <?php if(checked(1, get_option('vendredi_mide_open'), false)) : ?>
                    <ul class="hour-list">
                        <li class="hour-item"><?php echo get_option('vendredi_mide_de') ?></li>
                        <li class="hour-item">-</li>
                        <li class="hour-item"><?php echo get_option('vendredi_mide_a') ?></li>
                    </ul>
                <?php endif; ?>

                <?php if(checked(1, get_option('vendredi_soir_open'), false)) : ?>
                    <ul class="hour-list">
                        <li class="hour-item"><?php echo get_option('vendredi_soir_de') ?></li>
                        <li class="hour-item">-</li>
                        <li class="hour-item"><?php echo get_option('vendredi_soir_a') ?></li>
                    </ul>
                <?php endif; ?>
            <?php endif; ?>
        </td>
    </tr>

    <tr class="item-days">
        <td class="day"><?php _e('Samedi', 'TableBouddha');?></td>
        <td>
            <?php if(checked(1, get_option('samedi_fermer'), false)) : ?>
                <ul class="hour-list">
                    <li class="hour-item"><?php _e('Fermé', 'TableBouddha')?></li>
                </ul>
            <?php else: ?>
                <?php if(checked(1, get_option('samedi_mide_open'), false)) : ?>
                    <ul class="hour-list">
                        <li class="hour-item"><?php echo get_option('samedi_mide_de') ?></li>
                        <li class="hour-item">-</li>
                        <li class="hour-item"><?php echo get_option('samedi_mide_a') ?></li>
                    </ul>
                <?php endif; ?>

                <?php if(checked(1, get_option('samedi_soir_open'), false)) : ?>
                    <ul class="hour-list">
                        <li class="hour-item"><?php echo get_option('samedi_soir_de') ?></li>
                        <li class="hour-item">-</li>
                        <li class="hour-item"><?php echo get_option('samedi_soir_a') ?></li>
                    </ul>
                <?php endif; ?>
            <?php endif; ?>
        </td>
    </tr>

    <tr class="item-days">
        <td class="day"><?php _e('Dimanche', 'TableBouddha'); ?></td>
        <td>
            <?php if(checked(1, get_option('dimanche_fermer'), false)) : ?>
                <ul class="hour-list">
                    <li class="hour-item"><?php _e('Fermé', 'TableBouddha')?></li>
                </ul>
            <?php else: ?>
                <?php if(checked(1, get_option('dimanche_mide_open'), false)) : ?>
                    <ul class="hour-list">
                        <li class="hour-item"><?php echo get_option('dimanche_mide_de') ?></li>
                        <li class="hour-item">-</li>
                        <li class="hour-item"><?php echo get_option('dimanche_mide_a') ?></li>
                    </ul>
                <?php endif; ?>

                <?php if(checked(1, get_option('dimanche_soir_open'), false)) : ?>
                    <ul class="hour-list">
                        <li class="hour-item"><?php echo get_option('dimanche_soir_de') ?></li>
                        <li class="hour-item">-</li>
                        <li class="hour-item"><?php echo get_option('dimanche_soir_a') ?></li>
                    </ul>
                <?php endif; ?>
            <?php endif; ?>
        </td>
    </tr>

</table>

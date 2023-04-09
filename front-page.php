<?php
/**
 * The front page template file
 *
 * @package WordPress
 * @subpackage TableBouddha
 * @since 2.1
 */
?>

<?php get_header(); ?>


<?php
/**
 * SI 'yes_video' checked = 1
 * ==> Afficher video en background
 */
 ?>
<?php if(checked(1, get_option('yes_video'), false)) : ?>
  <section id="bg-video">
    <?php if(checked(1, get_option('sound_video'), false)): ?>
      <video autoplay="true" loop="true" muted id="video-background">
        <source src="<?php echo get_option('add_video'); ?>"
                type="video/mp4">
        <source src="<?php echo get_option('add_video'); ?>"
                type="video/ogg">
      </video>
      <audio autoplay="true" loop="true">
        <source src="<?php echo get_template_directory_uri().'/assets/media/video-1592479640.mp3' ?>"
                type="audio/mpeg">
        <source src="<?php echo get_template_directory_uri().'/assets/media/video-1592479640.mp3' ?>"
                type="audio/ogg">
      </audio>
    <?php else : ?>
      <video autoplay="true" loop="true" muted  id="video-background">
        <source src="<?php echo get_option('add_video'); ?>"
                type="video/mp4">
        <source src="<?php echo get_option('add_video'); ?>"
                type="video/ogg">
      </video>
    <?php endif; ?>

    <div class="filter">
      <?php if(checked(1, get_option('yes_message_video'), false)){ ?>
        <div class="container message">
          <div class="row jumbtitle">
            <?php
              if(
                (checked(1, get_option('view_logo_video'), false)) &&
                (checked(1, get_option('view_namesite_video'), false))
              ){
            ?>
              <div class="col-lg-3 col-12 animated fadeInLeft">
                <img src="<?php echo get_option('img_logo') ?>"
                     class="logo small-logo"
                     alt="<?php bloginfo('title'); ?>"
                />
                <h1 class="small-title">
                  <?php bloginfo('title'); ?>
                </h1>
              </div>
              <div class="col-lg-9 col-12 animated fadeInRight view-message">
                <?php echo get_option('message_video'); ?>
              </div>
            <?php } elseif(checked(1, get_option('view_logo_video'), false)) { ?>
              <div class="col-lg-3 col-12 animated fadeInLeft">
                <img src="<?php echo get_option('img_logo') ?>"
                     class="logo small-logo"
                     alt="<?php bloginfo('title'); ?>"
                />
              </div>
              <div class="col-lg-9 col-12 view view-message animated fadeInRight">
                <?php echo get_option('message_video'); ?>
              </div>
            <?php } elseif(checked(1, get_option('view_namesite_video'), false)){ ?>
              <div class="col-lg-3 col-12  small small-md-3 animated fadeInLeft">
                <h1 class="small-title">
                  <?php bloginfo('title'); ?>
                </h1>
              </div>
              <div class="col-lg-9 col-12 small small-md-9 view-message animated fadeInRight">
                <?php echo get_option('message_video'); ?>
              </div>
            <?php } else { ?>
              <div class="col-12 small view-message animated fadeIn">
                <?php echo get_option('message_video'); ?>
              </div>
            <?php } ?>
          </div>
        </div>
      <?php
        } elseif(
          (checked(1, get_option('view_logo_video'), false)) &&
          (checked(1, get_option('view_namesite_video'), false))
        ) {
      ?>
        <div class="jumbtitle my-4">
          <img src="<?php echo get_option('img_logo') ?>"
               class="logo animated fadeInRight"
               alt="<?php bloginfo('title'); ?>"
          />
          <h1 class="animated fadeInLeft">
            <?php bloginfo('title'); ?>
          </h1>
        </div>
      <?php } elseif(checked(1, get_option('view_logo_video'), false)){ ?>
        <div class="jumbtitle pt-4">
          <img src="<?php echo get_option('img_logo') ?>"
               class="logo logo-center animated fadeIn"
               alt="<?php bloginfo('title'); ?>"
          />
        </div>
      <?php } elseif(checked(1, get_option('view_namesite_video'), false)) { ?>
        <div class="jumbtitle pt-6">
          <h1 class="title-center animated zoomIn">
            <?php bloginfo('title'); ?>
          </h1>
        </div>
      <?php } ?>
    </div>

    <div class="info-contact">
      <?php
        if (
          (checked(1, get_option('view_address_video'), false)) &&
          (checked(1, get_option('view_phone_video'), false))
        ){
      ?>
        <ul>
          <li class="item-info-contact">
            <span class="icons flaticon-localization"></span>
            <p><?php echo get_option('adresse') ?></p>
          </li>
          <li class="item-info-contact invible">
            <p> | </p>
          </li>
          <li class="item-info-contact">
            <span class="icons flaticon-phone"></span>
            <p><?php echo get_option('phone') ?></p>
          </li>
        </ul>

      <?php } elseif (checked(1, get_option('view_address_video'), false)) { ?>
        <ul>
          <li class="item-info-contact">
            <span class="icons flaticon-localization"></span>
            <p><?php echo get_option('adresse') ?></p>
          </li>
        </ul>
      <?php } elseif (checked(1, get_option('view_phone_video'), false)) { ?>
        <ul>
          <li class="item-info-contact">
            <span class="icons flaticon-phone"></span>
            <p><?php echo get_option('phone') ?></p>
          </li>
        </ul>
      <?php } ?>
    </div>
  </section>

<?php elseif(checked(1, get_option('yes_image'), false)) : ?>
<section id="bg-image" style="background-image: url(<?php echo get_option('add_image') ?>)">
  <div class="filter">
    <?php if(checked(1, get_option('yes_message_image'), false)){ ?>
      <div class="container message" >
        <div class="row jumbtitle">
          <?php
            if(
              (checked(1, get_option('view_logo_image'), false)) &&
              (checked(1, get_option('view_namesite_image'), false))
            ){
          ?>
            <div class="col-lg-3 col-12">
              <img src="<?php echo get_option('img_logo') ?>"
                   class="logo small-logo"
                   alt="<?php bloginfo('title'); ?>"
              />
              <h1 class="small-title">
                <?php bloginfo('title'); ?>
              </h1>
            </div>
            <div class="col-lg-9 col-12 view-message">
              <?php echo get_option('message_image'); ?>
            </div>
          <?php } elseif(checked(1, get_option('view_logo_image'), false)) { ?>
            <div class="col-lg-3 col-12">
              <img src="<?php echo get_option('img_logo') ?>"
                   class="logo small-logo"
                   alt="<?php bloginfo('title'); ?>"
              />
            </div>
            <div class="col-lg-9 col-12 view view-message">
              <?php echo get_option('message_image'); ?>
            </div>
          <?php } elseif(checked(1, get_option('view_namesite_image'), false)){ ?>
            <div class="col-lg-3 col-12  small small-md-3">
              <h1 class="small-title">
                <?php bloginfo('title'); ?>
              </h1>
            </div>
            <div class="col-lg-9 col-12 small small-md-9 view-message">
              <?php echo get_option('message_image'); ?>
            </div>
          <?php } else { ?>
            <div class="col-12 small small-msg view-message">
              <?php echo get_option('message_image'); ?>
            </div>
          <?php } ?>
        </div>
      </div>
    <?php
      } elseif(
        (checked(1, get_option('view_logo_image'), false)) &&
        (checked(1, get_option('view_namesite_image'), false))
      ) {
    ?>
      <div class="jumbtitle my-4">
        <img src="<?php echo get_option('img_logo') ?>"
             class="logo"
             alt="<?php bloginfo('title'); ?>"
        />
        <h1>
          <?php bloginfo('title'); ?>
        </h1>
      </div>
    <?php } elseif(checked(1, get_option('view_logo_image'), false)){ ?>
      <div class="jumbtitle pt-4">
        <img src="<?php echo get_option('img_logo') ?>"
             class="logo logo-center"
             alt="<?php bloginfo('title'); ?>"
        />
      </div>
    <?php } elseif(checked(1, get_option('view_namesite_image'), false)) { ?>
      <div class="jumbtitle">
        <h1 class="title-center">
          <?php bloginfo('title'); ?>
        </h1>
      </div>
    <?php } ?>
  </div>


  <div class="info-contact">
    <?php
      if (
        (checked(1, get_option('view_address_image'), false)) &&
        (checked(1, get_option('view_phone_image'), false))
      ){
    ?>
      <ul>
        <li class="item-info-contact">
          <span class="icons flaticon-localization"></span>
          <p><?php echo get_option('adresse') ?></p>
        </li>
        <li class="item-info-contact invible">
          <p> | </p>
        </li>
        <li class="item-info-contact">
          <span class="icons flaticon-phone"></span>
          <p><?php echo get_option('phone') ?></p>
        </li>
      </ul>

    <?php } elseif (checked(1, get_option('view_address_image'), false)) { ?>
      <ul>
        <li class="item-info-contact">
          <span class="icons flaticon-localization"></span>
          <p><?php echo get_option('adresse') ?></p>
        </li>
      </ul>
    <?php } elseif (checked(1, get_option('view_phone_image'), false)) { ?>
      <ul>
        <li class="item-info-contact">
          <span class="icons flaticon-phone"></span>
          <p><?php echo get_option('phone') ?></p>
        </li>
      </ul>
    <?php } ?>
  </div>
</section>
<?php endif; ?>



<span style="display:none">
  <?php get_footer(); ?>
</span>

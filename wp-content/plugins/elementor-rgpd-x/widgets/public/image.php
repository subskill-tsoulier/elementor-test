<?php
// Bloc image
// image
// Dynamise le : 12/08/2022
?>
<!-- Section - Block Simple Wysiwyg-->
<!-- add "blue-block" ou "violet-block" pour les déclinaisons en violet ou en bleu ou enlever si couleur classique -->
<section class="block-wysiwyg block-simple-wysiwyg bg-white block-image">
 <div class="container">
     <?php
     if ($settings['title']):
     ?>
     <div class="block_section-title left">
         <<?= $settings['hn'] ?  $settings['hn'] : 'h2' ?> class="title"><?= $settings['title'] ?></<?= $settings['hn'] ?  $settings['hn'] : 'h2' ?>>
        </div>
    <?php
    endif;
    ?>
   <?php
   if( !empty($image) ):
    ?>
     <div class="img img-full">
      <a href="<?= $image['url']; ?>" data-title=" " data-toggle="lightbox">
       <img src="<?= $image['url']; ?>" alt="" />
      </a>
     </div>
    <?php
   endif;
   ?>
   <?php
   if( !empty($cta_label) && !empty($cta_link) && !empty($cta_link['url']) ):
    ?>
     <div class="cta">
      <a href="<?= $cta_link['url']; ?>" <?= (!empty($cta_link['is_external']) && $cta_link['is_external'] == "on")?'target="_blank"':''; ?> <?= (!empty($cta_link['nofollow']) && $cta_link['nofollow'] == "on")?'rel="nofollow"':''; ?> class="btn btn-primary bg-light small">
       <div class="text"><?= $cta_label; ?></div>
       <div class="circle"></div>
      </a>
     </div>
    <?php
   endif;
   ?>
 </div>
</section>

<?php
/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */

if( !empty($image) ) {
    $image['url']   = wp_get_attachment_image_url($image['id'], 'large-half-img');
}
global $special_color;
$classes .= (!empty($special_color))?"special-".$special_color:"";
?>
<!-- Section - Block Text Image-->
<section class="block-text-img <?= (!empty($displayCover) && $displayCover == "yes")?"finance":""; ?> <?= $classes ?>">
    <div class="container-fluid p-0">
        <div class="row gx-0 <?= $displayRight == 'yes' ? 'flex-row-reverse' : '' ;?> ">
            <div class="col-lg-<?= $display == 'half' ? '6' : '5' ;?>  text-part block-wysiwyg">
                <div class="block_section-title">
                    <<?=$hn;?> class="title"> <?= $title ;?> </<?= $hn;?>>
            </div>
            <?= $text ;?>
            <?php if($displayCta === 'yes') : ?>
                <div class="cta">
                    <a href="<?= !empty($ctaLink) && !empty($ctaLink['url']) ? $ctaLink['url'] : '#'?>" <?= !empty($ctaLink['is_external']) && $ctaLink['is_external'] == "yes"?'target="_blank"':''; ?> class="btn btn-primary bg-light small">
                        <div class="text"><?php echo $ctaLabel ; ?></div>
                        <div class="circle"></div>
                    </a>
                </div>
            <?php endif ;?>
        </div>
        <?php if (is_admin()) { ?>
            <div class="col-lg-<?= $display == 'half' ? '6' : '7' ;?> pic-part bg-img b-lazy <?= !empty($backgroundColorImg)?$backgroundColorImg:''; ?>" <?php if(!empty($image)): ?>style="background-image: url(<?= $image['url'] ?>)"<?php endif; ?>></div>
        <?php } else { ?>
            <div class="col-lg-<?= $display == 'half' ? '6' : '7' ;?> pic-part bg-img b-lazy <?= !empty($backgroundColorImg)?$backgroundColorImg:''; ?>" <?php if(!empty($image)): ?>data-src="<?= $image['url'];?>"<?php endif; ?>></div>
        <?php } ?>
    </div>
</section>
<!-- -->
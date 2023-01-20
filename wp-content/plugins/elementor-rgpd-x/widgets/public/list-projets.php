<?php
// Liste des projets - remontée automatique  
// Dynamise le : 12/08/22
?>
<!-- Block Slider Full References -->
<section class="block-references">
    <div class="container">
        <?php if( !empty($title) ): ?>
        <div class="block_section-title block_section-swiper">
            <<?= $hn ?> class="title"><?= $title; ?></<?= $hn ?>>
    </div>
    <?php endif; ?>
    </div>
    <!-- -->
    <div class="block-references_container">
        <div class="row gx-0">
            <?php if ( !empty($posts) ): ?>
            <?php foreach( $posts as $post ): ?>
            <?php
            $image          = '';
            $image_id       = get_post_thumbnail_id($post->ID);
            if ( !empty($image_id) ) {
                $image      = wp_get_attachment_image_src($image_id, 'project-list-img');
                $image      = (!empty($image))?$image[0]:'';
            };
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <?php if (is_admin()) { ?>
                <div class="block_preview-project" <?= (!empty($image) && $image != false)?'style="background-image: url("' . $image. ')"':''; ?>>
                    <?php } else { ?>
                    <div class="block_preview-project b-lazy" <?= (!empty($image) && $image != false)?'data-src="'.$image.'"':''; ?>>
                        <?php } ?>
                        <div class="top tags hashtags">
                                <?php
                                $sector     =   get_field("sector", $post->ID);
                                $country    =   get_field("country", $post->ID);
                                $offer_type =   get_field("offer_type", $post->ID);
                                if ( !empty($sector) ) :
                                    if( !is_array($sector) ) {
                                        ?>
                                        <div class="tag"><?= "#" . $sector->post_title ?></div>
                                        <?php
                                    } else {
                                        foreach($sector as $sector_item):
                                        ?>
                                        <div class="tag"><?= "#" . $sector_item->post_title ?></div>
                                        <?php
                                        endforeach;
                                        }
                                endif;
                                if ( !empty($offer_type) ) :
                                    ?>
                                    <div class="tag"><?= ($offer_type == "ingenierie")?"#" . __("Ingénierie", "assystem"):"#" . __("Digital", "assystem"); ?></div>
                                    <?php
                                endif;
                                if ( !empty($country) ) :
                                    if(gettype($country) == 'object'):
                                        ?>
                                        <div class="tag"><?= "#" . $country->post_title ?></div>
                                        <?php
                                    elseif(gettype($country) == 'array'): ?>
                                        <?php
                                        foreach($country as $county_item):
                                            ?>
                                            <div class="tag"><?= "#" . $county_item->post_title ?></div>
                                            <?php
                                        endforeach;
                                        ?>
                                    <?php endif; endif;
                                ?>
                        </div>
                        <div class="bottom">
                            <a href="<?= get_permalink($post->ID); ?>" class="title">
                                <?= $post->post_title; ?>
                            </a>
                            <a href="<?= get_permalink($post->ID); ?>" class="btn btn-secondary white"><?= __("Lire plus", "assystem"); ?></a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="ctas-center">
            <?php
            if( !empty($cta_link) && !empty($cta_label) ):
                ?>
                <div class="cta">
                    <a <?= ((!empty($cta_link['nofollow']) && $cta_link['nofollow'] == "on")?'rel="nofollow"':'') ?> <?= ((!empty($cta_link['is_external']) && $cta_link['is_external'] == "on")?'target="_blank"':'') ?> href="<?= $cta_link['url'] ?>" class="btn btn-primary bg-light small">
                        <div class="text"><?= $cta_label; ?></div>
                        <div class="circle"></div>
                    </a>
                </div>
                <?php
            endif;
            ?>
        </div>
</section>
<!-- -->
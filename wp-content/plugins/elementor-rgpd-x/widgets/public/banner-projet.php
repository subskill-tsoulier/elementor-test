<?php
/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */
?>
<!--   Section - Project Banner -->
<?php
if (is_admin()) { ?>
<section class="block-project-banner bg-img"
         <?php if (!empty($image) && !empty($image['url'])): ?>style="background-image: url(<?= $image['url'] ?>)"<?php endif; ?>>
    <?php }else { ?>
    <section class="block-project-banner bg-img b-lazy"
             <?php if (!empty($image) && !empty($image['url'])): ?>data-src="<?= $image['url']; ?>"<?php endif; ?>>
        <?php } ?>
        <div class="content">
            <?php
            if (!empty($title)):
            ?>
            <div class="block_section-title title-no-line title-white">
                <<?= $hn; ?> class="title"><?= $title; ?></<?= $hn; ?>>
        </div>
    <?php
    endif;
    ?>
        <?php
        if (!empty($text)):
            ?>
            <div class="descr">
                <?= $text; ?>
            </div>
        <?php
        endif;
        ?>
        <?php
        if (is_singular('publications')) {
            $ID         = get_the_ID();
            $sector     = get_field('publication_sector', $ID);
            $offer_type = get_field('offer_type', $ID);
            $custom     = '';
            $type       = get_field("publication_type", $ID);
            if( $type == "podcast" ):
                $custom     = get_field('podcast', $ID);
                $custom     = (!empty($custom['banner_tag']))?$custom['banner_tag']:'';
            endif;
            ?>
            <div class="tags project-tags">
                <?php
                if (!empty($offer_type)):
                    ?>

                    <a href="<?= get_field('page_offre_'.$offer_type,'options')['url'] ?>" class="tag">
                        <span><?= ($offer_type == "digital")?__("Digital", "assystem"):__("Ingénierie", "assystem"); ?></span>
                    </a>
                    <?php
                endif;
                if (!empty($sector)):
                    ?>
                    <a href="<?= get_permalink($sector->ID); ?>" class="tag">
                        <span><?= $sector->post_title; ?></span>
                    </a>
                <?php
                endif;
                if (!empty($custom)):
                    ?>
                    <div class="tag no-cursor">
                        <?= $custom; ?>
                    </div>
                <?php
                endif;
                ?>
            </div>
            <?php
        }
        if (is_singular('reference')) {
            $ID = get_the_ID();
            $sector = get_field('sector', $ID);
            $country = get_field('country', $ID);
            $offer_type = get_field('offer_type', $ID);
            ?>
            <div class="tags project-tags">
                <?php
                if (!empty($offer_type)):
                    ?>

                    <a href="<?= get_field('page_offre_'.$offer_type,'options')['url'] ?>" class="tag">
                        <span><?= ($offer_type == "digital")?__("Digital", "assystem"):__("Ingénierie", "assystem"); ?></span>
                    </a>
                <?php
                endif;
                if (!empty($sector)):
                    if (!is_array($sector)):
                        ?>
                        <a href="<?= get_permalink($sector->ID); ?>" class="tag">
                            <span><?= $sector->post_title; ?></span>
                        </a>
                    <?php
                    else:
                        foreach ($sector as $item_sector):
                            ?>
                            <a href="<?= get_permalink($item_sector->ID); ?>" class="tag">
                                <span><?= $item_sector->post_title; ?></span>
                            </a>
                        <?php
                        endforeach;
                    endif;
                endif;
                if (!empty($country)):
                    if (!is_array($country)):
                        ?>
                        <a href="<?= get_permalink($country->ID); ?>" class="tag">
                            <span><?= $country->post_title; ?></span>
                        </a>
                    <?php
                    else:
                        foreach ($country as $item_country):
                            ?>
                            <a href="<?= get_permalink($item_country->ID); ?>" class="tag">
                                <span><?= $item_country->post_title; ?></span>
                            </a>
                        <?php
                        endforeach;
                    endif;
                endif;
                ?>
            </div>
            <?php
        }
        ?>
        </div>
    </section>

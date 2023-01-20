<?php
/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */
?>
<!--<p>Block Map Pays</p>-->
<section class="block-map-country v-eco">
    <div class="container">
        <div class="row">
            <div class="col-12 block-map-country-content">
            <?php if (!empty($title)): ?>
                <div class="block_section-title title-white">
                    <<?= $hn; ?> class="title"> <?= $title; ?> </<?= $hn; ?> >
                </div>
            <?php endif; ?>
            <ul class="addresses-country without-style row collapse">
                <?php
                if (!empty($locals)):
                    foreach ($locals as $local):
                        ?>
                        <li class="address-country col-12 col-md-6 col-lg-4">
                            <div class="name">
                                <?= $local->post_title; ?>
                            </div>
                            <?php
                            $sectors = get_field("sector", $local->ID);
                            if (!empty($sectors)):
                                if (!is_array($sectors)) {
                                    $sectors = array($sectors);
                                } ?>
                                <ul class="tags hashtags without-style upp medium">
                                    <?php
                                    foreach ($sectors as $sector):
                                        $sector = get_post($sector);
                                        ?>
                                        <li><a href="<?= get_permalink($sector->ID); ?>"
                                               class="tag">#<?= $sector->post_title; ?></a></li>
                                    <?php
                                    endforeach;
                                    ?>
                                </ul>
                            <?php
                            endif;
                            ?>
                            <div class="details">
                                <?= nl2br($local->post_content); ?>
                            </div>
                        </li>
                    <?php
                    endforeach;
                endif;
                ?>
            </ul>
            <?php if (!empty($locals) && count($locals) >= 6) { ?>
                <div class="ctas-center">
                    <div class="load-more-loading"></div>
                    <div class="cta">
                        <a href="javascript:void(0);" role="button" class="btn btn-primary bg-white small" id="load-more" data-target="<?= $country_id ?>">
                            <div class="text"><?= __("Voir toutes les agences", "assystem"); ?></div>
                            <div class="circle"></div>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    </div>
</section>

<?php
/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */

if( $display_mode == "horizontal" ) {
    ?>
    <!-- Section - Banner Homepage for Career -->
    <section class="banner-switch banner-switch_<?= (!empty($bgcolor)?$bgcolor:'pink'); ?> <?= (!empty($display_as_banner) && $display_as_banner == "yes")?'banner-switch_career':'banner-switch_hp-career'; ?>">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="banner-switch_mask">
                        <?php
                        if( !empty($image) && !empty($image['url']) ):
                            if (is_admin()){ ?>
                                <img class="img" src="<?= $image['url'] ?>" alt="test" />
                            <?php }else { ?>
                                <img class="img b-lazy" src="<?= get_stylesheet_directory_uri(); ?>/assets/images/lazy/placeholder.jpg" data-src="<?= $image['url'] ?>" alt="" />
                           <?php }
                        endif;
                        ?>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="banner-switch_content">
                        <?php
                        if (!empty($overtitle)):
                            ?>
                            <div class="sub-title category"><?= $overtitle ?></div>
                            <?php
                        endif;
                        ?>
                        <?php
                        if (!empty($title)):
                        ?>
                        <<?= $hn ?> class="title"><?= $title ?>
                    </<?= $hn ?>>
                    <?php
                    endif;
                    ?>
                    <?php
                    if (!empty($text)):
                        ?>
                        <div class="description">
                            <?= $text ?>
                        </div>
                        <?php
                    endif;
                    ?>
                    <?php
                    if (!empty($cta_link['url']) && !empty($cta_label)):
                        ?>
                        <div class="cta">
                            <a href="<?= $cta_link['url'] ?>" class="btn btn-primary bg-white small">
                                <div class="text"><?= $cta_label ?></div>
                                <div class="circle"></div>
                            </a>
                        </div>
                        <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
        </div>
    </section>
    <?php
} else {
    ?>
    <!--        Section 1 - Banner Image Text Cta Vertical -->
    <section class="banner-switch banner-switch_pink banner-switch_vertical">
            <div class="banner-switch_mask">
                <?php
                if( !empty($image) && !empty($image['url']) ):
                    ?>
                    <img class="img" src="<?= $image['url']; ?>" alt="" />
                    <?php
                endif;
                ?>
            </div>
            <div class="banner-switch_content">
                <?php
                if( !empty($title) ):
                ?>
                <<?= $hn; ?> class="title"><?= $title ?></<?= $hn; ?>>
                <?php
                endif;
                if( !empty($cta_link) && !empty($cta_link['url']) && !empty($cta_label) ):
                    ?>
                    <div class="cta">
                        <a <?= !empty($cta_link['is_external'] && $cta_link['is_external'] == "on")?'target="_blank"':'' ?>  <?= !empty($cta_link['nofollow'] && $cta_link['nofollow'] == "on")?'rel="nofollow"':'' ?> href="<?= $cta_link['url'] ?>" class="btn btn-primary bg-white small">
                            <div class="text"><?= $cta_label; ?></div>
                            <div class="circle"></div>
                        </a>
                    </div>
                    <?php
                endif;
                ?>
            </div>
    </section>
    <?php
}
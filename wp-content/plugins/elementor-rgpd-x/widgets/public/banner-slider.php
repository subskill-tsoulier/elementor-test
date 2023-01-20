<?php
/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */
global $special_color;
?>
<!--  Section : Bannière Slider Projets -->
<section class="banner-slider banner-switch banner-switch_light banner-switch_right <?= !empty($special_color)?"special-" .$special_color:''; ?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="swiper-ass_wrapper">
                    <!-- Slider main container -->
                    <div class="banner-slider_swiper swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <?php
                            foreach ($settings['list'] as $key_item => $item):
                            if ($item['display_switch_on'] == "yes"):
                            ?>
                            <div class="swiper-slide">
                                <div class="banner-slider_item" <?= ($key_item == 0 && !empty($hide_first) && $hide_first == "yes")?'data-class="hide"':'' ?> data-title-pagination="<?= !empty($item['post_title'])?$item['post_title']:'' ?>" data-desc-pagination="<?= (!empty($item['post_excerpt']))?wp_trim_words($item['post_excerpt'], 10):''; ?>">
                                    <div class="row">
                                        <div class="col-12 col-lg-7">
                                            <div class="banner-switch_mask">
                                                <?php
                                                if( !empty($item['image']) ):
                                                    ?>
                                                    <img class="img <?= (count($settings['list']) > 1)?'swiper-lazy':'' ?>" <?= (count($settings['list']) > 1)?'data-':''; ?>src="<?= $item['image']; ?>" alt="">
                                                <?php
                                                endif;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-5">
                                            <div class="banner-switch_content">
                                                <<?= $item['hn'] ? $item['hn'] : 'h1'; ?> class="title specific-title offset"><?= __("SWITCH <br>ON", "assystem"); ?>
                                                    <span class="sub-title-inside">
                                                        <img src="<?= get_stylesheet_directory_uri() ?>/assets/images/baseline_hp.svg" alt="Engineering & Digital for energy transition" />
                                                    </span>
                                                </<?= $item['hn'] ? $item['hn'] : 'h1'; ?>>
                                                <?php
                                                if(!empty($item['post_excerpt'])) :
                                                ?>
                                                <p class="description"><?= $item['post_excerpt']; ?></p>
                                                <?php
                                                endif;
                                                ?>
                                                <?php
                                                if( !empty($item['cta_link']) && !empty($item['cta_link']['url']) && !empty($item['cta_label']) ):
                                                    ?>
                                                    <div class="cta">
                                                        <a href="<?= $item['cta_link']['url'] ?>" <?= (!empty($item['cta_link']['is_external']) && $item['cta_link']['is_external'] == "on")?'target="_blank"':'' ?> <?= (!empty($item['cta_link']['nofollow']) && $item['cta_link']['nofollow'] == "on")?'rel="nofollow"':'' ?> class="btn btn-primary medium bg-white">
                                                            <div class="text"><?= (!empty($item['cta_label']))?$item['cta_label']:__("Voir", "assystem"); ?></div>
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
                        </div>
                        <?php
                        else:
                        ?>
                        <div class="swiper-slide">
                            <div class="banner-slider_item banner-slider_item-desc"  data-class="<?= ($key_item == 0 && !empty($hide_first) && $hide_first == "yes")?'hide':'' ?>" data-title-pagination="<?= !empty($item['post_title'])?$item['post_title']:'' ?>" data-desc-pagination="<?= (!empty($item['post_excerpt']))?wp_trim_words($item['post_excerpt'], 10):''; ?>">
                                <div class="row">
                                    <div class="col-12 col-lg-7">
                                        <div class="banner-switch_mask">
                                            <?php
                                            if( !empty($item['image']) ):
                                                ?>
                                                <img class="img <?= (count($settings['list']) > 1)?'swiper-lazy':'' ?>" <?= (count($settings['list']) > 1)?'data-':''; ?>src="<?= $item['image']; ?>" alt="">
                                            <?php
                                            endif;
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-5 bright">
                                        <div class="banner-switch_content">
                                            <?php
                                            if (!empty($item['post_title'])):
                                            ?>
                                            <<?= $item['hn'] ? $item['hn'] : 'h2'; ?> class="title offset"> <?= $item['post_title'] ?> </<?= $item['hn'] ? $item['hn'] : 'h2'; ?>>
                                        <?php
                                        endif;
                                        ?>
                                        <?php
                                        if(!empty($item['post_excerpt'])) :
                                            ?>
                                            <p class="description"><?= $item['post_excerpt']; ?></p>
                                        <?php
                                        endif;
                                        ?>

                                            <?php
                                            if( !empty($item['cta_link']) && !empty($item['cta_label']) ):
                                                ?>
                                                <div class="cta">
                                                    <a href="<?= $item['cta_link']['url'] ?>" <?= (!empty($item['cta_link']['is_external']) && $item['cta_link']['is_external'] == "on")?'target="_blank"':'' ?> <?= (!empty($item['cta_link']['nofollow']) && $item['cta_link']['nofollow'] == "on")?'rel="nofollow"':'' ?> class="btn btn-primary small bg-white">
                                                        <div class="text"><?= (!empty($item['cta_label']))?$item['cta_label']:__("Voir", "assystem"); ?></div>
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
                    </div>
                    <?php
                    endif;
                    endforeach;
                    ?>
                </div>
            </div>
            <?php
            if( is_array($settings['list']) && !empty($settings['list']) && count($settings['list']) > 1 ):
            ?>
            <!-- If we need pagination -->
            <div class="banner-slider_pagination-wrapper">
                <div class="swiper-pagination banner-slider_pagination"></div>
            </div>
            <?php
            endif;
            ?>
        </div>
    </div>
    </div>
</section>
<!-- -->

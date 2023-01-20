<?php
/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */
global $special_color;
?>
<!-- Block Full Quote -->
<?php if ( !empty($display_image) && $display_image == 'yes' ) { ?>
<section class="block-full-quote <?= (!empty($special_color))?"special-".$special_color:'' ?> <?= (!empty($bgcolor))?$bgcolor:'bg-pink' ?>" <?php if (!empty($image)) { ?>style="background-image: url(<?= $image['url'] ?>)"<?php }; ?>>
    <?php } else { ?>
    <section class="block-full-quote <?= (!empty($special_color))?"special-".$special_color:'' ?> <?= (!empty($bgcolor))?$bgcolor:'bg-pink' ?>">
        <?php } ?>
        <?php if(!empty($filtre) && $filtre == 'yes'): ?>
            <div class="opacity"></div>
        <?php endif;?>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php if (!empty($title)) { ?>
                    <div class="block_section-title">
                        <<?= $hn ;?> class="title">
                        <?= $title ;?>
                    </<?= $hn ;?>>
                </div>
                <?php } ?>
                <blockquote class="content">
                    <?php if (!empty($display_quote) && $display_quote == 'yes') { ?>
                        <i class="icon icon-quote"></i>
                    <?php } ?>
                    <?php if (!empty($subtitle)) : ?>
                        <div class="title">
                            <?= $subtitle;?>
                            <?php
                            if( empty($text) ) {
                                // If no text and "guillemets" > display after title
                                if (!empty($display_quote) && $display_quote == 'yes' && (empty($display_quote_after_name) || $display_quote_after_name != "yes")) { ?>
                                    <i class="icon icon-end icon-quote"></i>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($text)) : ?>
                        <div class="quote">
                            <?= $text ;?>
                            <?php if (!empty($display_quote) && $display_quote == 'yes' && (empty($display_quote_after_name) || $display_quote_after_name != "yes")) { ?>
                                <i class="icon icon-end icon-quote"></i>
                            <?php } ?>
                        </div>
                    <?php endif;?>
                    <?php if (empty($display_quote) || $display_quote != 'yes') { ?>
                        <div class="ctas-left col-lg-9">
                            <?php
                            if( !empty($cta_link_1) && !empty($cta_label_1) ):
                                ?>
                                <div class="cta-container col-lg-5 col-md-5 col-xs-12">
                                    <div class="cta">
                                        <a href="<?= !empty($cta_link_1) ? $cta_link_1 : '#'?>" class="btn btn-primary bg-light small">
                                            <div class="text"><?php echo $cta_label_1; ?></div>
                                            <div class="circle"></div>
                                        </a>
                                    </div>
                                </div>
                                <?php
                            endif;
                            //
                            if( !empty($cta_link_2) && !empty($cta_label_2) ):
                                ?>
                                <div class="cta-container col-lg-5 col-md-5 offset-lg-2 offset-md-2 col-xs-12">
                                    <div class="cta">
                                        <a href="<?= !empty($cta_link_2) ? $cta_link_2 : '#'?>"
                                           class="btn btn-primary bg-light small">
                                            <div class="text"><?php echo $cta_label_2; ?></div>
                                            <div class="circle"></div>
                                        </a>
                                    </div>
                                </div>
                                <?php
                            endif;
                            ?>
                        </div>
                    <?php } ?>
                </blockquote>
                <figcaption>
                    <?php
                    if( !empty($name) || !empty($function) ):
                        ?>
                        <div class="author">
                            <span><?= $name ?></span>
                            <span><?= $function ?></span>
                        </div>
                        <?php if (!empty($display_quote) && $display_quote == 'yes' && (!empty($display_quote_after_name) && $display_quote_after_name == "yes")) { ?>
                        <i class="icon icon-end icon-quote"></i>
                    <?php } ?>
                        <?php
                    endif;
                    ?>
                </figcaption>
            </div>
        </div>
        </div>
    </section>
    <!-- -->
<?php
/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */
global $special_color;
?>
<!--        Section - Block Expert Word -->
<section class="block-expert-word <?= !empty($special_color)?'special-'.$special_color:'' ?>" id="expert-word">
    <div class="container">
        <div class="row reverse-mob">
            <div class="col-lg-6">
                <?php if( !empty($title) ) : ?>
                <div class="block_section-title">
                    <<?php echo $hn;?> class="title"> <?= $title ;?> </<?= $hn;?>>
                </div>
                <?php endif; ?>
                <div class="block-expert">
                <?php
                if( !empty($post) && !empty($quote) ):
                    $tag    =   !empty($quote["quote_tag"])?$quote["quote_tag"]:'';
                    if( !empty($tag) ):
                        ?>
                        <div class="new-tag">
                            <?= (!empty($tag))?$tag:'' ?>
                        </div>
                        <?php
                    endif;
                    ?>
                    <?php
                    $title  =   !empty($quote["quote_title"])?$quote["quote_title"]:'';
                    if( !empty($title) ):
                        ?>
                        <h3><?= $title; ?></h3>
                        <?php
                    endif;
                    $text   =   $quote["quote"];
                    if( !empty($text) ):
                        ?>
                        <div class="block-expert-descr">
                            <?= nl2br($text); ?>
                        </div>
                        <?php
                    endif;
                    ?>
                    <div class="block-expert-link">
                        <a href="<?= get_permalink($post->ID); ?>" class="btn btn-secondary"><?= __("Voir plus", "assystem"); ?></a>
                    </div>
                    <?php
                    if( !empty($author) ):
                        $fname      =   get_field("firstname", $author->ID);
                        $lname      =   get_field("lastname", $author->ID);
                        $function   =   get_field("function", $author->ID);
                        ?>
                        <div class="block-expert-author">
                            <div class="name">
                                <?= (!empty($fname))?$fname:''; ?> <?= (!empty($lname))?$lname:''; ?>
                            </div>
                            <?php
                            if (!empty($function)):
                            ?>
                            <div class="job">
                                <?= $function; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php
                    endif;
                endif;
                ?>
            </div>
            </div>
            <div class="col-lg-6">
                <div class="person_mask">
                    <?php
                    $picture    = get_field("profil_picture", $author->ID);
                    if( !empty($picture) ):
                        $image_id   = $picture['ID'];
                        if ( !empty($image_id) ) {
                            $picture      = wp_get_attachment_image_src($image_id, 'parole-img');
                            $picture      = (!empty($picture))?$picture[0]:'';
                        };
                        if( !empty($picture) ):
                            if (is_admin()){ ?>
                                <img class="img" src="<?= $picture; ?>" alt="<?= ((!empty($fname))?$fname:'').' '.((!empty($lname))?$lname:'') ?>">
                            <?php }else { ?>
                                <img class="img b-lazy" src="<?= get_stylesheet_directory_uri(); ?>/assets/images/lazy/placeholder.jpg" data-src="<?= $picture; ?>" alt="<?= ((!empty($fname))?$fname:'').' '.((!empty($lname))?$lname:'') ?>">
                            <?php }
                        endif;
                    endif;
                    ?>
                    <?php
                    if( !empty($podcast_image) ): ?>
                        <img class="img" src="<?= $podcast_image; ?>">
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
        <?php
        if( !empty($cta_link) && !empty($cta_label) ):
            ?>
            <div class="ctas-center">
                <!-- html structure btn btn-primary -->
                <div class="cta">
                    <a href="<?= isset($cta_link) ? $cta_link['url'] : '#'?>" class="btn btn-primary bg-white small">
                        <div class="text"><?php echo $cta_label; ?></div>
                        <div class="circle"></div>
                    </a>
                </div>
            </div>
            <?php
        endif;
        ?>
    </div>
</section>
<!-- -->
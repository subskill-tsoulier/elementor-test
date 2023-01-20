<?php
/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */
?>
<section class="featured-document container">
    <div class="row">
            <div class="col-12 col-lg-10 offset-0 offset-lg-1">
                <div class="featured-document_content bg-light">
                    <div class="document">
                        <div class="img">
                            <?php
                            if( !empty($document_thumb) ):
                                // TODO : dynamize ALT
                                if (is_admin()){ ?>
                                    <img src="<?= $document_thumb ?>" alt="" />
                                <?php }else { ?>
                                    <img class="b-lazy" src="<?= get_stylesheet_directory_uri(); ?>/assets/images/lazy/featured-document.jpg" data-src="<?= $document_thumb ?>" alt="" />
                                <?php }
                            endif;
                            ?>
                        </div>
                        <?php if (!empty($title)) : ?>
                        <div class="title">
                            <?= $title ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="ctas-left">
                        <div class="cta">
                            <?php
                            if( !empty($document_file) ):
                                ?>
                                <a href="<?=$document_file ?>" target="_blank" class="btn btn-primary bg-white small">
                                    <div class="text"><?= __("Télécharger", "assystem"); ?></div>
                                    <div class="circle"></div>
                                </a>
                                <?php
                            endif;
                            ?>
                        </div>
                        <!-- -->
                        <?php
                        if ( !empty($cta_label) && !empty($cta_link) ):
                            ?>
                            <div class="link">
                                <a href="<?= $cta_link['url'] ?>" <?= !empty($cta_link['is_external'] && $cta_link['is_external'] == "on")?'target="_blank"':'' ?>  <?= !empty($cta_link['nofollow'] && $cta_link['nofollow'] == "on")?'rel="nofollow"':'' ?> class="btn btn-secondary"><?= $cta_label ?></a>
                            </div>
                            <?php
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- -->
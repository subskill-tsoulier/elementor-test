<?php
// Liste des news - remontée au choix  
// Dynamise le : 12/08/22
?>
<!-- Section - Block Publications Download-->
<section class="block-publications container">
    <?php if( !empty($title) ): ?>
        <div class="block_section-title">
            <<?= $hn; ?> class="title"><?= $title; ?></<?= $hn; ?>>
        </div>
    <?php endif; ?>
    <div class="row news-row">
        <?php if( !empty($posts) ): ?>
            <?php foreach( $posts as $post ): ?>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <article class="block-news">
                        <?php 
                        /* <div class="lang">
                            <a href="#"><img class="img" src="<?= get_stylesheet_directory_uri() ?>/assets/images/gb.svg" alt="" /></a>
                        </div>
                        */ ?>
                            <?php
                            if( !empty($post->category_name) ):
                            ?>
                        <div class="date">
                                <?= $post->category_name ?>
                        </div>
                            <?php
                            endif;
                            ?>
                        <h3 class="title-article">
                            <?= $post->post_title; ?>
                        </h3>
                        <a href="<?= get_permalink($post->ID); ?>" class="btn btn-secondary link"><?= !empty($post->cta_label)?$post->cta_label:__("Télécharger", "assystem"); ?></a>
                    </article>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>
<!-- -->

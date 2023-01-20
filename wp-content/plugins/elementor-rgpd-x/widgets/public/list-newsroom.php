<?php
// Liste des actualités - remontée automatique  
// Dynamise le : 12/08/22
?>
<!-- Section - Block NewsRoom -->
<!-- add bg-light pour avoir le fond bleu -->
<section class="block-newsroom container">
        <?php if( !empty($title) ): ?>
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="block_section-title">
                    <?php
                    if (is_singular('post')) {
                    ?>
                        <<?= $hn; ?> class="title"><?= __("Actualités connexes", "assystem"); ?></<?= $hn; ?>>
                    <?php
                    }else{
                        ?>
                        <<?= $hn; ?> class="title"><?= $title; ?></<?= $hn; ?>>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="row news-row">
            <?php if(!empty($posts)): ?>
                <?php foreach( $posts as $post ): ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                        <!-- Section - Block Article -->
                        <article class="block-news">
                            <?php
                            if( !empty($display_image) && $display_image == "yes" ) {
                                $image          = '';
                                $image_id       = get_post_thumbnail_id($post->ID);
                                if ( !empty($image_id) ) {
                                    $image      = wp_get_attachment_image_src($image_id, 'newsroom-list-img');
                                    $image      = (!empty($image))?$image[0]:'';
                                };
                                ?>
                                <div class="pic bg-img b-lazy" <?= (!empty($image) && $image != false)?'data-src="'.$image.'"':''; ?>>
                                    <?php
                                    $post_categories = wp_get_post_terms($post->ID, 'category');
                                    if( !empty($post_categories) ):
                                        ?>
                                        <div class="tags">
                                            <div class="tag"><?= $post_categories[0]->name; ?></div>
                                        </div>
                                        <?php
                                    endif;
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="date">
                                <?= date("d.m.Y",strtotime($post->post_date)); ?>
                            </div>
                            <h3 class="title-article">
                                <?= $post->post_title; ?>
                            </h3>
                            <a href="<?= get_permalink($post->ID); ?>" class="btn btn-secondary link"><?= __("Voir plus", "assystem"); ?></a>
                        </article>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
            <?php
            if( !empty($settings['cta_link']) ):
                ?>
                <div class="ctas-center">
                    <div class="cta">
                        <a href="<?= get_permalink($settings['cta_link']) ?>" class="btn btn-primary bg-light small">
                            <div class="text"><?= $settings['cta_label']; ?></div>
                            <div class="circle"></div>
                        </a>
                    </div>
                </div>
                <?php
            endif;
            ?>
</section>
<!-- -->
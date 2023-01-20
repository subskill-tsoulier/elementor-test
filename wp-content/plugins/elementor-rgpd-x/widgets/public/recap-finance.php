<?php
// Bloc Recap finance (document) 
// overtitle
// title
// cta_link_1
// cta_label_1
// cta_link_2
// cta_label_2
// ###########
// post_id
// ###########
// agenda_title
// agenda_background
// Dynamise le : 12/08/2022
?>
<!-- Block Multiple Elements -->
<section class="block-publications block-multiple container">
    <div class="row publications">
        <div class="col-lg-4 col-md-6 col-12">
            <div class="publication">
                <div class="publication-title">
                    <?php
                    if( !empty($overtitle) ):
                    ?>
                    <div class="new-tag">
                        <?= $overtitle; ?>
                    </div>
                    <?php
                    endif;
                    ?>
                    <div class="icon center-block mb-3 mt-3">
                        <?php
                        if( !empty($pictogramme) && !empty($pictogramme['url']) ):
                            ?>
                            <img src="<?= $pictogramme['url'] ?>" alt="<?= $pictogramme['alt'] ?>" />
                            <?php
                        endif;
                        ?>
                    </div>
                    <?php if( !empty($title) ) : ?>
                    <p><?= $title ?></p>
                    <?php endif; ?>
                </div>
                <div class="ctas-center">
                    <?php
                    if( !empty($cta_link_1) && !empty($cta_label_1) ):
                        ?>
                        <div class="cta">
                            <a <?= !empty($cta_link_1['is_external'] && $cta_link_1['is_external'] == "on")?'target="_blank"':'' ?>  <?= !empty($cta_link_1['nofollow'] && $cta_link_1['nofollow'] == "on")?'rel="nofollow"':'' ?> href="<?= $cta_link_1['url'] ?>" class="btn btn-primary bg">
                                <div class="text"><?= $cta_label_1; ?></div>
                                <div class="circle"></div>
                            </a>
                        </div>
                        <?php
                    endif;
                    if( !empty($cta_link_2) && !empty($cta_label_2) ):
                        ?>
                        <a <?= !empty($cta_link_2['is_external'] && $cta_link_2['is_external'] == "on")?'target="_blank"':'' ?>  <?= !empty($cta_link_2['nofollow'] && $cta_link_2['nofollow'] == "on")?'rel="nofollow"':'' ?> href="<?= $cta_link_2['url'] ?>" class="btn btn-secondary"><?= $cta_label_2; ?></a>
                        <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
        <!-- -->
        <div class="col-lg-4 col-md-6 col-12 bg-light">
            <!-- Section - Block Article -->
            <?php
            if( !empty($financial_news) ) :
                ?>
                <article class="block-news">
                    <div class="date">
                        <?php
                        $financial_date =   $financial_news->post_date;
                        if( !empty($financial_date) ) {
                            $financial_date =   date("d.m.Y", strtotime($financial_date));
                        }
                        ?>
                        <p><?= $financial_date; ?></p>
                    </div>
                    <h3 class="title-article">
                        <?= $financial_news->post_title; ?>
                    </h3>
                    <?php
                    if( empty($post_automatic) || $post_automatic != "yes" ):
                    ?>
                    <div class="excerpt">
                        <?= $financial_news->post_excerpt; ?>
                    </div>
                    <?php
                    endif;
                    ?>
                    <?php
                    if( !empty($post_automatic) && $post_automatic ):
                        ?>
                        <a href="<?= get_permalink($financial_news->ID); ?>" class="btn btn-secondary link"><?php _e("Voir plus", "assystem"); ?></a>
                    <?php else:
                        if( !empty($financial_news->cta_label) && !empty($financial_news->cta_link) ):
                            ?>
                            <a href="<?= $financial_news->cta_link['url']; ?>" <?= !empty($financial_news->cta_link['is_external'] && $financial_news->cta_link['is_external'] == "on")?'target="_blank"':'' ?>  <?= !empty($financial_news->cta_link['nofollow'] && $financial_news->cta_link['nofollow'] == "on")?'rel="nofollow"':'' ?> class="btn btn-secondary link"><?= $financial_news->cta_label; ?></a>
                        <?php
                        endif;
                    endif; ?>
                </article>
                <?php
            endif;
            ?>
        </div>
        <!-- -->
        <div class="col-lg-4 col-md-6 col-12">
            <div class="agenda <?= (!empty($agenda_background)?$agenda_background:'bg-pink') ?>">
                <div class="title">
                    <?= $agenda_title; ?>
                </div>
                <ul class="without-style agenda-list">
                    <?php
                    if( !empty($agenda_posts) ):
                        foreach($agenda_posts as $agenda_post):
                            ?>
                            <li class="agenda-list_item">
                                <?php
                                $date   = get_field("date", $agenda_post->ID);
                                ?>
                                <div class="date"><?= $date; ?></div>
                                <div class="title"><?= get_field("title", $agenda_post->ID); ?></div>
                            </li>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </ul>
                <div class="actions">
                    <?php
                    if( !empty($agenda_link) && !empty($agenda_link['url']) ) :
                        ?>
                        <div class="cta">
                            <a <?= !empty($agenda_link['is_external'] && $agenda_link['is_external'] == "on")?'target="_blank"':'' ?>  <?= !empty($agenda_link['nofollow'] && $agenda_link['nofollow'] == "on")?'rel="nofollow"':'' ?> href="<?= $agenda_link['url'] ?>"  class="btn btn-primary bg-light">
                                <div class="text"><?php _e( "Voir tout l'agenda", "assystem" ); ?></div>
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
<!-- -->
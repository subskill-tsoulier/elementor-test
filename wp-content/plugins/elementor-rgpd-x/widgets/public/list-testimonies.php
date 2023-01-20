<?php

/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */
$testimonial_type   =   $_GET['testimonial_type'];
?>
<section class="block-filters-bar bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 list-offers_filters block-filters-bar_list reverse large-bar">
                <aside id="form-filter-offers">
                    <form method="get" action="<?= get_permalink(get_the_ID()) ?>">
                        <div id="offers-filter-wrap">
                            <div id="offers-filter-inner">
                                <div class="card" id="collapse-type">
                                    <button class="opener"><?php _e("Tous les types", "assystem"); ?></button>
                                    <div class="list-group">
                                        <div class="list-group-item">
                                            <input class="styled-checkbox" type="checkbox" id="testimonial-type-article" name="testimonial_type[]" value="article" <?= (isset($testimonial_type) && !empty($testimonial_type) && in_array("article", $testimonial_type))?'checked="checked"':'' ?> />
                                            <label for="testimonial-type-article"><?= __("Article", "assystem"); ?></label>
                                        </div>
                                        <div class="list-group-item">
                                            <input class="styled-checkbox" type="checkbox" id="testimonial-type-podcast" name="testimonial_type[]" value="podcast" <?= (isset($testimonial_type) && !empty($testimonial_type) && in_array("podcast", $testimonial_type))?'checked="checked"':'' ?> />
                                            <label for="testimonial-type-podcast"><?= __("Podcast", "assystem"); ?></label>
                                        </div>
                                        <div class="list-group-item">
                                            <input class="styled-checkbox" type="checkbox" id="testimonial-type-video" name="testimonial_type[]" value="video" <?= (isset($testimonial_type) && !empty($testimonial_type) && in_array("video", $testimonial_type))?'checked="checked"':'' ?> />
                                            <label for="testimonial-type-video"><?= __("Vidéo", "assystem"); ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-sbt">
                                    <?php
                                    $args = array('text_cta' => 'Appliquer les filtres', 'bg' => 'bg-white');
                                    ?>
                                    <div class="cta">
                                        <button type="submit" class="btn btn-primary bg-white small">
                                            <div class="text"><?php echo __("Appliquer les filtres", "assystem"); ?></div>
                                            <div class="circle"></div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- -->
                        <?php
                        if( !empty($chips) ):
                            ?>
                            <div class="search-criteria">
                                <div class="search-criteria-container">
                                    <div class="tag-wrapper">
                                        <?php
                                        foreach ($chips as $chip) {
                                            ?>
                                            <span class="tag-search" data-code="<?= $chip['id'] ?>" data-collapse="<?= $chip['ref'] ?>"> <?= $chip['name']; ?><button role="button" aria-label="<?= __("Supprimer le filtre", "assystem"); ?>" class="close">x</button></span>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <a href="<?= get_permalink(); ?>" class="btn btn-reset"><?= __("Réinitialiser", "assystem"); ?></a>
                                </div>
                            </div>
                        <?php
                        endif;
                        ?>
                    </form>
                </aside>
            </div>
        </div>
    </div>
</section>
<section class="block-testimonials bg-light">
    <div class="container">
        <?php if (!empty($title)) : ?>
        <div class="row">
            <div class="col-12">
                <div class="block_section-title">
                    <<?= $hn; ?> class="title"><?= $title; ?></<?= $hn; ?>>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="row row-testi">
        <?php
        if ($the_query->have_posts()) :
            while ($the_query->have_posts()) :
                $the_query->the_post();
                $fname      =   get_field("firstname");
                $lname      =   get_field("lastname");
                $function   =   get_field("function");
                $type       =   get_field("testimonial_type");
                //
                $image      =   get_field("profil_picture");
                if (!empty($image)) {
                    $image  =   wp_get_attachment_image_src($image['ID'], 'testimony-thumb')[0];
                } else {
                    // TODO : default thumb with Assystem Logo
                }
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12 item-testi">
                    <div class="block-testimonial_item">
                        <div class="title">
                            <div class="heading">
                                    <span class="name">
                                        <?= (!empty($fname)) ? $fname : ''; ?> <?= (!empty($lname)) ? $lname : ''; ?>
                                    </span>
                                <!--                                <span class="category">--><? //= // (!empty($type))?$type:'article';
                                ?>
                                <!--</span>-->
                            </div>
                            <div class="img">
                                <?php
                                if (!empty($image)) :
                                    ?>
                                    <img src="<?= $image; ?>" alt="">
                                <?php
                                endif;
                                ?>
                            </div>
                        </div>
                        <div class="content">
                            <div class="title">
                                <?= get_the_title(); ?>
                            </div>
                            <div class="desc">
                                <?= get_the_excerpt(); ?>
                            </div>
                        </div>
                        <div class="actions">
                            <a href="<?= get_permalink(); ?>" class="btn btn-secondary"><?= __("Découvrir", "assystem"); ?></a>
                        </div>
                        <div class="icon-category <?= (!empty($type)) ? $type : 'article'; ?>"></div>
                    </div>
                </div>
            <?php endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
    <nav class="navigation pagination pagination-light" role="navigation">
        <div class="nav-links">
            <?php
            $big = 999999999;
            if ($paged == 1 && $the_query->max_num_pages > 1) {
                echo '<div class="prev page-numbers disabled"><i class="icon icon-article-prev"></i></div>';
            }
            echo paginate_links(array(
                // Plus d'info sur les arguments possibles : https://codex.wordpress.org/Function_Reference/paginate_links
                'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format'    => '?paged=%#%',
                'current'   => max(1, get_query_var('paged')),
                'total'     => $the_query->max_num_pages,
                'mid_size'  => 1,
                'prev_next' => true,
                'prev_text'     => '<',
                'next_text'     => '>'
            ));
            ?>
        </div>
    </nav>
    </div>
</section>
<!-- -->
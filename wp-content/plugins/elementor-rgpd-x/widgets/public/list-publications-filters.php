<?php
/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */
$categorieFilter                = !empty($_GET['category']) ? $_GET['category'] : [];
$sectorFilter                   = !empty($_GET['sector']) ? $_GET['sector'] : [];
?>
<section class="block-filters-bar">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="list-offers_filters block-filters-bar_list reverse large-bar">
                    <aside id="form-filter-offers">
                        <form method="get" action="<?= get_permalink(get_the_ID()) ?>">
                            <div id="offers-filter-wrap">
                                <div id="offers-filter-inner">
                                    <div class="card" id="collapse-category">
                                        <button class="opener"><?= __("Catégorie", "assystem"); ?></button>
                                        <div class="list-group">
                                                <?php
                                                $num    =   0;
                                                foreach($categories as $key => $name):
                                                    $selected = '';
                                                    if (in_array($key, $categorieFilter)){
                                                        $selected = 'checked';
                                                    }
                                                    ?>
                                                    <div class="list-group-item">
                                                        <input <?= $selected ?>  class="styled-checkbox" type="checkbox" id="category-<?= $num ?>" name="category[]" value="<?= $key ?>">
                                                        <label for="category-<?= $num ?>"><?= $name ?></label>
                                                    </div>
                                                    <?php
                                                    $num++;
                                                endforeach;
                                                ?>
                                            </div>
                                    </div>
                                    <!-- -->
                                    <div class="card" id="collapse-secteur">
                                        <button class="opener"><?= __("Secteur", "assystem"); ?></button>
                                        <div class="list-group">
                                                <?php
                                                $num = 0;
                                                foreach($secteurs as $secteur):
                                                    $selected = '';
                                                    if (in_array($secteur->ID, $sectorFilter)){
                                                        $selected = 'checked';
                                                    }
                                                    ?>
                                                    <div class="list-group-item">
                                                        <input <?= $selected ?> class="styled-checkbox" type="checkbox" id="sector-<?= $num ?>" name="sector[]" value="<?= $secteur->ID; ?>">
                                                        <label for="sector-<?= $num ?>"><?= $secteur->post_title; ?></label>
                                                    </div>
                                                    <?php
                                                    $num++;
                                                endforeach;
                                                ?>
                                            </div>
                                    </div>
                                    <!-- -->
                                    <div class="card-sbt">
                                        <button type="submit" class="btn btn-primary bg-white small">
                                            <div class="text"><?php echo __( "Appliquer les filtres", "assystem" ); ?></div>
                                            <div class="circle"></div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- -->
                            <?php
                            if( !empty($get_categories) || !empty($get_sectors) ):
                                ?>
                                <div class="search-criteria">
                                    <div class="search-criteria-container">
                                        <div class="tag-wrapper">
                                            <?php
                                            foreach($chips as $chip) {
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
    </div>
</section>
<!-- Section - Block Publications Download-->
<section class="block-list-news">
    <div class="container">
        <ul role="list" class="row block-list-news_masonry without-style">
            <?php if( $the_query->have_posts() ) : ?>
                <?php
                while ( $the_query->have_posts() ) :
                    $the_query->the_post();
                    $image      = "";
                    $image_id   = get_post_thumbnail_id(get_the_ID());
                    if ( !empty($image_id) ) {
                        $image      = wp_get_attachment_image_src($image_id, 'publications-list-img');
                        $image      = (!empty($image))?$image[0]:'';
                    }
                    ?>
                    <li role="listitem" class="news-item col-md-6 col-lg-6 col-12" role="article">
                        <article class="block-news">
                            <?php
                            $publication_type   =   get_field("publication_type");
                            if( !empty($publication_type) ):
                                ?>
                                <div class="date tags hashtags">
                                    <?php
                                    /* <a href="<?= get_permalink($sector->ID); ?>" class="tag">#<?= $sector->post_title; ?></a> */
                                    switch( $publication_type ) {
                                        case "parole_expert":
                                            echo __("Parole d'expert", "assystem");
                                            break;
                                        case "document":
                                            echo __("Document", "assystem");
                                            break;
                                        case "podcast":
                                            echo __("Podcast", "assystem");
                                            break;
                                        case "rapport":
                                            echo __("Rapport", "assystem");
                                            break;
                                    }
                                    ?>
                                </div>
                                <?php
                            endif;
                            ?>
                            <h3 class="title-article"><?php the_title(); ?></h3>
                                <?php
                                // @TODO : dynamize auteur (?)
                                if( $publication_type == "parole_expert" ):
                                    $obj_author =   get_field("parole_dexpert");
                                    if( !empty($obj_author) && !empty($obj_author['author']) ):
                                        $lastname   =   get_field("lastname", $obj_author['author']->ID);
                                        $firstname  =   get_field("firstname", $obj_author['author']->ID);
                                        $function   =   get_field("function", $obj_author['author']->ID);
                                    ?>
                                    <div class="date">
                                        <?= $firstname; ?> <?= $lastname; ?><br />
                                        <?= $function ?>
                                    </div>
                                    <?php
                                    endif;
                                endif;
                                ?>
                            <a href="<?php the_permalink(); ?>" class="btn btn-secondary link"><?= __("Voir plus", "assystem"); ?></a>
                        </article>
                    </li>
                <?php endwhile;
                wp_reset_postdata();
            else: ?>
                <li><?= __("Aucun résultat trouvé", "assystem"); ?></li>
            <?php endif; ?>
        </ul>
        <nav class="navigation pagination pagination-light" role="navigation">
            <div class="nav-links">
                <?php
                $big = 999999999;
                if ($paged == 1 && $the_query->max_num_pages > 1){
                    echo '<div class="prev page-numbers disabled"><i class="icon icon-article-prev"></i></div>';
                }
                echo paginate_links( array(
                    // Plus d'info sur les arguments possibles : https://codex.wordpress.org/Function_Reference/paginate_links
                    'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format'    => '?paged=%#%',
                    'current'   => max( 1, get_query_var('paged') ),
                    'total'     => $the_query->max_num_pages,
                    'mid_size'  => 1,
                    'prev_next' => true,
                    'prev_text'     => '<',
                    'next_text'     => '>'
                ) );
                ?>
            </div>
        </nav>
    </div>
</section>
<!-- -->
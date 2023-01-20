<?php
// Bloc liste des articles avec filtres
// Dynamise le : 12/08/2022
$categorieFilter                = !empty($_GET['category']) ? $_GET['category'] : [];
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
                                        <div>
                                            <button class="opener"><?= __("Catégorie", "assystem"); ?></button>
                                            <div class="list-group">
                                                <?php
                                                $num    =   0;
                                                foreach($categories as $category):
                                                    $selected = "";
                                                    if (in_array($category->term_id, $categorieFilter)){
                                                        $selected = "checked";
                                                    }
                                                    ?>
                                                    <div class="list-group-item">
                                                        <input <?= $selected ?> class="styled-checkbox" type="checkbox" id="category-<?= $num ?>" name="category[]" value="<?= $category->term_id ?>">
                                                        <label for="category-<?= $num ?>"><?= $category->name ?></label>
                                                    </div>
                                                    <?php
                                                    $num++;
                                                endforeach;
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card" id="collapse-secteur">
                                        <div>
                                            <?php
                                            /*
                                             <button class="opener"><?= __("Secteur", "assytem"); ?></button>
                                            <div class="list-group">
                                                <?php
                                                $num = 0;
                                                foreach($secteurs as $secteur):
                                                    ?>
                                                    <div class="list-group-item">
                                                        <label for="sector-<?= $num ?>">
                                                            <input type="checkbox" <?= (!empty($get_sectors) && in_array($secteur->ID, array_values($get_sectors)))?'checked="checked"':''; ?>  class="uniform" id="sector-<?= $num ?>" name="sector[]" value="<?= $secteur->ID; ?>" />
                                                            <?= $secteur->post_title; ?>
                                                        </label>
                                                    </div>
                                                    <?php
                                                    $num++;
                                                endforeach;
                                                ?>
                                            </div>
                                             */
                                            ?>
                                        </div>
                                    </div>
                                    <div class="card-sbt">
                                        <div class="cta">
                                            <button type="submit" class="btn btn-primary bg-white small">
                                                <div class="text"><?php echo __( "Appliquer les filtres", "assystem" ); ?></div>
                                                <div class="circle"></div>
                                            </button>
                                        </div>
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
<!-- -->
<section class="block-list-news">
    <div class="container">
        <ul role="list" class="row block-list-news_masonry without-style">
            <?php if( $the_query->have_posts() ) : ?>
                <?php while ( $the_query->have_posts() ) :
                    $the_query->the_post();
                    ?>
                    <li role="listitem" class="news-item col-md-6 col-lg-6 col-12" role="article">
                        <!-- Section - Block Article -->
                        <article class="block-news">
                            <div class="date">
                                <?php
                                $post_category  =   get_the_category(get_the_ID());
                                if( !empty($post_category) ):
                                    ?><?= $post_category[0]->name; ?> |
                                <?php
                                endif;
                                ?>
                                <?php the_date(); ?>
                            </div>
                            <h3 class="title-article">
                                <?php the_title(); ?>
                            </h3>
                            <a href="<?php the_permalink(); ?>" class="btn btn-secondary link"><?= __("Voir plus", "assystem"); ?></a>
                        </article>
                    </li>
                <?php endwhile;
                wp_reset_postdata();
            else: ?>
                <li><?= __("Aucun résultat trouvé", "assystem"); ?></li>
            <?php endif; ?>
        </ul>
        <!-- -->
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

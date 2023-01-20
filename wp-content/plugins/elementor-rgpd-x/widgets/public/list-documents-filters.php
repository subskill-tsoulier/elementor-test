<?php
// Bloc liste des documents avec filtres
// Dynamise le : 12/08/2022
$yearFilter                = !empty($_GET['d-year']) ? $_GET['d-year'] : [];
?>
<section class="bg-light list-documents_view agendas documents-general-assembly">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <!--  add block search-bar-v2 without col-12 -->
                <div class="list-offers_filters block-filters-bar_list reverse large-bar">
                    <aside id="form-filter-offers">
                        <form method="get" action="<?= get_permalink(get_the_ID()) ?>">
                            <div id="offers-filter-wrap">
                                <div id="offers-filter-inner">
                                    <div class="card" id="collapse-year">
                                        <button class="opener"><?php _e("Toutes les années", "assystem"); ?></button>
                                        <div class="list-group">
                                            <?php
                                            foreach($years as $key => $year) :
                                                $selected = "";
                                                if (in_array($year, $yearFilter)){
                                                    $selected = "checked";
                                                }
                                                ?>
                                                <div <?= $selected ?> class="list-group-item">
                                                    <input class="styled-checkbox" type="checkbox" id="year-<?= $key ?>" name="d-year[]" value="<?= $year; ?>">
                                                    <label for="year-<?= $key ?>"><?= $year ?></label>
                                                </div>
                                            <?php
                                            endforeach;
                                            ?>
                                        </div>
                                    </div>
                                    <!-- -->
                                    <div class="card" id="collapse-category">
                                        <?php
                                        if( !empty($categories) ):
                                            ?>
                                            <button class="opener"><?= __("Toutes les catégories", "assystem"); ?></button>
                                            <div class="list-group">
                                                <?php
                                                foreach($categories as $key => $category) :
                                                    ?>
                                                    <div class="list-group-item">
                                                        <input class="styled-checkbox" type="checkbox" id="category-<?= $key ?>" name="category[]" value="<?= $category->term_id ?>">
                                                        <label for="category-<?= $key ?>"><?= $category->name ?></label>
                                                    </div>
                                                <?php
                                                endforeach;
                                                ?>
                                            </div>
                                        <?php
                                        endif;
                                        ?>
                                    </div>
                                    <!-- -->
                                    <div class="card-sbt">
                                        <div class="cta">
                                            <button type="submit" class="btn btn-primary bg-white small">
                                                <div class="text"><?php _e("Appliquer les filtres", "assystem"); ?></div>
                                                <div class="circle"></div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- -->
                            <?php
                            if( !empty($get_categories) || !empty($get_years) ):
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
        <!-- -->
        <div class="row">
            <div class="col-12 col-lg-12">
                <!--Block list offers -->
                <div class="list">
                    <?php if( $the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) :
                    $the_query->the_post();
                    ?>
                    <div class="list-documents-items">
                        <div class="list-documents-item">
                            <div class="documents-detail">
                                <h2 class="documents-title">
                                    <?php
                                    $file_to_dl   =   get_field("fichier");
                                    if( !empty($file_to_dl) && !empty($file_to_dl['url']) ) :
                                    ?>
                                    <a class="documents-link" href="<?= $file_to_dl['url']; ?>" target="_blank">
                                        <?php
                                        else:
                                        ?>
                                        <div class="documents-link">
                                            <?php
                                            endif;
                                            ?>
                                            <?php the_title();
                                            if( !empty($file_to_dl) && !empty($file_to_dl['url']) ) :
                                            ?>
                                    </a>
                                    <?php else: ?>
                            </div>
                            <?php endif; ?>
                            </h2>
                            <div class="detail">
                                <i class="icon-time"></i>
                                <?php
                                $date   =   get_field("date");
                                if( !empty($date) ):
                                    if( str_contains($date, "/") ) {
                                        $date   =   explode("/", $date);
                                        $date   =   $date[2]."-".$date[1]."-".$date[0];
                                        echo date_i18n("d F Y", strtotime($date));
                                    } else {
                                        $date   =   substr($date,0,4)."-".substr($date,4,2)."-".substr($date,6,2);
                                        echo date_i18n("d F Y", strtotime($date));
                                    }
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile;
                wp_reset_postdata();
                else: ?>
                    <div class="text-center"><?= __("Aucun résultat trouvé", "assystem"); ?></div>
                <?php endif; ?>
                <!-- -->
                <nav class="navigation pagination pagination-white" role="navigation">
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
        </div>
    </div>
    <!-- -->
    </div>
</section>

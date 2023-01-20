<?php
// Bloc liste des projets avec filtres 
// Dynamise le : 12/08/2022
$sectorFilter               = !empty($_GET['sector']) ? $_GET['sector'] : [];
$serviceFilter              = !empty($_GET['service']) ? $_GET['service'] : [];
$countryFilter              = !empty($_GET['country']) ? $_GET['country'] : [];
?>
<section class="block-filters-bar container">
    <div class="row">
        <div class="col-12 list-offers_filters block-filters-bar_list reverse large-bar">
            <aside id="form-filter-offers">
                <form method="get" action="<?= get_permalink(get_the_ID()) ?>">
                    <div id="offers-filter-wrap">
                        <div id="offers-filter-inner" class="filter-projects">
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
                            <div class="card" id="collapse-service">
                                <button class="opener"><?= __("Services", "assystem"); ?></button>
                                <div class="list-group">
                                    <?php
                                    $selected_1 = '';
                                    if (in_array("digital", $serviceFilter)){
                                        $selected_1 = 'checked';
                                    }
                                    ?>
                                    <div class="list-group-item">
                                        <input <?= $selected_1 ?> class="styled-checkbox" type="checkbox" id="service-0" name="service[]" value="digital">
                                        <label for="service-0"><?= __("Digital", "assystem"); ?></label>
                                    </div>
                                    <?php
                                    $selected_2 = '';
                                    if (in_array("ingenierie", $serviceFilter)){
                                        $selected_2 = 'checked';
                                    }
                                    ?>
                                    <div class="list-group-item">
                                        <input  <?= $selected_2 ?> class="styled-checkbox" type="checkbox" id="service-1" name="service[]" value="ingenierie">
                                        <label for="service-1"><?= __("Ingénierie", "assystem"); ?></label>
                                    </div>
                                </div>
                            </div>
                            <!-- -->
                            <div class="card" id="collapse-pays">
                                <button class="opener"><?= __("Pays", "assystem"); ?></button>
                                <div class="list-group">
                                    <?php
                                    $num = 0;
                                    foreach($pays as $pays_item):
                                        $selected = '';
                                        if (in_array($pays_item->ID, $countryFilter)){
                                            $selected = 'checked';
                                        }
                                        ?>
                                        <div class="list-group-item">
                                            <input <?= $selected ?> class="styled-checkbox" type="checkbox" id="pays-<?= $num ?>" name="country[]" value="<?= $pays_item->ID; ?>">
                                            <label for="pays-<?= $num ?>"><?= $pays_item->post_title; ?></label>
                                        </div>
                                        <?php
                                        $num++;
                                    endforeach;
                                    ?>
                                </div>
                            </div>
                            <div class="card-sbt">
                                <?php
                                $args = array( 'text_cta' => 'Appliquer les filtres', 'bg' => 'bg-white' );
                                ?>
                                <!-- html structure btn btn-primary -->
                                <div class="cta">
                                    <button type="submit" class="btn btn-primary bg-white small">
                                        <div class="text"><?php echo __( "Appliquer les filtres", "assystem" ); ?></div>
                                        <div class="circle"></div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="search-criteria">
                        <div class="search-criteria-container">
                            <?php
                            if( !empty($get_type) || !empty($get_sectors)  || !empty($get_pays) ):
                                ?>
                                <div class="tag-wrapper">
                                    <?php
                                    foreach($chips as $chip) {
                                        if (!empty($chip['name'])):
                                            ?>
                                            <span class="tag-search" data-code="<?= $chip['id'] ?>" data-collapse="<?= $chip['ref'] ?>"> <?= $chip['name']; ?><button role="button" aria-label="<?= __("Supprimer le filtre", "assystem"); ?>" class="close">x</button></span>
                                        <?php
                                        endif;
                                    }
                                    ?>
                                </div>
                                <a href="<?= get_permalink(); ?>" class="btn btn-reset"><?= __("Réinitialiser", "assystem"); ?></a>
                            <?php else : ?>
                                <div class="tag-wrapper"></div>
                            <?php
                            endif;
                            ?>
                        </div>
                    </div
                </form>
            </aside>
        </div>
    </div>
</section>
<!-- -->
<section class="block-list-projects block-list-projects">
    <div class="container">
        <ul class="row block-list-projects_masonry without-style">
            <?php if( $the_query->have_posts() ) : ?>
                <?php
                while ( $the_query->have_posts() ) :
                    $the_query->the_post();
                    $image      = '';
                    $image_id  = get_post_thumbnail_id(get_the_ID());
                    if ( !empty($image_id) ) {
                        $image      = wp_get_attachment_image_src($image_id, 'project-list-img');
                        $image      = (!empty($image))?$image[0]:'';
                    }
                    ?>
                    <li class="projects-item col-md-6 col-12" role="article">
                        <?php if (is_admin()) { ?>
                        <div class="block_preview-project" <?= (!empty($image) && $image != false)?'style="background-image: url("' . $image. ')"':''; ?>>
                            <?php } else { ?>
                            <div class="block_preview-project b-lazy" <?= (!empty($image) && $image != false)?'data-src="'.$image.'"':''; ?>>
                                <?php } ?>
                                <div class="top">
                                    <ul class="tags hashtags without-style">
                                        <?php
                                        $sector_ref     =   get_field("sector");
                                        $country_ref    =   get_field("country");
                                        $type_ref       =   get_field("offer_type");
                                        $type_ref       =   (empty($type_ref))?"ingenierie":$type_ref;
                                        //
                                        if( !empty($sector_ref) ):
                                            if( !is_array($sector_ref) ) {
                                                ?>
                                                <li><a href="<?= get_permalink($sector_ref->ID); ?>" class="tag">#<?= $sector_ref->post_title; ?></a></li>
                                                <?php
                                            } else {
                                                foreach($sector_ref as $sector_item):
                                                    ?>
                                                    <li class="tag"><?= "#" . $sector_item->post_title ?></li>
                                                <?php
                                                endforeach;
                                            }
                                        endif;
                                        //
                                        if( !empty($type_ref) ):
                                            ?>
                                            <li><a href="#" class="tag">#<?= ($type_ref == "digital")?__("Digital", "assystem"):__("Ingénierie", "assystem"); ?></a></li>
                                        <?php
                                        endif;
                                        //
                                        if( !empty($country_ref) ):
                                            if( is_array($country_ref) ):
                                                foreach($country_ref as $c_ref):
                                                    ?>
                                                    <li><a href="<?= get_permalink($c_ref->ID); ?>" class="tag">#<?= $c_ref->post_title; ?></a></li>
                                                <?php
                                                endforeach;
                                            else:
                                                ?>
                                                <li><a href="<?= get_permalink($country_ref->ID); ?>" class="tag">#<?= $country_ref->post_title; ?></a></li>
                                            <?php
                                            endif;
                                        endif;
                                        //
                                        ?>
                                    </ul>
                                </div>
                                <div class="bottom">
                                    <a href="<?php the_permalink(); ?>" class="title">
                                        <?php the_title(); ?>
                                    </a>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-secondary white"><?= __("Lire plus", "assystem"); ?></a>
                                </div>
                            </div>
                    </li>
                <?php endwhile;
                wp_reset_postdata();
            else: ?>
                <li class="projects-item col-md-6 col-12" role="article">
                    <?= __("Aucun résultat trouvé", "assystem"); ?>
                </li>
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
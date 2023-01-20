<?php
/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */
?>
<section class="block-testimonials bg-light <?= $mobilehide ?>">
    <div class="container">
        <?php
        if( !empty($title) ):
        ?>
        <div class="row">
            <div class="col-12">
                <div class="block_section-title">
                    <<?= $hn ;?> class="title"><?= $title; ?></<?= $hn ;?>>
                </div>
            </div>
        </div>
        <?php
        endif;
        ?>
        <div class="row row-testi">
            <?php
            if ( !empty($posts) ):
                foreach($posts as $post) :
                    $fname      =   get_field("firstname", $post->ID);
                    $lname      =   get_field("lastname", $post->ID);
                    $function   =   get_field("function", $post->ID);
                    $type       =   get_field("testimonial_type", $post->ID);
                    //
                    $image      =   get_field("profil_picture", $post->ID);
                    if( !empty($image) ) {
                        $image  =   wp_get_attachment_image_src($image['ID'], 'testimony-img')[0];
                    } else {

                        // TODO : default thumb with Assystem Logo
                    }
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="block-testimonial_item">
                        <div class="title">
                            <div class="heading">
                                <span class="name">
                                    <?= (!empty($fname))?$fname:''; ?> <?= (!empty($lname))?$lname:''; ?>
                                </span>
<!--                                <span class="category"></span>-->
                            </div>
                            <div class="img">
                                <?php
                                if( !empty($image) ):
                                    if (is_admin()){ ?>
                                        <img src="<?= $image; ?>" alt="">
                                    <?php }else { ?>
                                        <img class="b-lazy" src="<?= get_stylesheet_directory_uri(); ?>/assets/images/lazy/placeholder.jpg" data-src="<?= $image; ?>" alt="">
                                    <?php }
                                    endif;
                                    ?>
                            </div>
                        </div>
                        <div class="content">
                            <div class="title">
                                <?= $post->post_title ?>
                            </div>
                            <div class="desc">
                                <?= $post->post_excerpt; ?>
                            </div>
                        </div>
                        <div class="actions">
                            <a href="<?= get_permalink($post->ID); ?>" class="btn btn-secondary"><?= __("Découvrir", "assystem"); ?></a>
                        </div>
                        <div class="icon-category <?= (!empty($type))?$type:'article'; ?>"></div>
                    </div>
                </div>
                <?php
                endforeach;
            endif;
            ?>
        </div>
        <div class="ctas-center">
            <div class="cta">
                <a href="<?= !empty($cta_link) ? get_permalink($cta_link) : '#' ?>" class="btn btn-primary medium bg-white">
                    <div class="text"><?= (!empty($cta_label))?$cta_label : __( "Voir tous les témoignages", "assystem" ); ?></div>
                    <div class="circle"></div>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- -->

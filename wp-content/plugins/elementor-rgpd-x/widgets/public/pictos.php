<?php
// Bloc 3 pictogrammes en ligne
// title
// hn
// background-color (bg-white, bg-pink)
// list items
//  - image
//  - text
//  - cta_link (to CPT)
//  - cta_label
// Dynamise le : 12/08/2022
global $special_color;
?>
<!--       Block Icon Text Link White -->
<section class="block_icon-text-link <?= (!empty($bgcolor) ? $bgcolor : 'bg-light') ?> <?= (!empty($special_color))?"special-".$special_color:'' ?>">
    <div class="container">
        <?php if( !empty($title) ) : ?>
        <div class="row">
            <div class="col-12">
                <div class="block_section-title ">
                    <<?= $hn; ?> class="title"><?= $title; ?></<?= $hn; ?>>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="row items_icon-text-link justify-content-md-center">
            <?php
            if (!empty($list)):
                foreach ($list as $item) :
                    ?>
                    <div class="col-12 col-lg-3">
                        <div class="icon-text-link">
                            <?php
                            if (!empty($item['image']) && !empty($item['image']['url'])) :
                                ?>
                                <div class="icon-img"><img class="img b-lazy" src="<?= get_stylesheet_directory_uri() ?>/assets/images/lazy/placeholder.jpg" data-src="<?= $item['image']['url']; ?>" alt=""/></div>
                            <?php
                            endif;
                            ?>
                            <div class="text"><?= $item['text'] ?></div>
                            <?php
                            if(!empty($item['cta_link']) && !empty($item['cta_link']['url'])):
                                ?>
                            <div class="action">
                                <div class="cta">
                                    <a href="<?= $item['cta_link']['url'] ?>"
                                        <?= (!empty($item['cta_link']['is_external']) && $item['cta_link']['is_external'] == "yes")?'target="_blank"':'' ?>
                                            class="btn btn-secondary"><?= $item['cta_label']; ?></a>
                                </div>
                            </div>
                            <?php
                            endif;
                            ?>
                        </div>
                    </div>
                <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</section>
<!-- -->
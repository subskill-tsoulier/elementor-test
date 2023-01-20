<?php
// WYSIWIG + RESSOURCES (type livre blanc) 
// Dynamise le : 12/08/22
?>
<!--        Section - Block Double Wysiwyg-->
<!-- add "blue-block" ou "violet-block" pour les déclinaisons en violet ou en bleu ou enlever si couleur classique -->
<section class="block-wysiwyg block-double-wysiwyg container">
    <div class="row">
        <?php if( !empty($title) ): ?>
        <div class="col-lg-6">
            <div class="block_section-title">
                <<?= $hn; ?> class="title"><?= $title; ?></<?= $hn; ?>>
            <?= $text ?>
        </div>
    </div>
    <?php endif; ?>
    <div class="col-lg-5 offset-lg-1 center-block">
        <?php
        if( !empty($image) && isset($image['url']) ) {
            ?>
            <img src="<?= $image['url'] ?>" alt="" />
            <?php
        }
        if( !empty($cta_link) && !empty($cta_label) ) {
            // url
            // nofollow
            // is_external
            // custom_attributes
            ?>
            <!-- html structure btn btn-primary -->
            <div class="cta">
                <a <?= !empty($cta_link['is_external'] && $cta_link['is_external'] == "on")?'target="_blank"':'' ?>  <?= !empty($cta_link['nofollow'] && $cta_link['nofollow'] == "on")?'rel="nofollow"':'' ?> href="<?= $cta_link['url'] ?>" class="btn btn-primary">
                    <div class="text"><?= $cta_label; ?></div>
                    <div class="circle"></div>
                </a>
            </div>
            <?php
        }
        ?>
    </div>
    </div>
</section>
<!-- -->
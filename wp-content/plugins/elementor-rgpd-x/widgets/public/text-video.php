<?php
// Bloc Wysiwyg + Video
// title
// hn
// text
// video_type + URL
// Dynamise le : 12/08/2022
?>
<!--        Section - Block Double Wysiwyg-->
<!-- add "blue-block" ou "violet-block" pour les déclinaisons en violet ou en bleu ou enlever si couleur classique -->
<section class="block-wysiwyg block-double-wysiwyg with-embed container">
    <div class="row">
        <?php if( !empty($title) ) : ?>
        <div class="col-lg-6">
            <div class="block_section-title">
                <<?= $hn; ?> class="title"><?= $title; ?></<?= $hn; ?>>
            <?= $text; ?>
        </div>
    </div>
    <?php endif; ?>
        <div class="col-lg-6 center-block">
            <div class="embed-responsive embed-responsive-16by9">
                <?php
                if( !empty($video_type) && !empty($video_html) ) {
                    echo $video_html;
                }
                ?>
            </div>
        </div>
    </div>
</section>
<!-- -->
<?php
// Bloc WYSIWYG simple
// Titre
// Texte
// Dynamise le : 12/08/2022 
global $special_color;
?>
<!--  Section - Block Simple Wysiwyg-->
<section class="block-podcast">
    <div class="container">
        <?php
        if( !empty($title) ):
        ?>
        <div class="block_section-title">
            <<?= $hn; ?> class="title"><?= $title; ?></<?= $hn; ?>>
        </div>
        <?php
        endif;
        if( !empty($rss) ):
        ?>
        <div class="row">
            <div class="col-lg-12 podcast-content">
                <?= (!empty($text))?$text:''; ?>
                <div class="cta">
                    <a href="javascript:void(0);" class="btn btn-primary bg-white small" data-target="<?= $rss ?>" data-height="<?= $height ?>">
                        <div class="text"><?= $cta_label; ?></div>
                        <div class="circle"></div>
                    </a>
                </div>
            </div>
        </div>
        <?php
        endif;
        ?>
    </div>
</section>
<!-- -->
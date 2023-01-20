<?php
// Bloc WYSIWYG simple
// Titre
// Texte
// Dynamise le : 12/08/2022 
global $special_color;
?>
<!--  Section - Block Simple Wysiwyg-->
<section class="block-wysiwyg block-simple-wysiwyg <?= $in_card?'block-simple-wysiwyg-with-card':'' ?> <?= !empty($bg_color)?$bg_color:'bg-white' ?> <?= (!empty($special_color))?"special-".$special_color:'' ?>">
    <div class="container">
        <?= $in_card?'<div class="bg-white">':''; ?>
        <?php
        if( !empty($title) ):
        ?>
        <div class="block_section-title">
            <<?= $hn; ?> class="title"><?= $title; ?></<?= $hn; ?>>
        </div>
        <?php
        endif;
        if( !empty($text) ):
        ?>
        <div class="row">
            <div class="col-lg-12">
                <?php if(is_single() && 'post' == get_post_type()) : ?>
                    <p class="date"><?php $post_date = get_the_date( 'j F Y' ); echo $post_date; ?></p>
                <?php
                endif;?>
                <?= $text; ?>
            </div>
        </div>
        <?php
        endif;
        ?>
    <?= $in_card?'</div>':''; ?>
    </div>
</section>
<!-- -->
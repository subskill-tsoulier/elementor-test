<?php
// Bloc colonne avec pictogramme x 3
// - Display du bloc bleu en dessous 
// Dynamise le : 12/08/2022
global $special_color;
?>
<!-- Section - Block Offers -->
<section class="block-offers <?= (!empty($special_color))?"special-".$special_color:"" ?> container">
    <?php if( !empty($title) ): ?>
        <div class="row">
        <<?= $hn ?>><?= $title; ?></<?= $hn ?>>
        </div>
    <?php endif; ?>
    <div class="row offers-row justify-content-between">
        <?php
        for( $i=1; $i <= 3; $i++):
            if( !empty($settings['display_col_'.$i]) && $settings['display_col_'.$i] == "yes" ) :
                ?>
                <?php if($settings['display_col_3'] == 'yes') : ?>
                <div class="col-lg-4 col-12 item">
                    <?php
                    if( !empty($settings['col_'.$i.'_icon']) && !empty($settings['col_'.$i.'_icon']['url']) ):
                        ?>
                        <div class="img">
                            <img class="b-lazy" src="<?= get_stylesheet_directory_uri() ?>/assets/images/lazy/placeholder.jpg" data-src="<?= $settings['col_'.$i.'_icon']['url'] ?>" alt="" />
                        </div>
                    <?php
                    endif;
                    ?>
                    <div class="name">
                        <?= $settings['col_'.$i.'_title'] ?>
                    </div>
                    <?php
                    if( !empty($settings['col_'.$i.'_subtitle']) ):
                        ?>
                        <div class="descr">
                            <p><?= $settings['col_'.$i.'_subtitle'] ?></p>
                        </div>
                    <?php
                    endif;
                    ?>
                    <?php if( !empty($settings['col_'.$i.'_title_col']) ): ?>
                        <p class="title-list"><?= $settings['col_'.$i.'_title_col'] ?></p>
                    <?php endif; ?>
                    <?= $settings['col_'.$i.'_text'] ?>
                </div>
                <?php else : ?>
                <div class="col-lg-6 col-12 item">
                    <?php
                    if( !empty($settings['col_'.$i.'_icon']) && !empty($settings['col_'.$i.'_icon']['url']) ):
                        ?>
                        <div class="img">
                            <img class="b-lazy" src="<?= get_stylesheet_directory_uri() ?>/assets/images/lazy/placeholder.jpg" data-src="<?= $settings['col_'.$i.'_icon']['url'] ?>" alt="" />
                        </div>
                    <?php
                    endif;
                    ?>
                    <div class="name">
                        <?= $settings['col_'.$i.'_title'] ?>
                    </div>
                    <?php
                    if( !empty($settings['col_'.$i.'_subtitle']) ):
                        ?>
                        <div class="descr">
                            <p><?= $settings['col_'.$i.'_subtitle'] ?></p>
                        </div>
                    <?php
                    endif;
                    ?>
                    <?php if( !empty($settings['col_'.$i.'_title_col']) ): ?>
                        <p class="title-list"><?= $settings['col_'.$i.'_title_col'] ?></p>
                    <?php endif; ?>
                    <?= $settings['col_'.$i.'_text'] ?>
                </div>
                <?php endif; ?>
            <?php
            endif; ?>
        <?php
        endfor;
        ?>
    </div>
    <?php
    if( !empty($display_double_cols) && $display_double_cols == "yes" ):
        ?>
        <div class="bracket"></div>
        <div class="bloc-color">
            <div class="row">
                <div class="col-lg-6 col-12 item">
                    <?= $double_cols_left; ?>
                </div>
                <div class="col-lg-6 col-12 item">
                    <?= $double_cols_right; ?>
                </div>
            </div>
        </div>
    <?php
    endif;
    ?>
</section>
<!-- -->
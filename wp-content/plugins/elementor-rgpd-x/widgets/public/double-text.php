<?php
/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */
global $special_color;
?>
<!-- Section - Block Wysiwyg V5-->
<section class="block-wysiwyg block-double-wysiwyg block-double-wysiwyg-icons">
    <div class="container-fluid p-0">
        <div class="row gx-0">
            <div class="col-lg-6 text-part <?= $col_left_bg ? $col_left_bg : 'bg-light' ?> <?= (!empty($special_color))?"special-".$special_color:'' ?>">
                <div class="heading-offer">
                    <?php
                    if (!empty($col_left_icon) && !empty($col_left_icon['url'])):
                        ?>
                        <div class="img"><img src="<?= $col_left_icon['url'] ?>" alt=""></div>
                    <?php
                    endif;
                    ?>
                    <?php
                    if (!empty($col_left_title)):
                        ?>
                        <div class="name">
                            <p><?= $col_left_title; ?></p>
                        </div>
                    <?php
                    endif;
                    ?>
                    <?= $col_left_text ?>
                </div>
            </div>
            <div class="col-lg-6 text-part <?= $col_right_bg ? $col_right_bg : 'bg-light' ?> <?= (!empty($special_color))?"special-".$special_color:'' ?>">
                <div class="heading-offer">
                    <?php
                    if (!empty($col_right_icon) && !empty($col_right_icon['url'])):
                        ?>
                        <div class="img"><img src="<?= $col_right_icon['url'] ?>" alt=""></div>
                    <?php
                    endif;
                    ?>
                    <?php
                    if (!empty($col_right__title)):
                        ?>
                        <div class="name">
                            <p><?= $col_right__title; ?></p>
                        </div>
                    <?php
                    endif;
                    ?>
                    <?= $col_right_text; ?>
                </div>
            </div>
        </div>
    </div>
</section>

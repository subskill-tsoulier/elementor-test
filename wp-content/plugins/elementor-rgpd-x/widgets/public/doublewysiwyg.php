<?php
/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */
global $special_color;
?>
<!-- Section - Block Double Wysiwyg-->
<section class="block-wysiwyg block-double-wysiwyg <?= (!empty($display_title) && $display_title != "yes")?'block-double-wysiwyg-with-card':''; ?> <?= !empty($bgcolor) ? $bgcolor : 'bg-light' ?> <?= (!empty($special_color))?"special-".$special_color:'' ?>">
    <div class="container">
    <?php
    if( !empty($display_title) && $display_title == "yes" ):
        ?>
        <?php
        if( !empty($title) ):
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="block_section-title">
                        <<?= $hn; ?> class="title"><?= $title; ?></<?= $hn; ?>>
                </div>
            </div>
            </div>
        <?php
        endif;
        ?>
    <?php
    endif;
    ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="double-part <?= (!empty($display_title) && $display_title != "yes" )?'bg-white':''; ?>">
                <?php
                if(!empty($left_title)):
                ?>
                <div class="block_section-title">
                    <<?= $hn_left; ?> <?= ($hn_left == "h2")?'class="title"':''; ?>><?= $left_title ?></<?= $hn_left; ?>>
            </div>
            <?php
            endif;
            ?>
            <?php
            if ( !empty($left_description) ):
                echo $left_description;
            endif;
            ?>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="double-part <?= (!empty($display_title) && $display_title != "yes" )?'bg-white':''; ?>">
            <?php
            if( !empty($right_title) ):
            ?>
            <div class="block_section-title">
                <<?= $hn_right; ?> <?= ($hn_right == "h2")?'class="title"':''; ?>><?= $right_title ?></<?= $hn_right; ?>>
        </div>
        <?php
        endif;
        ?>
        <?php
        if ( !empty($right_description) ):
            echo $right_description;
        endif;
        ?>
    </div>
    </div>
    </div>
    </div>
</section>
<!-- -->
<?php
/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */
?>
<section class="block-banner-contact bg-light">
    <div class="content">
        <?php
        if ( !empty($title) ):
            ?>
        <div class="title">
            <<?= $hn; ?>><?= $title; ?></<?= $hn; ?>>
        </div>
        <?php
        endif;
        ?>
    <?php
    if ($text):
        ?>
        <div class="descr">
            <p><?= $text; ?></p>
        </div>
    <?php
    endif;
    ?>
    </div>
</section>
<!-- -->
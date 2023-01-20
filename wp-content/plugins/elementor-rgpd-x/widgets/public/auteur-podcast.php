<?php
/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */
?>
<section class="block-expert-word-preview">
    <div class="preview">
        <div class="author">
            <div class="avatar">
                <?php
                if( !empty($profil_picture) ):
                    if (is_admin()){ ?>
                        <img src="<?= $profil_picture ?>" alt="<?= $firstname ?> <?= $lastname ?>" />
                    <?php }else { ?>
                        <img class="b-lazy" src="<?= get_stylesheet_directory_uri(); ?>/assets/images/lazy/placeholder.jpg" data-src="<?= $profil_picture ?>" alt="<?= $lastname ?> <?= $firstname ?>" />
                    <?php } ?>
                <?php
                endif;
                ?>
            </div>
            <div class="id">
                <p class="name">
                    <?= $firstname ?> <?= $lastname ?>
                </p>
                <p class="job">
                    <?= $function ?>
                </p>
            </div>
        </div>
        <div class="block-expert-descr">
            <?= $biography ?>
        </div>
</div>
</section>
<!-- -->

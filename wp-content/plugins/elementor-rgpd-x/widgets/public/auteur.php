<?php
/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */
?>
<section class="block-expert-word-preview container">
    <div class="row">
            <div class="col-12 col-lg-4">
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
                    <div class="block-share">
                        <?php
                        $share_url = urlencode(get_the_permalink());
                        ?>
                        <ul role="list" id="menu-socials" class="menu without-style">
                            <li role="listitem" class="menu-title">
                                <span><?= __("Partager", "assystem"); ?></span>
                            </li>
                            <li role="listitem" id="menu-item-6" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item  menu-item-6">
                                <a href="mailto:?subject=<?= urlencode(get_the_title()); ?>&body=<?= urlencode(__("Venez découvrir cette page : ", "assystem")); ?><?= $share_url; ?>" title="<?= __("Partager par mail", "assystem"); ?>" target="_blank"><i class="icon icon-full-mail"></i></a>
                            </li>
                            <li role="listitem" id="menu-item-6" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item  menu-item-6">
                                <a href="https://www.facebook.com/sharer.php?u=<?= $share_url; ?>"" title="<?= __("Partager sur Facebook", "assystem"); ?>" target="_blank"><i class="icon icon-facebook"></i></a>
                            </li>
                            <li role="listitem" id="menu-item-6" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item  menu-item-6">
                                <a href="https://www.linkedin.com/shareArticle/?mini=true&url=<?= $share_url; ?>" title="<?= __("Partager sur Linkedin", "assystem"); ?>" target="_blank"><i class="icon icon-linkedin"></i></a>
                            </li>
                            <li role="listitem" id="menu-item-6" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item  menu-item-6">
                                <a href="https://twitter.com/share?text=<?= get_the_title() ?>&url=<?= $share_url; ?>" title="<?= __("Partager sur Twitter", "assystem"); ?>" target="_blank"><i class="icon icon-twitter"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php if(isset($settings['text'])):?>
                <div class="col-12 col-lg-8">
                    <div class="text">
                        <?= $settings['text'] ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
</section>
<!-- -->

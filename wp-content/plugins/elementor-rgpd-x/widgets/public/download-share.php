<?php
// Bloc téléchargement + partage 
// Dynamise 17/08
global $special_color;
?>
<section class="block-news-details container bg-white <?= (!empty($special_color))?"special-".$special_color:""; ?>">
        <div class="row">
            <?php
            if ($settings['title']):
            ?>
            <div class="col-12">
                    <div class="block_section-title">
                        <<?= $settings['hn'] ?  $settings['hn'] : 'h2' ?> class="title"><?= $settings['title'] ?></<?= $settings['hn'] ?  $settings['hn'] : 'h2' ?>>
                </div>
            </div>
            <?php
            endif;
            ?>
            <div class="col-12 col-md-9 block-download <?= (!empty($special_color))?"special-".$special_color:""; ?>">
                <div class="files">
                        <?php
                        if (!empty($list)):
                            foreach ($list as $key_item => $item):
                                ?>
                                <a href="<?= $item['file']['url'] ?>" target="_blank" download class="btn btn-download"><i class="icon icon-download"></i><?= $item['title'] ?></a>
                            <?php
                            endforeach;
                        endif;
                        ?>
                    </div>
            </div>
            <div class="col-12 col-md-3">
                <?php
                if ( isset($display_share) && $display_share == 'yes' ):
                ?>
                <div class="block-share <?= (!empty($special_color))?"special-".$special_color:""; ?>">
                    <?php
                    $share_url = urlencode(get_the_permalink());
                    ?>
                    <ul role="list" id="menu-socials" class="menu without-style">
                        <li role="listitem" class="menu-title">
                            <?= __("Partager", "assystem"); ?>
                        </li>
                        <li role="listitem" id="menu-item-6" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item  menu-item-6">
                            <a href="mailto:?subject=<?= urlencode(get_the_title()); ?>&body=<?= urlencode(__("Venez découvrir cette page : ", "assystem")); ?><?= $share_url; ?>"
                               title="<?= __("Partager par mail", "assystem"); ?>"
                               target="_blank"
                               class="icon contact">
                            </a>
                        </li>
                        <li role="listitem" id="menu-item-6" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item  menu-item-6">
                            <a href="https://www.facebook.com/sharer.php?u=<?= $share_url; ?>" title="<?= __("Partager sur Facebook", "assystem"); ?>" target="_blank"
                            class="icon facebook"></a>
                        </li>
                        <li role="listitem" id="menu-item-6" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item  menu-item-6">
                            <a href="https://www.linkedin.com/shareArticle/?mini=true&url=<?= $share_url; ?>" title="<?= __("Partager sur Linkedin", "assystem"); ?>" target="_blank" class="icon linkedin"></a>
                        </li>
                        <li role="listitem" id="menu-item-6" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item  menu-item-6">
                            <a href="https://twitter.com/share?text=<?= get_the_title() ?>&url=<?= $share_url; ?>" title="<?= __("Partager sur Twitter", "assystem"); ?>" target="_blank" class="icon twitter"></a>
                        </li>
                    </ul>
                </div>
                <?php
                endif;
                ?>
            </div>
        </div>
</section>
<!-- -->
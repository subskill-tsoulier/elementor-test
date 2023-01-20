<?php
/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */
?>
<section class="block-anchors container">
    <div class="row">
        <ul class="col-lg-12 without-style">
            <?php
            foreach ($ancres as $key_item => $item):
                if ($item['title']):
                    if ($item['choose_anchor_type'] == "yes"):
                        ?>
                        <li class="anchor"><a href="#" class="anchor-link" data-anchor="<?= $item['selector'] ? $item['selector'] : "#" ?>"><?= $item['title'] ?></a></li>
                    <?php
                    else:
                        ?>
                        <li class="anchor"><a href="<?= $item['link'] ? $item['link']['url'] : "#" ?>" class="anchor-link"><?= $item['title'] ?></a></li>
                    <?php
                    endif;
                endif;
            endforeach;
            ?>
        </ul>
    </div>
</section>
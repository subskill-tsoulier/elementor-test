<?php
/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */
global $special_color;
?>
<section class="block-list-pictos container <?= !empty($bgcolor) ? $bgcolor:'bg-white'?> <?= (!empty($special_color))?"special-" . $special_color:'' ?>">
        <?php
        if ($settings['title']):
            ?>
            <div class="row">
                <div class="col-12">
                    <div class="block_section-title">
                        <<?= $settings['hn'] ?  $settings['hn'] : 'h2' ?> class="title"><?= $settings['title'] ?></<?= $settings['hn'] ?  $settings['hn'] : 'h2' ?>>
                </div>
            </div>
            </div>
        <?php
        endif;
        ?>
        <?php
        // Hack for bg-pink : gulp issue > impossible to get the right class conditions, so 'bgpink' is used to get right colors
        ?>
        <div class="row list-picto <?= !empty($bgcolor) ? $bgcolor:'bg-white'?> <?= (!empty($special_color))?"special-" . $special_color:'' ?>">
            <?php
            $is_even     = (count($settings['list']) % 2 == 0) ?true:false; // IMPAIR
            foreach ($settings['list'] as $key_item => $item) :
            ?>
            <div class="col-md-6 elem elem-<?= ($is_even)?'even':'odd'; ?>">
                <div class="list-picto-elem">
                    <i class="icon icon-check"></i>
                    <div class="title-picto">
                        <?= $item['text'] ?>
                    </div>
                </div>
            </div>
            <?php
            endforeach;
            ?>
        </div>
</section>
<!-- -->
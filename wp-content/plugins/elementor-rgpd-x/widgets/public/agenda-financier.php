<?php
/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */
global $special_color;
?>
<div class="agenda <?= !empty($bgcolor) ? $bgcolor : 'bg-pink'?> <?= !empty($special_color)?"special-" . $special_color:"" ?>">
    <?php
    if (!empty($settings['title'])):
    ?>
    <div class="title">
        <<?= $settings['hn'] ?>> <?= $settings['title'] ?> </<?= $settings['hn'] ?>>
    </div>
    <?php
    endif;
    ?>
    <ul class="without-style agenda-list">
    <?php
    foreach ($post_agenda_financier as $key_item => $item_agenda):
        $front_title        = get_field('title', $item_agenda->ID);
        $front_date_title   = get_field('date', $item_agenda->ID);
        ?>
        <li class="agenda-list_item">
            <div class="date"><?= $front_date_title ?></div>
            <div class="title"><?= $front_title ?></div>
        </li>
        <?php
    endforeach;
    ?>
</ul>
</div>
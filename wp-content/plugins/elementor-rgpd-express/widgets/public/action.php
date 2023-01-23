<?php
/**
 * Created by PhpStorm.
 * User: theosoulier
 * Date: 23/01/2023
 * Time: 10:32
 */
?>
<div class="container">
    <?php if (!empty($text)) : ?>
        <<?= $hn ?> class="title"><?= $text ?></<?= $hn ?>>
    <?php endif; ?>
</div>

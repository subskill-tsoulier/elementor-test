<?php
/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */
?>
<!--        Section - Block Text and Numbers -->
<section class="block-text-numbers container">
    <?php if( !empty($title) ) : ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="block_section-title">
                    <<?= $hn ;?> class="title"> <?=$title;?> </<?=$hn;?>>
            </div>
        </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-lg-8">
            <?= $text ;?>
        </div>
        <div class="col-lg-1">
            <div class="line"></div>
        </div>
        <div class="col-lg-3">
            <?php if(!empty($list)): ?>
                <?php   foreach ( $list as $item) :?>
                    <div class="numbers">
                        <div class="num"><?= $item['text'] ;?></div>
                        <div class="descr">
                            <?= $item['suffix']; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif ;?>
        </div>
    </div>
</section>
<!-- -->
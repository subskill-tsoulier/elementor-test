<?php
/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */
?>
<section class="block-chiffre-img container">
        <div class="row gx-0">
            <div class="col-lg-6">
                <div class="block-key-numbers">
                    <div class="bg-pink pad">
                        <?php if (!empty($title)): ?>
                        <div class="block_section-title title-white">
                            <<?=$hn;?> class="title"> <?= $title;?> </<?= $hn;?>>
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($list)): ?>
                        <?php foreach ( $list as $item) :?>
                            <div class="key-numbers text-white">
                                <div class="prefix"><p><?= $item['prefix'] ;?></p></div>
                                <div class="num"><p><?= $item['text'];?></p></div>
                                <div class="descr">
                                    <p><?= $item['suffix'];?> </p>
                                </div>
                            </div>
                        <?php endforeach ;?>
                    <?php endif;?>
                    </div>
                </div>
            </div>
        <?php if (is_admin()) { ?>
            <div class="col-lg-6 pic-part bg-img" style="background-image: url(<?= $image ?>)"></div>
        <?php } else { ?>
            <div class="col-lg-6 pic-part bg-img b-lazy" data-src="<?= $image ?>"></div>
        <?php } ?>
        </div>
</section>
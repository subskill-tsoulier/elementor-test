<?php
/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */
?>
<!-- Section - Block Profit-->
<section class="block-profit bg-light">
    <div class="container">
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
        <?php
        if ($settings['list']):
            foreach ($settings['list'] as $key_item => $item):
                ?>
                <div class="profit-col col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="profit">
                        <div class="icon">
                            <img src="<?= get_stylesheet_directory_uri() ?>/assets/images/lazy/placeholder.jpg" data-src="<?= $item['image']['url'] ?>" alt="" class="b-lazy" />
                        </div>
                        <div class="descr">
                            <p><?= $item['text'] ?></p>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
        endif;
        ?>
    </div>
    </div>
</section>
<!-- -->
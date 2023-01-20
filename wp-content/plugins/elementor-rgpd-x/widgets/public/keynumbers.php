<?php
/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */
global $special_color;
?>
<!-- Section - Block Key Numbers-->
<section class="block-key-numbers <?php echo $numberItem === 2 ? 'two-numbers' : '' ;?> <?= (!empty($bgcolor))?$bgcolor:'bg-pink' ?> <?= (!empty($special_color))?"special-".$special_color:"" ?> " id="chiffre-cle">
    <div class="container">
        <div class="pad bkn-content row">
            <?php if( !empty($title) ) : ?>
            <div class="col-lg-12">
                <div class="block_section-title">
                    <<?=$hn;?> class="title"> <?= $title;?> </<?=$hn;?>>
            </div>
        </div>
        <?php endif; ?>
        <?php
        if( !empty($text) ):
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <?= $text ?>
                </div>
            </div>
        <?php
        endif;
        ?>
    </div>
    <?php if(!empty($list)): ?>
        <div class="row">
            <?php foreach ( $list as $item) :?>
                <div class="key-numbers col-md-6 <?php echo $numberItem === 2 ? 'col-lg-6' : 'col-lg-3' ;?> ">
                    <?php if( !empty($item['prefix']) ) : ?>
                        <div class="prefix"><?= $item['prefix'] ;?></div>
                    <?php endif; ?>
                    <div class="num"><?= $item['text'] ;?></div>
                    <div class="descr">
                        <?= $item['suffix'];?>
                    </div>
                </div>
            <?php endforeach ;?>
        </div>
    <?php endif;?>
    </div>
</section>
<!-- -->
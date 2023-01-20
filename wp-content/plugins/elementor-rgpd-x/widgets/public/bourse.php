<?php
/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */
?>
<section class="block-action-investor container">
    <div class="row">
        <div class="col-12">
            <div class="block-action-investor-content <?= isset($args['bg-block']) ? $args['bg-block'] : 'bg-pink'?>">
                <div class="left">
                    <?php if( !empty($overtitle) ): ?>
                        <div class="title">
                            <?= !empty($overtitle) ? $overtitle : 'Cours de l\'action Assystem' ?>
                        </div>
                    <?php endif; ?>
                    <?php if( !empty($title) ) : ?>
                        <div class="name">
                            <?= $title; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php
                if( !empty($action_datas) ):
                    ?>
                    <div class="right">
                        <div class="value">
                            <?= str_replace('.', ',', $action_datas->instr->currInstrSess->lastPx) ?> <?= $action_datas->instr->currency ?>
                        </div>
                        <div class="date">
                            <?= $action_datas->formatted_date; ?>
                            <?= $action_datas->percentage; ?>
                        </div>
                    </div>
                    <?php
                endif;
                ?>
            </div>
        </div>
    </div>
</section>
<!-- -->
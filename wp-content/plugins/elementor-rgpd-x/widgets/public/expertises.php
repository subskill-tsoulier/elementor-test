<?php
// Bloc expertises
// Dynamise le 17/08
?>
<section class="block-expertise">
    <?php
    if (!empty($title)):
    ?>
    <div class="container">
        <div class="block_section-title">
            <<?= $hn; ?> class="title"><?= $title ?></<?= $hn; ?>>
        </div>
    </div>
    <?php
    endif;
    if(is_admin()) { ?>
        <div class="expertises-bg bg-img" <?php if( !empty($image) ): ?>style="background-image: url(<?= $image ?>)"<?php endif; ?>>
    <?php } else { ?>
        <div class="expertises-bg bg-img b-lazy" <?php if( !empty($image) ): ?>data-src="<?= $image; ?>"<?php endif; ?>>
    <?php } ?>
        <div class="opacity"></div>
        <div class="container">
            <div class="row row-expertise">
                <?php
                if (!empty($list)):
                    foreach ($list as $key_item => $item):
                        if( !empty($item) ):
                            ?>
                            <div class="col-lg-3 col-md-6 col-sm-12 col-12 item-expertise expertise">
                                    <?php
                                    if( !empty($item['link']) ):
                                    ?>
                                    <a href="<?= $item['link']['url']; ?>" <?= (!empty($item['link']['is_external']) && $item['link']['is_external'] == "on")?'target="_blank"':'' ?>>
                                        <?php
                                        endif;
                                        ?>
                                        <p><?= $item['title'] ?></p>
                                        <?php
                                        if( !empty($item['link']) ):
                                        ?>
                                    </a>
                                <?php
                                endif;
                                ?>
                            </div>
                            <?php
                        endif;
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </div>
</section>

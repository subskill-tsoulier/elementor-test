<section class="block-hub-contact container">
    <div class="row">
            <?php
            if ( !empty($list) ):
                foreach ($list as $key_item => $item):
                    ?>
                    <div class="col-md-6 col-12">
                        <div class="contact-type bg-light">
                            <a href="<?= get_permalink($item['cta_link']); ?>">
                                <img src="<?= $item['image']['url'] ?>" alt="">
                                <div class="type">
                                    <span><?= $item['text_over'] ?></span>
                                    <span class="fw-bold color-pink-fluo"><?= $item['text_under'] ?></span>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php
                endforeach;
            endif;
            ?>
        </div>
</section>
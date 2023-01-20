<?php
?>
<!--        Section - Social Wall -->
<section class="block-social-wall bg-light">
    <div class="container">
        <?php if( !empty($title) ) : ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="block_section-title">
                    <<?= $hn; ?> class="title"><?= $title; ?></<?= $hn; ?>>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="row">
        <?php if( !empty($tweets) ) : ?>
            <?php foreach( $tweets as $tweet ): ?>
                <div class="col-sm-6 col-12">
                    <!--        Block - Tweet Card -->
                    <div class="tweet card">
                        <div class="card-header">
                            <div class="left-part">
                                <div class="pic bg-img" style="background-image: url('<?= get_stylesheet_directory_uri() ?>/assets/images/tmp/tweet-ass.png')"></div>
                                <div>
                                    <a class="name-account" href="https://twitter.com/assystem">Assystem</a>
                                    <span class="pseudo-account">@<?= $tweet['screen_name']; ?></span>
                                </div>
                            </div>
                            <div class="twitter-heading"><i class="icon-twitter"></i></div>
                        </div>
                        <div class="tweet-content">
                            <?= $tweet['text']; ?>
                            <div class="date"><span><?= $tweet['date'] ?></span></div>
                        </div>

                        <div class="card-footer">
                            <div class="left-part">
                                <div class="likes"><i class="icon-like"></i> <span class="count"><?= $tweet['likes']; ?></span></div>
                                <div class="link-to-account"><i class="icon-person"></i><a href="https://twitter.com/Assystem" target="_blank"><?php __("See Assystem’s other Tweets", "assytem-elementor"); ?></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="ctas-center">
        <!-- html structure btn btn-primary -->
        <div class="cta">
            <a href="#" class="btn btn-primary small bg-white">
                <div class="text"><?= __("Charger plus", "assystem"); ?></div>
                <div class="circle"></div>
            </a>
        </div>
    </div>
    </div>
</section>

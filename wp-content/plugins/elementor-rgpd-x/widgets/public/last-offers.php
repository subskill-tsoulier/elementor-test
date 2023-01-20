<?php
// Dernières offres d'emplois
// - title
// - numberpost
?>
<div class="last-offers_content">
    <div class="block_section-title">
        <<?= $hn ?> class="title">
            <?= !empty($title)?$title:''; ?> <span class="sub pink"><?= $offers_list_no_filter->_pagination->total ?> <?= __("offres disponibles", "assystem"); ?></span>
        </<?= $hn ?>>
    </div>
    <div class="last-offers_list">
        <?php
        if( !empty($offers) ) :
            foreach ( $offers->data as $offer ) :
                ?>
                <div class="list-offer-item">
                    <div class="offer-detail">
                        <h2 class="offer-title">
                            <?php
                            if( !empty($auto) && $auto == "yes" ) :
                            $detail_offer       =   get_field("detail_offer", "option");
                            $detail_offer_url   =   get_permalink($detail_offer);
                                ?>
                                <a class="offer-link" href="<?= $detail_offer_url; ?><?= sanitize_title($offer->title) . '_' . $offer->reference;?>">
                                    <?= $offer->title ?>
                                </a>
                                <?php
                            else:
                                ?>
                                <a class="offer-link" href="<?= $offer->link->url['url']; ?>" <?= (!empty($offer->link->url['is_external']) && $offer->link->url['is_external'] == "on")?'target="_blank"':''; ?>>
                                    <?= $offer->title ?>
                                </a>
                                <?php
                            endif;
                            ?>
                        </h2>
                        <div class="detail">
                            <p><?= $offer->contractType->label ?></p>
                            <p>
                                    <?= $offer->location ?>
                            </p>
                            <?php
                            if( !empty($auto) && $auto == "yes" ) :
                                $date_no_filter = $offer->startPublicationDate;
                                $datetime       = new DateTime($date_no_filter);
                                $date_format    = $datetime->format('d/m/Y');
                            else:
                                $date_format    = $offer->date;
                            endif;
                            ?>
                            <p class="date"><?php if ($auto == "yes"): ?><i class="icon-time"></i><?php endif; ?> <?= $date_format ?></p>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
        endif;
        ?>
    </div>
    <?php if( !empty($cta_link) && !empty($cta_link['url']) && !empty($cta_label) ): ?>
        <div class="cta">
            <a <?= !empty($cta_link['is_external'] && $cta_link['is_external'] == "on")?'target="_blank"':'' ?>  <?= !empty($cta_link['nofollow'] && $cta_link['nofollow'] == "on")?'rel="nofollow"':'' ?> href="<?= $cta_link['url'] ?>" class="btn btn-primary bg-light">
                <div class="text"><?= $cta_label; ?></div>
                <div class="circle"></div>
            </a>
        </div>
    <?php endif; ?>
</div>
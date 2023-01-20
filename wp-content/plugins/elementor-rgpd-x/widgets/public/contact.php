<?php
/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */
?>
<section class="block-advice container">
    <div class="row">
        <div class="col-12 block-advice-content <?= $bgcolor ? $bgcolor : 'bg-pink' ?>">
            <?php
            if (!empty($title)):
            ?>
            <div class="block_section-title title-no-line title-center">
                <<?= $hn ?> class="title"><?= $title; ?></<?= $hn ?>>
        </div>
        <?php
        endif;
        ?>
        <?php
        if (!empty($cta_link) && !empty($cta_link)):
            ?>
            <a href="<?= get_permalink($cta_link); ?>"><?= $cta_label ?></a>
            <?php
        else :
            $business_page  =   get_field("business_contact_hub", "option");
            if( !empty($business_page) ) :
            ?>
                <a href="<?= $business_page['url']; ?>" <?= (!empty($business_page['target']) && $business_page['target'] == "_ blank")?'target="_blank"':''; ?> class="link">
                    <?= __("Contactez-nous", "assystem"); ?>
                </a>
        <?php
            endif;
        endif;
        ?>
    </div>
</section>
<!-- -->
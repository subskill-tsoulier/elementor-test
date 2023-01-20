<?php
/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */
?>
<!--        Section - Block Maps -->
<section class="block-maps container">
    <div class="row">
        <?php if( !empty($title) ): ?>
        <div class="col-lg-12">
            <div class="block_section-title">
                <<?= $hn ;?> class="title"> <?= $title;?> </<?= $hn ;?>>
        </div>
    </div>
    <?php endif;?>
    <div class="col-lg-12">
        <ul class="nav nav-style-underline nav-tabs map-countries_continents without-style" role="tablist">
            <li tabindex="0" class="nav-item active" role="presentation" data-coordinates="0 0" data-zoom="1" data-continent="monde">
                <?= __("Monde", "assystem") ?>
            </li>
            <li tabindex="0" class="nav-item" role="presentation" data-coordinates="4.6% 55%" data-zoom="4.3" data-continent="europe">
                <?= __("Europe", "assystem") ?>
            </li>
            <li tabindex="0" class="nav-item" data-coordinates="-64% -8%" data-zoom="4" data-continent="inde" role="presentation">
                <?= __("Inde", "assystem") ?>
            </li>
            <li tabindex="0" class="nav-item" data-coordinates="-51% -40%" data-zoom="2" data-continent="asie-pacifique" role="presentation">
                <?= __("Asie et Pacifique", "assystem"); ?>
            </li>
            <li tabindex="0" class="nav-item" data-coordinates="-1.5% -21.4%" data-zoom="3" data-continent="afrique-moyen-orient" role="presentation">
                <?= __("Moyen Orient", "assystem") ?>
            </li>
            <div class="indicator"></div>
        </ul>
        <div role="tabpanel" class="map-countries" id="myTabContent">
            <?php
            if ( is_admin() ) {
                echo '<img src="' . get_stylesheet_directory_uri() . '/assets/images/map-v3.svg' . '" />';
            } else {
                echo file_get_contents(get_stylesheet_directory() . '/assets/images/map-v3.svg');
            }
            ?>
        </div>
        <script>
            var countriesInfos = <?= json_encode($locals) ?>;
        </script>
    </div>
    </div>
</section>
<!-- -->
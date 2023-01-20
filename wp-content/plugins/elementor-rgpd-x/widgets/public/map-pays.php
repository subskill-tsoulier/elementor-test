<?php
/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */
?>
<!--<p>Block Map Pays</p>-->
<section class="block-map-country container-fluid p-0">
    <div class="row g-0">
        <div class="col-12 col-lg-5 block-map-country-content">
            <?php if( !empty($title) ): ?>
            <div class="block_section-title">
                <<?= $hn ;?>  class="title offset-lg-2 offset-1"> <?= $title;?> </<?= $hn ;?> >
        </div>
        <?php endif; ?>
        <ul class="addresses-country offset-lg-2 offset-1 custom-scrollbar custom-scrollbar-style-1">
            <?php
            if( !empty($locals) ):
                foreach($locals as $local):
                    ?>
                    <div class="address-country">
                        <div class="name">
                            <?= $local->post_title; ?>
                        </div>
                        <ul class="tags hashtags without-style upp medium">
                            <?php
                            $sectors     =   get_field("sector", $local->ID);
                            if( !empty($sectors) ):
                                if( !is_array($sectors) ) {
                                    $sectors    =   array($sectors);
                                }
                                foreach($sectors as $sector):
                                    $sector     =   get_post($sector);
                                    ?>
                                    <li><a href="<?= get_permalink($sector->ID); ?>" class="tag">#<?= $sector->post_title; ?></a></li>
                                <?php
                                endforeach;
                            endif;
                            ?>
                        </ul>
                        <div class="details">
                            <?= nl2br($local->post_content); ?>
                            <div class="actions">
                                <?php
                                // TODO keep to dynamize later
                                /**
                                $phone  =   get_field("phone", $local->ID);
                                $fax    =   get_field("fax", $local->ID);
                                ?>
                                <?= (!empty($phone)) ? '<p>Tél : <a href="tel:'.$phone.'">'.$phone.'</a></p>':''; ?>
                                <?= (!empty($fax)) ? '<p>Fax : <a href="tel:'.$fax.'">'.$fax.'</a></p>':'';
                                 **/
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
                endforeach;
            endif;
            ?>
        </ul>
    </div>
    <div class="col-12 col-lg-7 block-map-country-visuel">
        <div id="map"></div>
    </div>
    </div>
</section>
<!-- -->
<script>
    window.pins     = <?php echo json_encode($map_pins) ?>;
    window.mapzoom  = <?php echo $map_zoom; ?>;
    window.latitude = <?php echo $latitude_map; ?>;
    window.longitude= <?php echo $longitude_map; ?>;
</script>
<script async src="https://maps.googleapis.com/maps/api/js?key=<?= MAP_KEY ?>"></script>
<!-- -->
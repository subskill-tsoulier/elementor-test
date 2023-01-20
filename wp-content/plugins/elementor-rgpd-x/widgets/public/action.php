<?php
/**
 * Created by PhpStorm.
 * User: denisthomas
 * Date: 27/05/2022
 * Time: 16:38
 */
?>
<!-- Block Array -->
<section class="block_array">
    <div class="container">
        <?php if (!empty($title)) : ?>
            <div class="block_section-title">
                <<?= $hn ?> class="title"><?= $title ?></<?= $hn ?>>
            </div>
        <?php endif; ?>

        <?php if( !empty($subtitle) ) : ?>
        <<?= $subtitle_hn; ?>><?= $subtitle ?></<?= $subtitle_hn; ?>>
        <?php endif; ?>
        <table width="100%" cellpadding="0" cellspacing="0" tabindex="0">
        <tbody>
        <tr>
            <th class="tbl_title" scope="row"><?= __("Date", "assystem"); ?></th>
            <th scope="col">
                <?php
                if( !empty($cotation) && !empty($cotation['date']) ):
                    echo $cotation['date']['cur']['date'] . '<br />';
                    echo $cotation['date']['cur']['time'];
                endif;
                ?>
            </th>
            <th scope="col">
                <?php
                if( !empty($cotation) && !empty($cotation['date']) ):
                    echo $cotation['date']['prev']['date'] . '<br />';
                    echo $cotation['date']['prev']['time'];
                endif;
                ?>
            </th>
        </tr>
        <tr>
            <th class="tbl_title" scope="row"><?= __("Dernier", "assystem"); ?></th>
            <td>
                <?php
                if( !empty($cotation) && !empty($cotation['last']) ):
                    echo $cotation['last']['cur'];
                endif;
                ?>
            </td>
            <td>
                <?php
                if( !empty($cotation) && !empty($cotation['last']) ):
                    echo $cotation['last']['prev'];
                endif;
                ?>
            </td>
        </tr>
        <tr>
            <th class="tbl_title" scope="row"><?= __("Var %", "assystem"); ?></th>
            <td>
                <?php
                if( !empty($cotation) && !empty($cotation['var']) ):
                    echo '<span class="'.$cotation['var']['cur']['class'].'">'.$cotation['var']['cur']['val'].'%</span>';
                endif;
                ?>
            </td>
            <td>
                <?php
                if( !empty($cotation) && !empty($cotation['var']) ):
                    echo '<span class="'.$cotation['var']['prev']['class'].'">'.$cotation['var']['prev']['val'].'%</span>';
                endif;
                ?>
            </td>
        </tr>
        <tr>
            <th class="tbl_title" scope="row"><?= __("Premier", "assystem"); ?></th>
            <td>
                <?php
                if( !empty($cotation) && !empty($cotation['last']) ):
                    echo $cotation['perf']['cur'];
                endif;
                ?>
            </td>
            <td>
                <?php
                if( !empty($cotation) && !empty($cotation['last']) ):
                    echo $cotation['perf']['prev'];
                endif;
                ?>
            </td>
        </tr>
        <tr>
            <th class="tbl_title" scope="row"><?= __("+ Haut", "assystem"); ?></th>
            <td>
                <?php
                if( !empty($cotation) && !empty($cotation['high']) ):
                    echo $cotation['high']['cur'];
                endif;
                ?>
            </td>
            <td>
                <?php
                if( !empty($cotation) && !empty($cotation['high']) ):
                    echo $cotation['high']['prev'];
                endif;
                ?>
            </td>
        </tr>
        <tr>
            <th class="tbl_title" scope="row"><?= __("+ Bas", "assystem"); ?></th>
            <td>
                <?php
                if( !empty($cotation) && !empty($cotation['low']) ):
                    echo $cotation['low']['cur'];
                endif;
                ?>
            </td>
            <td>
                <?php
                if( !empty($cotation) && !empty($cotation['low']) ):
                    echo $cotation['low']['prev'];
                endif;
                ?>
            </td>
        </tr>
        <tr>
            <th class="tbl_title" scope="row"><?= __("Capitaux", "assystem"); ?></th>
            <td>
                <?php
                if( !empty($cotation) && !empty($cotation['capitaux']) ):
                    echo $cotation['capitaux']['cur'];
                endif;
                ?>
            </td>
            <td>
                <?php
                if( !empty($cotation) && !empty($cotation['capitaux']) ):
                    echo $cotation['capitaux']['prev'];
                endif;
                ?>
            </td>
        </tr>
        </tbody>
    </table>
    </div>
</section>
<!-- Block Graph -->
<section class="block_graph">
    <div class="container">
        <?php if( !empty($subtitle_graph) ) : ?>
        <<?= $subtitle_graph_hn; ?>><?= $subtitle_graph ?></<?= $subtitle_graph_hn; ?>>
    <?php endif; ?>
        <div class="cotation-graph" tabindex="0">
            <?php
            if( !empty($cotation['graph']) ):
            ?>
            <img class="b-lazy" src="<?= get_stylesheet_directory_uri() ?>/assets/images/lazy/banner-slider.jpg" data-src="<?= $cotation['graph']['img']; ?>" />
            <?php
            endif;
            ?>
        </div>
        <?php
        if( !empty($cotation_alt) ):
        ?>
        <div class="screen-reader-text" tabindex="0">
            <?= $cotation_alt; ?>
        </div>
        <?php
        endif;
        ?>
    </div>
</section>
<!-- Block Array -->
<section class="block_array">
    <div class="container">
    <?php if (!empty($comparaison_title)) : ?>
        <<?= $comparaison_hn ?> class="title"><?= $comparaison_title ?></<?= $comparaison_hn ?>>
    <?php endif; ?>
    <table width="100%" cellpadding="0" cellspacing="0" tabindex="0">
    <tbody>
    <tr>
        <th class='tbl_title'></th>
        <th class='tbl_title' scope='col'><?= __('52 semaines', 'assystem'); ?></th>
        <th class='tbl_title' scope='col'><?= __('1er janvier', 'assystem'); ?></th>
        <th class='tbl_title' scope='col'><?= __('6 mois', 'assystem'); ?></th>
        <th class='tbl_title' scope='col'><?= __('3 mois', 'assystem'); ?></th>
        <th class='tbl_title' scope='col'><?= __('1 mois', 'assystem'); ?></th>
    </tr>
    <tr>
        <th class="tbl_title" scope="row"><?= __('Variation %', 'assystem'); ?></th>
        <td><?= !empty($comparaison) && !empty($comparaison['variation'])?'<span class="'.$comparaison['variation_class']['week'].'">'.$comparaison['variation']['week'].'</span>':'' ?></td>
        <td><?= !empty($comparaison) && !empty($comparaison['variation'])?'<span class="'.$comparaison['variation_class']['jan_1'].'">'.$comparaison['variation']['jan_1'].'</span>':'' ?></td>
        <td><?= !empty($comparaison) && !empty($comparaison['variation'])?'<span class="'.$comparaison['variation_class']['6m'].'">'.$comparaison['variation']['6m'].'</span>':'' ?></td>
        <td><?= !empty($comparaison) && !empty($comparaison['variation'])?'<span class="'.$comparaison['variation_class']['3m'].'">'.$comparaison['variation']['3m'].'</span>':'' ?></td>
        <td><?= !empty($comparaison) && !empty($comparaison['variation'])?'<span class="'.$comparaison['variation_class']['1m'].'">'.$comparaison['variation']['1m'].'</span>':'' ?></td>
    </tr>
    <tr>
        <th class="tbl_title" scope="row"><?= __('Date + Haut', 'assystem'); ?></th>
        <td><?= !empty($comparaison) && !empty($comparaison['date'])?$comparaison['date']['week']:'' ?></td>
        <td><?= !empty($comparaison) && !empty($comparaison['date'])?$comparaison['date']['jan_1']:'' ?></td>
        <td><?= !empty($comparaison) && !empty($comparaison['date'])?$comparaison['date']['6m']:'' ?></td>
        <td><?= !empty($comparaison) && !empty($comparaison['date'])?$comparaison['date']['3m']:'' ?></td>
        <td><?= !empty($comparaison) && !empty($comparaison['date'])?$comparaison['date']['1m']:'' ?></td>
    </tr>
    <tr>
        <th class="tbl_title" scope="row"><?= __('+ Haut', 'assystem'); ?></th>
        <td><?= !empty($comparaison) && !empty($comparaison['high'])?$comparaison['high']['week']:'' ?></td>
        <td><?= !empty($comparaison) && !empty($comparaison['high'])?$comparaison['high']['jan_1']:'' ?></td>
        <td><?= !empty($comparaison) && !empty($comparaison['high'])?$comparaison['high']['6m']:'' ?></td>
        <td><?= !empty($comparaison) && !empty($comparaison['high'])?$comparaison['high']['3m']:'' ?></td>
        <td><?= !empty($comparaison) && !empty($comparaison['high'])?$comparaison['high']['1m']:'' ?></td>
    </tr>
    <tr>
        <th class="tbl_title" scope="row"><?= __('Date + Bas', 'assystem'); ?></th>
        <td><?= !empty($comparaison) && !empty($comparaison['date_lower'])?$comparaison['date_lower']['week']:'' ?></td>
        <td><?= !empty($comparaison) && !empty($comparaison['date_lower'])?$comparaison['date_lower']['jan_1']:'' ?></td>
        <td><?= !empty($comparaison) && !empty($comparaison['date_lower'])?$comparaison['date_lower']['6m']:'' ?></td>
        <td><?= !empty($comparaison) && !empty($comparaison['date_lower'])?$comparaison['date_lower']['3m']:'' ?></td>
        <td><?= !empty($comparaison) && !empty($comparaison['date_lower'])?$comparaison['date_lower']['1m']:'' ?></td>
    </tr>
    <tr>
        <th class="tbl_title" scope="row"><?= __('+ Bas', 'assystem'); ?></th>
        <td><?= !empty($comparaison) && !empty($comparaison['low'])?$comparaison['low']['week']:'' ?></td>
        <td><?= !empty($comparaison) && !empty($comparaison['low'])?$comparaison['low']['jan_1']:'' ?></td>
        <td><?= !empty($comparaison) && !empty($comparaison['low'])?$comparaison['low']['6m']:'' ?></td>
        <td><?= !empty($comparaison) && !empty($comparaison['low'])?$comparaison['low']['3m']:'' ?></td>
        <td><?= !empty($comparaison) && !empty($comparaison['low'])?$comparaison['low']['1m']:'' ?></td>
    </tr>
    </tbody>
</table>
    </div>
</section>
<!-- Block Graph -->
<section class="block_graph">
    <div class="container">
        <?php if (!empty($historique_title)) : ?>
        <<?= $historique_hn ?> class="title"><?= $historique_title ?></<?= $historique_hn ?>>
        <?php endif; ?>
        <div class="cotation-graph" tabindex="0">
            <?php
            /*
             <a href="/export/stats/"><?php _e('Export au format Excel sur 12 mois', 'assystem'); ?></a>
             */

            if( !empty($historique['graph']) ):
                ?>
                <img class="histo-graph b-lazy" src="<?= get_stylesheet_directory_uri() ?>/assets/images/lazy/banner-slider.jpg" data-src="<?= $historique['graph']['img']; ?>" />
                <?php
            endif;
            ?>
            <ul class="graph-year-menu">
                <?php foreach ($historique_graph as $year): ?>
                    <li><a href="#" data-year="<?php echo $year; ?>"><?php echo $year; ?> <?php (float) $year > 1 ? _e('ans', 'assystem') : _e('an', 'assystem'); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php
        if( !empty($historique_alt) ):
            ?>
            <div class="screen-reader-text" tabindex="0">
                <?= $historique_alt; ?>
            </div>
            <?php
        endif;
        ?>
    </div>
</section>
<!-- -->
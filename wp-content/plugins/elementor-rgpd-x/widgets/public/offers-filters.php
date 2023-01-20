<?php
// Bloc Offfres d'emploi avec filtres
// Dynamise le : 12/08/2022
$list_offers   =   get_field("list_offer", "option");
?>
<div class="list-offers_filters block-filters-bar_list <?= (!empty($reverse) && $reverse == "yes" )?'reverse':''; ?> filters-up <?= (!empty($is_large) && $is_large == "yes" )?'large-bar':''; ?>">
    <aside id="form-filter-offers">
        <form method="get" action="<?= $list_offers['url']; ?>">
            <div id="offers-filter-wrap">
                <input type="hidden" name="filter_from" value="aside_filter_form_fields" />
                <div id="offers-filter-inner">
                    <div class="card" id="collapse-keywords">
                        <input type="text"
                               placeholder="<?= __("Mots clés", "assystem"); ?>"
                               class="keywords"
                               name="keywords"
                               value=""
                        />
                    </div>
                    <div class="card" id="collapse-metier">
                        <button role="button" class="opener"><?= __("Métier", "assystem"); ?></button>
                        <div class="list-group">
                                <?php
                                foreach ($search_bar_type[0] as $key_type_0 => $type_0):
                                    if ($type_0->parentCode != false && $type_0->parentType != "offerFamilyCategory"):
                                        ?>
                                        <div class="list-group-item">
                                            <input class="styled-checkbox" type="checkbox" id="job-<?= $key_type_0 ?>" name="<?= $data_type_search_bar[0] ?>[]" value="<?= $type_0->code ?>">
                                            <label for="job-<?= $key_type_0 ?>"><?= $type_0->label ?></label>
                                        </div>
                                    <?php
                                    endif;
                                endforeach;
                                ?>
                            </div>
                    </div>
                    <div class="card" id="collapse-location">
                        <button role="button" class="opener"><?= __("Localisation", "assystem"); ?></button>
                        <div class="list-group">
                                <?php
                                foreach ($locations as $key_location => $location):
                                    if (!array_key_exists('child', $location)):
                                        ?>
                                        <div class="list-group-item">
                                            <input class="styled-checkbox" type="checkbox" id="geographicalLocation-<?= $key_location ?>" name="geographicalLocation[]" value="<?= $location['code'] ?>">
                                            <label for="geographicalLocation-<?= $key_location ?>"><?= $location['label'] ?></label>
                                        </div>
                                    <?php
                                    else:
                                        ?>
                                        <div class="list-group-item has-children">
                                            <div class="collpase-wrap">
                                                <input class="styled-checkbox" type="checkbox" id="geographicalLocation-<?= $key_location ?>" name="geographicalLocation[]" value="<?= $location['code'] ?>" data-has-children="">
                                                <label for="geographicalLocation-<?= $key_location ?>"><?= $location['label'] ?></label>
                                                <a data-toggle="collapse" href="#collapse-<?= $location['code'] ?>"></a>
                                            </div>
                                            <div class="collapse" id="collapse-<?= $location['code'] ?>">
                                                <div class="list-group">
                                                    <?php
                                                    foreach ($location['child'] as $key_location_child => $location_child):
                                                        ?>
                                                        <div class="list-group-item has-parent">
                                                            <input class="styled-checkbox" type="checkbox" tabindex="0" id="geographicalLocation-<?= $key_location ?>-<?= $key_location_child ?>" name="geographicalLocation[]" value="<?= $location_child['code'] ?>" data-has-parent="">
                                                            <label for="geographicalLocation-<?= $key_location ?>-<?= $key_location_child ?>"><?= $location_child['label'] ?></label>
                                                        </div>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    endif;
                                endforeach;
                                ?>
                            </div>
                    </div>
                    <div class="card" id="collapse-secteur-activite">
                        <button role="button" class="opener"><?= __("Secteur", "assystem"); ?></button>
                        <div class="list-group">
                            <?php
                            foreach ($search_bar_type[2] as $key_type_2 => $type_2):
                                ?>
                                <div class="list-group-item">
                                    <input class="styled-checkbox" type="checkbox" id="JobDescription.customCodeTable1-<?= $key_type_2 ?>" name="dynamicFields[]" value="JobDescription.customCodeTable1.<?= $type_2->code ?>">
                                    <label for="JobDescription.customCodeTable1-<?= $key_type_2 ?>"><?= $type_2->label ?></label>
                                </div>
                            <?php
                            endforeach;
                            ?>
                        </div>
                    </div>
                    <div class="card" id="collapse-contract-type">
                        <button role="button" class="opener"><?= __("Type de Contrat", "assystem"); ?></button>
                        <div class="list-group">
                                <?php
                                foreach ($search_bar_type[3] as $key_type_3 => $type_3):
                                    ?>
                                    <div class="list-group-item">
                                        <input class="styled-checkbox" type="checkbox" id="contractType-<?= $key_type_3 ?>" name="<?= $data_type_search_bar[3] ?>[]" value="<?= $type_3->code ?>">
                                        <label for="contractType-<?= $key_type_3 ?>"><?= $type_3->label ?></label>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                    </div>
                    <div class="card-sbt">
                        <button type="submit" class="btn btn-submit">
                            <span class="btn-text"><?php _e("Appliquer les filtres", "assystem"); ?></span><i class="icon-search"></i></button>
                    </div>
                </div>
            </div>
            <div class="search-criteria">
                <div class="search-criteria-container">
                    <div class="tag-wrapper">
<!--                        <span class="tag-search" data-code="79"> France-->
<!--                            <button role="button" aria-label="--><?php //_e("Supprimer le filtre", "assystem"); ?><!--" class="close">x</button>-->
<!--                        </span>-->
<!--                        <span class="tag-search" data-code="79"> France-->
<!--                            <button role="button" aria-label="--><?php //_e("Supprimer le filtre", "assystem"); ?><!--" class="close">x</button>-->
<!--                        </span>-->
                    </div>
                    <button type="reset" class="btn btn-reset"><?php _e("Réinitialiser", "assystem"); ?></button>
                </div>
            </div>
        </form>
    </aside>
</div>
<!-- -->
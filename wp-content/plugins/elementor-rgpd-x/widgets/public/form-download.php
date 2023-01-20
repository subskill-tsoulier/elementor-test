<?php
// Bloc formulaire de téléchargement
?>
<section class="block-form-livre-blanc assystem-form bg-light">
    <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="assystem-form-content">
                        <div class="assystem-form-content-wrap">
                            <div class="tab-content multi-form-wrap">
                                <div class="contact-card">
                                <?php
                                if (!empty($title)):
                                ?>
                                    <div class="block_section-title">
                                        <<?= $hn ?> class="title"><?= $title ?></<?= $hn ?>>
                                    </div>
                                <?php
                                endif;
                                ?>
                                <?php
                                if( !empty($form_html) ) {
                                    echo $form_html;
                                }
                                if( !empty($form_cpt) ) {
                                    echo do_shortcode("[contact-form-7 id='".$form_cpt."' title=".get_the_title($form_cpt)."]");
                                }
                                ?>
                                <?php
                                /*
                                 <form action="" id="form-id" class="custom-form custom-form-small">
                                <input type="hidden" name="action" value="create_account">
                                <div class="form-group">
                                    <!--<label for="lastName">Nom*</label>-->
                                    <input type="text"
                                           id="lastName"
                                           aria-required="true"
                                           aria-label="Nom"
                                           name="personalInformation[lastName]"
                                           class="form-control required"
                                           placeholder="Nom*">
                                </div>
                                <div class="form-group">
                                    <input type="text"
                                           id="firstName"
                                           aria-label="Prénom"
                                           aria-required="true"
                                           name="personalInformation[firstName]"
                                           class="form-control required"
                                           placeholder="Prénom*">
                                </div>
                                <div class="form-group">
                                    <input type="text"
                                           id="company"
                                           aria-label="Société"
                                           aria-required="true"
                                           name="personalInformation[company]"
                                           class="form-control required"
                                           placeholder="Société*">
                                </div>
                                <div class="form-group">
                                    <input type="text"
                                           id="email"
                                           aria-label="Email"
                                           aria-required="true"
                                           name="personalInformation[email]"
                                           class="form-control required"
                                           autocomplete="email"
                                           placeholder="Email*">
                                </div>
                                <div class="form-group">
                                    <input type="text"
                                           id="fonction"
                                           aria-label="Fonction"
                                           aria-required="true"
                                           name="personalInformation[fonction]"
                                           class="form-control required"
                                           placeholder="Fonction*">
                                </div>
                                <div class="form-group custom-select">
                                    <!--                                                <label for="select-need">Je souhaite*</label>-->
                                    <select class="js-custom-single-white"
                                            name="sector"
                                            id="select-sector"
                                            data-placeholder="Sector"
                                    >
                                        <option></option>
                                        <option value="madame">Madame</option>
                                        <option value="monsieur">Monsieur</option>
                                    </select>
                                </div>
                                <div class="form-group custom-checkbox">
                                    <input type="checkbox"
                                           aria-required="true"
                                           aria-labelledby="message_info-1"
                                           id="message_info-1"
                                           name="messageInfo[1]"
                                           checked
                                    >
                                    <label for="message_info-1">
                                        <p>J’autorise Assystem à traiter mes données personnelles pour répondre à ma
                                            demande.​​​​​​*
                                        </p>
                                    </label>
                                </div>
                                <div class="form-group custom-checkbox">
                                    <input type="checkbox"
                                           aria-labelledby="message_info-2"
                                           id="message_info-2"
                                           name="messageInfo[2]"
                                           checked
                                    >
                                    <label for="message_info-2">
                                        <p>J’autorise Assystem à traiter mes donnnées personnelles pour répondre à
                                            ma demande
                                            conformément aux conditions génnérales
                                            <span class="pink">En savoir plus</span>
                                        </p>
                                    </label>
                                </div>
                                <div class="custom-form-actions">
                                    <div class="ctas-center">
                                        <div class="cta">
                                            <button role="button" type="submit"
                                                    class="btn btn-primary bg-full-pink small">
                                                <span class="text"><span>Envoyer</span></span>
                                                <span class="circle">
                                        <span class="icon">
                                            <i class="icon-arrow-right"></i>
                                        </span>
                                    </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                </form>
                                 */
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 center-block">
                <?php
                if( !empty($image) && !empty($image['url']) ):
                    if (is_admin()){ ?>
                        <img src="<?= $image['url'] ?>" alt="" />
                    <?php }else { ?>
                        <img class="b-lazy" src="<?= get_stylesheet_directory_uri(); ?>/assets/images/lazy/form-download.png" data-src="<?= $image['url'] ?>" alt="" />
                    <?php }
                endif;
                ?>
            </div>
        </div>
    </div>
</section>
<!-- -->
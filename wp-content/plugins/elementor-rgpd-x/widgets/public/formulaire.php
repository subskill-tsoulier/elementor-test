<?php
/**
 * Formulaire HTML ou WPCF7
 * Dynamise le 16/08
 */
?>
<section class="assystem-form bg-white">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="assystem-form-content">
                    <div class="assystem-form-content-wrap">
                        <div class="tab-content multi-form-wrap">
                            <?php if( !empty($title) ) : ?>
                            <fieldset class="contact-card assystem-form-card">
                                <div class="block_section-title">
                                    <<?= $hn ?> class="title"><?= $title; ?></<?= $hn ?>>
                                </div>
                            </fieldset>
                            <?php
                            endif;
                            if (!empty($form_html)) :
                                echo $form_html;
                            endif;
                            if( !empty($form_cpt) ) :
                                echo do_shortcode("[contact-form-7 id='".$form_cpt."' title=".get_the_title($form_cpt)."]");
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- -->
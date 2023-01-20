<?php

?>
<!-- Section - Block Team -->
<section class="block-team <?= (!empty($bgcolor))?$bgcolor:'bg-light' ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php
                if( !empty($title) ):
                ?>
                <div class="block_section-title">
                    <<?= $hn; ?> class="title"><?= $title; ?></<?= $hn; ?>>
                </div>
                <?php
                endif;
                if( !empty($text) ):
                    ?>
                    <div class="descr">
                        <?= $text; ?>
                    </div>
                    <?php
                endif;
                ?>
            </div>
        </div>
        <ul class="row row-team without-style">
            <?php
            if( !empty($posts) ):
                foreach($posts as $post):
                    if( !empty($post) && $post->post_type == 'equipe'):
                    ?>
                        <li class="col-lg-4 col-md-6 col-sm-12 col-12">
                            <div class="team-member" tabindex="1">
                                <?php
                                $image      =   get_field("profil_picture", $post->ID);
                                if( !empty($image) ) {
                                    $image  =   wp_get_attachment_image_src($image['ID'], 'membre-team-img')[0];
                                } else {
                                    // TODO : default thumb with Assystem Logo
                                }
                                $fname      =   get_field("firstname", $post->ID);
                                $lname      =   get_field("lastname", $post->ID);
                                $function   =   get_field("function", $post->ID);
                                $linkedin   =   get_field("linkedin_url", $post->ID);
                                ?>
                                <?php if (is_admin()) { ?>
                                    <div class="bg-img" <?= (!empty($image))?'style="background-image: url("' . $image. ')"':''; ?>></div>
                                <?php } else { ?>
                                    <div class="bg-img b-lazy" <?= (!empty($image))?'data-src="'.$image.'"':'' ?>></div>
                                <?php } ?>
                                <div class="infos-member">
                                    <div class="left-part">
                                        <div class="name">
                                            <p>
                                                <?php
                                                if (!empty($linkedin)):
                                                ?>
                                                <a href="<?= $linkedin ?>" target="_blank">
                                                    <?php
                                                    endif;
                                                    ?>
                                                    <?= (!empty($fname))?$fname:'' ?> <?= (!empty($lname))?$lname:'' ?>
                                                    <?php
                                                    if (!empty($linkedin)):
                                                    ?>
                                                </a>
                                            <?php
                                            endif;
                                            ?>
                                            </p>
                                        </div>
                                        <div class="job">
                                            <p><?= (!empty($function))?$function:'' ?></p>
                                        </div>
                                    </div>
                                    <div class="right-part">
                                        <?php
                                        if (!empty($linkedin)):
                                        ?>
                                        <i class="icon-linkedin"></i>
                                            <?php
                                        endif;
                                        ?>
                                    </div>
                                </div>
                                <div class="description custom-scrollbar custom-scrollbar-style-2">
                                    <h3 class="name"><?= (!empty($fname))?$fname:'' ?> <?= (!empty($lname))?$lname:'' ?></h3>
                                    <h4 class="job"><?= (!empty($function))?$function:'' ?></h4>
                                    <?= $post->post_content; ?>
                                </div>
                            </div>
                        </li>
                    <?php
                    endif;
                endforeach;
            endif;
            ?>
        </ul>
    </div>
</section>
<!-- -->
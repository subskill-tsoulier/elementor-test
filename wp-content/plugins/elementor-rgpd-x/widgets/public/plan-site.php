<section class="sitemap-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'sitemap-1',
                    'depth' => 3,
                    'container' => 'div',
                    'container_class' => 'sitemap-container',
                    'menu_class' => 'sitemap-menu',
                    'fallback_cb' => 'wp_page_menu',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                ));
                ?>
            </div>
        </div>
    </div>
</section>

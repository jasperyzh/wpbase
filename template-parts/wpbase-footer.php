<footer class="site-footer">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-muted">© 2022 Company, Inc</p>

            <?php
            wp_nav_menu(
                array(
                    'theme_location'  => 'footer',
                    'menu_id'        => 'footer-menu',
                    'menu_class'      => 'nav col-md-4 justify-content-end',
                    'container'         => "",
                    'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
                    'fallback_cb'     => false,
                    // custom parameter added thru functions-wpbas3.php
                    'list_item_class'  => 'nav-item',
                    'link_class'   => 'nav-link menu-item'
                    //  nav-active
                )
            );
            ?>
        </div>
    </div>
</footer>
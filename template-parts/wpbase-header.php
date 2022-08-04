<header id="masthead" class="site-header">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between py-3 mb-4 border-bottom">

            <div class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">

                <div class="site-branding">
                    <?php
                    the_custom_logo();
                    if (is_front_page() && is_home()) :
                    ?>
                        <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                    <?php
                    else :
                    ?>
                        <p class="site-title mb-0"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                    <?php
                    endif;
                    $wpbase_description = get_bloginfo('description', 'display');
                    if ($wpbase_description || is_customize_preview()) :
                    ?>
                        <p class="site-description mb-0"><?php echo $wpbase_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                            ?></p>
                    <?php endif; ?>
                </div><!-- .site-branding -->
            </div>

            <nav id="site-navigation" class="main-navigation d-flex align-items-center">



                <nav class="navbar navbar-expand-lg" aria-label="offcanvas navbar">

                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>

                        <div class="offcanvas-body">

                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location'  => 'primary',
                                    'menu_id'        => 'primary-menu',
                                    'menu_class'      => 'navbar-nav justify-content-end flex-grow-1',
                                    'container'         => "",
                                    'items_wrap'      => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
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
                </nav>
            </nav>
        </div>
    </div>
</header>
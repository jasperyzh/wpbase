<header class="site-header navbar navbar-expand-lg" aria-label="Offcanvas navbar large">
    <div class="container-fluid">
        <!-- <a class="navbar-brand" href="#">    -->
        <!-- <img width="120" height="64" src="@/assets/placeholder/placeholder.png" alt="" /> -->
        <?php
        the_custom_logo();
        if (is_front_page() && is_home()) :
        ?>
            <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
        <?php else : ?>
            <p class="site-title mb-0"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
        <?php
        endif;
        $wpbase_description = get_bloginfo('description', 'display');
        if ($wpbase_description || is_customize_preview()) :
        ?>
            <p class="site-description mb-0"><?php echo $wpbase_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                ?></p>
        <?php endif; ?>

        <!-- </a> -->

        <div class="row p-3">
            <nav class="nav menu__social justify-content-end d-none d-lg-flex">
                <a class="nav-link" href="#"><i class="bi bi-facebook"></i></a>
                <a class="nav-link" href="#"><i class="bi bi-instagram"></i></a>
                <a class="nav-link" href="#"><i class="bi bi-linkedin"></i></a>
                <a class="nav-link" href="#"><i class="bi bi-facebook"></i></a>
            </nav>

            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbar2Label">
                        Explore
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
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

                    <nav class="
                nav
                menu__social
                justify-content-start
                d-flex d-lg-none
                my-5
              ">
                        <a class="nav-link" href="#"><i class="bi bi-facebook"></i></a>
                        <a class="nav-link" href="#"><i class="bi bi-instagram"></i></a>
                        <a class="nav-link" href="#"><i class="bi bi-linkedin"></i></a>
                        <a class="nav-link" href="#"><i class="bi bi-facebook"></i></a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
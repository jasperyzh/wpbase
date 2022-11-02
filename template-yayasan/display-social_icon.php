<?php
wp_nav_menu([
    'theme_location'  => 'social',
    'menu_id'        => 'social-media-menu',
    'menu_class'      => 'nav h2',
    'container'         => "",
    'items_wrap'      => '<nav id="display-social-menu" class="%2$s">%3$s</nav>',
    'fallback_cb'     => false,
    // custom parameter added thru functions-wpbas3.php
    'list_item_class'  => 'nav-item',
    'link_class'   => 'nav-link menu-item mx-2'
    //  nav-active
]);

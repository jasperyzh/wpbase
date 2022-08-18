<footer class="bg-primary text-light border-top border-light text-center text-lg-start">
    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 pt-5">
            <div class="col mb-3 col-lg-3">
                <figure>
                    <img width="120" src="@/assets/placeholder/placeholder.png" alt="" />
                </figure>
                <p>
                    Level 71, Tower 1,
                    <br />PETRONAS Twin Towers <br />Kuala Lumpur City Centre,
                    <br />50088 Kuala Lumpur, <br />Malaysia
                </p>
            </div>

            <div class="col mb-3 col-lg-3">
                <h5>Network</h5>

                <?php
                wp_nav_menu([
                    'theme_location'  => 'quick',
                    'menu_id'        => 'quick-menu',
                    'menu_class'      => 'nav menu__quick flex-column',
                    'container'         => "",
                    'items_wrap'      => '<nav id="footer-quick-menu" class="%2$s">%3$s</nav>',
                    'fallback_cb'     => false,
                    // custom parameter added thru functions-wpbas3.php
                    'list_item_class'  => 'nav-item mb-2',
                    // 'link_class'   => 'nav-link menu-item'
                    //  nav-active
                ]);
                // <ul class="nav flex-column">
                //     <li class="nav-item mb-2">
                //         <a href="#" class="nav-link p-0">PETRONAS</a>
                //     </li>
                //     <li class="nav-item mb-2">
                //         <a href="#" class="nav-link p-0">PETRONAS Education Sponsorship Programme (PESP)</a>
                //     </li>
                //     <li class="nav-item mb-2">
                //         <a href="#" class="nav-link p-0">Galeri PETRONAS</a>
                //     </li>
                //     <li class="nav-item mb-2">
                //         <a href="#" class="nav-link p-0">PETROSAINS</a>
                //     </li>
                //     <li class="nav-item mb-2">
                //         <a href="#" class="nav-link p-0">Malaysian Philharmonic Orchestra</a>
                //     </li>
                // </ul>
                ?>
            </div>

            <div class="col mb-3 flex-fill">
                <h5>Stay Connected with Us</h5>
                <p>
                    Find out more about the many exciting programmes at Yayasan
                    PETRONAS and be part of the Where Good Flourishes community.
                </p>
                <form>
                    <div class="mb-3">
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" />
                    </div>

                    <button type="submit" class="btn btn-outline-light w-100">
                        Sign Up
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="bg-primary text-light fullbleed__secondary">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-lg-2 py-3">
                <div class="col order-lg-2">
                    <ul class="nav justify-content-center justify-content-lg-end my-2">
                        <li class="nav-item mx-2">
                            <a href="#" class="nav-link p-0">Sitemap</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a href="#" class="nav-link p-0">Risk Policy</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a href="#" class="nav-link p-0">Contribution Policy</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a href="#" class="nav-link p-0">Privacy Policy</a>
                        </li>
                    </ul>
                </div>
                <div class="col order-lg-1">
                    <p class="my-2">© 2022 Yayasan PETRONAS · All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
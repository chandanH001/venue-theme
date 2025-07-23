<?php
    function venue_header_logo()
    {
        $logo_url = get_theme_mod('logo_upload', get_template_directory_uri() . '/assets/img/logo.png');
    ?>
<a class="flex" href="<?php echo get_home_url(); ?>">
    <div class="logo">
        <img src="<?php echo esc_url($logo_url); ?>" alt="<?php bloginfo(); ?>">

    </div>
</a>

<?php
    }
?>


<header id="header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 flex justify-between">
                <button id="primary-nav-button" type="button">Menu</button>
                <?php venue_header_logo(); ?>
<?php venue_main_menu(); ?>
                <!-- <nav id="primary-nav" class="dropdown cf">
                    <ul class="dropdown menu">
                        <li class='active'><a href="#">Popular</a></li>
                        <li><a href="#">Most Visited</a>
                            <ul class="sub-menu">
                                <li><a href="#">Most Visited 1</a>
                                </li>
                                <li><a href="#">Most Visited 2</a>
                                </li>
                                <li><a href="#">Most Visited 3</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="scrollTo" data-scrollTo="blog" href="#">Blog Entries</a></li>
                        <li><a class="scrollTo" data-scrollTo="services" href="#">Our Services</a></li>
                        <li><a class="scrollTo" data-scrollTo="contact" href="#">Contact Us</a></li>
                    </ul>
                </nav>/ #primary-nav -->
            </div>
        </div>
    </div>
</header>
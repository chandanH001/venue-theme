<?php

// Nav menu function
if (! function_exists('venue_main_menu')) {
    function venue_main_menu()
    {
        if (has_nav_menu('header')) {
            wp_nav_menu([
                'theme_location'  => 'header',
                'container'       => 'nav',
                'container_class' => 'dropdown cf',
                'container_id'    => 'primary-nav',
                'menu_class'      => 'dropdown menu',
                'fallback_cb'     => 'Venue_Walker_Nav_Menu',
                'walker'          => new Venue_Walker_Nav_Menu,

            ]);
        }
    }
}
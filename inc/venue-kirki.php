<?php

new \Kirki\Panel(
    'venue_options',
    [
        'priority'    => 10,
        'title'       => esc_html__('Venue Options', 'venue'),
        'description' => esc_html__('My venue Options Description.', 'venue'),
    ]
);

// Main Header

new \Kirki\Section(
    'venue_header',
    [
        'title'       => esc_html__('Header', 'venue'),
        'description' => esc_html__('My Header Description.', 'venue'),
        'panel'       => 'venue_options',
        'priority'    => 160,
    ]
);

//Right Header Switcher

new \Kirki\Field\Upload(
    [
        'settings'    => 'logo_upload',
        'label'       => esc_html__('Upload Logo', 'venue'),
        'description' => esc_html__('The saved value will the URL.', 'venue'),
        'section'     => 'venue_header',
        'default'     => get_template_directory_uri() . '/assets/img/logo.png',

    ]
);

//footer
new \Kirki\Section(
    'venue_footer',
    [
        'title'       => esc_html__('Footer Options', 'venue'),
        'description' => esc_html__('My Footer Description.', 'venue'),
        'panel'       => 'venue_options',
        'priority'    => 160,
    ]
);

new \Kirki\Field\Upload(
    [
        'settings'    => 'footer_logo_upload',
        'label'       => esc_html__('Upload Logo For Footer', 'venue'),
        'description' => esc_html__('The saved value will the URL.', 'venue'),
        'section'     => 'venue_footer',
        'default'     => get_template_directory_uri() . '/assets/img/footer_logo.png',

    ]
);
// Copyright Text
new \Kirki\Field\Text(
    [
        'settings' => 'footer_copyright',
        'label'    => esc_html__('Footer Copyright Text', 'venue'),
        'section'  => 'venue_footer',
        'default'  => esc_html__('Copyright © 2018 Company Name - Design: Template Mo', 'venue'),
        'priority' => 10,
    ]
);

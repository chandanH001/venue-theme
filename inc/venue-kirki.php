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
new \Kirki\Field\Checkbox_Switch(
    [
        'settings'    => 'venue_right_header_switch',
        'label'       => esc_html__('Header Right Switch', 'venue'),
        'description' => esc_html__('Enable Or Disable Header Right', 'venue'),
        'section'     => 'venue_header',
        'default'     => 'off',
        'choices'     => [
            'on'  => esc_html__('Enable', 'venue'),
            'off' => esc_html__('Disable', 'venue'),
        ],
    ]
);

new \Kirki\Field\Upload(
    [
        'settings'    => 'logo_upload',
        'label'       => esc_html__('Upload Logo', 'venue'),
        'description' => esc_html__('The saved value will the URL.', 'venue'),
        'section'     => 'venue_header',
        'default'     => get_template_directory_uri() . '/assets/img/logo.png',

    ]
);

// new \Kirki\Field\Image(
//     [
//         'settings'    => 'logo_upload',
//         'label'       => esc_html__('Please Add your logo', 'venue'),
//         'description' => esc_html__('The saved value will be the URL.', 'venue'),
//         'section'     => 'venue_header',
//         'default'     => 'assets/img/logo.png',
//     ]
// );

//footer

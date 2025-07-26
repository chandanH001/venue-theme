<?php

if (! function_exists('venue_setup')):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since venue 1
 */
    function venue_setup()
{

/*
* Make theme available for translation.
* Translations can be filed in the /languages/ directory.
* If you're building a theme based on venue, use a find and replace
* to change 'venue' to the name of your theme in all the template files
*/
        load_theme_textdomain('venue', get_template_directory() . '/languages');

// Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

/*
* Let WordPress manage the document title.
* By adding theme support, we declare that this theme does not use a
* hard-coded tag in the document head, and expect WordPress to
* provide it for us.
*/
        add_theme_support('title-tag');

// Remove widget block editor
        remove_theme_support('widgets-block-editor');

/*
* Enable support for Post Thumbnails on posts and pages.
*
* See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
*/
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(825, 510, true);

// This theme uses wp_nav_menu() in two locations.
        register_nav_menus([
            'header' => __('Header Menu', 'venue'),
            'footer' => __('Footer Menu', 'venue'),
            // 'social'  => __('Social Links Menu', 'venue'),
        ]);

/*
* Switch default core markup for search form, comment form, and comments
* to output valid HTML5.
*/
        add_theme_support('html5', [
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
        ]);

/*
* Enable support for Post Formats.
*
* See: https://codex.wordpress.org/Post_Formats
*/
        add_theme_support('post-formats', [
            'image', 'video', 'quote', 'link', 'gallery', 'audio',
        ]);

    }
endif;
// venue_setup
add_action('after_setup_theme', 'venue_setup');

// Widget Registration
function venue_widgets_init()
{
    register_sidebar([
        'name'          => __('Blog Sidebar', 'venue'),
        'id'            => 'venue-blog-sidebar',
        'description'   => __('Widgets in this area will be shown under your single posts, Blog sidebar.', 'venue'),
        'before_widget' => '<div id="%1$s" class="tp-sidebar-widget mb-45 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="tp-sidebar-widget-title">',
        'after_title'   => '</h3>',
    ]);
    register_sidebar([
        'name'          => __('Footer 1', 'venue'),
        'id'            => 'venue-footer1-widgets',
        'description'   => __('Widgets in this area will be shown under your single posts, before comments.', 'venue'),
        'before_widget' => '<div id="%1$s" class="tp-footer-widget tp-footer-col-1 mb-30 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="tp-footer-widget-title">',
        'after_title'   => '</h3>',
    ]);
    register_sidebar([
        'name'          => __('Footer 2', 'venue'),
        'id'            => 'venue-footer2-widgets',
        'description'   => __('Widgets in this area will be shown under your single posts, before comments.', 'venue'),
        'before_widget' => '<div id="%1$s" class="footer-heading %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="">',
        'after_title'   => '</h4>',
        'link_before'   => '<i class="fa fa-stop"></i> ',
    ]);
    register_sidebar([
        'name'          => __('Footer 3', 'venue'),
        'id'            => 'venue-footer3-widgets',
        'description'   => __('Widgets in this area will be shown under your single posts, before comments.', 'venue'),
        'before_widget' => '<div id="%1$s" class="tp-footer-widget tp-footer-col-3 mb-30 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="tp-footer-widget-title">',
        'after_title'   => '</h3>',
    ]);

}
add_action('widgets_init', 'venue_widgets_init');

function venue_theme_scripts()
{

    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', [], '5.2.3', 'all');
    wp_enqueue_style('bootstrap_main', get_template_directory_uri() . '/assets/css/bootstrap-theme.min.css', [], '8.2.2', 'all');
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/css/fontAwesome.css', [], '8.2.2', 'all');
    wp_enqueue_style('hero_slider', get_template_directory_uri() . '/assets/css/hero-slider.css', [], '6.0', 'all');
    wp_enqueue_style('owl_carosel', get_template_directory_uri() . '/assets/css/owl-carousel', [], '8.2.2', 'all');
    wp_enqueue_style('datepicker', get_template_directory_uri() . '/assets/css/datepicker.css', [], '8.2.2', 'all');
    wp_enqueue_style('templatemo', get_template_directory_uri() . '/assets/css/templatemo-style.css', [], '8.2.2', 'all');
    wp_enqueue_style('raleway-font', 'https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900', false);

    //style css
    // wp_enqueue_style('style', get_stylesheet_uri());
    // For emedite apply css
    wp_enqueue_style(
        'style',
        get_stylesheet_uri(),
        [],
        filemtime(get_stylesheet_directory() . '/style.css') // This busts the cache
    );

    wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/vendor/jquery-1.11.2.min.js', ['jquery'], 1.1, true);
    wp_enqueue_script('modernizr', get_template_directory_uri() . '/assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js', [], 1.1, true);
    wp_enqueue_script('bootstrapbundle', get_template_directory_uri() . '/assets/js/vendor/bootstrap.min.js', ['jquery'],
        1.1, true);
    wp_enqueue_script('datepicker', get_template_directory_uri() . '/assets/js/datepicker.js', [], 1.1, true);
    wp_enqueue_script('plugins', get_template_directory_uri() . '/assets/js/plugins.js', [], 1.1,
        true);
    wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', [], 1.1, true);
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', [], null, true);
    // if (is_singular() && comments_open() && get_option('thread_comments')) {
    //     wp_enqueue_script('comment-reply');
    // }
}
add_action('wp_enqueue_scripts', 'venue_theme_scripts');

// Include breadcrumb functionality for the theme.
// include_once 'inc/beadcrumb.php';
include_once 'inc/template-function.php';

include_once 'inc/widget.php';
include_once 'inc/nav-walker.php';

if (class_exists('Kirki')) {
    include_once get_template_directory() . '/inc/venue-kirki.php';
}
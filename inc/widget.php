<?php

    // Social Widget
    class WP_Widget_Social_Icons extends WP_Widget
    {

        public function __construct()
        {
            parent::__construct(
                'social_icons_widget',
                __('Social Icons', 'textdomain'),
                ['description' => __('A widget to display social media icons.', 'textdomain')]
            );
        }

        public function widget($args, $instance)
        {
            echo $args['before_widget'];
        ?>
<ul class="social-icons">
    <li>
        <?php if (! empty($instance['facebook'])): ?>
        <a href="<?php echo esc_url($instance['facebook']); ?>"><i class="fa fa-facebook"></i></a>
        <?php endif; ?>
        <?php if (! empty($instance['twitter'])): ?>
        <a href="<?php echo esc_url($instance['twitter']); ?>"><i class="fa fa-twitter"></i></a>
        <?php endif; ?>
        <?php if (! empty($instance['linkedin'])): ?>
        <a href="<?php echo esc_url($instance['linkedin']); ?>"><i class="fa fa-linkedin"></i></a>
        <?php endif; ?>
        <?php if (! empty($instance['rss'])): ?>
        <a href="<?php echo esc_url($instance['rss']); ?>"><i class="fa fa-rss"></i></a>
        <?php endif; ?>
        <?php if (! empty($instance['dribbble'])): ?>
        <a href="<?php echo esc_url($instance['dribbble']); ?>"><i class="fa fa-dribbble"></i></a>
        <?php endif; ?>
    </li>
</ul>
<?php
    echo $args['after_widget'];
        }

        public function form($instance)
        {
            $fields = [
                'facebook' => 'Facebook URL',
                'twitter'  => 'Twitter URL',
                'linkedin' => 'LinkedIn URL',
                'rss'      => 'RSS URL',
                'dribbble' => 'Dribbble URL',
            ];

            foreach ($fields as $key => $label) {
                $value = ! empty($instance[$key]) ? esc_attr($instance[$key]) : '';
            ?>
<p>
    <label for="<?php echo $this->get_field_id($key); ?>"><?php echo $label; ?>:</label>
    <input class="widefat" id="<?php echo $this->get_field_id($key); ?>"
        name="<?php echo $this->get_field_name($key); ?>" type="text" value="<?php echo $value; ?>">
</p>
<?php
    }
        }

        public function update($new_instance, $old_instance)
        {
            $instance = [];
            foreach (['facebook', 'twitter', 'linkedin', 'rss', 'dribbble'] as $field) {
                $instance[$field] = (! empty($new_instance[$field])) ? strip_tags($new_instance[$field]) : '';
            }
            return $instance;
        }
    }

    // Register Widget
    function register_social_icons_widget()
    {
        register_widget('WP_Widget_Social_Icons');
    }
    add_action('widgets_init', 'register_social_icons_widget');

    // Footer Menu Widget

    class Venue_Footer_Menu_Widget extends WP_Widget
    {
        public function __construct()
        {
            parent::__construct(
                'venue_footer_menu',
                __('Venue Footer Menu', 'venue'),
                ['description' => __('Displays a custom footer menu with icons.', 'venue')]
            );
        }

        public function widget($args, $instance)
        {
            echo $args['before_widget'];

            if (! empty($instance['title'])) {
                echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
            }

            $menu_id = ! empty($instance['menu']) ? $instance['menu'] : '';

            if ($menu_id && ($menu = wp_get_nav_menu_object($menu_id))) {
                $menu_items = wp_get_nav_menu_items($menu->term_id);

                if (! empty($menu_items)) {
                    echo '<ul>';
                    foreach ($menu_items as $item) {
                        echo '<li><a href="' . esc_url($item->url) . '"><i class="fa fa-stop"></i>' . esc_html($item->title) . '</a></li>';
                    }
                    echo '</ul>';
                }
            }

            echo $args['after_widget'];
        }

        public function form($instance)
        {
            $title   = ! empty($instance['title']) ? $instance['title'] : __('Footer Menu', 'venue');
            $menu_id = ! empty($instance['menu']) ? $instance['menu'] : '';
            $menus   = wp_get_nav_menus();
        ?>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
        name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
</p>
<p>
    <label for="<?php echo $this->get_field_id('menu'); ?>"><?php _e('Select Menu:'); ?></label>
    <select class="widefat" id="<?php echo $this->get_field_id('menu'); ?>"
        name="<?php echo $this->get_field_name('menu'); ?>">
        <?php foreach ($menus as $menu): ?>
        <option value="<?php echo $menu->term_id; ?>" <?php selected($menu_id, $menu->term_id); ?>>
            <?php echo esc_html($menu->name); ?>
        </option>
        <?php endforeach; ?>
    </select>
</p>
<?php
    }

        public function update($new_instance, $old_instance)
        {
            $instance          = [];
            $instance['title'] = sanitize_text_field($new_instance['title']);
            $instance['menu']  = sanitize_text_field($new_instance['menu']);
            return $instance;
        }
    }

    // Register the widget
    function register_venue_footer_menu_widget()
    {
        register_widget('Venue_Footer_Menu_Widget');
    }
    add_action('widgets_init', 'register_venue_footer_menu_widget');

    // Contact Info Widget

    class Venue_Footer_Contact_Widget extends WP_Widget
    {
        public function __construct()
        {
            parent::__construct(
                'venue_footer_contact',
                __('Venue Footer Contact Info', 'venue'),
                ['description' => __('Displays dynamic contact info with repeater items.', 'venue')]
            );
        }

        public function widget($args, $instance)
        {
            echo $args['before_widget'];

            $title       = ! empty($instance['title']) ? $instance['title'] : __('Contact Information', 'venue');
            $description = ! empty($instance['description']) ? $instance['description'] : '';
            $items       = ! empty($instance['items']) && is_array($instance['items']) ? $instance['items'] : [];

            echo '<div class="footer-heading"><h4>' . esc_html($title) . '</h4></div>';

            if (! empty($description)) {
                echo '<p>' . esc_html($description) . '</p>';
            }

            if (! empty($items)) {
                echo '<ul>';
                foreach ($items as $item) {
                    $label = ! empty($item['label']) ? esc_html($item['label']) : '';
                    $value = ! empty($item['value']) ? esc_html($item['value']) : '';
                    $url   = ! empty($item['url']) ? esc_url($item['url']) : '#';

                    if ($label && $value) {
                        echo '<li><span>' . $label . ':</span><a href="' . $url . '">' . $value . '</a></li>';
                    }
                }
                echo '</ul>';
            }

            echo $args['after_widget'];
        }

        public function form($instance)
        {
            $title       = ! empty($instance['title']) ? esc_attr($instance['title']) : __('Contact Information', 'venue');
            $description = ! empty($instance['description']) ? esc_textarea($instance['description']) : '';
            $items       = ! empty($instance['items']) && is_array($instance['items']) ? $instance['items'] : [];

        ?>
<p>
    <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'venue'); ?></label>
    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
        name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
    <label
        for="<?php echo esc_attr($this->get_field_id('description')); ?>"><?php _e('Description:', 'venue'); ?></label>
    <textarea class="widefat" rows="4" id="<?php echo esc_attr($this->get_field_id('description')); ?>"
        name="<?php echo esc_attr($this->get_field_name('description')); ?>"><?php echo $description; ?></textarea>
</p>

<div><strong><?php _e('Contact Items (Label, Value, URL)', 'venue'); ?></strong></div>
<?php for ($i = 0; $i < 5; $i++):
                $label = isset($items[$i]['label']) ? esc_attr($items[$i]['label']) : '';
                $value = isset($items[$i]['value']) ? esc_attr($items[$i]['value']) : '';
                $url   = isset($items[$i]['url']) ? esc_url($items[$i]['url']) : '';
            ?>
<p>
    <input class="widefat" placeholder="Label (e.g. Phone)"
        name="<?php echo esc_attr($this->get_field_name("items")); ?>[<?php echo $i; ?>][label]" type="text"
        value="<?php echo $label; ?>" />

    <input class="widefat" placeholder="Value (e.g. 010-050-0550)"
        name="<?php echo esc_attr($this->get_field_name("items")); ?>[<?php echo $i; ?>][value]" type="text"
        value="<?php echo $value; ?>" />

    <input class="widefat" placeholder="Link (e.g. tel:010-050-0550)"
        name="<?php echo esc_attr($this->get_field_name("items")); ?>[<?php echo $i; ?>][url]" type="text"
        value="<?php echo $url; ?>" />
</p>
<hr>
<?php endfor; ?>

<p style="font-size: 11px; color: #666;">(You can support up to 5 contact fields. Extend the loop for more.)</p>
<?php
    }

        public function update($new_instance, $old_instance)
        {
            $instance                = [];
            $instance['title']       = sanitize_text_field($new_instance['title']);
            $instance['description'] = sanitize_textarea_field($new_instance['description']);
            $instance['items']       = [];

            if (! empty($new_instance['items']) && is_array($new_instance['items'])) {
                foreach ($new_instance['items'] as $item) {
                    if (! empty($item['label']) && ! empty($item['value'])) {
                        $instance['items'][] = [
                            'label' => sanitize_text_field($item['label']),
                            'value' => sanitize_text_field($item['value']),
                            'url'   => esc_url_raw($item['url']),
                        ];
                    }
                }
            }

            return $instance;
        }
    }

    // Register the widget
    function register_venue_footer_contact_widget()
    {
        register_widget('Venue_Footer_Contact_Widget');
}
add_action('widgets_init', 'register_venue_footer_contact_widget');
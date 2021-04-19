<?php
/**
 * Add async and defer attributes to enqueued scripts where needed.
 */
/* function my_async_scripts( $tag, $handle, $src ) {
    // the handles of the enqueued scripts we want to async
    $async_scripts = array( 'ferus-core-ga-maps', );

    if ( in_array( $handle, $async_scripts ) ) {
        return '<script type="text/javascript" src="' . $src . '" async defer></script>' . "\n";
    }

    return $tag;
}
add_filter( 'script_loader_tag', 'my_async_scripts', 10, 3 ); */

/******************************************************************************/
/* Enqueue Styles and Scripts */
/******************************************************************************/
function ferus_core_enqueue_custom_scripts() {
    /* CSS */
    //wp_enqueue_style('lato', 'https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i,900,900i');
    //wp_enqueue_style('pt-sans', 'https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i');
    wp_enqueue_style('open-sans', 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap');
    wp_enqueue_style('baskerville', 'https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap');
    wp_enqueue_style('great-vibes', 'https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap');
    //wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('ferus-core-bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style('slick-style', get_template_directory_uri() . '/css/slick.css');
    wp_enqueue_style('slick-theme-style', get_template_directory_uri() . '/css/slick-theme.css');
    //wp_enqueue_style('lightbox-css', get_template_directory_uri() . '/css/lightbox.min.css');
    wp_enqueue_style('lightbox-css', get_template_directory_uri() . '/css/featherlight.min.css');
    wp_enqueue_style('lightbox-gallery-css', get_template_directory_uri() . '/css/featherlight.gallery.min.css');
    wp_enqueue_style('mapbox-css', 'https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css');
    wp_enqueue_style('fc-theme-style', get_template_directory_uri() . '/css/ferus-core.css', array(), '1.0.1');
    //wp_enqueue_style('fc-custom-style', get_template_directory_uri() . '/css/custom.css', array(), '1.0.1');
    wp_enqueue_style('animate-css', get_template_directory_uri() . '/css/animate.min.css');
    /* JS */
    wp_enqueue_script('cc-fontawesome', 'https://kit.fontawesome.com/400d5ec791.js', array(), 1.0, false);
    wp_enqueue_script('ferus-core-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), 1.0, true);
    wp_enqueue_script('ferus-core-slick', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), 1.0, true);
    //wp_enqueue_script('ferus-core-lightbox', get_template_directory_uri() . '/js/lightbox.min.js', array('jquery'), 1.0, true);
    wp_enqueue_script('ferus-core-lightbox', get_template_directory_uri() . '/js/featherlight.min.js', array('jquery'), 1.0, true);
    wp_enqueue_script('ferus-core-lightbox-gallery', get_template_directory_uri() . '/js/featherlight.gallery.min.js', array('jquery'), 1.0, true);
    wp_enqueue_script('ferus-core-eqcss', get_template_directory_uri() . '/js/EQCSS.min.js', array(), 1.0, true);
    wp_enqueue_script('ferus-core-mapbox', 'https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js', array(), 1.0, true);
    wp_enqueue_script('ferus-core-custom-script', get_template_directory_uri() . '/js/ferus-core.js', array('jquery'), 1.0, true);

}

add_action('wp_enqueue_scripts', 'ferus_core_enqueue_custom_scripts');

/* Admin Styles and Scripts */
function ferus_core_enqueue_custom_admin_scripts() {
    wp_enqueue_style('ferus_core-custom-admin-style', get_template_directory_uri() . '/css/ferus-core-admin.css');
}

add_action('admin_enqueue_scripts', 'ferus_core_enqueue_custom_admin_scripts');

/**
 * Bloack wp-admin access to all users except admins
 */
/*add_action( 'init', 'blockusers_init' );
function blockusers_init() {
    if ( is_admin() && ! current_user_can( 'administrator' ) &&
        ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
        wp_redirect( home_url() );
        exit;
    }
}*/

/**
 * Disable Admin Bar for all users but admin
 */
add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}

/**
 * Redirect logged out users to the login page
 * &
 * Redirect the login page to landlord members for logged in users
 */
/* add_action( 'template_redirect', 'redirect_logged_out_users' );

function redirect_logged_out_users() {

    if ( is_page('landlord-members') && ! is_user_logged_in() ) {
        wp_redirect( '/login/' );
        exit;
    } else if ( is_page('owner-members') && ! is_user_logged_in() ) {
        wp_redirect( '/login/' );
        exit;
    } else if ( is_page('login') && is_user_logged_in() ) {
        wp_redirect( '/owner-members/' );
        exit;
    }
} */

/**
 * Disable WYSIWYG for pages
 */
add_filter( 'user_can_richedit', 'patrick_user_can_richedit');

function patrick_user_can_richedit($c) {
    global $post_type;

    if ('page' == $post_type)
        return false;
    return $c;
}

/**
 * Register Custom Image Sizes
 */
add_image_size('slider-thumb', 200, 100, array('center', 'center')); // Hard crop center
add_image_size( 'headshot-sq', 800, 800, array( 'center', 'center' ) ); // Hard crop center

// Remove auto p from content (needed for proper html content in pages)
//remove_filter( 'the_content', 'wpautop' );
//remove_filter( 'the_excerpt', 'wpautop' );
function remove_wpautop_on_pages() {
    if ( is_page() ) {
        remove_filter( 'the_content', 'wpautop' );
        remove_filter( 'the_excerpt', 'wpautop' );
    }
}
add_action( 'wp_head', 'remove_wpautop_on_pages' );

/**
 * Register Menu Locations
 */
register_nav_menus( array(
    'menu-left' => 'Menu Left',
    'menu-right' => 'Menu Right',
    'mobile-menu' => 'Mobile Menu',
    'footer' => 'Footer'
) );

/**
 * Append Search to Menu
 */
/*add_filter('wp_nav_menu_items','add_search_box_to_menu', 10, 2);
function add_search_box_to_menu( $items, $args ) {
    if( $args->theme_location == 'menu-1' )
        return $items."<li class='menu-header-search'><form action='http://example.com/' id='searchform' method='get'><input type='text' name='s' id='s' placeholder='Search'></form></li>";

    return $items;
}*/

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ferus_core_sidebar_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar Left', 'ferus_core' ),
        'id'            => 'sidebar-2',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Alert Banner', 'ferus_core' ),
        'id'            => 'alert-banner',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Toolbar', 'ferus_core' ),
        'id'            => 'toolbar',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Page Header', 'ferus_core' ),
        'id'            => 'page-header',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Page Top', 'ferus_core' ),
        'id'            => 'page-top',
        'before_widget' => '<div id="%1$s" class="%2$s '. ferus_core_widget_count('page-top') .'">',
        'after_widget'  => '</div>',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Page Inner-Top', 'ferus_core' ),
        'id'            => 'inner-top',
        'before_widget' => '<div id="%1$s" class="%2$s '. ferus_core_widget_count('inner-top') .'">',
        'after_widget'  => '</div>',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Page Inner-Bottom', 'ferus_core' ),
        'id'            => 'inner-bottom',
        'before_widget' => '<div id="%1$s" class="%2$s '. ferus_core_widget_count('inner-bottom') .'">',
        'after_widget'  => '</div>',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Page Bottom', 'ferus_core' ),
        'id'            => 'page-bottom',
        'before_widget' => '<div id="%1$s" class="%2$s '. ferus_core_widget_count('page-bottom') .'">',
        'after_widget'  => '</div>',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Banner Bottom', 'ferus_core' ),
        'id'            => 'banner-bottom',
        'before_widget' => '<div id="%1$s" class="%2$s '. ferus_core_widget_count('banner-bottom') .'">',
        'after_widget'  => '</div>',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    /*register_sidebar( array(
        'name'          => __( 'Contact Page Map', 'ferus_core' ),
        'id'            => 'contact-page-map',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );*/
    /*register_sidebar( array(
        'name'          => __( 'Footer Left', 'ferus_core' ),
        'id'            => 'footer-left',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Right', 'ferus_core' ),
        'id'            => 'footer-right',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );*/
    register_sidebar( array(
        'name'          => __( 'Footer', 'ferus_core' ),
        'id'            => 'footer-content',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<!-- ',
        'after_title'   => ' -->',
    ) );
}

add_action('widgets_init', 'ferus_core_sidebar_init');

/**
 * Remove wpautop from widgets
 */
add_filter( 'widget_display_callback', 'widget_wpautop_widget_display_callback', 10, 3 );
function widget_wpautop_widget_display_callback( $instance, $widget, $args ) {
    $instance['filter'] = false;
    return $instance;
}

/**
 * Count number of widgets in a sidebar
 * Used to add classes to widget areas so widgets can be displayed one, two, three or four per row
 */
function ferus_core_widget_count( $sidebar_id ) {
    // If loading from front page, consult $_wp_sidebars_widgets rather than options
    // to see if wp_convert_widget_settings() has made manipulations in memory.
    global $_wp_sidebars_widgets;
    if ( empty( $_wp_sidebars_widgets ) ) :
        $_wp_sidebars_widgets = get_option( 'sidebars_widgets', array() );
    endif;

    $sidebars_widgets_count = $_wp_sidebars_widgets;

    if ( isset( $sidebars_widgets_count[ $sidebar_id ] ) ) :
        $widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );
        $widget_classes = 'widget-count-' . count( $sidebars_widgets_count[ $sidebar_id ] );
        if ( $widget_count % 4 == 0 || $widget_count > 6 ) :
            // Four widgets per row if there are exactly four or more than six
            $widget_classes .= ' widget-col-4';
        elseif ( $widget_count >= 3 ) :
            // Three widgets per row if there's three or more widgets
            $widget_classes .= ' widget-col-3';
        elseif ( 2 == $widget_count ) :
            // Otherwise show two widgets per row
            $widget_classes .= ' widget-col-2';
        endif;

        return $widget_classes;
    endif;
}

/**
 * Enable Shortcodes in Widgets
 */
add_filter('widget_text', 'do_shortcode');

/**
 * Return the widget title only if the first character is not "!"
 */
add_filter('widget_title', 'remove_widget_title');
function remove_widget_title($widget_title) {
    if (substr($widget_title, 0, 1) == '!')
        return;
    else
        return ($widget_title);
}

/**
 * Excerpt Length
 */
function custom_excerpt_length( $length ) {
    return 50;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
/**
 * Excerpt More
 */
function new_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

/**
 * Truncate Titles
 */
function FeaturedTitle($text) {
    $chars_limit = 100;
    $chars_text = strlen($text);
    $text = $text . " ";
    $text = substr($text, 0, $chars_limit);
    $text = substr($text, 0, strrpos($text, ' '));

    if ($chars_text > $chars_limit) {
        $text = $text . "...";
    }
    return $text;
}

/**
 * Truncates text.
 *
 * Cuts a string to the length of $length and replaces the last characters
 * with the ending if the text is longer than length.
 *
 * @param string  $text String to truncate.
 * @param integer $length Length of returned string, including ellipsis.
 * @param string  $ending Ending to be appended to the trimmed string.
 * @param boolean $exact If false, $text will not be cut mid-word
 * @param boolean $considerHtml If true, HTML tags would be handled correctly
 * @return string Trimmed string.
 *
 * Usage:
 * $excerpt_length = 250;
 * $content = apply_filters('the_content', get_the_content());
 * $excerpt = truncate( $content, $excerpt_length, '', false, true );
 *
 */
function truncate($text, $length = 100, $ending = '...', $exact = true, $considerHtml = false) {
    if ($considerHtml) {
        // if the plain text is shorter than the maximum length, return the whole text
        if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
            return $text;
        }

        // splits all html-tags to scanable lines
        preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);

        $total_length = strlen($ending);
        $open_tags = array();
        $truncate = '';

        foreach ($lines as $line_matchings) {
            // if there is any html-tag in this line, handle it and add it (uncounted) to the output
            if (!empty($line_matchings[1])) {
                // if it's an "empty element" with or without xhtml-conform closing slash (f.e. <br/>)
                if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
                    // do nothing
                    // if tag is a closing tag (f.e. </b>)
                } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
                    // delete tag from $open_tags list
                    $pos = array_search($tag_matchings[1], $open_tags);
                    if ($pos !== false) {
                        unset($open_tags[$pos]);
                    }
                    // if tag is an opening tag (f.e. <b>)
                } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
                    // add tag to the beginning of $open_tags list
                    array_unshift($open_tags, strtolower($tag_matchings[1]));
                }
                // add html-tag to $truncate'd text
                $truncate .= $line_matchings[1];
            }

            // calculate the length of the plain text part of the line; handle entities as one character
            $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
            if ($total_length+$content_length> $length) {
                // the number of characters which are left
                $left = $length - $total_length;
                $entities_length = 0;
                // search for html entities
                if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
                    // calculate the real length of all entities in the legal range
                    foreach ($entities[0] as $entity) {
                        if ($entity[1]+1-$entities_length <= $left) {
                            $left--;
                            $entities_length += strlen($entity[0]);
                        } else {
                            // no more characters left
                            break;
                        }
                    }
                }
                $truncate .= substr($line_matchings[2], 0, $left+$entities_length);
                // maximum lenght is reached, so get off the loop
                break;
            } else {
                $truncate .= $line_matchings[2];
                $total_length += $content_length;
            }

            // if the maximum length is reached, get off the loop
            if($total_length>= $length) {
                break;
            }
        }
    } else {
        if (strlen($text) <= $length) {
            return $text;
        } else {
            $truncate = substr($text, 0, $length - strlen($ending));
        }
    }

    // if the words shouldn't be cut in the middle...
    if (!$exact) {
        // ...search the last occurance of a space...
        $spacepos = strrpos($truncate, ' ');
        if (isset($spacepos)) {
            // ...and cut the text in this position
            $truncate = substr($truncate, 0, $spacepos);
        }
    }

    // add the defined ending to the text
    $truncate .= $ending;

    if($considerHtml) {
        // close all unclosed html-tags
        foreach ($open_tags as $tag) {
            $truncate .= '</' . $tag . '>';
        }
    }

    return $truncate;

}

/**
 * Remove "Private" and "Protected" from post and page titles
 * @param $title
 * @return mixed
 */
/* function the_title_trim_private($title) {
    $title = attribute_escape($title);
    $findthese = array(
        '#Protected:#',
        '#Private:#'
    );
    $replacewith = array(
        '',
        ''
    );
    $title = preg_replace($findthese, $replacewith, $title);
    return $title;
}
add_filter('the_title', 'the_title_trim_private'); */

/**
 * Search Filter - remove specific pages from search
 */
/*function page_search_filter( $query ) {
  if ( $query->is_search && $query->is_main_query() ) {
    $query->set( 'post__not_in', array( 63,65,88,90 ) );
  }
}
add_action( 'pre_get_posts', 'page_search_filter' );*/

/**
 * Featured Image in admin post list
 */
add_filter('manage_posts_columns', 'add_thumbnail_column', 5);

function add_thumbnail_column($columns) {
    $columns['new_post_thumb'] = __('Featured Image');
    return $columns;
}

add_action('manage_posts_custom_column', 'display_thumbnail_column', 5, 2);

function display_thumbnail_column($column_name, $post_id) {
    switch ($column_name) {
        case 'new_post_thumb':
            $post_thumbnail_id = get_post_thumbnail_id($post_id);
            if ($post_thumbnail_id) {
                $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'thumbnail');
                echo '<img width="100" src="' . $post_thumbnail_img[0] . '" />';
            }
            break;
    }
}
/******************************************************************************
 * Featured Image Header Height Meta Box
 * Display/Hide the Page Title
 ******************************************************************************/
function header_height_get_meta( $value ) {
    global $post;

    $field = get_post_meta( $post->ID, $value, true );
    if ( ! empty( $field ) ) {
        return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
    } else {
        return false;
    }
}

function header_height_add_meta_box() {
    add_meta_box(
        'header_height-header-height',
        __( 'Header Height', 'header_height' ),
        'header_height_html',
        'page',
        'side',
        'default'
    );
}
add_action( 'add_meta_boxes', 'header_height_add_meta_box' );

function header_height_html( $post) {
    wp_nonce_field( '_header_height_nonce', 'header_height_nonce' ); ?>

    <p>Change the height of the header image.</p>

    <p>
    <label for="header_height_size"><?php _e( 'Size', 'header_height' ); ?></label><br>
    <select name="header_height_size" id="header_height_size">
        <option <?php echo (header_height_get_meta( 'header_height_size' ) === 'Normal' ) ? 'selected' : '' ?>>Normal</option>
        <option <?php echo (header_height_get_meta( 'header_height_size' ) === 'Narrow' ) ? 'selected' : '' ?>>Narrow</option>
        <option <?php echo (header_height_get_meta( 'header_height_size' ) === 'Tall' ) ? 'selected' : '' ?>>Tall</option>
        <option <?php echo (header_height_get_meta( 'header_height_size' ) === 'None' ) ? 'selected' : '' ?>>None</option>
    </select>
    </p><?php
}

function header_height_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! isset( $_POST['header_height_nonce'] ) || ! wp_verify_nonce( $_POST['header_height_nonce'], '_header_height_nonce' ) ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;


    if ( isset( $_POST['header_height_size'] ) )
        update_post_meta( $post_id, 'header_height_size', esc_attr( $_POST['header_height_size'] ) );
    else
        update_post_meta( $post_id, 'header_height_size', null );
}
add_action( 'save_post', 'header_height_save' );

/*
  Usage: header_height_get_meta( 'header_height_size' )
*/

/******************************************************************************
 * Custom Header Content Meta Box
 ******************************************************************************/
function custom_header_content_get_meta( $value ) {
    global $post;

    $field = get_post_meta( $post->ID, $value, true );
    if ( ! empty( $field ) ) {
        return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
    } else {
        return false;
    }
}

function ferus_create_custom_header_content( $post ) {

    do_meta_boxes( null, 'custom-header-content', $post );
}
add_action( 'edit_form_after_title', 'ferus_create_custom_header_content' );

function ferus_add_custom_header_content_box() {
    add_meta_box(
        'custom_header_content',
        __( 'Custom Header Content', 'custom_header_content' ),
        'ferus_render_header_metabox',
        'page',
        'custom-header-content'
    );
}
add_action( 'add_meta_boxes', 'ferus_add_custom_header_content_box' );

function ferus_render_header_metabox( $post ) {
    wp_nonce_field( '_custom_header_content_nonce', 'custom_header_content_nonce' ); ?>
    <div class="ferus-admin-group">
        <label for="custom_header_content_title"><?php _e( 'Title', 'custom_header_content' ); ?></label>
        <input type="text" name="custom_header_content_title" id="custom_header_content_title" value="<?php echo custom_header_content_get_meta( 'custom_header_content_title' ); ?>">
    </div>
    <div class="ferus-admin-group">
        <label for="custom_header_content_content"><?php _e( 'Content', 'custom_header_content' ); ?></label>
        <textarea name="custom_header_content_content" id="custom_header_content_content" rows="5"><?php echo custom_header_content_get_meta( 'custom_header_content_content' ); ?></textarea>
    </div>
    <div class="ferus-admin-group">
        <label>Content Location</label>
        <ul class="custom-content-location">
            <li>
                <input type="radio" name="custom_header_content_location" id="custom_content_location_0" value="content-center" checked>
                <label for="custom_content_location_0">Center</label>
            </li>
            <li>
                <input type="radio" name="custom_header_content_location" id="custom_content_location_1" value="content-left" <?php echo ( custom_header_content_get_meta( 'custom_header_content_location' ) === 'content-left' ) ? 'checked' : ''; ?>>
                <label for="custom_content_location_1">Left</label>
            </li>
            <li>
                <input type="radio" name="custom_header_content_location" id="custom_content_location_2" value="content-right" <?php echo ( custom_header_content_get_meta( 'custom_header_content_location' ) === 'content-right' ) ? 'checked' : ''; ?>>
                <label for="custom_content_location_2">Right</label>
            </li>
        </ul>
    </div>
    <?php
}

function custom_header_content_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! isset( $_POST['custom_header_content_nonce'] ) || ! wp_verify_nonce( $_POST['custom_header_content_nonce'], '_custom_header_content_nonce' ) ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['custom_header_content_title'] ) )
        update_post_meta( $post_id, 'custom_header_content_title', esc_attr( $_POST['custom_header_content_title'] ) );
    if ( isset( $_POST['custom_header_content_content'] ) )
        update_post_meta( $post_id, 'custom_header_content_content', esc_attr( $_POST['custom_header_content_content'] ) );
    if ( isset( $_POST['custom_header_content_location'] ) )
        update_post_meta( $post_id, 'custom_header_content_location', esc_attr( $_POST['custom_header_content_location'] ) );
}
add_action( 'save_post', 'custom_header_content_save' );

/*
	Usage: custom_header_content_get_meta( 'custom_header_content_title' )
	Usage: custom_header_content_get_meta( 'custom_header_content_content' )
    Usage: custom_header_content_get_meta( 'custom_header_content_location' )
*/
/******************************************************************************
 * Menu Shortcode
 ******************************************************************************/
function list_menu_shortcode($atts, $content = null) {

    extract(shortcode_atts(
            array(
                'menu'            => '',
                'container'       => 'div',
                'container_class' => 'list-menu',
                'container_id'    => '',
                'menu_class'      => 'menu',
                'menu_id'         => '',
                'echo'            => true,
                'fallback_cb'     => 'wp_page_menu',
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'depth'           => 0,
                'walker'          => '',
                'theme_location'  => ''
        ), $atts)
    );

    return wp_nav_menu( array(
        'menu'            => $menu,
        'container'       => $container,
        'container_class' => $container_class,
        'container_id'    => $container_id,
        'menu_class'      => $menu_class,
        'menu_id'         => $menu_id,
        'echo'            => false,
        'fallback_cb'     => $fallback_cb,
        'before'          => $before,
        'after'           => $after,
        'link_before'     => $link_before,
        'link_after'      => $link_after,
        'depth'           => $depth,
        'walker'          => $walker,
        'theme_location'  => $theme_location
    ));
}

add_shortcode("list-menu", "list_menu_shortcode");
/******************************************************************************
 * Must Reads Shortcode
 ******************************************************************************/
function must_reads_shortcode($atts, $content = null) {
    ob_start();
    global $post;
    // Attributes
    extract(shortcode_atts(
            array(
                'posts' => '4',
                'category' => '',
                'wrapper' => '',
            ), $atts)
    );

    // Code
    $recent_args = array(
        'post_type' => 'post',
        'category_name' => $category,
        'posts_per_page' => $posts,
        'order' => 'DESC'
    );
    $recent_query = new WP_Query($recent_args);
    if ($recent_query->have_posts()) : ?>
        <?php
        $container_class = $wrapper;
        $postCount = $recent_args['posts_per_page'];
        $columnWidth = 'col-sm-6 col-md-3';
        if ($postCount === '1') {
            $columnWidth = 'col-md-12';
        } else if ($postCount === '2') {
            $columnWidth = 'col-sm-12 col-md-6';
        } else if ($postCount === '3' || $postCount === '6') {
            $columnWidth = 'col-sm-12 col-md-4';
        }
        ?>
        <div class="must-reads-wrap <?php echo $container_class; ?>">
            <div class="row">
                <?php while ( $recent_query->have_posts() ) : $recent_query->the_post(); ?>
                    <?php
                    // Get Image
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'post-med');
                    if ($image) {
                        $image = $image[0];
                    } else {
                        $image = '/wp-content/themes/concore/inc/images/hero.jpg';
                    }
                    // Get Post Format
                    $format = get_post_format() ?: 'standard';
                    ?>
                    <div class="post-item <?php echo $columnWidth; ?> <?php echo $format; ?>" data-col="post-item">
                        <article id="post-<?php echo $post->ID; ?>" class="post-<?php echo $post->ID; ?> post-inner">

                            <div class="category">
                                <?php the_category(' | ', '', $post->ID); ?>
                            </div>

                            <a class="post-thumb" href="<?php echo get_permalink($post->ID); ?>" style="background-image: url(<?php echo $image; ?>);">
                                <!-- <div class="post-format">
                            <?php if ($format === 'case-study' || $format === 'quote'): ?>
                                <i class="fa fa-pie-chart"></i> <span>Case Study</span>
                            <?php elseif ($format === 'infographic' || $format === 'image'): ?>
                                <i class="fa fa-bar-chart"></i> <span>Infographic</span>
                            <?php elseif ($format === 'video'): ?>
                                <i class="fa fa-play-circle-o"></i> <span>Video</span>
                            <?php else: ?>
                            <?php endif; ?>
                        </div> -->
                            </a><!-- .post-thumb -->

                            <div class="post-content">
                                <p class="author-date"><?php the_author(); ?> | <?php the_time('F d, Y'); ?></p>
                                <h2 class="post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <p class="content-blurb">
                                    <?php echo wp_trim_words(get_the_content(), 13, '...'); ?>
                                </p>
                                <!-- <a href="<?php // the_permalink(); ?>" data-button="arrow">Read More</a> -->
                                <hr>
                            </div>

                        </article>
                    </div><!-- .post-item -->
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div><!-- .row -->
        </div><!-- .container -->
    <?php else : ?>
        <p>Sorry! No posts found within your criteria.</p>
    <?php endif;
    $output = ob_get_clean();
    return $output;
}

add_shortcode('must-reads', 'must_reads_shortcode');
/******************************************************************************
 * Homepage Must Reads Shortcode
 ******************************************************************************/
function hp_must_reads_shortcode($atts, $content = null) {
    ob_start();
    global $post;
    // Attributes
    extract(shortcode_atts(
            array(
                'posts' => '4',
                'category' => '',
                'wrapper' => '',
            ), $atts)
    );

    // Code
    $post_1 = array(
        'post_type' => 'post',
        'category_name' => $category,
        'posts_per_page' => '1',
        'meta_query' => array(
            'relation' => 'AND',
			array(
                'key'     => 'hp_article',
                'value'   => true,
                'compare' => '='
            ),
            array(
                'key'     => 'hp_position',
                'value'   => '1',
                'compare' => '='
            ),
		),
    );
    $post_2 = array(
        'post_type' => 'post',
        'category_name' => $category,
        'posts_per_page' => '1',
        'meta_query' => array(
            'relation' => 'AND',
			array(
                'key'     => 'hp_article',
                'value'   => true,
                'compare' => '='
            ),
            array(
                'key'     => 'hp_position',
                'value'   => '2',
                'compare' => '='
            ),
		),
    );
    $post_3 = array(
        'post_type' => 'post',
        'category_name' => $category,
        'posts_per_page' => '1',
        'meta_query' => array(
            'relation' => 'AND',
			array(
                'key'     => 'hp_article',
                'value'   => true,
                'compare' => '='
            ),
            array(
                'key'     => 'hp_position',
                'value'   => '3',
                'compare' => '='
            ),
		),
    );
    $post_4 = array(
        'post_type' => 'post',
        'category_name' => $category,
        'posts_per_page' => '1',
        'meta_query' => array(
            'relation' => 'AND',
			array(
                'key'     => 'hp_article',
                'value'   => true,
                'compare' => '='
            ),
            array(
                'key'     => 'hp_position',
                'value'   => '4',
                'compare' => '='
            ),
		),
    );
    $post1_query = new WP_Query($post_1);
    $post2_query = new WP_Query($post_2);
    $post3_query = new WP_Query($post_3);
    $post4_query = new WP_Query($post_4);

    $recent_query = new WP_Query();
    $recent_query->posts = array_merge( $post1_query->posts, $post2_query->posts, $post3_query->posts, $post4_query->posts );
    $recent_query->post_count = $post1_query->post_count + $post2_query->post_count + $post3_query->post_count + $post4_query->post_count;

    if ($recent_query->have_posts()) : ?>
        <?php
        $container_class = $wrapper;
        $postCount = $recent_args['posts_per_page'];
        $columnWidth = 'col-sm-6 col-md-3';
        if ($postCount === '1') {
            $columnWidth = 'col-md-12';
        } else if ($postCount === '2') {
            $columnWidth = 'col-sm-12 col-md-6';
        } else if ($postCount === '3' || $postCount === '6') {
            $columnWidth = 'col-sm-12 col-md-4';
        }
        ?>
        <div class="must-reads-wrap <?php echo $container_class; ?>">
            <div class="row">
                <?php while ( $recent_query->have_posts() ) : $recent_query->the_post(); ?>
                    <?php
                    // Get Image
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'post-med');
                    if ($image) {
                        $image = $image[0];
                    } else {
                        $image = '/wp-content/themes/concore/inc/images/hero.jpg';
                    }
                    // Get Post Format
                    //$format = get_post_format() ?: 'standard';
                    ?>
                    <div class="post-item <?php echo $columnWidth; ?> <?php echo $format; ?>" data-col="post-item">
                        <article id="post-<?php echo $post->ID; ?>" class="post-<?php echo $post->ID; ?> post-inner">

                            <div class="category">
                                <?php // the_category(' | ', '', $post->ID); ?>
                                <?php
                                $categories = get_the_category();
                                if ( ! empty( $categories ) ) {
                                    echo '<span>' . esc_html( $categories[0]->name ) . '</span>';
                                }
                                ?>
                            </div>

                            <a class="post-thumb" href="<?php echo get_permalink($post->ID); ?>" style="background-image: url(<?php echo $image; ?>);">
                                <!-- <div class="post-format">
                                <?php // if ($format === 'case-study' || $format === 'quote'): ?>
                                    <i class="fa fa-pie-chart"></i> <span>Case Study</span>
                                <?php // elseif ($format === 'infographic' || $format === 'image'): ?>
                                    <i class="fa fa-bar-chart"></i> <span>Infographic</span>
                                <?php // elseif ($format === 'video'): ?>
                                    <i class="fa fa-play-circle-o"></i> <span>Video</span>
                                <?php // else: ?>
                                <?php // endif; ?>
                            </div> -->
                            </a><!-- .post-thumb -->

                            <div class="post-content">
                                <p class="author-date"><?php // the_author(); ?><?php the_time('F d, Y'); ?></p>
                                <h2 class="post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <!-- <p class="content-blurb">
                                    <?php // echo wp_trim_words(get_the_content(), 13, '...'); ?>
                                </p> -->
                                <!-- <a href="<?php // the_permalink(); ?>" data-button="arrow">Read More</a> -->
                            </div>

                        </article>
                    </div><!-- .post-item -->
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div><!-- .row -->
        </div><!-- .container -->
    <?php else : ?>
        <p>Sorry! No posts found within your criteria.</p>
    <?php endif;
    $output = ob_get_clean();
    return $output;
}

add_shortcode('hp-must-reads', 'hp_must_reads_shortcode');
/******************************************************************************
 * Related Articles Shortcode
 ******************************************************************************/
function related_articles_shortcode($atts, $content = null) {
    ob_start();
    global $post;
    // Attributes
    extract(shortcode_atts(
            array(
                'posts' => '3',
                'category' => '',
                'tag' => '',
                'author' => '',
                'wrapper' => '',
            ), $atts)
    );

    // Code
    $related_args = array(
        'post_type' => 'post',
        'category_name' => $category,
        'tag' => $tag,
        'author_name' => $author,
        'posts_per_page' => $posts,
        'order' => 'DESC',
        'orderby' => 'rand'
    );
    $related_query = new WP_Query($related_args);
    if ($related_query->have_posts()) : ?>
        <?php
        $container_class = $wrapper;
        $postCount = $related_args['posts_per_page'];
        $columnWidth = 'col-sm-6 col-md-3';
        if ($postCount === '1') {
            $columnWidth = 'col-md-12';
        } else if ($postCount === '2') {
            $columnWidth = 'col-sm-12 col-md-6';
        } else if ($postCount === '3' || $postCount === '6') {
            $columnWidth = 'col-sm-12 col-md-4';
        }
        ?>
        <div class="related-articles-wrap <?php echo $container_class; ?>">
            <div class="row">
                <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
                    <?php
                    // Get Image
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'post-med');
                    if ($image) {
                        $image = $image[0];
                    } else {
                        $image = '/wp-content/themes/concore/inc/images/hero.jpg';
                    }
                    // Get Post Format
                    $format = get_post_format() ?: 'standard';
                    ?>
                    <div class="post-item <?php echo $columnWidth; ?> <?php echo $format; ?>" data-col="post-item">
                        <article id="post-<?php echo $post->ID; ?>" class="post-<?php echo $post->ID; ?> post-inner">

                            <!-- <div class="category">
                                <?php // the_category(' | ', '', $post->ID); ?>
                            </div> -->

                            <a class="post-thumb" href="<?php echo get_permalink($post->ID); ?>" style="background-image: url(<?php echo $image; ?>);"></a><!-- .post-thumb -->

                            <div class="post-content">
                                <h2 class="post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                            </div>

                        </article>
                    </div><!-- .post-item -->
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div><!-- .row -->
        </div><!-- .container -->
    <?php else : ?>
        <p>Sorry! No posts found within your criteria.</p>
    <?php endif;
    $output = ob_get_clean();
    return $output;
}

add_shortcode('related-articles', 'related_articles_shortcode');
/******************************************************************************
 * Article List Shortcode
 ******************************************************************************/
function article_list_shortcode($atts, $content = null) {
    ob_start();
    global $post;
    // Attributes
    extract(shortcode_atts(
            array(
                'posts' => '3',
                'category' => '',
                'offset' => '',
            ), $atts)
    );

    // Code
    $recent_args = array(
        'post_type' => 'post',
        'category_name' => $category,
        'posts_per_page' => $posts,
        'offset' => $offset,
        'order' => 'DESC'
    );
    $recent_query = new WP_Query($recent_args);
    if ($recent_query->have_posts()) : ?>
        <div class="article-list">
            <ul>
                <?php while ( $recent_query->have_posts() ) : $recent_query->the_post(); ?>
                    <?php
                    // Get Image
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'post-med');
                    if ($image) {
                        $image = $image[0];
                    } else {
                        $image = '/wp-content/themes/concore/inc/images/hero.jpg';
                    }
                    ?>
                    <li class="post-item">
                        <article id="post-<?php echo $post->ID; ?>" class="post-<?php echo $post->ID; ?> post-inner">

                            <div class="post-content">
                                <h2 class="post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <div class="post-details">
                                    <p class="author-date"><?php the_time('m-d-Y'); ?></p> |
                                    <a href="<?php the_permalink(); ?>">Read More</a>
                                </div>
                            </div>

                        </article>
                    </li><!-- .post-item -->
                <?php endwhile; ?>
            </ul>
            <div class="view-all">
                <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" data-button="arrow">View All</a>
            </div>
        </div><!-- .article-list -->
    <?php else : ?>
        <p>Sorry! No posts found within your criteria.</p>
    <?php endif;
    $output = ob_get_clean();
    return $output;
}

add_shortcode('article-list', 'article_list_shortcode');
/******************************************************************************
 * Featured Article Shortcode
 ******************************************************************************/
function featured_article_shortcode($atts, $content = null) {
    ob_start();
    global $post;
    // Attributes
    extract(shortcode_atts(
            array(
                'posts' => '1',
                'category' => '',
            ), $atts)
    );
    // Code
    $recent_args = array(
        'post_type' => 'post',
        'category_name' => $category,
        'posts_per_page' => $posts,
        'order' => 'DESC'
    );
    $recent_query = new WP_Query($recent_args);
    if ($recent_query->have_posts()) : ?>
        <div class="featured-article">
            <?php while ( $recent_query->have_posts() ) : $recent_query->the_post(); ?>
                <?php
                // Get Image
                $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'post-med');
                if ($image) {
                    $image = $image[0];
                } else {
                    $image = '/wp-content/themes/concore/inc/images/hero.jpg';
                }
                ?>
                <div class="post-item">
                    <article id="post-<?php echo $post->ID; ?>" class="post-<?php echo $post->ID; ?> post-inner">

                        <a class="post-thumb" href="<?php echo get_permalink($post->ID); ?>" style="background-image: url(<?php echo $image; ?>);"></a><!-- .post-thumb -->

                        <div class="post-content">
                            <h2 class="post-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <p class="content-blurb">
                                <?php echo wp_trim_words(get_the_content(), 33, '...'); ?>
                            </p>
                            <a href="<?php the_permalink(); ?>" data-button="arrow">Read More</a>
                        </div>

                    </article>
                </div><!-- .post-item -->
            <?php endwhile; ?>
        </div><!-- .featured-article -->
    <?php else : ?>
        <p>Sorry! No post found within your criteria.</p>
    <?php endif;
    $output = ob_get_clean();
    return $output;
}

add_shortcode('featured-article', 'featured_article_shortcode');
/******************************************************************************
 * Content Slider Shortcode
 ******************************************************************************/
function content_slider_shortcode($atts, $content = null) {
    ob_start();
    // Attributes
    extract(shortcode_atts(
            array(
                'posts' => '4',
                'category' => '',
            ), $atts)
    );

    // Code
    $recent_args = array(
        'post_type' => 'post',
        'category_name' => $category,
        'posts_per_page' => $posts,
        'order' => 'DESC'
    );
    $recent_query = new WP_Query($recent_args);
    if ($recent_query->have_posts()) : ?>
        <div class="content_slider content-slider">
            <?php while ( $recent_query->have_posts() ) : $recent_query->the_post(); ?>
                <?php
                $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
                $image = $feat_image[0] ? $feat_image[0] : get_template_directory_uri() . '/inc/images/hero.jpg';
                ?>
                <div>
                    <div class="col-md-7 content-img" data-col="content-slide">
                        <div class="img-wrap" style="background-image:url(<?php echo $image; ?>);"></div>
                        <!-- <img src="<?php //echo get_template_directory_uri(); ?>/inc/images/home-slide-01.jpg"> -->
                    </div>
                    <div class="col-md-5 slide-content" data-col="content-slide">
                        <p class="category"><?php the_category(' | ', '', $post->ID); ?></p>
                        <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
                        <!-- <p class="entry-excerpt"><?php // echo wp_trim_words(get_the_excerpt(), 18, '...'); ?></p> -->
                        <p class="entry-excerpt"><?php echo get_the_excerpt(); ?></p>
                        <p class="read-more"><a href="<?php the_permalink(); ?>" data-button>Learn More</a></p>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
            <!-- <p class="see-all-posts"><a href="<?php // echo site_url(); ?>">See All Posts</a></p> -->
        </div><!-- .recent-posts -->
    <?php else : ?>
        <p>Sorry! No posts found within your criteria.</p>
    <?php endif;
    $output = ob_get_clean();
    return $output;
}

add_shortcode('content-slider', 'content_slider_shortcode');
/******************************************************************************
 * Portfolio Shortcode
 ******************************************************************************/
function portfolio_slider_shortcode($atts, $content = null) {
    ob_start();
    // Attributes
    extract(shortcode_atts(
            array(
                'posts' => '4',
                'category' => '',
                'content' => '',
            ), $atts)
    );

    $content_pos = $content?$content:'right';
    $pos_class = 'content-pos-' . $content_pos;

    // Code
    $recent_args = array(
        'post_type' => 'post',
        'category_name' => $category,
        'posts_per_page' => $posts,
        'order' => 'DESC'
    );
    $recent_query = new WP_Query($recent_args);
    if ($recent_query->have_posts()) : ?>
        <div class="content_slider content-slider <?php echo $pos_class; ?>">
            <?php while ( $recent_query->have_posts() ) : $recent_query->the_post(); ?>
                <?php
                $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
                $image = $feat_image[0] ? $feat_image[0] : get_template_directory_uri() . '/inc/images/hero.jpg';
                $company_url = get_post_meta( get_the_ID(), 'portfolio_url', true );
                $excerpt_length = 250;
                $content = apply_filters('the_content', get_the_content());
                $excerpt = truncate( $content, $excerpt_length, '...', false, true );
                ?>
                <div>
                <?php if($content_pos === 'left') : ?>
                    <div class="col-md-5 slide-content" data-col="content-slide">
                        <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
                        <?php //if($company_url) : ?>
                            <!-- <a class="link" href="<?php //echo 'http://' . $company_url; ?>"><?php //echo $company_url; ?></a></a> -->
                        <?php //endif; ?>
                        <div class="entry-excerpt"><?php echo $excerpt; ?></div>
                        <p class="read-more"><a href="<?php the_permalink(); ?>" data-button>Learn More</a></p>
                    </div>
                    <div class="col-md-7 content-img" data-col="content-slide">
                        <div class="img-wrap" style="background-image:url(<?php echo $image; ?>);"></div>
                    </div>
                <?php else : ?>
                    <div class="col-md-7 content-img" data-col="content-slide">
                        <div class="img-wrap" style="background-image:url(<?php echo $image; ?>);"></div>
                    </div>
                    <div class="col-md-5 slide-content" data-col="content-slide">
                        <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
                        <a class="link" href="<?php the_permalink(); ?>">www.website.com</a></a>
                        <div class="entry-excerpt"><?php echo $excerpt; ?></div>
                        <p class="read-more"><a href="<?php the_permalink(); ?>" data-button>Learn More</a></p>
                    </div>
                <?php endif; ?>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
            <!-- <p class="see-all-posts"><a href="<?php // echo site_url(); ?>">See All Posts</a></p> -->
        </div><!-- .recent-posts -->
    <?php else : ?>
        <p>Sorry! No posts found within your criteria.</p>
    <?php endif;
    $output = ob_get_clean();
    return $output;
}

add_shortcode('portfolio-slider', 'portfolio_slider_shortcode');

/******************************************************************************
 * Our Team Shortcode
 ******************************************************************************/
function our_team_shortcode($atts, $content = null) {
    ob_start();
    // Attributes
    extract(shortcode_atts(
            array(
                'posts' => '4',
                'people' => '',
                'bg' => 'light',
            ), $atts)
    );
    $bg_class = $bg;

    // Code
    $recent_args = array(
        'post_type' => 'our_team',
        'tag' => $people,
        'posts_per_page' => $posts,
        'order' => 'ASC'
    );
    $recent_query = new WP_Query($recent_args);
    if ($recent_query->have_posts()) : ?>
        <div class="our-team <?php echo $bg_class; ?>">
            <?php while ( $recent_query->have_posts() ) : $recent_query->the_post(); ?>
                <?php
                $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'headshot-sq' );
                $image = $feat_image ? $feat_image[0] : get_template_directory_uri() . '/inc/images/hero-sq.jpg';
                $m_linkedin = get_field('member_linkedin');
                $m_email = get_field('member_email');
                $m_phone = get_field('member_phone');
                $job_title = get_field('member_job_title');
                $member_position = get_field('member_position');
                ?>
                <div class="member col-sm-6 col-md-4">
                    <a href="<?php the_permalink(); ?>" class="inner">
                        <img src="<?php echo $image; ?>">
                        <h3><?php the_title(); ?></h3>
                        <h4><?php echo $job_title; ?></h4>
                    </a>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div><!-- .consultants -->
    <?php else : ?>
        <p>Sorry! No team members found within your criteria.</p>
    <?php endif;
    $output = ob_get_clean();
    return $output;
}

add_shortcode('our-team', 'our_team_shortcode');
/******************************************************************************
 * Gallery Shortcode Re-format
 ******************************************************************************/
/*add_filter( 'post_gallery', 'my_post_gallery', 10, 2 );
function my_post_gallery( $output, $attr) {
    global $post, $wp_locale;

    static $instance = 0;
    $instance++;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'div',
        'icontag'    => 'div',
        'captiontag' => 'div',
        'columns'    => 3,
        'size'       => 'thumbnail',
        'include'    => '',
        'exclude'    => '',
        'slideset'    => ''
    ), $attr));

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    $slidesetClass = '';
    if ( $slideset == 'true')
        $slidesetClass = 'gallery-slideset';

    if ( !empty($include) ) {
        $include = preg_replace( '/[^0-9,]+/', '', $include );
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $columns = intval($columns);
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';

    $selector = "gallery-{$instance}";

    $output = apply_filters('gallery_style', "<div id='$selector' class='gallery galleryid-{$id} {$slidesetClass}'>");

    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
        $img = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_image($id, $size, false, false) : wp_get_attachment_image($id, $size, true, false);
        $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_url($id) : wp_get_attachment_url($id);
        if ( $captiontag && trim($attachment->post_excerpt) ) {
            $caption = wptexturize($attachment->post_excerpt);
        }

        $output .= "<{$itemtag} class='gallery-item'>";
        $output .= "<a class='gallery-icon' href='". $link ."' data-lightbox='". $selector ."' data-title='" . $caption . "'>" . $img . "</a>";
        $output .= "</{$itemtag}>";
        if ( $columns > 0 && ++$i % $columns == 0 )
            $output .= '';
    }

    $output .= "</div>\n";

    return $output;
}*/
/******************************************************************************
 * Custom Author Info Box
 * this adds the author info box at the end of each article
 ******************************************************************************/
function wpb_author_info_box( $content ) {

    global $post;

    // Detect if it is a single post with a post author
    if ( is_singular('post') && isset( $post->post_author ) ) {

        // Get author's display name
        $display_name = get_the_author_meta( 'display_name', $post->post_author );

        // If display name is not available then use nickname as display name
        if ( empty( $display_name ) )
            $display_name = get_the_author_meta( 'nickname', $post->post_author );

        // Get author's biographical information or description
        $user_description = get_the_author_meta( 'user_description', $post->post_author );

        // Get author's website URL
        $user_website = get_the_author_meta('url', $post->post_author);

        // Get link to the author archive page
        $user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));

        //Get User Profile Image
        if (function_exists ( 'mt_profile_img' ) ) {
            $user_image = mt_profile_img( $post->post_author, array(
                    'size' => 'thumbnail',
                    'attr' => array( 'alt' => 'Alternative Text' ),
                    'echo' => false )
            );
        }
        if (!$user_image) {
            $user_image = get_avatar( get_the_author_meta('user_email') , 90 );
        }

        $author_details = '';

        //Author Image
        $author_details .= '<div class="author_img">' . $user_image . '</div>';

        // Start Author Details
        $author_details .= '<div class="author_details">';

        if ( ! empty( $display_name ) ) {
            $author_details .= '<h4 class="author_name">About ' . $display_name . '</h4>';
        }

        if ( ! empty( $user_description ) )
            // Author avatar and bio

            $author_details .= '<p class="author_bio">' . nl2br( $user_description ). '</p>';

            //$author_details .= '<p class="author_links"><a href="'. $user_posts .'">View all posts by ' . $display_name . '</a>';

            // Check if author has a website in their profile
        if ( ! empty( $user_website ) ) {

            // Display author website link
            $author_details .= '<a class="author_link" href="' . $user_website .'" data-button>Learn More</a>';

        }

        // END Author Details
        $author_details .= '</div>';

        // Pass all this info to post content
        $content = $content . '<footer class="author_bio_section" >' . $author_details . '</footer>';
    }
    return $content;
}

// Add our function to the post content filter
add_action( 'the_content', 'wpb_author_info_box' );

// Allow HTML in author bio section
remove_filter('pre_user_description', 'wp_filter_kses');

/******************************************************************************
 * Add Custom Query Vars
 * this is for searching custom variables in custom post types
 ******************************************************************************/
/* function add_query_vars_filter( $vars ){
    $vars[] = "price";
    $vars[] .= "bdrms";
    return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' ); */


/**
 * Paginate Archive Index Page Links
 */
function get_pagination_links() {
    global $wp_query;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

    return paginate_links( array(
        'base' => @add_query_arg('paged','%#%'),
        'format' => '?paged=%#%',
        'current' => $current,
        'total' => $wp_query->max_num_pages,
        'prev_next'    => false
    ) );
}
/******************************************************************************
 * Infinite Scroll Blogroll
 ******************************************************************************/
function wp_infinitepaginate(){
    $loopFile        = $_POST['loop_file'];
    $paged           = $_POST['page_no'];
    $posts_per_page  = get_option('posts_per_page');
    $searchText  = $_POST['s'];
    $category  = $_POST['cat'];
    $tag  = $_POST['tag'];
    $order = 'DESC';
    $post_type = 'post';
    $post_status = 'publish';

    # Load the posts
    query_posts(array('post_type' => $post_type, 'post_status' => $post_status, 'paged' => $paged, 's' => $searchText, 'cat' => $category, 'tag' => $tag, 'order' => $order ));
    get_template_part( $loopFile );

    exit;
}
add_action('wp_ajax_infinite_scroll', 'wp_infinitepaginate');
add_action('wp_ajax_nopriv_infinite_scroll', 'wp_infinitepaginate');

/**
 * Disable Lazy Load images by classname
 */
function rocket_lazyload_exclude_class( $attributes ) {
	$attributes[] = 'class="nolazy';
	return $attributes;
}
add_filter( 'rocket_lazyload_excluded_attributes', 'rocket_lazyload_exclude_class' );
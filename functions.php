<?php

  if(!function_exists('pre_setup')) {
    function pre_setup() {
      add_theme_support('custom-logo', [
        'height'      => 50,
        'width'       => 130,
        'flex-width'  => false,
        'flex-height' => false,
        'header-text' => '',
      ]);
      //dynamic tag title
      add_theme_support('title-tag');
      add_theme_support('post-thumbnails');
      set_post_thumbnail_size(730, 480);
    }
    add_action('after_setup_theme', 'pre_setup');
  }

  //styles and scripts init
  add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );
  function theme_name_scripts() {
    wp_enqueue_style('main-style', get_stylesheet_uri());
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/plugins/bootstrap/css/bootstrap.css', array());
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/plugins/fontawesome/css/all.css', array());
    wp_enqueue_style('animate-css', get_template_directory_uri() . '/plugins/animate-css/animate.css', array());
    wp_enqueue_style('icofont', get_template_directory_uri() . '/plugins/icofont/icofont.css', array());
    wp_enqueue_style('secondary-style', get_template_directory_uri() . '/css/style.css', array('bootstrap', 'icofont'));

    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', get_template_directory_uri() . '/plugins/jquery/jquery.min.js');
    wp_enqueue_script( 'jquery' );
    
    wp_enqueue_script( 'popper', get_template_directory_uri() . '/plugins/bootstrap/js/popper.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/plugins/bootstrap/js/bootstrap.min.js', array('jquery', 'popper'), null, true );

    wp_enqueue_script( 'wow', get_template_directory_uri() . '/plugins/counterup/wow.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'easing', get_template_directory_uri() . '/plugins/counterup/jquery.easing.1.3.js', array('jquery'), null, true );
    wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/plugins/counterup/jquery.waypoints.js', array('jquery'), null, true );
    wp_enqueue_script( 'counterup', get_template_directory_uri() . '/plugins/counterup/jquery.counterup.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'gmap3', get_template_directory_uri() . '/plugins/google-map/gmap3.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'googleapis', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAkeLMlsiwzp6b3Gnaxd86lvakimwGA6UA&callback=initMap', array('jquery', 'gmap3'), null, true );
    wp_enqueue_script( 'contact', get_template_directory_uri() . '/plugins/jquery/contact.js', array('jquery'), null, true );
    wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), null, true );
  }

  //register several menus
  function menus() {
    $locations = array(
      'header' => __('Header Menu', 'header_menu'),
      'footer' => __('Footer Menu', 'footer_menu'),
    );

    register_nav_menus($locations);
  }

  add_action('init', 'menus');

  // //adding class to all nav items
  // add_filter( 'nav_menu_css_class', 'custom_nav_menu_css_class', 10, 1);

  // function custom_nav_menu_css_class($classes) {
  //   $classes[] = 'nav-item';
  //   return $classes;
  // }

  // //adding class to all links inside items
  // add_filter( 'nav_menu_link_attributes', 'custom_nav_menu_link_attributes', 10, 1);

  // function custom_nav_menu_link_attributes($atts) {
  //   $atts['class'] = 'nav-link';
  //   return $atts;
  // }


  class bootstrap_4_walker_nav_menu extends Walker_Nav_menu {
    
    function start_lvl( &$output, $depth = 0, $args = array() ){ // ul
        $indent = str_repeat("\t",$depth); // indents the outputted HTML
        $submenu = ($depth > 0) ? ' sub-menu' : '';
        $output .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";
    }
  
  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ){ // li a span
        
    $indent = ( $depth ) ? str_repeat("\t",$depth) : '';
    
    $li_attributes = '';
        $class_names = $value = '';
    
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        
        $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
        $classes[] = ($item->current || $item->current_item_anchestor) ? 'active' : '';
        $classes[] = 'nav-item';
        $classes[] = 'nav-item-' . $item->ID;
        if( $depth && $args->walker->has_children ){
            $classes[] = 'dropdown-menu';
        }
        
        $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr($class_names) . '"';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
        
        $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';
        
        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr($item->url) . '"' : '';
        
        $attributes .= ( $args->walker->has_children ) ? ' class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="nav-link"';
        
        $item_output = $args->before;
        $item_output .= ( $depth > 0 ) ? '<a class="dropdown-item"' . $attributes . '>' : '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        $output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    
    }
    
}
/*
Register Navbar
*/
register_nav_menu('navbar', __('Navbar', 'Основное меню'));

## отключаем создание миниатюр файлов для указанных размеров
function delete_intermediate_image_sizes($sizes){
	// размеры которые нужно удалить
	return array_diff($sizes, [
		'medium_large',
		'large',
		'1536x1536',
		'2048x2048',
	]);
}

add_filter( 'intermediate_image_sizes', 'delete_intermediate_image_sizes' );

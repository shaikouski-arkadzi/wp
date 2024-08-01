<?php

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

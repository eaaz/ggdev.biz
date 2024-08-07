<?php

function theme_setup()
{
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  // add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
}
function my_load_scripts()
{
  wp_enqueue_script('jquery');
  wp_enqueue_script('scripts', get_template_directory_uri() . '/scripts.js');
}
add_action('after_setup_theme', 'theme_setup');
add_action('wp_enqueue_scripts', 'my_load_scripts');

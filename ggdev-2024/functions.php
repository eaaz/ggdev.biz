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
  wp_enqueue_style('style', get_stylesheet_uri(), ['normalize']);
  wp_enqueue_style('normalize', 'https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css');
  wp_enqueue_style('googlefonts', 'https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Noto+Sans+JP:wght@100..900&display=swap');
}
add_action('after_setup_theme', 'theme_setup');
add_action('wp_enqueue_scripts', 'my_load_scripts');
function disable_rest_api()
{
  if (!is_user_logged_in()) {
    return new WP_Error('disabled', __('REST API is disabled.'), array('status' => rest_authorization_required_code()));
  }
}
add_filter('rest_authentication_errors', 'disable_rest_api');
function itsme_disable_feed()
{
  wp_die(__('No feed available, please visit the <a href="' . esc_url(home_url('/')) . '">homepage</a>!'));
}
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'feed_links', 2);
add_action('do_feed', 'itsme_disable_feed', 1);
add_action('do_feed_rdf', 'itsme_disable_feed', 1);
add_action('do_feed_rss', 'itsme_disable_feed', 1);
add_action('do_feed_rss2', 'itsme_disable_feed', 1);
add_action('do_feed_atom', 'itsme_disable_feed', 1);
add_action('do_feed_rss2_comments', 'itsme_disable_feed', 1);
add_action('do_feed_atom_comments', 'itsme_disable_feed', 1);
add_action('wp', function () {
  global $post;
  if ($post && $post->post_name === 'contact' && isset($_POST['_wpnonce'])) {
    if (!wp_verify_nonce($_POST['_wpnonce'], -1)) {
      wp_die('お問い合わせのメール送信に失敗しました。');
    };

    $to = get_option('admin_email');
    $subject = 'お問い合わせメール';
    $message = '';
    foreach (
      [
        'email' => 'メールアドレス',
        'fullname' => '氏名',
        'subject' => '件名',
        'message' => '内容',
      ] as $key => $label
    ) {
      $message .= $label . '　：' . (string)@$_POST[$key] . "\n";
      $message .= "\n";
    }

    if (!wp_mail($to, $subject, $message)) {
      wp_die('お問い合わせのメール送信に失敗しました。');
    }

    return wp_redirect(home_url('/contact?thanks=1'));
  }
});

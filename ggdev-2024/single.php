<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php wp_head() ?>
  </head>
  <body class="<?= esc_attr(implode(' ', get_body_class())) ?>">
    <header class="header">
      <h1 class="header-title">
        <a href="<?= home_url('/') ?>"><?php include('assets/img/logo.svg') ?></a>
      </h1>
      <nav class="header-nav"><?php wp_nav_menu() ?></nav>
    </header>
    <main class="main">
      <?php if (has_post_thumbnail()): ?>
      <div class="thumbnail"><?php the_post_thumbnail() ?></div>
      <?php else: ?>
      <div class="thumbnail no-image"></div>
      <?php endif ?>
      <div class="content-title"><?php the_title() ?></div>
      <div class="content">
        <div class="content-wp"><?php the_content() ?></div>
        <div class="content-nextprev">
          <?php if ($previous_post_link = get_previous_post_link('%link', 'PREV')): ?>
          <?= $previous_post_link ?>
          <?php else: ?>
          <span>PREV</span>
          <?php endif ?>
          <?php if ($next_post_link = get_next_post_link('%link', 'NEXT')): ?>
          <?= $next_post_link ?>
          <?php else: ?>
          <span>NEXT</span>
          <?php endif ?>
        </div>
        <div class="content-back"><a class="btn" href="<?= home_url('/') ?>">BACK</a></div>
      </div>
    </main>
    <footer class="footer">
      <div class="footer-copy">
        (C)
        <?= date('Y') ?>
        GGDEV.BIZ
      </div>
    </footer>
    <a class="toggler" href="javascript:" data-js-toggler><?php include('assets/img/logo.svg') ?></a>
    <?php wp_footer() ?>
  </body>
</html>

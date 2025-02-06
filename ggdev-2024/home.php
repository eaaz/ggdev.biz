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
      <div class="thumbnail no-image"></div>
      <div class="content-title">BLOG</div>
      <div class="content">
        <div class="content-paginate"><?php echo paginate_links('prev_next=0') ?></div>
        <div class="content-list">
          <?php while(have_posts()): the_post() ?>
          <div class="content-list-item">
            <div class="content-list-item-title">
              <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
            </div>
            <div class="content-list-item-excerpt"><?php the_excerpt() ?></div>
            <div class="content-list-item-data"><?php the_time('Y/m/d') ?></div>
          </div>
          <?php endwhile ?>
        </div>
        <div class="content-paginate"><?php echo paginate_links('prev_next=0') ?></div>
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

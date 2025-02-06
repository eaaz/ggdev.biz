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
      <div class="content-title">404</div>
      <div class="content">
        <div class="content-404">お探しのページが見つかりませんでした。変更されたか削除された可能性があります。</div>
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

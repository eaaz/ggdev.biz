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
        <?php if (@$_GET['thanks']): ?>
        <p>
          お問い合わせメールを送信しました。１週間以内を目処に返信させていただきます。
          <br />
          しばらくお待ちくださいませ。
        </p>
        <?php else: ?>
        <form class="form" method="POST" action="/contact">
          <div class="form-control">
            <label class="form-control-label">メールアドレス</label>
            <div class="form-control-input"><input class="input" type="email" name="email" /></div>
          </div>
          <div class="form-control">
            <label class="form-control-label">氏名</label>
            <div class="form-control-input"><input class="input" type="text" name="fullname" /></div>
          </div>
          <div class="form-control">
            <label class="form-control-label">件名</label>
            <div class="form-control-input"><input class="input" type="text" name="subject" /></div>
          </div>
          <div class="form-control">
            <label class="form-control-label">内容</label>
            <div class="form-control-input"><textarea class="input" rows="10" name="message"></textarea></div>
          </div>
          <div class="form-submit">
            <?php wp_nonce_field() ?>
            <button class="btn" type="submit">SUBMIT</button>
          </div>
        </form>
        <?php endif ?>
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

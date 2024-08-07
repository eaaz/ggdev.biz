/*!
  * Wordpress Theme - GGDEV v1.0.0 (https://ggdev.biz)
  * Copyright 2021-2024 紅葉琉歌
  */
  (function ($) {
  $(document).on("click", "a", function (e) {
    const href = $(this).prop("href");
    if (href.match(window.location.host)) {
      e.preventDefault();
      $.ajax({ url: href }).then((res) => {
        res
          .replace("<!DOCTYPE html>", "")
          .replace('<html lang="ja">', "")
          .replace("</html>", "");
        document.querySelector("html").innerHTML = res;
      });
      return false;
    }
  });
})(jQuery);

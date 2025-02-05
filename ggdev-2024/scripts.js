/*!
  * Wordpress Theme - GGDEV v1.0.0 (https://ggdev.biz)
  * Copyright 2021-2025 紅葉琉歌
  */
  (function ($) {
  const scriptIds = [];
  const styleIds = [];

  const setScriptIds = function () {
    $(document)
      .find("head > *")
      .each(function (i, el) {
        if (
          el.tagName.toUpperCase() === "SCRIPT" &&
          $(el).attr("src") &&
          $(el).attr("id")
        ) {
          scriptIds.push($(el).attr("id"));
        }
      });
  };
  const setStyleIds = function () {
    $(document)
      .find("head > *")
      .each(function (i, el) {
        if (
          el.tagName.toUpperCase() === "LINK" &&
          $(el).attr("rel") === "stylesheet" &&
          $(el).attr("href") &&
          $(el).attr("id")
        ) {
          styleIds.push($(el).attr("id"));
        }
      });
  };

  const replaceHead = function (newDOM) {
    const newHeadDOM = $.makeArray(
      $(newDOM)
        .find("head > *")
        .filter(function (i, el) {
          return (
            !(
              el.tagName.toUpperCase() === "SCRIPT" &&
              scriptIds.includes($(el).attr("id"))
            ) &&
            !(
              el.tagName.toUpperCase() === "LINK" &&
              styleIds.includes($(el).attr("id"))
            )
          );
        })
    );

    $(document)
      .find("head > *")
      .each(function (i, el) {
        if (
          !(
            el.tagName.toUpperCase() === "SCRIPT" &&
            scriptIds.includes($(el).attr("id"))
          ) &&
          !(
            el.tagName.toUpperCase() === "LINK" &&
            styleIds.includes($(el).attr("id"))
          )
        ) {
          $(this).remove();
        }
      });
    $(document).find("head").append(newHeadDOM);
  };

  const replaceBodyClass = function (newDOM) {
    const newBodyClasses = $(newDOM).find("body").attr("class");
    $(document).find("body").attr("class", newBodyClasses);
  };

  const replaceBody = function (newDOM) {
    const newBodyHtml = $(newDOM).find("body main.main").html();
    $(document).find("body main.main").html(newBodyHtml);
  };

  const replaceMenu = function (newDOM) {
    const newMenuHtml = $(newDOM).find("body nav.header-nav").html();
    $(document).find("body nav.header-nav").html(newMenuHtml);
  };

  const ajaxLink = function (href, isPopState = false) {
    $.ajax({ url: href }).then((res) => {
      const newDOM = new DOMParser().parseFromString(res, "text/html");
      replaceHead(newDOM);
      setScriptIds();
      setStyleIds();
      replaceBodyClass(newDOM);
      replaceBody(newDOM);
      replaceMenu(newDOM);

      if (!isPopState) history.pushState({ href }, null, href);
    });
  };

  $(document).on("click", "a", function (e) {
    const href = $(this).prop("href");
    if (href.match(window.location.host)) {
      e.preventDefault();
      return ajaxLink(href);
    }
  });

  window.addEventListener("popstate", function ({ state }) {
    if (state && "href" in state) {
      return ajaxLink(state.href, true);
    }
  });

  $(document).on("click", "a[data-js-toggler]", function () {
    $("body").toggleClass("show-menu");
  });

  setScriptIds();
  setStyleIds();
})(jQuery);

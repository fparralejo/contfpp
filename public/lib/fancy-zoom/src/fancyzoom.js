// Generated by CoffeeScript 1.3.3
(function() {
  var $;

  $ = jQuery;

  $.fn.fancyZoom = function(options) {
    var directory, hide, html, show, zoom, zoom_close, zoom_content, zooming;
    show = function(e) {
      var curLeft, curTop, height, newLeft, newTop, new_width, width, window_size, x, y, zoom_height, zoom_width, zooming;
      if (zooming) {
        return false;
      }
      if (zoom.data('el') === this) {
        return hide();
      }
      zoom_width = options.width;
      zoom_height = options.height;
      width = $(window).innerWidth();
      height = $(window).innerHeight();
      x = $(window).scrollLeft();
      y = $(window).scrollTop();
      window_size = {
        width: width,
        height: height,
        x: x,
        y: y
      };
      width = zoom_width || this.naturalWidth;
      height = zoom_height || this.naturalHeight;
      if (window_size.width < width) {
        new_width = window_size.width - 50;
        height *= new_width / width;
        width = new_width;
      }
      if (!options.showAlways && (width <= this.width || height <= this.height)) {
        return false;
      }
      newTop = Math.max((window_size.height / 2) - (height / 2) + y, 10);
      newLeft = (window_size.width / 2) - (width / 2);
      curTop = e.pageY;
      curLeft = e.pageX;
      zoom_close.data("curTop", curTop);
      zoom_close.data("curLeft", curLeft);
      zoom.hide().css({
        position: "absolute",
        top: curTop + "px",
        left: curLeft + "px",
        width: "1px",
        height: "1px"
      });
      zoom_close.hide();
      if (options.closeOnClick) {
        zoom.click(hide);
      }
      zoom_content.html($(this).clone());
      zoom_content.children().css({
        width: '100%'
      });
      zoom.animate({
        top: newTop + "px",
        left: newLeft + "px",
        opacity: "show",
        width: width,
        height: height
      }, 500, null, function() {
        var zooming;
        zoom_close.show();
        return zooming = false;
      });
      zooming = true;
      zoom.data('el', this);
      return false;
    };
    hide = function() {
      var zooming;
      if (zooming) {
        return false;
      }
      zooming = true;
      zoom.data('el', null);
      zoom.unbind("click");
      zoom_close.hide();
      zoom.animate({
        top: zoom_close.data("curTop") + "px",
        left: zoom_close.data("curLeft") + "px",
        opacity: "hide",
        width: "1px",
        height: "1px"
      }, 500, null, function() {
        zoom_content.html("");
        return zooming = false;
      });
      return false;
    };
    options || (options = {});
    directory = (options && options.directory ? options.directory : "img");
    zooming = false;
    if ($("#zoom-box").length === 0) {
      html = "<div id=\"zoom-box\" style=\"display:none;\">\n   <div class=\"zoom-content\">\n   </div>\n   <a href=\"javascript:void(0)\" class=\"zoom-close\">\n     <img src=\"" + directory + "/closebox.png\" alt=\"&#215;\">\n   </a>\n </div>";
      $("body").append(html);
      $("html").click(function(e) {
        if (zoom.is(':visible') && $(e.target).parents('#zoom-box').length === 0) {
          return hide();
        } else {
          return void 0;
        }
      });
      $(document).keyup(function(event) {
        if (event.keyCode === 27 && $("#zoom-box:visible").length > 0) {
          return hide();
        }
      });
      $('#zoom-box > .zoom-close').click(hide);
    }
    zoom = $('#zoom-box');
    zoom_close = zoom.children('.zoom-close');
    zoom_content = zoom.children('.zoom-content');
    this.each(function(i) {
      return $(this).click(show);
    });
    return this;
  };

}).call(this);

(function($) {
  "use strict";

  var events = 'click mouseover mousemove mouseup mouseenter mouseleave keydown keyup keypress dblclick';

  var id = 1;

  var ContextMenu = function ContextMenu(options) {
    _.extend(this, _.omit(defaults, 'item'), _.omit(options, 'item'));
    this.init(options);
  };

  $(document.body).on('keydown', function(e) {
    if(e.which == 27) $('.ctx-menu').hide();
  });

  ContextMenu.prototype = {
    init: function(options) {
      options = options || {};
      if(this.$wrapper) {
        this.$wrapper.remove();
        delete this.$wrapper;

        this.$elements.off('contextmenu');
      }
      var $elements = this.$elements = this.jquery;
      var $wrapper = this.$wrapper = this.createWrapper();
      var _super = this;

      this.items = this.items.map(function(item) {
        return _.defaults(item, defaults.item, options.item);
      });

      $elements.contextmenu(function(e) {
        e.preventDefault();
        e.stopPropagation();

        $wrapper
          .css({
            position: 'absolute',
            left: e.pageX + 5,
            top: e.pageY + 5,
            display: 'block',
            visibility: 'hidden'
          });

        var offset = $wrapper.offset(),
            width = $wrapper.width(),
            height = $wrapper.height();
        if(offset.left + width > $(window).width()) {
          $wrapper.css({
            left: e.pageX - width - 5
          });
        }
        if(offset.top + height > $(window).height()) {
          $wrapper.css({
            top: e.pageY - height - 5
          });
        }

        $wrapper.css('visibility', 'visible').show();
      });

      $wrapper.on(events, function(e) {
        var $target = $(e.target);

        if($target.tagName() != 'li') {
          $target = $target.parent('li');
          if(!$target.length) return;
        }

        var id = parseInt($target.attr('data-id'), 10);

        var fn = (_super.items[id].events || {})[e.type];

        if(typeof fn == 'function') fn(e);
      });

      $wrapper.on('close', function() {
        $wrapper.hide();
      });

      $(document).ready(function() {
        $(document.body).append($wrapper);
        _super.createItems();
      });
    },
    add: function(item) {
      var index = this.items.push(item);
      this.createItems();

      return index-1;
    },
    remove: function(item) {
      if(_.isNumber(item)) {
        this.items.splice(item, 1);
      } else {
        this.items = _.without(this.items, _.omit(item, 'events'));
      }
      this.createItems();

      return this.items.length;
    },
    _createItems: function() {
      var $stack = $('<ul></ul>');
      for(var i = 0, len = this.items.length; i < len; i++) {
        var item = _.extend(defaults.item, this.items[i]);
        var $el = $('<li data-id="' + i + '"><a ' + (item.link ? 'href="' + item.link + '"' : '') + '>' + item.text + '</a></li>');
        $stack = $stack.append($el);
      }

      this.$wrapper.empty().append($stack);
      return $stack;
    },
    createItems: function() {
      return this._createItems();
    },
    _createWrapper: function() {
      var $wrapper = $('<div class="ctx-menu" id="ctx-' + (id++) + '" data-modal></div>');
      $wrapper.css({
        display: 'none',
        position: 'absolute'
      });

      $wrapper.find('ul').css({
        'list-style': 'none',
        margin: '0'
      });

      return $wrapper;
    },
    createWrapper: function() {
      return this._createWrapper();
    }
  };

  ContextMenu.extend = extend;

  $.fn.ctxMenu = function(options) {
    return new ContextMenu(_.extend(options, {jquery: this}));
  };

  var defaults = $.fn.ctxMenu.defaults = {
    item: {
      link: false
    }
  };
})(jQuery);
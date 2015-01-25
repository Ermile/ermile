(function($) {
  "use strict";

  var defaults = {
    ajax: {
      type: undefined,
      url: undefined,
      processData: false,
      contentType: false,
      dataType: 'json',
      cache: false
    },
    event: false,
    immediate: false,
    noLoading: false,

    // Events

    before: _.noop,
    after: _.noop,
    success: _.noop,
    fail: _.noop,
    complete: _.noop,
    beforeValidation: _.noop,
    // afterValidation: _.noop,
    createElement: _.noop
  };

  $.fn.ajaxify = function Ajaxify(options) {
    var $form = $(this);

    _.extend(this, defaults, options);
    this.ajax =_.defaults((options || {}).ajax || {}, defaults.ajax);

    var _super = this;

    function send($this) {
      if(_super.before(_super) === false) return;

      var callbacks = this.callbacks || {};

      var elementOptions = {
        type: _super.link ? $this.attr('data-method') || 'get' : $this.prop('method'),
        url: (_super.link ? $this.prop('href') : $this.prop('action')) || location.href
      };

      var ajax = _.extend(_super.ajax, elementOptions);

      var ajaxOptions;

      if(!_super.link) {
        var fd = new FormData($this.get(0));

        ajaxOptions = _.extend(ajax, {
          data: fd
        });
        $('input').attr('disabled', '');
      } else {
        try {
          var data = JSON.parse($this.attr('data-data'));
          ajaxOptions = _.extend(ajax, {
            data: data
          });
        } catch(e) {
          ajaxOptions = ajax;
        }
        $('[data-ajaxify]').attr('disabled', '');
      }

      var refresh = ajaxOptions.refresh || $this.attr('data-refresh') !== undefined;

      if(!_super.noLoading) $('body').addClass('loading-form');

      $.ajax(ajaxOptions)
      .done(function(data, status, xhr) {
        _super.results = data;
        if(_super.success.apply(_super, arguments) === false) return;

       $.fn.ajaxify.showResults(data, $this, _super); 

        if(data.msg && data.msg.redirect) {
          var a = $('<a href="' + data.msg.redirect + '"></a>');
          if(a.isAbsoluteURL()) {
            location.replace(data.msg.redirect);
          } else {
            Navigate({
              url: data.msg.redirect
            });
          }
        }

        if(refresh) {
          Navigate({
            url: location.href,
            replace: true
          });
        }

        // if(_super.afterValidation.apply(_super, arguments) === false) return;
        if(_super.after(_super) === false) return;
      }).fail(function(xhr, status, error) {
        if(_super.fail.apply(_super, arguments) === false) return;
      }).always(function() {
        if(_super.complete.apply(_super, arguments) === false) return;
        if(!_super.noLoading) $('body').removeClass('loading-form');
        $('input, [data-ajaxify]').removeAttr('disabled');
      })
      .done(callbacks.success)
      .fail(callbacks.fail)
      .always(callbacks.complete);
    }

    if(this.immediate) {
      send.call(_super, $form.first());
    } else {
      $form.on(this.event ? this.event : this.link ? 'click' : 'submit', function(e) {
        e.preventDefault();
        send.call(_super, $(this)); 
      });
    }
 
  };

  $.fn.ajaxify.showResults = function(data, $form, _super) {
    $form.find('input').removeClass('error warn');

    if(_super.beforeValidation.apply(_super, arguments) === false) return;

    for(var i in data.messages) {
      var grp = data.messages[i];

      var type;

      switch(i) {
        case 'true':
          type = 'success';
          break;
        case 'warn':
          type = 'warning';
          break;
        case 'error':
          type = 'error';
          break;
        default:
          type = 'info';
      }

      var $ul = $('<ul class="' + i + '"></ul>');

      $form.find('input').removeClass('invalid');

      for(var j = 0, len = grp.length; j < len; j++) {
        var msg = grp[j];
        var $msg = $ul.append('<li class="' + msg.group + '">' + msg.title + '</li>');

        if(msg.element) {
          (msg.element.length ? msg.element : [msg.element]).forEach(function(e) {
            var $el = $form.find('input[name="' + e + '"]');
            $el.addClass('invalid');
          })
        }
      }

      notify({
        html: $ul
      });
    }
  };

  $.fn.ajaxifyCallbacks = function FormAjaxifyCallback(callbacks) {
    $(this).prop('callbacks', callbacks);
  };
})(jQuery);

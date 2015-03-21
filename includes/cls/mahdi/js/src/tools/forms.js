(function($) {
  'use strict';

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
    createElement: _.noop
  };

  $.fn.ajaxify = function Ajaxify(options) {
    var $form = $(this);

    $.extend(true, this, defaults, options);

    var _super = this;


    function send($this) {
      $form.trigger('ajaxify:before', _super);

      var elementOptions = {
        type: _super.link ? $this.attr('data-method') || 'get' : $this.prop('method'),
        url: (_super.link ? $this.prop('href') : $this.prop('action')) || location.href
      };

      var ajax = _.extend(_super.ajax, elementOptions);

      var ajaxOptions;

      if(!_super.link) {
        var fd = new FormData($this.get(0));

        $this.find('[contenteditable]').each(function() {
          fd.append(this.getAttribute('name'), this.innerHTML);
        });

        ajaxOptions = _.extend(ajax, {
          data: fd
        });
        $('input').attr('disabled', '');
      } else {
        try {
          var data = JSON.parse($this.attr('data-data'));
          ajaxOptions = _.extend(ajax, {
            data: data,
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            processData: true
          });
        } catch(e) {
          ajaxOptions = ajax;
        }
        $('[data-ajaxify]').attr('disabled', '');
      }

      var refresh = ajaxOptions.refresh || $this.attr('data-refresh') !== undefined;

      if(!_super.noLoading) $('body').addClass('loading-form');

      var callbacks = $this.get(0).callbacks || {};

      $.ajax(ajaxOptions)
      .done(function(data, status, xhr) {
        _super.results = data;

       $.fn.ajaxify.showResults(data, $this, _super); 

        if(data.msg && data.msg.redirect) {
          var a = $('<a href="' + data.msg.redirect + '"></a>');
          if(a.isAbsoluteURL()) {
            location.replace(data.msg.redirect);
          } else {
            // Navigate({
            //   url: data.msg.redirect
            // });
          }
        }

        if(refresh) {
          Navigate({
            url: location.href,
            replace: true
          });
        }

        if (!$form.find('.invalid').length && $form.attr('data-clear') !== undefined) {
          $form.find('*').not('[data-unclear]').val('');
        }

        $form.trigger('ajaxify:success', data, status, xhr);
      }).fail(function(xhr, status, error) {
        $form.trigger('ajaxify:fail', xhr, status, error);
      }).always(function(a1, a2, a3) {
        $form.trigger('ajaxify:complete', a1, a2, a3);

        if(_super.noLoading || (a1.msg && a1.msg.redirect)) return;
        
        $('input, [data-ajaxify]').removeAttr('disabled');
        $('body').removeClass('loading-form');
      });
    }

    send.call(_super, $form.first());
  };

  $.fn.ajaxify.showResults = function(data, $form, _super) {
    $form.find('input').removeClass('error warn');

    var $div = $('<div></div>');

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

      var $ul = $('<ul class="' + i + ' unselectable"></ul>');

      $form.find('input').removeClass('invalid');

      for(var j = 0, len = grp.length; j < len; j++) {
        var msg = grp[j];
        var $msg = $ul.append('<li class="notify-' + msg.group + ' ' + msg.redirect + '">' +
                              (data.title||'') + msg.title + '</li>');

        if(msg.element) {
          try {
            var parsed = JSON.parse(msg.element);
            msg.element = parsed;
          } catch(e) {}

          (_.isArray(msg.element) ? msg.element : [msg.element]).forEach(function(e) {
            var $el = $form.find('input[name="' + e + '"]');
            $el.addClass('invalid');
          });
        }
      }

      $form.find('input:first-of-type').get(0).focus();

      $div.append($ul);
    }
    var opts = {
      html: $div,
      delay: parseInt($form.attr('data-delay'), 10),
      sticky: data.msg && data.msg.redirect
    };
    
    $form.trigger('ajaxify:shownResults', opts);
    notify(opts);
  };
})(jQuery);


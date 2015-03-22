(function(root) {
  "use strict";

  var defaults = {
    html: '',
    title: null,
    url: '/',
    replace: false,
    filter: null,
    ajax: {
      type: 'get'
    }
  };

  function exec(src) {
    var r = src.slice(src.lastIndexOf('/')+1);
    $(document).sroute(r);
  }

  function updateDocument(obj) {
    var html = obj.html,
        $html = $(html);

    if(obj.id) $('body').attr('id', obj.id);

    var filter = _.isArray(obj.filter) ? 
        '[data-xhr="' + obj.filter.join('"], [data-xhr="') + '"]'
      : obj.filter ? '[data-xhr="' + obj.filter + '"]' : null;

    (filter ? $html.filter(filter).add($html.find(filter)) : $html).each(function() {
      var target = $(this).attr('data-xhr');

      var $target = $('[data-xhr="'+target+'"]');

      $target.after(this);

      $target.remove();
    });

    var $title = $html.find('title');

    if($title.length) {
      $('head title').text($title.text());
    }

    if(obj.js) {
      var scripts = obj.js;

      scripts.forEach(function(src) {
        var $script = $('script[src="' + src + '"]');

        if(!$script.length) {
          $script = $('<script></script>');
          $script.prop('async', true);
          $script.prop('src', src);

          $(document.body).append($script);
        }
      });
    }

    $html.sroute();

    if(obj.title) document.title = obj.title;
  }

  function fetch(props, md5) {
    $(document.body).addClass('loading-page');

    var options = $.extend(true, {}, props.ajax, {
      url: props.url,
      headers: {
        'Cached-MD5': props.md5
      }
    });

    var deferred = new jQuery.Deferred();

    $.ajax(options).done(function(res) {
      var json,
          html;

      try {
        var n = res.indexOf('\n');
        n = n === -1 ? undefined : n;
        json = JSON.parse(res.slice(0, n));

        if(json.getFromCache) {
          json = LS.get(props.md5);
        } else {
          html = res.slice(n);
          if(json.md5) {
            LS.set(props.url, json.md5);
            LS.set(json.md5, _.extend(json, {html: html}));
          }
        }

        if(json.options) {
          var $options = $('#options-meta');
          $options.putData(json.options);
        }
      } catch(e) {
        deferred.reject();
        return location.replace(props.url);
      }

      deferred.resolve(json);
      $(document.body).removeClass('loading-page');
    });

    return deferred.promise();
  }

  function Navigate(obj) {
    var deferred = new jQuery.Deferred();

    var props = $.extend(true, {}, defaults, obj);

    if(obj.fake) {
      deferred.resolve();
      root.history[props.replace ? 'replaceState' : 'pushState'](props, props.title, props.url);
      $(window).trigger('statechange');

      return deferred.promise();
    }

    if(obj.html) {
      updateDocument(props);
      deferred.resolve();
      root.history[props.replace ? 'replaceState' : 'pushState'](props, props.title, props.url);
      $(window).trigger('statechange');

      return deferred.promise();
    }

    var md5 = LS.get(props.url);
    props.md5 = md5;

    fetch(props).then(function(data) {
      _.extend(props, data);

      root.history[props.replace ? 'replaceState' : 'pushState'](props, props.title, props.url);

      if(!props.data) {
        updateDocument(_.extend({}, props, {html: data.html}));
      }

      $(window).trigger('statechange');
      $('body').removeClass('loading-page');

      deferred.resolve(props);
    });

    return deferred.promise();
  }

  window.onpopstate = function(e) {
    var state = e.state;

    if(!state) return true;
    e.preventDefault();

    if(!state.html) {
      fetch(state).then(function(data) {
        var props = _.extend(true, {}, state, data.json);

        updateDocument(_.extend({}, props, {html: data.html}));

        $(window).trigger('statechange');
      });
    } else {
      updateDocument(state);
      $(window).trigger('statechange');
    }

    return false;
  };

  if(!history.state) {
    Navigate({
      url: location.href,
      fake: true,
      replace: true
    });
  }

  root.Navigate = Navigate;
})(this);
(function(root) {
  "use strict";

  var defaults = {
    html: '',
    title: false,
    url: '/'
  };

  function exec(src) {
    var r = src.slice(src.lastIndexOf('/')+1);
    $(document).sroute(r);
  }

  function updateDocument(obj) {
    var html = obj.html,
        $html = $(html);

    if(obj.id) $('body').attr('id', obj.id);

    $html.each(function() {
      var target = $(this).attr('data-xhr');

      var $target = $('[data-xhr="'+target+'"]');

      $target.after(this);

      $target.remove();
    });

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

  function Navigate(obj) {
    var deferred = new jQuery.Deferred();

    var props = _.extend(defaults, obj);

    var data = _.omit(props, 'url', 'replace');

    if(obj.html) {
      updateDocument(data);
      deferred.resolve();
      root.history[props.replace ? 'replaceState' : 'pushState'](data, props.title, props.url);

      return deferred;
    }
    
    $('body').addClass('loading-page');

    var md5 = LS.get(props.url);

    return $.ajax({
      type: 'get',
      url: props.url,
      headers: {
        'Cached-MD5': md5
      }
    }).done(function(res) {
      var json,
          html;
      try {
        var n = res.indexOf('\n');
        n = n === -1 ? res.length : n;
        json = JSON.parse(res.slice(0, n));

        if(json.getFromCache) {
          json = LS.get(md5);
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
        json = {};
        html = res;
      }

      _.extend(data, json);
      root.history[props.replace ? 'replaceState' : 'pushState'](data, props.title, props.url);
      updateDocument(data);
      $('body').removeClass('loading-page');
      // var id = location.pathname.slice(1).replace(/\//g, '_').replace(/_$/) || 'home';
      // $('body').attr('id', id);
    });
  }

  root.onpopstate = function(e) {
    if(e.state) {
      updateDocument(e.state);
      e.preventDefault();
      return false;
    }
  };

  if(!history.state) {
    root.history.replaceState({
      html: $('body').html(),
      title: document.title
    }, document.title, location.pathname + location.search);
  }

  root.Navigate = Navigate;
})(this);
$(document).ready(function() {
  var regex = /(?:\?|&)?lang=\w*/g;
  if(regex.test(location.search)) {
    Navigate({
      url: location.pathname + location.search.replace(regex, '') + location.hash,
      replace: true
    });
  }
});

route('*', function() {
  $(document).keydown(function(e) {
    if(e.keyCode === 27) {
      $('input').blur();
    }
  });

  $('form', this).ajaxify();

  $('[data-ajaxify]', this).ajaxify({link: true});

  $('a', this).not('[target="_blank"]').not('[data-ajaxify]').click(function(e) {
    // if it's another absolute url, let the browser handle it
    if($(this).attr('href') === '#' || $(this).isAbsoluteURL()) return;
    e.preventDefault();
    var href = $(this).attr('href');

    if(href.indexOf('lang=') > -1) {
      location.replace(href);
    } else {
      Navigate({
        url: href
      });
    }
  });

  $('#langlist', this).change(function() {
    var regex = /(?:\?|&)?lang=\w*/g;
    var srch = location.search.replace(regex, ''),
        url = location.pathname + (srch ? srch + '&' : '?') + 'lang='+this.value;

  /*  var promise = Navigate({
      url: url,
      replace: true
    });
  */
    location.replace(url);
  /*
    var $doc = $(document.documentElement);

    var lang = this.value;
    
    promise.done(function() {
      if(lang === 'fa_IR')
        $doc.attr('class', 'rtl')
      else
        $doc.attr('class', 'ltr');

      $doc.attr('lang', lang.slice(0, 2));
    })*/
  });  

});

(function(root) {
  var $f = $('#formError');
  var $notif = $f.length ? $f : $('<div id="formError" class="hidden"></div>');
  
  $(document.body).append($notif);

  var timeout = 0;

  function Notification(options) {
    _.extend(this, options);

    if(timeout) {
      clearTimeout(timeout);
    }

    if(options === false) {
      $notif.removeClass('visible').addClass('hidden');
      return;
    }

    if(options.html) {
      $notif.html(options.html);
    } else {
      $notif.html('<p>' + options.text + '</p>').addClass(options.type);
    }

    $notif.removeClass('hidden').addClass('visible');

    if(options.sticky) return;

    timeout = setTimeout(function() {
      $notif.removeClass('visible').addClass('hidden');
    }, options.delay || 10000);
  }

  $notif.click(function() {
    $(this).removeClass('visible').addClass('hidden');
  });

  root.notify = Notification;
})(this);
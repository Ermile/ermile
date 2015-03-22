(function(root) {
  
  var timeout = 0;

  function Notification(options) {
    var $f = $('#formError');
    var $notif = $f.length ? $f : $('<div id="formError"></div>');
    $(document.body).append($notif);

    $notif.fadeIn();

    if(timeout) {
      clearTimeout(timeout);
    }

    if(options === false) {
      $notif.fadeOutAndRemove();
      // $notif.removeClass('visible').addClass('hidden');
      return;
    }

    if(options.html) {
      $notif.html(options.html);
    } else {
      $notif.html('<p>' + options.text + '</p>').addClass(options.type);
    }

    if(options.sticky) {
      $notif.prop('sticky', true);
      return;
    }

    timeout = setTimeout(function() {
      $notif.fadeOutAndRemove();
    }, options.delay || 7000);
  }

  $(document).on('click', '#formError li', function() {
    var $this = $(this);
    if($this.parents('#formError').prop('sticky')) return;
    $this.fadeOutAndRemove();
  });

  root.notify = Notification;
})(this);
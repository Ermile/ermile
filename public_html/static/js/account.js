route('/verificationsms', function() {
  setTimeout(createdelay, 5000);
});

route('/verification', function() {
  setTimeout(showafterdelay, 5000);
});


function showafterdelay() {
  $('#delay').addClass('show');
}

function createdelay() {
  var requestDelay = 3000;
  var $body = $(document.body);

  $body.ajaxify({
    ajax: {
      type: 'post',
      url: location.href
    },
    event: 'send',
    link: true,
    noLoading: true,
    success: function(response) {
      var _super = this;
      if(response.status == 1) {
        Navigate({
          url: '/login'
        }).done(function() {
          $.fn.ajaxify.showResults(response,
            $body,
            _super);
        });
      } else {
        setTimeout(loop, requestDelay);
      }
    },
    fail: function() {
      setTimeout(loop, requestDelay);
    }
  });

  function loop() {
    $body.trigger('send');
    requestDelay += 2000;
  }

  setTimeout(loop, 1000);
}


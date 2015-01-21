route('verificationsms', 'account.js', function() {
  setTimeout(createdelay, 1000);
});

route('verification', 'account.js', function() {
  setTimeout(showafterdelay, 10000);
});

function showafterdelay()
{
  document.getElementById("delay").className="show";
}

function createdelay()
{
  // document.getElementById("delay").className="show";

  var requestDelay = 3000;

  $('#delay').ajaxify({
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
            $('#delay'),
            _super);
        })
      } else {
        setTimeout(loop, requestDelay);
      }
    },
    fail: function() {
      setTimeout(loop, requestDelay);
    }
  });

  function loop() {
    $('#delay').trigger('send');
    requestDelay += 2000;
  };

  setTimeout(loop, 1000);
}


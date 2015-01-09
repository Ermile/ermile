route('*', function() {
  if($('#delay', this).length){
    setTimeout(createdelay, 1000);
  }
})


function createdelay()
{
  document.getElementById("delay").className="show";

  var requestDelay = 3000;

  $('#delay').ajaxify({
    ajax: {
      type: 'post',
      url: location.href
    },
    event: 'send',
    link: true,
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


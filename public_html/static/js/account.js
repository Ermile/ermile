$(document).ready(function () {

  if(document.getElementById('delay')){
      setTimeout(createdelay, 1000);
    }
});

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
      if(response.status == 1) {
        Navigate({
          url: '/login'
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
    $('#delay').trigger('send');
    requestDelay += 2000;
  };

  setTimeout(loop, 1000);
}


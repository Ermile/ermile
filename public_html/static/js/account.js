$(document).ready(function () {

  if(document.getElementById('delay')){
      setTimeout(createdelay, 2000);
    }
});

function createdelay()
{
  document.getElementById("delay").className="show";

  var requestDelay = 3000;

  function loop() {
    console.log('Request');
    $.ajax({
      url: location.search,
      type: 'POST'
    }).done(function(response) {
      if(response === 'true') {
        alert(response);
        Navigate({
          url: '/login'
        });
      } else {
        setTimeout(loop, requestDelay);
      }
    }).fail(function() {
      setTimeout(loop, requestDelay);
    })
    requestDelay += 2000;
  };

  setTimeout(loop, 1000);
}


// ******************************************************** declare mobile input
var telInput = $("#mobile"),
    errorMsg = $("#error-msg"),
    validMsg = $("#valid-msg");

telInput.intlTelInput({
//autoFormat: false,
//autoHideDialCode: false,
defaultCountry: "ir",
// defaultCountry: "auto",
// nationalMode: true,
// numberType: "MOBILE",
//onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
preferredCountries: ['ir'],
// responsiveDropdown: true,
utilsScript: "static/js/intlTelInput-utils.js"
});

telInput.on("invalidkey", function() {
  telInput.addClass("flash");
  setTimeout(function() {
    telInput.removeClass("flash");
  }, 100);
});

telInput.keyup(function() {
  var intlNumber = telInput.intlTelInput("getCleanNumber");
  if (intlNumber) {
    // @hasan: send to php with ajax 
    // output.text("International: " + intlNumber);
  } else {
    // Do not Aloow submit form before input correct mobile number
    // output.text("Please enter a number below");
  }
});

// on blur: validate
telInput.blur(function() {
  if ($.trim(telInput.val())) {
    if (telInput.intlTelInput("isValidNumber")) {
      telInput.addClass("valid");
      telInput.removeClass("invalid");
    } else {
      telInput.addClass("invalid");
      telInput.removeClass("valid");
    }
  }
});

// on keydown: reset
telInput.keydown(function() {
  telInput.removeClass("valid");
  telInput.removeClass("invalid");
});
// ******************************************************** End mobile input
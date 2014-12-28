$(document).ready(function () {
    hideFields();

    $(".fields-toggle").change(function () {
        $("."+this.value).toggleClass('hide');
    });

    $("#options-link").click(function () {
        $("#meta").toggleClass('hide');
    });

});

function hideFields() {
    $("input:checkbox").each(function()
    {

        if( !$(this).is(":checked") )
        {
            $("."+$(this).val()).addClass('hide');
        }
    }
);}





function UpdateTableHeaders() {
   $(".persist-area").each(function() {
   
       var el             = $(this),
           offset         = el.offset(),
           scrollTop      = $(window).scrollTop(),
           floatingHeader = $(".floatingHeader", this)
       
       if ((scrollTop > offset.top) && (scrollTop < offset.top + el.height())) {
           floatingHeader.css({
            "visibility": "visible",
            "opacity": "1"
           });
       } else {
           floatingHeader.css({
            "visibility": "hidden"
           });      
       };
   });
}

// DOM Ready      
$(function() {

   var clonedHeaderRow;

   $(".persist-area").each(function() {
       clonedHeaderRow = $(".persist-header", this);
       clonedHeaderRow
         .before(clonedHeaderRow.clone())
         .addClass("floatingHeader");
         
   });
   
   $(window)
    .scroll(UpdateTableHeaders)
    .trigger("scroll");
   
});




var previousScroll = 0;
$(window).on("scroll touchmove", function () {
  var currentScroll = $(this).scrollTop();

  $('body').toggleClass('tiny', $(document).scrollTop() > 100);
  $('body').toggleClass('full', $(document).scrollTop() > 200);

  // for detect slide status on other elements
  $('body').toggleClass('slideDown', currentScroll < previousScroll);
  $('body').toggleClass('slideUp', currentScroll > previousScroll);

  // for slide up and down header
  $('#header').toggleClass('slideDown', currentScroll+50 < previousScroll && $(document).scrollTop() > (screen.height-60) );
  $('#header').toggleClass('slideUp', currentScroll-50 > previousScroll && $(document).scrollTop() > (screen.height-60) );

   previousScroll = currentScroll;
});














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
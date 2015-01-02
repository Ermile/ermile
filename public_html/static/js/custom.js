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


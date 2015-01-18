route('*', 'cp.js', function() {
  hideFields();

  $(".fields-toggle", this).change(function () {
    var box = $("."+this.value);
    box.toggleClass('disappear');
  });
  $("#options-link", this).click(function () {
    console.log('clicked');
    $("#options-meta").toggleClass('disappear');
  });
  
  var $slug = $('#slug');
  if($slug.length) {
    $('#title').keypress(function() {
      $slug.val(slugify(this.value));
    });
  }
});

function hideFields()
{
  $("input:checkbox", this).each(function()
  {
    if( !$(this).is(":checked") )
    {
      $("."+$(this).val()).addClass('disappear');
    }
  }
  );}

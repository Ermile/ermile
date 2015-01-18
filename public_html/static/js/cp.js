function slugify(text) {
  return text.toString().toLowerCase()
    .replace(/\s+/g, '-')           // Replace spaces with -
    .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
    .replace(/\-\-+/g, '-')         // Replace multiple - with single -
    .replace(/^-+/, '')             // Trim - from start of text
    .replace(/-+$/, '');            // Trim - from end of text
}

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

  var $slug = $('#slug'),
      handEdited = false;
  if($slug.length) {
    $('#title').keyup(function() {
      var sv = $slug.val();
      if(sv && handEdited) return;
      handEdited = false;
      $slug.val(slugify(this.value));
    });
    $slug.keyup(function() {
      if(this.value) handEdited = true;
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

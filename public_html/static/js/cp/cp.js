function slugify(text) {
  return text.toString().toLowerCase()
    .replace(/\s+/g, '-')           // Replace spaces with -
    // .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
    .replace(/\-\-+/g, '-')         // Replace multiple - with single -
    .replace(/^-+/, '')             // Trim - from start of text
    .replace(/-+$/, '')             // Trim - from end of text
    .replace(/=.*/, '');            
}


// ***************************************************** slug
function bindSlug() {
  $('#form_posts').on('ajaxify:success', function() {
    Navigate({
      url: location.href,
      replace: true,
      filter: 'slug'
    })
  });
}


route('*', function() 
{
  console.log('route');

  hideFields();
  
  $(window).on('statechange', function() {
    // history.state.url.indexOf('posts');
    if(history.state && !history.state.replace) {
      console.log('statechange');
      bindSlug();
    }
  });
  bindSlug();


  $(".fields-toggle", this).change(function () {
    var box = $("."+this.value);
    box.toggleClass('disappear');
  });
  $("#options-link", this).click(function () {
    console.log('clicked');
    $("#options-meta").toggleClass('disappear');
  });

  $(document).bind('ajaxSuccess', function(e, promise, xhr) {
    if(xhr.url === $('#delete-confirm [data-ajaxify]').prop('href')) {
      setTimeout(function() {
        Navigate({
          url: location.href,
          replace: true
        });
      }, 500);
    }
  });

  $('#delete-confirm').on('open', function(e, link) {
    var $this = $(this),
        $link = $(link);

    $this.find('a[data-ajaxify]').attr('href', $link.attr('href'))
         .copyData($this);
  });

  // var $slug = $('#slug'),
  //     slug = $slug.get(0),
  //     handEdited = false;
  // if($slug.length) {
  //   $('#title').keyup(function()
  //   {
  //     var sv = $slug.val();
  //     if(sv && handEdited) return;
  //     handEdited = false;
  //     $slug.val(slugify(this.value));
  //     $('#url-slug').html($slug.val());
  //   });
  //   $slug.parents('form').submit(function()
  //   {
  //     if(!slug.value) slug.value = slugify($('#title').val());
  //   });
  //   $slug.keyup(function()
  //   {
  //     if(this.value) handEdited = true;
  //     $('#url-slug').html(slugify($slug.val()));
  //   });
  //   $('#url-slug').html($slug.val());
  // }


  // ============================================================================= checkbox
  // ************************************** first init loop in all checkboxes
  $('.cats input:checkbox:checked').each(function()
  {
    console.log($(this).data('slug'));
    console.log($('#cat').val());
    if($(this).data('slug') === $('#cat').val())
    {
      console.log(33);
      $(this).parent().appendTo('#cat-main');
    }
    else
      $(this).parent().appendTo('#cat-selected');
  });

  // ************************************** on change check box after page load
  $(".item input:checkbox").change(function()
  {
    // if checked
    if($(this).is(":checked"))
    {
      // if main cat not set, set it as main cat
      if($('#cat-main').children().length == 1)
      {
        $(this).parent().appendTo('#cat-main');
        $('#cat').val($(this).data('slug'));
      }
      // else add to selected cat list
      else
        $(this).parent().appendTo('#cat-selected');
    }
    // if uncheck
    else if($(this).is(":not(:checked)"))
    {
      $(this).parent().prependTo('#cat-list');
      $('#cat').val('');
    }
  });



  var $options = $('#options-meta');

  if($options.length) {
    $options.find('input').change(function() {
      var data = $options.getData();
      $.ajax({
        url: location.protocol + '//' + location.hostname + 
             location.pathname.slice(0, location.pathname.lastIndexOf('/')+1) + 'options',
        type: 'post',
        data: data,
        dataType: 'json',
        cache: false
      });
    });
  }

  
  $('#tag-add').keypress(function(e)
  {
    // if Enter pressed disallow it and run add func
    if(e.which == 13) { addTag(); return false; }
  });
  $(document).on('click', '#tag-add-btn', function () { addTag(); });
  $(document).on('click', '#tag-list span i', function ()
  {
    var span = $(this).parent();
    $('#tags').val($('#tags').val().replace(span.text()+', ', ''));
    span.remove();
  });

  $(document).ready(function()
  {
    var tagDefault = $('#tags').val();
    $('#tag-list').text('');
    if(tagDefault)
    {
      $.each(tagDefault.split(', '),function(t, item)
      {
        if(item.trim())
          $('#tag-list').append( "<span><i class='fa fa-times'></i>"+item+"</span>" );   
      });
    }
  });





});

function addTag()
{
  var tag = $('#tag-add');
  var newTag = tag.val().trim();
  if(newTag)
  {

    var exist = false;
    $.each($('#tags').val().split(', '),function(t, item)
    {
      if(item == newTag) {exist = t+1;}
    });

    if(exist)
    {
      existEl = $("#tag-list span:nth-child("+exist+")" );
      bg = existEl.css('background-color');
      existEl.css('background-color', '#ddd');
      setTimeout(function () { existEl.css("background-color",bg) }, 500);
    }
    else
    {
      $('#tag-list').append( "<span><i class='fa fa-times'></i>"+newTag+"</span>" );
      $('#tags').val( $('#tags').val() + newTag+', ' );
    }
  }
  tag.val('');  
}

function hideFields()
{
  $("input:checkbox", document).each(function()
  {
    if( !$(this).is(":checked") )
    {
      $("."+$(this).val()).addClass('disappear');
    }
  }
  );}

(function(root) {
  root.focusedFile = false;

  function focusFix(add) {
    var l = $('#file-div').children().length - 1;
    if(focusedFile === false) focusedFile = -1;
    focusedFile += add;
    if(focusedFile > l) focusedFile = 0;
    else if(focusedFile < 0) focusedFile = l;


    $('#file-div').children().removeClass('focus').eq(focusedFile).addClass('focus').trigger('focus');
  }

  Mousetrap.bind('right', function(e) {
    e.preventDefault();
    focusFix(1);
  });

  Mousetrap.bind('left', function(e) {
    e.preventDefault();
    focusFix(-1);
  })

  Mousetrap.bind('up', function(e) {
    e.preventDefault();
    var d = -1*(Math.round($('#file-div').innerWidth() / $('#file-div').children().outerWidth()) - 1);
    if(focusedFile + d < 0) return;
    focusFix(d);
  })

  Mousetrap.bind('down', function(e) {
    e.preventDefault();
    var d = Math.round($('#file-div').innerWidth() / $('#file-div').children().outerWidth()) - 1;
    if(focusedFile + d >= $('#file-div').children().length) return;
    focusFix(d);
  })

  $('#file-div').on('click', '.file, .folder', function(e) {
    $('#file-div').children().removeClass('focus')
    $(this).addClass('focus').trigger('focus');
    focusedFile = $(this).index();
  });

})(this);
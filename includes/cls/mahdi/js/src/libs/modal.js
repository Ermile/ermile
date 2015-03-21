(function(e, t) {
  $(document).ready(function() {
    $(document.body).click(function(e) {
      var $target = $(e.target);
      if($target.is('[data-modal]') || $target.parents('[data-modal]').length || 
         $target.is('.modal-dialog') || $target.parents('.modal-dialog').length) return;
      $('.modal').trigger('close');
    });
  });
})(this);
  $('#sidebar div > span').click(function()
  {
    var menuTitle = $(this);
    var submenu   = $(this).parent().children('ul');
    if (submenu)
    {
      submenu.stop().slideToggle(300);
      menuTitle.toggleClass('open');
    }
  });
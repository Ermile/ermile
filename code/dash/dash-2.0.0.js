  $('#sidebar ul.sidenav > li > a').click(function()
  {
    var menuTitle = $(this);
    var submenu   = $(this).parent().children('ul');
    console.log(submenu);
    if (submenu)
    {
      submenu.stop().slideToggle(300);
      menuTitle.toggleClass('open');
    }
  });
// on start
route('*', function ()
{


}).once(function()
{

  runDataResponse();
  showFilePreview();
  responsiveSidebar();
  setLanguageURL();

});



/**
 * set link of language on each page
 */
function setLanguageURL()
{
  var urlPath     = window.location.pathname;
  var urlHash     = window.location.hash;
  var indexOfLang = urlPath.indexOf('/' + $('html').attr('lang'));
  var urlBase     = $('base').attr('href');
  urlBase         = urlBase.substr(0, urlBase.indexOf('/', 9));

  if(indexOfLang === 0)
  {
    urlPath = urlPath.substr(4);
  }
  else
  {
    urlPath = urlPath.substr(1);
  }

  $('.langlist a').each(function(key, index)
  {
    var lang = $(index).attr('hreflang');
    // if we are in this language
    if(lang == $('html').attr('lang'))
    {
      $(index).attr('class', 'isActive');
    }
    if(lang == 'en')
    {
      lang = '';
    }
    else if(lang == $('html').attr('lang'))
    {
      // lang = '/' + lang;
    }
    var myUrl = urlPath;
    if(lang)
    {
      myUrl = lang + '/' + myUrl;
    }
    // add hash if exist
    if(urlHash)
    {
      myUrl += urlHash;
    }
    myUrl = urlBase + '/' + myUrl;
    $(index).attr('href', myUrl.trim('/'));
  })
}


/**
 * show preview of input file if its posible
 * @return {[type]} [description]
 */
function showFilePreview()
{
  $('input[type="file"][data-preview]').on('change', function()
  {
    var myLabel   = $(this).parent().find('label');
    var myImgPrev = myLabel.find('img');
    var myImgSrc  = null;

    if(myImgPrev.length < 1)
    {
      // create img element and replace it in html
      var myImg = document.createElement("img");
      myImg.id  = $(this).attr('id') + 'Preview';
      myLabel.html(myImg);
      // get new inserted img
      myImgPrev = myLabel.find('img');
    }

    // get image path and ext
    var imgPath = $(this)[0].value;
    var imgExt  = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
    // if selected valid extention for preview
    if (imgExt == "gif" || imgExt == "png" || imgExt == "jpg" || imgExt == "jpeg")
    {
      // if file reader is defined!
      if (typeof (FileReader) != "undefined")
      {
        // create new reader
        var reader = new FileReader();

        reader.onload = function (e)
        {
          // get loaded data and render thumbnail.
          myImgPrev.attr('src', e.target.result);
        };

        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
        myImgSrc = true;
      }
      else
      {
        console.log('file reader is undefined!');
        var blobURL = window.URL.createObjectURL(this.files[0]);
        myImgPrev.attr('src', blobURL);
        myImgSrc = true;
      }
    }
    else
    {
      console.log('we cant preview this type of file');
      myImgPrev.attr('src', null);
    }
  });
}



/**
 * handle responsive sidebar on mobile and tablets
 * @return {[type]} [description]
 */
function responsiveSidebar()
{
  $('#main').on('click', function(_e)
  {
    if($(_e.target).parents('#sidenavHandler').length)
    {
      // click on hanlder, do nothing!
      $("body").attr('data-sidebar', 'dada');
    }
    else if($('body').attr('data-sidebar') === undefined)
    {
      // do nothing because its none!
    }
    else
    {
      $("body").attr('data-sidebar', null);
    }
  });

  $('#sidebar a[href]').on('click', function()
  {
      setTimeout(function()
      {
        $("body").attr('data-sidebar', null);
      }, 500);
  })

  // $('#sidebar ul.sidenav > li > a').click(function()
  // {
  //   var menuTitle = $(this);
  //   var submenu   = $(this).parent().children('ul');
  //   console.log(submenu);
  //   if (submenu)
  //   {
  //     submenu.stop().slideToggle(300);
  //     menuTitle.toggleClass('open');
  //   }
  // });
}



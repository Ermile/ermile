// on start
route('*', function ()
{


}).once(function()
{

  runDataResponse();
  showFilePreview();

});



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
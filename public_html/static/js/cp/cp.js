/**
 * Ermile Control Panel JS
 * V 3.0.0
 */


/***cpjs***/(function(){window.saloos||(window.saloos=new Object)}).call(this),function(){$.fn.dataTableExt.sErrMode="throw",window.saloos.datatable=function(){function datatable(el){var e,first_data;if(el instanceof Element){try{first_data=JSON.parse($("tbody td:first",el).text())}catch(_error){e=_error,$("tbody td:first",el).html("<tr><td>Json paresError</td></tr>"),console.log(e)}first_data&&($(el).empty(),$(el).removeClass("hidden"),run.call(el,first_data))}else el.each(function(){return new window.saloos.datatable(this)})}var col_creat,data_compile,first_make_data,run;return first_make_data=!0,data_compile=Object(),col_creat=Object(),run=function(columns){var cl,lang,o_columns,obj;o_columns=Array(),columns.columns.id&&(columns.columns.id.table=!0);for(cl in columns.columns)columns.columns[cl].table&&(columns.columns[cl].title=columns.columns[cl].label,columns.columns[cl].name=cl,columns.columns[cl].data=cl,columns.columns[cl].className="col_"+columns.columns[cl].value,obj={title:columns.columns[cl].label,name:cl,data:cl,className:"col_"+columns.columns[cl].value,_resp:columns.columns[cl],createdCell:col_creat[columns.columns[cl].value]?col_creat[columns.columns[cl].value]:null},"id"===cl&&(obj.className="col_row"),o_columns.push(obj));return o_columns.push({orderable:!1,title:"",name:"id",data:"id",className:"col_actions",createdCell:col_creat.action?col_creat.action:null}),lang=document.documentElement.lang.slice(0,2)+".json",$(this).DataTable({language:{url:location.protocol+"//"+location.hostname.match(/([^\.]*)\.([^\.]*)$/)[0]+"/static/js/datatable/datatable-langs/"+lang},processing:!0,serverSide:!0,columns:o_columns,ajax:{cache:!0,url:$(this).attr("data-tablesrc"),beforeSend:function(){return first_make_data?(first_make_data=!1,this.error=0,this.success(columns),!1):0},data:function(data){var d,ret,val;ret=Array();for(d in data)data_compile[d]&&(val=data_compile[d](data[d],data),val&&ret.push(val));return ret.join("&")}},rowCallback:function(row,data,index){},createdRow:function(row,data,dataIndex){var len,num,sort,start,total;return len=this.fnSettings()._iDisplayLength,start=this.fnSettings()._iDisplayStart,sort=this.fnSettings().aaSorting[0][1],total=this.fnSettings()._iRecordsDisplay,"asc"===sort?num=dataIndex+start+1:(num=total-(dataIndex+start),data.num=num),$("td:first",row).text(num)}})},data_compile.order=function(order,data){var col_name;return col_name=data_compile.getColName(data,order[0].column),"sortby="+col_name+"&order="+order[0].dir},data_compile.search=function(search,data){return search.value?"search="+search.value:void 0},data_compile.length=function(length){return"length="+length},data_compile.start=function(start){return"start="+start},data_compile.draw=function(draw){return"draw="+draw},data_compile.getColName=function(data,col){return data.columns[col].name?data.columns[col].name:col},col_creat.action=function(td,cellData,rowData,row,col){var html,text;return text=$(td).text(),html=$('<span class="fa-stack fa-lg"> <i class="fa fa-square-o fa-stack-2x"></i> <a class="fa fa-pencil fa-stack-1x label-default" href="'+location.pathname+"/edit="+rowData.id+'"></a> </span> <span class="fa-stack fa-lg"> <i class="fa fa-square-o fa-stack-2x"></i> <a class="fa fa-times fa-stack-1x label-danger" href="'+location.pathname+"/delete="+rowData.id+'" data-data=\'{"id": '+rowData.id+'}\' data-method="post" data-modal="delete-confirm"></a> </span>'),$(td).html(html)},col_creat.title=function(td,cellData,rowData,row,col){var html,text;return text=$(td).text(),html=$("<a href='"+location.pathname+"/edit="+rowData.id+"'>"+text+"</a>"),$(td).html(html)},col_creat.url=function(td,cellData,rowData,row,col){var html,root,site_location,text;return text=$(td).text(),root=$("meta[name='site:root']").attr("content"),site_location=root+text,html=$("<a href='"+site_location+"?preview=yes' target='_blank'>"+text+"</a>"),$(td).html(html)},col_creat.filetype=function(td,cellData,rowData,row,col){return $(td).html('<i class="fa fa-2x fa-file-'+cellData.type+'-o"></i>')},datatable}(),route("*",function(){return $("[data-tablesrc]",this).each(function(){return new window.saloos.datatable(this)})})}.call(this),function(){window.saloos.getCatlist=function(){function getCatlist(el){$(".panel-body .item span",el).unbind("click.getCatlist"),$(".panel-body .item span",el).bind("click.getCatlist",function(){var id,parent;return parent=$(this).parents(".panel"),$(parent).hasClass("data-disabled")?void 0:(parent.addClass("data-disabled"),$(":checkbox",parent).attr("disabled",""),id=$(this).parents(".item").find(":checkbox").val(),ajax.call(this,id))})}var ajax;return ajax=function(id){var addr,parent;return/^\d+$/.test(id)||(id="",parent=$(this).parents(".panel"),$(".panel-heading span",parent).remove()),addr=location.pathname.replace(/\/[^\/]*$/,"")+"/options",$.ajax({context:this,url:addr,data:{parent:id,type:"getcatlist"}}).done(function(obj,header,xhr){var ch,i,j,label,ref;if(200===xhr.status){for($(".cat-list").empty(),parent=$(this).parents(".panel"),parent[0]||(parent=$(".cats")),parent.removeClass("data-disabled"),$(".panel-heading i",parent).removeClass("hidden"),$(".panel-heading span",parent).remove(),""!==id&&($("<span> × "+$(this).text()+" </span>").appendTo($(".panel-heading",parent)),$(".panel-heading span",parent).click(ajax)),$(":checkbox",parent).removeAttr("disabled"),$("#cat-list",parent).empty(),i=j=0,ref=obj.data.length;ref>=0?ref>j:j>ref;i=ref>=0?++j:--j)ch=$(":checkbox[value="+obj.data[i].id+"]",parent),ch.length||(label=$("<label class='item'><input type='checkbox' name='categories[]' value='"+obj.data[i].id+"' data-slug='book-index/haj'> <span>"+obj.data[i].title+"</span></label>"),label.appendTo($("#cat-list",parent)));return cat_selected(),void new saloos.getCatlist(parent[0])}}),!1},getCatlist}(),route("*",function(){return $(".cats",this).each(function(){return new saloos.getCatlist(this)})})}.call(this),function(){window.saloos.getParentlist=function(){function getParentlist(el){var name;name=$(el).attr("name"),$(el).removeAttr("name"),$('<input id="hidden-parent" type="hidden" name="'+name+'" value="'+$(el).val()+'">').insertBefore($(el)),$(el).change(change)}var change,remove;return change=function(){var addr,val;return val=$(this).val(),remove.call(this),""===val?(val=$(this).prev("select").val(),void $("#hidden-parent").val(val)):($("#hidden-parent").val(val),$(this,$(this).parents(".panel")).attr("disabled",""),addr=location.pathname.replace(/\/[^\/]*$/,"")+"/options",$.ajax({context:this,url:addr,data:{parent:val,type:"getparentlist"}}).done(function(obj,header,xhr){var i,j,parent,ref,select;if(200!==xhr.status)return void $("#hidden-parent").val("");if(parent=$(this).parents(".panel"),$(this,parent).removeAttr("disabled"),obj.data.length>0)for(select=$("<select class='input'></select>"),select.insertAfter($(this)),$('<option selected="selected"></option>').appendTo(select),select.change(change),i=j=0,ref=obj.data.length;ref>=0?ref>j:j>ref;i=ref>=0?++j:--j)$('<option value="'+obj.data[i].id+'">'+obj.data[i].title+"</option>").appendTo(select);return void 0}))},remove=function(){var _self,parent,start_remove;return _self=this,parent=$(this).parents(".panel"),start_remove=!1,$("select",parent).each(function(){return start_remove&&$(this).remove(),$(this).is(_self)?start_remove=!0:void 0})},getParentlist}(),route("*",function(){return $("#sp-parent",this).each(function(){return new saloos.getParentlist(this)})})}.call(this);/***cpjs***/

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

function showPass()
{
  $("#pass").focus(function()
  {
    this.type = "text";
  }).blur(function()
  {
    this.type = "password";
  })
}
showPass();



checkPermissions();


route('*', function()
{
  hideFields();
  $(window).off('statechange');
  $(window).on('statechange', function()
  {
    checkLocation();
    showPass();
    // history.state.url.indexOf('posts');
    if(history.state && !history.state.replace) {
      // console.log('statechange');
      bindSlug();
    }

    if(location.pathname.match('/permissions/'))
    {
      checkPermissions();
    }
  });
  bindSlug();


  $(".fields-toggle", this).change(function () {
    var box = $("."+this.value);
    box.toggleClass('disappear');
  });
  $("#options-link", this).click(function () {
    // console.log('clicked');
    $("#options-meta").toggleClass('disappear');
  });
  $(document).unbind('ajaxSuccess');
  $(document).bind('ajaxSuccess', function(e, promise, xhr) {
    bindSlug();
    if(xhr.url === $('#delete-confirm [data-ajaxify]').prop('href')) {
      // setTimeout(function() {
      //   Navigate({
      //     url: location.href,
      //     replace: true
      //   });
      // }, 500);
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
  cat_selected();



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
    $('#sp-tags').val($('#sp-tags').val().replace(span.text()+', ', ''));
    span.remove();
  });

  $(document).ready(function()
  {
    // declare functions
    checkInputFirstTime();
    checkInputChange();

    // add tab support to cp
    $('.tabs li').click(function()
    {
      var _this     = $(this);
      var tabNum    = _this.attr('data-tab');
      var tabsItems = _this.parent().children('li');
      var tabGroup  = _this.parent().attr('data-group');
      var tabSelected;
      var tabItems
      // if use group find it else use default tab value
      if(tabGroup)
      {
        tabItems  = $('.tab[data-group="'+ tabGroup +'"]');
      }
      else
      {
        tabItems  = $('.tab');
      }

      // remove active class from all items and select clicked item
      tabsItems.removeClass('active');
      _this.addClass('active');

      if(tabNum)
      {
        tabSelected = tabItems.children("#tab-"+tabNum);
        // $('[id^=tab-]').not(tabSelected).css('display', "none");
        tabItems.children('[id^=tab-]').not(tabSelected).css('display', "none");
      }
      else
      {
        tabNum = _this.index()+1;
        tabSelected = tabItems.children("li:nth-child("+tabNum+")");
        tabItems.children('li').not(tabSelected).css('display', "none");
      }
      $(tabSelected).fadeIn(300);
    })
    // run click for first time and show content of active tab
    $(".tabs").each(function()
    {
      // if select one element as active select content of it
      if($(this).children('li.active').length == 1)
      {
        $(this).children('li.active').trigger("click");
      }
      // else select first child
      else
      {
        $(this).children('li:first-child').trigger("click");
      }
    });


    var tagDefault = $('#sp-tags').val();
    $('#tag-list').text('');
    if(tagDefault)
    {
      $.each(tagDefault.split(', '),function(t, item)
      {
        if(item.trim())
          $('#tag-list').append( "<span><i class='fa fa-times'></i>"+item+"</span>" );
      });
    }


      $('[data-hint] input, [data-hint] select, [data-hint] .button').on('blur', function ()
      {
        $(this).parent().removeClass('hint--always');
      }).on('focus', function ()
      {
        $(this).parent().addClass('hint--always');
      });

  });

  $(".light-gallery", this).lightGallery();


});

function addTag()
{
  var tag = $('#tag-add');
  var newTag = tag.val().trim();
  if(newTag)
  {

    var exist = false;
    $.each($('#sp-tags').val().split(', '),function(t, item)
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
      $('#sp-tags').val( $('#sp-tags').val() + newTag+', ' );
    }
  }
  tag.val('');
}



/**
 * this function check status of input after change parent one
 */
function checkInput(_this, _firstTime)
{
	var chkID        = $(_this).attr('id');
  var chkChildrens = $('input[data-parent='+ chkID +']').parent();
	var chkChildrens = $('input[data-relation='+ chkID +']');

  if($(_this).is(":checked"))
  {
    chkChildrens.fadeIn()
    if(!_firstTime)
    {
      chkChildrens.prop('checked', true);
    }
  }
  else
  {
    chkChildrens.fadeOut();
  }
}

/**
 * check input for first time
 */
function checkInputFirstTime()
{
  $('input[type=checkbox]').each(function ()
  {
    checkInput(this, true);
  });
}

/**
 * check input for first time
 */
function checkInputChange()
{
  $('input[type="checkbox"]').change(function()
  {
    checkInput(this);
  });
}
checkInputChange();



/**
 * this function check status of permissions and do good job!
 */
function checkPermissions()
{
  //show or hide detail box of each part of permissions
  $('.permission-content .checkbox').change(function()
  {
    var contentName = $(this).attr('id');
    var contentDetail = $("#"+contentName+"-detail");

    if($(this).is(":checked"))
    {
      contentDetail.removeClass('closed');
      contentDetail.slideDown(300);
    }
    else
    {
      contentDetail.slideUp(500);
    }
  });

  $(".permission-detail [class$='-all']").click(function()
  {
    var detailField  = $(this).parents('.row').find('.checkbox');
    var detailChecks = detailField.filter(':checked').length;
    if(detailField.length == detailChecks)
    {
      detailField.prop('checked', false);
    }
    else
    {
      detailField.prop('checked', true);
    }
  });

  // check view checkbox if another one is checked
  // because for all of them first need to view!
  $('.permission-detail .checkbox').change(function()
  {
      if(!$(this).is("[name$='-view']") && $(this).prop('checked') )
      {
          $(this).parents('.row').find(".checkbox").filter("[name$='-view']").prop('checked', true);

      }

  });


  // $(".permission-detail [class$='-all']").change(function()
  // {
  //   var detailField  = $(this).parents('.row').find('.checkbox').not("[name$='-all']");
  //   var detailChecks = detailField.filter(':checked');

  //   // if click on all checkbox change status of others
  //   if($(this).is("[name$='-all']"))
  //   {
  //     detailField.prop('checked', $(this).prop("checked"));
  //   }
  //   // if user on or off 4th checkbox, do it for all check on this field
  //   else if(detailChecks.length == $(this).parents('.row').find('.checkbox').length - 1)
  //   {
  //     $(this).parents('.row').find(".checkbox").filter("[name$='-all']").prop('checked', $(this).prop("checked"));
  //   }
  //   else
  //   {
  //     if(!$(this).is("[name$='-view']") && $(this).prop('checked') )
  //     {
  //         $(this).parents('.row').find(".checkbox").filter("[name$='-view']").prop('checked', true);
  //     }
  //     $(this).parents('.row').find(".checkbox").filter("[name$='-all']").prop('checked', false);
  //   }
  // });

  // on click each title select or deselect all of this column
  $(".permission-detail .head div").click(function()
  {
    var mySelection;
    if($(this).hasClass('allAll'))
    {
      mySelection = 'all';
    }
    else if($(this).hasClass('allView'))
    {
      mySelection = 'view';
    }
    else if($(this).hasClass('allAdd'))
    {
      mySelection = 'add';
    }
    else if($(this).hasClass('allEdit'))
    {
      mySelection = 'edit';
    }
    else if($(this).hasClass('allDelete'))
    {
      mySelection = 'delete';
    }
    else if($(this).hasClass('allAdmin'))
    {
      mySelection = 'admin';
    }
    var detailField = $(this).parents('.panel-body').find('.checkbox').filter("[name$='-" + mySelection + "']");
    if($(this).hasClass('allAll'))
    {
      var detailField = $(this).parents('.panel-body').find('.checkbox');
    }
    var detailChecks = detailField.filter(':checked');

    if(detailField.length == detailChecks.length)
    {
      detailField.prop('checked', false).change();
    }
    else
    {
      detailField.prop('checked', true).change();
    }
  });
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


function cat_selected()
{
  $('.cats input:checkbox:checked').each(function()
  {
    // console.log($('#cat').val());
    if($(this).data('slug') === $('#cat').val())
    {
      // console.log(33);
      $(this).parent().appendTo('#cat-main');
    }
    else
      $(this).parent().appendTo('#cat-selected');
  });

  // ************************************** on change check box after page load
  $(".item input:checkbox").unbind("change.cat_selected")
  $(".item input:checkbox").bind('change.cat_selected', function()
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
}

/**
 * check current location and highligh it
 */
function checkLocation()
{
  var CURRENTPATH = (location.pathname).replace(/^\/+/, '');
  var currentModule = CURRENTPATH;

  if(CURRENTPATH.indexOf('/') > -1)
  {
    currentModule = CURRENTPATH.substring(0, CURRENTPATH.indexOf('/'));
  }
  $('#page-sidebar a').removeClass('active');

  $('#page-sidebar .sidebar-items a').each(function()
  {
    var myHref    = $(this).attr('href');
    myHref        = myHref.substring(myHref.lastIndexOf('/')+1);

    if(myHref == currentModule)
    {
      $(this).addClass('active');
    }
  });
}
checkLocation();




// intro js v1.1.1
(function(B,n){"object"===typeof exports?n(exports):"function"===typeof define&&define.amd?define(["exports"],n):n(B)})(this,function(B){function n(a){this._targetElement=a;this._options={nextLabel:"Next &rarr;",prevLabel:"&larr; Back",skipLabel:"Skip",doneLabel:"Done",tooltipPosition:"bottom",tooltipClass:"",highlightClass:"",exitOnEsc:!0,exitOnOverlayClick:!0,showStepNumbers:!0,keyboardNavigation:!0,showButtons:!0,showBullets:!0,showProgress:!1,scrollToElement:!0,overlayOpacity:0.8,positionPrecedence:["bottom",
"top","right","left"],disableInteraction:!1}}function M(a){var b=[],c=this;if(this._options.steps)for(var e=0,d=this._options.steps.length;e<d;e++){var f=H(this._options.steps[e]);f.step=b.length+1;"string"===typeof f.element&&(f.element=document.querySelector(f.element));if("undefined"===typeof f.element||null==f.element){var h=document.querySelector(".introjsFloatingElement");null==h&&(h=document.createElement("div"),h.className="introjsFloatingElement",document.body.appendChild(h));f.element=h;
f.position="floating"}null!=f.element&&b.push(f)}else{d=a.querySelectorAll("*[data-intro]");if(1>d.length)return!1;e=0;for(f=d.length;e<f;e++){var h=d[e],q=parseInt(h.getAttribute("data-step"),10);0<q&&(b[q-1]={element:h,intro:h.getAttribute("data-intro"),step:parseInt(h.getAttribute("data-step"),10),tooltipClass:h.getAttribute("data-tooltipClass"),highlightClass:h.getAttribute("data-highlightClass"),position:h.getAttribute("data-position")||this._options.tooltipPosition})}e=q=0;for(f=d.length;e<
f;e++)if(h=d[e],null==h.getAttribute("data-step")){for(;"undefined"!=typeof b[q];)q++;b[q]={element:h,intro:h.getAttribute("data-intro"),step:q+1,tooltipClass:h.getAttribute("data-tooltipClass"),highlightClass:h.getAttribute("data-highlightClass"),position:h.getAttribute("data-position")||this._options.tooltipPosition}}}e=[];for(d=0;d<b.length;d++)b[d]&&e.push(b[d]);b=e;b.sort(function(a,b){return a.step-b.step});c._introItems=b;N.call(c,a)&&(x.call(c),a.querySelector(".introjs-skipbutton"),a.querySelector(".introjs-nextbutton"),
c._onKeyDown=function(b){if(27===b.keyCode&&!0==c._options.exitOnEsc)void 0!=c._introExitCallback&&c._introExitCallback.call(c),y.call(c,a);else if(37===b.keyCode)C.call(c);else if(39===b.keyCode)x.call(c);else if(13===b.keyCode){var d=b.target||b.srcElement;d&&0<d.className.indexOf("introjs-prevbutton")?C.call(c):d&&0<d.className.indexOf("introjs-skipbutton")?(c._introItems.length-1==c._currentStep&&"function"===typeof c._introCompleteCallback&&c._introCompleteCallback.call(c),void 0!=c._introExitCallback&&
c._introExitCallback.call(c),y.call(c,a)):x.call(c);b.preventDefault?b.preventDefault():b.returnValue=!1}},c._onResize=function(a){t.call(c,document.querySelector(".introjs-helperLayer"));t.call(c,document.querySelector(".introjs-tooltipReferenceLayer"))},window.addEventListener?(this._options.keyboardNavigation&&window.addEventListener("keydown",c._onKeyDown,!0),window.addEventListener("resize",c._onResize,!0)):document.attachEvent&&(this._options.keyboardNavigation&&document.attachEvent("onkeydown",
c._onKeyDown),document.attachEvent("onresize",c._onResize)));return!1}function H(a){if(null==a||"object"!=typeof a||"undefined"!=typeof a.nodeType)return a;var b={},c;for(c in a)b[c]="undefined"!=typeof jQuery&&a[c]instanceof jQuery?a[c]:H(a[c]);return b}function x(){this._direction="forward";"undefined"===typeof this._currentStep?this._currentStep=0:++this._currentStep;if(this._introItems.length<=this._currentStep)"function"===typeof this._introCompleteCallback&&this._introCompleteCallback.call(this),
y.call(this,this._targetElement);else{var a=this._introItems[this._currentStep];"undefined"!==typeof this._introBeforeChangeCallback&&this._introBeforeChangeCallback.call(this,a.element);I.call(this,a)}}function C(){this._direction="backward";if(0===this._currentStep)return!1;var a=this._introItems[--this._currentStep];"undefined"!==typeof this._introBeforeChangeCallback&&this._introBeforeChangeCallback.call(this,a.element);I.call(this,a)}function y(a){var b=a.querySelector(".introjs-overlay");if(null!=
b){b.style.opacity=0;setTimeout(function(){b.parentNode&&b.parentNode.removeChild(b)},500);var c=a.querySelector(".introjs-helperLayer");c&&c.parentNode.removeChild(c);(c=a.querySelector(".introjs-tooltipReferenceLayer"))&&c.parentNode.removeChild(c);(a=a.querySelector(".introjs-disableInteraction"))&&a.parentNode.removeChild(a);(a=document.querySelector(".introjsFloatingElement"))&&a.parentNode.removeChild(a);if(a=document.querySelector(".introjs-showElement"))a.className=a.className.replace(/introjs-[a-zA-Z]+/g,
"").replace(/^\s+|\s+$/g,"");if((a=document.querySelectorAll(".introjs-fixParent"))&&0<a.length)for(c=a.length-1;0<=c;c--)a[c].className=a[c].className.replace(/introjs-fixParent/g,"").replace(/^\s+|\s+$/g,"");window.removeEventListener?window.removeEventListener("keydown",this._onKeyDown,!0):document.detachEvent&&document.detachEvent("onkeydown",this._onKeyDown);this._currentStep=void 0}}function J(a,b,c,e){var d="",f,h;b.style.top=null;b.style.right=null;b.style.bottom=null;b.style.left=null;b.style.marginLeft=
null;b.style.marginTop=null;c.style.display="inherit";"undefined"!=typeof e&&null!=e&&(e.style.top=null,e.style.left=null);if(this._introItems[this._currentStep]){d=this._introItems[this._currentStep];d="string"===typeof d.tooltipClass?d.tooltipClass:this._options.tooltipClass;b.className=("introjs-tooltip "+d).replace(/^\s+|\s+$/g,"");h=this._introItems[this._currentStep].position;if(("auto"==h||"auto"==this._options.tooltipPosition)&&"floating"!=h){d=h;f=this._options.positionPrecedence.slice();
h=F();var q=v(b).height+10,r=v(b).width+20,k=v(a),l="floating";k.left+r>h.width||0>k.left+k.width/2-r?(s(f,"bottom"),s(f,"top")):(k.height+k.top+q>h.height&&s(f,"bottom"),0>k.top-q&&s(f,"top"));k.width+k.left+r>h.width&&s(f,"right");0>k.left-r&&s(f,"left");0<f.length&&(l=f[0]);d&&"auto"!=d&&-1<f.indexOf(d)&&(l=d);h=l}d=v(a);a=v(b);f=F();switch(h){case "top":c.className="introjs-arrow bottom";z(d,15,a,f,b);b.style.bottom=d.height+20+"px";break;case "right":b.style.left=d.width+20+"px";d.top+a.height>
f.height?(c.className="introjs-arrow left-bottom",b.style.top="-"+(a.height-d.height-20)+"px"):c.className="introjs-arrow left";break;case "left":!0==this._options.showStepNumbers&&(b.style.top="15px");d.top+a.height>f.height?(b.style.top="-"+(a.height-d.height-20)+"px",c.className="introjs-arrow right-bottom"):c.className="introjs-arrow right";b.style.right=d.width+20+"px";break;case "floating":c.style.display="none";b.style.left="50%";b.style.top="50%";b.style.marginLeft="-"+a.width/2+"px";b.style.marginTop=
"-"+a.height/2+"px";"undefined"!=typeof e&&null!=e&&(e.style.left="-"+(a.width/2+18)+"px",e.style.top="-"+(a.height/2+18)+"px");break;case "bottom-right-aligned":c.className="introjs-arrow top-right";K(d,0,a,b);b.style.top=d.height+20+"px";break;case "bottom-middle-aligned":c.className="introjs-arrow top-middle";c=d.width/2-a.width/2;K(d,c,a,b)&&(b.style.right=null,z(d,c,a,f,b));b.style.top=d.height+20+"px";break;default:c.className="introjs-arrow top",z(d,0,a,f,b),b.style.top=d.height+20+"px"}}}
function z(a,b,c,e,d){if(a.left+b+c.width>e.width)return d.style.left=e.width-c.width-a.left+"px",!1;d.style.left=b+"px";return!0}function K(a,b,c,e){if(0>a.left+a.width-b-c.width)return e.style.left=-a.left+"px",!1;e.style.right=b+"px";return!0}function s(a,b){-1<a.indexOf(b)&&a.splice(a.indexOf(b),1)}function t(a){if(a&&this._introItems[this._currentStep]){var b=this._introItems[this._currentStep],c=v(b.element),e=10;"floating"==b.position&&(e=0);a.setAttribute("style","width: "+(c.width+e)+"px; height:"+
(c.height+e)+"px; top:"+(c.top-5)+"px;left: "+(c.left-5)+"px;")}}function O(){var a=document.querySelector(".introjs-disableInteraction");null===a&&(a=document.createElement("div"),a.className="introjs-disableInteraction",this._targetElement.appendChild(a));t.call(this,a)}function I(a){"undefined"!==typeof this._introChangeCallback&&this._introChangeCallback.call(this,a.element);var b=this,c=document.querySelector(".introjs-helperLayer"),e=document.querySelector(".introjs-tooltipReferenceLayer"),
d="introjs-helperLayer";v(a.element);"string"===typeof a.highlightClass&&(d+=" "+a.highlightClass);"string"===typeof this._options.highlightClass&&(d+=" "+this._options.highlightClass);if(null!=c){var f=e.querySelector(".introjs-helperNumberLayer"),h=e.querySelector(".introjs-tooltiptext"),q=e.querySelector(".introjs-arrow"),r=e.querySelector(".introjs-tooltip"),k=e.querySelector(".introjs-skipbutton"),l=e.querySelector(".introjs-prevbutton"),p=e.querySelector(".introjs-nextbutton");c.className=d;
r.style.opacity=0;r.style.display="none";if(null!=f){var g=this._introItems[0<=a.step-2?a.step-2:0];if(null!=g&&"forward"==this._direction&&"floating"==g.position||"backward"==this._direction&&"floating"==a.position)f.style.opacity=0}t.call(b,c);t.call(b,e);if((g=document.querySelectorAll(".introjs-fixParent"))&&0<g.length)for(d=g.length-1;0<=d;d--)g[d].className=g[d].className.replace(/introjs-fixParent/g,"").replace(/^\s+|\s+$/g,"");g=document.querySelector(".introjs-showElement");g.className=g.className.replace(/introjs-[a-zA-Z]+/g,
"").replace(/^\s+|\s+$/g,"");b._lastShowElementTimer&&clearTimeout(b._lastShowElementTimer);b._lastShowElementTimer=setTimeout(function(){null!=f&&(f.innerHTML=a.step);h.innerHTML=a.intro;r.style.display="block";J.call(b,a.element,r,q,f);e.querySelector(".introjs-bullets li > a.active").className="";e.querySelector('.introjs-bullets li > a[data-stepnumber="'+a.step+'"]').className="active";e.querySelector(".introjs-progress .introjs-progressbar").setAttribute("style","width:"+L.call(b)+"%;");r.style.opacity=
1;f&&(f.style.opacity=1);-1===p.tabIndex?k.focus():p.focus()},350)}else{var n=document.createElement("div"),l=document.createElement("div"),c=document.createElement("div"),m=document.createElement("div"),s=document.createElement("div"),D=document.createElement("div"),E=document.createElement("div"),u=document.createElement("div");n.className=d;l.className="introjs-tooltipReferenceLayer";t.call(b,n);t.call(b,l);this._targetElement.appendChild(n);this._targetElement.appendChild(l);c.className="introjs-arrow";
s.className="introjs-tooltiptext";s.innerHTML=a.intro;D.className="introjs-bullets";!1===this._options.showBullets&&(D.style.display="none");for(var n=document.createElement("ul"),d=0,B=this._introItems.length;d<B;d++){var z=document.createElement("li"),A=document.createElement("a");A.onclick=function(){b.goToStep(this.getAttribute("data-stepnumber"))};d===a.step-1&&(A.className="active");A.href="javascript:void(0);";A.innerHTML="&nbsp;";A.setAttribute("data-stepnumber",this._introItems[d].step);
z.appendChild(A);n.appendChild(z)}D.appendChild(n);E.className="introjs-progress";!1===this._options.showProgress&&(E.style.display="none");d=document.createElement("div");d.className="introjs-progressbar";d.setAttribute("style","width:"+L.call(this)+"%;");E.appendChild(d);u.className="introjs-tooltipbuttons";!1===this._options.showButtons&&(u.style.display="none");m.className="introjs-tooltip";m.appendChild(s);m.appendChild(D);m.appendChild(E);!0==this._options.showStepNumbers&&(g=document.createElement("span"),
g.className="introjs-helperNumberLayer",g.innerHTML=a.step,l.appendChild(g));m.appendChild(c);l.appendChild(m);p=document.createElement("a");p.onclick=function(){b._introItems.length-1!=b._currentStep&&x.call(b)};p.href="javascript:void(0);";p.innerHTML=this._options.nextLabel;l=document.createElement("a");l.onclick=function(){0!=b._currentStep&&C.call(b)};l.href="javascript:void(0);";l.innerHTML=this._options.prevLabel;k=document.createElement("a");k.className="introjs-button introjs-skipbutton";
k.href="javascript:void(0);";k.innerHTML=this._options.skipLabel;k.onclick=function(){b._introItems.length-1==b._currentStep&&"function"===typeof b._introCompleteCallback&&b._introCompleteCallback.call(b);b._introItems.length-1!=b._currentStep&&"function"===typeof b._introExitCallback&&b._introExitCallback.call(b);y.call(b,b._targetElement)};u.appendChild(k);1<this._introItems.length&&(u.appendChild(l),u.appendChild(p));m.appendChild(u);J.call(b,a.element,m,c,g)}!0===this._options.disableInteraction&&
O.call(b);l.removeAttribute("tabIndex");p.removeAttribute("tabIndex");0==this._currentStep&&1<this._introItems.length?(l.className="introjs-button introjs-prevbutton introjs-disabled",l.tabIndex="-1",p.className="introjs-button introjs-nextbutton",k.innerHTML=this._options.skipLabel):this._introItems.length-1==this._currentStep||1==this._introItems.length?(k.innerHTML=this._options.doneLabel,l.className="introjs-button introjs-prevbutton",p.className="introjs-button introjs-nextbutton introjs-disabled",
p.tabIndex="-1"):(l.className="introjs-button introjs-prevbutton",p.className="introjs-button introjs-nextbutton",k.innerHTML=this._options.skipLabel);p.focus();a.element.className+=" introjs-showElement";g=w(a.element,"position");"absolute"!==g&&"relative"!==g&&(a.element.className+=" introjs-relativePosition");for(g=a.element.parentNode;null!=g&&"body"!==g.tagName.toLowerCase();){c=w(g,"z-index");m=parseFloat(w(g,"opacity"));u=w(g,"transform")||w(g,"-webkit-transform")||w(g,"-moz-transform")||w(g,
"-ms-transform")||w(g,"-o-transform");if(/[0-9]+/.test(c)||1>m||"none"!==u&&void 0!==u)g.className+=" introjs-fixParent";g=g.parentNode}P(a.element)||!0!==this._options.scrollToElement||(m=a.element.getBoundingClientRect(),g=F().height,c=m.bottom-(m.bottom-m.top),m=m.bottom-g,0>c||a.element.clientHeight>g?window.scrollBy(0,c-30):window.scrollBy(0,m+100));"undefined"!==typeof this._introAfterChangeCallback&&this._introAfterChangeCallback.call(this,a.element)}function w(a,b){var c="";a.currentStyle?
c=a.currentStyle[b]:document.defaultView&&document.defaultView.getComputedStyle&&(c=document.defaultView.getComputedStyle(a,null).getPropertyValue(b));return c&&c.toLowerCase?c.toLowerCase():c}function F(){if(void 0!=window.innerWidth)return{width:window.innerWidth,height:window.innerHeight};var a=document.documentElement;return{width:a.clientWidth,height:a.clientHeight}}function P(a){a=a.getBoundingClientRect();return 0<=a.top&&0<=a.left&&a.bottom+80<=window.innerHeight&&a.right<=window.innerWidth}
function N(a){var b=document.createElement("div"),c="",e=this;b.className="introjs-overlay";if("body"===a.tagName.toLowerCase())c+="top: 0;bottom: 0; left: 0;right: 0;position: fixed;",b.setAttribute("style",c);else{var d=v(a);d&&(c+="width: "+d.width+"px; height:"+d.height+"px; top:"+d.top+"px;left: "+d.left+"px;",b.setAttribute("style",c))}a.appendChild(b);b.onclick=function(){!0==e._options.exitOnOverlayClick&&(void 0!=e._introExitCallback&&e._introExitCallback.call(e),y.call(e,a))};setTimeout(function(){c+=
"opacity: "+e._options.overlayOpacity.toString()+";";b.setAttribute("style",c)},10);return!0}function v(a){var b={};b.width=a.offsetWidth;b.height=a.offsetHeight;for(var c=0,e=0;a&&!isNaN(a.offsetLeft)&&!isNaN(a.offsetTop);)c+=a.offsetLeft,e+=a.offsetTop,a=a.offsetParent;b.top=e;b.left=c;return b}function L(){return 100*(parseInt(this._currentStep+1,10)/this._introItems.length)}var G=function(a){if("object"===typeof a)return new n(a);if("string"===typeof a){if(a=document.querySelector(a))return new n(a);
throw Error("There is no element with given selector.");}return new n(document.body)};G.version="1.1.1";G.fn=n.prototype={clone:function(){return new n(this)},setOption:function(a,b){this._options[a]=b;return this},setOptions:function(a){var b=this._options,c={},e;for(e in b)c[e]=b[e];for(e in a)c[e]=a[e];this._options=c;return this},start:function(){M.call(this,this._targetElement);return this},goToStep:function(a){this._currentStep=a-2;"undefined"!==typeof this._introItems&&x.call(this);return this},
nextStep:function(){x.call(this);return this},previousStep:function(){C.call(this);return this},exit:function(){y.call(this,this._targetElement);return this},refresh:function(){t.call(this,document.querySelector(".introjs-helperLayer"));t.call(this,document.querySelector(".introjs-tooltipReferenceLayer"));return this},onbeforechange:function(a){if("function"===typeof a)this._introBeforeChangeCallback=a;else throw Error("Provided callback for onbeforechange was not a function");return this},onchange:function(a){if("function"===
typeof a)this._introChangeCallback=a;else throw Error("Provided callback for onchange was not a function.");return this},onafterchange:function(a){if("function"===typeof a)this._introAfterChangeCallback=a;else throw Error("Provided callback for onafterchange was not a function");return this},oncomplete:function(a){if("function"===typeof a)this._introCompleteCallback=a;else throw Error("Provided callback for oncomplete was not a function.");return this},onexit:function(a){if("function"===typeof a)this._introExitCallback=
a;else throw Error("Provided callback for onexit was not a function.");return this}};return B.introJs=G});
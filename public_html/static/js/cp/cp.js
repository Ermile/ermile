// intro js v1.0.0
(function(w,p){"object"===typeof exports?p(exports):"function"===typeof define&&define.amd?define(["exports"],p):p(w)})(this,function(w){function p(a){this._targetElement=a;this._options={nextLabel:"Next &rarr;",prevLabel:"&larr; Back",skipLabel:"Skip",doneLabel:"Done",tooltipPosition:"bottom",tooltipClass:"",highlightClass:"",exitOnEsc:!0,exitOnOverlayClick:!0,showStepNumbers:!0,keyboardNavigation:!0,showButtons:!0,showBullets:!0,showProgress:!1,scrollToElement:!0,overlayOpacity:0.8,positionPrecedence:["bottom",
"top","right","left"],disableInteraction:!1}}function J(a){var b=[],c=this;if(this._options.steps)for(var d=[],e=0,d=this._options.steps.length;e<d;e++){var f=A(this._options.steps[e]);f.step=b.length+1;"string"===typeof f.element&&(f.element=document.querySelector(f.element));if("undefined"===typeof f.element||null==f.element){var h=document.querySelector(".introjsFloatingElement");null==h&&(h=document.createElement("div"),h.className="introjsFloatingElement",document.body.appendChild(h));f.element=
h;f.position="floating"}null!=f.element&&b.push(f)}else{d=a.querySelectorAll("*[data-intro]");if(1>d.length)return!1;e=0;for(f=d.length;e<f;e++){var h=d[e],k=parseInt(h.getAttribute("data-step"),10);0<k&&(b[k-1]={element:h,intro:h.getAttribute("data-intro"),step:parseInt(h.getAttribute("data-step"),10),tooltipClass:h.getAttribute("data-tooltipClass"),highlightClass:h.getAttribute("data-highlightClass"),position:h.getAttribute("data-position")||this._options.tooltipPosition})}e=k=0;for(f=d.length;e<
f;e++)if(h=d[e],null==h.getAttribute("data-step")){for(;"undefined"!=typeof b[k];)k++;b[k]={element:h,intro:h.getAttribute("data-intro"),step:k+1,tooltipClass:h.getAttribute("data-tooltipClass"),highlightClass:h.getAttribute("data-highlightClass"),position:h.getAttribute("data-position")||this._options.tooltipPosition}}}e=[];for(d=0;d<b.length;d++)b[d]&&e.push(b[d]);b=e;b.sort(function(a,b){return a.step-b.step});c._introItems=b;K.call(c,a)&&(x.call(c),a.querySelector(".introjs-skipbutton"),a.querySelector(".introjs-nextbutton"),
c._onKeyDown=function(b){if(27===b.keyCode&&!0==c._options.exitOnEsc)y.call(c,a),void 0!=c._introExitCallback&&c._introExitCallback.call(c);else if(37===b.keyCode)C.call(c);else if(39===b.keyCode)x.call(c);else if(13===b.keyCode){var d=b.target||b.srcElement;d&&0<d.className.indexOf("introjs-prevbutton")?C.call(c):d&&0<d.className.indexOf("introjs-skipbutton")?y.call(c,a):x.call(c);b.preventDefault?b.preventDefault():b.returnValue=!1}},c._onResize=function(a){t.call(c,document.querySelector(".introjs-helperLayer"));
t.call(c,document.querySelector(".introjs-tooltipReferenceLayer"))},window.addEventListener?(this._options.keyboardNavigation&&window.addEventListener("keydown",c._onKeyDown,!0),window.addEventListener("resize",c._onResize,!0)):document.attachEvent&&(this._options.keyboardNavigation&&document.attachEvent("onkeydown",c._onKeyDown),document.attachEvent("onresize",c._onResize)));return!1}function A(a){if(null==a||"object"!=typeof a||"undefined"!=typeof a.nodeType)return a;var b={},c;for(c in a)b[c]=
A(a[c]);return b}function x(){this._direction="forward";"undefined"===typeof this._currentStep?this._currentStep=0:++this._currentStep;if(this._introItems.length<=this._currentStep)"function"===typeof this._introCompleteCallback&&this._introCompleteCallback.call(this),y.call(this,this._targetElement);else{var a=this._introItems[this._currentStep];"undefined"!==typeof this._introBeforeChangeCallback&&this._introBeforeChangeCallback.call(this,a.element);G.call(this,a)}}function C(){this._direction=
"backward";if(0===this._currentStep)return!1;var a=this._introItems[--this._currentStep];"undefined"!==typeof this._introBeforeChangeCallback&&this._introBeforeChangeCallback.call(this,a.element);G.call(this,a)}function y(a){var b=a.querySelector(".introjs-overlay");if(null!=b){b.style.opacity=0;setTimeout(function(){b.parentNode&&b.parentNode.removeChild(b)},500);var c=a.querySelector(".introjs-helperLayer");c&&c.parentNode.removeChild(c);(c=a.querySelector(".introjs-tooltipReferenceLayer"))&&c.parentNode.removeChild(c);
(a=a.querySelector(".introjs-disableInteraction"))&&a.parentNode.removeChild(a);(a=document.querySelector(".introjsFloatingElement"))&&a.parentNode.removeChild(a);if(a=document.querySelector(".introjs-showElement"))a.className=a.className.replace(/introjs-[a-zA-Z]+/g,"").replace(/^\s+|\s+$/g,"");if((a=document.querySelectorAll(".introjs-fixParent"))&&0<a.length)for(c=a.length-1;0<=c;c--)a[c].className=a[c].className.replace(/introjs-fixParent/g,"").replace(/^\s+|\s+$/g,"");window.removeEventListener?
window.removeEventListener("keydown",this._onKeyDown,!0):document.detachEvent&&document.detachEvent("onkeydown",this._onKeyDown);this._currentStep=void 0}}function H(a,b,c,d){var e="";b.style.top=null;b.style.right=null;b.style.bottom=null;b.style.left=null;b.style.marginLeft=null;b.style.marginTop=null;c.style.display="inherit";"undefined"!=typeof d&&null!=d&&(d.style.top=null,d.style.left=null);if(this._introItems[this._currentStep]){e=this._introItems[this._currentStep];e="string"===typeof e.tooltipClass?
e.tooltipClass:this._options.tooltipClass;b.className=("introjs-tooltip "+e).replace(/^\s+|\s+$/g,"");currentTooltipPosition=this._introItems[this._currentStep].position;if(("auto"==currentTooltipPosition||"auto"==this._options.tooltipPosition)&&"floating"!=currentTooltipPosition){var e=currentTooltipPosition,f=this._options.positionPrecedence.slice(),h=F(),p=k(b).height+10,s=k(b).width+20,l=k(a),m="floating";l.left+s>h.width||0>l.left+l.width/2-s?(q(f,"bottom"),q(f,"top")):(l.height+l.top+p>h.height&&
q(f,"bottom"),0>l.top-p&&q(f,"top"));l.width+l.left+s>h.width&&q(f,"right");0>l.left-s&&q(f,"left");0<f.length&&(m=f[0]);e&&"auto"!=e&&-1<f.indexOf(e)&&(m=e);currentTooltipPosition=m}e=k(a);f=k(b).height;h=F();switch(currentTooltipPosition){case "top":b.style.left="15px";b.style.top="-"+(f+10)+"px";c.className="introjs-arrow bottom";break;case "right":b.style.left=k(a).width+20+"px";e.top+f>h.height&&(c.className="introjs-arrow left-bottom",b.style.top="-"+(f-e.height-20)+"px");c.className="introjs-arrow left";
break;case "left":!0==this._options.showStepNumbers&&(b.style.top="15px");e.top+f>h.height?(b.style.top="-"+(f-e.height-20)+"px",c.className="introjs-arrow right-bottom"):c.className="introjs-arrow right";b.style.right=e.width+20+"px";break;case "floating":c.style.display="none";a=k(b);b.style.left="50%";b.style.top="50%";b.style.marginLeft="-"+a.width/2+"px";b.style.marginTop="-"+a.height/2+"px";"undefined"!=typeof d&&null!=d&&(d.style.left="-"+(a.width/2+18)+"px",d.style.top="-"+(a.height/2+18)+
"px");break;case "bottom-right-aligned":c.className="introjs-arrow top-right";b.style.right="0px";b.style.bottom="-"+(k(b).height+10)+"px";break;case "bottom-middle-aligned":d=k(a);a=k(b);c.className="introjs-arrow top-middle";b.style.left=d.width/2-a.width/2+"px";b.style.bottom="-"+(a.height+10)+"px";break;default:b.style.bottom="-"+(k(b).height+10)+"px",b.style.left=k(a).width/2-k(b).width/2+"px",c.className="introjs-arrow top"}}}function q(a,b){-1<a.indexOf(b)&&a.splice(a.indexOf(b),1)}function t(a){if(a&&
this._introItems[this._currentStep]){var b=this._introItems[this._currentStep],c=k(b.element),d=10;"floating"==b.position&&(d=0);a.setAttribute("style","width: "+(c.width+d)+"px; height:"+(c.height+d)+"px; top:"+(c.top-5)+"px;left: "+(c.left-5)+"px;")}}function L(){var a=document.querySelector(".introjs-disableInteraction");null===a&&(a=document.createElement("div"),a.className="introjs-disableInteraction",this._targetElement.appendChild(a));t.call(this,a)}function G(a){"undefined"!==typeof this._introChangeCallback&&
this._introChangeCallback.call(this,a.element);var b=this,c=document.querySelector(".introjs-helperLayer"),d=document.querySelector(".introjs-tooltipReferenceLayer"),e="introjs-helperLayer";k(a.element);"string"===typeof a.highlightClass&&(e+=" "+a.highlightClass);"string"===typeof this._options.highlightClass&&(e+=" "+this._options.highlightClass);if(null!=c){var f=d.querySelector(".introjs-helperNumberLayer"),h=d.querySelector(".introjs-tooltiptext"),p=d.querySelector(".introjs-arrow"),s=d.querySelector(".introjs-tooltip"),
l=d.querySelector(".introjs-skipbutton"),m=d.querySelector(".introjs-prevbutton"),r=d.querySelector(".introjs-nextbutton");c.className=e;s.style.opacity=0;s.style.display="none";if(null!=f){var g=this._introItems[0<=a.step-2?a.step-2:0];if(null!=g&&"forward"==this._direction&&"floating"==g.position||"backward"==this._direction&&"floating"==a.position)f.style.opacity=0}t.call(b,c);t.call(b,d);if((g=document.querySelectorAll(".introjs-fixParent"))&&0<g.length)for(e=g.length-1;0<=e;e--)g[e].className=
g[e].className.replace(/introjs-fixParent/g,"").replace(/^\s+|\s+$/g,"");g=document.querySelector(".introjs-showElement");g.className=g.className.replace(/introjs-[a-zA-Z]+/g,"").replace(/^\s+|\s+$/g,"");b._lastShowElementTimer&&clearTimeout(b._lastShowElementTimer);b._lastShowElementTimer=setTimeout(function(){null!=f&&(f.innerHTML=a.step);h.innerHTML=a.intro;s.style.display="block";H.call(b,a.element,s,p,f);d.querySelector(".introjs-bullets li > a.active").className="";d.querySelector('.introjs-bullets li > a[data-stepnumber="'+
a.step+'"]').className="active";d.querySelector(".introjs-progress .introjs-progressbar").setAttribute("style","width:"+I.call(b)+"%;");s.style.opacity=1;f&&(f.style.opacity=1);-1===r.tabIndex?l.focus():r.focus()},350)}else{var q=document.createElement("div"),m=document.createElement("div"),c=document.createElement("div"),n=document.createElement("div"),w=document.createElement("div"),D=document.createElement("div"),E=document.createElement("div"),u=document.createElement("div");q.className=e;m.className=
"introjs-tooltipReferenceLayer";t.call(b,q);t.call(b,m);this._targetElement.appendChild(q);this._targetElement.appendChild(m);c.className="introjs-arrow";w.className="introjs-tooltiptext";w.innerHTML=a.intro;D.className="introjs-bullets";!1===this._options.showBullets&&(D.style.display="none");for(var q=document.createElement("ul"),e=0,B=this._introItems.length;e<B;e++){var A=document.createElement("li"),z=document.createElement("a");z.onclick=function(){b.goToStep(this.getAttribute("data-stepnumber"))};
e===a.step-1&&(z.className="active");z.href="javascript:void(0);";z.innerHTML="&nbsp;";z.setAttribute("data-stepnumber",this._introItems[e].step);A.appendChild(z);q.appendChild(A)}D.appendChild(q);E.className="introjs-progress";!1===this._options.showProgress&&(E.style.display="none");e=document.createElement("div");e.className="introjs-progressbar";e.setAttribute("style","width:"+I.call(this)+"%;");E.appendChild(e);u.className="introjs-tooltipbuttons";!1===this._options.showButtons&&(u.style.display=
"none");n.className="introjs-tooltip";n.appendChild(w);n.appendChild(D);n.appendChild(E);!0==this._options.showStepNumbers&&(g=document.createElement("span"),g.className="introjs-helperNumberLayer",g.innerHTML=a.step,m.appendChild(g));n.appendChild(c);m.appendChild(n);r=document.createElement("a");r.onclick=function(){b._introItems.length-1!=b._currentStep&&x.call(b)};r.href="javascript:void(0);";r.innerHTML=this._options.nextLabel;m=document.createElement("a");m.onclick=function(){0!=b._currentStep&&
C.call(b)};m.href="javascript:void(0);";m.innerHTML=this._options.prevLabel;l=document.createElement("a");l.className="introjs-button introjs-skipbutton";l.href="javascript:void(0);";l.innerHTML=this._options.skipLabel;l.onclick=function(){b._introItems.length-1==b._currentStep&&"function"===typeof b._introCompleteCallback&&b._introCompleteCallback.call(b);b._introItems.length-1!=b._currentStep&&"function"===typeof b._introExitCallback&&b._introExitCallback.call(b);y.call(b,b._targetElement)};u.appendChild(l);
1<this._introItems.length&&(u.appendChild(m),u.appendChild(r));n.appendChild(u);H.call(b,a.element,n,c,g)}!0===this._options.disableInteraction&&L.call(b);m.removeAttribute("tabIndex");r.removeAttribute("tabIndex");0==this._currentStep&&1<this._introItems.length?(m.className="introjs-button introjs-prevbutton introjs-disabled",m.tabIndex="-1",r.className="introjs-button introjs-nextbutton",l.innerHTML=this._options.skipLabel):this._introItems.length-1==this._currentStep||1==this._introItems.length?
(l.innerHTML=this._options.doneLabel,m.className="introjs-button introjs-prevbutton",r.className="introjs-button introjs-nextbutton introjs-disabled",r.tabIndex="-1"):(m.className="introjs-button introjs-prevbutton",r.className="introjs-button introjs-nextbutton",l.innerHTML=this._options.skipLabel);r.focus();a.element.className+=" introjs-showElement";g=v(a.element,"position");"absolute"!==g&&"relative"!==g&&(a.element.className+=" introjs-relativePosition");for(g=a.element.parentNode;null!=g&&"body"!==
g.tagName.toLowerCase();){c=v(g,"z-index");n=parseFloat(v(g,"opacity"));u=v(g,"transform")||v(g,"-webkit-transform")||v(g,"-moz-transform")||v(g,"-ms-transform")||v(g,"-o-transform");if(/[0-9]+/.test(c)||1>n||"none"!==u)g.className+=" introjs-fixParent";g=g.parentNode}M(a.element)||!0!==this._options.scrollToElement||(n=a.element.getBoundingClientRect(),g=F().height,c=n.bottom-(n.bottom-n.top),n=n.bottom-g,0>c||a.element.clientHeight>g?window.scrollBy(0,c-30):window.scrollBy(0,n+100));"undefined"!==
typeof this._introAfterChangeCallback&&this._introAfterChangeCallback.call(this,a.element)}function v(a,b){var c="";a.currentStyle?c=a.currentStyle[b]:document.defaultView&&document.defaultView.getComputedStyle&&(c=document.defaultView.getComputedStyle(a,null).getPropertyValue(b));return c&&c.toLowerCase?c.toLowerCase():c}function F(){if(void 0!=window.innerWidth)return{width:window.innerWidth,height:window.innerHeight};var a=document.documentElement;return{width:a.clientWidth,height:a.clientHeight}}
function M(a){a=a.getBoundingClientRect();return 0<=a.top&&0<=a.left&&a.bottom+80<=window.innerHeight&&a.right<=window.innerWidth}function K(a){var b=document.createElement("div"),c="",d=this;b.className="introjs-overlay";if("body"===a.tagName.toLowerCase())c+="top: 0;bottom: 0; left: 0;right: 0;position: fixed;",b.setAttribute("style",c);else{var e=k(a);e&&(c+="width: "+e.width+"px; height:"+e.height+"px; top:"+e.top+"px;left: "+e.left+"px;",b.setAttribute("style",c))}a.appendChild(b);b.onclick=
function(){!0==d._options.exitOnOverlayClick&&(y.call(d,a),void 0!=d._introExitCallback&&d._introExitCallback.call(d))};setTimeout(function(){c+="opacity: "+d._options.overlayOpacity.toString()+";";b.setAttribute("style",c)},10);return!0}function k(a){var b={};b.width=a.offsetWidth;b.height=a.offsetHeight;for(var c=0,d=0;a&&!isNaN(a.offsetLeft)&&!isNaN(a.offsetTop);)c+=a.offsetLeft,d+=a.offsetTop,a=a.offsetParent;b.top=d;b.left=c;return b}function I(){return 100*(parseInt(this._currentStep+1,10)/
this._introItems.length)}var B=function(a){if("object"===typeof a)return new p(a);if("string"===typeof a){if(a=document.querySelector(a))return new p(a);throw Error("There is no element with given selector.");}return new p(document.body)};B.version="1.0.0";B.fn=p.prototype={clone:function(){return new p(this)},setOption:function(a,b){this._options[a]=b;return this},setOptions:function(a){var b=this._options,c={},d;for(d in b)c[d]=b[d];for(d in a)c[d]=a[d];this._options=c;return this},start:function(){J.call(this,
this._targetElement);return this},goToStep:function(a){this._currentStep=a-2;"undefined"!==typeof this._introItems&&x.call(this);return this},nextStep:function(){x.call(this);return this},previousStep:function(){C.call(this);return this},exit:function(){y.call(this,this._targetElement);return this},refresh:function(){t.call(this,document.querySelector(".introjs-helperLayer"));t.call(this,document.querySelector(".introjs-tooltipReferenceLayer"));return this},onbeforechange:function(a){if("function"===
typeof a)this._introBeforeChangeCallback=a;else throw Error("Provided callback for onbeforechange was not a function");return this},onchange:function(a){if("function"===typeof a)this._introChangeCallback=a;else throw Error("Provided callback for onchange was not a function.");return this},onafterchange:function(a){if("function"===typeof a)this._introAfterChangeCallback=a;else throw Error("Provided callback for onafterchange was not a function");return this},oncomplete:function(a){if("function"===
typeof a)this._introCompleteCallback=a;else throw Error("Provided callback for oncomplete was not a function.");return this},onexit:function(a){if("function"===typeof a)this._introExitCallback=a;else throw Error("Provided callback for onexit was not a function.");return this}};return w.introJs=B});


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


route('*', function() 
{
  hideFields();
  $(window).off('statechange');
  $(window).on('statechange', function() {
    // history.state.url.indexOf('posts');
    if(history.state && !history.state.replace) {
      // console.log('statechange');
      bindSlug();
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
function cat_selected(){
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
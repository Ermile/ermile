
///////////////////////////////////////////////// selsectable Cards \ check class, add or remove

function add_class(_this , _class)
{
  get_class(_this);
  if (has_class(_this, _class) == -1)
    {
      classnames_arr.push(_class);
    }

  _this.setAttribute('class', classnames_arr.join(' '));
}

function remove_class(_this , _class){

  var classnames = _this.getAttribute('class');

  var classnames_arr = classnames.split(" ");
  var has = has_class(_this, _class);
  if(has >= 0)
  {
    classnames_arr.splice(has, 1);
  }
    var x = classnames_arr.join(' ');
    _this.setAttribute('class', classnames_arr.join(' '));
}


function has_class(_this , _class){
  var has_spin = -1;
  classnames_arr = get_class(_this);
  for (var j = 0; j < classnames_arr.length; j++) {
    if (classnames_arr[j] ==  _class)
      {
        has_spin = j;
        break;
      }
  }
  return has_spin;
}

function get_class(_this){
  console.log(_this);
  var classnames = _this.getAttribute('class');
  return classnames.split(" ");
}

///////////////////////////////////////////////// navigation_tabs



var nav  = document.getElementsByClassName("titles");
var tabs    = nav[0].getElementsByTagName("li");
for(var i = 0; i < tabs.length; i++)
{
  tabs[i].addEventListener("click", function(){ showTab(this); return false; });
}


function showTab(_this){
  var selectedTab = _this.getAttribute('data-tab');
  var selectedTabClasses = _this.getAttribute('class');
  var tabs        = document.getElementById("tab_data").getElementsByTagName("li");
  for(var i = 0; i < tabs.length; i++)
  {
    var tabName = tabs[i].getAttribute('data-tab');
    if(tabName === selectedTab)
    {
        tabs[i].className = 'selected';
        activeClassLinks(_this);
    }
    else
    {
        tabs[i].className = '';
    }
  }
  return false;
}


function activeClassLinks(_this){
  var titles = document.getElementsByClassName("titles");
  var links  = titles[0].getElementsByTagName("li");

  for(element = 0; element < links.length; ++element)
  {
        if(links[element] == _this)
        {
          if (has_class(_this , 'active') == -1)
            {
              add_class(links[element], 'active');
            }

        }
        else
          {
            remove_class(links[element], 'active');
          }
  }
  return false;
}

////////////////////////////////////// - Noel Delgado | hover cards effect

var nodes  = document.querySelectorAll(".benefits li");
    _nodes = [].slice.call(nodes, 0);

var getDirection = function (ev, obj) {
    var w = obj.offsetWidth,
        h = obj.offsetHeight,
        x = (ev.pageX - obj.offsetLeft - (w / 2) * (w > h ? (h / w) : 1)),
        y = (ev.pageY - obj.offsetTop - (h / 2) * (h > w ? (w / h) : 1)),
        d = Math.round( Math.atan2(y, x) / 1.57079633 + 5 ) % 4;
    return d;
}

var addClass = function ( ev, obj, state ) {
    var direction = getDirection( ev, obj ),
        class_suffix = "";
    obj.className = "";
console.log(direction);
    switch ( direction ) {
        case 0 : class_suffix = '-top';    break;
        case 1 : class_suffix = '-right';  break;
        case 2 : class_suffix = '-bottom'; break;
        case 3 : class_suffix = '-left';   break;
    }

    obj.classList.add( state + class_suffix );
}

// bind events
_nodes.forEach(function (el) {
    el.addEventListener('mouseover', function (ev) {
        addClass( ev, this, 'in' );
    }, false);

    el.addEventListener('mouseout', function (ev) {
        addClass( ev, this, 'out' );
    }, false);
})

////////////////////////////////////// - input type file | Upload


var inputs = document.querySelectorAll( '#file' );
Array.prototype.forEach.call( inputs, function( input )
{
  var label  = input.nextElementSibling,
    labelVal = label.innerHTML;

  input.addEventListener( 'change', function( e )
  {
    var fileName = '';

    fileName = e.target.value.split( '\\' ).pop();

    if( fileName )
    {
      label.querySelector( 'strong' ).innerHTML = fileName;
      var my_label = document.querySelectorAll("#resume-send label")[0];
      console.log(my_label);
     add_class(my_label, 'successful');

    }
    else
      label.innerHTML = labelVal;
  });
});

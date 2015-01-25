(function(root) {
  function extend(protoProps, staticProps) {
    var parent = this;
    var child;

    if (protoProps && _.has(protoProps, 'constructor')) {
      child = protoProps.constructor;
    } else {
      child = function(){ return parent.apply(this, arguments); };
    }

    _.extend(child, parent, staticProps);

    var Surrogate = function(){ this.constructor = child; };
    Surrogate.prototype = parent.prototype;
    child.prototype = new Surrogate();

    if (protoProps) _.extend(child.prototype, protoProps);

    child.__super__ = parent.prototype;

    return child;
  }
  
  $.fn.getData = function() {
    var d = {};
    $(this).find('input').each(function() {
      d[this.name] = this.value;
    });

    return d;
  };

  $.fn.putData = function(d) {
    $(this).find('input').each(function() {
      var k = d[this.name];
      if(k) this.value = k;
    });
  };

  root.extend = extend;
})(this);

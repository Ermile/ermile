(function(root) {
  "use strict";

  var d = {
    initialize: _.noop,
    base: 'http://localhost:8000/json',
    url: '',
    dirty: false
  };

  var Model = function(properties) {
    return this.construct(properties);
  };

  Model.lastId = 0;

  Model.extend = extend;

  Model.prototype = {
    construct: function(props) {
      _.defaults(this, d);

      this.properties = _.extend(this.defaults || {}, _.omit(props, 'url', 'initialize', 'constructor'));

      if(!_.has(this.properties, 'id')) {
        this.set('id', this.constructor.lastId++);
      } else {
        this.constructor.lastId = this.get('id') + 1;
      }

      this.fullURL = this.base.replace(/\/$/, '') + '/' + 
                     this.url.replace(/^\/|\/$/g, '');

      this.initialize.call(this, props);
    },
    get: function(a) {
      return this.properties[a];
    },
    set: function(a, b) {
      this.dirty = true;
      this.properties[a] = b;
    },
    has: function(a) {
      return _.has(this.properties, a);
    },
    fetch: function(a, b) {
      var _super = this;

      var destination = this.fullURL + '/' + (this.has('id') ? this.get('id') : '');
      var lsData = LS.get(destination);
      this.properties = lsData;

      return {
        localStorage: lsData,
        promise: $.ajax({
          url: destination,
          type: 'get'
        }).then(function(data) {
          _super.properties = data;
        }, function(xhr, status, err) {
          console.error('Error fetching model ', err);
        })
      };
    },
    save: function(a, b) {
      var _super = this;

      var destination = this.fullURL + '/' + (this.has('id') ? this.get('id') : '');

      LS.set(destination, this.properties);

      return $.ajax({
        url: destination,
        type: 'post',
        data: this.properties
      }).done(function() {
        _super.dirty = false;
      });
    },
    super: function() {
      return this.constructor.__super__ || this.constructor;
    },
    toJSON: function() {
      return this.properties;
    }
  };

  root.Model = Model;

})(this);
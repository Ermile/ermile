(function(root) {
  "use strict";

  var d = {
    initialize: _.noop,
    base: 'http://localhost:8000/view',
    url: '',
    container: '',
    model: null,
    collection: null,
    dirty: false
  };

  var View = function(properties) {
    return this.construct(properties);
  };

  View.lastId = 0;

  View.extend = extend;

  View.prototype = {
    construct: function(props) {
      _.defaults(this, d);

      this.html = '';
      _.extend(this, _.omit(props, 'initialize', 'constructor'));

      if(!_.has(this, 'id')) {
        this.id =  this.constructor.lastId++;
      } else {
        this.constructor.lastId = this.id + 1;
      }

      this.$el = $(this.container);
      this.$ = function(s) {
        return this.$el.find(s);
      };

      this.fullURL = this.base.replace(/\/$/, '') + '/' + 
                     this.url.replace(/^\/|\/$/g, '');

      this.initialize.call(this, props);
    },
    fetch: function(a, b) {
      var _super = this;

      var destination = this.fullURL + '/' + (_.has(this, 'id') ? this.id : '');
      var lsData = LS.get(destination);
      this.html = lsData;

      return {
        localStorage: lsData,
        promise: $.ajax({
          url: destination,
          type: 'get'
        }).then(function(data) {
          _super.html = data;
        }, function(xhr, status, err) {
          console.error('Error fetching model ', err);
        })
      };
    },
    render: function() {
      this.$el.html(this.html);
    },
    save: function(a, b) {
      var _super = this;

      var destination = this.fullURL + '/' + (_.has(this, 'id') ? this.id : '');

      LS.set(destination, this.html);
    },
    super: function() {
      return this.constructor.__super__ || this.constructor;
    }
  };

  root.View = View;
})(this);
(function(root) {
  "use strict";

    var d = {
    initialize: _.noop
  };

  root.test = [];

  var Collection = function(models) {
    if(!_.isArray(models)) models = [models];

    return this.construct(models);
  };

  Collection.extend = extend;

  Collection.prototype = {
    construct: function(models) {
      _.defaults(this, d);

      this.models = models;

      this.initialize.call(this, models);
    },
    at: function(i) {
      return this.models[i];
    },
    get: function(obj) {
      if(_.isNumber(obj)) obj = {id: obj};
      var match = _.matches(obj);
      return _.find(this.models, function(model) {
        return match(model.properties);
      });
    },
    has: function(a) {
      if(a instanceof Model) {
        return _.contains(this.models, a);
      } else {
        var eq = function(b) { return _.isEqual(a, b) };
        var result = false;
        for(var i = 0, len = this.models.length; i < len; i++) {
          if(eq(this.models[i].properties)) {
            result = true;
            break;
          }
        }
        return result;
      }
    },
    fetch: function(a, b) {
      var _super = this;
      return $.when.apply($, _.map(this.models, function(m) {
        var f = m.fetch();
        this.models = f.localStorage || [];
        return f.promise;
      }));
    },
    save: function(a, b) {
      var _super = this;
      return $.when.apply($, _.map(this.models, function(m) {
        return m.save();
      }));
    },
    toJSON: function() {
      return this.properties;
    },
    super: function() {
      return this.__super__ || this.constructor.__super__;
    }
  };

  root.Collection = Collection;

})(this);
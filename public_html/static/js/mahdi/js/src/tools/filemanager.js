(function(root) {
  "use strict";

  var defaults = {
    ajax: {
      type: 'post',
      contentType: false,
      processData: false,
      dataType: 'text',
      mimeType: 'text/plain',
      url: 'http://localhost:8000'
    },
    type: 'BinaryString',
    originalFile: null,
    file: null,
    result: null,
    range: [0, 0],
    parts: 200,
    rest: 20,
    restDuration: 500,

    // Events

    beforeStart: _.noop,
    afterCheck: _.noop,
    progress: _.noop,
    done: _.noop
  };

  var FileManager = function(options) {
    _.extend(this, defaults, options);

    this.originalFile = this.file;
    this.size = this.originalFile.size;
    this.fileType = this.originalFile.type;
    this.range = [0, this.size];
  };

  FileManager.prototype = {
    _load: function() {
      var deferred = new jQuery.Deferred();

      this.fileReader = new FileReader();
      var self = this;
      this.fileReader.onload = function(e) {
        self.result = e.target.result;
        deferred.resolve(self);
      };
      this.fileReader.onerror = this.fileReader.onabort = function(e) {
        deferred.reject(e);
      };
      this.fileReader['readAs' + this.type](this.file);

      return deferred.promise();
    },
    load: function() {
      return this._load.apply(this, arguments);
    },
    _slice: function(start, end) {
      this.file = this.originalFile.slice(start, end);
      this.range = [start, end];
      return this;
    },
    slice: function() {
      return this._slice.apply(this, arguments);
    },
    _full: function() {
      this.file = this.originalFile;
      this.range = [0, this.size];
      return this;
    },
    full: function() {
      return this._full.apply(this, arguments);
    },
    _check: function(from, to, options) {
      var lastbits = this.originalFile.slice(from, to);

      var fd = new FormData();
      fd.append('file', lastbits, this.originalFile.name);
      fd.append('range', from +'-'+to);

      var opts = _.extend(this.ajax, options || {}, {
        data: fd,
      });

      return $.ajax(this.ajax.url + '/check', opts);
    },
    check: function() {
      return this._check.apply(this, arguments);
    },
    _send: function(options) {
      var fd = new FormData();
      fd.append('file', this.file, this.originalFile.name);

      var opts = _.extend(this.ajax, options || {}, {
        data: fd,
      });

      return $.ajax(this.ajax.url + '/file', opts);
    },
    send: function() {
      return this._send.apply(this, arguments);
    },
    _upload: function(from, to, options) {
      this.beforeStart(this);

      var deferred = new jQuery.Deferred();

      var opts = _.extend({}, this, options);

      from = _.isNumber(from) ? from : 0;
      to = _.isNumber(to) ? to : this.size;
      var parts = (parts || opts.parts)*1000;

      var i = from,
          max = false,
          _super = this,
          rest = 0,
          percentage = i * 100 / to;

      function loop() {
        if(_super._abort) {
          _super._abort = false;
          deferred.reject(_super);
          return;
        }
        if(max) {
          deferred.resolve(_super);
          _super.done(_super);
          return;
        }
        if(i + parts > to) {
          max = true;
        }
        _super.slice(i, max ? to : i+parts).load().then(function() {

          function done() {
            i = max ? to : i + parts;
            percentage = i * 100 / to;
            _super.progress({
              min: from,
              max: to,
              sent: i,
              percentage: percentage,
              _super: _super});

            rest++;
            if(rest >= _super.rest) {
              setTimeout(loop, _super.restDuration);
              rest = 0;
            } else {
              loop();
            }
          }
          function err(xhr, status, error) {
            deferred.reject.apply(deferred, arguments);
            _super._abort = true;
          }

          _super.send(opts.ajax).then(done, err);
        }, function(err) {
          deferred.reject(err);
          _super._abort = true;
        });
      }

      if(i > 0) {
        var f = from - 100 < 0 ? 0 : from - 100;
        this.check(f, from).then(function() {
          _super.afterCheck(_super);
          loop();
        }, function(e) {
          deferred.reject(e);
        });
      } else {
        loop();
      }

      return deferred.promise();
    },
    upload: function() {
      return this._upload.apply(this, arguments);
    },
    _pause: function() {
      this._abort = true;
      return this;
    },
    pause: function() {
      return this._pause.apply(this, arguments);
    },
    _resume: function(options) {
      var _super = this;

      var opts = _.extend({
        type: 'post',
        data: {fileName: this.originalFile.name},
        dataType: 'text',
        mimeType: 'text/plain'},
        options || {});

      return $.ajax(this.ajax.url + '/resume', opts)
              .then(function(response) {
                _super.upload(+response);
              });
    },
    resume: function() {
      return this._resume.apply(this, arguments); 
    }
  };

  root.FileManager = FileManager;
})(this);
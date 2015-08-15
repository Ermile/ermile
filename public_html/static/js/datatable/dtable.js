(function() {
  $.fn.dataTableExt.sErrMode = "throw";

  if (!window.saloos) {
    window.saloos = new Object();
  }

  window.saloos.datatable = (function() {
    var data_compile, first_make_data, run;

    first_make_data = true;

    data_compile = Object();

    function datatable(el) {
      var e, first_data;
      if (el instanceof Element) {
        try {
          first_data = JSON.parse($("tbody td:first", el).text());
        } catch (_error) {
          e = _error;
          console.log(e);
          alert("Json paresError");
        }
        if (first_data) {
          run.call(el, first_data);
        }
      } else {
        el.each(function() {
          return new window.saloos.datatable(this);
        });
      }
    }

    run = function(columns) {
      var i, j, ref;
      for (i = j = 0, ref = columns.headers.length; 0 <= ref ? j < ref : j > ref; i = 0 <= ref ? ++j : --j) {
        if (!columns.headers[i]['name'] && columns.headers[i]['data']) {
          columns.headers[i]['name'] = columns.headers[i]['data'];
        }
      }
      return $(this).DataTable({
        processing: true,
        serverSide: true,
        columns: columns.headers,
        ajax: {
          cache: true,
          url: $(this).attr('data-tablesrc'),
          beforeSend: function() {
            if (!first_make_data) {
              return 0;
            }
            first_make_data = false;
            this.error = 0;
            this.success(columns);
            return false;
          },
          data: function(data) {
            var d, ret, val;
            ret = Array();
            for (d in data) {
              if (data_compile[d]) {
                val = data_compile[d](data[d], data);
                if (val) {
                  ret.push(val);
                }
              }
            }
            return ret.join('&');
          },
          rowCallback: function(row, data, index) {
            return console.log(row, data, index);
          }
        },
        createdRow: function(row, data, dataIndex) {
          return console.log(row, data, dataIndex);
        }
      });
    };

    data_compile.order = function(order, data) {
      var col_name;
      col_name = data_compile.getColName(data, order[0]['column']);
      return "sort=" + col_name + "," + order[0]['dir'];
    };

    data_compile.search = function(search, data) {
      if (search.value) {
        return "search=" + search.value;
      }
    };

    data_compile.length = function(length) {
      return "length=" + length;
    };

    data_compile.start = function(start) {
      return "start=" + start;
    };

    data_compile.draw = function(draw) {
      return "draw=" + draw;
    };

    data_compile.getColName = function(data, col) {
      console.log(data);
      if (data['columns'][col]['name']) {
        return data['columns'][col]['name'];
      } else {
        return col;
      }
    };

    return datatable;

  })();

  $(document).ready(function() {
    return window.saloos.datatable($("[data-tablesrc]"));
  });

}).call(this);

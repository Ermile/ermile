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
      var a, e, first_data;
      if (el instanceof Element) {
        try {
          first_data = JSON.parse($("tbody td:first", el).text());
        } catch (_error) {
          e = _error;
          $(el).html("<tr><td>Json pares Error</td></tr>");
        }
        if (first_data) {
          a = 10;
          run.call(el, first_data);
        }
      } else {
        el.each(function() {
          return new window.saloos.datatable(this);
        });
      }
    }

    run = function(columns) {
      var cl, o_columns;
      o_columns = Array();
      for (cl in columns.columns) {
        if (columns.columns[cl]['table']) {
          columns.columns[cl]['title'] = columns.columns[cl]['label'];
          columns.columns[cl]['name'] = cl;
          columns.columns[cl]['data'] = cl;
          o_columns.push(columns.columns[cl]);
        }
      }
      return $(this).DataTable({
        processing: true,
        serverSide: true,
        columns: o_columns,
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
          rowCallback: function(row, data, index) {}
        },
        createdRow: function(row, data, dataIndex) {}
      });
    };

    data_compile.order = function(order, data) {
      var col_name;
      col_name = data_compile.getColName(data, order[0]['column']);
      return "sortby=" + col_name + "&order=" + order[0]['dir'];
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

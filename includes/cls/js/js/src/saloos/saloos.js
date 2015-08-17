(function() {
  if (!window.saloos) {
    window.saloos = new Object();
  }

}).call(this);

(function() {
  $.fn.dataTableExt.sErrMode = "throw";

  window.saloos.datatable = (function() {
    var col_creat, data_compile, first_make_data, run;

    first_make_data = true;

    data_compile = Object();

    col_creat = Object();

    function datatable(el) {
      var e, first_data;
      if (el instanceof Element) {
        try {
          first_data = JSON.parse($("tbody td:first", el).text());
        } catch (_error) {
          e = _error;
          $("tbody td:first", el).html("<tr><td>Json paresError</td></tr>");
          console.log(e);
        }
        if (first_data) {
          $(el).empty();
          $(el).removeClass('hidden');
          run.call(el, first_data);
        }
      } else {
        el.each(function() {
          return new window.saloos.datatable(this);
        });
      }
    }

    run = function(columns) {
      var cl, lang, o_columns, obj;
      o_columns = Array();
      if (columns.columns.id) {
        columns.columns.id.table = true;
      }
      for (cl in columns.columns) {
        if (columns.columns[cl]['table']) {
          columns.columns[cl]['title'] = columns.columns[cl]['label'];
          columns.columns[cl]['name'] = cl;
          columns.columns[cl]['data'] = cl;
          columns.columns[cl]['className'] = "col_" + columns.columns[cl]['value'];
          obj = {
            title: columns.columns[cl]['label'],
            name: cl,
            data: cl,
            className: "col_" + columns.columns[cl]['value'],
            _resp: columns.columns[cl],
            createdCell: col_creat[columns.columns[cl]['value']] ? col_creat[columns.columns[cl]['value']] : null
          };
          if (cl === 'id') {
            obj.className = "col_row";
          }
          o_columns.push(obj);
        }
      }
      o_columns.push({
        orderable: false,
        title: "",
        name: "id",
        data: "id",
        className: "col_actions",
        createdCell: col_creat['action'] ? col_creat['action'] : null
      });
      lang = document.documentElement.lang.slice(0, 2) + ".json";
      return $(this).DataTable({
        language: {
          "url": location.protocol + "//" + location.hostname.match(/([^\.]*)\.([^\.]*)$/)[0] + "/static/js/datatable/datatable-langs/" + lang
        },
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
          }
        },
        rowCallback: function(row, data, index) {},
        createdRow: function(row, data, dataIndex) {
          var len, num, sort, start, total;
          len = this.fnSettings()._iDisplayLength;
          start = this.fnSettings()._iDisplayStart;
          sort = this.fnSettings().aaSorting[0][1];
          total = this.fnSettings()._iRecordsDisplay;
          if (sort === 'asc') {
            num = dataIndex + start + 1;
          } else {
            num = total - (dataIndex + start);
            data.num = num;
          }
          return $('td:first', row).text(num);
        }
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

    col_creat.action = function(td, cellData, rowData, row, col) {
      var html, text;
      text = $(td).text();
      html = $("<span class=\"fa-stack fa-lg\"> <i class=\"fa fa-square-o fa-stack-2x\"></i> <a class=\"fa fa-pencil fa-stack-1x label-default\" href=\"" + location.pathname + "/edit=" + rowData.id + "\"></a> </span> <span class=\"fa-stack fa-lg\"> <i class=\"fa fa-square-o fa-stack-2x\"></i> <a class=\"fa fa-times fa-stack-1x label-danger\" href=\"" + location.pathname + "/delete=" + rowData.id + "\" data-data='{\"id\": " + rowData.id + "}' data-method=\"post\" data-modal=\"delete-confirm\"></a> </span>");
      return $(td).html(html);
    };

    col_creat.title = function(td, cellData, rowData, row, col) {
      var html, text;
      text = $(td).text();
      html = $("<a href='" + location.pathname + "/edit=" + rowData.id + "'>" + text + "</a>");
      return $(td).html(html);
    };

    col_creat.url = function(td, cellData, rowData, row, col) {
      var html, root, site_location, text;
      text = $(td).text();
      root = $("meta[name='site:root']").attr('content');
      site_location = root + text;
      html = $("<a href='" + site_location + "?preview=yes'>" + text + "</a>");
      return $(td).html(html);
    };

    return datatable;

  })();

  route('*', function() {
    return $("[data-tablesrc]", this).each(function() {
      return new window.saloos.datatable(this);
    });
  });

}).call(this);

(function() {
  window.saloos.getParent = (function() {
    function getParent(el) {
      var name;
      name = $(el).attr('name');
      $(el).removeAttr('name');
      $("<input type=\"hidden\" name=\"" + name + "\" value=\"" + ($(el).val()) + "\">").insertAfter($(el));
      $(el).change(function() {
        var addr, val;
        $(this).attr('disabled', '');
        val = $(this).val();
        addr = location.pathname.replace(/\/[^\/]*$/, '') + "/options";
        return $.ajax({
          url: addr,
          data: {
            parent: val,
            type: "getparent"
          },
          success: function(data) {
            return console.log(data);
          }
        });
      });
    }

    return getParent;

  })();

  route('*', function() {
    return $("#sp-parent", this).each(function() {
      return new saloos.getParent(this);
    });
  });

}).call(this);

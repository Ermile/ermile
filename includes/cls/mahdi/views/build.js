var BreadcrumbView = React.createClass({displayName: "BreadcrumbView",
  createItem: function(object) {
    return React.createElement("li", null, 
      React.createElement("i", {className: "fa fa-arrow-right"}), 
      React.createElement("a", {"data-fake": true, href: object.url}, object.name)
    );
  },
  render: function() {
    var _self = this;
    var url = '';

    var els = this.props.items.map(function(o) {
      url += '/' + o;
      return _self.createItem({
        name: o,
        url: url
      });
    });

    var home = React.createElement("li", null, 
      React.createElement("a", {"data-fake": true, href: "/"}, "Home")
    );

    els.unshift(home);

    return React.createElement("ul", {className: "fbreadcrumb"}, els);
  }
});
var FileView = React.createClass({displayName: "FileView",
  render: function() {
    var mime = this.props.ext.split('/');
    return React.createElement("li", {className: this.props.disabled ? 'file disabled' : 'file'}, 
      React.createElement("span", {className: "file-ext"}, mime[1]), 
      React.createElement("span", null, React.createElement("a", {"data-fake": true, href: this.props.disabled ? '#' : this.props.href}, this.props.name)), 
      React.createElement("span", {className: "file-type"}, mime[0]), 
      React.createElement("span", {className: "file-size"}, this.props.size)
    );
  }
});

var FolderView = React.createClass({displayName: "FolderView",
  render: function() {
    return React.createElement("li", {className: this.props.disabled ? 'folder disabled' : 'folder'}, 
      React.createElement("span", null, "Folder"), 
      React.createElement("span", null, React.createElement("a", {"data-fake": true, href: this.props.disabled ? '#' : this.props.href}, this.props.name)), 
      React.createElement("span", {className: "folder-children"}, this.props.children)
    );
  }
})

var FileList = React.createClass({displayName: "FileList",
  pathFor: function(item) {
    var path = '/' + item.name;

    var parent = _.findWhere(this.props.items, {id: item.parent});
    while(parent) {
      path = '/' + parent.name + path;

      parent = _.findWhere(this.props.items, {id: parent.parent});
    }

    return path;
  },
  createItems: function() {
    if(this.props.parent === null) return null;
    var parent = _.matches({parent: this.props.parent || ''});

    var _self = this;

    var items = _.filter(this.props.items, parent).sort(function(a, b) {
      return (+a.order||0) - (+b.order||0);
    }).map(function(item,i) {
      if(item.type === 'folder')
        return React.createElement(FolderView, React.__spread({},  item, {href: _self.pathFor(item)}));
      else
        return React.createElement(FileView, React.__spread({},  item, {href: _self.pathFor(item)}));
    })

    if(!items || !items.length) return null;
    return items;
  },
  render: function() {
    return React.createElement("ul", null, 
      React.createElement("li", {id: "newform", className: "folder hidden"}, 
        React.createElement("form", {method: "post", action: "/newfolder"}, 
          React.createElement("input", {type: "text", name: "address", type: "hidden"}), 
          React.createElement("input", {type: "text", name: "name"}), 

          React.createElement("button", {type: "hidden"}, "Create")
        )
      ), 
      this.createItems() || 'No Files Found'
    );
  }
});
var TreeView = React.createClass({displayName: "TreeView",
  createItem: function(object) {
    return React.createElement("li", null, 
      React.createElement("i", null), 
      React.createElement("a", {"data-fake": true, href: object.url}, object.name), 
      React.createElement("ul", null, 
        this.createItems(object.children)
      )
    );
  },
  createItems: function(list) {
    var _self = this;
    var els = [];
    for(var item in list) {
      els.push(_self.createItem(list[item]));
    }

    return els;
  },
  render: function() {
    var els = this.createItems(this.props.items);

    return React.createElement("ul", null, 
      React.createElement("li", null, 
        React.createElement("i", null), 
        React.createElement("a", {"data-fake": true, href: "/"}, "Home"), 
        React.createElement("ul", null, 
          els
        )
      )
    );
  }
});
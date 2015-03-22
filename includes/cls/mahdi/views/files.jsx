var FileView = React.createClass({
  render: function() {
    var mime = this.props.ext.split('/');
    return <li className={this.props.disabled ? 'file disabled' : 'file'}>
      <span className="file-ext">{mime[1]}</span>
      <span><a data-fake href={this.props.disabled ? '#' : this.props.href}>{this.props.name}</a></span>
      <span className="file-type">{mime[0]}</span>
      <span className="file-size">{this.props.size}</span>
    </li>;
  }
});

var FolderView = React.createClass({
  render: function() {
    return <li className={this.props.disabled ? 'folder disabled' : 'folder'}>
      <span>Folder</span>
      <span><a data-fake href={this.props.disabled ? '#' : this.props.href}>{this.props.name}</a></span>
      <span className="folder-children">{this.props.children}</span>
    </li>;
  }
})

var FileList = React.createClass({
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
        return <FolderView {...item} href={_self.pathFor(item)} />;
      else
        return <FileView {...item} href={_self.pathFor(item)} />;
    })

    if(!items || !items.length) return null;
    return items;
  },
  render: function() {
    return <ul>
      <li id='newform' className='folder hidden'>
        <form method="post" action="/newfolder">
          <input type='text' name='address' type='hidden' />
          <input type='text' name='name' />

          <button type='hidden'>Create</button>
        </form>
      </li>
      {this.createItems() || 'No Files Found'}
    </ul>;
  }
});
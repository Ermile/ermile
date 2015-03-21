var TreeView = React.createClass({
  createItem: function(object) {
    return <li>
      <i></i>
      <a href={object.url}>{object.name}</a>
      <ul>
        {this.createItems(object.children)}
      </ul>
    </li>;
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

    return <ul>
      <li>
        <i></i>
        <a href="/">Home</a>
        <ul>
          {els}
        </ul>
      </li>
    </ul>;
  }
});
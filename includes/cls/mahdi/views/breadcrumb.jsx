var BreadcrumbView = React.createClass({
  createItem: function(object) {
    return <li>
      <i className="fa fa-arrow-right"></i>
      <a href={object.url}>{object.name}</a>
    </li>;
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

    var home = <li>
      <a href="/">Home</a>
    </li>;

    els.unshift(home);

    return <ul className='fbreadcrumb'>{els}</ul>;
  }
});
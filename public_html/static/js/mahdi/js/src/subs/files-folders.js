/*var FileModel = Model.extend({
  url: '/file'
});

var fileList = new Collection([
  new FileModel({id: 2}),
  new FileModel(),
  new FileModel(),
  new FileModel()
]);

var FolderModel = Model.extend({
  url: '/folder'
});

var folderList = new Collection([
  new FolderModel({id: 0}),
  new FolderModel() // Automatically assigned with id = 1
]);

var FileFolderView = View.extend({
  url: 'files',
  container: '#file-div',
  render: function() {
    this.super().render.apply(this);

    var _super = this;

    this.$('[id^="folder"]').on('focus', function() {
      var id = parseInt($(this).attr('id').slice(6), 10);
      var m = _super.models.folders.get(id);
      console.log('Folder: ' + m.get('id') + ' - ' + m.get('name'));
    });

    this.$('[id^="file"]').on('focus', function() {
      var id = parseInt($(this).attr('id').slice(4), 10);
      var m = _super.models.files.get(id);
      console.log('File: ' + m.get('id') + ' - ' + m.get('name'));
    })
  }
});

var ffview = new FileFolderView({
  id: '',
  models: {
    files: fileList,
    folders: folderList
  }
});

$.when(folderList.fetch(), fileList.fetch(), ffview.fetch()).then(function() {
  folderList.save();
  fileList.save();
  ffview.render();
  ffview.save();
});

ffview.render();*/
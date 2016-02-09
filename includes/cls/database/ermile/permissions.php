<?php
namespace database\ermile;
class permissions 
{
	public $id                = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'id'              ,'type'=>'smallint@5'];
	public $permission_title  = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'title'           ,'type'=>'varchar@50'];
	public $permission_object = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'object'          ,'type'=>'varchar@100'];
	public $permission_read   = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'read'            ,'type'=>'bit@1'];
	public $permission_add    = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'add'             ,'type'=>'bit@1'];
	public $permission_edit   = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'edit'            ,'type'=>'bit@1'];
	public $permission_delete = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'delete'          ,'type'=>'bit@1'];
	public $permission_type   = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'type'            ,'type'=>'varchar@50'];

	//--------------------------------------------------------------------------------id
	public function id(){}

	public function permission_title()
	{
		$this->form('#title')->type('text')->name('title')->maxlength('50')->required();
	}

	public function permission_object()
	{
		$this->form()->type('text')->name('object')->maxlength('100')->required();
	}

	public function permission_read(){}

	public function permission_add(){}

	public function permission_edit(){}

	public function permission_delete(){}

	public function permission_type()
	{
		$this->form()->type('text')->name('type')->maxlength('50');
	}
}
?>
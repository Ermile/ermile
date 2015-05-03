<?php
namespace database\ermile;
class costcats 
{
	public $id             = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'id'              ,'type'=>'smallint@5'];
	public $costcat_title  = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'title'           ,'type'=>'varchar@50'];
	public $costcat_slug   = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'slug'            ,'type'=>'varchar@50'];
	public $costcat_desc   = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'desc'            ,'type'=>'varchar@200'];
	public $costcat_parent = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'parent'          ,'type'=>'smallint@5'                      ,'foreign'=>'costcats@id!costcat_title'];
	public $costcat_order  = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'order'           ,'type'=>'smallint@5'];
	public $costcat_type   = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'type'            ,'type'=>'enum@income,outcome'];
	public $costcat_status = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'status'          ,'type'=>'enum@enable,disable,expire!enable'];
	public $date_modified  = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'modified'        ,'type'=>'timestamp@'];

	//--------------------------------------------------------------------------------id
	public function id(){}

	public function costcat_title()
	{
		$this->form('#title')->type('text')->name('title')->maxlength('50')->required();
	}

	public function costcat_slug()
	{
		$this->form('#slug')->type('text')->name('slug')->maxlength('50')->required();
	}

	public function costcat_desc()
	{
		$this->form('#desc')->type('textarea')->name('desc')->maxlength('200');
	}

	public function costcat_parent()
	{
		$this->form()->type('select')->name('parent');
		$this->setChild();
	}

	public function costcat_order()
	{
		$this->form()->type('number')->name('order')->max('99999');
	}

	public function costcat_type()
	{
		$this->form()->type('radio')->name('type');
		$this->setChild();
	}

	public function costcat_status()
	{
		$this->form()->type('radio')->name('status')->required();
		$this->setChild();
	}

	public function date_modified(){}
}
?>
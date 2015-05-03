<?php
namespace database\ermile;
class options 
{
	public $id            = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'id'              ,'type'=>'smallint@5'];
	public $option_cat    = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'cat'             ,'type'=>'varchar@50'];
	public $option_key    = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'key'             ,'type'=>'varchar@50'];
	public $option_value  = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'value'           ,'type'=>'varchar@200'];
	public $option_extra  = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'extra'           ,'type'=>'varchar@400'];
	public $option_status = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'status'          ,'type'=>'enum@enable,disable,expire!enable'];
	public $date_modified = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'modified'        ,'type'=>'timestamp@'];

	//--------------------------------------------------------------------------------id
	public function id(){}

	public function option_cat()
	{
		$this->form()->type('text')->name('cat')->maxlength('50')->required();
	}

	public function option_key()
	{
		$this->form()->type('text')->name('key')->maxlength('50')->required();
	}

	public function option_value()
	{
		$this->form()->type('textarea')->name('value')->maxlength('200');
	}

	public function option_extra()
	{
		$this->form()->type('textarea')->name('extra')->maxlength('400');
	}

	public function option_status()
	{
		$this->form()->type('radio')->name('status')->required();
		$this->setChild();
	}

	public function date_modified(){}
}
?>
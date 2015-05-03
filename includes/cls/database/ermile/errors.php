<?php
namespace database\ermile;
class errors 
{
	public $id             = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'id'              ,'type'=>'smallint@5'];
	public $error_title    = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'title'           ,'type'=>'varchar@100'];
	public $error_solution = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'solution'        ,'type'=>'varchar@999'];
	public $error_priority = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'priority'        ,'type'=>'enum@critical,high,medium,low!medium'];
	public $date_modified  = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'modified'        ,'type'=>'timestamp@'];

	//--------------------------------------------------------------------------------id
	public function id(){}

	public function error_title()
	{
		$this->form('#title')->type('text')->name('title')->maxlength('100')->required();
	}

	public function error_solution()
	{
		$this->form()->type('textarea')->name('solution')->maxlength('999');
	}

	public function error_priority()
	{
		$this->form()->type('radio')->name('priority')->required();
		$this->setChild();
	}

	public function date_modified(){}
}
?>
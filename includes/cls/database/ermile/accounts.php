<?php
namespace database\ermile;
class accounts 
{
	public $id                     = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'id'              ,'type'=>'smallint@5'];
	public $account_title          = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'title'           ,'type'=>'varchar@50'];
	public $account_slug           = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'slug'            ,'type'=>'varchar@50'];
	public $bank_id                = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'bank'            ,'type'=>'smallint@5'                      ,'foreign'=>'banks@id!id'];
	public $account_branch         = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'branch'          ,'type'=>'varchar@50'];
	public $account_number         = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'number'          ,'type'=>'varchar@50'];
	public $account_card           = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'card'            ,'type'=>'varchar@30'];
	public $account_primarybalance = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'primarybalance'  ,'type'=>'decimal@14,4!0.0000'];
	public $account_desc           = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'desc'            ,'type'=>'varchar@200'];
	public $user_id                = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'user'            ,'type'=>'int@10'                          ,'foreign'=>'users@id!user_displayname'];
	public $date_modified          = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'modified'        ,'type'=>'timestamp@'];

	//--------------------------------------------------------------------------------id
	public function id(){}

	public function account_title()
	{
		$this->form('#title')->type('text')->name('title')->maxlength('50')->required();
	}

	public function account_slug()
	{
		$this->form('#slug')->type('text')->name('slug')->maxlength('50')->required();
	}
	//--------------------------------------------------------------------------------foreign
	public function bank_id()
	{
		$this->form()->type('select')->name('bank_')->required();
		$this->setChild();
	}

	public function account_branch()
	{
		$this->form()->type('text')->name('branch')->maxlength('50');
	}

	public function account_number()
	{
		$this->form()->type('text')->name('number')->maxlength('50');
	}

	public function account_card()
	{
		$this->form()->type('text')->name('card')->maxlength('30');
	}

	public function account_primarybalance()
	{
		$this->form()->type('number')->name('primarybalance')->max('99999999999999')->required();
	}

	public function account_desc()
	{
		$this->form('#desc')->type('textarea')->name('desc')->maxlength('200');
	}
	//--------------------------------------------------------------------------------foreign
	public function user_id()
	{
		$this->form()->type('select')->name('user_')->required();
		$this->setChild();
	}

	public function date_modified(){}
}
?>
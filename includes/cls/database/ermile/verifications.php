<?php
namespace database\ermile;
class verifications 
{
	public $id                      = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'id'              ,'type'=>'smallint@5'];
	public $verification_type       = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'type'            ,'type'=>'enum@emailsignup,emailchangepass,emailrecovery,mobilesignup,mobilechangepass,mobilerecovery'];
	public $verification_value      = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'value'           ,'type'=>'varchar@50'];
	public $verification_code       = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'code'            ,'type'=>'varchar@32'];
	public $verification_url        = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'url'             ,'type'=>'varchar@100'];
	public $user_id                 = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'user'            ,'type'=>'int@10'                          ,'foreign'=>'users@id!user_displayname'];
	public $verification_verified   = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'verified'        ,'type'=>'enum@yes,no!no'];
	public $verification_status     = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'status'          ,'type'=>'enum@enable,disable,expire!enable'];
	public $verification_createdate = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'createdate'      ,'type'=>'datetime@'];
	public $date_modified           = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'modified'        ,'type'=>'timestamp@'];

	//--------------------------------------------------------------------------------id
	public function id(){}

	public function verification_type()
	{
		$this->form()->type('radio')->name('type')->required();
		$this->setChild();
	}

	public function verification_value()
	{
		$this->form()->type('text')->name('value')->maxlength('50')->required();
	}

	public function verification_code()
	{
		$this->form()->type('text')->name('code')->maxlength('32')->required();
	}

	public function verification_url()
	{
		$this->form()->type('text')->name('url')->maxlength('100');
	}
	//--------------------------------------------------------------------------------foreign
	public function user_id()
	{
		$this->form()->type('select')->name('user_')->required();
		$this->setChild();
	}

	public function verification_verified()
	{
		$this->form()->type('radio')->name('verified')->required();
		$this->setChild();
	}

	public function verification_status()
	{
		$this->form()->type('radio')->name('status')->required();
		$this->setChild();
	}

	public function verification_createdate()
	{
		$this->form()->type('text')->name('createdate');
	}

	public function date_modified(){}
}
?>
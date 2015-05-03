<?php
namespace database\ermile;
class postmetas 
{
	public $id              = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'id'              ,'type'=>'bigint@20'];
	public $post_id         = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'post'            ,'type'=>'bigint@20'                       ,'foreign'=>'posts@id!post_title'];
	public $postmeta_cat    = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'cat'             ,'type'=>'varchar@50'];
	public $postmeta_key    = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'key'             ,'type'=>'varchar@100'];
	public $postmeta_value  = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'value'           ,'type'=>'varchar@999'];
	public $postmeta_status = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'status'          ,'type'=>'enum@enable,disable,expire!enable'];
	public $date_modified   = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'modified'        ,'type'=>'timestamp@'];

	//--------------------------------------------------------------------------------id
	public function id(){}
	//--------------------------------------------------------------------------------foreign
	public function post_id()
	{
		$this->form()->type('select')->name('post_')->required();
		$this->setChild();
	}

	public function postmeta_cat()
	{
		$this->form()->type('text')->name('cat')->maxlength('50')->required();
	}

	public function postmeta_key()
	{
		$this->form()->type('text')->name('key')->maxlength('100')->required();
	}

	public function postmeta_value()
	{
		$this->form()->type('textarea')->name('value')->maxlength('999');
	}

	public function postmeta_status()
	{
		$this->form()->type('radio')->name('status')->required();
		$this->setChild();
	}

	public function date_modified(){}
}
?>
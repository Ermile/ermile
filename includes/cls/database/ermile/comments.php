<?php
namespace database\ermile;
class comments 
{
	public $id              = array('null' =>'NO',  'show' =>'NO',  'label'=>'id',            'type' => 'smallint@5',                                       );
	public $post_id         = array('null' =>'YES', 'show' =>'YES', 'label'=>'post',          'type' => 'smallint@5',                                       'foreign'=>'posts@id!post_title');
	public $product_id      = array('null' =>'YES', 'show' =>'YES', 'label'=>'product',       'type' => 'smallint@5',                                       'foreign'=>'products@id!product_title');
	public $comment_author  = array('null' =>'YES', 'show' =>'YES', 'label'=>'author',        'type' => 'varchar@50',                                       );
	public $comment_email   = array('null' =>'YES', 'show' =>'YES', 'label'=>'email',         'type' => 'varchar@100',                                      );
	public $comment_url     = array('null' =>'YES', 'show' =>'YES', 'label'=>'url',           'type' => 'varchar@100',                                      );
	public $comment_content = array('null' =>'NO',  'show' =>'YES', 'label'=>'content',       'type' => 'varchar@999',                                      );
	public $comment_status  = array('null' =>'NO',  'show' =>'YES', 'label'=>'status',        'type' => 'enum@approved,unapproved,spam,deleted!unapproved', );
	public $comment_parent  = array('null' =>'YES', 'show' =>'YES', 'label'=>'parent',        'type' => 'smallint@5',                                       );
	public $user_id         = array('null' =>'YES', 'show' =>'NO',  'label'=>'user',          'type' => 'smallint@5',                                       'foreign'=>'users@id!user_nickname');
	public $Visitor_id      = array('null' =>'NO',  'show' =>'YES', 'label'=>'visitor',       'type' => 'int@10',                                           'foreign'=>'Visitors@id!Visitor_title');
	public $date_modified   = array('null' =>'YES', 'show' =>'NO',  'label'=>'modified',      'type' => 'timestamp@',                                       );


	//------------------------------------------------------------------ id
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function post_id() 
	{
		$this->form("select")->name("post_")->min(0)->max(99999)->type("select")->validate()->id();
		$this->setChild();
	}

	//------------------------------------------------------------------ id - foreign key
	public function product_id() 
	{
		$this->form("select")->name("product_")->min(0)->max(99999)->type("select")->validate()->id();
		$this->setChild();
	}
	public function comment_author() 
	{
		$this->form("text")->name("author")->maxlength(50)->type('text');
	}

	//------------------------------------------------------------------ email
	public function comment_email() 
	{
		$this->form("#email")->maxlength(100)->type('email');
	}
	public function comment_url() 
	{
		$this->form("text")->name("url")->maxlength(100)->type('text');
	}
	public function comment_content() 
	{
		$this->form("text")->name("content")->maxlength(999)->required()->type('textarea');
	}

	//------------------------------------------------------------------ select button
	public function comment_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild();
	}
	public function comment_parent() 
	{
		$this->form("text")->name("parent")->min(0)->max(99999)->type('number');
	}

	//------------------------------------------------------------------ user_id
	public function user_id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function Visitor_id() 
	{
		$this->form("select")->name("visitor_")->min(0)->max(9999999999)->required()->type("select")->validate()->id();
		$this->setChild();
	}
	public function date_modified() {}
}
?>
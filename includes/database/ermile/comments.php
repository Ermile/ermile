<?php
namespace database\ermile;
class comments 
{
	public $id = array('type' => 'smallint@5', 'null'=>'NO', 'show'=>'NO', 'label'=>'ID');
	public $post_id = array('type' => 'smallint@5', 'null'=>'YES', 'show'=>'YES', 'label'=>'Post', 'foreign'=>'posts@id!post_title');
	public $product_id = array('type' => 'smallint@5', 'null'=>'YES', 'show'=>'YES', 'label'=>'Product', 'foreign'=>'products@id!product_title');
	public $comment_author = array('type' => 'varchar@50', 'null'=>'YES', 'show'=>'YES', 'label'=>'Author');
	public $comment_email = array('type' => 'varchar@100', 'null'=>'YES', 'show'=>'YES', 'label'=>'Email');
	public $comment_url = array('type' => 'varchar@100', 'null'=>'YES', 'show'=>'YES', 'label'=>'Url');
	public $comment_content = array('type' => 'varchar@999', 'null'=>'NO', 'show'=>'YES', 'label'=>'Content');
	public $comment_status = array('type' => 'enum@approved,unapproved,spam,deleted!unapproved', 'null'=>'NO', 'show'=>'YES', 'label'=>'Status');
	public $comment_parent = array('type' => 'int@10', 'null'=>'YES', 'show'=>'YES', 'label'=>'Parent');
	public $user_id = array('type' => 'smallint@5', 'null'=>'YES', 'show'=>'NO', 'label'=>'User', 'foreign'=>'users@id!user_nickname');
	public $Visitor_id = array('type' => 'int@10', 'null'=>'NO', 'show'=>'YES', 'label'=>'Visitor', 'foreign'=>'Visitors@id!Visitor_title');
	public $date_modified = array('type' => 'timestamp@', 'null'=>'YES', 'show'=>'NO', 'label'=>'Date Modified');


	//------------------------------------------------------------------ id - primary key
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function post_id() 
	{
		$this->form("select")->name("post")->min(0)->max(9999)->type("select")->validate()->id();
		$this->setChild($this->form);
	}

	//------------------------------------------------------------------ id - foreign key
	public function product_id() 
	{
		$this->form("select")->name("product")->min(0)->max(9999)->type("select")->validate()->id();
		$this->setChild($this->form);
	}
	public function comment_author() 
	{
		$this->form("text")->name("author")->maxlength(50)->type('text');
	}

	//------------------------------------------------------------------ email
	public function comment_email() 
	{
		$this->form("#email")->type("email")->required()->maxlength(100);
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
		$this->setChild($this->form);
	}
	public function comment_parent() 
	{
		$this->form("text")->name("parent")->min(0)->max(999999999)->type('number');
	}
	public function user_id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function Visitor_id() 
	{
		$this->form("select")->name("Visitor")->min(0)->max(999999999)->required()->type("select")->validate()->id();
		$this->setChild($this->form);
	}
	public function date_modified() {}
}
?>
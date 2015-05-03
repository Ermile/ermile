<?php
namespace database\ermile;
class comments 
{
	public $id              = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'id'              ,'type'=>'int@10'];
	public $post_id         = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'post'            ,'type'=>'bigint@20'                       ,'foreign'=>'posts@id!post_title'];
	public $product_id      = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'product'         ,'type'=>'int@10'                          ,'foreign'=>'products@id!product_title'];
	public $comment_author  = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'author'          ,'type'=>'varchar@50'];
	public $comment_email   = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'email'           ,'type'=>'varchar@100'];
	public $comment_url     = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'url'             ,'type'=>'varchar@100'];
	public $comment_content = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'content'         ,'type'=>'varchar@999'];
	public $comment_status  = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'status'          ,'type'=>'enum@approved,unapproved,spam,deleted!unapproved'];
	public $comment_parent  = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'parent'          ,'type'=>'smallint@5'                      ,'foreign'=>'comments@id!comment_title'];
	public $user_id         = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'user'            ,'type'=>'int@10'                          ,'foreign'=>'users@id!user_displayname'];
	public $Visitor_id      = ['null'=>'NO'  ,'show'=>'YES'     ,'label'=>'visitor'         ,'type'=>'bigint@20'                       ,'foreign'=>'visitors@id!visitor_title'];
	public $date_modified   = ['null'=>'YES' ,'show'=>'YES'     ,'label'=>'modified'        ,'type'=>'timestamp@'];

	//--------------------------------------------------------------------------------id
	public function id(){}
	//--------------------------------------------------------------------------------foreign
	public function post_id()
	{
		$this->form()->type('select')->name('post_');
		$this->setChild();
	}
	//--------------------------------------------------------------------------------foreign
	public function product_id()
	{
		$this->form()->type('select')->name('product_');
		$this->setChild();
	}

	public function comment_author()
	{
		$this->form()->type('text')->name('author')->maxlength('50');
	}

	public function comment_email()
	{
		$this->form('#email')->type('email')->name('email')->maxlength('100');
	}

	public function comment_url()
	{
		$this->form()->type('text')->name('url')->maxlength('100');
	}

	public function comment_content()
	{
		$this->form()->type('textarea')->name('content')->maxlength('999')->required();
	}

	public function comment_status()
	{
		$this->form()->type('radio')->name('status')->required();
		$this->setChild();
	}

	public function comment_parent()
	{
		$this->form()->type('select')->name('parent');
		$this->setChild();
	}
	//--------------------------------------------------------------------------------foreign
	public function user_id()
	{
		$this->form()->type('select')->name('user_');
		$this->setChild();
	}
	//--------------------------------------------------------------------------------foreign
	public function Visitor_id()
	{
		$this->form()->type('select')->name('visitor_')->required();
		$this->setChild();
	}

	public function date_modified(){}
}
?>